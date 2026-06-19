# Use case — Devis assurance temporaire avec OCR de la carte grise

> Scénario de référence (validé en réel sur le serveur de prod). Créé : 2026-06-19.

## Personnage
**Marie** part en vacances et veut assurer **15 jours** la voiture de son père.
Elle ne connaît pas la puissance fiscale ni le PTAC. Elle a une photo de la carte grise.

## Déroulé (dans ChatGPT)

**1. Marie** — « Je veux assurer une voiture **15 jours** pour mes vacances. »

**2. ChatGPT (app Assurance temporaire)** — propose et invite :
> « Je peux vous préparer un devis. Pour un **tarif exact**, partagez une **photo de la
> carte grise** (ou indiquez la puissance fiscale). »

**3. Marie** joint la **photo de la carte grise**.

**4. ChatGPT (vision/OCR)** lit **uniquement les champs techniques** :
- genre (J.1) = `VP` · puissance (P.6) = `7 CV` · PTAC (F.2) = `1900 kg` · 1re mise en circulation = `12/05/2019`
- ➜ il **n'extrait PAS** nom, adresse, immatriculation, n° de châssis, n° de permis.
Puis il appelle l'outil `devis_assurance_temporaire` avec ces champs bruts.

**5. L'app (Render)** convertit (déterministe) et interroge l'**API tarif jlassure** :
- `VP`→`VL-VL` · `7 CV`→`inf30` · `1900 kg`→`inf3500` · `2019`→`moins10`

**6. La carte de devis s'affiche** :
- **118,67 € pour 15 jours — PRIX RÉEL** (RC + Défense et Recours, frais inclus)
- « Lu sur la carte grise : catégorie, puissance, PTAC, âge du véhicule »
- Marie peut **cliquer une autre durée** → le prix se recalcule.

**7. Marie clique « Souscrire »** → le **tarificateur jlassure s'ouvre pré-rempli**
(catégorie/puissance/PTAC/pays/durée déjà remplis). Elle **complète son identité**,
téléverse les pièces (permis, carte grise) et **paie**. 
➜ Conformité : la **souscription et le paiement restent réalisés par Marie** (DDA/ACPR).

## Résultat réel (prod, 2026-06-19)
```
Entrée OCR : {genre_carte_grise:"VP", puissance_cv:7, ptac_kg:1900,
              date_mise_circulation:"12/05/2019", age_conducteur:42, duree:15, pays France}
Sortie     : source=jlassure_api · 118,67 € (prix réel) · 37 durées
             lien pré-rempli : …?categorie_vehi=VL-VL&age_vehicule=moins10&puissance=inf30&ptac=inf3500&…
```

## Données & conformité
- **Minimisation** : seuls les **champs techniques** sortent de la carte grise. Aucune
  donnée d'identité n'est extraite ni transmise par l'app.
- **Pièces justificatives** : téléversées **directement par le client sur le tunnel
  jlassure** (l'app ne les héberge pas).

## Ce que ce use case NE fait PAS encore (phase 2)
- **Pré-remplir la page « identité conducteur »** (nom, adresse, permis) et l'identité
  véhicule (immatriculation, châssis). 
  ➜ Bloqué tant que : (a) **jlassure** ne fournit pas un **prefill sécurisé** par jeton
  (voir `note-jlassure-prefill-securise.md`), et (b) la **check-list RGPD**
  (`rgpd-checklist-ocr.md`) n'est pas validée.
  ➜ D'ici là, Marie remplit encore **sa partie identité** sur le tarificateur.
