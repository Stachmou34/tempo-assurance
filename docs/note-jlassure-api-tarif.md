# Note à JL Assure — endpoint de tarification pour application conversationnelle

> Document interne (brouillon à envoyer). Créé : 2026-06-18.
> Destinataire : christophe.p@jlassure.com — Compte : `cd=BLA1905B` / `id=43`.

## Contexte
Nous étudions le lancement d'une **application Tempo-Assurance dans ChatGPT** (canal
conversationnel, sur le modèle d'APRIL Moto, lancé le 15/06/2026). Principe : l'IA
collecte le profil, **affiche un tarif**, puis **redirige vers le tarificateur jlassure
pré-rempli** pour la souscription et le paiement. Le tunnel contractuel reste inchangé
côté JL Assure (conformité DDA/ACPR : souscription + paiement = action du client).

## Demande
Pour afficher un **tarif réel** (et pas seulement indicatif), il nous faudrait un
**endpoint de tarification autonome**, sans contexte de session — la doc §8.3 mentionne
cette possibilité (« demander un endpoint simplifié »).

- **Entrée** (données NON personnelles) : `categorie_vehi`, `age_vehicule`, `puissance`,
  `ptac`, `pays_immatriculation`, `pays_residence`, **âge conducteur** (ou tranche), `duree`.
- **Sortie** : `prix_vente` TTC (frais de courtage inclus, compte `BLA1905B`/`43`) +
  **liste des durées disponibles** pour le profil.
- **Accès** : appel **serveur-à-serveur** avec **clé d'API**, sans `tname`/`databaseIp`.

## Questions
1. Un tel endpoint existe-t-il déjà, ou peut-on l'ouvrir pour notre compte ?
2. Modalités : authentification, limites d'appel, format (JSON), délai de mise à dispo ?
3. Confirmez-vous que la **redirection finale** vers `assure_tempo_rapide_mb.php`
   pré-rempli reste la voie de souscription ?

## Pourquoi c'est le jalon clé
Le différenciateur d'une app ChatGPT crédible = le **tarif réel**. Sans cet endpoint,
on reste sur un **prix indicatif** (notre grille) + redirection. Avec, on est à parité
avec APRIL Moto.
