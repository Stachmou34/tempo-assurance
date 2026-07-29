# Handoff : Tempo-Assurance — Page d'accueil, piste « E · Plein champ »

## Vue d'ensemble
Refonte de la page d'accueil de **Tempo-Assurance** (JL Assure), un assureur
spécialiste de **l'assurance automobile temporaire et frontière, de 1 à 90 jours**.
La piste « E · Plein champ » est une direction *affiche suisse* : un grand aplat
de couleur vert profond en héros, une typographie display surdimensionnée, et la
durée de garantie rendue comme une **barre de temps horizontale** dégradée
vert → orange. Le héros contient un mini-calculateur de tarif fonctionnel
(véhicule + durée → prix en direct).

## À propos des fichiers de design
Les fichiers de ce paquet sont des **références de design réalisées en HTML/React** :
un prototype montrant l'apparence et le comportement souhaités, **pas du code de
production à copier tel quel**. La tâche consiste à **recréer ce design dans
l'environnement existant du codebase cible** (React, Vue, Next, Astro, etc.) en
suivant ses conventions et sa bibliothèque de composants. Si aucun environnement
n'existe encore, choisir le framework le plus adapté (une simple page React/Next
ou même HTML+CSS statique suffit — il n'y a pas de logique serveur complexe ici).

Le prototype utilise React 18 via Babel in-browser uniquement pour la démo ; en
production, transpiler normalement et remplacer les polices CDN par les polices
auto-hébergées.

## Fidélité
**Haute-fidélité (hifi).** Couleurs, typographie, espacements et interactions sont
définitifs. Recréer l'UI au pixel près avec la bibliothèque et les patterns du
codebase. Les valeurs exactes figurent dans la section « Design tokens ».

---

## Écran : Page d'accueil (single page, responsive)
**But :** présenter l'offre, laisser l'utilisateur estimer un tarif et l'amener vers
le devis/souscription.

La page est une colonne verticale de sections, largeur de contenu max **1240px**,
centrée, padding latéral **48px** (desktop) / **28px** (≤900px) / **20px** (≤560px).

### 1. Héros — aplat vert (`.field`)
- **Fond :** vert profond `#134E2A` plein bord (full-bleed), texte blanc.
- **Filigrane :** un énorme chiffre (la durée courante, ex. `21`) en
  Bricolage Grotesque 800, **560px**, couleur `rgba(255,255,255,.05)`, positionné
  à droite, `translateY(-46%)`, `z-index:0`, non sélectionnable. Réduit à 360px
  ≤920px, masqué ≤560px.
- **Barre de nav** (hauteur 84px, `z-index:3`) :
  - Logo/wordmark à gauche (voir « Wordmark »).
  - Liens centre : `Devis · Tarifs · Véhicules · FAQ · Espace pro`, blanc 70%
    opacité, 15px/500. **Masqués ≤920px.**
  - À droite : bouton `Espace pro` (style *line* : bordure `rgba(255,255,255,.3)`,
    fond transparent, texte blanc — **masqué ≤920px**) + bouton `Mon devis`
    (style *orange*).
- **Eyebrow / kick :** pastille `rgba` pleine `#41C064` (vert clair), texte
  `#134E2A`, JetBrains Mono 12px, lettrage `.09em`, MAJUSCULES, icône horloge +
  « Assurance 1 → 90 jours ». Padding 8/13px, radius 999px.
- **H1 :** Bricolage Grotesque 800, **104px**, line-height `.9`,
  letter-spacing `-0.045em`, max-width 14ch. Texte : « Le temps que vous **voulez.** »
  où « voulez. » est en orange `#F2811D`. (68px ≤920px, 52px ≤560px.)
- **Lede :** Schibsted Grotesk 20px, line-height 1.5, `rgba(255,255,255,.72)`,
  max-width 46ch.

#### Time bar (calculateur, `.timebar`)
- **Ligne supérieure** (`.tbtop`) : à gauche label JetBrains Mono 12px
  `rgba(255,255,255,.6)` MAJ « Glissez pour fixer la durée de garantie » ; à droite
  valeur live Bricolage 800 22px « {jours} jours · {CODE} » (le « · CODE » en vert
  clair `#41C064`).
- **La barre** (`.bar`) : hauteur **64px**, radius 14px, fond `rgba(255,255,255,.1)`,
  bordure `rgba(255,255,255,.18)`.
  - **Remplissage** (`.fill`) : `width` = `((jours-1)/89)*100%`, dégradé
    `linear-gradient(90deg, #41C064, #F2811D)`, radius 14px, transition
    `width .25s cubic-bezier(.2,.7,.3,1)`.
  - **Knob** au bout du remplissage : barre verticale blanche 6×40px, radius 3px,
    halo `0 0 0 4px rgba(255,255,255,.2)`.
  - **Grille de fond** : 12 traits verticaux `rgba(255,255,255,.12)` répartis.
  - Un `<input type="range" min=1 max=90>` transparent (`opacity:0`) superposé en
    `position:absolute; inset:0; z-index:4` capte le drag. **C'est la vraie commande**
    — le remplissage n'est qu'un rendu visuel piloté par la valeur.
