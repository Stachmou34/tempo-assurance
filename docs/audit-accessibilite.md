# Audit accessibilité & responsive — tempo-assurance.com

**Date :** 6 juillet 2026 · **Référentiel :** WCAG 2.1 niveau AA
**Périmètre :** 57 pages HTML + `assets/site.js` + nouveau `assets/a11y.css`.
**Méthode :** axe-core 4.10 (tags wcag2a/2aa/21a/21aa) sur les 57 pages ; détection
programmatique du scroll horizontal aux breakpoints 1280 / 768 / 390 px ; tests
clavier pilotés (Playwright : Tab / Entrée / Espace / Échap, anneau de focus,
`aria-expanded`, restitution du focus) ; revue humaine par 3 auditeurs indépendants
(pages véhicule/tarifs, pages interactives/formulaires, contenus/légales).

---

## 1. Résultat global

- **Responsive :** aucun scroll horizontal ni débordement réel aux 3 breakpoints, sur
  aucune des 57 pages. (Les éléments hors écran détectés — skip-link, tiroir mobile en
  `translateX(105%)`, honeypot — sont intentionnels et ne provoquent pas de défilement.)
- **axe-core :** après correctifs, **0 violation** sur les 57 pages
  (avant : 1 sérieuse sur la FAQ + contraste sérieux sur toutes les pages « véhicule »).
- **Clavier :** tous les parcours essentiels réalisables au clavier seul, focus toujours
  visible, pièges de focus corrects (tiroir mobile + modale), Échap opérationnel partout.

---

## 2. Problèmes détectés et corrigés

### A. Transverses (via le nouveau fichier `assets/a11y.css`, chargé sur les 57 pages)

