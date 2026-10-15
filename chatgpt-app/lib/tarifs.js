'use strict';
/* Grille de tarifs indicatifs Tempo-Assurance (TTC, RC + Défense et Recours,
   conducteur 23 ans et plus, frais de courtage inclus). Source : llms.txt.
   MVP-light : prix indicatif. La V2 remplacera ce module par l'API jlassure
   (voir docs/note-jlassure-api-tarif.md). */

/* Grilles prix par durée (jours -> € TTC) */
const G = {
  vl_inf30: { 1: 50.74, 2: 66.26, 3: 68.58, 5: 74.44, 7: 83.58, 10: 94.88, 15: 107.82, 20: 126.11, 30: 189.15, 45: 233.27, 60: 278.23, 90: 402.66 },
  vl_sup30: { 1: 61.43, 7: 115.84, 15: 144.52, 30: 213.89, 60: 345.19, 90: 486.49 },
  cc_light: { 1: 63.49, 7: 93.58, 15: 117.82, 30: 199.15, 60: 300.19, 90: 423.20 },
  cc_heavy: { 1: 92.56, 3: 112.98, 5: 119.15, 8: 135.61, 15: 159.37 },
  poids_lourd: { 1: 92.56, 3: 112.98, 5: 119.15, 8: 135.61, 15: 159.37 },
  bus: { 1: 92.55, 3: 112.99, 5: 119.16, 8: 143.10, 15: 159.37 },
  remorque: { 1: 57.67, 3: 67.76, 5: 86.93, 8: 95.74, 15: 120.47 },
  voiturette: { 10: 102.34, 15: 116.93, 20: 132.98, 30: 181.72 }
};

/* Libellés des catégories (valeurs categorie_vehi) */
const LABELS = {
  'VL-VL': 'Voiture (VP)',
  'VL-VU': 'Utilitaire / fourgon (CTTE)',
  'QM-QM': 'Quad',
  'VSP-VSP': 'Voiturette sans permis',
  'QMQLEM-QMQLEM': 'Buggy sans permis',
  'CC-Cap': 'Camping-car (≤ 3,5 t)',
  'CAM-Fou': 'Camping-car (> 3,5 t)',
  'CAM-CAM3': 'Camion / poids lourd (> 3,5 t)',
  'TRA-TRA': 'Tracteur agricole',
  'TCP-TCP': 'Bus / car / autocar',
  'REM-REM2': 'Remorque / semi-remorque',
  'REM-REM3': 'Caravane'
};

/* Sélectionne la grille selon la catégorie (et la puissance pour VL/VU/quad) */
function gridFor(categorie_vehi, puissance) {
  switch (categorie_vehi) {
    case 'VL-VL':
    case 'VL-VU':
    case 'QM-QM':
      return puissance === 'sup30' ? G.vl_sup30 : G.vl_inf30;
    case 'VSP-VSP':
    case 'QMQLEM-QMQLEM':
      return G.voiturette;
    case 'CC-Cap': return G.cc_light;
    case 'CAM-Fou': return G.cc_heavy;
    case 'CAM-CAM3':
    case 'TRA-TRA':
      return G.poids_lourd;
    case 'TCP-TCP': return G.bus;
    case 'REM-REM2':
    case 'REM-REM3':
      return G.remorque;
    default: return null;
  }
}

const CATEGORIES = Object.keys(LABELS);

module.exports = { G, LABELS, CATEGORIES, gridFor };
