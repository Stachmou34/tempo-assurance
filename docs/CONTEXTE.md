# Contexte projet — Tempo-Assurance

> Document interne (mémoire projet). Mis à jour : 2026-06-21.

## C'est quoi
**tempo-assurance.com** : site d'**assurance temporaire de véhicules** (1 à 90 jours), 100 % en ligne.
- **Marque** de **MCJ Courtage** (courtier français), immatriculé **ORIAS n° 26008651**, contrôle ACPR.
- **Tarificateur / souscription** = moteur **jlassure** (JL Assure), intégré en **iframe** (compte apporteur `cd=BLA1905B`, `id=43`). On ne gère pas le devis/paiement nous-mêmes.
- Paiement par CB via banque partenaire **CIC**.

## Les axes de travail
1. **Conformité + SEO + contenu** — fiabiliser le site, corriger les erreurs, créer les pages manquantes.
2. **GEO (référencement par les IA)** — être cité/recommandé par ChatGPT, Claude, Perplexity…
3. **Devis assisté par IA (« Route A »)** — qu'un lien ouvre un devis **pré-rempli** sur le tarificateur.
4. **Application ChatGPT (Apps SDK / serveur MCP)** — préparer un devis dans ChatGPT (tarif réel JL Assure + OCR carte grise), redirection vers le tunnel sécurisé. Soumise à OpenAI (en revue). Code dans `chatgpt-app/`. Phase 2 (zéro formulaire) **OFF** jusqu'au feu vert RGPD.

## Architecture technique
- Site **statique** : ~48 pages HTML, CSS inline (dupliqué par page — choix perf volontaire), `assets/site.js` (vanilla, partagé), `llms.txt`, `robots.txt`, `sitemap.xml`, `.htaccess`. (`assets/site.css` supprimé car orphelin.)
- Dépôt Git : `Stachmou34/tempo-assurance`, branche de travail courante `claude/upbeat-cerf-yjyYC`, base `main`.
- Le devis = iframe jlassure sur `devis-ou-souscription.html` + une modale (`#modal-souscription`) ouverte par les boutons `.cta-btn-modal` sur les autres pages.

## Route A — comment marche le pré-remplissage
1. Un lien arrive sur une page avec des paramètres d'URL (ex. `?categorie_vehi=VL-VL&duree=15&...`).
2. `assets/site.js` relaie une **liste blanche de 12 paramètres** vers le `src` de l'iframe (page devis ET modale).
3. jlassure **valide** chaque paramètre (liste blanche serveur), injecte les valeurs dans des champs cachés `pref_*`, puis son JS les applique au formulaire et calcule le tarif.
4. Le client vérifie, lit l'IPID, signe et paie. **La souscription/paiement restent humains (obligation DDA/ACPR).**

### Les 7 paramètres de pré-remplissage
`categorie_vehi, age_vehicule, puissance, pays_immatriculation, pays_residence, date_naissance, duree`
- Minimum pour afficher un tarif : `categorie_vehi + age_vehicule + puissance + pays_immatriculation + pays_residence + date_naissance`.
- **MàJ tunnel JL Assure (2026-06)** : `ptac` et `motif_assurance_temporaire`/`_autre` **retirés** du tunnel. Le **PTAC est calculé automatiquement** depuis `categorie_vehi` (CC-Cap → ≤ 3,5 t · CAM-Fou / CAM-CAM3 / TCP-TCP → > 3,5 t · reste → ≤ 3,5 t) ; le **motif** a été supprimé. Camping-car : choisir **CC-Cap** ou **CAM-Fou**. Les anciens liens avec `ptac=`/`motif_*` restent valides (paramètres ignorés).
- ⚠️ **`date_debut` / `heure_debut` retirés du relais (2026-07-01)** : le tarificateur renvoie une **erreur 500** quand `date_debut` est passé en GET (bug serveur JL Assure, `mb.php` ET `mb43.php`, tout format). Le client saisit la date dans le tunnel. À réactiver après correctif — cf. `docs/message-jlassure-date-debut-500.md`.
- Détail des valeurs : voir `llms.txt` (section « Préparer un devis pré-rempli »).

## Catégories de véhicules (codes jlassure) → nos pages
| Code | Véhicule | Page |
|---|---|---|
| `VL-VL` | Voiture (VP) | assurance-temporaire-auto.html |
| `VL-VU` | Utilitaire / fourgon ≤ 3,5 t (CTTE) | assurance-temporaire-utilitaire.html |
| `CAM-CAM3` | Camion / tracteur routier > 3,5 t | assurance-temporaire-camion.html |
| `CC-Cap` | Camping-car ≤ 3,5 t | assurance-temporaire-camping-car.html |
| `CAM-Fou` | Camping-car > 3,5 t | (au devis ; pas de page dédiée) |
| `TCP-TCP` | Bus / car / autocar | assurance-temporaire-bus.html |
| `VSP-VSP` | Voiturette sans permis | assurance-temporaire-voiturette.html |
| `QMQLEM-QMQLEM` | Buggy sans permis | (couvert sur la page voiturette) |
| `QM-QM` | Quad | assurance-temporaire-quad.html |
| `TRA-TRA` | Tracteur agricole | assurance-temporaire-tracteur-agricole.html |
| `REM-REM2` | Remorque / semi-remorque | assurance-temporaire-remorque.html |
| `REM-REM3` | Caravane | assurance-temporaire-caravane.html |

## Décisions clés (à ne pas refaire)
- **Âge conducteur** : minimum **21 ans** (le « 23 ans » est un seuil tarifaire, pas le minimum). 2 ans de permis.
- **Camion = > 3,5 t** (CAM-CAM3, durée max 15 j, sans assistance). En dessous = **utilitaire** (VL-VU). **Pas** de « camion < 3,5 t ».
- **Pas de moto** : aucune catégorie 2-roues dans le tarificateur → ne jamais l'afficher.
- **Frontière** : véhicules immatriculés **hors EEE** ; immatriculation **Pologne, Roumanie, Italie exclues** ; durées 30 ou 90 jours.
- **DOM / outre-mer** : couverts (confirmé) — on garde.
- **Prix 90 j voiture = 420,21 €** (4,67 €/jour). L'ancien 290,16 € était le tarif **60 jours** (erreur corrigée).
- **Pages auto / utilitaire** créées ; **poids-lourd** consolidée → camion : page supprimée + **301 fait** dans `.htaccess`.
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
