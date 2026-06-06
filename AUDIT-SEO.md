# Audit SEO — tempo-assurance.com

> Date de l'audit : 2026-06-06
> Périmètre : site statique HTML (généré par WebSite X5) + blog PHP
> Méthode : analyse on-page page par page (balises `<title>`, méta-description, structure Hn, balisage sémantique, données structurées, Open Graph, images/alt, maillage, fichiers techniques).

---

## 1. Synthèse exécutive

Le site dispose de bonnes bases (titles et descriptions présents et largement uniques, balise `lang`, `viewport`, une seule `<h1>` par page, en-têtes de sécurité). Les axes d'amélioration prioritaires sont **transversaux** :

| Priorité | Problème | Impact | Effort |
|----------|----------|--------|--------|
| 🔴 Haute | Aucune balise `<link rel="canonical">` sur aucune page | Risque de contenu dupliqué (`/` vs `/index.html`, http/https/www) | Faible |
| 🔴 Haute | Aucune donnée structurée JSON-LD (Organization, LocalBusiness, FAQPage, Article, BreadcrumbList) | Pas d'éligibilité aux rich results | Moyen |
| 🔴 Haute | Aucune balise `og:image` ni Twitter Card | Partages sociaux sans visuel → faible CTR | Faible |
| 🟠 Moyenne | Pages utilitaires (`404`, `confirmation-mail`) sans `meta robots noindex` | Pages parasites indexables | Faible |
| 🟠 Moyenne | Fautes d'orthographe en dur (titres, URL, contenu) | Crédibilité + pertinence sémantique | Moyen |
| 🟠 Moyenne | Sitemap : priorités toutes à 0.5, `lastmod` incohérents, 2 pages manquantes, URLs blog en `?query` | Crawl/priorisation sous-optimaux | Faible |
| 🟡 Basse | Pas de `loading="lazy"`, pas d'`apple-touch-icon`, pas de hreflang | Perf / mobile / international | Faible |
| 🟡 Basse | Contenu mince sur certaines pages, structure Hn absente (h2/h3) hors accueil | Profondeur sémantique | Moyen |

---

## 2. Constats transversaux (toutes pages)

### 2.1 Balise canonique — ❌ absente partout
Aucune des 13 pages ne déclare `<link rel="canonical">`. Le site est accessible via plusieurs variantes (`http`/`https`, avec/sans `www`, `/` vs `/index.html`). Le `.htaccess` gère bien les redirections 301, mais une canonique explicite reste recommandée.
**Action :** ajouter sur chaque page `<link rel="canonical" href="https://www.tempo-assurance.com/{page}.html" />` (URL absolue auto-référente).

### 2.2 Données structurées (schema.org / JSON-LD) — ❌ absentes
Aucun bloc `application/ld+json`. Recommandations :
- **Toutes pages** : `Organization` (ou `InsuranceAgency` / `LocalBusiness`) avec logo, nom, URL, téléphone, adresse.
- **Accueil** : `WebSite` + `SearchAction` éventuel.
- **Blog (FAQ)** : `FAQPage` — le contenu du blog est un Q/R parfait pour ce balisage.
- **Pages news** : `Article`/`NewsArticle` (headline, datePublished, image, author).
- **Toutes pages** : `BreadcrumbList`.

### 2.3 Open Graph / Twitter — ⚠️ incomplet
Chaque page a 6 balises OG (`locale`, `type`, `url`, `title`, `site_name`, `description`) avec `og:url` correctement unique par page ✅. **Mais aucune `og:image`** et **aucune Twitter Card**.
**Action :** ajouter `og:image` (1200×630), `twitter:card=summary_large_image`, `twitter:title/description/image`.

### 2.4 Méta keywords — ⚠️ obsolète
Toutes les pages utilisent `<meta name="keywords">`, ignoré par Google depuis 2009. Sans danger mais inutile ; à supprimer pour alléger le code.

### 2.5 Images
- `loading="lazy"` absent partout → ajouter sur les images sous la ligne de flottaison (perf / Core Web Vitals).
- `apple-touch-icon` absent → ajouter pour iOS.
- Un `alt` manquant détecté (voir page `news---mise-en-fourriere.html`).

### 2.6 Internationalisation
Pas de balises `hreflang`. Acceptable si la cible est 100 % FR ; à prévoir si extension DOM/étranger envisagée (cf. page « Extension DOM »).

### 2.7 Fichiers techniques

**`robots.txt`** — ⚠️
```
Disallow: /blog/index.php?start=0&amp;length=20
Disallow: /blog/index.php?start=20&amp;length=20
```
Le `&amp;` est une entité HTML : dans un `robots.txt` il faut un `&` littéral, sinon la règle ne matche pas. Corriger en `&`.

