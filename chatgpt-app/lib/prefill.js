'use strict';
/* Phase 2 — préparation de souscription pré-remplie (données personnelles).
   Appelle l'API prefill sécurisée de jlassure et renvoie une session_url
   (jeton usage unique, 30 min, AUCUNE donnée perso dans l'URL).

   ⚠️ Données personnelles : OUTIL DÉSACTIVÉ par défaut. Activer via la variable
   d'environnement ENABLE_PREFILL_SESSION=1 UNIQUEMENT après validation RGPD
   (consentement client, registre des traitements). Voir docs/rgpd-checklist-ocr.md.
   L'outil ne fait que PRÉPARER : le client ouvre l'URL, vérifie, consulte l'IPID,
   téléverse ses pièces et paie sur le tunnel (DDA/ACPR). */

const { createPrefillSession, downloadDocument, uploadPrefillDocs } = require('./jlassureApi');
const { CATEGORIES, LABELS } = require('./tarifs');
const { SOUSCRIPTION_URI } = require('./resources');

/* --- Phase 2bis : pièces jointes (photos partagées dans ChatGPT -> dossier JL Assure) ---
   ChatGPT fournit pour chaque photo une référence { file_id, download_url, mime_type?, file_name? }
   (openai/fileParams). Notre serveur télécharge puis transmet en multipart : transit éphémère,
   aucune écriture disque, aucune conservation. */
const FILE_FIELDS = [
  { arg: 'photo_permis', api: 'permis', label: 'permis (recto)' },
  { arg: 'photo_permis_verso', api: 'permis_verso', label: 'permis (verso)' },
  { arg: 'photo_carte_grise', api: 'carte_grise', label: 'carte grise (recto)' },
  { arg: 'photo_carte_grise_verso', api: 'carte_grise_verso', label: 'carte grise (verso)' }
];

const DOWNLOAD_ERRORS = {
  file_too_large: 'fichier de plus de 10 Mo — demander une photo plus légère',
  empty_file: 'fichier vide — demander une nouvelle photo',
  reference_incomplete: "référence de fichier incomplète (téléversement mobile ?) — le client pourra déposer cette pièce sur le tunnel"
};
const UPLOAD_ERRORS = {
  invalid_format: 'format refusé (JPEG, PNG ou PDF uniquement) — demander une photo dans un de ces formats',
  file_too_large: 'fichier de plus de 10 Mo — demander une photo plus légère',
  unreadable_document: 'photo trop petite, floue ou PDF corrompu — demander une nouvelle photo nette',
  session_not_found: 'session expirée — recréer la session puis renvoyer les pièces'
};

function libelleEchec(code, fallback) {
  return DOWNLOAD_ERRORS[code] || UPLOAD_ERRORS[code] || fallback || ('erreur ' + code + ' — le client pourra déposer cette pièce sur le tunnel');
}

/* Télécharge les photos référencées puis les joint au dossier de la session.
   Renvoie { transmises: ['permis', …], echecs: [{ piece, code, message }] }. */
async function transmettrePieces(args, prefillToken, opts) {
  const echecs = [];
  const aTransmettre = [];
  const labels = {}; /* champ API -> libellé humain */
  for (const spec of FILE_FIELDS) {
    const v = args[spec.arg];
    if (!v) continue;
    labels[spec.api] = spec.label;
    const url = typeof v === 'string' ? v : (v && v.download_url) || null;
    if (!url) { echecs.push({ piece: spec.label, code: 'reference_incomplete', message: libelleEchec('reference_incomplete') }); continue; }
    const dl = await downloadDocument(url, opts);
    if (!dl.ok) { echecs.push({ piece: spec.label, code: dl.reason, message: libelleEchec(dl.reason) }); continue; }
    aTransmettre.push({
      field: spec.api, bytes: dl.bytes,
      mimeType: (typeof v === 'object' && v.mime_type) || dl.mimeType || 'image/jpeg',
      filename: (typeof v === 'object' && v.file_name) || (spec.api + '.jpg')
    });
  }
  if (!aTransmettre.length) return { transmises: [], echecs: echecs };

  const up = await uploadPrefillDocs(prefillToken, aTransmettre, opts);
  const data = (up && up.data) || {};
  const transmises = Array.isArray(data.pieces) ? data.pieces : [];
  /* Pièces refusées, signalées par l'API selon le cas (spec JL Assure) :
     - HTTP 207 succès partiel : data.warnings = [{ field, error, code }]
     - HTTP 422 échec total    : data.details  = [{ field, error, code }] */
  const problemes = (Array.isArray(data.warnings) ? data.warnings : [])
    .concat(Array.isArray(data.details) ? data.details : []);
  if (problemes.length) {
    problemes.forEach(function (d) {
      echecs.push({ piece: labels[d.field] || d.field, code: d.code || 'erreur', message: libelleEchec(d.code, d.error) });
    });
  } else if (!up.ok && !transmises.length) {
    /* Erreur globale (réseau, 401, 500, ou 4xx sans corps structuré) : repli tunnel */
    aTransmettre.forEach(function (doc) {
      echecs.push({ piece: labels[doc.field] || doc.field, code: up.reason || ('http_' + up.status), message: 'transmission impossible — le client pourra déposer cette pièce sur le tunnel' });
    });
  }
  return { transmises: transmises.map(function (p) { return labels[p] || p; }), echecs: echecs };
}

