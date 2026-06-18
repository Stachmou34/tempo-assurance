'use strict';
/* Déclaration des outils MCP exposés à ChatGPT (Apps SDK = MCP).
   Schémas alignés sur la spec de pré-remplissage jlassure / WebMCP du site. */

const { devisAssuranceTemporaire, tarifsParCategorie } = require('./devis');
const { CATEGORIES } = require('./tarifs');
const { WIDGET_URI } = require('./resources');

const profilProps = {
  categorie_vehi: { type: 'string', enum: CATEGORIES, description: 'Catégorie de véhicule (ex. VL-VL voiture, CAM-CAM3 camion, REM-REM2 remorque…)' },
  age_vehicule: { type: 'string', enum: ['moins10', 'plus10'], description: 'Âge du véhicule' },
  puissance: { type: 'string', enum: ['inf30', 'sup30', '0'], description: 'inf30 (≤30 CV) · sup30 (>30 CV) · 0 (remorque/caravane)' },
  ptac: { type: 'string', enum: ['inf3500', 'sup3500'], description: 'PTAC selon la catégorie' },
  pays_immatriculation: { type: 'string', description: "Pays d'immatriculation en MAJUSCULES (ex. FRANCE METROPOLITAINE)" },
  pays_residence: { type: 'string', description: 'Pays de résidence du conducteur, en MAJUSCULES' },
  date_naissance: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$', description: 'AAAA-MM-JJ (conducteur 21 à 90 ans)' },
  age_conducteur: { type: 'integer', minimum: 21, maximum: 90, description: "Âge du conducteur (alternative à date_naissance pour l'API tarif)" },
  duree: { type: 'integer', minimum: 1, maximum: 90, description: 'Durée en jours (1 à 90)' },
  date_debut: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$', description: "Date de début AAAA-MM-JJ (≥ aujourd'hui)" },
  heure_debut: { type: 'string', pattern: '^\\d{2}:\\d{2}$', description: 'Heure de début HH:MM' },
  motif_assurance_temporaire: { type: 'string', enum: ['achat_vente', 'resilie_non_paiement', 'sortie_fourriere', 'autre'], description: 'Motif du besoin' },
  motif_assurance_temporaire_autre: { type: 'string', maxLength: 255, description: 'Texte libre si motif=autre' }
};

/* Outils en lecture seule (préparation) : aucune écriture, aucun envoi de données
   hors ChatGPT, cible bornée (notre produit / tarif jlassure). */
const READONLY = { readOnlyHint: true, openWorldHint: false, destructiveHint: false };

const devisOutputSchema = {
  type: 'object', additionalProperties: true,
  properties: {
    source: { type: 'string', enum: ['jlassure_api', 'indicatif'] },
    categorie: { type: ['string', 'null'] },
    tarif: { type: ['object', 'null'] },
    tarif_indicatif: { type: ['object', 'null'] },
    durees_disponibles: { type: ['array', 'null'], items: { type: 'integer' } },
    lien_devis_pre_rempli: { type: 'string' },
    hors_perimetre: { type: 'boolean' },
    message: { type: 'string' }
  }
};

const tarifsOutputSchema = {
  type: 'object', additionalProperties: true,
  properties: {
    categorie: { type: 'string' },
    puissance: { type: 'string' },
    grille: {
      type: 'array',
      items: { type: 'object', properties: { duree: { type: 'integer' }, prix_indicatif: { type: 'string' } } }
    },
    message: { type: 'string' }
  }
};

const TOOLS = [
  {
    name: 'devis_assurance_temporaire',
    title: 'Devis assurance temporaire',
    description: "Prépare un devis d'assurance auto temporaire (1 à 90 jours) sur Tempo-Assurance : " +
      'renvoie un tarif (réel via le tarificateur partenaire si disponible, sinon indicatif) et un ' +
      'lien de devis pré-rempli. La souscription et le paiement se font ensuite sur le tarificateur ' +
      '(le client finalise lui-même). ' +
      'Pour un TARIF RÉEL, fournir : categorie_vehi, age_vehicule (moins10/plus10), puissance ' +
      '(inf30 = ≤30 CV / sup30 = >30 CV), pays_immatriculation, pays_residence, age_conducteur et ' +
      'duree. À défaut, l\'outil suppose voiture ≤30 CV et véhicule <10 ans (préciser pour ajuster).',
    inputSchema: { type: 'object', additionalProperties: false, properties: profilProps },
    outputSchema: devisOutputSchema,
    annotations: READONLY,
    _meta: { 'openai/outputTemplate': WIDGET_URI },
    handler: devisAssuranceTemporaire
  },
  {
    name: 'tarifs_par_categorie',
    title: 'Tarifs par catégorie',
    description: "Donne la grille de tarifs indicatifs (par durée) pour une catégorie de véhicule.",
    inputSchema: {
      type: 'object', additionalProperties: false,
      required: ['categorie_vehi'],
      properties: {
        categorie_vehi: profilProps.categorie_vehi,
        puissance: profilProps.puissance
      }
    },
    outputSchema: tarifsOutputSchema,
    annotations: READONLY,
    handler: tarifsParCategorie
  }
];

module.exports = { TOOLS };
