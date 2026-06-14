# À faire — backlog priorisé

> Document interne. Mis à jour : 2026-06-14.

## 🔴 P0 — Le vrai goulot : être trouvé/cité par les IA (« étage 1 »)
Tout le pré-remplissage est prêt, mais une IA ne nous recommande que si elle nous **trouve**. Leviers (SEO + réputation, pas technique) :
1. **Fiche Google Business Profile** (MCJ Courtage / Tempo-Assurance) — levier n°1, gratuit. Avis Google = cités par les IA + étoiles natives Google. → fiche à créer + faire vérifier (carte postale 5-14 j).
2. **Collecte d'avis** (Google + Trustpilot) : envoyer le lien d'invitation après souscription.
3. **Indexation Search Console** : renvoyer le sitemap + « Demander l'indexation » des pages prioritaires (liste de batches fournie). Le site est jeune → beaucoup de pages « explorées/détectées non indexées ».
4. **Backlinks** : annuaire ORIAS, annuaires assurance, partenaires.

## 🟠 P1 — Déploiement / cohérence
- **Merger la PR #34** puis vérifier le déploiement live.
- **Redirection 301** `assurance-temporaire-poids-lourd.html → assurance-temporaire-camion.html` côté hébergeur (le canonical seul ne suffit pas).
- **ORIAS** : insérer le numéro d'immatriculation dès réception (~1 mois) — actuellement « en cours » dans les mentions légales.

## 🟡 P2 — Pages catégories manquantes (opportunités SEO + couverture devis)
À créer sur le modèle auto/utilitaire/camion (avec estimateur + CTA pré-rempli) :
- **Voiturette sans permis** (`VSP-VSP`) — forte demande.
- **Remorque / semi-remorque** (`REM-REM2`) + **Caravane** (`REM-REM3`).
- **Tracteur agricole** (`TRA-TRA`).
- **Quad** (`QM-QM`).
- **Buggy sans permis** (`QMQLEM-QMQLEM`).
- **Corriger camping-car > 3,5 t** (`CAM-Fou`) : la page camping-car ne traite que le ≤ 3,5 t.
Prix de chaque catégorie déjà disponibles dans le barème extrait.

## 🟢 P3 — Améliorations Route A / estimateurs
- **Généraliser** estimateurs + CTA pré-remplis aux pages **camping-car** et **bus**.
- Décider d'une **heure de début par défaut** (ex. 08:00) ou laisser le client choisir.
- (Optionnel) demander à jlassure un **endpoint tarif standalone** pour afficher le prix EXACT en direct sans redirection (aujourd'hui : prix indicatif chez nous + exact après redirection — déjà fonctionnel).

## 🔵 P4 — Réputation / widgets (selon budget)
- **Trustpilot** : widgets dynamiques + Google Seller Ratings = plan payant. Sur plan gratuit : lien + badge (fait). Quand vrais avis : envisager schéma `Review`/`AggregateRating` **uniquement** via une source légitime (pas de note inventée).
- **Schéma `Organization`** reliant site ↔ Trustpilot ↔ Google (quand la fiche Google existe).

## 📊 Suivi
- **Re-mesurer Search Console fin juin** : c'est là qu'on verra l'effet du travail des 11-14 juin (les rapports actuels sont des photos « avant »).
- Re-tester le **parcours IA** (sur Perplexity + en forçant l'IA sur le site) une fois le cache rafraîchi.

## ⚠️ Points à NE PAS oublier (cohérence)
- Toute nouvelle page véhicule doit pointer le **bon code `categorie_vehi`** et la **bonne grille de durées** (PL/bus/remorque/voiturette = durées limitées, pas 1-90).
- **Jamais** afficher : moto, « camion < 3,5 t », âge ≥ 23 comme minimum, prix 90 j à 290,16 €.
- **Jamais** exposer en public : coûts/marges jlassure, prix concurrents.
