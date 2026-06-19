# Check-list RGPD — OCR des pièces (permis / carte grise) via ChatGPT

> Document interne. À valider avec un conseil / DPO **avant** d'aller au-delà de la
> lecture des champs techniques de la carte grise. Créé : 2026-06-18.

## Principe de prudence
- **Faisable tout de suite (faible risque)** : OCR de la carte grise pour les **seuls
  champs techniques de tarification** (puissance, PTAC, genre, date de mise en
  circulation). Peu/pas de données identifiantes. → déjà implémenté côté outil.
- **À cadrer (risque élevé)** : OCR du **permis** et des données **personnelles** de la
  carte grise (nom, adresse, immatriculation, n° de permis/châssis). Ne pas lancer sans
  les points ci-dessous validés.

## Check-list à valider
- [ ] **Base légale** : consentement **explicite** du client pour traiter ses pièces
      d'identité via une IA, avec finalité claire (préparer une souscription).
- [ ] **Responsable de traitement** : MCJ Courtage. **Sous-traitants** : OpenAI
      (ChatGPT) et JL Assure → vérifier les **contrats / DPA** correspondants.
- [ ] **Transfert hors UE** : OpenAI traite aux **États-Unis** → vérifier les garanties
      (clauses contractuelles types / Data Privacy Framework).
- [ ] **Minimisation** : n'extraire que le **strict nécessaire** ; pour le tarif, se
      limiter aux **champs techniques** (pas d'identité).
- [ ] **Conservation** : pas de stockage des images ni des données extraites ; traitement
      **éphémère**. Vérifier la rétention côté OpenAI et jlassure.
- [ ] **Information** : mention RGPD claire (finalité, destinataires, durée, droits
      d'accès/rectification/effacement, réclamation CNIL).
- [ ] **Sécurité** : aucune donnée personnelle dans les **URL** ni les **logs**
      (déjà respecté côté tarif ; à garantir pour le prefill sécurisé).
- [ ] **AIPD/DPIA** : une **analyse d'impact** est probablement requise (traitement
      d'identité + nouveau dispositif IA à grande échelle potentielle).
- [ ] **ACPR / DDA** : l'IA **assiste** la préparation ; le **devoir de conseil**, la
      souscription et le paiement restent **encadrés et réalisés via le tunnel régulé**.

## Recommandation
1. **Phase 1 (maintenant)** : OCR carte grise → champs **techniques** uniquement (tarif
   précis). Implémenté. Risque RGPD faible.
2. **Phase 2 (sous conditions)** : pré-remplissage des pages **identité** → nécessite
   le **prefill sécurisé jlassure** (voir `note-jlassure-prefill-securise.md`) **et** la
   validation de cette check-list par un conseil juridique / DPO.
