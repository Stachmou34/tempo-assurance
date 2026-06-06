# Plan d'implémentation SEO — tempo-assurance.com

> Date : 2026-06-06 · Branche : `claude/upbeat-cerf-yjyYC`
> Document de référence pour l'exécution des correctifs identifiés dans `AUDIT-SEO.md` (constats on-page) et complétés par les données Search Console (§5-6 de l'audit).

---

## ⚠️ Point d'attention préalable — site généré par WebSite X5

Le site est **généré automatiquement par WebSite X5** (voir en-têtes `WebSite X5` dans `.htaccess`, scripts `x5engine.js`, dossiers `pluginAppObj/`). Conséquence majeure :

> **Toute modification manuelle des fichiers HTML sera ÉCRASÉE au prochain export depuis le logiciel X5.**

**Décision à prendre avant de coder** (voir « Question ouverte » en fin de doc) :
- **Option A — Édition HTML directe** (ce plan) : rapide, mais à reporter dans le projet X5 ou à refaire après chaque export.
- **Option B — Tout faire dans le projet X5** : pérenne, mais nécessite l'accès au fichier projet `.iwzip` et le logiciel (hors de ce dépôt).
- **Option C — Hybride** : éléments serveur (`.htaccess`, `robots.txt`, `sitemap.xml`) édités ici (non régénérés par X5), + le reste documenté pour report dans X5.

Ce plan décrit l'**Option A/C** (ce qu'on peut faire dans ce dépôt). Les modifs purement HTML sont signalées 🟡 « à reporter dans X5 ».

---

## Structure type des pages (constat)

Toutes les pages partagent le même gabarit `<head>`. Ancres fiables pour des édits scriptables :
- ligne `<meta name="keywords" ... />` (présente partout)
- bloc des 6 balises `<meta property="og:..." />`
- ligne `<meta name="viewport" ... />`
- chaque page possède déjà un `og:url` **unique et correct** → réutilisable pour générer le `canonical`.

---

## Sprint 1 — Quick wins techniques (effort faible / impact fort)

### 1.1 Balises canoniques 🟡 (toutes pages)
Pour chacune des 13 pages : insérer après le bloc OG
```html
<link rel="canonical" href="https://www.tempo-assurance.com/{page}.html" />
```
- URL dérivée du `og:url` existant de chaque page.
- **Exclure** `404.html` et `google5cf29f286db93f8c.html`.
- *Méthode* : script `sed`/`Edit` ciblant la balise `viewport` comme point d'insertion.

### 1.2 `noindex` sur pages utilitaires 🟡
- `404.html` et `confirmation-mail.html` : ajouter
  ```html
  <meta name="robots" content="noindex,follow" />
  ```

### 1.3 `robots.txt` ✅ (éditable ici)
- Remplacer `&amp;` par `&` dans les 2 lignes `Disallow` blog.
- Vérifier la cohérence avec le sitemap.

### 1.4 `.htaccess` ✅ (éditable ici)
- **Chaîne de redirection** : faire pointer la règle non-www directement vers `https://www.` (au lieu de `http://www.` puis 2ᵉ saut).
  ```apache
  RewriteCond %{HTTP_HOST} !^www\. [OR]
  RewriteCond %{HTTPS} !=on
  RewriteRule ^ https://www.tempo-assurance.com%{REQUEST_URI} [R=301,L]
  ```
- **CSP malformé** : `Content-Security-Policy "'self';"` → corriger en directive valide, p. ex.
  `default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline';`
  ⚠️ **À tester** sur préprod : une CSP trop stricte peut casser l'affichage (X5 utilise du JS/CSS inline). Démarrer en `Content-Security-Policy-Report-Only` recommandé.

### 1.5 `sitemap.xml` ✅ (éditable ici)
- `priority` différenciées : accueil `1.0`, devis/tarif `0.8`, news/blog `0.6`, mentions légales `0.3`.
- `lastmod` cohérents et à jour.
- Ajouter `espace-professionel.html` (si indexable) ; **ne pas** ajouter `confirmation-mail.html`.