- **Ticks d'échelle** sous la barre : `1 jour · 30 jours · 60 jours · 90 jours`,
  JetBrains Mono 11px `rgba(255,255,255,.5)`, `space-between`.
- **Pied** (`.tbfoot`, grille `auto 1fr auto`) :
  - **Pills véhicule** : un bouton par véhicule affichant son code (`VL UT PL CC MT RM`),
    JetBrains Mono 12px/600, bordure `rgba(255,255,255,.25)` transparente ; état
    actif = fond blanc, texte `#134E2A`.
  - **Bloc prix** à droite : label JetBrains Mono 11px MAJ « {Nom véhicule} · {j} j »
    puis prix Bricolage 800 **44px** ; bouton `Souscrire` style *paper*
    (fond `#FBFBF7`, texte vert `#134E2A`).
  - ≤920px la grille passe en 1 colonne, bloc prix aligné à gauche.

### 2. Blocs de features (`.blocks`, grille 2×2, gap 18px → 1 col ≤920px)
Quatre cartes radius 20px, padding 38px, min-height 230px, flex column
space-between. Chaque carte : petite icône en haut, puis titre Bricolage 800 30px +
paragraphe.
| # | Fond | Texte | Icône | Titre | Corps |
|---|------|-------|-------|-------|-------|
| 1 | vert `#134E2A` | blanc | éclair (vert clair) | Attestation immédiate | Éditée et envoyée par e-mail dès le paiement, 24h/24 et 7j/7. Valable sur-le-champ. |
| 2 | orange `#F2811D` | blanc | horloge (blanc) | De 1 à 90 jours | Vous fixez la durée au jour près. Pas d'abonnement, pas de reconduction tacite. |
| 3 | blanc + bordure `--line` | encre | bouclier (vert) | Garantie RC conforme | Responsabilité civile au code des assurances, en France et aux frontières. |
| 4 | encre `#16201A` | blanc | check (vert clair) | Les cas qui coincent | Permis étranger, plaque de transit, carte grise barrée, import-export : on assure. |

En-tête de section (`.shead`) : kick JetBrains Mono 12px MAJ vert « Pourquoi Tempo » +
H2 Bricolage 800 52px line-height 1 « Quatre raisons d'arrêter le compteur quand
vous voulez ».

### 3. Liste véhicules (`.vstack`)
En-tête : kick « Véhicules couverts » + H2 « Six familles, un tarif net ».
Liste à filet supérieur 2px encre. Chaque ligne (`.vbig`, grille `1fr auto auto`,
padding 26px) :
- Nom véhicule Bricolage 800 **40px**.
- Méta Schibsted 14.5px muted « {sous-titre} · code {CODE} ».
- Tarif JetBrains Mono 15px vert « dès {prix}/j ».
- **Hover :** fond devient vert `#134E2A`, texte blanc, padding latéral +18px,
  radius 4px (transition `.14s`). ≤560px la méta est masquée, nom à 30px.

### 4. CTA final (`.ctaf`)
Carte pleine orange `#F2811D`, radius 24px, padding 64px, centrée. H2 Bricolage 800
**60px** « Réglez la durée. Roulez couvert. » + paragraphe blanc 88% + bouton
`Démarrer mon devis` style *ink* (fond encre, texte blanc).

### 5. Footer (`footer`)
Fond encre `#16201A`, texte `rgba(255,255,255,.7)`. Grille `1.6fr 1fr 1fr 1fr`
(→ 1fr 1fr ≤920px → 1 col ≤560px), padding 60/0/36px.
- Colonne 1 : wordmark (clair) + descriptif « Assurance automobile temporaire et
  frontière, de 1 à 90 jours. Édition immédiate, 24h/24. »
- Produits : Auto temporaire · Poids lourd · Camping-car · Frontière
- Aide : FAQ · Documentation · Contact · Espace pro
- Légal : Mentions légales · CGV · Confidentialité
- Barre légale (filet haut `rgba(255,255,255,.12)`) : « © 2026 Tempo-Assurance —
  JL Assure » à gauche, « Garantie RC · CIC · 24/7 » (mono) à droite.

---

## Données & modèle de prix
Six véhicules, avec un tarif journalier de base (`rate`, en €/jour) :
| id | Nom | Sous-titre | Code | rate |
|----|-----|-----------|------|------|
| vl | Voiture | VL < 3,5 T | VL | 5.9 |
| util | Utilitaire | Camionnette | UT | 7.2 |
| pl | Poids lourd | > 3,5 T | PL | 12.4 |
| cc | Camping-car | VASP | CC | 8.4 |
| moto | Moto | 2 & 3 roues | MT | 4.6 |
| rem | Remorque | & semi-remorque | RM | 3.2 |

