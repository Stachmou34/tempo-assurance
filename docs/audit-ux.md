# Audit UX des parcours principaux — tempo-assurance.com

**Rôle :** designer UX senior · **Date :** 6 juillet 2026
**Parcours audités :** (1) Accueil → compréhension de l'offre · (2) Devis → souscription
(tarificateur) · (3) Carte grise · (4) Contact.
**Méthode :** analyse heuristique (Nielsen) + captures desktop/mobile des parcours réels.

**Échelle de gravité :** 🔴 Critique (bloque ou casse la conversion) · 🟠 Élevé (friction forte)
· 🟡 Moyen (gêne mesurable) · ⚪ Faible (polish).

---

## Synthèse (top 8, par gravité)

| # | Gravité | Parcours | Problème | Catégorie |
|---|---|---|---|---|
| 1 | 🔴 | Devis + Carte grise | Tarificateur/outil en iframe **sans état de chargement** : boîte grise/vide pendant le chargement. | Feedback / état vide |
| 2 | 🔴 | Devis + Carte grise | **Aucun état d'erreur** si l'iframe échoue (outil tiers lent, bloqué, HS) : l'utilisateur reste devant un cadre vide, sans issue. | État d'erreur non conçu |
| 3 | 🟠 | Accueil | Cartes véhicule « **Calculer mon tarif** » → mènent à une page de contenu, pas au calculateur, et **sans pré-sélection** du véhicule. Promesse ≠ résultat. | Friction |
| 4 | 🟠 | Devis (mobile) | Le tarificateur (action principale) est **repoussé loin sous la ligne de flottaison** par l'intro + 3 étapes + badges. | Hiérarchie |
| 5 | 🟡 | Contact | Bouton « Envoyer » **sans état d'envoi/désactivation** : risque de double soumission, aucun retour pendant l'attente. | Feedback |
| 6 | 🟡 | Contact | Erreur = rechargement complet + **message générique** (« champ manquant, e-mail invalide ou anti-spam ») sans indiquer **quel** champ. | Étape propice aux erreurs |
| 7 | 🟡 | Accueil | Moitié basse = **pavés de texte SEO** avec longues listes de liens : faible scannabilité, dilue l'action. | Hiérarchie |
| 8 | ⚪ | Global | Boutons de navigation (cartes, CTA) **sans retour au clic** (état pressé/chargement) sur connexions lentes. | Feedback |

---

## 1. Hiérarchie de l'information

### 1.1 🟡 Accueil — pavés SEO en bas de page
Sous les cartes véhicule, la page enchaîne plusieurs blocs de texte dense (« Souscrire une
assurance temporaire en ligne », « Assurer votre véhicule pour une courte durée ») avec de
**longues listes de liens internes**. Utile au référencement, mais faible pour l'utilisateur :
peu scannable, aucune hiérarchie visuelle forte, l'action se dilue.
**Solution :** condenser en 2-3 blocs avec sous-titres + puces courtes ; déplacer les listes
de liens exhaustives vers un « bloc SEO » discret en fin de page ; garder au-dessus un rappel
d'action (bouton) tous les ~2 écrans.

### 1.2 🟡 Devis (mobile) — l'outil trop bas
Au-dessus de la ligne de flottaison mobile : header, fil d'Ariane, H1, paragraphe d'intro,
puis **3 grandes cartes d'étapes** empilées. Le tarificateur n'apparaît qu'après un long
défilement. L'action principale doit être plus haute.
**Solution :** sur mobile, réduire l'intro à 1 phrase, passer les 3 étapes en une bande
horizontale compacte (ou les déplacer **sous** le tarificateur), et ancrer le tarificateur
juste après le H1. Alternative : un bouton « Aller au tarif ↓ » collant.

### 1.3 ⚪ Accueil — chemins concurrents
Le hero propose 2 CTA + 5 pastilles de durée ; suit une grille de 8 véhicules + un 3ᵉ CTA.
Beaucoup de points d'entrée pour une même action (léger paradoxe du choix).
**Solution :** hiérarchiser visuellement un **CTA primaire** unique par écran ; traiter durées
et véhicules comme des raccourcis secondaires (déjà le cas visuellement, à conserver).

