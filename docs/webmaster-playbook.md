# Playbook webmaster — tempo-assurance.com

> Référentiel de travail pour toute intervention sur le site, et base de la routine quotidienne.
> Mis à jour le 25/09/2026.

## 1. Le principe qui prime sur tous les autres

**Mesurer avant de décider.** Sur ce site, trois hypothèses de bon sens ont été
invalidées par les données. Ne jamais repartir d'une intuition SEO générique.

| Hypothèse plausible | Ce que disent les données | Statut |
|---|---|---|
| « Les pages minces ne sont pas indexées » | Les **58 URLs sont indexées** (URL Inspection API, 25/09/2026) | FAUX |
| « Il faut étoffer les pages minces pour monter » | Pages < 350 mots : position 11,6. Pages ≥ 350 mots : 10,8. `belgique.html` = 264 mots, position 4,3 | FAUX |
| « Réécrire les meta descriptions va gagner des clics » | Inutile en position 12-18. Les CTR faibles en page 1 étaient un artefact des sitelinks de marque | FAUX |
| « Les autres domaines cannibalisent tempo » | Ils pèsent 2,8 % des impressions et perdent sur toutes les requêtes communes | FAUX |

**Le seul vrai problème du site est la POSITION, pas l'indexation ni le volume de contenu.**

## 2. État de référence (25/06 → 24/09/2026)

- Search Console : **161 891 impressions, 4 065 clics, CTR 2,51 %, position moyenne 12,5**
- GA4 : 11 140 sessions, 7 731 utilisateurs, 58,7 % de sessions engagées
- Marque saine : « tempo assurance » = 850 clics, position 1,2, CTR 46,8 %
- L'accueil porte le site : 59 077 impressions (36 %), 48 % des clics, mais position 13,5 sur les têtes de gondole

### Taux d'ouverture du tarificateur par page (proxy de conversion)
camping-car 78 % · plaque-ww 76 % · utilitaire 75 % · **auto 74 %** · véhicule importé 66 %
caravane 63 % · belgique 50 % · tunisie 47 % · frontière 42 % · **accueil 41 %** · tarifs 31 %

### Taxonomie des evenements (corrigee le 25/09/2026)

| Evenement | Declencheur | Ce qu'il mesure |
|---|---|---|
| `ouverture_tarificateur` | clic sur un `.cta-btn-modal` (assets/site.js) | une **intention** : le visiteur ouvre volontairement le tarificateur |
| `affichage_tarificateur` | chargement de `devis-ou-souscription.html` (script inline) | un **affichage** : le tunnel est montre d'emblee, sans action |

> Avant le 25/09/2026 les deux portaient le meme nom, ce qui gonflait la metrique
> d'intention (2 798 declenchements pour 2 800 vues sur la page devis). Les donnees
> anterieures a cette date sont donc a lire avec cette reserve : sur la page devis,
> `ouverture_tarificateur` valait pour une vue de page, pas pour un clic.

## 3. Règles produit à ne jamais enfreindre

- Durées **1 à 90 jours**. Conducteur **21 ans minimum**, permis depuis **2 ans et plus**.
  Les tarifs affichés valent pour **23 ans et plus** (légère surprime entre 21 et 22).
- Garanties réelles : **RC + défense et recours**. Assistance en option, **voiture et utilitaire uniquement**.
- **NON couverts** : vol, bris de glace, dommages au véhicule. **Il n'existe pas de formule tous risques.**
  Quand une requête demande « tous risques », répondre franchement et orienter vers un contrat annuel.
- Assureur **HDI Global Specialty**. Courtier **MCJ Courtage, ORIAS 26008651**.
- Interdits absolus : moto, « camion < 3,5 t », annoncer 23 ans comme minimum, prix 90 j à 290,16 €.
- **Aucun prix inventé.** Source unique de vérité : `tarifs.md` (8 grilles par catégorie).
  Attention : la voiturette démarre à 10 jours, les poids lourds s'arrêtent à 15 jours.

## 4. Règles de rédaction

