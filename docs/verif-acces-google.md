# Verification de l'acces Google par compte de service

Date de la verification : 2026-09-25
Domaine concerne : tempo-assurance.com
Branche : `claude/upbeat-cerf-yjyYC`

## Resultat en une ligne

**Acces non fonctionnel.** La variable `GOOGLE_SERVICE_ACCOUNT_JSON` est absente de
l'environnement, donc aucun jeton ne peut etre fabrique et aucun appel authentifie
n'a pu etre tente.

## Detail des verifications

| # | Verification | Resultat |
|---|---|---|
| 1 | Presence de `GOOGLE_SERVICE_ACCOUNT_JSON` | **ABSENTE** |
| 2 | Jeton Search Console (`node scripts/gsc-token.mjs`) | **Echec**, code de sortie `2` |
| 3 | Appel reel Search Console (`webmasters/v3/sites`, `searchAnalytics/query`) | **Non executable** (aucun jeton) |
| 4 | Appel reel GA4 (`properties/540804517:runReport`) | **Non executable** (aucun jeton) |

### 1 et 2 — Fabrication du jeton

Les deux portees echouent de facon identique, avec le meme code de sortie `2` :

- `node scripts/gsc-token.mjs` (portee Search Console) → code `2`
- `node scripts/gsc-token.mjs analytics` (portee GA4) → code `2`

Message d'erreur exact, sur `stderr`, dans les deux cas :

```
GOOGLE_SERVICE_ACCOUNT_JSON absente.
A ajouter dans les variables d'environnement du cloud (menu environnement > Edit).
Contenu attendu : le JSON de la cle du compte de service, tel quel.
```

L'echec se produit dans le garde-fou en tete de `scripts/gsc-token.mjs`, **avant tout
appel reseau vers Google**. Le script lui-meme n'est pas en cause : il lit la variable,
la trouve vide et s'arrete immediatement. Aucune requete n'est partie vers
`oauth2.googleapis.com`.

### 3 et 4 — Appels reels

Ces deux etapes etaient conditionnees a l'obtention d'un jeton. Sans jeton, elles
n'ont pas ete executees.

Elles n'ont volontairement **pas** ete lancees avec un jeton vide : un tel appel
renverrait un `401 UNAUTHENTICATED` qui ne dirait rien de l'etat reel des
autorisations, et brouillerait le diagnostic.

### Verification annexe — le reseau n'est pas en cause

Pour isoler la cause, la joignabilite des points d'entree Google a ete testee sans
authentification depuis le conteneur :

| Point d'entree | Reponse |
|---|---|
| `https://oauth2.googleapis.com/token` | HTTP 400 (requete vide, attendu) |
| `https://www.googleapis.com/webmasters/v3/sites` | HTTP 401 (sans identifiants, attendu) |
| `https://analyticsdata.googleapis.com` | HTTP 404 (racine, attendu) |

Google repond dans les trois cas. **La sortie reseau du conteneur fonctionne** : ni le
pare-feu, ni le proxy, ni la politique reseau ne bloquent quoi que ce soit. Le seul
element manquant est la cle.

## Cause

Cause unique et certaine : **la cle du compte de service n'est pas presente dans
l'environnement d'execution.**

Il faut souligner ce que cette verification **ne permet pas** de conclure. L'echec
etant survenu avant le moindre contact avec Google, il est impossible de dire a ce
stade si :

- l'API Search Console et l'API GA4 Data sont activees dans le projet Google Cloud ;
- le compte de service est bien ajoute comme utilisateur dans Search Console
  (Parametres > Utilisateurs et autorisations) ;
- le compte de service est bien ajoute comme utilisateur de la propriete GA4
  `540804517`.

Ces trois points restent **non verifies**. Ils ne pourront l'etre qu'une fois la cle
en place, lors d'une seconde passe.

## Ce qu'il faut faire

1. Ajouter la cle dans les variables d'environnement du cloud (menu de l'environnement
   dans la barre de titre de la session, puis « Edit »), sous le nom exact
   `GOOGLE_SERVICE_ACCOUNT_JSON`. Le contenu attendu est le fichier JSON de la cle du
   compte de service, tel quel, sans retrait ni reformatage.
2. Ouvrir une nouvelle session : les variables ne sont lues qu'au demarrage du
   conteneur.
3. Rejouer cette verification. Si elle echoue alors *apres* l'echange de jeton, le
   message renvoye par Google indiquera lequel des trois points ci-dessus est en cause.

La cle ne doit jamais etre collee dans la conversation, ni commitee dans le depot.

## Note sur l'emplacement du script

`scripts/gsc-token.mjs` existe sur la branche `claude/upbeat-cerf-yjyYC` mais **pas sur
`main`**. Sur `main`, `scripts/` ne contient que `verif-qualite.mjs`. A reproduire cette
verification depuis `main`, la commande echouerait avec « module introuvable », pour une
raison sans rapport avec les acces Google.
