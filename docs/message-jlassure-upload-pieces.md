# Demande à JL Assure — téléversement des pièces (permis + carte grise) via API

> Destinataire : christophe.p@jlassure.com — Compte : BLA1905B / id=43. Créé : 2026-07-02.
> Suite de l'API `api_prefill_session.php` (pré-remplissage sécurisé, déjà en prod).

## Objectif
Aujourd'hui, l'app ChatGPT pré-remplit les pages « Conducteur » et « Véhicule » via la session
sécurisée, mais le client doit **re-téléverser** son permis et sa carte grise sur le tunnel.
On aimerait supprimer cette étape : **les photos partagées dans ChatGPT seraient transmises
par notre serveur** (canal server-to-server, même clé API) et **rattachées au dossier**, pour
que le client n'ait plus qu'à vérifier, signer et payer.

## Côté OpenAI/MCJ : déjà possible
L'Apps SDK d'OpenAI permet à notre serveur de recevoir les fichiers téléversés par le client
(référence + URL de téléchargement temporaire). Notre serveur peut donc récupérer les images
(JPEG/PNG/PDF) et vous les transmettre immédiatement, **sans les stocker** (transit éphémère).

## Demande : un endpoint d'upload rattaché à la session
Proposition (à adapter à vos contraintes) :

```
POST https://www.jlassure.com/sousfiche/api_prefill_docs.php
Headers : X-Api-Key: <clé> (la même que api_tarif/api_prefill_session)
Content-Type : multipart/form-data
Champs :
  - prefill_token : le token renvoyé par api_prefill_session.php
  - permis        : fichier (jpeg/png/pdf)
  - carte_grise   : fichier (jpeg/png/pdf)
Réponse : { "success": true, "pieces": ["permis", "carte_grise"] }
```

Comportement souhaité : à l'ouverture de la `session_url`, les pièces apparaissent **déjà
jointes** au dossier (étape justificatifs pré-validée ou pré-remplie), le client garde la main
pour les remplacer si besoin.

## Questions
1. Est-ce faisable ? Sous quel délai ? (endpoint dédié, ou extension multipart de
   `api_prefill_session.php` — les deux nous vont.)
2. **Formats/poids** acceptés (JPEG, PNG, PDF ; taille max ?).
3. Les pièces transmises par API passent-elles par la **même validation** que celles
   téléversées par le client sur le tunnel (contrôles, lisibilité) ?
4. **Conservation** côté JL Assure : durée, sort des pièces si la session expire sans
   souscription (suppression ?) — nécessaire pour notre registre RGPD.
5. En cas de pièce illisible/refusée, quel **retour d'erreur** l'API renvoie-t-elle
   (pour qu'on redemande une photo nette au client dans ChatGPT) ?

## Cadre
- Transmission **server-to-server uniquement** (jamais d'URL publique, jamais de donnée
  personnelle dans une URL), authentifiée par clé API.
- Notre serveur ne **conserve rien** (ni images, ni données) : simple transit chiffré (TLS).
- La souscription, l'IPID et le paiement restent réalisés par le client sur votre tunnel
  (DDA/ACPR inchangé).
