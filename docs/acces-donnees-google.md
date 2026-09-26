# Acces aux donnees Google (Search Console et GA4)

Etabli et verifie le 26/09/2026.

## Comment ca marche

L'acces passe par un **identifiant d'API stocke dans le coffre de l'environnement cloud**
(cle de compte de service GCP). Le proxy signe les appels tout seul : il n'y a **aucun
jeton a fabriquer, aucune cle a lire, aucune variable d'environnement a manipuler**.

Concretement, un simple `curl` sans en-tete d'authentification suffit :

```bash
# Proprietes accessibles
curl -s https://www.googleapis.com/webmasters/v3/sites

# Requetes Search Console
curl -s -X POST -H "Content-Type: application/json" \
  "https://www.googleapis.com/webmasters/v3/sites/sc-domain%3Atempo-assurance.com/searchAnalytics/query" \
  -d '{"startDate":"2026-09-01","endDate":"2026-09-23","dimensions":["query"],"rowLimit":25}'

# GA4
curl -s -X POST -H "Content-Type: application/json" \
  "https://analyticsdata.googleapis.com/v1beta/properties/540804517:runReport" \
  -d '{"dateRanges":[{"startDate":"2026-09-01","endDate":"2026-09-23"}],"metrics":[{"name":"sessions"}]}'
```

## Identifiants

| Element | Valeur |
|---|---|
| Propriete Search Console | `sc-domain:tempo-assurance.com` (niveau `siteFullUser`) |
| Propriete GA4 | `540804517` |
| Compte de service | `claude@chrome-sensor-489410-n7.iam.gserviceaccount.com` |
| Hotes autorises | `www.googleapis.com`, `analyticsdata.googleapis.com` |
| Scopes | `webmasters.readonly`, `analytics.readonly` |

## Diagnostic en cas d'echec

Le code HTTP dit precisement ou ca coince :

| Reponse | Cause |
|---|---|
| **200** | tout va bien |
| **401** `missing credential` | le proxy n'injecte rien : identifiant absent ou hote non autorise |
| **401** `invalid credentials` | mauvais type d'identifiant (un jeton IAP n'est pas un jeton OAuth) |
| **403** `ACCESS_TOKEN_SCOPE_INSUFFICIENT` | le jeton est valide mais les scopes manquent |
| **200** avec liste de proprietes **vide** | cle valide, mais compte de service pas ajoute dans Search Console |

Ces quatre etats ont tous ete rencontres lors de la mise en place : la progression
401 -> 403 -> 200 est le chemin normal de configuration.

## A ne pas refaire

Un script `scripts/gsc-token.mjs` fabriquait un jeton a partir d'une cle lue dans une
variable d'environnement. Il a ete **supprime** : le coffre du proxy fait mieux et plus
sur, puisque la cle n'est jamais exposee aux sessions. Ne pas remettre une cle en clair
dans les variables d'environnement, ce champ etant visible par quiconque utilise
l'environnement.