function sessionEnabled() {
  const v = String(process.env.ENABLE_PREFILL_SESSION || '').toLowerCase();
  return v === '1' || v === 'true' || v === 'on';
}

const CONDUCTEUR_KEYS = ['nom', 'prenom', 'date_naissance', 'pays_naissance', 'adresse', 'code_postal',
  'ville', 'pays_residence', 'mobile', 'email', 'num_permis', 'date_permis', 'pays_permis', 'type_permis'];
const VEHICULE_KEYS = ['immatriculation', 'date_premiere_mec', 'marque', 'modele',
  'genre', 'puissance_fiscale', 'ptac_kg', 'places', 'chassis', 'pays_immatriculation'];
/* profil_tarifaire = champs du formulaire de tarif (équivalent des paramètres GET).
   Doit être complet pour que le tarif se pré-remplisse à l'ouverture. */
const PROFIL_KEYS = ['categorie_vehi', 'age_vehicule', 'puissance',
  'pays_immatriculation', 'pays_residence', 'date_naissance',
  'duree', 'date_debut', 'heure_debut'];

function pick(obj, keys) {
  const o = {};
  if (!obj) return o;
  keys.forEach(function (k) {
    const v = obj[k];
    if (v !== undefined && v !== null && v !== '') o[k] = v;
  });
  return o;
}

/* Construit un profil_tarifaire complet : reprend les champs fournis, puis complète
   les champs de tarif manquants à partir des blocs conducteur/véhicule. */
function buildProfil(args) {
  const c = args.conducteur || {}, v = args.vehicule || {}, pt = args.profil_tarifaire || {};
  const prof = pick(pt, PROFIL_KEYS);
  if (!prof.categorie_vehi && v.genre) prof.categorie_vehi = v.genre;
  if (!prof.date_naissance && c.date_naissance) prof.date_naissance = c.date_naissance;
  if (!prof.pays_residence && c.pays_residence) prof.pays_residence = c.pays_residence;
  if (!prof.pays_immatriculation && v.pays_immatriculation) prof.pays_immatriculation = v.pays_immatriculation;
  if (!prof.puissance && v.puissance_fiscale != null) {
    const cv = Number(v.puissance_fiscale);
    if (!isNaN(cv)) prof.puissance = cv <= 30 ? 'inf30' : 'sup30';
  }
  /* PTAC non transmis (calculé auto par le tunnel) ; pour un camping-car,
     ptac_kg > 3500 sélectionne la catégorie CAM-Fou plutôt que CC-Cap. */
  if (prof.categorie_vehi === 'CC-Cap' && v.ptac_kg != null) {
    const kg = Number(v.ptac_kg);
    if (!isNaN(kg) && kg > 3500) prof.categorie_vehi = 'CAM-Fou';
  }
  if (!prof.age_vehicule && v.date_premiere_mec) {
    const m = String(v.date_premiere_mec).match(/(\d{4})/);
    if (m) prof.age_vehicule = (new Date().getFullYear() - Number(m[1])) < 10 ? 'moins10' : 'plus10';
  }
  return prof;
}

/* Construit le payload jlassure en ne gardant que les champs fournis (minimisation). */
function buildSessionPayload(args) {
  args = args || {};
  const payload = {};
  const c = pick(args.conducteur, CONDUCTEUR_KEYS);
  const v = pick(args.vehicule, VEHICULE_KEYS);
  const p = buildProfil(args);
  if (Object.keys(c).length) payload.conducteur = c;
  if (Object.keys(v).length) payload.vehicule = v;
  if (Object.keys(p).length) payload.profil_tarifaire = p;
  return payload;
}

