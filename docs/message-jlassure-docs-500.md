# Signalement à JL Assure — `api_prefill_docs.php` renvoie HTTP 500 à l'upload

> Contact : christophe.p@jlassure.com — Compte : BLA1905B / id=43. Créé : 2026-07.

## Résumé
La **création de session** fonctionne (`api_prefill_session.php` → `session_url` + `prefill_token`).
Mais **l'ajout des pièces** (`api_prefill_docs.php`) renvoie **HTTP 500** lors d'un upload réel
(clé API valide + token valide + vrais fichiers JPEG). Résultat : les pièces ne sont pas jointes,
le client doit les redéposer sur le tunnel.

## Ce qui marche vs ce qui plante
| Test | Résultat |
|---|---|
| `api_prefill_docs.php` sans clé | ✅ **401** `{"code":"unauthorized"}` (auth OK) |
| `api_prefill_session.php` (création) | ✅ **200** → `session_url` + `prefill_token` |
| `api_prefill_docs.php` avec clé + token + fichiers | ❌ **500** |

Exemple concret (session créée le 2026-07 via `assure_tempo_rapide_mb43.php`) :
- `prefill_token` = `1c52c772-5ba-4e4b-8784-4adfa4077f57`
- 4 fichiers envoyés : `permis`, `permis_verso`, `carte_grise`, `carte_grise_verso` (JPEG)
- Réponse : **HTTP 500** → pièces non jointes

## Notre requête (côté MCJ)
```
POST https://www.jlassure.com/sousfiche/api_prefill_docs.php
Headers : X-Api-Key: <clé>  +  Authorization: Bearer <clé>
Content-Type : multipart/form-data (boundary posé automatiquement)
Champs :
  - prefill_token : <token de la session>        (champ texte)
  - permis / permis_verso / carte_grise / carte_grise_verso : fichiers JPEG
    (chaque partie a un filename et un Content-Type: image/jpeg)
```

## Questions / pistes à vérifier de votre côté
1. `api_prefill_docs.php` est-il bien **déployé en production** (et pas seulement en recette) ?
2. Le **dossier d'upload** (`uploads/…` ou `uploads/_prefill/{token}/`) est-il **créé et accessible en écriture** en prod ?
3. L'endpoint accepte-t-il un **token issu d'une session `mb43`** (le `session_url` renvoyé pointe sur `assure_tempo_rapide_mb43.php`) ?
4. Pouvez-vous consulter vos **logs serveur** pour le token `1c52c772-5ba-4e4b-8784-4adfa4077f57` et nous dire l'erreur PHP exacte (fatal error / exception) ?
5. Le **format multipart** attendu correspond-il bien à ce qu'on envoie (noms de champs, filename requis, `$_FILES`) ?

## Impact / contournement en place
Non bloquant : notre app gère le 500 proprement (le client dépose ses pièces sur le tunnel).
Mais l'objectif « zéro re-téléversement » n'est atteint qu'une fois ce 500 corrigé.
