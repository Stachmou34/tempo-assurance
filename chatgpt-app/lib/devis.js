'use strict';
/* Logique métier de l'app ChatGPT Tempo-Assurance.
   - construit le lien de devis pré-rempli (même liste blanche que assets/site.js)
   - calcule un tarif indicatif depuis la grille (MVP-light)
   Aucune souscription / aucun paiement ici : l'app prépare, le client finalise
   sur le tarificateur jlassure (conformité DDA/ACPR). */

const { LABELS, CATEGORIES, gridFor } = require('./tarifs');

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

function euro(n) { return n.toFixed(2).replace('.', ',') + ' €'; }

/* Outil 1 : prépare un devis (tarif indicatif + lien pré-rempli) */
function devisAssuranceTemporaire(params) {
  params = params || {};
  const cat = params.categorie_vehi;
  if (cat && !LABELS[cat]) {
    return { error: 'categorie_vehi inconnue : ' + cat, categories_valides: CATEGORIES };
  }
  const url = buildDevisUrl(params);
  const grid = cat ? gridFor(cat, params.puissance) : null;

  let tarif = null;
  let durees_disponibles = null;
  if (grid) {
    durees_disponibles = Object.keys(grid).map(Number).sort(function (a, b) { return a - b; });
    const d = params.duree != null ? Number(params.duree) : null;
    if (d != null && grid[d] != null) tarif = { duree: d, prix_indicatif: euro(grid[d]) };
  }

  const lignes = [];
  lignes.push('Assurance temporaire' + (cat ? ' — ' + LABELS[cat] : '') + ' sur Tempo-Assurance.');
  if (tarif) {
    lignes.push('Tarif indicatif : ' + tarif.prix_indicatif + ' pour ' + tarif.duree + ' jour(s) (RC + Défense et Recours, frais inclus).');
  } else if (durees_disponibles) {
    lignes.push('Durées disponibles (jours) : ' + durees_disponibles.join(', ') + '. Précisez "duree" pour un tarif.');
  }
  lignes.push('Surprime légère (~5 €) pour les conducteurs de 21-22 ans.');
  lignes.push('Finaliser le devis pré-rempli : ' + url);
  lignes.push('Le client vérifie les informations, consulte l\'IPID, confirme et règle par carte sur le tarificateur — aucune souscription n\'est finalisée par l\'application.');

  return {
    categorie: cat ? LABELS[cat] : null,
    tarif_indicatif: tarif,
    durees_disponibles: durees_disponibles,
    lien_devis_pre_rempli: url,
    note_conformite: 'Tarif indicatif. Prix exact et souscription sur le tarificateur jlassure (paiement CB par le client).',
    message: lignes.join('\n')
  };
}

/* Outil 2 : grille de tarifs pour une catégorie */
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