/* Dialogue de correction : on ne crée PAS de session tant que les champs clés
   ne sont pas présents et bien formés. Le modèle demande alors au client de
   confirmer/corriger (par écrit ou nouvelle photo) plutôt que de deviner. */
function estVide(v) { return v === undefined || v === null || String(v).trim() === ''; }
const DATE_ISO = /^\d{4}-\d{2}-\d{2}$/;
const TYPES_PERMIS = ['B', 'C1', 'C', 'D1', 'D', 'BE', 'C1E', 'CE', 'D1E', 'DE'];

function champsAConfirmer(payload) {
  const c = payload.conducteur || {}, v = payload.vehicule || {};
  const out = [];
  /* Présence des champs clés (issus du permis + carte grise) */
  [['nom', 'le nom du conducteur'], ['prenom', 'le prénom du conducteur'],
   ['date_naissance', 'la date de naissance'], ['num_permis', 'le numéro de permis']
  ].forEach(function (f) { if (estVide(c[f[0]])) out.push({ champ: f[1], raison: 'non lu ou manquant' }); });
  if (estVide(v.immatriculation)) out.push({ champ: "l'immatriculation du véhicule", raison: 'non lue ou manquante' });
  /* Cohérence de format (une date/valeur mal lue = à confirmer) */
  if (!estVide(c.date_naissance) && !DATE_ISO.test(c.date_naissance)) out.push({ champ: 'la date de naissance', raison: 'format illisible (attendu JJ/MM/AAAA)' });
  if (!estVide(c.date_permis) && !DATE_ISO.test(c.date_permis)) out.push({ champ: "la date d'obtention du permis", raison: 'format illisible (attendu JJ/MM/AAAA)' });
  if (!estVide(c.type_permis) && TYPES_PERMIS.indexOf(c.type_permis) === -1) out.push({ champ: 'la catégorie du permis', raison: 'valeur non reconnue (ex. B, C, D)' });
  return out;
}

async function preparerSessionSouscription(args, opts) {
  if (!sessionEnabled()) {
    return {
      disabled: true,
      message: "La préparation de souscription pré-remplie n'est pas activée. " +
        "En attendant, proposez le devis et le lien de souscription standard (outil devis_assurance_temporaire)."
    };
  }
  const payload = buildSessionPayload(args);
  if (!payload.conducteur || !payload.vehicule) {
    return { success: false, message: 'Fournir au moins les informations conducteur et véhicule (avec le consentement du client).' };
  }

  /* Filet de sécurité : champs clés manquants/illisibles -> on demande au client
     de confirmer/corriger AVANT de créer la session (aucune supposition). */
  const aConfirmer = champsAConfirmer(payload);
  if (aConfirmer.length) {
    const lignes = ['Avant de préparer la souscription, à confirmer ou corriger avec le client :'];
    aConfirmer.forEach(function (f) { lignes.push('• ' + f.champ + ' — ' + f.raison + '.'); });
    lignes.push('Demandez-lui de fournir ou corriger ces informations (il peut les écrire, ou renvoyer une photo plus nette du document). NE RIEN deviner ; rappeler l\'outil une fois corrigé.');
    return { success: false, besoin_confirmation: aConfirmer, message: lignes.join('\n') };
  }

  const r = await createPrefillSession(payload, opts);
  if (r.ok && r.data && r.data.success && r.data.session_url) {
    /* Phase 2bis : joindre les photos partagées (permis / carte grise) au dossier,
       pour que le client n'ait plus à les re-téléverser sur le tunnel. */
    let pieces = { transmises: [], echecs: [] };
    const aDesPhotos = FILE_FIELDS.some(function (s) { return !!args[s.arg]; });
    if (aDesPhotos && r.data.token) {
      pieces = await transmettrePieces(args, r.data.token, opts);
    } else if (aDesPhotos && !r.data.token) {
      pieces.echecs.push({ piece: 'pièces', code: 'no_token', message: 'session sans token — le client pourra déposer ses pièces sur le tunnel' });
    }

    const lignes = ['Lien de souscription pré-rempli prêt (valable ~30 min, usage unique) :', r.data.session_url];
    if (pieces.transmises.length) {
      lignes.push('Pièces déjà jointes au dossier : ' + pieces.transmises.join(', ') +
        ' — le client n\'a plus à les téléverser (il peut les remplacer sur le tunnel si besoin).');
    }
    if (pieces.echecs.length) {
      lignes.push('Pièces NON jointes :');
      pieces.echecs.forEach(function (e) { lignes.push('• ' + e.piece + ' : ' + e.message); });
      lignes.push('Si une photo est illisible, demander au client une photo plus nette peut résoudre le problème ; sinon il déposera la pièce directement sur le tunnel.');
    }
    if (!pieces.transmises.length && !pieces.echecs.length) {
      lignes.push('Le client devra téléverser ses pièces (permis, carte grise) sur le tunnel.');
    }
    lignes.push("Le client ouvre le lien, vérifie ses informations, consulte l'IPID et règle par carte. Aucune souscription ni paiement n'est effectué par l'application.");

    /* Champs pour le widget « souscription prête » (openai/outputTemplate). */
    const prof = args.profil_tarifaire || {};
    const catCode = prof.categorie_vehi || (args.vehicule && args.vehicule.genre);
    const dureeNum = prof.duree != null ? Number(prof.duree) : null;

    return {
      success: true,
      session_url: r.data.session_url,
      expires_at: r.data.expires_at || null,
      ttl_seconds: r.data.ttl_seconds || null,
      vehicule_label: (catCode && LABELS[catCode]) || null,
      duree: (dureeNum != null && !isNaN(dureeNum)) ? dureeNum : null,
      pieces_jointes: pieces.transmises,
      pieces_en_echec: pieces.echecs.length ? pieces.echecs : null,
      message: lignes.join('\n')
    };
  }
  return {
    success: false,
    message: "Impossible de préparer la session pré-remplie pour le moment. Proposez le devis + lien standard.",
    details: (r.data && (r.data.error || r.data.ref)) || r.reason || ('http_' + r.status)
  };
}

