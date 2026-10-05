# Analyse hebdo : semaine du 28/09 au 04/10/2026

> Rédigée le lundi 05/10/2026. Sources : GA4 (propriété `540804517`) et Search Console
> (`sc-domain:tempo-assurance.com`), interrogées par API le 05/10. Agrégats uniquement.

Notations utilisées dans les tableaux :

- **S0** = semaine analysée, **S-1** = 21-27/09, **S-2** = 14-20/09, **S-3** = 07-13/09 ;
- **moy. 3 sem.** = moyenne de S-1, S-2 et S-3 ;
- les variations en % sont toujours données avec les effectifs bruts.

## 0. Périmètre et fraîcheur des données

| Source | Fenêtre comparée | Complète jusqu'au |
| --- | --- | --- |
| GA4 | lun-dim, 28/09-04/10 | 04/10 (le 05/10 est exclu) |
| Search Console | **lun-sam**, 28/09-03/10 | 03/10 (données finales) |

- **Search Console** : l'API ne donne de données finales que jusqu'au **03/10**. Le 04/10
  n'existe qu'en données provisoires (35 clics, 2 362 impressions) et le 05/10 est quasi vide
  (7 clics). Toutes les comparaisons Search Console portent donc sur **lundi-samedi contre
  lundi-samedi**.
- **GA4** : semaines complètes du lundi au dimanche. Le 04/10 a moins de 48 h de traitement :
  sa répartition par canal ne montre pas d'anomalie (aucune session « Unassigned »), mais elle
  reste à relire.
- **Rupture de mesure du 03/10** (§2 ter du playbook) : traitée au §1.4 ci-dessous.

## 1. GA4

### 1.1 Trafic

| Mesure | S0 | S-1 | moy. 3 sem. |
| --- | --- | --- | --- |
| Sessions | **1 087** | 1 004 (+8 %) | 922 (+18 %) |
| Utilisateurs | **811** | 726 (+12 %) | 679 (+19 %) |
| Nouveaux utilisateurs | **717** | 654 (+10 %) | 614 (+17 %) |
| Sessions engagées | **696** (64,0 %) | 605 (60,3 %) | 540 (58,5 %) |

### 1.2 Sessions par canal

| Canal | S0 | S-1 | S-2 | S-3 |
| --- | --- | --- | --- | --- |
| Organic Search | 506 | 516 | 491 | 466 |
| Referral | 196 | 155 | 170 | 135 |
| Direct | 192 | 196 | 141 | 152 |
| AI Assistant | **189** | 122 | 82 | 114 |
| Autres | 5 | 16 | 6 | 2 |

- **Referral** : il s'agit presque entièrement de `jlassure.com` (196 sessions, contre 149,
  168 et 134). Ce sont des retours depuis le tunnel du partenaire, qui atterrissent à 167 sur
  196 sur la page devis.
- **AI Assistant** : il s'agit presque entièrement de `chatgpt.com` (186 sessions, contre
  120, 76 et 114).
- **Organic Search** : stable (506, contre une moyenne de 491 sur 3 semaines, soit +3 %).

**ChatGPT, détail par jour :**

| Période | Sessions par jour |
| --- | --- |
| 21-25/09 | 5 à 18 |
| 26/09 | 43 (marche) |
| 27/09-04/10 | 15 à 35 |

Sur S0, 143 sessions ChatGPT sur 186 atterrissent sur l'accueil, et 113 sur ces 143 sont
engagées (79 %).

### 1.3 Pages d'atterrissage et appareils

| Page d'atterrissage | S0 | S-1 | moy. 3 sem. |
| --- | --- | --- | --- |
| `/` (accueil) | **497** | 459 | 381 |
| dont venues de ChatGPT | 143 | 85 | 68 |
| accueil hors ChatGPT | 354 | 374 | 313 |
| `/devis-ou-souscription.html` | 236 | 217 | 199 |
| `(not set)` | 57 | 47 | 52 |
| `assurance-temporaire-auto` | 26 | 28 | 21 |
| `assurance-temporaire-remorque` | 20 | 17 | 14 |
| `assurance-temporaire-plaque-ww` | 19 | 9 | 13 |
| `assurance-temporaire-caravane` | 16 | 14 | 24 |
| `assurance-temporaire-7-jours` | 12 | 3 | 4 |

