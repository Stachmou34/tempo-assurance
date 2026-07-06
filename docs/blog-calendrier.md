# Calendrier éditorial — Blog Tempo-Assurance

> 1 article/semaine. Angle : assurance auto **avec un pont vers l'assurance temporaire**. Chaque article = recherche web + sources citées + 1-2 photos libres de droit (Pexels/Unsplash) + page on-brand (schémas BlogPosting + FAQPage + BreadcrumbList + WebPage) + CTA devis + maillage interne. Fichiers : `blog-<slug>.html`, listés dans `blog.html` + sitemap + llms.txt + menu Guides & FAQ.

## Process (à répéter chaque semaine)
1. Prendre le **prochain sujet non publié** ci-dessous.
2. Rechercher (sources FR fiables : service-public, assureurs, code des assurances) → faits + chiffres datés.
3. Sélectionner 1-2 **photos libres de droit** (Pexels/Unsplash), télécharger dans `images/blog/`, vérifier visuellement, créditer la source.
4. Générer la page (gabarit = `blog-preter-sa-voiture.html`) : bloc « En bref » 40-60 mots, H2 extractibles, FAQ, sources, CTA devis, liens internes.
5. Ajouter au `blog.html`, `sitemap.xml`, `llms.txt`. Vérifier JSON-LD + rendu (0 erreur JS).
6. Commit + PR.

## Sujets (file d'attente)
| # | Statut | Titre | Mot-clé cible | Pont temporaire |
|---|---|---|---|---|
| 1 | ✅ publié | Prêter sa voiture : qui est assuré ? | prêter sa voiture assurance | temp au nom de l'emprunteur |
| 2 | ✅ publié | Acheter une voiture d'occasion : être assuré le jour de l'achat | assurance achat voiture occasion | temp immédiate achat-vente |
| 3 | à faire | Jeune conducteur : rouler assuré sans ruiner son budget | assurance jeune conducteur | temp ponctuelle / 2e véhicule |
| 4 | à faire | Carte grise barrée : assurer et ré-immatriculer | carte grise barrée assurance | temp + carte grise |
| 5 | à faire | Conduire un véhicule importé : assurance frontière et démarches | assurance véhicule importé | frontière + temp |
| 6 | à faire | Résilié par son assureur : quelles solutions pour continuer à rouler | assurance après résiliation | temp en transition |
| 7 | à faire | Convoyer une voiture achetée loin : comment l'assurer | assurance convoyage voiture | temp 1-2 jours |
| 8 | à faire | Emprunter une voiture le temps d'un week-end | assurance voiture week-end | temp week-end |
| 9 | à faire | Sortie de fourrière : rouler légalement tout de suite | assurance sortie de fourrière | temp attestation immédiate |
| 10 | à faire | Bonus-malus : tout comprendre (et comment le protéger) | bonus malus explication | temp protège le CRM du prêteur |
| 11 | à faire | Camping-car & van : bien s'assurer pour les vacances | assurance temporaire camping-car | temp vacances |
| 12 | à faire | Permis étranger en France : assurer sa voiture | assurance permis étranger | frontière + temp |

## Planning des sorties (1 article / semaine — lundi)
Cadence : **chaque lundi ~9 h** (cron `74d29a1a`, voir réserves sur l'expiration 7 j). Démarrage le 29/06/2026.

| Semaine | Date | # | Article | Statut |
|---|---|---|---|---|
| S1 | **lun. 29/06/2026** | 1 | Prêter sa voiture : qui est assuré ? | ✅ publié |
| S2 | **lun. 06/07/2026** | 2 | Acheter une voiture d'occasion : être assuré le jour de l'achat | ✅ publié |
| S3 | lun. 13/07/2026 | 3 | Jeune conducteur : rouler assuré sans ruiner son budget | à venir |
| S4 | lun. 20/07/2026 | 4 | Carte grise barrée : assurer et ré-immatriculer | à venir |
| S5 | lun. 27/07/2026 | 5 | Conduire un véhicule importé : assurance frontière et démarches | à venir |
| S6 | lun. 03/08/2026 | 6 | Résilié par son assureur : quelles solutions pour rouler | à venir |
| S7 | lun. 10/08/2026 | 7 | Convoyer une voiture achetée loin : comment l'assurer | à venir |
| S8 | lun. 17/08/2026 | 8 | Emprunter une voiture le temps d'un week-end | à venir |
| S9 | lun. 24/08/2026 | 9 | Sortie de fourrière : rouler légalement tout de suite | à venir |
| S10 | lun. 31/08/2026 | 10 | Bonus-malus : tout comprendre (et comment le protéger) | à venir |
| S11 | lun. 07/09/2026 | 11 | Camping-car & van : bien s'assurer pour les vacances | à venir |
| S12 | lun. 14/09/2026 | 12 | Permis étranger en France : assurer sa voiture | à venir |

> Après S12 (14/09), la boucle propose **6 nouveaux sujets** avant de continuer. Idée : faire coïncider certains sujets avec la saisonnalité (ex. camping-car avant l'été, achat-vente en septembre/octobre — rentrée auto d'occasion).

## Règles de conformité (rappel)
- Jamais : moto, « camion < 3,5 t », âge ≥ 23 comme minimum, prix 90 j à 290,16 €.
- Durées : voiture/camping-car 1-90 ; camion/PL/bus/remorque 1-15 ; voiturette 10-30.
- Prix uniquement publics (barème `tarifs.md`/`llms.txt`), jamais coûts/marges.
- Photos : licence commerciale libre uniquement, source créditée.
- Ton : informatif, sourcé, « écrit pour des humains » (pas de bourrage de mots-clés).
- **Éviter les tirets cadratins (—) en prose** (tell n°1 d'écriture IA) : préférer virgules/parenthèses. Éviter aussi les tics (« il est important de », « n'hésitez pas », « en somme »…).
