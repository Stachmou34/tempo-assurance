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