**`sitemap.xml`** — ⚠️
- Toutes les `priority` sont à `0.5` → la page d'accueil devrait être à `1.0` et les pages de conversion (devis) plus hautes que les mentions légales.
- `lastmod` incohérents : pages racine au `2026-05-26`, articles blog figés au `2017-08-30`.
- Pages **absentes** : `confirmation-mail.html` (normal, à laisser hors sitemap) et `espace-professionel.html` (à ajouter si destinée à être indexée).
- Les URLs blog en `?query` (`/blog/?question...`) sont indexables mais peu lisibles ; préférer des URLs réécrites à terme.

**`.htaccess`** — ⚠️ 2 points
- Redirection non-www : `RewriteRule ^(.*)$ http://www.%{HTTP_HOST}/$1` force `http://` puis une 2ᵉ redirection passe en `https`. Cela crée une **chaîne de redirections** (301→301). Rediriger directement en `https://www.`.
- En-tête `Content-Security-Policy "'self';"` est **malformé** : `'self'` n'est pas une directive. Il faut `default-src 'self'; ...`. En l'état la politique est probablement ignorée ou trop restrictive.

---

## 3. Audit page par page

### 🏠 `index.html` — Accueil
- **Title** (69) : « Tempo-Assurance, Assurance temporaire et frontière - Tempo-assurance » ✅ bonne longueur, mais redondance « Tempo-Assurance … - Tempo-assurance ».
- **Description** (165) ✅ longueur idéale, riche en mots-clés.
- **H1** : « Tempo-Assurance, le spécialiste de l'assurance temporaire » ✅ (diffère du title = bien).
- **Structure** : 7 × `<h2>`, 0 `<h3>` ✅ bonne hiérarchie.
- **Contenu** : ~1022 mots ✅.
- **Images** : 6, toutes avec `alt` ✅, mais pas de lazy-load.
- ⚠️ **Faute** : occurrence « professionel » (manque un « n ») dans le contenu.
- **Actions** : canonical, JSON-LD `WebSite`+`Organization`, `og:image`, dédoublonner le branding dans le title, corriger « professionnel ».

### 📝 `devis-ou-souscription.html` — Conversion (page clé)
- **Title** (83) : ❌ **trop long** (>60), tronqué en SERP. « Souscrire une assurance temporaire pas cher directement en ligne. » → raccourcir (ex. « Souscrire une assurance temporaire pas chère en ligne | Tempo »).
- **Description** (162) ✅.
- **H1** ✅ unique.
- **Structure** : ❌ **0 h2/h3** → ajouter des sous-titres (étapes de souscription, garanties, durées 1–90 j).
- **Contenu** : ~569 mots, correct.
- ⚠️ **Fautes** : « soucription » / « soucrire » présentes.
- **Priorité sitemap** : page de conversion à monter en priorité.
- **Actions** : raccourcir title, ajouter Hn, corriger fautes, JSON-LD (Service/Offer), canonical, og:image.