Toutes les pages d'atterrissage hors accueil et page devis sont **sous 30 sessions par
semaine** : leurs variations relèvent du bruit.

| Appareil | S0 | S-1 | moy. 3 sem. |
| --- | --- | --- | --- |
| Mobile | **772** (71 %) | 680 (68 %) | 626 |
| Ordinateur | 310 | 317 | 290 |
| Tablette | 5 | 9 | 7 |

La hausse du trafic est **mobile** : +92 sessions face à S-1, alors que l'ordinateur perd 7
sessions.

### 1.4 Tarificateur

#### `affichage_tarificateur` (arrivée sur la page devis)

| Mesure | S0 |
| --- | --- |
| Événements | 418 |
| Sessions concernées | 267 |
| Sessions ayant vu la page devis | 287 |
| Vues de la page devis | 423 |

L'événement existe depuis le 26/09 : il n'y a **pas de point de comparaison**. Par les vues
de page, la page devis passe de 270 à 287 sessions face à S-1 (+6 %), et la moyenne sur
3 semaines est de 247.

#### `ouverture_tarificateur`

Deux ruptures empêchent de comparer le total brut d'une semaine à l'autre :

1. **Jusqu'au 25/09**, la page devis comptait chaque affichage comme une ouverture (37 à 65
   par jour), puis plus rien à partir du 26/09. Le total brut chute donc de 832 à 642, ce
   qui est **un artefact de mesure, pas une baisse**. Toutes les comparaisons ci-dessous
   **excluent la page devis**.
2. **Le 03/10**, le paramètre `mode` a été ajouté (voir §2 ter du playbook).

**Le filtre `mode = fenetre` n'est pas disponible par l'API** : `mode` n'est pas déclaré
comme dimension personnalisée dans GA4. Il a été reconstitué par page :

- les 28 pages en mode `lien` n'ont pas de fenêtre de devis ;
- toutes les pages qui ont envoyé l'événement avant le 03/10 l'ont en revanche ;
- résultat : sur S0, **0 événement en mode `lien`**. Ces 28 pages n'ont fait que 33 vues du
  03 au 05/10, et le premier événement `lien` date du 05/10 (`blog-assurer-voiture-occasion`).

Sur S0, le total et le mode `fenetre` sont donc identiques : **642 événements, dont 636 hors
page devis**.

| Ouverture, hors page devis | S0 | S-1 | moy. 3 sem. |
| --- | --- | --- | --- |
| Événements | **636** | 579 (+10 %) | 516 (+23 %) |
| Sessions avec ouverture | **385** | 343 (+12 %) | 310 (+24 %) |
| Part des sessions | **35,4 %** | 34,2 % | S-2 30,9 %, S-3 35,9 % |

**La hausse des ouvertures vient du volume de trafic, pas d'un meilleur taux.**

#### Taux d'ouverture par page

Méthode : sessions avec ouverture sur la page, divisées par les sessions qui ont vu la page.
Cette méthode est choisie parce que le taux par page d'atterrissage est faussé avant le 26/09
par le comptage de la page devis. La référence du playbook (§2) a été calculée autrement :
elle n'est qu'indicative.

| Page | S0 | S-1 | réf. §2 |
| --- | --- | --- | --- |
| Accueil | **41 %** (210/515) | 37 % (179/480) | 41 % |
| Auto | 61 % (68/112) | 58 % (61/106) | 74 % |
| Utilitaire | 55 % (18/33) | 62 % (15/24) | 75 % |
| Plaque WW | 68 % (13/19) | 64 % (7/11) | 76 % |
| Remorque | 54 % (13/24) | 33 % (6/18) | n.d. |
| Caravane | 62 % (10/16) | 44 % (7/16) | 63 % |
| Belgique | 56 % (10/18) | 45 % (5/11) | 50 % |

