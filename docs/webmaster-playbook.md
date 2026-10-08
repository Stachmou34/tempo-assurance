# Playbook webmaster — tempo-assurance.com

> Référentiel de travail pour toute intervention sur le site, et base de la routine quotidienne.
> Mis à jour le 26/09/2026.

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

## 2 ter. Rupture de mesure du 03/10/2026 : `ouverture_tarificateur` change de périmètre

**À rappeler dans tout rapport qui compare avant et après le 03/10.**

Jusqu'au 03/10, l'événement clé `ouverture_tarificateur` n'était envoyé que sur les pages
**qui contiennent la fenêtre de devis**. Sur **28 pages** sans cette fenêtre (articles de
blog, FAQ, pages carte grise, veille, contact, à propos…), le bouton est un simple lien vers
`devis-ou-souscription.html` et **aucun clic n'était compté**. Les deux articles qui
attirent le plus de trafic éditorial du site étaient dans ce cas.

Depuis le 03/10 (`site.js?v=15`), ces clics sont comptés, avec le paramètre **`mode`** :

| `mode` | Signification |
| --- | --- |
| `fenetre` | la fenêtre de devis s'ouvre sur place (comportement historique) |
| `lien` | le visiteur part vers la page devis (nouveau, `transport_type: beacon`) |

**Conséquence : l'événement clé va monter mécaniquement.** Ce n'est pas un gain de
conversion, c'est la fin d'un angle mort. Pour comparer à l'historique, filtrer sur
`mode = fenetre`. Pour savoir enfin quelles pages envoient au devis, regarder `mode = lien`
par `page_path`.

Sur la page devis elle-même, rien n'est envoyé au clic : le tarificateur y est déjà
affiché, et `affichage_tarificateur` le compte au chargement.

**Règle pour l'avenir** : la classe `cta-btn-modal` est réservée aux boutons qui mènent au
devis d'assurance. Un bouton « Faire ma carte grise » la portait sur l'article occasion ; avec
la nouvelle mesure, chacun de ses clics aurait compté comme une ouverture du tarificateur.
Corrigé. Pour tout autre bouton, utiliser `btn cta-btn`, qui a exactement le même rendu.

## 2 bis. Test en cours : titre et description de l'accueil

**Changé le 29/09/2026. Relever au 27/10, soit quatre semaines.** Sans ce point de
référence, on ne saura pas si le changement a servi.

| | Avant | Après |
| --- | --- | --- |
| `<title>` | Assurance temporaire en ligne \| Tempo Assurance | Assurance temporaire **immédiate** en ligne \| Tempo Assurance |
| longueur | 47 | 57 |
| description | 187 caractères, prix rejeté en fin de phrase | 160 caractères, « attestation immédiate » et « dès 50,75 € » avant la troncature |

**Pourquoi.** 3 748 impressions sur « assurance temporaire immédiate » et ses variantes,
en positions 9 à 17, et le mot n'était nulle part dans le titre. « assurance temporaire
immédiate en ligne » est une requête réelle à 1 390 impressions : le nouveau titre en est
la correspondance quasi exacte.

### État de référence, à comparer au 27/10

| Mesure (27/06 → 24/09) | Valeur |
| --- | --- |
| « assurance temporaire », 90 j | 4 848 impressions, 93 clics, CTR 1,9 %, position 12,7 |
| « assurance temporaire », 30 derniers jours | 2 889 impressions, 57 clics, CTR 1,97 %, position 10,6 |
| cluster « immédiate » | 3 748 impressions, positions 9 à 17 |
| cluster prix et « pas cher » | 2 862 impressions, 12 clics, **CTR 0,4 %** |
| accueil, toutes requêtes | 945 requêtes, 48 287 impressions |
| marque « tempo assurance » | 1 725 impressions, 777 clics, **CTR 45 %**, position 1,3 |

### Quand revenir en arrière

- **Si le CTR de la marque passe sous 40 %** : le titre gêne la requête qui convertit le
  mieux du site. Revenir immédiatement.
- **Si le CTR hors marque de l'accueil baisse** sur quatre semaines pleines, à position
  égale : le titre est moins bon, revenir.
- Une position qui bouge dans les deux premières semaines ne prouve rien. Google met deux
  à six semaines à réévaluer une page, et le contenu de l'accueil a changé le même jour :
  **les deux effets ne seront pas séparables.** Le dire dans le rapport plutôt que
  d'attribuer le mouvement à l'un ou à l'autre.

