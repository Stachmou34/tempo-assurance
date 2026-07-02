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
| Consignes au modèle : consentement explicite → OCR permis + carte grise → récapitulatif → confirmation → appel | ✅ dans la description de l'outil |
| Minimisation (seuls les champs fournis sont transmis), pas de donnée perso en URL/logs | ✅ |
| Politique de confidentialité (`confidentialite-ia.html` §2, §6, §9) | ✅ mise à jour (2026-07-02) |
| Verrou d'activation | `ENABLE_PREFILL_SESSION` (OFF par défaut) |

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
4. L'assistant renvoie un **lien de session** (`prefill_token=…`, PAS de nom/immat dans l'URL).
5. Ouvrir le lien : les pages **Conducteur** et **Véhicule** du tunnel doivent être pré-remplies.
6. Vérifier l'expiration (~30 min) et l'usage unique (2ᵉ ouverture → session invalide).

## Rollback

Supprimer/mettre à 0 `ENABLE_PREFILL_SESSION` sur Render → l'outil disparaît, retour au devis simple.