- **Accueil** : 37 %, 32 % et 37 % sur les trois semaines précédentes, 41 % sur S0. Le
  volume est suffisant pour que le chiffre compte, mais une hausse sur une seule semaine ne
  fait pas encore une tendance.
- **Autres pages** : sous 35 sessions par semaine, l'écart d'une semaine à l'autre relève du
  bruit.

### 1.5 Autres événements

| Événement | S0 | S-1 | Lecture |
| --- | --- | --- | --- |
| `clic_sans_effet` | 193 | 13 | posé le 27/09 |
| `clic_certimat` | 4 | 1 | page carte grise |
| `clic_telephone` | 1 | n.d. | existe depuis le 03/10 |
| `form_submit` | 2 | 1 | |
| `file_download` | 2 | 0 | |
| `click` (sortant) | 19 | 18 | |

- **`clic_sans_effet`** : 147 événements sur la page devis, 45 sur l'accueil et 1 sur la
  FAQ. La dimension `element` est désormais déclarée, mais elle renvoie **`(not set)` pour
  100 % des 237 événements** depuis le 27/09, y compris le 05/10. Il en va de même pour
  `customEvent:page_path` sur `ouverture_tarificateur` (676 événements du 28/09 au 05/10).
  Explication probable : la déclaration est trop récente, puisqu'elle n'est pas rétroactive.
  À relire le 07/10.
- **`clic_telephone`** : 1 clic le 03/10 depuis la page 1 jour, puis 2 le 05/10 (page
  contact et page devis, journée partielle). Pas de comparaison possible.

## 2. Search Console (lundi-samedi, données finales)

### 2.1 Totaux

| Mesure | S0 | S-1 | S-2 | S-3 |
| --- | --- | --- | --- | --- |
| Clics | **360** | 358 | 361 | 368 |
| Impressions | **15 939** | 15 110 | 14 990 | 16 133 |
| CTR | **2,26 %** | 2,37 % | 2,41 % | 2,28 % |
| Position | **11,9** | 10,9 | 10,8 | 12,0 |

| Hors marque | S0 | S-1 | S-2 | S-3 |
| --- | --- | --- | --- | --- |
| Clics | **285** | 288 | 304 | 301 |
| Impressions | 15 684 | 14 884 | 14 802 | 15 892 |
| CTR | **1,82 %** | 1,93 % | 2,05 % | 1,89 % |
| Position (req. visibles) | 14,7 | 13,4 | 13,5 | 16,0 |

**Définition de la marque** : requêtes contenant « tempo assurance », « tempo-assurance »,
« tempoassurance », ainsi que « assurance tempo », « assur tempo », « assurtempo » et
« assu tempo » en requête exacte. Jamais « tempo » seul.

Les clics sont plats depuis 4 semaines, entre 358 et 368. La position moyenne bouge d'une
semaine à l'autre sans direction nette (10,8 à 12,0).

### 2.2 Marque et test du titre (changé le 29/09)

| « tempo assurance » | Clics/impr. | CTR | Pos. |
| --- | --- | --- | --- |
| S0 | 56/124 | **45,2 %** | 1,0 |
| S-1 | 61/122 | 50,0 % | 1,0 |
| S-2 | 48/92 | 52,2 % | 1,7 |
| S-3 | 56/111 | 50,5 % | 1,0 |
| **Depuis le titre** (29/09-03/10) | 48/113 | **42,5 %** | |
| Mêmes jours de S-1 (22-26/09) | 51/107 | 47,7 % | |

**Lecture du test :**

- **Le seuil de retour arrière (CTR de marque sous 40 %) n'est pas franchi.**
- La marge est faible : 42,5 %, sur 113 impressions seulement. À cet effectif, l'écart avec
  les 47 à 52 % habituels reste dans la marge d'erreur, d'environ ±9 points.