---

## 2. Points de friction

### 2.1 🟠 Cartes véhicule « Calculer mon tarif » trompeuses
Sur l'accueil, chaque carte (« Camion · Calculer mon tarif ») pointe vers la page de contenu
`assurance-temporaire-camion.html`, **pas** vers le tarificateur, et ne transmet **pas** la
catégorie. L'utilisateur qui veut « calculer » doit encore trouver l'outil et re-sélectionner
son véhicule.
**Solution concrète :** faire pointer les cartes vers
`devis-ou-souscription.html?categorie_vehi=CAM-CAM3` (le site sait déjà pré-remplir le
tarificateur via l'URL). « Calculer mon tarif » calcule alors vraiment, véhicule pré-choisi,
en 1 clic. (Si l'on tient aux pages de contenu pour le SEO, alors relibeller la carte en
« Voir l'assurance camion » et déplacer « Calculer mon tarif » comme CTA de ces pages.)

### 2.2 🟡 Tarificateur tiers — performance perçue
Le tarificateur et l'outil carte grise sont des iframes JL Assure (démarrage parfois lent,
cf. hébergement). Sans traitement, l'attente est vécue comme un bug (cf. §3).
**Solution :** état de chargement + `loading="lazy"` déjà présent ; ajouter un squelette
visuel (voir 3.1) pour transformer l'attente en attente « rassurée ».

### 2.3 🟡 Devis mobile — outil sous l'intro (voir 1.2).

---

## 3. Retours utilisateur manquants

### 3.1 🔴 Aucun état de chargement des iframes (devis + carte grise)
C'est le problème n°1. Pendant le chargement de l'iframe (`.quote-frame`,
`carte-grise` iframe), l'utilisateur voit une **zone grise/blanche vide** (voire une icône
« image cassée »). Sur l'outil **le plus important du site**, l'attente ressemble à une panne.
**Solution concrète :** placer un squelette dans le conteneur `.quote`, **derrière** l'iframe,
recouvert quand l'iframe peint :
```html
<div class="quote">
  <div class="quote-head">…</div>
  <div class="quote-frame-wrap">
    <div class="quote-loading" aria-hidden="true">
      <span class="spinner"></span>
      Chargement du tarificateur sécurisé…
    </div>
    <iframe class="quote-frame" …></iframe>
  </div>
  <div class="quote-secure">…</div>
</div>
```
Le loader est masqué au premier `postMessage` de hauteur émis par JL Assure (déjà écouté
dans `site.js`) ou à l'événement `load` de l'iframe.

### 3.2 🟡 Contact — pas d'état d'envoi
Le bouton « Envoyer le message » ne se désactive pas et n'affiche pas « Envoi… » pendant la
soumission (POST plein-page). Risque de double clic / double envoi, aucun retour.
**Solution :** au `submit`, désactiver le bouton et afficher « Envoi en cours… » (rétabli si
la validation native échoue).

### 3.3 ⚪ Feedback au clic des boutons de navigation
Les CTA/cartes qui naviguent ne donnent aucun signe (état pressé/chargement) : sur mobile
lent, l'utilisateur peut re-cliquer.
**Solution :** micro-état `:active` déjà présent ; ajouter au besoin un curseur d'attente sur
les CTA qui déclenchent une navigation lourde.

---

## 4. Étapes propices aux erreurs