**Attention au piège de mesure.** Filtrer les requêtes de marque sur la chaîne « tempo »
attrape aussi « assurance **tempo**raire » et gonfle la marque à 49 % des impressions. La
vraie requête de marque est « tempo assurance », 1 725 impressions.

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

## 5 bis 2. Le balisage FAQPage ne produit plus rien dans Google

**21 pages sur 61 portent un balisage `FAQPage`. Il ne sert plus au référencement Google.**
Le résultat enrichi FAQ a été restreint aux sites gouvernementaux et de santé en août 2023,
puis **retiré complètement le 7 mai 2026**. Google a supprimé la fonctionnalité de Search,
le rapport dans la Search Console, et le support dans l'outil de test.

Conséquences concrètes :

- **Ne jamais présenter un ajout de `FAQPage` comme un gain SEO.** Ce serait vendre un
  résultat qui n'existe plus.
- **Ne pas le retirer pour autant.** Un balisage non supporté est ignoré, pas pénalisé, et il
  reste lu par Bing, par les assistants et par les IA qui parcourent le site. Vu que le site
  entretient un `llms.txt` et une application ChatGPT, c'est un canal qui compte ici.
- Une FAQ **visible en clair dans la page** garde toute sa valeur : c'est du contenu qui
  répond à une requête, indépendamment de tout balisage.

## 5 ter. Microsoft Clarity : les frictions que GA4 ne voit pas

GA4 dit combien de gens passent et où. Clarity dit **où ça coince**. Ce sont les seules
métriques du site qui pointent un défaut réparable :

| Signal | Ce que ça veut dire |
| --- | --- |
| **Rage clicks** | quelqu'un clique frénétiquement sur un élément qui ne répond pas |
| **Dead clicks** | un clic sur ce qui ressemble à un bouton et n'en est pas un |
| **Erreurs JS** | du code qui casse chez de vrais visiteurs, pas en test |
| **Quickbacks** | arrivée puis retour immédiat : la page a menti sur son contenu |
| **Excessive scroll** | l'information cherchée est trop bas, ou introuvable |
| Scroll moyen, temps actif | l'engagement réel, par page |

```bash
node scripts/clarity.mjs            # relevé du jour, enregistré et résumé
node scripts/clarity.mjs --relire   # relire le dernier instantané sans appeler l'API
node scripts/clarity.mjs --brut     # réponse brute, pour la mise au point
```

Le jeton est dans `CLARITY_API_TOKEN`. **Une session démarrée avant l'ajout de la variable
ne la verra jamais** : il faut une session neuve.

### Pourquoi l'instantané quotidien n'est pas optionnel

L'API ne donne que les **1 à 3 derniers jours** et plafonne à **10 requêtes par jour**.
Clarity ne conserve aucun historique exploitable. Le script enregistre donc la réponse
brute dans `donnees/clarity/AAAA-MM-JJ.json`, un fichier par jour.

**C'est le seul historique dont on disposera jamais.** Une journée non relevée est perdue
définitivement. Sans cette série, on ne saura pas si une friction est apparue hier ou
traîne depuis six semaines, et on ne pourra pas dire si une correction a servi à quelque
chose.

Le script consomme **2 requêtes sur 10**. Le quota est **par projet et par jour, pas par
session** : deux sessions qui relancent le script le même jour le vident à quatre. Le
script s'en protège — si l'instantané du jour existe, il le relit au lieu d'appeler l'API,
et il faut `--force` pour passer outre.

**Ne jamais supprimer un instantané pour « refaire proprement ».** Le 26/09, le quota a été
épuisé en re-testant, juste après avoir supprimé le fichier du jour : la journée est perdue
définitivement. En cas de journée manquante, le lendemain, `numOfDays=2` ou `3` permet de la
rattraper.

### L'evenement `clic_sans_effet`

Clarity compte les dead clicks mais **n'expose pas quel element les reçoit** : la
dimension heatmap n'est pas dans l'API. Un écouteur posé sur `devis-ou-souscription.html`,
`index.html` et `faq-assurance-temporaire.html` complète le relevé : à chaque clic dans
`<main>` sur un élément non interactif, il envoie à GA4 et à Clarity le **chemin CSS** de
la cible, en trois niveaux.

