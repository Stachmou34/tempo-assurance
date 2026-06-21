# Analyse profonde — page 1 du tarificateur marque blanche (JL Assure)

Fichier analysé : `assure_tempo_rapide_mb2.php` (version **mise à jour**, 4 207 lignes, CSS + 16 blocs `<script>` en ligne).
Page de production actuelle : `assure_tempo_rapide_mb.php` (la version `mb2` n'est **pas encore déployée** — l'URL renvoie 404).
Objectif : c'est l'écran où l'on perd le plus de transformation. Cible : conversion + zéro erreur JavaScript.

Méthode : deux analyses dédiées (UI / design visuel et UX / CRO) + vérification JavaScript automatisée (contrôle de syntaxe des 16 blocs, contrôle du périmètre global combiné) + chargement réel dans un navigateur (Chromium headless, profil mobile) avec capture des erreurs console.

---

## 1. Vérification JavaScript — RÉSULTAT : aucune erreur

| Contrôle | Résultat |
|---|---|
| Syntaxe des 16 blocs `<script>` (`node --check`, balises PHP neutralisées) | **16/16 OK** |
| Périmètre global combiné (tous les scripts du navigateur concaténés → simule la portée partagée du navigateur, détecte les redéclarations `const`/`let`/`class` entre blocs) | **OK — aucune redéclaration, aucune erreur** |
| Chargement réel `mb.php` (Chromium, UA iPhone) — exceptions non capturées | **0** |
| Chargement réel — `console.error` / `console.warning` | **0** |
| Chargement réel — requêtes réseau en échec | **0** |
| Fonctions clés présentes à l'exécution (`updateTarif`, `sendEmail`, `mbFetchTarif`, `callParamTable`, `showTarifReady`, `mbWebMcpRegisterTools`, `postH`) | **toutes définies** |

**Conclusion JS** : pas d'erreur de syntaxe ni d'erreur d'exécution. La page de production se charge proprement (0 erreur console, 0 exception, 0 requête en échec) y compris après sélection d'une catégorie de véhicule. La page n'utilise **aucune librairie externe** (ni jQuery ni Bootstrap) : JavaScript natif (`fetch`), seules dépendances externes = Google Fonts + Microsoft Clarity.

