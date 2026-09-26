# Analyse du portefeuille client — 26 septembre 2026

Première analyse des données de contrats, rendue possible par l'API `autotempo.net`.
Source : `scripts/analyse-portefeuille.mjs`, agrégats uniquement, aucune donnée nominative
n'est écrite ni conservée.

**À lire avant d'écrire le moindre message de relance.**

---

## 1. Ce que couvrent les données

| | |
| --- | --- |
| Contrats | 1 926 |
| Clients distincts | 1 280 |
| Primes | 222 936 € |
| Période | premier contrat le 26/05/2026, dernier début le 23/10/2026 |
| Mois pleins observés | juin, juillet, août, septembre |

Sur ces quatre mois pleins : **1 757 contrats et 185 055 €**, soit **439 contrats et
46 264 € par mois**.

**Limite à garder en tête : on ne voit que l'été.** Juin à septembre sont les mois de
déménagements, d'achats de véhicules et de départs. Rien ne permet d'extrapoler ces 439
contrats par mois au reste de l'année, et la baisse d'octobre (138 échéances) n'est pas
interprétable, le mois n'étant pas terminé. Il faudra six mois de plus pour parler de
saisonnalité.

---

## 2. Le taux de fidélité réel : 41 %, pas 21 %

Le chiffre brut dit que 21,3 % des clients ont pris plus d'un contrat. **Ce chiffre est
trompeur** : un client arrivé en septembre n'a pas eu le temps de revenir. Il ne mesure pas
la fidélité, il mesure l'âge de la base.

En regardant le taux de retour **en fonction du temps d'observation** :

| Observé depuis | Clients | Sont revenus |
| --- | --- | --- |
| plus de 90 jours | 272 | **41,2 %** |
| 60 à 90 jours | 376 | 23,7 % |
| 30 à 60 jours | 324 | 14,2 % |
| moins de 30 jours | 302 | 8,6 % |

Par cohorte de premier achat, même conclusion : mai 57,1 %, juin 37,6 %, juillet 23,3 %,
août 12,8 %, septembre 9,2 %. **La courbe monte encore à 90 jours et ne plafonne pas.**
Le taux de fidélité à long terme est vraisemblablement entre 45 et 55 %.

**C'est la conclusion la plus importante du document.** Ce n'est pas une base de clients
de passage : c'est une base qui revient d'elle-même, sans qu'on lui ait jamais rien envoyé.

**Quand reviennent-ils ?** Médiane **12 jours** entre deux dates de début, moyenne 17.
41 % reviennent sous 7 jours, 83 % sous 30 jours. Comme la durée médiane d'un contrat est
de 7 jours, cela signifie qu'ils reviennent environ **5 jours après la fin** du précédent.
Une relance 2 à 3 jours avant l'échéance tombe donc pile dans la fenêtre de décision.

---

## 3. Trois populations, pas une

| Segment | Clients | Contrats | Primes | Part du CA | Panier |
| --- | --- | --- | --- | --- | --- |
| 1 seul contrat | 1 007 | 1 007 | 109 758 € | **49,2 %** | 109 € |
| 2 à 4 contrats | 231 | 556 | 70 007 € | 31,4 % | 126 € |
| 5 contrats et plus | **42** | 363 | 43 171 € | **19,4 %** | 119 € |

**42 clients, soit 3,3 % de la base, pèsent 19,4 % du chiffre d'affaires.** Le plus gros
en compte 23 à lui seul.

Leur profil les trahit : moins de voitures particulières (63 % contre 78 %), trois fois
plus de bus et autocars (TCP 10 % contre 1 %), durées plus longues (médiane 9 jours contre
6), et seulement 12 % de contrats d'un jour contre 22 %. **Ce sont des professionnels** :
garages, marchands, convoyeurs, loueurs.

À l'autre bout, le client à contrat unique est massivement une voiture particulière (78 %),
sur une durée courte, et **22 % d'entre eux ont pris un contrat d'un seul jour** — environ
222 personnes, à peu près 55 par mois.

---

## 4. Ce que ça implique pour la relance

### Ne pas envoyer le même message à tout le monde

