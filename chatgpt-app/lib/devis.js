'use strict';
/* Logique métier de l'app ChatGPT Tempo-Assurance.
   - tarif RÉEL via l'API jlassure si la clé est configurée (JLASSURE_API_KEY)
   - sinon REPLI sur la grille indicative (MVP-light) — robustesse
   - construit/renvoie le lien de devis pré-rempli
   Aucune souscription / aucun paiement ici : l'app prépare, le client finalise
   sur le tarificateur jlassure (conformité DDA/ACPR). */

const { LABELS, CATEGORIES, gridFor } = require('./tarifs');
const { fetchTarif } = require('./jlassureApi');

const DEVIS_URL = 'https://www.tempo-assurance.com/devis-ou-souscription.html';

/* Liste blanche identique à celle relayée par assets/site.js vers l'iframe.
   PTAC retiré : le tunnel le calcule automatiquement depuis categorie_vehi.
   Motif retiré : supprimé du tunnel. (Anciens liens : paramètres ignorés sans erreur.) */
/* date_debut / heure_debut retirés : le tarificateur JL Assure renvoie une 500
   quand date_debut est passé en GET (bug serveur, mb.php ET mb43.php). Le client
   choisit la date dans le tunnel. Réactiver après correctif JL Assure. */
const PREFILL_KEYS = ['categorie_vehi', 'age_vehicule', 'puissance',
  'pays_immatriculation', 'pays_residence', 'date_naissance', 'duree'];

function buildDevisUrl(params) {
  const p = Object.assign({}, params);
  /* Compléter les champs nécessaires pour qu'un tarif s'affiche au clic sur le lien :
     - date_naissance déduite de age_conducteur si absente
     - date_debut = aujourd'hui (Europe/Paris) si absente
     - heure_debut = maintenant + 15 min si absente */
  if ((p.date_naissance === undefined || p.date_naissance === null || p.date_naissance === '') && p.age_conducteur != null) {
    const age = Number(p.age_conducteur);
    if (!isNaN(age) && age >= 18 && age <= 99) {
      const t = parisParts(0);
      p.date_naissance = (Number(t.year) - age) + '-' + t.month + '-' + t.day;
    }
  }
  /* date_debut / heure_debut NON pré-remplis : ils déclenchent une 500 côté
     tarificateur JL Assure (bug serveur). Le client saisit la date dans le tunnel. */
  const out = [];
  PREFILL_KEYS.forEach(function (k) {
    const v = p[k];
    if (v === undefined || v === null || v === '') return;
    out.push(k + '=' + encodeURIComponent(String(v)));
  });
  return out.length ? DEVIS_URL + '?' + out.join('&') : DEVIS_URL;
}

/* Date/heure courantes en Europe/Paris (décalage en ms optionnel). */
function parisParts(offsetMs) {
  const d = new Date(Date.now() + (offsetMs || 0));
  const parts = {};
  new Intl.DateTimeFormat('en-GB', {
    timeZone: 'Europe/Paris', year: 'numeric', month: '2-digit', day: '2-digit',
    hour: '2-digit', minute: '2-digit', hour12: false
  }).formatToParts(d).forEach(function (x) { parts[x.type] = x.value; });
  return parts;
}

function euro(n) { return Number(n).toFixed(2).replace('.', ',') + ' €'; }

/* Sous-ensemble de paramètres permettant au widget de re-tarifer une autre durée
   (clic sur une pastille) via window.openai.callTool. */
const ECHO_KEYS = ['categorie_vehi', 'age_vehicule', 'puissance',
  'pays_immatriculation', 'pays_residence', 'date_naissance', 'age_conducteur', 'duree'];
function echoArgs(p) {
  const o = {};
  ECHO_KEYS.forEach(function (k) {
    if (p[k] !== undefined && p[k] !== null && p[k] !== '') o[k] = p[k];
  });
  return o;
}

/* Conversion des champs BRUTS d'une carte grise (lus par OCR côté ChatGPT) vers
   nos valeurs de tarif. Déterministe côté serveur → pas d'erreur de mapping.
   Genre (J.1) -> categorie_vehi ; P.6 (CV) -> puissance ; F.2 (kg) -> camping-car
   ≤/> 3,5 t (CC-Cap vs CAM-Fou) ; date 1re mise en circulation -> age_vehicule. */
const GENRE_MAP = {
  'VP': 'VL-VL', 'CTTE': 'VL-VU', 'CAM': 'CAM-CAM3', 'TRR': 'REM-REM2',
  'REM': 'REM-REM2', 'RESP': 'REM-REM2', 'SREM': 'REM-REM2', 'CARAVANE': 'REM-REM3',
  'TCP': 'TCP-TCP', 'TRA': 'TRA-TRA', 'QM': 'QM-QM', 'VASP': 'CC-Cap'
};
function parseYear(s) { const m = String(s).match(/(\d{4})/); return m ? Number(m[1]) : null; }

