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
| 1 | Créer et faire vérifier la fiche Google Business Profile (contenu prêt : `docs/gbp-a-coller.md`) | Propriétaire | 30 min + délai de vérification | **Fait** : la fiche existe (confirmé le 14/10) |
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

## Décisions demandées au propriétaire : réponses du 14/10/2026

1. **Google Business Profile : la fiche existe.** Action 1 du tableau faite ; reste à l'entretenir (lien du site,
   produits avec lien vers les pages catégories, une publication par semaine reprise de la veille du dimanche).
2. **Demande à JL Assure pour un lien d'avis dans l'e-mail de confirmation : déjà faite par le propriétaire.**
   Réponse de JL Assure à suivre.
3. **Search Console > Liens : relevé transmis le 14/10** (ci-dessous).

## Inventaire des liens au 14/10/2026 (Search Console > Liens)

**79 liens externes, tous vers l'accueil, venus de 5 sites seulement :**

| Site d'origine | Liens | Ce que c'est |
| --- | --- | --- |
| seguro-temporal.es | 28 | Site espagnol du réseau JL Assure : lien de pied de page « Sitios Web Asociados », répété sur ses pages |
| jlassure.com | 19 | Le partenaire, depuis son tunnel |
| trustpilot.com | 18 | La fiche d'avis |
| chatgpt.com | 4 | Citations dans des réponses |
| mcj-courtage.com | 2 | Le site du cabinet, propriété du propriétaire |

Textes d'ancrage : « auto assurance temporaire », « assurance auto tempo », « tempo assurance logo »,
« visit website », « zur website ».

**Lecture** : aucun lien éditorial indépendant (média, blog, partenaire hors réseau). C'est l'écart principal avec les
sites mieux classés sur « assurance temporaire », où le contenu et la technique sont déjà au niveau (§1 du playbook).
Les autres sites du pied de page de seguro-temporal.es (assurance-tempo.eu, assurancetemporaireauto.com,
assurancetemporaire.re) sont présentés comme sites associés de JL Assure : probablement des concurrents sur la même
requête, avec le même produit. **Ne pas échanger de liens avec eux** : un réseau de sites qui se lient entre eux
ressemble à un schéma de liens.

## Liens à obtenir, par ordre de priorité (décidé le 14/10/2026)

1. **mcj-courtage.com (propriété du propriétaire, cette semaine)** : un vrai paragraphe dans le corps d'une page, pas
   seulement le pied de page, avec un lien « assurance auto temporaire en ligne » vers l'accueil, et deux ou trois liens
   vers les pages catégories (camion, camping-car, frontière). Bloc HTML à préparer par la session webmaster.
2. **Baromètre de l'assurance temporaire (le levier principal)** : une étude publiée sur le site à partir des agrégats
   du portefeuille (durées, jours de départ, catégories de véhicules, taux de retour, saisonnalité ; **jamais le chiffre
   d'affaires ni de donnée individuelle**), puis proposée à la presse auto et conso et à la presse régionale (Hérault).
   Les journalistes reprennent des chiffres inédits et citent la source avec un lien. **Accord du propriétaire requis
   avant toute publication de chiffres du portefeuille.**
3. **Partenaires professionnels** (garages, négociants VO, auto-écoles, convoyeurs, loueurs) : une page « partenaires »
   et un lien depuis leur site, avec les vidéos de prospection. Liens locaux et thématiques.
4. **À ne pas faire** : acheter des liens, échanger des liens avec le réseau JL Assure, s'inscrire dans des annuaires
   sans trafic. Un lien artificiel coûte plus qu'il ne rapporte.
