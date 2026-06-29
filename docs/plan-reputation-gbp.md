# Plan d'action — Réputation & Google Business Profile

> Objectif : bâtir l'**autorité** (le vrai goulot d'un site jeune) → meilleure indexation, étoiles dans Google, et **citations par les IA** (ChatGPT/Perplexity s'appuient sur les avis et entités reconnues). Skills : `local-seo`, `eeat-signals`, `schema`, `directories`.

## 0. NAP canonique (à figer — à utiliser PARTOUT à l'identique)
La cohérence NAP (Name, Address, Phone) est la base. Toujours écrire **exactement** :
- **Nom** : `Tempo-Assurance` (marque) — entité légale `MCJ COURTAGE`
- **Adresse** : 15 rue … 34290 Abeilhan (à reprendre des mentions légales, format identique partout)
- **Téléphone** : `09 78 31 02 93`
- **Site** : `https://www.tempo-assurance.com`
- **E-mail** : `contact@mcj-courtage.com`

⚠️ Décider d'une seule graphie (ex. « Tempo-Assurance » vs « Tempo Assurance ») et s'y tenir sur la fiche, le site, et tous les annuaires.

## 1. Google Business Profile (off-site — action prioritaire)
Tempo étant **100 % en ligne** (national, pas de boutique visitée) → fiche en **« zone de service »** :
- [ ] Créer/réclamer la fiche sur business.google.com (compte Google de l'entreprise).
- [ ] **Type** : entreprise de prestation de services → **masquer l'adresse**, définir la **zone desservie** = France (et DOM si pertinent).
- [ ] **Catégorie principale** : « Agence d'assurance » (+ secondaires : Courtier en assurances).
- [ ] **Description** (750 car., mots-clés dans les 100 premiers) : « Assurance temporaire auto de 1 à 90 jours, 100 % en ligne… » + carte grise.
- [ ] **Horaires** : 24h/24 7j/7 (service en ligne).
- [ ] **Téléphone / site** : le NAP canonique ci-dessus.
- [ ] **Photos** : logo (carré), bannière, visuels.
- [ ] **Vérification** : par téléphone/e-mail/vidéo (la carte postale n'est plus le seul moyen).
- [ ] **Lien ORIAS** : mentionner n° 26008651 dans la description (confiance).

## 2. Collecte d'avis (le moteur de la réputation)
- [ ] **Google** : une fois la fiche vérifiée, récupérer le **lien d'avis court** et l'envoyer après chaque souscription (SMS/e-mail). Viser un flux régulier (mieux que des pics).
- [ ] **Trustpilot** (déjà lié dans le footer) : envoyer l'**invitation automatique** post-souscription.
- [ ] **Modèle de message** : « Merci d'avoir souscrit ! Votre avis en 30 s nous aide énormément : [lien] ».
- [ ] **Répondre à TOUS les avis** (positifs et négatifs) — signal E-E-A-T fort.
- [ ] ⚠️ **Jamais d'avis inventés.** Le schéma `AggregateRating`/`Review` ne sera ajouté au site **que** lorsque de vrais avis existent (sinon risque de pénalité Google).

## 3. Citations / annuaires (autorité + backlinks)
Précision plutôt que volume. Ordre de priorité :
1. Google Business Profile · 2. Apple Plans (Apple Business Connect) · 3. Bing Places · 4. Pages Jaunes / Yelp FR · 5. Annuaire **ORIAS** (légitimité métier) · 6. Annuaires assurance/courtage FR.
- [ ] NAP **identique** sur chaque annuaire. Auditer/supprimer les doublons avant d'en ajouter.

## 4. On-site (ce que je code) — fait / à faire
- [x] **Téléphone unifié** 09 78 31 02 93 partout.
- [x] **Schéma `InsuranceAgency`** sur les 53 pages (nom, ORIAS, sameAs MCJ + Trustpilot, areaServed FR).
- [x] **Enrichissement schéma** : `address` (Abeilhan 34290 Occitanie), `contactPoint` (téléphone, service client, langue FR) → cohérence NAP + entité reconnue par Google/IA.
- [ ] **`AggregateRating`** : à ajouter quand vrais avis (note + nombre depuis Trustpilot/Google).
- [ ] **Page/section « Avis »** : afficher les avis réels (widget Trustpilot ou Google) quand le volume le permet.

## 5. Impact GEO (pourquoi c'est prioritaire pour toi)
Tes ~48 % de trafic ChatGPT viennent d'une bonne base GEO. **L'autorité (avis + fiche Google + citations) est le palier suivant** : les IA citent davantage les entités reconnues et notées. GBP + avis = le meilleur ROI restant.

## Récap priorités
1. 🔴 **Créer la fiche GBP** (zone de service) + vérifier.
2. 🔴 **Lancer la collecte d'avis** (Google + Trustpilot) post-souscription.
3. 🟠 **Citations** (Apple, Bing, ORIAS, Pages Jaunes) avec NAP identique.
4. 🟢 **On-site** : `AggregateRating` + section avis dès que le volume existe.
