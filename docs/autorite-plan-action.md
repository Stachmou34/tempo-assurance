# Autorité : plan d'action prêt à lancer (chantier n°6)

> Préparé le 07/10/2026. Le levier est hors code : ce document sert à **décider et exécuter**, pas à publier.
> Rien ici n'est automatisable depuis le site. Chaque action est à valider par le propriétaire.

## Pourquoi c'est le levier

Position moyenne 12,2 sur 28/09-04/10 (10,9 la semaine précédente), CTR 2,2 % : le site est vu mais jamais en page 1 sur
ses têtes de gondole. Les données du playbook (§1) écartent l'indexation et le volume de contenu. Reste l'autorité.
Le trafic ChatGPT (186 sessions la semaine du 28/09) montre aussi que les IA recopient ce que disent les sources
tierces : avis et annuaires comptent pour elles.

## Ordre d'exécution (du plus rentable au moins rentable)

| # | Action | Qui | Temps | Statut connu |
|---|---|---|---|---|
| 1 | Créer et faire vérifier la fiche Google Business Profile (contenu prêt : `docs/gbp-a-coller.md`) | Propriétaire | 30 min + délai de vérification | Aucune trace qu'elle existe : **à confirmer** |
| 2 | Corriger l'ancien numéro `04 67 36 72 01` dans les annuaires (`gbp-a-coller.md` §11) | Propriétaire | 1 h | À faire |
| 3 | Trustpilot : activer l'invitation automatique après souscription | Propriétaire + JL Assure | 30 min | 13 avis, 4,2/5 au 26/09 |
| 4 | Bing Places et Apple Business Connect (même NAP) | Propriétaire | 20 min chacun | À faire |
| 5 | Fiche ORIAS : vérifier que l'URL du site y figure | Propriétaire | 10 min | Registre gratuit, consultable sur orias.fr ; n° 26008651 |

Le NAP à utiliser partout est dans `docs/plan-reputation-gbp.md` §0. Une seule graphie de marque.

## Avis : le point qui bloque

Les invitations doivent partir **après la souscription**, or le tunnel est chez jlassure.com : le site ne voit ni la
vente ni l'adresse e-mail du client. Trois voies, de la plus simple à la plus lourde :

1. **Trustpilot par copie cachée (BCC)** : ajouter l'adresse BCC Trustpilot de MCJ Courtage aux e-mails de confirmation
   envoyés au client. Sans développement. Selon les pages publiques consultées, l'offre gratuite plafonne à
   100 invitations par mois ; **à vérifier dans le compte avant de s'y fier**.
2. **Demander à JL Assure** si l'e-mail de confirmation peut contenir un lien d'avis (modèle de message à
   adapter de `docs/message-jlassure-*.md`).
3. **Lien d'avis dans l'attestation ou le mémo véhicule assuré** : à ne faire que si JL Assure l'accepte.

Règles à respecter : demander un avis à **tous** les clients, pas seulement aux satisfaits (Trustpilot et Google
sanctionnent le tri), ne rien offrir en échange, répondre à tous les avis.

### Message e-mail (J+3, après le début de la couverture)

Objet : Votre avis sur Tempo-Assurance

> Bonjour,
> Votre assurance temporaire a pris effet il y a quelques jours. Quelle que soit votre expérience, votre avis aide les
> prochains conducteurs à choisir : [lien d'avis], 30 secondes.
> Merci, et bonne route.
> L'équipe Tempo-Assurance

## Liens entrants : ce que la recherche établit et n'établit pas

- **Établi** : l'ORIAS est le registre officiel et gratuit des intermédiaires ; l'inscription du courtier y est déjà faite.
- **Non établi** : la recherche web du 07/10 n'a renvoyé aucun annuaire de courtiers dont la valeur SEO soit démontrée.
  Je ne propose donc **aucune liste de sites à contacter** : en inventer une, ou pousser des annuaires douteux,
  ferait plus de mal (liens de basse qualité) que de bien.
- **Piste réaliste** : les partenaires de `docs/partenaires-porteurs.md` (hors Wakam) et les articles qui citent déjà le
  site, à relever dans Search Console > Liens (écran non accessible par l'API, à consulter à la main).

## Décisions demandées au propriétaire

1. La fiche Google Business Profile existe-t-elle ? Si non, la créer en premier.
2. Autoriser la demande à JL Assure sur l'e-mail de confirmation (voie 2 ci-dessus).
3. Ouvrir Search Console > Liens et noter les 10 premiers sites référents : base d'une prospection réelle.
