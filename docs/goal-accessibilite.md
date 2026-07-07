# /goal — Accessibilité & responsive de tempo-assurance.com

> Objectif : garantir que **tous** les utilisateurs (standard, malvoyants, navigation
> clavier seule, lecteurs d'écran, ordinateur/tablette/mobile) peuvent accomplir
> **toutes les actions essentielles** : obtenir un devis, souscrire, contacter le
> cabinet, faire une carte grise, lire les contenus.
> Cible de conformité : **WCAG 2.1 niveau AA**.

## Parcours essentiels couverts
1. Obtenir un devis / ouvrir le tarificateur (accueil, pages véhicule, page devis, modale).
2. Souscrire (redirection tunnel JL Assure, hors périmètre technique de ce site).
3. Contacter le cabinet (formulaire contact + anti-spam).
4. Faire une démarche de carte grise (page carte-grise + sous-pages).
5. Naviguer (menu principal + tiroir mobile + sous-menus).
6. Lire les contenus (blog, veille, actualités, FAQ, pages légales).

## Lots de travail
| Lot | Description | Statut |
|---|---|---|
| L1 | Audit automatisé (axe-core WCAG 2a/2aa/21a/21aa) + détection de scroll horizontal / débordements sur 3 breakpoints (1280 / 768 / 390). | ✅ |
| L2 | Navigation clavier : skip-link, ordre de tabulation, menu mobile (Échap, piège de focus, restitution du focus), accordéon FAQ, modale (piège de focus, Échap, restitution). | ✅ |
| L3 | CSS partagé : focus visible cohérent à fort contraste, correctif de contraste des CTA, prefers-reduced-motion, cibles tactiles. Fichier unique `assets/a11y.css` chargé sur les 57 pages. | ✅ |
| L4 | JS partagé + pages spécifiques : menu (Échap global + piège de focus + focus rendu au bouton), message d'erreur du formulaire contact annoncé (role=alert + focus). | ✅ |
| L5 | Revue multi-agents (3 auditeurs indépendants par groupe de pages) + balayage automatisé des 57 pages + revue finale + documentation. | ✅ |

## Méthode de validation
- Balayage axe-core sur les 57 pages HTML (hors fichier de vérification Google).
- Détection programmatique du scroll horizontal (`scrollWidth > clientWidth`) aux 3 breakpoints.
- Tests clavier pilotés (Playwright) : Tab / Entrée / Espace / Échap, vérification de l'anneau de focus, de `aria-expanded`, de la restitution du focus.
- Revue humaine (agents) : ordre des titres, qualité des `alt`, contraste des styles inline, cibles tactiles, libellés.

## Critère de fin (Definition of Done)
- 0 violation axe bloquante (impact serious/critical) sur les pages clés.
- 0 scroll horizontal non intentionnel aux 3 breakpoints.
- Tous les parcours essentiels réalisables au clavier seul, focus toujours visible.
- Formulaires étiquetés, messages d'état annoncés, images et icônes correctement exposées.
- Documentation livrée (`docs/audit-accessibilite.md`) + revue finale.

*(Détail des constats, corrections et risques résiduels : voir `docs/audit-accessibilite.md`.)*