1. **Les 42 professionnels ne doivent pas recevoir d'email automatique.** Envoyer
   « votre contrat se termine » à quelqu'un qui achète 23 fois est au mieux inutile, au
   pire vexant. Ils valent un appel de Christophe et probablement des conditions ou un
   parcours de re-commande dédié. 19 % du CA se traite à la main.
2. **Les 231 réguliers (2 à 4 contrats)** sont la cible naturelle de la relance à
   échéance. Ils connaissent le produit, ils reviennent déjà.
3. **Les 1 007 clients à contrat unique** sont le vrai gisement de vente complémentaire.
   Beaucoup n'ont simplement pas encore eu besoin d'un second contrat.

### L'hypothèse à tester en premier

Un client qui prend **un contrat d'un jour sur une voiture particulière** vient
quasi certainement d'acheter le véhicule et de le ramener. Il a alors **un mois** pour
faire sa carte grise. C'est un besoin daté, certain, et déjà couvert par le site via
Certimat.

C'est une hypothèse, pas un fait. Elle se teste. Le playbook rappelle que quatre
hypothèses de bon sens ont déjà été invalidées par les données sur ce site.

### Le piège à éviter absolument

**41 % des clients reviennent sans qu'on leur écrive quoi que ce soit.** Si on envoie des
relances à tout le monde et qu'on compte les retours, on s'attribuera des ventes qui
auraient eu lieu de toute façon, et on conclura que la relance fonctionne alors qu'on n'en
saura rien.

**Il faut un groupe témoin.** Garder 20 % des clients éligibles sans relance, et comparer
les taux de retour à 30 jours. Sans ça, le chiffre de conversion ne voudra rien dire.

### Ordre de grandeur

Environ 439 contrats arrivent à échéance chaque mois. À un horizon de 3 jours, cela
représente **13 à 14 relances par jour**. Si la relance produit 5 points de retour
incrémentaux, c'est de l'ordre de 22 contrats et 2 300 € de primes par mois. À 10 points,
le double. Ces chiffres ne valent que si le groupe témoin les confirme.

---

## 5. Volume par horizon, au 26/09/2026

| Échéance | Contrats | Clients distincts |
| --- | --- | --- |
| aujourd'hui | 16 | 16 |
| dans 1 à 3 jours | 41 | 40 |
| dans 4 à 7 jours | 46 | 41 |
| dans 8 à 30 jours | 95 | 93 |
| dans 31 à 90 jours | 33 | 28 |

Sur la fenêtre 0-7 jours : 103 contrats pour 96 clients. **Sans regroupement par email,
7 messages en trop**, envoyés à des gens qui en recevraient deux ou trois le même jour.

Dans la fenêtre 1-7 jours, 41 % des contrats appartiennent à des clients déjà récurrents
et 59 % à des clients qui ne sont jamais revenus. Les deux groupes n'ont pas besoin du
même message.

---

## 6. Catégories et paniers

| Catégorie | Contrats | Part | Panier moyen |
| --- | --- | --- | --- |
| VP (voiture) | 1 409 | 73,2 % | 110,52 € |
| VU (utilitaire) | 222 | 11,5 % | 130,84 € |
| CAM3 (camion) | 73 | 3,8 % | 130,17 € |
| CTTE (camionnette) | 69 | 3,6 % | 122,01 € |
| TCP (bus, autocar) | 66 | 3,4 % | 168,39 € |
| REM2, REM3 (remorque, caravane) | 57 | 3,0 % | 87 € |
| CAM4 | 20 | 1,0 % | 140,34 € |
| QM, TRA, VSP | 10 | 0,5 % | — |

Durée médiane 7 jours. Répartition : 17,8 % à 1 jour, 14,2 % de 2 à 3 jours, 22,4 % de
4 à 7, 24,9 % de 8 à 15, 16,4 % de 16 à 30, 4,4 % au-delà.

Le site met en avant dix catégories de véhicules. Dans les faits, **VP et VU représentent
85 % des contrats**. Les pages quad, tracteur et voiturette existent pour le référencement,
pas pour le volume : 10 contrats en quatre mois à elles trois.