Il n'envoie **aucun texte, aucun contenu saisi, rien de personnel** : balise et première
classe, 90 caractères au plus. Plafonné à 5 par chargement de page.

Lecture : `element` dans GA4 (événement `clic_sans_effet`), ou le tag personnalisé
`clic_sans_effet` dans les filtres Clarity.

**Pourquoi cet écouteur existe** : une enquête menée le 27/09 par une session dédiée a
produit quatre coupables présumés, dont **un élément qui n'existe pas dans le DOM**, avec
des dimensions au pixel près, et un autre **masqué sur mobile** alors que le mobile fait
66 % des sessions. Sans mesure directe, on ne fait que supposer avec assurance.

### Quand c'est une alerte

- **Rage clicks non nuls** sur une page de conversion (accueil, devis, tarifs) : à traiter
  le jour même, c'est un visiteur qui essaie d'acheter et n'y arrive pas.
- **Erreurs JS au-dessus de 1 % des sessions** : chercher la page et le navigateur.
- **Dead clicks au-dessus de 10 %** : en général un texte qui ressemble à un lien, ou
  l'inverse. Gênant, rarement urgent.
- Un ordre de grandeur relevé le 26/09 pour comparaison : **414 sessions sur 24 h dont 38
  bots, scroll moyen 59,8 %, dead clicks 8,2 %, erreurs JS 0,24 %, rage clicks 0.**

### Ce que Clarity ne dit pas

Les chiffres sont **agrégés et anonymes**, sans identité ni parcours individuel. Un pic de
dead clicks désigne une page, jamais une personne. Et comme pour tout le reste : un signal
n'est pas une cause. Une page à fort taux de rebond peut simplement avoir répondu à la
question du visiteur.

## 6. Contrôles obligatoires avant tout commit

```bash
# tous les JSON-LD parsent
node -e "const fs=require('fs');fs.readdirSync('.').filter(f=>f.endsWith('.html')).forEach(f=>{const h=fs.readFileSync(f,'utf8');[...h.matchAll(/<script type=\"application\/ld\+json\">([\s\S]*?)<\/script>/g)].forEach(m=>{try{JSON.parse(m[1])}catch(e){console.log('ERREUR',f,e.message)}})})"
# apostrophes typographiques et tirets cadratins en prose
grep -l "’" *.html ; grep -o "<p[^>]*>[^<]*—" *.html
```
En pratique, un seul appel couvre tout : `node scripts/verif-qualite.mjs` (même contrôle que la CI).

Et une fois par jour, avant de choisir le chantier :

```bash
node scripts/surveillance.mjs   # disponibilité, écart de déploiement, SSL
node scripts/clarity.mjs        # frictions réelles, et instantané du jour
```
Plus : rendu sans erreur JS, balises équilibrées, questions FAQ présentes en texte visible.

## 7. Cadence éditoriale

- **Dimanche** : veille auto (`veille-auto.html`), édition n+1, archivage de la précédente
  en `veille-auto-AAAA-MM-JJ.html` avec bandeau « édition archivée ». Voir `blog-calendrier.md`.
- **Lundi** : brève d'actualité dans `actualites.html`.
- Enregistrer toute nouvelle page dans `blog.html`, `sitemap.xml` et `llms.txt`.

### Sources de veille

```bash
node scripts/veille-sources.mjs            # nouveautes depuis le dernier passage
node scripts/veille-sources.mjs --tout     # tout le fonds, sans filtre de nouveaute
node scripts/veille-sources.mjs --jours 20 # elargir la fenetre
```

Trois flux institutionnels, retenus **après test** sur quatorze candidats : Sécurité
routière, Bercy (`/rss/toutesactualites`), France Assureurs. Les sites de presse auto,
Légifrance, l'Intérieur et l'ACPR renvoient 403 aux robots, et plusieurs flux annoncés
n'existent plus.

**Un HTTP 200 ne suffit pas à valider une source** : `economie.gouv.fr/rss` répond 200
sur une page qui *liste* des flux sans en être un. Vérifier qu'elle renvoie des entrées
avant de l'ajouter.

**Ce que ça vaut, honnêtement : 3 entrées pertinentes sur 20 jours.** Ces flux sont un
filet de sécurité, pas une source d'inspiration. Ils garantissent qu'une annonce
institutionnelle ne passe pas à travers, mais **la recherche web reste l'outil principal
de la veille du dimanche**. Ne pas construire une édition uniquement à partir d'eux.

