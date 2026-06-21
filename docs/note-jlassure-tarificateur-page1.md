# Note à JL Assure — première page du tarificateur (marque blanche)

**De :** MCJ COURTAGE / Tempo-Assurance (client marque blanche `id=43`, `cd=BLA1905B`)
**Objet :** pistes d'amélioration de la conversion sur la 1ʳᵉ page du tarificateur embarqué, et une question préalable sur le thème par client.
**Contexte :** page concernée `assure_tempo_rapide_mb.php` (et la version en préparation `mb2.php`). Nous l'embarquons en iframe sur `www.tempo-assurance.com`. Analyse réalisée sur le fichier `mb2.php` que vous nous avez transmis.

> Bonne nouvelle côté technique : **aucune erreur JavaScript**. Les 16 blocs de script passent le contrôle de syntaxe, il n'y a pas de redéclaration entre blocs, et le chargement réel (Chromium, profil mobile) ne remonte **aucune exception, aucune erreur console, aucune requête en échec**. La page se charge proprement. Les points ci-dessous sont donc des sujets **UX/UI/conversion**, pas des bugs.

---

## 0. Question préalable — thème par client

La page passe déjà des paramètres par client (`id`, `cd`, `tip`, `adrsite`). Aujourd'hui elle s'affiche en **vert `#689d71` + police Roboto**, sans notre charte ni notre ORIAS.

**Votre marque blanche permet-elle un thème par client** (couleurs, logo, bloc identité/ORIAS, mentions) piloté par `id`/`cd` ?
- Si **oui** : pourriez-vous appliquer pour `id=43` notre charte (bleu `#2563EB` / marine `#0F172A` / `system-ui`), notre logo et la mention « MCJ COURTAGE — ORIAS n° 26008651 » ? Cela réglerait à soi seul plusieurs points du §1.
- Si **non** : ce serait une évolution très utile (à tous vos clients), cf. §1.

La réponse à cette question détermine si les points de branding ci-dessous sont une simple **configuration** ou une **évolution du moteur**.

---

## 1. Branding & charte (idéalement : configuration par client)

1. **Couleurs hors marque + contraste insuffisant.** Le vert des CTA (`#689d71`) avec texte blanc est à ~2,7:1 → **échec WCAG AA** (seuil 4,5:1). Variable CSS `--orange-vitamine` (qui contient en réalité du vert). → Re-mapper vers notre bleu + remplacer la quinzaine de hex codés en dur.
2. **Police Roboto** (chargée via Google Fonts) au lieu d'une pile système → basculer sur `system-ui` (perf + cohérence).
3. **Aucune identité affichée** (ni courtier, ni ORIAS, ni assureur) sur la page → afficher le bloc identité du client.

---

## 2. Moteur partagé — UX/conversion (évolutions profitant à tous vos clients)

Par ordre d'impact estimé :

1. **`min-height:100vh` sur `html,body` (≈ ligne 950).** Comme la hauteur de l'iframe est pilotée par le `postMessage` du `ResizeObserver`, forcer le document à ≥ 1 plein écran **gonfle la hauteur remontée** : chez nous l'iframe s'affiche comme une grande boîte grise quasi vide sous un formulaire d'une seule question. **C'est probablement la 1ʳᵉ cause mécanique d'abandon.** → Laisser le contenu définir la hauteur (retirer `min-height:100vh` et `width:100%` sur `html,body`).
2. **Encadré valeur/prix masqué jusqu'au dernier champ** (`right-column` `display:none`, ≈ ligne 1956) → afficher les garanties + un état « estimation en cours » dès le départ ; ne garder verrouillé que le prix exact.
3. **PTAC demandé à tout le monde** (≈ ligne 1784), jargon, non conditionnel, et sans attribut `required` alors qu'il bloque la cascade → ne l'afficher que pour camping-car / poids lourd / remorque (même logique que l'option « pas de puissance » déjà gérée pour les remorques, ≈ lignes 1760-1778).
4. **Impasses silencieuses :**
   - Pays exclus (Pologne, Roumanie, Italie) **retirés sans message** (≈ ligne 1722) → afficher un message explicite + un repli téléphone (le numéro est déjà dans `$tip`).
   - Profil sans tarif → `hideTarifButtons()` laisse un **chargement éternel** sans message (≈ lignes 2255, 2261) → vrai état d'erreur + relance + repli humain.
   - Âge / durée hors scope → mur sec ; ajouter un CTA « Appelez un conseiller au … ».
5. **Spinner de calcul invisible.** `.loading-spinner` est référencé (≈ lignes 1990, 2183) mais **n'existe pas en CSS** → pendant les 3-4 requêtes enchaînées (`param_table → read_table → get_durees → get_tarifs`), l'attente ressemble à un blocage. → Définir le spinner (ou réutiliser le `.progress-bar` déjà stylé) + libellé « Calcul de votre tarif… ».
6. **Aide carte grise manquante** sur « Puissance fiscale » (≈ ligne 1752) et autres → texte d'aide « champ P.6 de votre carte grise ».
7. **Motif dans le chemin critique alors qu'il ne tarifie rien** (≈ ligne 1839, absent de `MB_PARAM_TABLE_FIELDS`/`MB_TARIF_RECALC_FIELDS`) → le rendre optionnel/non bloquant ou le déplacer après le prix.
8. **`alert()` natifs** dans `sendEmail()` (≈ lignes 2787, 2809-2818) → messages en ligne (l'`alert()` est perturbant dans un iframe).
9. **Cibles tactiles < 44px** (champs ~38-40px, e-mail ~36px) et **focus invisible** (`outline:none`) → `min-height:44-48px`, `font-size:16px` (évite le zoom iOS), et anneau `:focus-visible`.
10. **1ʳᵉ question intimidante** : menu de 12 options en 8 groupes avec jargon (M1/N1/GVW) → envisager des cartes visuelles (Voiture / Utilitaire / Camping-car / Moto-Quad / Poids lourd / Autre).

---

## 3. Hygiène de code (à nettoyer, sans urgence)

- Code mort commenté référençant `#subscription-button` (≈ lignes 1921, 1929) — sans danger car commenté.
- Validation `blur` morte (dimanche / horaires) ≈ lignes 1875-1934.
- `console.log` de debug en production (dont la valeur `mb_prefill`, ≈ ligne 1620).
- `Math.random()` qui fabrique de fausses valeurs pour un panneau `display:none` (≈ lignes 2927-2955).

---

## 4. Ce que nous faisons déjà de notre côté

En attendant, nous avons enrichi **notre page** autour de l'iframe (ce que nous maîtrisons) : bandeau de confiance (ORIAS, assureur HDI, attestation immédiate, sans engagement, paiement CIC) au-dessus du tarificateur, et bande garanties + tarif dégressif en dessous. Cela couvre une partie de la réassurance, mais **ne remplace pas** les points §1-§2 qui sont dans votre moteur.

---

## 5. Visuels joints

- `actuel-desktop-1-initial.png` / `actuel-mobile-1-initial.png` : l'état actuel (titre + 1 menu + grand vide).
- `propose-desktop.png` / `propose-mobile.png` : cible proposée (charte, réassurance, encadré valeur/prix visible, CTA dominant).

Détail complet ligne par ligne : `docs/analyse-tarificateur-page1.md`.
