# Signalement bug à JL Assure — `date_debut` provoque une erreur 500

> Contact : christophe.p@jlassure.com

## Résumé
Le tarificateur en marque blanche renvoie une **erreur HTTP 500 (page blanche)** dès que le paramètre GET **`date_debut`** est fourni dans l'URL de pré-remplissage. Le problème touche **les deux moteurs** : `assure_tempo_rapide_mb.php` **et** `assure_tempo_rapide_mb43.php`.

## Reproduction (testé le 2026-07-01)
Base OK (200) :
```
https://www.jlassure.com/sousfiche/assure_tempo_rapide_mb.php?cd=BLA1905B&id=43&adrsite=www.tempo-assurance.com
```
Chaque paramètre pris isolément → **200**, SAUF `date_debut` → **500** :
```
...&categorie_vehi=VL-VL      -> 200
...&age_vehicule=moins10      -> 200
...&puissance=inf30           -> 200
...&duree=15                  -> 200
...&date_naissance=1994-07-01 -> 200
...&pays_immatriculation=FRANCE%20METROPOLITAINE -> 200
...&date_debut=2026-07-02     -> 500  ❌
```
Le 500 survient **quel que soit le format** de `date_debut` (`2026-07-02`, `02-07-2026`, `02/07/2026`) et **quelle que soit la valeur** (aujourd'hui, demain, dans 15 jours), sur **mb.php et mb43.php**.

Profil complet **sans** `date_debut` → **200** (le formulaire s'affiche normalement) :
```
...&categorie_vehi=VL-VL&age_vehicule=moins10&puissance=inf30&pays_immatriculation=FRANCE%20METROPOLITAINE&pays_residence=FRANCE%20METROPOLITAINE&date_naissance=1994-07-01&duree=15  -> 200
```

## Impact
Tout lien de devis pré-rempli contenant `date_debut` (dont ceux générés par l'app ChatGPT) affiche une **iframe vide** côté tempo-assurance.com.

## Contournement en place côté MCJ
En attendant le correctif, nous **ne transmettons plus** `date_debut` ni `heure_debut` (le client saisit la date dans le tunnel). À **réactiver** une fois le bug corrigé :
- `assets/site.js` (liste blanche `PREFILL_KEYS` + outil WebMCP)
- `chatgpt-app/lib/devis.js` (`PREFILL_KEYS`, `ECHO_KEYS`, valeurs par défaut de `buildDevisUrl`)
- `chatgpt-app/lib/tools.js` (schéma) et `chatgpt-app/lib/prefill.js`
- `llms.txt` (exemple + doc paramètres)

## Question à JL Assure
Pouvez-vous corriger le traitement de `date_debut` (et confirmer le format attendu : `AAAA-MM-JJ` ?) afin qu'on puisse le réactiver ?
