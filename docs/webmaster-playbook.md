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


### Evenement cle GA4 (pose le 25/09/2026)

`ouverture_tarificateur` est desormais **marque comme evenement cle** dans GA4.
Trois consequences a connaitre avant de lire des chiffres :

1. **Ce n'est pas retroactif.** Le comptage demarre au 25/09/2026. Interroger l'API
   sur une periode anterieure renverra toujours `keyEvents = 0`. Ce n'est pas une panne.
2. **Le volume va CHUTER apres le deploiement de la separation des evenements**, parce que
   la page devis cesse de compter ses affichages. Ce n'est pas une regression de trafic,
   c'est le passage d'un comptage faux a un comptage juste.
3. **Compter environ 10 jours** avant d'avoir un volume par page exploitable.

Les trois evenements cles presents avant (`close_convert_lead`, `purchase`, `qualify_lead`)
sont des valeurs par defaut de GA4 que le site n'envoie jamais : ils expliquent le
`keyEvents = 0` initial. `purchase` resterait l'ideal, mais la vente se conclut dans
l'iframe JL Assure, donc hors de portee de la propriete sans action du partenaire.

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
- **La carte verte n'existe plus.** Supprimée en France le **1er avril 2024**
  (décret n° 2023-1152 du 8 décembre 2023). La preuve d'assurance passe par le
  **Fichier des Véhicules Assurés (FVA)**, interrogé sur la plaque, et l'assureur remet un
  **mémo véhicule assuré**. Dire « attestation d'assurance », jamais « carte verte ».
  Argument utile et vrai : un véhicule assuré depuis **moins de 72 heures** peut ne pas encore
  figurer au FVA, donc l'attestation téléchargée reste à conserver. C'est précisément le cas
  d'un contrat d'un jour.
  **Seule exception** : les pays hors reconnaissance automatique (Maroc, Tunisie, Turquie,
  Ukraine, Albanie, Azerbaïdjan, Moldavie, Macédoine du Nord). Là le document existe toujours et
  s'appelle **carte internationale d'assurance** ; on peut ajouter « dite carte verte » une fois
  par page, parce que c'est le mot que les visiteurs cherchent. Le contrôle `verif-qualite.mjs`
  bloque toute autre page qui la mentionne (liste blanche `CV_AUTORISEES`).

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

## 5 bis. Acces aux donnees Google (Search Console et GA4)

**L'acces est automatique.** Le proxy de l'environnement signe les appels grace a un
identifiant d'API stocke dans son coffre : aucun jeton a fabriquer, aucune cle a lire.
Un `curl` sans en-tete d'authentification suffit.

```bash
curl -s https://www.googleapis.com/webmasters/v3/sites

curl -s -X POST -H "Content-Type: application/json" \
  "https://www.googleapis.com/webmasters/v3/sites/sc-domain%3Atempo-assurance.com/searchAnalytics/query" \
  -d '{"startDate":"2026-09-01","endDate":"2026-09-23","dimensions":["query"],"rowLimit":25}'

 curl -s -X POST -H "Content-Type: application/json" \
  "https://analyticsdata.googleapis.com/v1beta/properties/540804517:runReport" \
  -d '{"dateRanges":[{"startDate":"2026-09-01","endDate":"2026-09-23"}],"metrics":[{"name":"sessions"}]}'
```

Propriete Search Console : `sc-domain:tempo-assurance.com`. Propriete GA4 : `540804517`.

En cas d'echec, le code HTTP suffit au diagnostic : voir `docs/acces-donnees-google.md`.

## 6. Contrôles obligatoires avant tout commit

```bash
# tous les JSON-LD parsent
node -e "const fs=require('fs');fs.readdirSync('.').filter(f=>f.endsWith('.html')).forEach(f=>{const h=fs.readFileSync(f,'utf8');[...h.matchAll(/<script type=\"application\/ld\+json\">([\s\S]*?)<\/script>/g)].forEach(m=>{try{JSON.parse(m[1])}catch(e){console.log('ERREUR',f,e.message)}})})"
# apostrophes typographiques et tirets cadratins en prose
grep -l "’" *.html ; grep -o "<p[^>]*>[^<]*—" *.html
```
En pratique, un seul appel couvre tout : `node scripts/verif-qualite.mjs` (même contrôle que la CI).
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