**Points d'hygiène à nettoyer** (ne provoquent pas d'erreur, mais à supprimer) :
- Code mort commenté référençant un élément inexistant `#subscription-button` (lignes ~1921, 1929) — sans danger car commenté, mais à retirer.
- Code mort de validation `blur` (dimanche / horaires d'ouverture) lignes ~1875–1934.
- `console.log` de debug laissés en production (dont la valeur `mb_prefill`, ligne ~1620) — à retirer avant mise en ligne.
- `Math.random()` qui fabrique de fausses valeurs (âge/puissance/PTAC) pour un panneau « valeurs saisies » qui est `display:none` (lignes ~2927–2955) — code mort.
- `.loading-spinner` est référencé dans le HTML (lignes ~1990, 2183) mais **n'existe pas en CSS** → ce n'est pas une erreur JS, mais le spinner de calcul est **invisible** (voir §3).

---

## 2. Le problème central de conversion

Au premier affichage, l'écran propose **un seul menu déroulant**, **aucun bouton**, **aucun aperçu de prix/garanties**, dans une charte **vert sauge + Roboto** étrangère à la marque, à l'intérieur d'un iframe **forcé à `min-height:100vh`** → l'iframe se présente comme une grande boîte grise quasi vide. Le visiteur ne voit ni récompense, ni preuve, ni prochaine étape.

Deux constats structurels :
1. **Le prix est verrouillé derrière ~10 champs obligatoires** (catégorie, pays d'immat., âge véhicule, puissance, PTAC, date de naissance, pays de résidence, motif, durée, date+heure de début). Pour une promesse « tarif en moins de 2 minutes », c'est très lourd.
2. **Toute la proposition de valeur (encadré prix + garanties) est masquée** (`display:none`) jusqu'au tout dernier champ. Le visiteur remplit le formulaire sans jamais voir où il va.

**Bonne nouvelle à préserver** : l'e-mail n'est **pas** exigé pour voir le prix (pas de « mur e-mail », tueur classique de conversion). À ne surtout pas casser.

---

## 3. Top problèmes priorisés (UI + UX fusionnés)

Classés par impact estimé sur la conversion.

### Critiques (priorité 1)

1. **`min-height:100vh` dans l'iframe** (ligne ~950). La hauteur de l'iframe est pilotée par `postMessage` (`ResizeObserver`, lignes ~4192–4206). Forcer le document à ≥ 1 plein écran gonfle la hauteur remontée → grand vide gris sous un formulaire quasi vide. **C'est probablement la cause mécanique n°1 de l'abandon.** → Retirer `min-height:100vh` (et `width:100%`) sur `html,body`, laisser le contenu définir la hauteur.

2. **Aucune couche de confiance sur l'écran 1.** Absence totale : pas d'identité courtier (MCJ COURTAGE), **pas d'ORIAS 26008651**, pas de logo assureur/partenaire, pas de « attestation immédiate », pas de « sans engagement », pas de « paiement sécurisé », pas de note de confidentialité près du champ e-mail, pas d'avis. La seule phrase de réassurance (`right_note`, ligne ~54) **inquiète** au lieu de rassurer (« pourra être réajusté si vos documents ne les confirment pas »). → Ajouter un bandeau de confiance visible dès le 1er affichage.

3. **Proposition de valeur + prix masqués jusqu'au dernier champ** (`right-column` `display:none`, ligne ~1956). → Afficher l'encadré garanties/valeur et un état « estimation en cours » dès le départ ; ne garder verrouillé que le prix exact.

4. **CTA principal inexistant à l'écran.** `.btn-submit` « Obtenir mon tarif » est `display:none` (le prix se calcule automatiquement au champ `heure_debut`, ce que rien n'indique au visiteur) ; le vrai CTA `#btn-devis` « Continuer la souscription » est masqué jusqu'au prix. → Toujours montrer la zone résultat/CTA (même grisée), CTA pleine largeur et dominant ; supprimer le bouton trompeur.

### Importants (priorité 2)

5. **Charte graphique étrangère à la marque.** Accent vert `#689d71` (variable mal nommée `--orange-vitamine`, ligne ~932) + police Roboto, alors que le site parent est bleu `#2563EB` / marine `#0F172A` / `system-ui`. Incohérence cross-origin = perte de confiance au moment de saisir date de naissance et e-mail. **De plus, le texte blanc sur le vert `#689d71` échoue au contraste WCAG AA (~2,7:1)** sur tous les CTA. → Re-mapper la variable vers le bleu parent + remplacer la quinzaine de hex codés en dur ; basculer la police sur `system-ui`.

6. **PTAC demandé à tout le monde** (ligne ~1784), jargon (« Poids Total Autorisé en Charge »), non pertinent pour une voiture, et non conditionnel. Il bloque la cascade alors qu'il n'a même pas l'attribut `required`. → N'afficher PTAC que pour camping-car / poids lourd / remorque.

7. **Impasses silencieuses.** Pays exclus (Pologne, Roumanie, Italie) **retirés sans message** (ligne ~1722) → un véhicule à plaque italienne (cas « véhicule importé » pourtant ciblé) ne trouve pas son pays et ne sait pas pourquoi. Profil sans tarif → `hideTarifButtons()` laisse un **chargement éternel** sans message (lignes ~2255, 2261). Âge/durée hors scope = mur sec sans solution de repli. → Toujours afficher un message utile + un repli humain (« Appelez un conseiller au … », le téléphone est déjà dans `$tip`). Ne jamais laisser la zone prix en chargement permanent.

8. **« Chevaux fiscaux » (et autres champs carte grise) sans aide.** `puissance` (ligne ~1752) ne dit pas où trouver la valeur. → Texte d'aide (« champ P.6 de votre carte grise ») + petite illustration.

9. **Cibles tactiles < 44px** (champs ~38–40px, e-mail ~36px, lignes ~1199–1206, 2002) et **focus invisible** (`outline:none` partout, simple changement de bordure). → `min-height:44–48px` + `font-size:16px` (évite aussi le zoom iOS) ; ajouter un anneau `:focus-visible`.

10. **Spinner de calcul invisible** (voir §1) pendant 3–4 requêtes enchaînées (`param_table → read_table → get_durees → get_tarifs`) → l'attente ressemble à un blocage. → Définir un vrai `.loading-spinner` (ou réutiliser le `.progress-bar` déjà stylé) + libellé « Calcul de votre tarif… ».

### Compléments

11. **Motif dans le chemin critique alors qu'il ne tarifie rien** (ligne ~1839, absent de `MB_PARAM_TABLE_FIELDS`/`MB_TARIF_RECALC_FIELDS`). « Autre » force un champ texte obligatoire. → Déplacer le motif en étape 2 ou le rendre optionnel/non bloquant.

12. **Date de naissance en `type="date"`** = douloureux sur mobile (faire défiler des décennies) ; code de contournement iOS abondant (lignes ~2602–2641) = champ fragile. → Composant mobile (3 sélecteurs JJ/MM/AAAA ou sélecteur année d'abord).

13. **`alert()` natifs** dans `sendEmail()` (lignes ~2787, 2809–2818) — perturbant dans un iframe. → Messages en ligne.

14. **Première question intimidante** : menu de 12 options en 8 groupes avec jargon (M1, N1, GVW). → Réduire à quelques cartes visuelles (Voiture / Utilitaire / Camping-car / 2-3 roues-quad / Autre) mappées vers les codes existants.

---

## 4. Flux d'étape 1 recommandé (réordonné)

**Demander d'abord (intention — gains rapides) :** type de véhicule (cartes visuelles) → durée + date/heure de début.
**Puis (contexte léger) :** pays d'immatriculation (défaut **FRANCE METROPOLITAINE**, liste complète seulement sur « autre pays », message explicite pour les pays exclus) → date de naissance (composant mobile, bornes 21–90) → pays de résidence (défaut France, replié).
**Auto-déduire / différer (hors chemin critique) :** PTAC (conditionnel catégories lourdes), puissance (défaut/aide pour les voitures), âge véhicule (depuis la plaque si possible), **motif** (étape 2), plaque + e-mail (déjà différés/optionnels — ajouter une note de confidentialité près de l'e-mail).
**Tout du long :** garder l'encadré valeur + le CTA mobile collant visibles dès le départ ; afficher un état d'estimation ; ne jamais laisser un chargement permanent.

---

## 5. Quick wins (< 1 jour) vs structurels

**Quick wins :**
- Retirer `min-height:100vh` sur `html,body` (impact mécanique fort).
- Ajouter un bandeau de confiance (ORIAS 26008651, MCJ COURTAGE, logo assureur, « Attestation immédiate », « Sans engagement », « Paiement sécurisé », « Données non revendues »).
- Définir le CSS `.loading-spinner` + libellé de calcul.
- Rendre PTAC conditionnel à `categorie_vehi` (réutiliser le pattern de la puissance lignes ~1760–1778).
- Textes d'aide sous puissance / PTAC / date de naissance.
- Remplacer les `alert()` par des messages en ligne.
- CTA téléphone de repli dans `exclusion-message` et `duree-error-message` (téléphone déjà dans `$tip`).
- Message explicite pour les pays exclus au lieu d'un retrait silencieux.
- Re-skinner via les variables CSS vers la charte parent + corriger le contraste des CTA.
- Valeurs par défaut FRANCE METROPOLITAINE sur les deux pays.
- Nettoyer le code mort (`#subscription-button`, blur dimanche/horaires, `console.log`, `Math.random()`).

**Structurels (multi-jours) :**
- Réordonner le tunnel (intention d'abord), différer technique + motif.
- Auto-déduire les données techniques depuis la plaque (la plomberie prefill/S2S existe déjà, lignes ~609–727).
- Découpler la visibilité de l'encadré valeur de `showTarifReady`.
- Remplacer la date de naissance `type="date"` + fiabiliser l'auto-avance/scroll mobile.
- Gestion robuste « pas de tarif » : vrai état d'erreur + relance + repli humain au lieu du silence.

---

## 6. À retenir

- **JavaScript : RAS.** Aucune erreur de syntaxe, aucune redéclaration entre blocs, aucune exception ni erreur console au chargement réel. Quelques nettoyages d'hygiène recommandés.
- Le manque à gagner est **UX/UI**, pas technique : iframe gonflée à 100vh, zéro réassurance, valeur/prix masqués, charte hors-marque, frictions (PTAC/jargon) et impasses silencieuses.
- Le fichier `mb2.php` est la **propriété de JL Assure** et n'est pas encore en ligne : ce document est destiné à être transmis à JL Assure (et/ou appliqué côté marque blanche). Les « quick wins » sont à faible risque et à fort effet.