**Formule (illustrative, à remplacer par le vrai tarif assureur) :**
```
jours  = clamp(jours, 1, 90)
taper  = jours <= 7  ? 1
       : jours <= 30 ? 0.92
       :               0.84
prix   = round(14 + rate * jours * taper)   // 14 € = frais de dossier fixes
```
`dès {prix}/j` dans les listes = `tempoPrice(rate, 1)`. Affichage monétaire :
`toLocaleString('fr-FR') + ' €'`.

> ⚠️ Le barème ci-dessus est une maquette. Le brancher sur le vrai moteur tarifaire
> de l'assureur (qui dépend en réalité de l'âge, l'ancienneté du permis, le profil, etc.).

## Interactions & comportement
- **State** (2 variables) : `veh` (id véhicule, défaut `'vl'`) et `days` (1–90,
  défaut `21`). Le prix et tous les libellés dérivés se recalculent à chaque rendu.
- **Slider durée :** input range superposé transparent ; met à jour `days` ;
  remplissage et knob suivent en `width %` avec transition `.25s`. Le chiffre
  filigrane du héros affiche `days` zéro-paddé sur 2.
- **Pills véhicule :** clic → `setVeh(id)`, met l'état actif sur la pill.
- **Hover lignes véhicule :** inversion vert/blanc + padding (cf. plus haut).
- **Reduced motion :** aucune animation décorative en boucle ; respecter
  `prefers-reduced-motion` si vous ajoutez des entrées.
- **Responsive :** tout est piloté par container queries sur `.tpe`
  (breakpoints **920px** et **560px**). En production, des media queries classiques
  conviennent si le composant occupe toujours la pleine largeur.

## Design tokens
**Couleurs**
```
--ink:          #16201A   (encre, footer, CTA ink)
--paper:        #FBFBF7   (fond page)
--muted:        #5C6660   (texte secondaire)
--line:         rgba(22,32,26,.10)
--green:        #2F9E44   (primaire, accents)
--green-bright: #41C064   (vert clair, accents sur fond sombre)
--green-soft:   #EAF6EC
--orange:       #F2811D   (accent chaud unique)
--field:        #134E2A   (aplat héros — vert profond)   [défini sur .tpe]
--field-2:      #0F3D21   (variante plus sombre, dispo)   [défini sur .tpe]
```
**Typographie** (Google Fonts → auto-héberger en prod)
- Display : **Bricolage Grotesque** (800) — H1/H2/prix/noms véhicules
- Texte : **Schibsted Grotesk** (400–600) — corps, lede, nav
- Mono : **JetBrains Mono** (400–600) — labels, codes, ticks, tarifs
**Échelle type clé (desktop) :** H1 104 · H2 52 · CTA H2 60 · prix héros 44 ·
nom véhicule 40 · block titre 30 · lede 20 · corps 15–16 · mono labels 11–12.
**Rayons :** boutons 11px · barre/fill 14px · cartes feature 20px · CTA 24px.
**Ombres :** boutons orange `0 10px 24px -10px rgba(242,129,29,.8)`.
**Breakpoints :** 920px (tablette) · 560px (mobile).

## Wordmark
Le logo est reconstruit en typo (pas d'image) : « **tempo.** » en Bricolage/
Schibsted 800, le point « . » en vert `--green` (ou `--green-bright` sur fond
sombre), suivi de « assurance » en 500, ~0.62× la taille, en gris/blanc translucide.
Sur fond sombre, passer `tone="light"`. Voir `Wordmark` dans `tempo-shared.jsx`.
→ Si un vrai fichier logo existe (TEMPO orange→vert + « Assurance » script, badge
24/7), l'intégrer à la place — il n'a pas été utilisé ici pour ne pas figer le
traitement daté du PNG d'origine.

## Assets
- **Aucune image** dans cette piste (E n'utilise pas de placeholder photo).
- Toutes les icônes sont des **SVG inline minimalistes** définis dans
  `tempo-shared.jsx` : `Clock`, `Check`, `ArrowR`, `Shield`, `Bolt`. Les remplacer
  par le set d'icônes du codebase si besoin.
- Polices via Google Fonts (Bricolage Grotesque, Schibsted Grotesk, JetBrains Mono).

## Fichiers de ce paquet
- `Piste E - Plein champ.html` — page autonome qui rend **uniquement** la piste E
  (ouvrir dans un navigateur pour la référence visuelle et interactive).
- `tempo-var-e.jsx` — le composant `TempoVarE` : tout le markup + le `<style>`
  injecté (préfixe `.tpe`). **La source de vérité du design.**
- `tempo-shared.jsx` — tokens/données (`TEMPO_VEHICLES`, `tempoPrice`, `tempoEuro`)
  et primitives (`Clock`, `Check`, `ArrowR`, `Shield`, `Bolt`, `Wordmark`,
  `Placeholder`).

Le fichier maître multi-pistes (canvas de comparaison A–E) reste dans le projet
d'origine ; ce paquet ne contient que ce qu'il faut pour implémenter **E**.