- **Rien ne permet de conclure** que le titre fait baisser le CTR de marque.
- Le groupe de requêtes de marque élargi est stable : 29,4 % (75/255), contre 31,0 %,
  30,3 % et 27,8 %.

#### « assurance temporaire » (toujours sur l'accueil)

| Semaine | Clics/impr. | CTR | Pos. |
| --- | --- | --- | --- |
| S0 | **4/490** | **0,82 %** | **10,7** |
| S-1 | 19/725 | 2,62 % | 9,7 |
| S-2 | 11/613 | 1,79 % | 9,0 |
| S-3 | 21/759 | 2,77 % | 11,0 |
| Réf. §2 bis (30 j) | 57/2 889 | 1,97 % | 10,6 |

**Position par jour :**

| Période | Position |
| --- | --- |
| 21-26/09 | 9,2 à 10,0 |
| 27 et 28/09, **avant le titre** | 10,2 |
| 29/09-03/10 | 10,6 à 11,0 |
| 04/10 (provisoire) | 11,5 |

- **C'est le mouvement le plus net de la semaine.** La requête passe du bas de la page 1 au
  haut de la page 2, et les impressions baissent de 32 % (490 contre 725).
- Hors marque, 4 clics contre 11 à 21 les semaines précédentes.
- **Le glissement a commencé le 27/09, deux jours avant le changement de titre.** Le titre
  n'en est donc pas la cause démontrée, et le contenu de l'accueil a changé le même jour
  (§2 bis : les deux effets ne sont pas séparables).
- Cause : **inconnue à ce stade.**

#### Accueil, hors marque (requêtes visibles)

| Semaine | Clics/impr. | CTR | Pos. |
| --- | --- | --- | --- |
| S0 | 46/4 449 | 1,03 % | 14,7 |
| S-1 | 57/5 100 | 1,12 % | 12,1 |
| S-2 | 57/4 171 | 1,37 % | 11,8 |
| S-3 | 65/4 323 | 1,50 % | 14,9 |

- Le CTR baisse depuis 4 semaines : 1,50 %, puis 1,37 %, 1,12 % et 1,03 %.
- **Cette baisse a commencé avant le changement de titre.** À position variable, elle ne se
  lit pas comme un effet du titre.
- Le critère du playbook (CTR hors marque sur quatre semaines pleines, à position égale)
  sera évalué le 27/10.

#### Requêtes du groupe « immédiate »

Requêtes contenant « immédiat » et « temporaire » :

| Semaine | Clics/impr. | CTR | Pos. |
| --- | --- | --- | --- |
| S0 | 11/712 | 1,54 % | 11,9 |
| S-1 | 9/664 | 1,36 % | 12,0 |
| S-2 | 7/587 | 1,19 % | 9,6 |
| S-3 | 11/551 | 2,00 % | 16,0 |

La requête visée par le nouveau titre, « assurance temporaire immédiate en ligne », passe à
**5 clics pour 209 impressions, en position 9,4**. La semaine précédente : 1 clic pour 128
impressions, position 10,2. Moyenne sur 3 semaines : 1,7 clic pour 107 impressions. Le sens
est cohérent avec le titre, mais **5 clics ne prouvent rien**.

### 2.3 Ce qui a le plus bougé (S0 contre moyenne 3 semaines)

#### Requêtes en baisse (impressions)

| Requête | S0 | moy. 3 sem. | Pos. S0 / S-1 |
| --- | --- | --- | --- |
| assurance temporaire | 490 | 699 | 10,7 / 9,7 |
| assurance provisoire | 188 | 365 | 11,8 / 9,9 |
| assurance temporaire voiture | 375 | 486 | 11,8 / 11,2 |
| assurance auto temporaire immédiate | 97 | 163 | 14,1 / 11,6 |
| temporauto | 63 | 121 | 6,9 / 3,9 |

#### Requêtes en hausse (impressions)

