# Avancement — ce qui a été fait

> Document interne. Mis à jour : 2026-06-14. Branche : `claude/geo-pages-reponses`.

## 1. Conformité produit
- **Moto retirée** : la FAQ déclarait couvrir « motos ≥ 125 cm³ » (en JSON-LD) — garantie inexistante → supprimée.
- **Dérives « Italie / targa di cartone »** supprimées (page Italie, FAQ, accueil).
- **Frontière** : durées corrigées « 15/30 » → **30 ou 90 jours** ; mention exclusion **Pologne/Roumanie/Italie** à l'immatriculation.
- **Âge** : « 20 / 23 ans » → **21 ans** partout (FAQ, pages, llms.txt).
- **Durée camion FAQ** « 1-15 » cohérence ; caption tarif « < 23 CV » → **« ≤ 30 CV »**.

## 2. Correction de prix (important)
- **90 jours voiture : 290,16 € → 420,21 €** (et « 3,22 €/jour » → **4,67 €/jour**). Le 290,16 € était le tarif **60 jours**. Vérifié via la formule `get_tarifs.php` (`prix_achat + marge_brute + frais 7 €`) et la centrale (420,23 €). Corrigé partout (tarif, pages durée, FAQ, llms.txt, schémas).

## 3. SEO technique
- **Canonical accueil** → racine `/` (au lieu de `/index.html`) + og:url + sitemap alignés.
- **Title/meta** : page tarif et accueil réécrits.
- **Fil d'ariane visible + schema BreadcrumbList** sur 26 pages.
- **Ordre des titres** (h1→h2→h3) rétabli (footer h3→h2 ; h2 « Nos engagements » sur l'accueil ; h1 FAQ restauré).
- **Fix mobile** : icône menu corrompue « ³0 » → **☰** (37 pages).

## 4. Contenu / pages
- **8 pages créées** (réécrites uniques, anti-templated) : durées **2 j, 3 j, 15 j, 2 mois, 3 mois** ; situations **contrôle technique, week-end, plaque WW**.
- **Page Auto (voiture, VL-VL)** créée — n'existait pas.
- **Page Utilitaire / fourgon (VL-VU)** créée.
- **Page Camion corrigée** : catégorie **CAM-CAM3 > 3,5 t**, durée 1-15 j, sans assistance.
- **Poids-lourd** consolidée → camion (canonical → camion, retirée du sitemap). *Reste : 301 côté hébergeur.*
- Maillage : nav + footer + accueil + annuaire véhicules mis à jour (Auto/Utilitaire ajoutés, Poids lourd retiré), pastilles hero accueil corrigées.

## 5. GEO (référencement IA)
- **`llms.txt`** : présent et à jour — résumé, faits clés, **barème indicatif par catégorie** (prix publics IFRAMEUR), **recette du lien de devis pré-rempli**, liste des pages.
- **`robots.txt`** : accès explicitement autorisé aux bots IA (GPTBot, ClaudeBot, PerplexityBot, Google-Extended…) + Sitemap.

## 6. Route A — devis assisté par IA (FONCTIONNE, testé live)
- `assets/site.js` : relais d'une **liste blanche de 12 paramètres** d'URL vers l'iframe (page devis + modale). Garde anti-injection, accepte la valeur `0`, cache-bust `?v=3`.
- **Estimateurs on-page** (durée → prix indicatif) sur **auto, utilitaire, camion** ; CTA pré-remplis (bonne catégorie).
- **ptac + motif=achat_vente** ajoutés par défaut aux liens (Poids + Motif remplis).
- **Test live OK** : appel du formulaire jlassure avec params → champs `pref_*` injectés (categorie, ptac, motif, duree, dates, pays, âge…). Valeur invalide ignorée sans erreur.
- jlassure a **déployé** le pré-remplissage GET en prod le 2026-06-14.

## 7. Réputation
- **Badge Trustpilot** (lien profil) dans le footer des 37 pages, sans note inventée.

## 8. Données tarifaires (référence)
- Barème **IFRAMEUR « avec frais de courtage »** extrait de la centrale jlassure pour toutes les catégories/durées (scénario standard : conducteur ≥ 23 ans, véhicule < 10 ans). Sert au site/llms.txt. **Prix publics uniquement** (jamais les coûts/marges).

## Historique des PR (vers `main`)
- **#30** mergée — conformité, SEO/GEO, contenu, accessibilité, réputation.
- **#31** mergée — âge 21 ans.
- **#32** mergée — Route A (relais params), correction prix 90 j, barème llms.txt, estimateur camion, corrections QA.
- **#33** mergée — pages Auto + Utilitaire, correction catégorie Camion.
- **#34** ouverte — ptac + motif par défaut, pastilles hero, cohérence liens/llms.txt.
