# Contexte projet — Tempo-Assurance

> Document interne (mémoire projet). Mis à jour : 2026-06-14.

## C'est quoi
**tempo-assurance.com** : site d'**assurance temporaire de véhicules** (1 à 90 jours), 100 % en ligne.
- **Marque** de **MCJ Courtage** (courtier français, à Abeilhan 34290).
- **Tarificateur / souscription** = moteur **jlassure** (JL Assure), intégré en **iframe** (compte apporteur `cd=BLA1905B`, `id=43`). On ne gère pas le devis/paiement nous-mêmes.
- Paiement par CB via banque partenaire **CIC**.

## Les 3 axes de travail
1. **Conformité + SEO + contenu** — fiabiliser le site, corriger les erreurs, créer les pages manquantes.
2. **GEO (référencement par les IA)** — être cité/recommandé par ChatGPT, Claude, Perplexity…
3. **Devis assisté par IA (« Route A »)** — qu'un lien ouvre un devis **pré-rempli** sur le tarificateur.

## Architecture technique
- Site **statique** : ~40 pages HTML, CSS inline (dupliqué par page), `assets/site.js` (vanilla, partagé), `llms.txt`, `robots.txt`, `sitemap.xml`.
- Dépôt Git : `Stachmou34/tempo-assurance`, branche de travail `claude/geo-pages-reponses`, base `main`.
- Le devis = iframe jlassure sur `devis-ou-souscription.html` + une modale (`#modal-souscription`) ouverte par les boutons `.cta-btn-modal` sur les autres pages.

## Route A — comment marche le pré-remplissage
1. Un lien arrive sur une page avec des paramètres d'URL (ex. `?categorie_vehi=VL-VL&duree=15&...`).
2. `assets/site.js` relaie une **liste blanche de 12 paramètres** vers le `src` de l'iframe (page devis ET modale).
3. jlassure **valide** chaque paramètre (liste blanche serveur), injecte les valeurs dans des champs cachés `pref_*`, puis son JS les applique au formulaire et calcule le tarif.
4. Le client vérifie, lit l'IPID, signe et paie. **La souscription/paiement restent humains (obligation DDA/ACPR).**

### Les 12 paramètres de pré-remplissage
`categorie_vehi, age_vehicule, puissance, ptac, pays_immatriculation, pays_residence, date_naissance, motif_assurance_temporaire, motif_assurance_temporaire_autre, duree, date_debut, heure_debut`
- Minimum pour afficher un tarif : `categorie_vehi + age_vehicule + puissance + pays_immatriculation + pays_residence + date_naissance`.
- Détail des valeurs : voir `llms.txt` (section « Préparer un devis pré-rempli »).

## Catégories de véhicules (codes jlassure) → nos pages
| Code | Véhicule | Page |
|---|---|---|
| `VL-VL` | Voiture (VP) | assurance-temporaire-auto.html |
| `VL-VU` | Utilitaire / fourgon ≤ 3,5 t (CTTE) | assurance-temporaire-utilitaire.html |
| `CAM-CAM3` | Camion / tracteur routier > 3,5 t | assurance-temporaire-camion.html |
| `CC-Cap` | Camping-car ≤ 3,5 t | assurance-temporaire-camping-car.html (partiel) |
| `CAM-Fou` | Camping-car > 3,5 t | (à traiter) |
| `TCP-TCP` | Bus / car / autocar | assurance-temporaire-bus.html |
| `VSP-VSP` | Voiturette sans permis | (à créer) |
| `QMQLEM-QMQLEM` | Buggy sans permis | (à créer) |
| `QM-QM` | Quad | (à créer) |
| `TRA-TRA` | Tracteur agricole | (à créer) |
| `REM-REM2` | Remorque / semi-remorque | (à créer) |
| `REM-REM3` | Caravane | (à créer) |

## Décisions clés (à ne pas refaire)
- **Âge conducteur** : minimum **21 ans** (le « 23 ans » est un seuil tarifaire, pas le minimum). 2 ans de permis.
- **Camion = > 3,5 t** (CAM-CAM3, durée max 15 j, sans assistance). En dessous = **utilitaire** (VL-VU). **Pas** de « camion < 3,5 t ».
- **Pas de moto** : aucune catégorie 2-roues dans le tarificateur → ne jamais l'afficher.
- **Frontière** : véhicules immatriculés **hors EEE** ; immatriculation **Pologne, Roumanie, Italie exclues** ; durées 30 ou 90 jours.
- **DOM / outre-mer** : couverts (confirmé) — on garde.
- **Prix 90 j voiture = 420,21 €** (4,67 €/jour). L'ancien 290,16 € était le tarif **60 jours** (erreur corrigée).
- **Pages auto / utilitaire** créées ; **poids-lourd** consolidée → camion (canonical), retirée du sitemap.
- **Assistance** : uniquement voiture/utilitaire. Pas pour camion, PL, bus, remorque, voiturette.


## Vision cible (long terme) — architecture de marque

- **MCJ Courtage (`mcj-courtage.com`)** : à terme, **courtier généraliste** (auto à l'année, habitation, santé, pro…). C'est le **navire amiral corporate**, multi-produits.
- **Tempo-Assurance (`tempo-assurance.com`)** : reste **dédié à la niche « assurance temporaire »**. Le domaine est un **actif fort** (mémorisable, spécialiste) → on ne le dilue pas.
- **Règle d'étanchéité** : le temporaire reste **uniquement** sur tempo. mcj-courtage **ne crée pas** de pages temporaire (il **renvoie** vers tempo) → pas de doublon / cannibalisation.
- **Séquencement** : **gagner d'abord la niche** (tempo, marché atteignable) avant d'investir le généraliste (marché très concurrentiel : comparateurs, gros courtiers). Toute l'énergie sur tempo pour l'instant.
- **Au lancement du généraliste** : modéliser `mcj-courtage.com` = `parentOrganization` et tempo = marque spécialiste (`brand` / `subOrganization`). La fiche Google pourra alors pointer vers mcj-courtage (le « site web » se change en 1 clic ; les avis restent attachés à l'entité MCJ Courtage). La base `sameAs` déjà posée s'enchaîne dessus.

## Réserve importante sur le GEO
`llms.txt` est un standard **émergent** : lu par **Perplexity et les agents**, mais **PAS** par ChatGPT/Claude en navigation classique (constaté en test). Pour ces IA, ce qui compte = **contenu visible + autorité (SEO/réputation)**. Le pré-remplissage automatique par lien = surtout pour agents/Perplexity + nos propres estimateurs on-site.

## Fichiers sources jlassure (privés, NON versionnés)
Reçus pour valider l'intégration, à garder hors du repo (données internes) :
- formulaire `assure_tempo_rapide_mb.php`, `param_table.php`, `get_tarifs.php`
- centrale tarifaire Excel (Nouveau tarif 23/10/2025) — contient coûts/marges/concurrents.
- Brief technique jlassure + barème IFRAMEUR extrait — fournis hors repo.
