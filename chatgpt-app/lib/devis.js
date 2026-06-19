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

/* Liste blanche identique à celle relayée par assets/site.js vers l'iframe */
const PREFILL_KEYS = ['categorie_vehi', 'age_vehicule', 'puissance', 'ptac',
  'pays_immatriculation', 'pays_residence', 'date_naissance',
  'motif_assurance_temporaire', 'motif_assurance_temporaire_autre',
  'duree', 'date_debut', 'heure_debut'];

function buildDevisUrl(params) {
  const out = [];
  PREFILL_KEYS.forEach(function (k) {
    const v = params[k];
    if (v === undefined || v === null || v === '') return;
    out.push(k + '=' + encodeURIComponent(String(v)));
  });
  return out.length ? DEVIS_URL + '?' + out.join('&') : DEVIS_URL;
}

function euro(n) { return Number(n).toFixed(2).replace('.', ',') + ' €'; }

/* Conversion des champs BRUTS d'une carte grise (lus par OCR côté ChatGPT) vers
   nos valeurs de tarif. Déterministe côté serveur → pas d'erreur de mapping.
   Genre (J.1) -> categorie_vehi ; P.6 (CV) -> puissance ; F.2 (kg) -> ptac ;
   date 1re mise en circulation -> age_vehicule. */
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
  if ((p.ptac === undefined || p.ptac === null || p.ptac === '') && p.ptac_kg != null) {
    const kg = Number(p.ptac_kg);
    if (!isNaN(kg)) { p.ptac = kg <= 3500 ? 'inf3500' : 'sup3500'; deduits.push('PTAC'); }
  }
  if (p.categorie_vehi === 'CC-Cap' && p.ptac === 'sup3500') { p.categorie_vehi = 'CAM-Fou'; }
  if ((p.age_vehicule === undefined || p.age_vehicule === null || p.age_vehicule === '') && p.date_mise_circulation) {
    const y = parseYear(p.date_mise_circulation);
    if (y) { p.age_vehicule = (new Date().getFullYear() - y) < 10 ? 'moins10' : 'plus10'; deduits.push('âge du véhicule'); }
  }
  return { params: p, deduits: deduits };
}

/* Pour obtenir un tarif RÉEL, l'API jlassure exige age_vehicule + puissance.
   Si le modèle ne les a pas fournis, on suppose des valeurs courantes (voiture
   ≤30 CV, véhicule <10 ans ; remorque/caravane = pas de puissance) et on le
   signale. Ces hypothèses ne sont PAS imposées dans le lien de devis. */
function withDefaults(params) {
  const p = Object.assign({}, params);
  const assumed = [];
  const remorque = (p.categorie_vehi === 'REM-REM2' || p.categorie_vehi === 'REM-REM3');
  if (p.puissance === undefined || p.puissance === null || p.puissance === '') {
    if (remorque) { p.puissance = '0'; }
    else { p.puissance = 'inf30'; assumed.push('≤ 30 CV'); }
  }
  if (p.age_vehicule === undefined || p.age_vehicule === null || p.age_vehicule === '') {
    p.age_vehicule = 'moins10'; assumed.push('véhicule de moins de 10 ans');
  }
  return { params: p, assumed: assumed };
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

  /* 1) Tentative tarif RÉEL via l'API jlassure (avec valeurs par défaut) */
  const withDef = withDefaults(params);
  const api = await fetchTarif(withDef.params, opts);
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
      lignes.push('Durées disponibles (jours) : ' + data.durees.join(', ') + '. Précisez "duree" pour un tarif.');
    }
    if (norm.deduits.length) {
      lignes.push('Lu sur la carte grise : ' + norm.deduits.join(', ') + '.');
    }
    if (withDef.assumed.length) {
      lignes.push('Hypothèses : ' + withDef.assumed.join(', ') + ' (précisez pour ajuster).');
    }
    lignes.push('Finaliser la souscription (devis pré-rempli) : ' + url);
    lignes.push('Le client vérifie, consulte l\'IPID, confirme et règle par carte sur le tarificateur — aucune souscription n\'est finalisée par l\'application.');
    return {
      source: 'jlassure_api',
      categorie: cat ? LABELS[cat] : null,
      tarif: (data.prix_vente != null && d != null) ? { duree: d, prix_vente: euro(data.prix_vente), prix_reel: true } : null,
      durees_disponibles: data.durees || null,
      hypotheses: withDef.assumed.length ? withDef.assumed : null,
      lien_devis_pre_rempli: url,
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