| Requête | S0 | moy. 3 sem. | Pos. S0 |
| --- | --- | --- | --- |
| assurance bus organise-tes-vacances.fr | 394 | 55 | 2,7 |
| assurance temporaire immédiate en ligne | 209 | 107 | 9,4 |
| carte grise barrée | 154 | 34 | 9,2 |
| assurance temporaire remorque | 73 | 20 | 14,5 |
| assurance auto immédiate | 55 | 3 | 20,4 |

#### Pages

| Page | Impr. S0 | moy. 3 sem. | Clics S0 / moy. |
| --- | --- | --- | --- |
| accueil | 5 697 | 5 989 | 174 / 185 |
| assurance-temporaire-auto | 289 | 470 | 3 / 3 |
| carte-grise-barree | 1 031 | 688 | 2 / 4 |
| assurance-temporaire-bus | 505 | 162 | 1 / 5 |
| assurance-temporaire-1-jour | 1 147 | 838 | 10 / 8 |
| assurance-temporaire-remorque | 357 | 271 | 18 / 11 |

**Lecture :**

- **Les têtes de requête de l'accueil reculent ensemble** : « assurance temporaire »,
  « assurance provisoire », « assurance temporaire voiture ». La position de l'accueil passe
  de 11,1 à 13,3 sur S-1. C'est un même mouvement de position, pas trois problèmes distincts.
- **Bus** : la hausse vient d'une requête de navigation vers un autre site
  (« organise-tes-vacances.fr », 0 clic). Sans valeur.
- **Carte grise barrée** : la requête monte de la position 24,0 à 9,2, mais ne rapporte que
  2 clics.
- **1 jour** : les impressions montent mais la position recule (17,9 contre 13,9), parce que
  de nouvelles requêtes « assurance auto immédiate » apparaissent en position 20.
- **Remorque** : 18 clics contre 12. Faible volume.

### 2.4 Suivis demandés

**Wakam (`blog-contrat-auto-non-renouvele.html`, publié le 03/10)**

- **0 impression du 01 au 05/10**, données provisoires comprises.
- Aucune requête contenant « wakam », « renouvel » ou « reconduit ».
- Rien d'anormal deux jours après la publication : Google n'a pas encore exposé la page.

**Page week-end (réécrite le 30/09)**

| Semaine | Clics/impr. | Pos. |
| --- | --- | --- |
| S0 | 1/200 | 28,2 |
| S-1 | 1/185 | 13,2 |

Par jour, la page passe de 11 à 30 impressions (21-29/09, sauf 77 le 26/09) à **37 à 70 impressions du 01 au
04/10**, mais en positions 22,9 à 44,2. Google l'essaie sur de nouvelles requêtes, plus
longues et mal classées. **Trop tôt pour juger.**

**Veille n°6 (publiée le 04/10)** : `veille-auto.html` fait 1 impression par jour, rien à
lire avant une semaine.

**Apple Pay (mis en avant depuis le 30/09)** : aucun événement GA4 ne le mesure. Effet non
mesurable.

**Nouvelles requêtes** (absentes des 3 semaines précédentes) : 164 requêtes, pour 283
impressions et 5 clics au total. La plus forte, « assurance temporaire 90 jours », fait 12
impressions. Le reste est de la longue traîne, dont des fautes d'orthographe sur « carte grise
barrée ». **Bruit.**

## 3. Analyse

### Vraies tendances

1. **ChatGPT devient un canal à part entière.**
   - 186 sessions (+55 % sur S-1, +80 % sur la moyenne de 3 semaines), avec une marche le
     26/09 qui tient depuis neuf jours.
   - Taux d'engagement de 79 %, et 98 sessions avec ouverture du tarificateur, contre 64.
   - **Toute la hausse de l'accueil en vient** : hors ChatGPT, l'accueil fait 354
     atterrissages, contre 374 la semaine précédente.
   - Aucun commit du 23 au 28/09 ne touche `llms.txt` ni l'application ChatGPT. **Cause
     inconnue.**