/* Schémas (objets imbriqués) */
const conducteurSchema = {
  type: 'object', additionalProperties: false,
  properties: {
    nom: { type: 'string' }, prenom: { type: 'string' },
    date_naissance: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$' },
    pays_naissance: { type: 'string', description: 'Pays de naissance en MAJUSCULES (même référentiel que pays_residence, ex. FRANCE METROPOLITAINE)' },
    adresse: { type: 'string' }, code_postal: { type: 'string' }, ville: { type: 'string' },
    pays_residence: { type: 'string' }, mobile: { type: 'string' },
    email: { type: 'string', format: 'email' },
    num_permis: { type: 'string' }, date_permis: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$' },
    pays_permis: { type: 'string', description: 'Pays du permis (nationalité du permis) en MAJUSCULES, ex. FRANCE METROPOLITAINE' },
    type_permis: { type: 'string', enum: ['B', 'C1', 'C', 'D1', 'D', 'BE', 'C1E', 'CE', 'D1E', 'DE'], description: 'Catégorie du permis (rubrique 9/12 du permis) mappée depuis la catégorie du véhicule : voiture/utilitaire -> B · poids lourd -> C1 ou C · car/bus -> D1 ou D · avec remorque -> ajouter E. Pour l\'assurance temporaire, généralement B.' }
  }
};
const vehiculeSchema = {
  type: 'object', additionalProperties: false,
  properties: {
    immatriculation: { type: 'string' }, date_premiere_mec: { type: 'string' },
    marque: { type: 'string' }, modele: { type: 'string' },
    genre: { type: 'string', enum: CATEGORIES, description: 'Mêmes valeurs que le tarificateur (VL-VL, VL-VU, …)' },
    puissance_fiscale: { type: 'integer', description: 'Puissance fiscale en CV (carte grise P.6)' },
    ptac_kg: { type: 'integer' }, places: { type: 'integer' },
    chassis: { type: 'string' }, pays_immatriculation: { type: 'string' }
  }
};
const profilSchema = {
  type: 'object', additionalProperties: false,
  description: 'Champs de tarif. Si omis, déduits des blocs conducteur/véhicule.',
  properties: {
    categorie_vehi: { type: 'string', enum: CATEGORIES },
    age_vehicule: { type: 'string', enum: ['moins10', 'plus10'] },
    puissance: { type: 'string', enum: ['inf30', 'sup30', '0'] },
    pays_immatriculation: { type: 'string' },
    pays_residence: { type: 'string' },
    date_naissance: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$' },
    duree: { type: 'string' }, date_debut: { type: 'string' }, heure_debut: { type: 'string' }
  }
};

/* Référence de fichier fournie par ChatGPT pour chaque photo (openai/fileParams). */
const fichierSchema = {
  type: 'object', additionalProperties: true,
  properties: {
    file_id: { type: 'string' },
    download_url: { type: 'string' },
    mime_type: { type: 'string' },
    file_name: { type: 'string' }
  }
};

