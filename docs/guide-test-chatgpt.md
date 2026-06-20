# Guide de test — App « Assurance temporaire » dans ChatGPT

> Scénarios à jouer pour valider l'app. Astuce : **une nouvelle conversation** par test
> (sinon ChatGPT peut réutiliser un résultat en mémoire). Créé : 2026-06-19.

## Prérequis
- App branchée dans ChatGPT (connecteur `/mcp`).
- Niveaux 1 & 1+ actifs. Niveau 2 (souscription pré-remplie) seulement si
  `ENABLE_PREFILL_SESSION=1` est posé sur Render (après feu vert RGPD).

---

## Scénario 1 — Devis sans détails (aucune hypothèse)
**Tu écris :** « Je veux assurer ma voiture. »
**Attendu :** l'IA **pose les questions** (durée, âge véhicule, puissance ≤30/>30 CV,
pays, âge conducteur, motif). Elle **n'invente pas** de valeurs.

## Scénario 2 — Devis complet (conversationnel)
**Tu écris :** « Assure ma voiture 15 jours, véhicule de 5 ans, moins de 30 CV,
immatriculée et conducteur en France, 40 ans, achat/vente. »
**Attendu :** la **carte de devis** s'affiche avec le **tarif réel** ; tu peux **changer
la durée** dans la liste déroulante → le prix se met à jour ; bouton **Souscrire**.

## Scénario 3 — Tarif précis par carte grise (OCR)
**Tu écris :** « Devis 15 jours » **+ joins une photo de carte grise.**
**Attendu :** l'IA lit puissance/genre/PTAC/âge → **tarif précis** + mention
« Lu sur la carte grise : … ». *(Utilise ta propre carte grise ; l'image passe par OpenAI.)*

## Scénario 4 — Le client ne connaît pas la puissance
**Tu écris :** « Je ne connais pas la puissance fiscale. »
**Attendu :** l'IA **propose d'envoyer la carte grise** (au lieu de supposer).

## Scénario 5 — Mauvaise photo / mauvais document
**Tu écris :** « Devis » + joins une photo floue ou autre chose qu'une carte grise.
**Attendu :** l'IA demande **une photo nette de la carte grise** (pas d'invention).

## Scénario 6 — Souscription facilitée (Niveau 2, si activé)
**Tu écris :** « Je veux directement souscrire, comment gagner du temps ? »
**Attendu :** l'IA propose d'envoyer **carte grise + permis**, **demande ton accord**
(RGPD), **récapitule** les infos, puis donne un **lien de souscription pré-rempli**.
Le tunnel s'ouvre avec véhicule **et** conducteur remplis → vérifier, IPID, téléverser
les pièces, payer.

## Scénario 7 — Hors périmètre
**Tu écris :** un profil non couvert (ex. immatriculation Pologne).
**Attendu :** message « profil non tarifiable en ligne » + numéro de téléphone.

---

## Points à vérifier
- [ ] Aucune valeur **supposée** (puissance/âge) — l'IA demande.
- [ ] Tarif = **prix réel** (badge « prix réel ») quand le profil est complet.
- [ ] OCR carte grise → champs techniques lus, **jamais** d'identité au Niveau 1.
- [ ] Widget : catégorie en titre, **durée en liste déroulante**, prix recalculé.
- [ ] **Récap + confirmation** avant le lien de souscription.
- [ ] (Niveau 2) **consentement** demandé avant tout traitement d'identité.
- [ ] Souscription/paiement **toujours** sur le tunnel (jamais par l'app).