### 4.1 🔴 Tarificateur/outil sans issue en cas d'échec (voir aussi 3.1)
Si l'iframe ne charge pas (outil tiers indisponible, bloqué par un réseau d'entreprise,
timeout), l'utilisateur est **coincé devant un cadre vide**, sans message ni alternative.
**Solution concrète :** minuteur de repli. Si aucun `postMessage`/`load` après ~8 s, afficher
dans `.quote-loading` un état d'erreur :
« Le tarificateur met plus de temps que prévu. Réessayez, ou obtenez votre devis par
téléphone au **09 78 31 02 93** (7 j/7) » + bouton « Réessayer » (recharge l'iframe) + lien
« Ouvrir le tarificateur dans un nouvel onglet ». Idem pour l'outil carte grise.

### 4.2 🟡 Contact — erreurs non localisées
En cas d'échec serveur, retour sur la page avec **un message générique** listant toutes les
causes possibles, sans surligner le champ fautif. L'utilisateur doit deviner.
**Solution :** validation en ligne (HTML5 + petit JS) qui marque le champ concerné et affiche
le motif sous le champ, avant l'envoi ; conserver les valeurs saisies en cas d'erreur serveur.

### 4.3 ⚪ Anti-spam arithmétique
La question « 3 + 4 ? » est simple et accessible, mais un utilisateur pressé peut se tromper
et perdre sa saisie.
**Solution :** déjà acceptable ; s'assurer que les champs sont repeuplés en cas d'erreur (lié
à 4.2).

---

## 5. États vides ou d'erreur jamais conçus

| État | Statut | Action |
|---|---|---|
| **Chargement du tarificateur / outil carte grise** | 🔴 **Non conçu** | Squelette + spinner (3.1). |
| **Échec de l'iframe (devis / carte grise)** | 🔴 **Non conçu** | Repli téléphone + réessayer + nouvel onglet (4.1). |
| **Contact — succès** | ✅ Conçu | Page dédiée `confirmation-mail.html`. RAS. |
| **Contact — erreur** | 🟡 Minimal | Message générique ; à localiser (4.2). |
| **404 (page introuvable)** | ✅ Conçu | `404.html` présent et clair. RAS. |
| **FAQ — aucun résultat de recherche** | ✅ Conçu | `#faqNoResult` géré en JS. RAS. |
| **Sans JavaScript** | 🟡 Non traité | Les iframes fonctionnent, mais menu mobile et modale non ; ajouter un `<noscript>` d'info sur les pages à outil. |

---

## Statut d'implémentation (7 juillet 2026)

- ✅ **Priorité 1 — États de chargement + erreur des iframes** : voile (spinner + message)
  sur le tarificateur (devis) et l'outil carte grise, masqué au `load`, avec repli
  (téléphone + Réessayer + nouvel onglet) après délai. Étendu à la **modale tarificateur**
  des 34 pages véhicule.
- ✅ **Priorité 3 — Tarificateur trop bas sur mobile** : bouton « Calculer mon tarif ↓ »
  (mobile) sous l'intro de la page devis.
- ✅ **Priorité 2 — Calculateur pré-rempli sur les pages véhicule** : choix retenu =
  conserver les pages véhicule (SEO). Ces pages ont déjà un CTA pré-rempli en tête ; on a
  fiabilisé le calculateur qu'il ouvre (état de chargement/erreur de la modale).
- ✅ **Priorité 4 — Feedback du formulaire contact** : bouton « Envoi en cours… » +
  anti double-soumission ; anti-spam validé côté client (message localisé sur le champ via
  l'API de validation native) ; valeurs restaurées en cas d'erreur serveur.
- ✅ **Priorité 5 — Densité de l'accueil** : longue liste des cas d'usage sur 2 colonnes
  (scannabilité) + rappel d'action dans la zone dense. Aucun contenu ni lien retiré (SEO
  intact) — la condensation plus poussée reste possible sur demande.

## Recommandations priorisées (impact / effort)

1. **🔴 État de chargement + d'erreur des iframes** (devis & carte grise) — *fort impact, effort
   moyen*. Transforme le pire moment (attente/panne apparente) sur l'outil le plus important.
2. **🟠 Pré-remplir depuis les cartes véhicule** (`?categorie_vehi=…`) — *fort impact, effort
   faible*. « Calculer mon tarif » calcule vraiment, en 1 clic.
3. **🟠 Remonter le tarificateur sur mobile** — *impact moyen-fort, effort faible*.
4. **🟡 État d'envoi + erreurs localisées du formulaire contact** — *impact moyen, effort
   faible-moyen*.
5. **🟡 Alléger/condenser le contenu SEO de l'accueil** — *impact moyen, effort moyen*.

*Les points 1 à 3 concentrent l'essentiel du gain de conversion pour un effort limité.*
