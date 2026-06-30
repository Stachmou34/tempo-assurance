# À faire — backlog priorisé

> Document interne. Mis à jour : 2026-06-21.

## 🔴 P0 — Être trouvé/cité par les IA et les moteurs (« étage 1 »)
Tout le pré-remplissage est prêt, mais une IA ne nous recommande que si elle nous **trouve**. Leviers (SEO + réputation) :
1. **Fiche Google Business Profile** (MCJ Courtage / Tempo-Assurance) — levier n°1, gratuit. À créer + faire vérifier.
2. **Collecte d'avis** (Google + Trustpilot) : envoyer le lien d'invitation après souscription.
3. **Indexation Search Console** : renvoyer le sitemap + « Demander l'indexation » des pages prioritaires.
4. **Backlinks** : annuaire ORIAS (maintenant qu'on a le n° 26008651), annuaires assurance, partenaires.

## 🟠 P1 — Application ChatGPT (✅ PUBLIÉE par OpenAI, juin 2026)
- ✅ Revue OpenAI passée — l'app est en ligne dans ChatGPT (annoncée sur Actualités + llms.txt).
- **Promouvoir** : encart « Disponible sur ChatGPT » sur l'accueil, post réseaux, suivi de l'usage (référents chatgpt.com dans GA4).
- **Render** : passer en plan **Starter** (éviter le cold start) et **régénérer la clé `JLASSURE_API_KEY`** (elle a transité en clair une fois) — clé à garder en variable d'environnement uniquement.
- **Phase 2 (pré-remplissage zéro formulaire)** : ne l'activer (`ENABLE_PREFILL_SESSION`) qu'après **feu vert RGPD** (consentement explicite + information).

## 🟡 P2 — Tarificateur (marque blanche) : suite
- **Envoyer la note à JL Assure** (`docs/note-jlassure-tarificateur-page1.md`) et **poser la question du thème par client** (couleurs/logo/ORIAS via `id=43`).
- Selon leur réponse : suivre les évolutions du moteur partagé (min-height 100vh, encadré valeur visible, PTAC conditionnel, impasses silencieuses, spinner, etc.).
- ✅ **MàJ tunnel JL Assure (2026-06) intégrée** : suppression `ptac` + `motif` (9 étapes, PTAC auto, dates JJ-MM-AAAA). **À re-tester en prod** : URLs pré-remplies + mobile (saisie des dates, suite antécédents), camping-car CC-Cap/CAM-Fou. Contact : christophe.p@jlassure.com.

## 🟡 P3 — Pages catégories manquantes (SEO + couverture devis)
À créer sur le modèle auto/utilitaire/camion (estimateur + CTA pré-rempli) :
- **Voiturette sans permis** (`VSP-VSP`), **Remorque/semi** (`REM-REM2`) + **Caravane** (`REM-REM3`), **Tracteur agricole** (`TRA-TRA`), **Quad** (`QM-QM`), **Buggy sans permis** (`QMQLEM-QMQLEM`).
- **Corriger camping-car > 3,5 t** (`CAM-Fou`) : la page camping-car ne traite que le ≤ 3,5 t.

## 🟢 P4 — Améliorations Route A / estimateurs
- Généraliser estimateurs + CTA pré-remplis aux pages **camping-car** et **bus**.
- (Optionnel) endpoint tarif standalone jlassure pour le prix EXACT sans redirection (le réel passe déjà par l'app ChatGPT).

## 🔵 P5 — Réputation / divers (parkés)
- Trustpilot widgets dynamiques / Google Seller Ratings (plan payant) ; schéma `Review`/`AggregateRating` **uniquement** via source légitime.
- **Palette de couleurs** du site (parkée) ; **e-mail d'avis à J+3** (parké) ; multi-modèle (Claude/REST) pour l'app (parké).

## 📊 Suivi
- **Re-mesurer Search Console** régulièrement.
- Re-tester le **parcours IA** (Perplexity + ChatGPT) après rafraîchissement du cache.

## ⚠️ Points à NE PAS oublier (cohérence)
- Nouvelle page véhicule = **bon code `categorie_vehi`** + **bonne grille de durées**.
- **Jamais** afficher : moto, « camion < 3,5 t », âge ≥ 23 comme minimum, prix 90 j à 290,16 €.
- **Jamais** exposer en public : coûts/marges jlassure, prix concurrents, clé d'API.
