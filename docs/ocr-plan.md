# Plan OCR & cas d'usage — App ChatGPT Tempo-Assurance

> Document de cadrage. Créé : 2026-06-19. À valider avant implémentation.

## 1. Principe
L'**OCR est réalisé par ChatGPT** (vision) : il lit la photo du document, **extrait les
champs**, puis **appelle notre outil** avec ces champs. Notre serveur **convertit et
valide** (déterministe). **Aucune image n'est stockée** par l'app ; les pièces officielles
restent **téléversées par le client sur le tunnel jlassure**.

## 2. Documents → champs extraits
| Document | Champs | Usage | Sensibilité RGPD |
|---|---|---|---|
| **Carte grise — technique** | J.1 genre · P.6 puissance · F.2 PTAC · date 1re MEC | **Tarif** | 🟢 faible |
| **Carte grise — véhicule** | immatriculation · D.1 marque · D.3 modèle · E châssis · pays immat. | Page Véhicule (phase 2) | 🟠 moyenne |
| **Permis de conduire** | nom · prénom · date naissance · n° permis · date d'obtention · catégories (type) · pays | Page Conducteur (phase 2) | 🔴 élevée (pièce d'identité) |

## 3. Fiabilisation (5 leviers)
1. **Déclenchement fiable** : consigne explicite dans la description de l'outil — *« si une
   photo de carte grise / permis est partagée, EXTRAIRE les champs et APPELER l'outil »*
   (et non décrire l'image).
2. **Conversion déterministe côté serveur** (déjà en place) : CV→inf30/sup30, kg→ptac,
   genre→categorie_vehi, date 1re MEC→age_vehicule. Évite les erreurs de mapping du modèle.
3. **Étape de confirmation** : l'app affiche les **valeurs lues** et demande validation
   avant de continuer (précision **+** consentement explicite).
4. **Champs illisibles** : si un champ manque ou est incertain → **demander au client**,
   ne jamais inventer.
5. **Minimisation** : n'extraire que les champs **nécessaires à l'étape** (tarif = technique
   seulement ; identité = phase 2, avec consentement).

## 4. Conformité
- **Carte grise « technique » (tarif)** : risque faible, mais **l'image transite par
  OpenAI** (vision) → à mentionner au client.
- **Permis / identité** : risque élevé → **phase 2**, sous **feu vert RGPD** + consentement.
- **Jamais de stockage** ; pièces officielles uploadées par le client sur le tunnel.

## 5. Phases
- **Phase A (EN PROD)** : carte grise → **tarif** (champs techniques). ✅ déjà livré.
- **Phase B (en attente RGPD)** : carte grise + permis → **pré-remplissage complet**
  (véhicule + conducteur) → `session_url`. Outil OFF par défaut (`ENABLE_PREFILL_SESSION`).

---

## 6. Catalogue de use cases

### UC1 — Carte grise → tarif précis (Phase A) ✅ live
- **Déclenchement** : « assure ma voiture 15 j » + photo de carte grise.
- **Étapes** : ChatGPT lit J.1/P.6/F.2/date → appelle `devis_assurance_temporaire` → carte avec tarif réel.
- **Résultat** : tarif exact, lien de souscription pré-rempli.
- **Conformité** : champs techniques uniquement, pas d'identité.

### UC2 — Permis → conducteur pré-rempli (Phase B)
- **Déclenchement** : après consentement, le client partage son permis.
- **Étapes** : ChatGPT extrait nom/prénom/naissance/n° permis/date/catégorie/pays → `preparer_session_souscription` → `session_url`.
- **Résultat** : page Conducteur pré-remplie.
- **Conformité** : consentement requis ; gated RGPD.

### UC3 — Carte grise + permis → zéro formulaire complet (Phase B)
- **Déclenchement** : client partage les **deux** documents (après consentement).
- **Étapes** : extraction véhicule + conducteur → une seule `session_url` → tunnel entièrement pré-rempli (tarif + véhicule + conducteur).
- **Résultat** : le client n'a qu'à **vérifier, consulter l'IPID, téléverser les pièces et payer**.
- **Conformité** : consentement ; gated RGPD ; PTAC requis (lu sur la carte grise).

### UC4 — OCR partiel / champ illisible
- **Déclenchement** : un champ manque (photo coupée, reflet…).
- **Étapes** : l'app **liste les champs manquants** et demande au client de les confirmer/saisir.
- **Résultat** : devis/préremplissage complété sans valeur inventée.

### UC5 — Mauvais document / photo floue
- **Déclenchement** : document non reconnu (ex. facture au lieu de carte grise).
- **Étapes** : message clair *« je n'ai pas reconnu une carte grise, pouvez-vous renvoyer une photo nette du recto ? »*.
- **Résultat** : nouvelle tentative, pas d'erreur silencieuse.

### UC6 — Confirmation avant envoi (récap)
- **Déclenchement** : avant de générer le lien / la session.
- **Étapes** : l'app **récapitule les valeurs lues** (« Voiture, 7 CV, 15 j, né(e) le 12/05/1990… ») et demande **« On valide ? »**.
- **Résultat** : précision + traçabilité du consentement.

---

## 7. Reste à coder (après validation)
| Item | Phase | Effort |
|---|---|---|
| Renforcer la **consigne OCR** dans la description des outils (déclenchement fiable) | A | faible |
| **Étape de confirmation** (récap des valeurs lues) | A/B | moyen |
| Consigne d'extraction **permis** (UC2/UC3) | B | faible |
| Gestion **champ illisible / mauvais document** (UC4/UC5) | A/B | faible |
| (déjà fait : conversion carte grise, champs conducteur pays_naissance/pays_permis/type_permis) | — | ✅ |