### 💶 `tarif-assurance-temporaire.html`
- **Title** (44) ✅.
- **Description** (51) : ⚠️ **trop courte** (« Echantillon de tarif de l'assurance temporaire. ») → enrichir à ~150 car. avec fourchettes de prix, types de véhicules.
- **H1** ✅. **Structure** : ❌ 0 h2/h3.
- **Contenu** : ~473 mots.
- **Actions** : enrichir description, structurer en Hn (tarifs auto/moto/camion), JSON-LD `Offer`/table de prix, canonical.

### 📄 `documentation-assurance-tempo.html`
- **Title** (47) ✅. **Description** (119) ✅.
- **H1** ✅.
- **Contenu** : ❌ ~234 mots → **contenu mince** ; étoffer (liste des documents, CG/CP, FAQ liée).
- **Actions** : enrichir contenu, ajouter liens vers les PDF avec `alt`/intitulés explicites, canonical.

### 👔 `espace-professionel.html`
- ❌ **Faute dans le nom de fichier / URL** : « professionel » (1 seul « n »). Une URL est difficile à corriger après indexation, mais à arbitrer (renommer + 301, ou conserver). 9 occurrences du mot mal orthographié sur la page.
- **Title** (37) ✅. **Description** (76) ⚠️ un peu courte.
- **H1** ✅. **Contenu** : ~432 mots.
- ⚠️ Page **absente du sitemap** — décider : indexable (l'ajouter) ou privée (`noindex`).
- **Actions** : corriger « professionnel » dans le contenu, statuer sur l'indexation, canonical.

### ✉️ `contact.html`
- **Title** (60) ✅. **Description** (171) : ⚠️ légèrement longue (>160), risque de troncature.
- **H1** ✅. 1 image avec alt ✅.
- **Actions** : raccourcir la description, JSON-LD `ContactPage`/`Organization` (tél, email, horaires), canonical, og:image.

### ⚖️ `mentions-legales.html`
- **Title** (35) ✅. **Description** (163) ⚠️ limite.
- **H1** ✅.
- **Recommandation SEO** : page nécessaire mais à faible valeur de recherche → la garder `index` est OK, baisser sa priorité sitemap (0.1–0.3).
- **Actions** : canonical.

### 📰 Pages News (×4)
| Page | Title | Desc | Remarque |
|------|-------|------|----------|
| `news---blocage-des-tarifs.html` | 43 ✅ | 147 ✅ | OK |
| `news---extension-dom.html` | 38 ✅ | 64 ⚠️ courte | + fautes keywords « Extenson », « Gaudeloupe », « Guyanne » |
| `news---jl-assure-la-solution.html` | 46 ✅ | 88 ⚠️ courte | OK |
| `news---mise-en-fourriere.html` | 43 ✅ | 73 ⚠️ courte | ❌ 1 image **sans alt** ; fautes keywords « fouttière », « défut » |

- **Communs** : préfixe « News - … » dans le H1 et le title → peu engageant ; préférer un titre éditorial.
- **Actions** : enrichir les descriptions courtes, ajouter l'`alt` manquant, JSON-LD `NewsArticle` (date, image, auteur), corriger fautes, `BreadcrumbList`, og:image.

### 🚫 `404.html`
- **Title/Description/H1** présents ✅.
- ❌ Manque `<meta name="robots" content="noindex,follow">`.
- Bien servie via `ErrorDocument 404` dans `.htaccess` ✅.
- **Action** : ajouter `noindex`. (Déjà hors sitemap ✅.)

### ✅ `confirmation-mail.html`
- Page de remerciement post-formulaire.
- ❌ Manque `<meta name="robots" content="noindex,follow">` (page sans valeur SEO, ne doit pas être indexée).
- Bien **absente du sitemap** ✅.
- **Action** : ajouter `noindex`.

### 🔧 `google5cf29f286db93f8c.html`
- Fichier de vérification Google Search Console (vide, normal). ✅ Aucune action — ne pas modifier.

### 📰 `blog/` (PHP — WebSite X5 Blog)
- Articles servis via `index.php?question` (≈ 25 entrées dans le sitemap).
- **Opportunités** : contenu Q/R = idéal pour `FAQPage` JSON-LD ; vérifier que chaque article expose un `title`/`description`/`canonical` uniques (non analysable statiquement ici car généré côté serveur).
- **robots.txt** bloque la pagination `?start=` mais avec `&amp;` invalide (cf. §2.7).
- **Action** : audit dynamique séparé recommandé (rendu réel des pages blog).

---

## 4. Plan d'action priorisé

**Quick wins (effort faible, impact fort)**
1. Ajouter `<link rel="canonical">` auto-référent sur les 13 pages.
2. Ajouter `og:image` + Twitter Cards (visuel 1200×630).
3. Ajouter `noindex` sur `404.html` et `confirmation-mail.html`.
4. Corriger `robots.txt` (`&amp;` → `&`) et la chaîne de redirection + CSP dans `.htaccess`.
5. Corriger le sitemap : `priority` différenciées, `lastmod` à jour, ajouter/statuer `espace-professionel`.

**Moyen terme**
6. Déployer le JSON-LD (Organization sur tout le site, FAQPage sur le blog, NewsArticle sur les news, BreadcrumbList).
7. Raccourcir le title de `devis-ou-souscription`, enrichir les descriptions courtes (tarif, news, espace pro).
8. Ajouter une structure Hn (h2/h3) sur `devis` et `tarif`.
9. Corriger les fautes d'orthographe en dur (« professionnel », « souscription/souscrire », « fourrière », « défaut », « Extension », « Guadeloupe », « Guyane »).
10. Ajouter l'`alt` manquant sur `news---mise-en-fourriere.html`.

**Fond**
11. Étoffer le contenu mince (`documentation-assurance-tempo`).
12. `loading="lazy"` + `apple-touch-icon`.
13. Statuer sur le renommage de l'URL `espace-professionel` (301 si correction).
14. Audit dynamique du blog (rendu PHP réel).

---

*Audit on-page statique. Un audit complémentaire (Core Web Vitals / PageSpeed, backlinks, exploration Search Console, rendu réel du blog PHP) est recommandé pour compléter ces constats.*