2. **La recherche organique est plate.** 360 clics (358, 361, 368 avant) et 506 sessions
   GA4. Toute la croissance du trafic vient de ChatGPT et des retours de JL Assure.
3. **Les têtes de requête de l'accueil glissent vers la page 2.** « assurance temporaire »
   passe de 9,7 à 10,7, et la position de l'accueil de 11,1 à 13,3. Le mouvement a commencé
   le 27/09, avant le changement de titre : **la corrélation avec le titre ne vaut pas
   causalité.**

### Relève du bruit

- Les taux d'ouverture par page hors accueil et la plupart des pages d'atterrissage : moins
  de 35 sessions.
- Les 164 nouvelles requêtes, la page bus, la page week-end et les 5 clics de la requête
  « immédiate en ligne ».

### À ne pas lire comme un progrès

- **`ouverture_tarificateur` à 642** : en total brut, c'est une baisse apparente (832 sur
  S-1), alors que hors page devis c'est une hausse (636 contre 579). Ni l'un ni l'autre n'est
  un changement de conversion.
- **Le taux par session est stable** : 35,4 %, contre 34,2 %, 30,9 % et 35,9 %.
- Le nouveau mode `lien` n'a encore rien ajouté sur S0.

## 4. Recommandations (3 au plus, par ordre)

**1. Garder le titre de l'accueil jusqu'au 27/10, mais relever le CTR de « tempo assurance »
chaque lundi.**

- Il est à **42,5 % (48/113)** depuis le changement, contre 47,7 % les mêmes jours de S-1,
  soit 2,5 points au-dessus du seuil de retour.
- Règle proposée : revenir en arrière si la semaine complète passe sous 40 % avec au moins 100
  impressions.
- Ne rien toucher d'autre sur l'accueil d'ici là. La baisse d'« assurance temporaire » (4
  clics contre 19) a commencé avant le titre, et un deuxième changement rendrait le test
  illisible.

**2. Déclarer `mode` comme dimension personnalisée dans GA4, et vérifier `element` et
`page_path`.**

- Action propriétaire, 2 minutes : Admin > Définitions personnalisées > portée « Événement ».
- Aujourd'hui, le filtre `mode = fenetre` exigé pour toute comparaison est **impossible par
  l'API**. Il a fallu le reconstituer par page.
- `element` et `page_path` renvoient `(not set)` pour 100 % des 237 `clic_sans_effet` et des
  676 ouvertures. Sans ces dimensions, le test des dead clicks de la page devis (147
  `clic_sans_effet` cette semaine) ne pourra pas désigner d'élément.

**3. Suivre ChatGPT comme un canal à part entière.**

- 186 sessions, soit 17 % du trafic, et 98 sessions avec ouverture.
- Le relever chaque lundi, et inscrire au journal toute modification de `llms.txt` ou de
  l'application ChatGPT avec la référence de la semaine (186 sessions, 143 sur l'accueil).
  C'est le seul canal en croissance, et la marche du 26/09 reste inexpliquée.
- Mesurer avant d'y toucher.

## 5. Limites

- **Search Console** :
  - données finales jusqu'au 03/10 seulement ; le dimanche 04/10 n'est pas comparé ;
  - les requêtes anonymisées sont comptées dans les totaux, mais pas dans les tableaux par
    requête.
- **GA4** :
  - le 04/10 a moins de 48 h de traitement ;
  - `mode` n'est pas filtrable par l'API : le filtre `fenetre` est reconstitué par page ;
  - `element` et `page_path` renvoient `(not set)` ;
  - `affichage_tarificateur` et `clic_telephone` n'ont pas d'historique.
- **Conversion** : la vente se conclut dans l'iframe JL Assure. Aucune donnée ici ne mesure
  un contrat signé.
- **Faibles volumes** : la marque fait environ 120 impressions par semaine. Un écart de 5
  points de CTR n'y est pas significatif.