Le filtre travaille sur **deux axes** : un sujet doit toucher l'automobile ET l'assurance,
ou porter un terme intrinsèquement automobile. Une première version, qui donnait le
maximum à tout titre contenant « assurance », faisait remonter le photovoltaïque, le
ramonage et l'assurance-vie en tête d'une veille auto. Un mot-clé seul ne veut rien dire.

Les entrées déjà vues sont mémorisées dans `donnees/veille/vus.json` : c'est ce qui évite
de publier deux fois le même sujet à deux semaines d'intervalle.

### Pourquoi pas X (Twitter)

Question tranchée le 27/09/2026. **L'API X n'a plus de palier gratuit depuis février 2026**,
et les paliers Basic (200 $/mois) et Pro (5 000 $/mois) ont été dépréciés : un nouveau
compte n'a accès qu'au pay-per-use, à **0,005 $ par post lu**. Une veille quotidienne de
150 posts coûterait environ 23 $ par mois.

Écarté pour l'actualité : l'actualité de l'assurance auto française sort des institutions
qui la produisent, pas de leur écho sur les réseaux, et la veille est hebdomadaire — une
avance de quelques heures ne vaut rien.

**Reste ouvert pour la réputation**, qui est un autre besoin : X est le seul endroit où
voir ce qu'on dit de la marque et ce qu'annoncent les concurrents. `api.x.com` est
joignable depuis l'environnement (401 sans clé, donc pas bloqué par la politique réseau).
Si cela se fait un jour : le pay-per-use n'a pas de plafond naturel, un script qui boucle
coûte de l'argent réel, donc plafond dur écrit dans le code.

## 8. Git

Branche de travail `claude/upbeat-cerf-yjyYC`, PR vers `main`, déploiement par `git pull` sur le serveur.
Quand la PR est mergée, repartir de `origin/main` (ne jamais empiler sur de l'historique déjà mergé).

### Vérifier l'état de la PR AVANT chaque push

Une branche n'est pas une PR. Quand le propriétaire merge, GitHub **ferme la PR au commit
fusionné** : tout ce qui est poussé ensuite reste sur la branche et **n'est porté par
aucune PR**. Le push réussit, la branche avance, et le travail n'arrive jamais en ligne.
C'est arrivé le 26/09 : cinq commits sont restés orphelins derrière une PR déjà mergée,
et ils ont été annoncés au propriétaire comme faisant partie de cette PR.

Avant tout commit, et de nouveau avant d'annoncer un livrable :

```bash
git fetch origin
# commits de la branche qui ne sont pas dans main
git log --oneline origin/main..origin/claude/upbeat-cerf-yjyYC
```

- **Aucun commit** : la branche est à jour, repartir de `origin/main`.
- **Des commits, et une PR ouverte qui les contient** : continuer dessus.
- **Des commits, et aucune PR ouverte** (ou une PR mergée à un commit antérieur) :
  les rebaser sur `origin/main` (`git rebase origin/main`), pousser en
  `--force-with-lease`, et **ouvrir une nouvelle PR**. Ne jamais rouvrir ni réutiliser une
  PR mergée.

Ne jamais annoncer un numéro de PR sans avoir relu son état et la liste de ses commits.
Une PR mergée à un commit antérieur affiche encore le bon titre et le bon lien : rien ne
signale l'erreur, sauf la vérification.

## 9. Chantiers ouverts

Liste **ordonnée**. Prendre le premier chantier non fait, en entier, et rien d'autre.
Chaque entrée tient dans une session : si ce n'est pas le cas, elle est mal découpée, la
redécouper et le dire dans le rapport.

0. ~~**Wakam interdit de souscription**~~ **Livré le 03/10/2026** : article
   `blog-contrat-auto-non-renouvele.html`, enregistré dans `blog.html`, `sitemap.xml` et
   `llms.txt`.

   Le 25/09/2026, l'ACPR a interdit à Wakam de souscrire et de **renouveler** des contrats,
   faute de solvabilité (66 % du capital requis, SFCR 2025 de Wakam). Ses assurés ne seront
   pas reconduits à l'échéance. La mesure accompagne une **procédure contradictoire pouvant
   aller jusqu'au retrait d'agrément** ; dans ce cas les contrats cessent de plein droit
   40 jours après publication au JO (art. L326-12). Ne jamais écrire « valable jusqu'à
   l'échéance » sans cette réserve. « Adossement » n'est confirmé par aucune source de
   premier rang : Wakam parle de « renforcement de ses fonds propres et ouverture du capital ».

   **Antécédents : le formulaire ne demande rien, les conditions générales si.** Le
   formulaire (`preparer_session_souscription`) ne pose aucune question sur le bonus-malus,
   les résiliations, la sinistralité ni l'alcoolémie. Mais les CG HDI (définitions
   « conducteur principal » et « conducteur occasionnel ») fixent des critères : 23 ans
   pour le conducteur occasionnel, **pas plus de 3 accidents responsables matériels, aucun
   sinistre corporel responsable, aucune condamnation alcool ou stupéfiants**, avec nullité
   du contrat si l'assuré cache des faits qui ne correspondent pas à ces critères. La
   correction du propriétaire (« ça n'empêche pas la temporaire ») vaut donc pour un
   résilié pour non-paiement, pas pour un malussé lourd. Ne jamais écrire que la temporaire
   est ouverte « quel que soit votre passé ». Écrire « ne demande pas de relevé
   d'information » et rappeler les critères. À faire confirmer par JL Assure (portée exacte
   pour le conducteur principal, période de référence des 3 accidents). Corrigé dans
   l'article le 03/10 après vérification par un agent.

   **Solly Azar n'est pas nommé dans l'article.** Le lien « Solly Azar → Wakam » ne vient que
   d'une source secondaire ; la page auto de Solly Azar ne nomme pas son assureur. L'article
   s'en tient à Wakam, dont la situation repose sur une décision publique, et explique au
   lecteur comment vérifier son propre assureur. Ne pas ajouter de nom de courtier sans
   source de premier rang.

   **À suivre dans le relevé du matin** : « wakam », « non renouvelé », « contrat non
   reconduit ». Au 02/10, zéro impression. La mesure est provisoire : si l'ACPR la lève,
   mettre l'article à jour plutôt que de le laisser affirmer une interdiction terminée.

