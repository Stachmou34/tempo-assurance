'use strict';
/* Déclaration des outils MCP exposés à ChatGPT (Apps SDK = MCP).
   Schémas alignés sur la spec de pré-remplissage jlassure / WebMCP du site. */

const { devisAssuranceTemporaire, tarifsParCategorie } = require('./devis');
const { CATEGORIES } = require('./tarifs');
const { WIDGET_URI } = require('./resources');
const { prefillTool, sessionEnabled } = require('./prefill');

const profilProps = {
  categorie_vehi: { type: 'string', enum: CATEGORIES, description: 'Catégorie de véhicule (ex. VL-VL voiture, CAM-CAM3 camion, REM-REM2 remorque…)' },
  age_vehicule: { type: 'string', enum: ['moins10', 'plus10'], description: 'Âge du véhicule' },
  puissance: { type: 'string', enum: ['inf30', 'sup30', '0'], description: 'inf30 (≤30 CV) · sup30 (>30 CV) · 0 (remorque/caravane)' },
  pays_immatriculation: { type: 'string', description: "Pays d'immatriculation en MAJUSCULES (ex. FRANCE METROPOLITAINE)" },
  pays_residence: { type: 'string', description: 'Pays de résidence du conducteur, en MAJUSCULES' },
  date_naissance: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$', description: 'AAAA-MM-JJ (conducteur 21 à 90 ans)' },
  age_conducteur: { type: 'integer', minimum: 21, maximum: 90, description: "Âge du conducteur (alternative à date_naissance pour l'API tarif)" },
  duree: { type: 'integer', minimum: 1, maximum: 90, description: 'Durée en jours (1 à 90)' },
  /* date_debut / heure_debut NON exposés : ils font planter le tarificateur
     (500 côté JL Assure). Le client saisit la date de début dans le tunnel. */
  /* Champs BRUTS lus sur une carte grise (OCR) : convertis automatiquement.
     Ne PAS demander/transmettre les champs personnels (nom, immatriculation, châssis). */
  puissance_cv: { type: 'integer', description: 'Carte grise P.6 : puissance fiscale en CV (ex. 6). Converti en inf30/sup30.' },
  ptac_kg: { type: 'integer', description: 'Carte grise F.2 : PTAC en kg. Sert uniquement à distinguer un camping-car ≤ 3,5 t (CC-Cap) d\'un camping-car > 3,5 t (CAM-Fou). Le PTAC n\'est pas transmis au tunnel.' },
  date_mise_circulation: { type: 'string', description: 'Carte grise B : date de 1re mise en circulation (JJ/MM/AAAA ou AAAA-MM-JJ). Converti en age_vehicule.' },
  genre_carte_grise: { type: 'string', description: 'Carte grise J.1 : genre national (VP, CTTE, CAM, TCP, REM, VASP, TRA, QM…). Converti en categorie_vehi.' }
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
      'renvoie un tarif et un lien de devis pré-rempli. La souscription et le paiement se font ' +
      'ensuite sur le tarificateur (le client finalise lui-même). ' +
      'NIVEAU 1 (devis) — DEMANDER au client, sans rien supposer : categorie_vehi · age_vehicule ' +
      '(moins/plus de 10 ans) · puissance (≤30 / >30 CV) · pays_immatriculation · ' +
      'pays_residence · age_conducteur (ou date_naissance) · duree. ' +
      'NE PAS demander le PTAC ni le motif (le PTAC est calculé automatiquement depuis categorie_vehi ; ' +
      'pour un camping-car, choisir CC-Cap si ≤ 3,5 t ou CAM-Fou si > 3,5 t). ' +
      "Si l'outil répond source=incomplet, poser les questions listées dans besoin_infos (NE PAS inventer de valeur). " +
      'NIVEAU 1+ (tarif précis) — si le client ne connaît pas la puissance, lui PROPOSER ' +
      "d'envoyer une photo de CARTE GRISE ; en extraire les champs TECHNIQUES et les passer en brut : " +
      'puissance_cv (P.6), date_mise_circulation (B), genre_carte_grise (J.1) — et ptac_kg (F.2) seulement ' +
      'pour un camping-car (CC-Cap vs CAM-Fou) — convertis automatiquement. ' +
      'NIVEAU 2 (souscription) — si le client veut souscrire / gagner du temps, lui proposer la carte ' +
      'grise + le permis et utiliser plutôt l\'outil preparer_session_souscription. ' +
      'Avant de présenter le lien de souscription final, RÉCAPITULER le profil (véhicule, durée, conducteur) et demander confirmation. ' +
      'NE PAS extraire ni transmettre de données personnelles ici (nom, adresse, immatriculation, châssis, n° de permis).',
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

/* Phase 2 (données personnelles) : outil ajouté SEULEMENT si activé explicitement
   (ENABLE_PREFILL_SESSION=1), après validation RGPD. OFF par défaut. */
if (sessionEnabled()) TOOLS.push(prefillTool);

module.exports = { TOOLS };