const prefillTool = {
  name: 'preparer_session_souscription',
  title: 'Préparer la souscription pré-remplie',
  description: "NIVEAU 2 (souscription facilitée) — prépare une souscription avec les pages conducteur " +
    "et véhicule DÉJÀ pré-remplies ET les pièces jointes au dossier, et renvoie un lien sécurisé " +
    "(session_url, valable 30 min). À utiliser quand le client veut SOUSCRIRE / gagner du temps. " +
    "Recueillir les infos en proposant d'envoyer une photo de la CARTE GRISE (véhicule : genre, marque D.1, " +
    "modèle D.3, immatriculation, châssis E, P.6, F.2, date 1re MEC) ET du PERMIS (conducteur : nom, prénom, " +
    "date de naissance, n° et date de permis, type_permis = catégorie du permis selon le véhicule " +
    "(voiture/utilitaire=B, poids lourd=C1/C, car/bus=D1/D), pays). Champs pays en MAJUSCULES ; " +
    "pays_permis = nationalité du permis. TOUJOURS inclure conducteur.nom et conducteur.prenom " +
    "(rattachement des pièces au dossier). " +
    "PIÈCES : passer les photos partagées via photo_permis / photo_carte_grise (+ _verso si fournis) — " +
    "elles seront jointes automatiquement au dossier, le client n'aura pas à les re-téléverser. " +
    "DIALOGUE DE CORRECTION — après lecture des documents, si un champ est illisible, manquant, " +
    "ambigu ou que tu n'es PAS SÛR de l'avoir bien lu, NE DEVINE PAS : liste ces champs au client et " +
    "demande-lui de les CONFIRMER ou de les CORRIGER (par écrit, ou en renvoyant une photo plus nette). " +
    "AVANT d'appeler : RÉCAPITULER au client TOUTES les informations collectées (véhicule + conducteur), en " +
    "signalant explicitement les champs incertains, et obtenir sa CONFIRMATION. " +
    "Si l'outil répond avec besoin_confirmation, transmets ces champs au client, recueille les corrections, " +
    "puis rappelle l'outil avec les valeurs confirmées. " +
    "⚠️ DONNÉES PERSONNELLES : n'appeler qu'APRÈS (1) le CONSENTEMENT EXPLICITE du client et (2) la collecte + confirmation des infos. " +
    "Minimisation : ne transmettre que les champs réellement fournis. " +
    "Si pieces_en_echec contient une pièce illisible, proposer au client de renvoyer une photo nette " +
    "(sinon il déposera la pièce sur le tunnel). " +
    "La souscription, l'IPID et le paiement restent réalisés par le client sur le tunnel.",
  inputSchema: {
    type: 'object', additionalProperties: false,
    properties: {
      conducteur: conducteurSchema, vehicule: vehiculeSchema, profil_tarifaire: profilSchema,
      photo_permis: fichierSchema, photo_permis_verso: fichierSchema,
      photo_carte_grise: fichierSchema, photo_carte_grise_verso: fichierSchema
    }
  },
  outputSchema: {
    type: 'object', additionalProperties: true,
    properties: {
      success: { type: 'boolean' }, disabled: { type: 'boolean' },
      besoin_confirmation: { type: ['array', 'null'], items: { type: 'object' } },
      session_url: { type: 'string' }, expires_at: { type: 'string' },
      ttl_seconds: { type: 'integer' },
      vehicule_label: { type: ['string', 'null'] }, duree: { type: ['integer', 'null'] },
      pieces_jointes: { type: 'array', items: { type: 'string' } },
      pieces_en_echec: { type: ['array', 'null'], items: { type: 'object' } },
      message: { type: 'string' }
    }
  },
  annotations: { readOnlyHint: false, openWorldHint: false, destructiveHint: false },
  _meta: {
    'openai/fileParams': ['photo_permis', 'photo_permis_verso', 'photo_carte_grise', 'photo_carte_grise_verso'],
    'openai/outputTemplate': SOUSCRIPTION_URI
  },
  handler: preparerSessionSouscription
};

module.exports = {
  sessionEnabled, buildSessionPayload, preparerSessionSouscription, prefillTool,
  transmettrePieces, champsAConfirmer, FILE_FIELDS,
  CONDUCTEUR_KEYS, VEHICULE_KEYS, PROFIL_KEYS
};