function normalizeFromCarteGrise(params) {
  const p = Object.assign({}, params);
  const deduits = [];
  if (!p.categorie_vehi && p.genre_carte_grise) {
    const g = String(p.genre_carte_grise).toUpperCase().trim();
    if (GENRE_MAP[g]) { p.categorie_vehi = GENRE_MAP[g]; deduits.push('catégorie'); }
  }
  if ((p.puissance === undefined || p.puissance === null || p.puissance === '') && p.puissance_cv != null) {
    const cv = Number(p.puissance_cv);
    if (!isNaN(cv)) { p.puissance = cv <= 30 ? 'inf30' : 'sup30'; deduits.push('puissance'); }
  }
  /* PTAC n'est plus transmis (calculé auto par le tunnel depuis categorie_vehi).
     ptac_kg ne sert plus qu'à distinguer le camping-car ≤ 3,5 t (CC-Cap) du
     camping-car > 3,5 t (CAM-Fou), tous deux de genre VASP sur la carte grise. */
  if (p.categorie_vehi === 'CC-Cap' && p.ptac_kg != null) {
    const kg = Number(p.ptac_kg);
    if (!isNaN(kg) && kg > 3500) { p.categorie_vehi = 'CAM-Fou'; deduits.push('camping-car > 3,5 t'); }
  }
  delete p.ptac;
  if ((p.age_vehicule === undefined || p.age_vehicule === null || p.age_vehicule === '') && p.date_mise_circulation) {
    const y = parseYear(p.date_mise_circulation);
    if (y) { p.age_vehicule = (new Date().getFullYear() - y) < 10 ? 'moins10' : 'plus10'; deduits.push('âge du véhicule'); }
  }
  return { params: p, deduits: deduits };
}

function empty(v) { return v === undefined || v === null || v === ''; }

/* AUCUNE hypothèse : on liste les champs de tarif manquants pour que l'IA les
   DEMANDE (au lieu de supposer une valeur). Remorque/caravane : puissance = 0
   (fait, pas une hypothèse). */
function missingTarifFields(p) {
  const miss = [];
  if (empty(p.categorie_vehi)) miss.push('le type de véhicule');
  const remorque = (p.categorie_vehi === 'REM-REM2' || p.categorie_vehi === 'REM-REM3');
  if (!remorque && empty(p.puissance)) miss.push('la puissance fiscale (≤ 30 CV ou > 30 CV — sur la carte grise, champ P.6)');
  if (empty(p.age_vehicule)) miss.push("l'âge du véhicule (moins ou plus de 10 ans)");
  if (empty(p.pays_immatriculation)) miss.push("le pays d'immatriculation");
  if (empty(p.pays_residence)) miss.push('le pays de résidence du conducteur');
  if (empty(p.date_naissance) && p.age_conducteur == null) miss.push("l'âge ou la date de naissance du conducteur");
  return miss;
}