1. **Dead clicks sur la page devis.** Relevé du 26/09 : 29 dead clicks, contre 13 sur
   l'accueil qui a pourtant deux fois plus de sessions. L'hypothèse la plus courante, un texte
   qui ressemble à un lien, a été **écartée** : aucun faux cliquable sur la page, vérifié au
   navigateur en 390 px et 1280 px. Reprendre avec le tableau par page, qui affiche désormais
   le pourcentage de sessions touchées et non le nombre de clics. Pistes restantes : la zone
   autour de l'iframe du tarificateur, les puces `.quote-trust`, le bandeau `.quote-head`.
   **Relevé du 29/09** : 27 % des sessions de la page (50 clics sur 59 sessions), contre 14 % sur
   l'accueil. L'API Clarity ne donne pas l'élément cliqué : impossible de trancher par les chiffres.
   Hypothèse la plus probable : clics dans l'iframe cross-origin du tarificateur (jlassure.com), que
   Clarity ne peut pas suivre, ou clics sur l'iframe `loading="lazy"` avant son affichage. À tester
   **sur décision du propriétaire** (le bloc tarificateur est protégé) : retirer `loading="lazy"` de
   l'iframe de `devis-ou-souscription.html`, puis comparer le % de dead clicks sur 3 jours.
   Ne pas conclure à un défaut UX tant que ce test n'est pas fait.
   **Test lancé le 05/10/2026** (feu vert du propriétaire) : `loading="lazy"` retiré de l'iframe. Référence avant test :
   18 % à 21 % des sessions de la page touchées (Clarity 01/10 et 05/10). Comparer le % de dead clicks du 09/10 au 12/10.
   **Relevé du 08/10** (avant la fenêtre de comparaison) : 34 % des sessions de la page devis (57 clics sur 90 sessions), en hausse par rapport au 21 % du 05/10 ; le trafic a presque doublé ce jour-là (575 sessions Clarity contre 306), donc rien à conclure avant le 12/10.
   **Relevé du 01/10** : l'écouteur `clic_sans_effet` a remonté 117 événements depuis le 27/09, dont
   **86 sur la page devis** et 30 sur l'accueil. Mais le paramètre `element` n'est **pas déclaré comme
   dimension personnalisée dans GA4** (l'API répond « customEvent:element is not a valid dimension ») : on
   voit où ça clique morts, pas sur quoi. **Action propriétaire, 2 minutes** : GA4 > Admin > Définitions
   personnalisées > Créer une dimension personnalisée, portée « Événement », paramètre `element` (et
   `page_path`). Non rétroactif : le comptage par élément démarre à la déclaration.
   Clarity du 01/10 : dead clicks 21 % des sessions de la page devis (21 clics sur 70), 3 % sur l'accueil.
2. ~~**Erreur JS sur `/devis-ou-souscription.html#tarificateur`**~~ **Clos le 30/09/2026 : pas notre code.**
   Les instantanes Clarity du 28/09 (15 erreurs, 2,78 % des sessions) et du 30/09 (10 erreurs, 1 %)
   placent toutes les erreurs sur l'URL `www.jlassure.com/sousfiche/assure_tempo_rapide_mb.php`, c'est-a-dire
   dans l'iframe du partenaire. `/devis-ou-souscription.html` est a 0 % (0 erreur) le 30/09. Rien a corriger
   cote site ; si le volume monte, le signaler a JL Assure (modele : `docs/message-jlassure-*.md`).
   Lecon : Clarity rattache aussi les pages jlassure.com aux sessions, lire l'URL avant de conclure.
3. **Passerelle de paiement** : la FAQ dit encore `CM-CIC p@iement` alors que le reste du site
   dit Crédit Mutuel. Nom actuel probable : Monetico. **Demander au propriétaire**, ne pas deviner.
4. **Crawl espacé** : des pages non recrawlées depuis fin juillet. Vérifier dans Search Console
   quelles pages, et si le `lastmod` du sitemap est bien à jour pour celles-là.
   **02/10** : `lastmod` resynchronisé sur la dernière modification git pour 57 pages sur 59 (la plupart
   étaient figées au 25/06). L'API d'inspection d'URL (`searchconsole.googleapis.com`) renvoie 401 : le proxy
   n'authentifie que `www.googleapis.com` et `analyticsdata`. Les dates de dernier crawl restent donc à relever
   à la main dans Search Console (Pages > Explorées). Effet sur le crawl à mesurer d'ici une semaine.
   **06/10** : `lastmod` du sitemap en retard sur git pour de nombreuses pages (09/26-09/30 contre 10/03), mais
   le 03/10 est un commit transversal : ne pas resynchroniser à l'aveugle, ce serait déclarer des modifications
   de contenu inexistantes. Search Console 29/09-03/10 : 312 clics, 13 487 impressions, position 11,9 (22-26/09 :
   297 clics, 12 452 impressions, position 11,1). Mesure de l'effet du lastmod : 09/10.
   **08/10** : relu page par page en ignorant les commits transversaux (cache-buster, tirets, correctif du 03/10) :
   seules 2 pages avaient un vrai contenu plus récent que leur `lastmod` (`devis-ou-souscription.html`, `blog.html`),
   corrigées. Le retard annoncé le 06/10 n'était donc presque que l'effet du commit transversal. Search Console
   04-06/10 : 77 clics, 5 225 impressions, position 12,7 (27-29/09 : 151 clics, 6 998 impressions, position 11,8),
   mais les 2 derniers jours sont encore incomplets côté API : ne pas lire cela comme une chute.
5. **Requêtes perdues** à surveiller après la refonte de la page tarifs :
   « assurance temporaire pas cher », « prix assurance auto temporaire » (position 48 à 67).
   **Relevé du 03/10** (17-30/09 contre 03-16/09) : « assurance temporaire pas cher » est revenue en
   **position 14,1 sur l'accueil** (81 impressions, 1 clic), loin des positions 48 à 67 : rien n'a été perdu.
   « assurance auto temporaire prix » : 43 impressions position 20,8, puis 22 impressions position 16,9
   (accueil 53 impressions, position 18,6 ; `assurance-temporaire-auto.html` seulement position 43,4).
   « assurance provisoire 1 mois prix » : 63 impressions position 11,1 sur la page 1 mois, qui affiche déjà
   189,15 € dans le titre, la description et le résumé : rien à corriger, c'est encore un problème de position.
   Clics sur toutes les requêtes « prix » : 1 sur 14 jours. Rien à faire côté code, surveiller seulement.
6. **Autorité** : c'est LE levier pour passer de la position 12 à la position 5 sur les têtes de
   gondole. Avis Google, liens entrants. Ce chantier ne se règle pas dans le code : il se prépare
   (modèle d'e-mail de demande d'avis, liste de sites à contacter) et se propose au propriétaire.
   **Préparé le 07/10/2026** : `docs/autorite-plan-action.md` (ordre d'exécution, e-mail d'avis J+3, blocage
   du tunnel chez jlassure.com, trois décisions demandées). Pas de liste de sites : la recherche n'en a établi aucun de fiable.
7. ~~**Mesure** : GA4 renvoie `keyEvents = 0`~~ **Clos le 06/10/2026** : `ouverture_tarificateur` est marqué
   événement clé et remonte (629 événements clés du 29/09 au 05/10, 58 le 05/10 contre 69 le 28/09).
   Attention : c'est l'**ouverture** du tarificateur, pas un contrat. Aucun événement de souscription n'est
   visible côté site (le tunnel est chez jlassure.com) : on mesure l'intention, pas la vente. Autres événements
   relevés sur 7 jours : `affichage_tarificateur` 425, `clic_sans_effet` 183, `clic_telephone` 4, `clic_certimat` 4.

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
- **26/09/2026** : badge Trustpilot posé (chantier n°1 clos). A (rangée de gages `quote-trust`
  de la page devis) et B (pastille `.hero-pill`, déjà présente dans le CSS mais jamais utilisée,
  du hero de l'accueil) affichent **4,2/5 sur Trustpilot (13 avis)**, lien vers la fiche. Pas de
  balise `aggregateRating` ajoutée, conformément à la décision du 25/09. La valeur n'existe qu'à
  un seul endroit par page pour rester facile à mettre à jour au prochain relevé.
- **26/09/2026** : cinq commits poussés derrière une PR déjà mergée, sans PR pour les
  porter, et annoncés au propriétaire comme faisant partie de cette PR. Le push réussissait
  à chaque fois, donc rien ne signalait le problème. Contrôle ajouté au §8 : vérifier
  `origin/main..origin/<branche>` et l'état de la PR avant tout commit et avant toute
  annonce.
- **26/09/2026** : Clarity branché (§5 ter). Le relevé quotidien est enregistré dans
  `donnees/clarity/`, parce que l'API ne garde que trois jours : une journée non relevée
  est perdue pour toujours. Ce qui a motivé le §5 ter plutôt qu'un ajout au prompt de la
  routine : **le playbook est lu à chaque session, le prompt doit être recopié à la main
  dans l'interface.** Tout ce qui peut vivre dans le playbook doit y vivre, le prompt reste
  l'ordre de mission et rien de plus.
- **26/09/2026, soir** : le contrôle de déploiement ne regardait que 3 pages fixes, dont
  aucune n'avait changé de la journée : il annonçait « production conforme » alors qu'il
  n'avait rien vu du travail du jour. Il couvre désormais le socle de conversion **plus les
  pages réellement modifiées sur 14 jours**, soit 25 pages au lieu de 3.
- **26/09/2026, soir** : vérification faite, le résultat enrichi FAQ de Google a été retiré
  le 7 mai 2026 (§5 bis 2). Les 21 pages qui portent un `FAQPage` n'en tirent plus rien côté
  Google. On les garde pour les autres moteurs et les IA, mais plus jamais comme argument SEO.
- **27/09/2026** : veille par flux RSS institutionnels plutôt que par l'API X (§7). X est
  passé en pay-per-use, environ 23 $/mois pour l'usage envisagé, et n'apporterait qu'un
  écho retardé de sources gratuites. Il reste le seul moyen de surveiller la réputation de
  la marque, ce qui est un besoin distinct et non tranché.
- **27/09/2026** : écouteur `clic_sans_effet` posé sur les trois pages qui remontent des
  dead clicks. La cause des 29 clics morts de la page devis n'était pas déterminable
  autrement : Clarity donne le compte, pas la cible. Rappel utile, tiré de la même
  journée : un rapport d'agent, aussi assuré soit-il, se vérifie avant d'être relayé.
- **03/10/2026** : anomalie GA4 du 02/10 à ne pas lire comme une baisse de trafic. Sessions Organic Search
  39 (105 le 25/09, 62 le 01/10) mais 90 sessions « Unassigned » (source `(not set)`, 1 engagée) et 65
  « Cross-network » (source `(data not available)`) apparues le même jour, soit 175 sessions au total
  (143 le 25/09). Search Console n'a pas de donnée au-delà du 29/09 (latence), et ses clics du 26 au 29/09 sont
  dans la norme (42 à 61 par jour). Hypothèses non tranchées : trafic automatisé, ou campagne payante sans
  étiquetage, ou défaut d'attribution GA4. À recontrôler quand Search Console aura rattrapé le 02/10.
  **Recontrôle du 04/10 : anomalie résolue, c'était un artefact de traitement GA4.** Le 02/10 relu deux jours
  plus tard : 99 sessions Organic Search (engagées 65), 31 AI Assistant, 28 Referral, 26 Direct, plus aucune
  « Unassigned » ni « Cross-network ». Le même motif réapparaît sur le 03/10 relu le matin du 04/10 (52 Unassigned
  dont 1 engagée, 39 Cross-network, seulement 19 Organic Search) : **GA4 attribue mal les sessions d'une journée
  tant qu'elle n'est pas entièrement traitée.** Règle : ne jamais lire la répartition par canal d'un jour de
  moins de 48 h, et ne pas la prendre pour une baisse du SEO. Search Console s'arrête au 29/09 côté API ce matin
  (72, 59, 42, 48, 61 clics du 25 au 29/09) : rien d'anormal.
- **03/10/2026** : Wakam interdit de souscription et de renouvellement par l'ACPR depuis
  le 25/09. Il avait été recommandé en premier partenaire dans `partenaires-porteurs.md`
  le 29/09, quatre jours après la décision, sans vérification de l'actualité de
  l'entreprise. Corrigé. Leçon : **avant de recommander un partenaire, chercher son nom
  avec « ACPR » et l'année en cours.** Un assureur se renseigne, un porteur de risque se
  vérifie.
- **03/10/2026** : 28 pages envoyaient vers le devis sans que le clic soit compté, la mesure
  s'arrêtant faute de fenêtre de devis sur la page. Corrigé dans `site.js` (v=15) avec un
  paramètre `mode` qui sépare l'ancien et le nouveau périmètre (§2 ter). Trouvé en voulant
  tracer les clics d'un seul article : l'angle mort couvrait tout le blog.
- **03/10/2026** : aucun clic sur un numéro de téléphone n'était mesuré. Nouvel événement GA4
  `clic_telephone` (paramètre `zone` : `corps`, `menu`, `pied`, `autre`) dans `site.js` (v=16).
  À déclarer comme événement clé dans GA4 si les appels convertissent. Même jour : l'article
  Wakam, vérifié par un agent, affirmait trop sur deux points (contrat « valable jusqu'à
  l'échéance » malgré la procédure de retrait d'agrément ; temporaire ouverte quel que soit
  le passé, alors que les CG HDI fixent des critères d'antécédents). Corrigé, voir chantier 0.
- **05/10/2026** : analyse hebdo du 28/09 au 04/10 (`docs/analyse-hebdo-2026-09-28.md`). Trois
  enseignements durables. (1) **ChatGPT est devenu le troisième canal** : 186 sessions (120 la
  semaine d'avant), marche le 26/09 non expliquée, et toute la hausse de l'accueil en vient ;
  la recherche organique est plate (360 clics Search Console, 358 à 368 avant). (2) **La hausse
  d'`ouverture_tarificateur` est du volume, pas du taux** : 35,4 % des sessions contre 34,2 %,
  hors page devis. Le mode `lien` n'a rien ajouté sur la semaine (0 événement), et `mode`
  n'étant pas déclaré dans GA4, le filtre `fenetre` doit être reconstitué par page. (3) **« assurance
  temporaire » a glissé de 9,7 à 10,7 (4 clics contre 19) en commençant le 27/09, avant le
  nouveau titre** : ne pas l'attribuer au titre. CTR de « tempo assurance » depuis le changement :
  42,5 % (48/113), au-dessus du seuil de 40 % mais à surveiller chaque lundi.
- **07/10/2026** : chantier autorité préparé sans liste de liens à contacter. La recherche web n'a trouvé aucun annuaire
  de courtiers à valeur SEO démontrée ; mieux vaut une absence qu'une liste inventée. Le vrai blocage des avis est que
  le tunnel de souscription est chez jlassure.com : le site ne peut pas envoyer l'invitation lui-même.