---

## 7. Ce qui reste à savoir

- **Pas de données hors saison.** Revoir ces chiffres en février.
- **Le taux de fidélité n'a pas fini de monter.** Refaire l'analyse des cohortes dans
  trois mois : la cohorte de mai sera à 200 jours d'observation.
- **On ignore pourquoi les clients uniques ne reviennent pas.** Ont-ils trouvé moins cher,
  sont-ils passés à un contrat annuel, ou n'ont-ils simplement plus eu besoin ? Seule une
  question posée directement y répondra.
- **Aucune donnée sur les devis non transformés.** L'API ne renvoie que des contrats. Le
  taux d'abandon du tarificateur reste invisible de ce côté.

---

## 8. Les gros utilisateurs : deux profils, deux produits

Analyse des **114 clients ayant pris 3 contrats ou plus**, en regardant si leurs contrats
se chevauchent (plusieurs véhicules assurés en même temps) ou s'enchaînent (un seul
véhicule, couvert en continu).

| | Profil professionnel | Particulier qui enchaîne |
| --- | --- | --- |
| Clients | **66** | 48 |
| Signature | contrats qui se chevauchent, véhicules variés | séquentiel, 85 % de voitures particulières |
| Taux de couverture de la période | **102 %** | 58 % |
| Jours assurés (médiane) | 63 | 36 |
| Dépense médiane | 636 € | 370 € |
| Dépense totale | **53 802 €** | 19 085 € |

Un taux de couverture supérieur à 100 % ne peut signifier qu'une chose : **plusieurs
véhicules assurés simultanément**. C'est la signature d'une activité professionnelle, pas
d'un besoin ponctuel. Ces 66 clients pèsent **24 % du chiffre d'affaires**.

Les 48 autres enchaînent les contrats sur un seul véhicule, majoritairement une voiture
particulière, avec un trou médian de 10 jours entre deux contrats. **25 d'entre eux
couvrent plus de la moitié de la période observée**, pour 458 € chacun sur environ 54 jours
assurés, soit 8,50 € par jour.

### Ce que ça change sur le résilié / malus

Le playbook dit, au §9 : « résilié/malus = 3 impressions en 3 mois, ne pas investir pour
le SEO ». **C'est toujours vrai pour l'acquisition, et c'est faux pour la base existante.**

Quelqu'un qui assure la même voiture en continu, par tranches de 9 jours, à 8,50 € par
jour, ne le fait pas par choix. Ce comportement est celui de quelqu'un qui **n'a pas accès
à un contrat annuel** : résilié, malus, jeune conducteur, permis étranger. La demande
existe, elle n'est simplement pas visible dans les requêtes Google : elle est visible dans
le comportement d'achat.

Extrapolé sur une année, un client à 58 % de couverture serait assuré environ 210 jours et
dépenserait de l'ordre de 1 700 €. Un contrat annuel, même surprimé, coûte moins cher.

**Réserve honnête** : 48 clients, c'est peu, et la fenêtre d'observation est de quatre mois.
Le taux de couverture calculé sur une période courte est fragile. La classification elle-même
est grossière : elle repose sur le chevauchement des dates et la variété des catégories,
faute de mieux, l'API ne renvoyant ni plaque ni identité, ce qui est voulu.

### Trois pistes, par ordre de facilité

1. **Carte grise via Certimat.** Partenariat déjà en place, commission déjà paramétrée,
   rien à négocier. Cible : les ~55 clients par mois qui prennent un contrat d'un jour sur
   une voiture particulière. Besoin daté et quasi certain : un mois pour immatriculer.
2. **Les 66 professionnels, 24 % du CA.** Ils assurent plusieurs véhicules à la fois. Ce
   sont 66 appels téléphoniques, pas une campagne. L'objectif du premier appel est
   d'apprendre ce qu'ils achètent ailleurs, pas de vendre.
3. **Le contrat annuel pour les 25 enchaîneurs.** À conditionner à ce que MCJ Courtage est
   réellement habilité à placer, et à un accord avec un assureur acceptant ces profils.