### 1.6 Open Graph image + Twitter Cards 🟡
- Créer/choisir un visuel `images/og-default.jpg` (1200×630, logo + accroche).
- Sur chaque page, après le bloc OG :
  ```html
  <meta property="og:image" content="https://www.tempo-assurance.com/images/og-default.jpg" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="{title}" />
  <meta name="twitter:description" content="{description}" />
  <meta name="twitter:image" content="https://www.tempo-assurance.com/images/og-default.jpg" />
  ```

**Livrable Sprint 1** : 1 commit « technique » (robots/htaccess/sitemap) + 1 commit « head » (canonical/noindex/OG-Twitter).

---

## Sprint 2 — Marque & CTR (le plus rentable au vu des impressions GSC)

> Données : `assur tempo` (24 impr, 0 clic), `jl assure` (13), `assurance tempo` (8) → marque mal captée. Site n°1 uniquement sur `tempo assurance`.

### 2.1 JSON-LD `Organization` 🟡 (toutes pages, dans `<head>`)
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "InsuranceAgency",
  "name": "Tempo-Assurance",
  "alternateName": ["Assur Tempo", "JL Assure"],
  "url": "https://www.tempo-assurance.com/",
  "logo": "https://www.tempo-assurance.com/images/{logo}.png",
  "telephone": "{à compléter depuis contact/mentions}",
  "address": { "@type": "PostalAddress", "addressCountry": "FR" }
}
</script>
```
- ⚠️ Récupérer **téléphone / raison sociale / adresse** depuis `contact.html` et `mentions-legales.html` avant de remplir (ne pas inventer).

### 2.2 Title / description / H1 d'accueil 🟡
- Intégrer les variantes de marque réellement recherchées (« Assur Tempo », « JL Assure ») dans le `<title>` et/ou le `<h1>` et le contenu d'intro.
- Objectif : améliorer le CTR sur les requêtes de marque actuellement à 0 clic.
- Dédoublonner le branding (« Tempo-Assurance … - Tempo-assurance »).

### 2.3 Correction des fautes en dur 🟡 (crédibilité de marque)
| Faute | Correct | Fichier(s) |
|-------|---------|-----------|
| professionel | professionnel | `index.html` (1×), `espace-professionel.html` (9×) |
| soucription / soucrire | souscription / souscrire | `devis-ou-souscription.html` |
| fouttière | fourrière | `news---mise-en-fourriere.html` |
| défut | défaut | `news---mise-en-fourriere.html` (keywords) |
| Extenson | Extension | `news---extension-dom.html` (keywords) |
| Gaudeloupe / Guyanne | Guadeloupe / Guyane | `news---extension-dom.html` (keywords) |

- ⚠️ Le **nom de fichier** `espace-professionel.html` : ne PAS renommer sans 301 (cf. §1 audit). Corriger seulement le **contenu visible** dans ce sprint ; arbitrer le renommage URL au Sprint 4.

**Livrable Sprint 2** : commit « marque » (JSON-LD + accueil) + commit « orthographe ».

---

## Sprint 3 — Page de conversion (`devis-ou-souscription`, pos 25 → page 1)

### 3.1 On-page 🟡
- Raccourcir le `<title>` (<60 car.), ex. « Souscrire une assurance temporaire pas chère en ligne | Tempo ».
- Ajouter une **structure Hn** : `<h2>` étapes de souscription, durées (1-90 j), garanties, véhicules couverts.
- Corriger « soucription/soucrire » (Sprint 2).

### 3.2 Données structurées 🟡
- JSON-LD `Service` / `Offer` (type de couverture, zone, durée).

### 3.3 Maillage interne 🟡
- Liens contextuels vers `devis-ou-souscription.html` depuis l'accueil, le blog et les news (ancres « souscrire en ligne », « obtenir un devis »).

**Livrable Sprint 3** : commit « optimisation page devis ».

---

## Sprint 4 — Contenu (gap véhicules + striking distance)

> Données : demande par type de véhicule sans page dédiée (`camion` pos 9, `bus` 6,7, `poids lourd` 13,5, `camping-car` — déjà 1 clic à la pos 33).

### 4.1 Landing pages dédiées 🟡 (fort levier)
Créer, sur le gabarit existant :
- `assurance-temporaire-camion.html`
- `assurance-temporaire-poids-lourd.html`
- `assurance-temporaire-bus.html`
- `assurance-temporaire-camping-car.html`

Chacune : title/H1/description ciblés, contenu ~500 mots, JSON-LD `Offer`, canonical, ajout au sitemap, liens depuis accueil + devis.
- ⚠️ En contexte X5 : ces pages devront idéalement être créées **dans le projet X5** pour rester cohérentes avec le menu/footer générés.

### 4.2 Striking distance 🟡
- Renforcer le contenu existant pour `assurance temporaire en ligne` (pos 16), `assurance 24h voiture` (17,7), `camion` (9).

### 4.3 Blog : `FAQPage` 🟡
- Injecter le balisage `FAQPage` sur les Q/R du blog (généré par `blog/index.php` → modif côté template PHP, pas HTML statique).
- Enrichir les réponses les plus vues (`attestation assurance provisoire`, `carte grise barrée`, `assurance provisoire 24h/24`).

### 4.4 Arbitrage URL espace pro 🟡
- Décider : renommer `espace-professionel.html` → `espace-professionnel.html` **avec redirection 301** dans `.htaccess`, ou conserver.

**Livrable Sprint 4** : 1 commit par landing page + commit blog/FAQ.

---

## Sprint 5 — Finitions

- `loading="lazy"` sur images hors écran 🟡
- `apple-touch-icon` + manifest 🟡
- Supprimer `<meta name="keywords">` (inutile) 🟡
- Ajouter l'`alt` manquant sur `news---mise-en-fourriere.html` 🟡

---

## Récapitulatif & séquencement

| Sprint | Thème | Fichiers | Régénéré par X5 ? | Priorité |
|--------|-------|----------|-------------------|----------|
| 1 | Technique + head | robots, htaccess, sitemap, `<head>` ×13 | head 🟡 / serveur ✅ | 🔴 |
| 2 | Marque & CTR | JSON-LD, accueil, fautes | 🟡 | 🔴 |
| 3 | Page devis | `devis-ou-souscription.html` + maillage | 🟡 | 🔴 |
| 4 | Contenu | 4 landing pages, blog PHP | 🟡 | 🟠 |
| 5 | Finitions | images, icônes, keywords | 🟡 / ✅ | 🟡 |

**Validation** : chaque sprint → vérif manuelle d'une page (rendu + balises), puis push. Suivi des positions sur GSC à J+30 / J+90.

---

## ❓ Questions ouvertes (à trancher avant exécution)

1. **Mode d'édition** : on édite directement le HTML de ce dépôt (Option A, rapide mais écrasable par X5) ou on se limite aux fichiers serveur + doc pour X5 (Option C, pérenne) ?
2. **Coordonnées** pour le JSON-LD `Organization` : confirmer téléphone / raison sociale / adresse (à extraire de `mentions-legales.html`).
3. **Visuel OG** : fournir une image de marque 1200×630 ou en générer une simple à partir du logo ?
4. **Renommage URL** `espace-professionel` : on corrige avec 301, ou on laisse en l'état ?
5. **CSP** : peut-on tester sur préprod avant prod (risque de casser l'affichage) ?

---

*Une fois ces points tranchés, je peux exécuter sprint par sprint, un commit ciblé par lot, sur `claude/upbeat-cerf-yjyYC`.*
