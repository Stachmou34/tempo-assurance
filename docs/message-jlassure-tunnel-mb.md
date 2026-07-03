# Demande à JL Assure — aligner la session pré-remplie sur le tunnel de base `mb.php`

> Contact : christophe.p@jlassure.com — Compte : BLA1905B / id=43.

## Constat
La `session_url` renvoyée par `api_prefill_session.php` pointe sur
**`assure_tempo_rapide_mb43.php`**, alors que notre parcours public reste sur le
tunnel de base **`assure_tempo_rapide_mb.php`** (iframe du site, liens de devis).

Exemple de session_url renvoyée :
```
https://www.jlassure.com/sousfiche/assure_tempo_rapide_mb43.php?cd=BLA1905B&id=43&adrsite=https://tempo-assurance.com&prefill_token=…
```

On souhaite **rester sur le tunnel de base `mb.php`** pour le client (cohérence de parcours).

## Questions
1. Pouvez-vous faire en sorte que `api_prefill_session.php` renvoie une `session_url`
   pointant sur **`assure_tempo_rapide_mb.php`** (au lieu de `mb43.php`) ?
2. Sinon : le **pré-remplissage (`prefill_token`) fonctionne-t-il aussi sur `mb.php`** ?
   - Si oui, on peut simplement pointer le client sur
     `assure_tempo_rapide_mb.php?...&prefill_token=…` (mêmes paramètres) — confirmez-vous
     que le token y est bien consommé (données + pièces pré-remplies) ?
   - Si non (le pré-remplissage est spécifique à `mb43`), dites-le nous : on tranchera
     entre garder ce parcours sur `mb43` ou aligner le site sur `mb43`.
3. Un **paramètre** existe-t-il pour choisir le moteur cible à la création de la session ?

## Contexte
- Côté MCJ, tout est déjà sur `mb.php` (iframe devis + liens pré-remplis).
- La création de session + la jonction des pièces (`api_prefill_docs.php`) fonctionnent
  bien (test OK). Il ne reste que ce **choix de moteur** dans la `session_url`.
