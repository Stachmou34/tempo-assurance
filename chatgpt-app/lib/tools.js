'use strict';
/* Déclaration des outils MCP exposés à ChatGPT (Apps SDK = MCP).
   Schémas alignés sur la spec de pré-remplissage jlassure / WebMCP du site. */

const { devisAssuranceTemporaire, tarifsParCategorie } = require('./devis');
const { CATEGORIES } = require('./tarifs');

const profilProps = {
  categorie_vehi: { type: 'string', enum: CATEGORIES, description: 'Catégorie de véhicule (ex. VL-VL voiture, CAM-CAM3 camion, REM-REM2 remorque…)' },
  age_vehicule: { type: 'string', enum: ['moins10', 'plus10'], description: 'Âge du véhicule' },
  puissance: { type: 'string', enum: ['inf30', 'sup30', '0'], description: 'inf30 (≤30 CV) · sup30 (>30 CV) · 0 (remorque/caravane)' },
  ptac: { type: 'string', enum: ['inf3500', 'sup3500'], description: 'PTAC selon la catégorie' },
  pays_immatriculation: { type: 'string', description: "Pays d'immatriculation en MAJUSCULES (ex. FRANCE METROPOLITAINE)" },
  pays_residence: { type: 'string', description: 'Pays de résidence du conducteur, en MAJUSCULES' },
  date_naissance: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$', description: 'AAAA-MM-JJ (conducteur 21 à 90 ans)' },
  duree: { type: 'integer', minimum: 1, maximum: 90, description: 'Durée en jours (1 à 90)' },
  date_debut: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$', description: "Date de début AAAA-MM-JJ (≥ aujourd'hui)" },
  heure_debut: { type: 'string', pattern: '^\\d{2}:\\d{2}$', description: 'Heure de début HH:MM' },
  motif_assurance_temporaire: { type: 'string', enum: ['achat_vente', 'resilie_non_paiement', 'sortie_fourriere', 'autre'], description: 'Motif du besoin' },
  motif_assurance_temporaire_autre: { type: 'string', maxLength: 255, description: 'Texte libre si motif=autre' }
};

const TOOLS = [
  {
    name: 'devis_assurance_temporaire',
    description: "Prépare un devis d'assurance auto temporaire (1 à 90 jours) sur Tempo-Assurance : " +
      'renvoie un tarif indicatif et un lien de devis pré-rempli. La souscription et le paiement ' +
      'se font ensuite sur le tarificateur (le client finalise lui-même).',
    inputSchema: { type: 'object', additionalProperties: false, properties: profilProps },
    handler: devisAssuranceTemporaire
  },
  {
    name: 'tarifs_par_categorie',
    description: "Donne la grille de tarifs indicatifs (par durée) pour une catégorie de véhicule.",
    inputSchema: {
      type: 'object', additionalProperties: false,
      required: ['categorie_vehi'],
      properties: {
        categorie_vehi: profilProps.categorie_vehi,
        puissance: profilProps.puissance
      }
    },
    handler: tarifsParCategorie
  }
];

module.exports = { TOOLS };