/* Outil 1 : prépare un devis (tarif réel via API si possible, sinon indicatif). */
async function devisAssuranceTemporaire(params, opts) {
  params = params || {};
  const norm = normalizeFromCarteGrise(params); /* champs carte grise -> valeurs de tarif */
  params = norm.params;
  const cat = params.categorie_vehi;
  if (cat && !LABELS[cat]) {
    return { error: 'categorie_vehi inconnue : ' + cat, categories_valides: CATEGORIES };
  }
  /* Remorque / caravane : pas de puissance (fait, pas une hypothèse) */
  if ((cat === 'REM-REM2' || cat === 'REM-REM3') && empty(params.puissance)) params.puissance = '0';

  /* AUCUNE hypothèse : si des champs de tarif manquent, on les fait demander par l'IA. */
  const miss = missingTarifFields(params);
  if (miss.length) {
    const lignes = ['Pour calculer le tarif, il me manque :'];
    miss.forEach(function (m) { lignes.push('• ' + m); });
    lignes.push("Pouvez-vous me préciser ces éléments ? (Pour la puissance/le PTAC, vous pouvez aussi m'envoyer une photo de la carte grise.)");
    return {
      source: 'incomplet',
      besoin_infos: miss,
      categorie: cat ? LABELS[cat] : null,
      deduits_carte_grise: norm.deduits.length ? norm.deduits : null,
      message: lignes.join('\n')
    };
  }

  /* 1) Tarif RÉEL via l'API jlassure (sans aucune valeur supposée) */
  const api = await fetchTarif(params, opts);
  if (api.ok && api.data) {
    const data = api.data;
    if (data.hors_perimetre) {
      return {
        source: 'jlassure_api',
        hors_perimetre: true,
        message: 'Ce profil n\'est pas tarifiable en ligne (hors périmètre). Contactez-nous au 09 78 31 02 93.'
      };
    }
    const url = buildDevisUrl(params);
    const d = params.duree != null ? Number(params.duree) : null;
    const lignes = [];
    lignes.push('Assurance temporaire' + (cat ? ' — ' + LABELS[cat] : '') + ' sur Tempo-Assurance.');
    if (data.prix_vente != null && d != null) {
      lignes.push('Tarif : ' + euro(data.prix_vente) + ' pour ' + d + ' jour(s) (prix réel, RC + Défense et Recours, frais inclus).');
    } else if (Array.isArray(data.durees)) {
      lignes.push('Durées disponibles (jours) : ' + data.durees.join(', ') + '. Précisez la durée pour un tarif.');
    }
    if (norm.deduits.length) {
      lignes.push('Lu sur la carte grise : ' + norm.deduits.join(', ') + '.');
    }
    lignes.push('Finaliser la souscription (devis pré-rempli) : ' + url);
    lignes.push('Le client vérifie, consulte l\'IPID, confirme et règle par carte sur le tarificateur — aucune souscription n\'est finalisée par l\'application.');
    return {
      source: 'jlassure_api',
      categorie: cat ? LABELS[cat] : null,
      tarif: (data.prix_vente != null && d != null) ? { duree: d, prix_vente: euro(data.prix_vente), prix_reel: true } : null,
      durees_disponibles: data.durees || null,
      lien_devis_pre_rempli: url,
      echo_args: echoArgs(params),
      message: lignes.join('\n')
    };
  }

  /* 2) REPLI : grille indicative (clé absente, API indispo, etc.) */
  const url = buildDevisUrl(params);
  const grid = cat ? gridFor(cat, params.puissance) : null;
  let tarif = null, durees = null;
  if (grid) {
    durees = Object.keys(grid).map(Number).sort(function (a, b) { return a - b; });
    const d = params.duree != null ? Number(params.duree) : null;
    if (d != null && grid[d] != null) tarif = { duree: d, prix_indicatif: euro(grid[d]) };
  }
  const lignes = [];
  lignes.push('Assurance temporaire' + (cat ? ' — ' + LABELS[cat] : '') + ' sur Tempo-Assurance.');
  if (tarif) {
    lignes.push('Tarif indicatif : ' + tarif.prix_indicatif + ' pour ' + tarif.duree + ' jour(s) (RC + Défense et Recours, frais inclus).');
  } else if (durees) {
    lignes.push('Durées disponibles (jours) : ' + durees.join(', ') + '. Précisez "duree" pour un tarif.');
  }
  lignes.push('Surprime légère (~5 €) pour les conducteurs de 21-22 ans.');
  lignes.push('Finaliser le devis pré-rempli : ' + url);
  lignes.push('Le client vérifie, consulte l\'IPID, confirme et règle par carte — aucune souscription n\'est finalisée par l\'application.');
  return {
    source: 'indicatif',
    categorie: cat ? LABELS[cat] : null,
    tarif_indicatif: tarif,
    durees_disponibles: durees,
    lien_devis_pre_rempli: url,
    echo_args: echoArgs(params),
    note_conformite: 'Tarif indicatif (le prix exact est confirmé au devis sur le tarificateur).',
    message: lignes.join('\n')
  };
}

/* Outil 2 : grille de tarifs indicatifs pour une catégorie */
function tarifsParCategorie(params) {
  params = params || {};
  const cat = params.categorie_vehi;
  if (!cat || !LABELS[cat]) {
    return { error: 'Fournir une categorie_vehi valide.', categories_valides: CATEGORIES };
  }
  const grid = gridFor(cat, params.puissance);
  const table = Object.keys(grid).map(Number).sort(function (a, b) { return a - b; })
    .map(function (d) { return { duree: d, prix_indicatif: euro(grid[d]) }; });
  return {
    categorie: LABELS[cat],
    puissance: params.puissance || 'inf30 (par défaut)',
    grille: table,
    message: LABELS[cat] + ' — tarifs indicatifs : ' +
      table.map(function (r) { return r.duree + 'j ' + r.prix_indicatif; }).join(' · ')
  };
}

module.exports = {
  DEVIS_URL, PREFILL_KEYS, buildDevisUrl,
  devisAssuranceTemporaire, tarifsParCategorie
};
