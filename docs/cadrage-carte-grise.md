# Cadrage — Carte grise en marque blanche (AssuCarteGrise) sur Tempo-Assurance

> Document interne. Créé : 2026-06-24. Source : assucartegrise.com + argumentaire courtier APRIL Partenaires + presse (Wazari).

## 1. Ce qu'est l'offre (faits)
**AssuCarteGrise** = service en ligne d'obtention du **certificat d'immatriculation (carte grise)**, distribué aux **assureurs / courtiers / agents** en **apporteur d'affaires**.
- **Habilité par le Ministère de l'Intérieur** (réseau privé agréé pour l'immatriculation). Adossé à APRIL (ORIAS 07 024 083) dans une de ses distributions.
- **Démarche 100 % dématérialisée**, traçable, suivi 24/24.
- **Prise en charge du dossier en ~15 min** après dépôt des pièces ; **certificat provisoire (CPI) immédiat** pour rouler ; **carte grise définitive à domicile sous 24–72 h**.
- ~4 500 à 6 000 courtiers partenaires ; le grossiste **Wazari** a signé avec eux (signal de crédibilité).

### Situations couvertes (= déclencheurs)
- Conducteur qui **achète / change de véhicule** (changement de titulaire).
- **Achat d'un véhicule à l'étranger** (import).
- **Vol / perte / détérioration** de la carte grise (duplicata).
- **Changement d'adresse** ou de situation matrimoniale.
- **Rachat de véhicule en leasing**.
- (Mentionnés aussi : Crit'Air, COC.)

## 2. Modèle économique
- Le **partenaire fixe librement le prix client** et donc sa **marge**.
- Exemple affiché : **coût opérateur 24,90 € → prix client 49,90 € = +25 € net** par dossier. Version APRIL : modulation **5 € à 40 €** par dossier (jusqu'à **~50 %** du tarif).
- **Aucun risque de souscription, aucun stock, aucune avance** : pure commission sur un acte administratif.
- Intégration annoncée publiquement : **lien d'apport / QR code + back-office** pour déposer les pièces et suivre les dossiers. ⚠️ **Pas d'API ni d'iframe documentée publiquement** — la « marque blanche / iframe » est à confirmer directement avec eux (voir §6).

## 3. Potentiel de marché vs nos clients temporaires
C'est **le cross-sell le plus naturel possible** : nos motifs d'assurance temporaire **sont** des déclencheurs de carte grise, **au même instant**.

| Notre page / motif temporaire | Besoin carte grise associé | Force du lien |
|---|---|---|
| **Achat-vente entre particuliers** (motif n°1) | Changement de titulaire | 🔴 Très fort — même journée |
| **Carte grise barrée** (page dédiée) | Ré-immatriculation au nom de l'acheteur | 🔴 Très fort |
| **Véhicule importé / frontière** | Carte grise import (+ COC, quitus fiscal) | 🔴 Très fort |
| **Plaque WW provisoire** | CPI puis carte grise définitive | 🟠 Fort (séquence directe) |
| Sortie de fourrière, contrôle technique, week-end | Faible / ponctuel | 🟢 Marginal |

**Pourquoi c'est puissant chez nous :**
- On capte le client **exactement au moment de l'achat** (il prend une assurance temporaire pour rouler tout de suite) → c'est **précisément** le moment où il doit faire sa carte grise (délai légal 30 j).
- **Marché énorme** : ~5,8 M de véhicules d'occasion vendus/an, et **~50 % des conducteurs passent par un réseau privé habilité** pour leur carte grise.
- **Marge additionnelle sans risque** : ~25 €/dossier, sur une base de clients déjà en intention d'achat véhicule.
- **Rétention / image** : service « tout-en-un » (j'assure + j'immatricule) → différenciant vs concurrents pure-assurance.

> Ordre de grandeur : il suffit que **N dossiers/mois** se concrétisent pour ~**25 €** chacun. La part « achat-vente + import + carte grise barrée » de nos clients est, par nature, **la majorité** du trafic temporaire → l'audience adressable est large. (Chiffrage précis à faire avec nos volumes réels de souscription par motif.)

## 4. Options d'intégration sur tempo-assurance (du + simple au + intégré)
**Niveau 0 — Lien apporteur (immédiat, zéro dev)**
- CTA « Faire ma carte grise » avec notre **lien d'apport** sur les pages à forte intention : `carte-grise-barree.html`, `assurance-temporaire-vehicule-importe.html`, `assurance-temporaire-plaque-ww.html`, `assurance-temporaire-frontiere.html`, + le motif achat-vente.
- Ouvre leur parcours hébergé (idéalement habillé à nos couleurs via leur back-office).

**Niveau 1 — Page dédiée + modale (recommandé pour démarrer)**
- Créer `carte-grise.html` (SEO : « carte grise en ligne », « changement de titulaire »…) + entrée dans le menu **Nos services**.
- Reproduire **exactement le pattern jlassure** : une modale `.cta-btn-modal` qui ouvre leur parcours en **iframe** (s'ils en fournissent une) ou le lien apporteur.
- Bandeau de confiance (habilité Ministère de l'Intérieur, CPI immédiat, livraison 24–72 h).

**Niveau 2 — Iframe marque blanche (si dispo, comme jlassure)**
- Embarquer leur URL dans une iframe, ajouter leur domaine au **CSP `frame-src`** du `.htaccess` (déjà fait pour jlassure).
- Pré-remplissage éventuel par paramètres d'URL (à voir avec eux, comme la Route A jlassure).

**Niveau 3 — Cross-sell au bon moment (le plus rentable)**
- **Après une souscription temporaire pour achat-vente/import** : écran/mail « Votre véhicule est assuré ✅ — besoin de la carte grise ? On s'en occupe » → lien apporteur.
- Idéalement, plus tard : **outil carte grise dans l'app ChatGPT** (même logique que le devis).

## 5. Conformité / RGPD (à cadrer)
- On reste **apporteur** : ne jamais laisser entendre qu'on réalise nous-mêmes l'immatriculation ; bien afficher que c'est un **service habilité partenaire**.
- **Données personnelles** : si transfert de données client (nom, plaque…), prévoir consentement + mention dans la politique de confidentialité.
- Mentionner leur **habilitation / agrément** sur la page dédiée (récupérer le n° exact).
- Vérifier la compatibilité avec notre statut **MCJ Courtage (ORIAS 26008651)** et la convention d'apport.

## 6. Questions à leur poser (avant intégration)
1. **Marque blanche / iframe** : fournissez-vous une **URL intégrable en iframe** habillable à nos couleurs (logo, ORIAS) ? Ou seulement lien/QR + back-office ?
2. **Pré-remplissage** par paramètres d'URL possible (plaque, type de démarche) ?
3. **Commission exacte** pour nous (montant/%) et qui encaisse / facture le client.
4. **Catalogue complet** des démarches + tarifs opérateur par démarche.
5. **RGPD / contrat d'apport** : modèle de convention, traitement des données, responsabilités.
6. **Exclusivité / volumes** : conditions, paliers de rémunération.
7. **Habilitation** : numéro à afficher légalement sur notre page.

## 6 bis. Iframe Certimat — analyse technique (CONFIRMÉE)
Certimat est la **plateforme technique** derrière l'offre carte grise. Iframe fournie :
`https://certimat.fr/iframe/prescripteurs?partner=7999` (notre **ID partenaire = 7999**, attribue les dossiers/commission).

- **Parcours** : sélecteur en **tuiles** (mise à nom, vente/don, changement d'adresse, perte/vol, immatriculation France/étranger, WW provisoire, fin de leasing, FIV/COC/situation administrative), **entrée par plaque**, calcul auto des taxes, **4 étapes**, traitement **15 min**, **paiement en plusieurs fois**.
- **Branding** : **thème vert, logo Certimat visible** → semi-marque-blanche (attribution partenaire, mais pas notre charte). On l'**habille autour** (bandeau de confiance navy/bleu), comme le tarificateur jlassure. Restylage interne impossible (cross-origin).
- **RGPD** : bandeau de consentement **Cookiebot** présent dans l'iframe (géré côté Certimat).

### 🔴 BLOCAGE technique à lever absolument
L'iframe renvoie un en-tête **`Content-Security-Policy: frame-ancestors '<liste blanche>'`**. La liste contient ~35 domaines partenaires (dont des **concurrents temporaires** : `assutempo.fr`, `assutemporaire.fr`) **mais PAS `tempo-assurance.com`**.
→ Tant que notre domaine n'est pas ajouté à leur `frame-ancestors`, **le navigateur bloque l'affichage de l'iframe** sur notre site.
- **Action Certimat** : ajouter `https://www.tempo-assurance.com` **et** `https://tempo-assurance.com` à la whitelist `frame-ancestors`.
- **Action de notre côté** : ajouter `https://certimat.fr` au **CSP `frame-src`** de notre `.htaccess` (à côté de `https://www.jlassure.com`).

Tant que ces deux points ne sont pas faits, la page peut être préparée mais l'iframe ne s'affichera pas en réel.

## 7. Recommandation / next steps
1. **Demander à Certimat** d'ajouter nos 2 domaines à `frame-ancestors` (bloquant n°1).
2. Démarrer en **Niveau 1** (page dédiée + modale) — rapide, SEO, et réutilise notre charte + le pattern jlassure.
3. Ajouter le **cross-sell post-souscription** (Niveau 3) dès que le lien apporteur est actif → meilleur ROI.
4. Chiffrer le potentiel avec **nos volumes réels** de souscriptions par motif (achat-vente / import / carte grise barrée).