- Apostrophes **droites** (`'`), jamais typographiques.
- **Jamais de tiret cadratin** en prose française (tell d'écriture IA). Virgules ou parenthèses.
- Ton courtier : factuel, sourcé, concret. Pas de « n'hésitez pas », « il est important de », superlatifs creux.
- Toute affirmation juridique ou chiffrée doit porter un lien vers une source fiable
  (service-public, Legifrance, France Assureurs, sécurité routière).
- Liens externes systématiquement en `target="_blank" rel="noopener"`.

## 5. Contraintes techniques

- Site statique, pas de build. Chaque page embarque d'énormes blocs `<style>` inlinés sur une seule ligne :
  **ne jamais les modifier ni les reformater**. Idem header, nav, footer, modale, sticky CTA.
- Tout changement de `assets/site.js` impose de **bumper le cache-buster** `site.js?v=N` sur les 58 pages,
  sinon les visiteurs de retour gardent l'ancien JS (incident déjà survenu : menu mobile mort).
- Classes réutilisables : `.tldr .callout .tableau .table-scroll .steps .cards .card .faq-q .btn .cta-btn-modal .breadcrumb .muted .maillage`
- **Ne jamais toucher aux blocs CTA et estimateur** : ce sont eux qui convertissent.

## 6. Contrôles obligatoires avant tout commit

```bash
# tous les JSON-LD parsent
node -e "const fs=require('fs');fs.readdirSync('.').filter(f=>f.endsWith('.html')).forEach(f=>{const h=fs.readFileSync(f,'utf8');[...h.matchAll(/<script type=\"application\/ld\+json\">([\s\S]*?)<\/script>/g)].forEach(m=>{try{JSON.parse(m[1])}catch(e){console.log('ERREUR',f,e.message)}})})"
# apostrophes typographiques et tirets cadratins en prose
grep -l "’" *.html ; grep -o "<p[^>]*>[^<]*—" *.html
```
Plus : rendu sans erreur JS, balises équilibrées, questions FAQ présentes en texte visible.

## 7. Cadence éditoriale

- **Dimanche** : veille auto (`veille-auto.html`), édition n+1, archivage de la précédente
  en `veille-auto-AAAA-MM-JJ.html` avec bandeau « édition archivée ». Voir `blog-calendrier.md`.
- **Lundi** : brève d'actualité dans `actualites.html`.
- Enregistrer toute nouvelle page dans `blog.html`, `sitemap.xml` et `llms.txt`.

## 8. Git

Branche de travail `claude/upbeat-cerf-yjyYC`, PR vers `main`, déploiement par `git pull` sur le serveur.
Quand la PR est mergée, repartir de `origin/main` (ne jamais empiler sur de l'historique déjà mergé).

## 9. Chantiers ouverts

1. **Autorité** : c'est LE levier pour passer de la position 12 à la position 5 sur les têtes de
   gondole. Avis Google et Trustpilot (4/5, 13 avis au 25/09), liens entrants. Tout le reste est secondaire.
2. **Mesure** : la separation des evenements est faite (voir §2). Reste le point bloquant :
   GA4 renvoie toujours `keyEvents = 0`, aucune conversion marquee. Cela se regle dans
   l'interface GA4 (Admin > Evenements > marquer comme evenement cle), pas dans le code.
   Tant que ce n'est pas fait, on ne peut pas savoir si le travail genere des contrats.
3. **Crawl espacé** : certaines pages n'ont pas été recrawlées depuis fin juillet.
4. **Requêtes perdues** à surveiller après la refonte de la page tarifs : « assurance temporaire pas cher »,
   « prix assurance auto temporaire » (elles étaient en position 48 à 67).
5. **Sans demande** : résilié/malus = 3 impressions sur 3 mois. Ne pas investir pour le SEO.
6. **Badge Trustpilot** : maquette validée (variantes A+B+D), pas encore posée sur le site.
   Plan gratuit Trustpilot = 1 seul widget de base, donc badge statique maison + lien vers la fiche.

## 10. Journal des décisions

- **25/09/2026** : simulateur du hero étendu à 10 véhicules avec les grilles réelles de `tarifs.md`.
  Les durées s'adaptent au véhicule (voiturette 10-30 j, poids lourds 1-15 j) : afficher six durées
  figées aurait produit des prix inexistants.
- **25/09/2026** : page `auto` différenciée au lieu d'être redirigée en 301. Elle convertit à 74 %,
  la rediriger aurait détruit la meilleure page commerciale à volume du site.
- **25/09/2026** : article « prêter sa voiture » renforcé plutôt que création d'un article
  « jeune conducteur », qui aurait cannibalisé une page déjà positionnée (12,9).
- **25/09/2026** : `tarifs.md` et `llms.txt` alignés sur « Crédit Mutuel » (ils annonçaient encore CIC,
  ce qui faisait raconter aux IA autre chose que le site).
