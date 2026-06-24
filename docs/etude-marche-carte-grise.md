# Étude de marché & audit concurrentiel — Carte grise (cross-sell Tempo × Certimat)

> Document interne. Créé : 2026-06-24. Sources : SDES/Ministère de la Transition écologique, Insee, AAA Data (via carte-grise.org / cartegrise.com), argumentaire APRIL/AssuCarteGrise, sites concurrents.

## 1. Le marché de la carte grise en France

### 1.1 Un marché gigantesque et captif
La carte grise (certificat d'immatriculation) est **obligatoire** dans les **30 jours** suivant l'achat d'un véhicule, et **100 % dématérialisée** depuis 2017 (plus de guichet préfecture). L'autorité est **France Titres** (ex-ANTS, renommée en février 2024).

**Volumes 2024 (voitures particulières) :**
- **1,72 M** de voitures **neuves** immatriculées (= autant de 1ʳᵉˢ immatriculations).
- **5,40 M** de voitures **d'occasion** vendues (**+2,9 %** vs 2023) = autant de **changements de titulaire**.
- À ajouter : utilitaires, 2-roues, remorques + les **actes secondaires** (duplicata perte/vol, changement d'adresse, déclaration de cession, WW/W garage).

➡️ **Ordre de grandeur : > 7 M de cartes grises VP/an**, et bien plus tous véhicules + actes secondaires confondus. Marché **récurrent, non cyclique** (on revend/achète tout le temps), **indépendant du neuf** (qui baisse) car porté par l'**occasion** (qui monte).

### 1.2 La moitié passe par un réseau privé habilité
La démarche officielle (France Titres) est gratuite mais **réputée complexe** (pièces, rejets, délais). Résultat : **~50 % des conducteurs passent par un professionnel habilité** (source argumentaire APRIL/AssuCarteGrise) qui facture un **frais de service**.
- C'est exactement le créneau de **Certimat / AssuCarteGrise** : habilité **Ministère de l'Intérieur**, raccordé au SIV.
- **Économie du dossier** : coût opérateur ≈ **24,90 €**, prix client **fixé librement** par le prescripteur → **marge ≈ 25 € / dossier** (modulable 5–40 €). Les **taxes** (régionale Y1, etc.) sont collectées pour l'État, hors marge.

### 1.3 Paysage concurrentiel du mot-clé « carte grise »
- **Pure players** (très gros budgets SEO/SEA) : eplaque, cartegriseminute, carte-grise.org, cartegrise.com… Ils **dominent la recherche générique** « carte grise ».
- **Notre angle n'est PAS de les battre sur « carte grise »** (trop cher), mais de **capter notre propre audience** au moment où elle a *déjà* le besoin (elle vient chez nous pour assurer un véhicule qu'elle vient d'acheter).

## 2. Audit concurrentiel — assurance temporaire qui vend la carte grise

| Concurrent | Carte grise ? | Structure site | Cross-sell | Forces | Faiblesses |
|---|---|---|---|---|---|
| **assutemporaire.fr** | ✅ Oui (Certimat) | Menu **Carte grise** + **sous-menu** (immatriculation, quitus, COC, WW, cession) + **6 tuiles** de démarches | Implicite | Très fort sur la **réassurance** : « Habilité & agréé Ministère », **CPI immédiat**, « sous 2-3 j », 24/24 | Peu de cross-sell explicite assurance↔CG |
| **assutempo.fr** (Evidence Assurances) | ✅ Oui (Certimat) | Lien menu **Carte grise** → page `/carte-grise` « sans la paperasse », **3 étapes**, badges **Ministère + France Titres** | ✅ **Bidirectionnel** : page CG → « Pas encore assuré ? » et home → CG | **Cross-sell dans les 2 sens**, parcours intégré, branding « France Titres » | Moins de pages SEO par démarche |
| **AED** (assurance-voiture-temporaire-provisoire.com) | ✅ Oui | **Page combinée** « assurance temporaire + nouvelle carte grise » | Sur la même page | Bon angle éditorial (achat→assurance→CG) | Pas de hub carte grise structuré |
| **Pure players** (eplaque, cartegriseminute…) | ✅ (cœur de métier) | Site 100 % carte grise, tunnel ultra-optimisé | N/A | UX/tunnel de référence, autorité SEO | Aucune offre assurance (pas notre terrain) |

### Ce qui ressort (best practices à reprendre / dépasser)
1. **Entrée « Carte grise » dans le menu global** (présente sur toutes les pages) — fait par tous.
2. **Page hub dédiée** + **tuiles par démarche** (mise à nom, cession, adresse, perte, import, WW).
3. **Réassurance très visible** : *habilité Ministère de l'Intérieur / France Titres*, **CPI immédiat**, délais 24–72 h.
4. **Cross-sell bidirectionnel** (assutempo le fait, les autres non) → **c'est le levier #1 et c'est là qu'on peut gagner**.
5. **Aucun** ne joue à fond le **déclencheur post-souscription** (« vous venez d'assurer un véhicule acheté → faites sa carte grise »). **Notre opportunité différenciante.**

## 3. Potentiel pour Tempo-Assurance
- Notre audience est **pré-qualifiée** : un client qui prend une assurance temporaire pour **achat-vente / import / carte grise barrée / plaque WW** a, par définition, un **besoin de carte grise imminent** (obligation 30 j).
- Ces motifs représentent **la majorité** de notre trafic temporaire → **base adressable large**, sans coût d'acquisition supplémentaire.
- **Revenu** : marge ≈ **25 € / dossier**, **sans risque** (acte administratif, pas d'assurance). Chaque tranche de N dossiers/mois = N×25 € de marge nette additionnelle.
- **Bonus rétention/image** : offre « tout-en-un » (j'assure **et** j'immatricule) → différenciant fort vs pure-assurance.

## 4. Structure de site recommandée (le modèle « boucle de conversion »)
Voir le schéma : `docs/visuals/schema-carte-grise.png`.

**Principe : ne pas traiter assurance et carte grise en silos, mais en BOUCLE.**
1. **Déclencheur commun** = achat / vente / import d'un véhicule.
2. **Deux portes d'entrée** qui se renvoient mutuellement : Assurance temporaire ⇄ Carte grise.
3. **Points de captation carte grise** (déjà en place côté Tempo) :
   - Menu global « Carte grise » (45 pages) → **hub `carte-grise.html`** (iframe Certimat `partner=7999`).
   - **CTA contextuels** sur carte-grise-barrée, import, plaque WW, frontière, achat-vente.
   - **Encart home** (à ajouter) sous le hero.
   - **Déclencheur post-souscription** (à ajouter) : après un devis assurance achat-vente → « Besoin de la carte grise ? ».
4. **Couche de réassurance** partout : habilité Ministère / France Titres · CPI immédiat · 24–72 h · paiement en plusieurs fois.
5. **Conversion** : iframe Certimat → commission ≈ 25 €.

## 5. Recommandations priorisées
- **P0** — Faire **whitelister nos domaines** chez Certimat (sinon rien ne s'affiche). *(message prêt : `docs/message-certimat.md`)*
- **P0** — **Cross-sell bidirectionnel** : le CTA carte grise est posé sur les pages clés ✅ ; ajouter le **retour CG → assurance** (déjà dans la page) et un **encart home**.
- **P1** — **Déclencheur post-souscription** (écran de confirmation + e-mail J+0) — *aucun concurrent ne le fait*.
- **P1** — **Pages SEO par démarche** (changement de titulaire, carte grise véhicule importé, duplicata, WW) pour capter la longue traîne sans affronter les pure-players sur « carte grise » sec.
- **P2** — **Tarification** : afficher un « à partir de X € de frais de service » une fois la commission calée avec Certimat.
- **P2** — **Outil carte grise dans l'app ChatGPT** (même logique que le devis).
