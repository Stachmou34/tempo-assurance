'use strict';
/* Phase 2 — préparation de souscription pré-remplie (données personnelles).
   Appelle l'API prefill sécurisée de jlassure et renvoie une session_url
   (jeton usage unique, 30 min, AUCUNE donnée perso dans l'URL).

   ⚠️ Données personnelles : OUTIL DÉSACTIVÉ par défaut. Activer via la variable
   d'environnement ENABLE_PREFILL_SESSION=1 UNIQUEMENT après validation RGPD
   (consentement client, registre des traitements). Voir docs/rgpd-checklist-ocr.md.
   L'outil ne fait que PRÉPARER : le client ouvre l'URL, vérifie, consulte l'IPID,
   téléverse ses pièces et paie sur le tunnel (DDA/ACPR). */

const { createPrefillSession } = require('./jlassureApi');
const { CATEGORIES } = require('./tarifs');

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
const PROFIL_KEYS = ['categorie_vehi', 'age_vehicule', 'puissance', 'ptac',
  'pays_immatriculation', 'pays_residence', 'date_naissance',
  'motif_assurance_temporaire', 'motif_assurance_temporaire_autre',
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
  if (!prof.ptac && v.ptac_kg != null) {
    const kg = Number(v.ptac_kg);
    if (!isNaN(kg)) prof.ptac = kg <= 3500 ? 'inf3500' : 'sup3500';
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
  const r = await createPrefillSession(payload, opts);
  if (r.ok && r.data && r.data.success && r.data.session_url) {
    return {
      success: true,
      session_url: r.data.session_url,
      expires_at: r.data.expires_at || null,
      ttl_seconds: r.data.ttl_seconds || null,
      message: 'Lien de souscription pré-rempli prêt (valable ~30 min, usage unique) :\n' +
        r.data.session_url + '\n' +
        "Le client ouvre ce lien, vérifie ses informations, consulte l'IPID, téléverse ses pièces " +
        "(permis, carte grise) et règle par carte. Aucune souscription ni paiement n'est effectué par l'application."
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
    type_permis: { type: 'string', description: 'Code court : B (voiture), C/C1 (poids lourd), D/D1 (car/bus)' }
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
    ptac: { type: 'string', enum: ['inf3500', 'sup3500'] },
    pays_immatriculation: { type: 'string' },
    pays_residence: { type: 'string' },
    date_naissance: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$' },
    motif_assurance_temporaire: { type: 'string', enum: ['achat_vente', 'resilie_non_paiement', 'sortie_fourriere', 'autre'] },
    duree: { type: 'string' }, date_debut: { type: 'string' }, heure_debut: { type: 'string' }
  }
};

const prefillTool = {
  name: 'preparer_session_souscription',
  title: 'Préparer la souscription pré-remplie',
  description: "NIVEAU 2 (souscription facilitée) — prépare une souscription avec les pages conducteur " +
    "et véhicule DÉJÀ pré-remplies, et renvoie un lien sécurisé (session_url, valable 30 min). " +
    "À utiliser quand le client veut SOUSCRIRE / gagner du temps. " +
    "Recueillir les infos en proposant d'envoyer une photo de la CARTE GRISE (véhicule : genre, marque D.1, " +
    "modèle D.3, immatriculation, châssis E, P.6, F.2, date 1re MEC) ET du PERMIS (conducteur : nom, prénom, " +
    "date de naissance, n° et date de permis, catégorie→type_permis, pays). Champs pays en MAJUSCULES ; " +
    "pays_permis = nationalité du permis. " +
    "Si un champ est illisible ou si le document n'est pas le bon, demander une photo nette (ne pas deviner). " +
    "⚠️ DONNÉES PERSONNELLES : n'appeler qu'APRÈS (1) le CONSENTEMENT EXPLICITE du client et (2) la collecte des infos. " +
    "Minimisation : ne transmettre que les champs réellement fournis. " +
    "Rappel au client : il devra quand même téléverser les pièces (permis, carte grise) sur le tunnel. " +
    "La souscription, l'IPID et le paiement restent réalisés par le client sur le tunnel.",
  inputSchema: {
    type: 'object', additionalProperties: false,
    properties: { conducteur: conducteurSchema, vehicule: vehiculeSchema, profil_tarifaire: profilSchema }
  },
  outputSchema: {
    type: 'object', additionalProperties: true,
    properties: {
      success: { type: 'boolean' }, disabled: { type: 'boolean' },
      session_url: { type: 'string' }, expires_at: { type: 'string' },
      ttl_seconds: { type: 'integer' }, message: { type: 'string' }
    }
  },
  annotations: { readOnlyHint: false, openWorldHint: false, destructiveHint: false },
  handler: preparerSessionSouscription
};

module.exports = {
  sessionEnabled, buildSessionPayload, preparerSessionSouscription, prefillTool,
  CONDUCTEUR_KEYS, VEHICULE_KEYS, PROFIL_KEYS
};
