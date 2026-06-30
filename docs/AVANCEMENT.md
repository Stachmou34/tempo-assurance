# Avancement — ce qui a été fait

> Document interne. Mis à jour : 2026-06-21. Branche de travail : `claude/upbeat-cerf-yjyYC`.

## 0. Réglementaire
- **ORIAS obtenu : n° 26008651** (remplace « en cours » partout : mentions légales, llms.txt, pages app IA, schémas).

## 1. Conformité produit
- **Moto retirée** (garantie inexistante), **dérives « Italie / targa di cartone »** supprimées.
- **Frontière** : durées **30 ou 90 jours** ; exclusion **Pologne/Roumanie/Italie** à l'immatriculation.
- **Âge** : **21 ans** partout ; caption tarif « ≤ 30 CV ».
- **Adresse postale** retirée partout **sauf mentions légales** ; téléphone unifié **09 78 31 02 93**.

## 2. Prix
- **90 jours voiture : 420,21 €** (4,67 €/jour) — l'ancien 290,16 € était le 60 jours. Corrigé partout.

## 3. SEO technique
- Canonical accueil → racine `/` ; titles/meta réécrits ; fil d'ariane + BreadcrumbList ; ordre des titres ; menu mobile ☰.
- **Poids-lourd** : **301 fait** dans `.htaccess` (`assurance-temporaire-poids-lourd.html → assurance-temporaire-camion.html`) ; page supprimée du repo (canonical pointait déjà vers camion, page orpheline + hors sitemap).
- **Nettoyage** : `assets/site.css` supprimé (orphelin, 0 référence — le site utilise du CSS inline + `assets/site.js`).

## 4. Contenu / pages
- 8 pages durées/situations créées ; pages **Auto** et **Utilitaire** créées ; **Camion** corrigée (CAM-CAM3 > 3,5 t).

## 5. GEO (référencement IA)
- `llms.txt` à jour (faits clés, barème indicatif, recette du lien pré-rempli, **outils WebMCP** documentés, ORIAS).
- `robots.txt` : bots IA autorisés + sitemap. `/docs/` en `Disallow`.

## 6. Route A — devis pré-rempli par lien (live)
- `assets/site.js` : relais d'une **liste blanche de 12 paramètres** vers l'iframe (page devis + modale), défaut heure début = +15 min.
- Estimateurs on-page (auto, utilitaire, camion) + CTA pré-remplis.
- jlassure a déployé le pré-remplissage GET en prod (2026-06-14).

## 7. Application ChatGPT (OpenAI Apps SDK / serveur MCP)
- **Serveur MCP** (`chatgpt-app/`) : Streamable HTTP `/mcp`, widget `ui://widget/devis.html`, outils `devis_assurance_temporaire` (tarif réel ou grille indicative), OCR carte grise (niveaux + **sans hypothèse** : on demande les champs manquants), `echo` re-pricing.
- **Intégration JL Assure** : API **tarif temps réel** + API **session de pré-remplissage sécurisée** (Phase 2) validées en live. Clé d'API en **variable d'environnement uniquement** (jamais commitée).
- **Phase 2 (zéro formulaire / données perso) : OFF** tant que le feu vert RGPD n'est pas donné (`ENABLE_PREFILL_SESSION`).
- **Soumission OpenAI** : dossier, politique de confidentialité (`confidentialite-ia.html`), CGU (`cgu-ia.html`), vérification de domaine, KYB. ✅ **Validée et publiée par OpenAI (juin 2026)** — l'application est en ligne dans ChatGPT. Annoncée sur la page Actualités + llms.txt.

## 8. Tarificateur marque blanche — analyse page 1
- Analyse profonde UI + UX + **vérification JS (aucune erreur)** : `docs/analyse-tarificateur-page1.md`.
- **Note de transmission JL Assure** : `docs/note-jlassure-tarificateur-page1.md` (branding par client vs moteur partagé).
- **Habillage côté Tempo** (ce qu'on maîtrise, l'iframe étant cross-origin) sur `devis-ou-souscription.html` : bandeau de confiance (ORIAS, assureur HDI, attestation immédiate, sans engagement, paiement CIC) + bande garanties + tarif dégressif. Resize dynamique de l'iframe non affecté.
- Visuels avant/après : `docs/visuals/`.

## 9. Réputation
- Badge Trustpilot (lien profil) dans le footer.