| # | Problème | Gravité | Correctif |
|---|---|---|---|
| A1 | **Contraste des boutons CTA** : la règle générique `main a:not(.btn)…` repeignait `.cta-btn` en bleu (#2563EB) ; sur le fond navy de la FAQ → **3,45:1** (échec AA). | Sérieux | `main a.cta-btn, main a.cta-btn-modal { color:#fff }` → 17:1. Le hero (`.btn` navy sur blanc) n'est **pas** touché. |
| A2 | **Focus clavier peu/pas visible** : aucune règle `:focus-visible` pour liens, boutons, cartes, menu. | Sérieux | Anneau `outline:3px solid #1D4ED8` (blanc sur fonds sombres), jamais rogné (outline vs box-shadow). |
| A3 | **Gris secondaire trop clair** : `--grey #64748B` tombait à **4,32:1** sur l'encart estimateur `#EFF4FF` (échec AA), signalé sur toutes les pages véhicule. | Sérieux | `--grey` assombri à **#5B6779** (≥5,2:1 partout). N'affecte que du texte sur fond clair → sans risque. |
| A4 | **Mouvement** : pas de prise en compte de `prefers-reduced-motion`. | Moyen | `@media (prefers-reduced-motion:reduce)` neutralise animations/transitions. |
| A5 | **Cibles tactiles** : bouton de fermeture de modale ~34×30 px, `.nav-close` ~39 px. | Moyen | `min-width/height:44px` sur `.menu-toggle`, `.nav-close`, `.modal-header button`. |
| A6 | **Étoile Trustpilot** (badge footer) : ★ blanc sur #00b67a ≈ **2,6:1**. | Faible | Fond assombri à #00875a (>3:1). |

### B. JavaScript partagé (`assets/site.js`)

| # | Problème | Gravité | Correctif |
|---|---|---|---|
| B1 | **Échap ne fermait pas le menu mobile** sur les pages sans modale devis (le gestionnaire était imbriqué dans `if (modal)`). | Sérieux | Gestionnaire Échap → `closeNav()` global, sur toutes les pages. |
| B2 | **Pas de piège de focus dans le tiroir mobile** : la tabulation sortait derrière l'overlay. | Moyen | Boucle Tab/Shift+Tab confinée au tiroir tant qu'il est ouvert. |
| B3 | **Focus non restitué** à la fermeture du menu. | Moyen | Le focus revient au bouton « MENU » déclencheur. |

### C. Pages spécifiques

| # | Page | Problème | Gravité | Correctif |
|---|---|---|---|---|
| C1 | `tarif-assurance-temporaire.html` | **Prix invisibles aux lecteurs d'écran sur mobile** : le tableau est `display:none` <700 px et les cartes mobiles portaient `aria-hidden="true"`. | Sérieux | Retrait de `aria-hidden` (les deux vues sont mutuellement exclusives par `display`). |
| C2 | `tarif-assurance-temporaire.html` | Tableaux sans `scope` ni en-têtes de ligne. | Moyen | `scope="col"` sur les en-têtes, 1re cellule de chaque ligne en `th scope="row"` (apparence claire préservée via `a11y.css`). |
| C3 | `faq-assurance-temporaire.html` | **Panneaux fermés focusables/lus** (`max-height:0` mais pas `display:none`) ; **aucun lien** bouton↔panneau. | Sérieux | `visibility:hidden` quand fermé (hors tabulation et arbre d'accessibilité) ; `aria-controls` + `id` + `role="region"` + `aria-labelledby`. |
| C4 | `veille-auto.html` | Numéros de sommaire ocre `#B7791F` ≈ **3,66:1** (petit texte). | Moyen | Assombris à `#8A5A12` (≥4,8:1). Les gros numéros de rubrique (32 px) restent conformes (large text ≥3:1). |
| C5 | `devis-ou-souscription.html` | Saut de hiérarchie de titres h1 → **h3** → h2 (aside avant la 1re section). | Moyen | `h3` de l'aside passé en `h2` (taille visuelle conservée). |
| C6 | `contact.html` | Message d'erreur non annoncé aux lecteurs d'écran. | Moyen | `role="alert"` + `tabindex="-1"` + `focus()` à l'affichage. |
| C7 | `cgu-ia.html`, `confidentialite-ia.html` | `assets/site.js` non chargé (incohérence). | Faible | Script ajouté sur les deux pages. |

---

## 3. Points vérifiés déjà conformes (aucune action)

- **Images** : 100 % des `<img>` ont un `alt` descriptif (0 sans alt sur tout le site).
- **iframes** : 41/41 ont un `title` descriptif.
- **Formulaire contact** : chaque champ a un `<label for>` ; requis marqués (`required`) ;
  honeypot correctement neutralisé pour l'AT (`aria-hidden` + `tabindex="-1"`).
- **Modale devis / carte grise** : `role="dialog"` + `aria-modal` + libellé ; bouton de
  fermeture avec `aria-label` ; piège de focus + Échap + restitution du focus (JS).
- **Icônes SVG décoratives** : `aria-hidden="true"`, toujours accompagnées de texte.
- **Champ de recherche FAQ** : `aria-label` présent.
- **Ordre des titres** : un seul `h1` par page, pas de saut (hors C5, corrigé).

---

## 4. Risques résiduels / limites connues

1. **Contraste des boutons au survol** : `.btn:hover` passe en bleu #2563EB (blanc ≈ 3,7:1).
   Non signalé par axe (état par défaut conforme, navy 17:1) ; concerne seulement le survol
   souris. Non modifié pour ne pas altérer l'identité visuelle. *Piste : survol en #1D4ED8.*
2. **Pages légales IA** (`cgu-ia`, `confidentialite-ia`) : en-tête/pied réduits (logo +
   « Retour au site »), différents du gabarit standard. Fonctionnels et accessibles, mais
   divergents. *Décision produit : harmoniser ou conserver ce format minimal.*
3. **Ouverture en nouvel onglet** : les liens `target="_blank"` (sources de la veille,
   Trustpilot…) n'indiquent pas explicitement l'ouverture d'un onglet (bonne pratique 3.2.5,
   niveau AAA). `rel="noopener"` bien présent. *Amélioration AAA optionnelle.*
4. **Densité de certains liens** (listes du footer ~22 px, `<select>` estimateur ~34 px) :
   sous la cible tactile idéale de 44 px, mais il s'agit de liens texte en liste / d'un
   `<select>` natif (critère AAA 2.5.5, non bloquant AA).
5. **Tunnel de souscription** (jlassure.com, en iframe) : hors périmètre technique de ce
   site ; son accessibilité relève de JL Assure.

---

## 5. Revue finale

Tous les parcours essentiels (devis, ouverture du tarificateur, contact, carte grise,
lecture des contenus, navigation) sont **réalisables au clavier seul**, avec un **focus
toujours visible**, sur ordinateur, tablette et mobile, sans scroll horizontal. Les
**lecteurs d'écran** disposent désormais des libellés, en-têtes de tableau, régions FAQ,
messages d'état et prix mobiles nécessaires. L'analyse automatisée (axe-core, 57 pages) ne
remonte **plus aucune violation** WCAG 2.1 AA ; les écarts restants (section 4) sont des
améliorations de niveau AAA ou des décisions produit, non bloquantes.

**Validation :** balayage axe 57 pages (0 violation) + tests clavier pilotés + revue
tri-agents. Détail des lots et critères de fin : `docs/goal-accessibilite.md`.