Liste **ordonnée**. Prendre le premier chantier non fait, en entier, et rien d'autre.
Chaque entrée tient dans une session : si ce n'est pas le cas, elle est mal découpée, la
redécouper et le dire dans le rapport.

1. **Badge Trustpilot** (maquette A + B + D validée le 25/09, jamais posée).
   Relever la note réelle sur `https://fr.trustpilot.com/review/tempo-assurance.com` avant
   d'écrire un chiffre. Au 26/09 : **4,2/5 sur 13 avis**. Poser A (rangée de gages de la page
   devis) et B (pastille du hero de l'accueil). Ne **pas** ajouter de balise
   `aggregateRating` : Google n'accepte pas les avis auto-déclarés sur une `Organization`,
   et une pénalité coûterait plus que le gain.
   *Fait quand* : les deux pages affichent la note, le lien ouvre la fiche Trustpilot, et la
   valeur est écrite à un seul endroit par page pour être trouvable au prochain relevé.
2. **Passerelle de paiement** : la FAQ dit encore `CM-CIC p@iement` alors que le reste du site
   dit Crédit Mutuel. Nom actuel probable : Monetico. **Demander au propriétaire**, ne pas deviner.
3. **Crawl espacé** : des pages non recrawlées depuis fin juillet. Vérifier dans Search Console
   quelles pages, et si le `lastmod` du sitemap est bien à jour pour celles-là.
4. **Requêtes perdues** à surveiller après la refonte de la page tarifs :
   « assurance temporaire pas cher », « prix assurance auto temporaire » (position 48 à 67).
5. **Autorité** : c'est LE levier pour passer de la position 12 à la position 5 sur les têtes de
   gondole. Avis Google, liens entrants. Ce chantier ne se règle pas dans le code : il se prépare
   (modèle d'e-mail de demande d'avis, liste de sites à contacter) et se propose au propriétaire.
6. **Mesure** : GA4 renvoie toujours `keyEvents = 0`. Cela se règle dans l'interface GA4
   (Admin > Événements > marquer comme événement clé), pas dans le code, et **ce n'est pas
   rétroactif**. Tant que ce n'est pas fait, on ne sait pas si le travail génère des contrats.
   À rappeler dans le rapport tant que le chiffre reste à zéro.

**Écarté, avec sa raison** : résilié / malus = 3 impressions en 3 mois. Aucune demande, ne pas
investir pour le SEO.

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
- **26/09/2026** : suppression de la **carte verte** sur 40 fichiers. Le site la promettait
  195 fois alors qu'elle n'existe plus depuis le 01/04/2024, et sa propre veille du 19/07 l'écrivait
  noir sur blanc : le site se contredisait et promettait un document inexistant, jusque dans le
  hero de l'accueil et dans 3 balises `<title>`. Conservée, sous son vrai nom, sur les 4 pages
  hors reconnaissance automatique. Garde-fou ajouté dans `verif-qualite.mjs` pour que la mention
  ne puisse pas revenir.
- **26/09/2026** : la réponse FAQ « mon attestation téléchargée est-elle valable ? » citait
  l'**article R211-17** sur la carte verte comme droit en vigueur. Réécrite sur le FVA, le mémo
  véhicule assuré et la fenêtre de 72 heures. Une citation légale obsolète sur un site
  d'assurance est pire qu'une absence de citation.
- **26/09/2026** : **CIC → Crédit Mutuel** terminé sur les 10 pages qui le mentionnaient encore
  (dont le hero de l'accueil). Reste `CM-CIC p@iement` dans la FAQ paiement : c'est le nom
  historique de la passerelle, rebaptisée Monetico. À trancher avec le propriétaire, pas à
  deviner.
- **26/09/2026** : Trustpilot est passé à **4,2/5 sur 13 avis** (relevé du 26/09, contre 4,0
  au 25/09). Le badge reste à poser.
