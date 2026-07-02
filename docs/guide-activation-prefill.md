# Activer le pré-remplissage de souscription (permis + carte grise) — app ChatGPT

> Phase 2 de l'app : le client téléverse son **permis** et sa **carte grise** dans ChatGPT,
> l'assistant extrait les informations, les **récapitule**, demande **confirmation**, puis
> obtient de JL Assure un **lien de souscription pré-rempli** (usage unique, ~30 min, aucune
> donnée personnelle dans l'URL). Le client n'a plus qu'à vérifier, téléverser ses pièces et payer.

## Ce qui est DÉJÀ en place (rien à coder)

| Brique | État |
|---|---|
| Outil MCP `preparer_session_souscription` (`chatgpt-app/lib/prefill.js`) | ✅ codé + testé |
| API JL Assure `api_prefill_session.php` (server-to-server, clé API) | ✅ validée en live |
| **Pièces jointes (Phase 2bis)** : photos permis/carte grise reçues via `openai/fileParams`, transmises en multipart à `api_prefill_docs.php` et **jointes au dossier** (zéro re-téléversement) | ✅ codé + testé (spec JL Assure du 2026-07-02) |
| Gestion des refus de pièce (`unreadable_document`, `invalid_format`, `file_too_large`…) : consigne de **relance photo nette**, repli = dépôt sur le tunnel | ✅ |
| Consignes au modèle : consentement explicite → OCR permis + carte grise → récapitulatif → confirmation → appel (avec `conducteur.nom`/`prenom` pour le rattachement des pièces) | ✅ dans la description de l'outil |
| Minimisation (seuls les champs fournis sont transmis), pas de donnée perso en URL/logs, transit éphémère des photos (aucune écriture disque) | ✅ |
| Politique de confidentialité (`confidentialite-ia.html` §2, §6, §9 — y compris transmission des photos) | ✅ mise à jour (2026-07-02) |
| Verrou d'activation | `ENABLE_PREFILL_SESSION` (OFF par défaut) |

> Côté JL Assure : `api_prefill_docs.php` doit être **déployé en production** (code prêt en
> local/recette d'après leur retour du 2026-07-02). Limites : JPEG/PNG/PDF, 10 Mo/fichier ;
> pièces supprimées automatiquement si la session expire sans souscription ; le contrôle humain
> back-office reste inchangé.

## Prérequis RGPD (décision MCJ — voir `rgpd-checklist-ocr.md`)

L'**information** (politique de confidentialité) et le **consentement dans le flux** sont en place.
Restent sous ta responsabilité avant d'ouvrir le robinet :
1. **Valider la check-list** `docs/rgpd-checklist-ocr.md` (idéalement avec un conseil/DPO) — notamment
   registre des traitements, DPA OpenAI/JL Assure, et l'opportunité d'une **AIPD**.
2. Confirmer avec **JL Assure** la **durée de conservation** des données de session côté tunnel.

## Activation (2 minutes, sur Render)

1. Render → service **tempo-assurance-mcp** → **Environment**.
2. Ajouter : `ENABLE_PREFILL_SESSION = 1` (la clé `JLASSURE_API_KEY` doit déjà être présente).
3. **Save & deploy** (redémarrage automatique).

Effets immédiats :
- l'outil `preparer_session_souscription` apparaît dans `tools/list` (3 outils au lieu de 2) ;
- la consigne « NIVEAU 2 » s'active dans la description de l'outil devis (elle est masquée quand
  le flag est OFF, pour que le modèle ne tente pas d'appeler un outil inexistant).

## Test de recette (dans ChatGPT, app « Assurance Temporaire »)

1. « Je veux assurer ma voiture 15 jours et **souscrire directement**. »
2. L'assistant doit proposer d'envoyer **photo du permis + carte grise** et demander le **consentement**.
3. Envoyer les photos → vérifier le **récapitulatif** (identité + véhicule) → confirmer.
4. L'assistant renvoie un **lien de session** (`prefill_token=…`, PAS de nom/immat dans l'URL) et
   confirme les **pièces jointes** (« déjà jointes au dossier »).
5. Ouvrir le lien : pages **Conducteur** et **Véhicule** pré-remplies, et à l'étape justificatifs
   les **pièces apparaissent en aperçu** (bouton « Continuer » actif) ; remplacement possible.
6. Vérifier l'expiration (~30 min) et l'usage unique (2ᵉ ouverture → session invalide).
7. **Cas dégradés** : envoyer une photo floue/minuscule → l'assistant doit **redemander une photo
   nette** (code `unreadable_document`) ; tester depuis **mobile** (bug connu OpenAI : référence de
   fichier incomplète → l'assistant doit continuer avec le repli « dépôt sur le tunnel »).

## Rollback

Supprimer/mettre à 0 `ENABLE_PREFILL_SESSION` sur Render → l'outil disparaît, retour au devis simple.
