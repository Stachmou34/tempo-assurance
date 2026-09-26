# Verification de l'acces Google par compte de service

Date de la verification : 2026-09-26
Domaine concerne : tempo-assurance.com
Propriete GA4 concernee : `540804517`
Branche : `claude/upbeat-cerf-yjyYC`

## Resultat en une ligne

**Acces toujours non fonctionnel.** La variable `GOOGLE_SERVICE_ACCOUNT_JSON` reste
absente de l'environnement d'execution. Aucun jeton n'a pu etre fabrique, donc aucun
appel authentifie n'a pu etre tente. Situation inchangee par rapport au 25/09.

## Detail des verifications

| # | Verification | Resultat |
|---|---|---|
| 1 | Presence de `GOOGLE_SERVICE_ACCOUNT_JSON` | **ABSENTE** (valeur vide) |
| 2 | Jeton Search Console (`node scripts/gsc-token.mjs`) | **Echec**, code de sortie `2` |
| 2bis | Jeton GA4 (`node scripts/gsc-token.mjs analytics`) | **Echec**, code de sortie `2` |
| 3 | Appel reel Search Console (`webmasters/v3/sites`, `searchAnalytics/query`) | **Non executable** (aucun jeton) |
| 4 | Appel reel GA4 (`properties/540804517:runReport`) | **Non executable** (aucun jeton) |

### 1 — Presence et forme de la variable

Le test de presence renvoie `ABSENTE`. L'inspection de la forme (JSON brut ou base64)
renvoie `vide` : il n'y a rien a analyser. Ni le champ `client_email`, ni le champ
`private_key` ne sont donc lisibles.

### 2 et 2bis — Fabrication du jeton

Les deux portees echouent de facon identique, avec le meme code de sortie `2` :

- `node scripts/gsc-token.mjs` (portee Search Console) → code `2`
- `node scripts/gsc-token.mjs analytics` (portee GA4) → code `2`

Message d'erreur exact, sur `stderr`, dans les deux cas :

```
GOOGLE_SERVICE_ACCOUNT_JSON absente.
A ajouter dans les variables d'environnement du cloud (menu environnement > Edit).
Contenu attendu : le JSON de la cle du compte de service, tel quel.
```

La sortie standard est vide (`0` octet). L'echec se produit dans le garde-fou en tete
de `scripts/gsc-token.mjs`, **avant tout appel reseau vers Google**. Le script n'est pas
en cause : il lit la variable, la trouve vide et s'arrete immediatement. Aucune requete
n'est partie vers `oauth2.googleapis.com`.

Aucun des diagnostics Google habituels n'a donc pu etre observe : pas d'`invalid_grant`,
pas de `403 accessNotConfigured`, pas de liste de proprietes vide. Ces messages
supposent un echange effectif avec Google, qui n'a pas eu lieu.

### 3 et 4 — Appels reels

Ces deux etapes etaient conditionnees a l'obtention d'un jeton. Sans jeton, elles n'ont
pas ete executees.

Elles n'ont volontairement **pas** ete lancees avec un jeton vide : un tel appel
renverrait un `401 UNAUTHENTICATED` qui ne dirait rien de l'etat reel des autorisations
et brouillerait le diagnostic.

### Verification annexe — le reseau n'est pas en cause

Pour isoler la cause, la joignabilite des points d'entree Google a ete testee sans
authentification depuis le conteneur, le 26/09 :

| Point d'entree | Reponse |
|---|---|
| `https://oauth2.googleapis.com/token` (GET) | HTTP 404 (methode non prevue, attendu) |
| `https://www.googleapis.com/webmasters/v3/sites` | HTTP 401 (sans identifiants, attendu) |
| `https://analyticsdata.googleapis.com` | HTTP 404 (racine, attendu) |

Google repond dans les trois cas. **La sortie reseau du conteneur fonctionne** : ni le
pare-feu, ni le proxy, ni la politique reseau ne bloquent quoi que ce soit. Le seul
element manquant est la cle.

## Cause

Cause unique et certaine : **la cle du compte de service n'est pas presente dans
l'environnement d'execution, sous le nom attendu `GOOGLE_SERVICE_ACCOUNT_JSON`.**

### Piste a verifier : une cle enregistree sous un autre nom

Un indice incident merite d'etre signale. Lors du recensement des variables liees a
Google, une ligne de texte ressemblant a du materiel de cle (fragment encode, reparti
sur plusieurs lignes) est apparue dans l'environnement — mais **pas** sous le nom
`GOOGLE_SERVICE_ACCOUNT_JSON`.

Cet indice n'a **pas** pu etre confirme : l'inspection systematique des variables
d'environnement a la recherche d'identifiants a ete bloquee par le bac a sable de la
session, a juste titre. Le nom exact de la variable concernee reste donc inconnu.

Hypothese la plus probable, a verifier cote console : **la cle a bien ete enregistree,
mais sous un nom de variable different de celui que le script attend** (ou dans une
section « API credentials » qui l'expose sous un autre nom). Si c'est le cas, la
correction est un simple renommage, pas un nouveau depot de cle.

### Ce que cette verification ne permet pas de conclure

L'echec etant survenu avant le moindre contact avec Google, il est impossible de dire a
ce stade si :

- l'API Search Console et l'API GA4 Data sont activees dans le projet Google Cloud ;
- le compte de service est bien ajoute comme utilisateur dans Search Console
  (Parametres > Utilisateurs et autorisations) ;
- le compte de service est bien ajoute comme utilisateur de la propriete GA4
  `540804517` (Admin > Gestion des acces).

Ces trois points restent **non verifies**, comme le 25/09. Ils ne pourront l'etre
qu'une fois la cle en place, lors d'une passe ulterieure.

## Ce qu'il faut faire

1. Ouvrir le menu de l'environnement cloud (barre de titre de la session), puis
   « Edit », et verifier la liste des variables deja enregistrees. Si une cle de compte
   de service y figure sous un autre nom, la renommer en `GOOGLE_SERVICE_ACCOUNT_JSON`
   — nom exact, respectant la casse.
2. Si aucune cle n'y figure, en ajouter une sous ce nom. Le contenu attendu est le
   fichier JSON de la cle du compte de service, tel quel ; le script accepte aussi ce
   meme JSON encode en base64 sur une seule ligne, forme plus sure quand le champ de
   saisie n'accepte qu'une ligne.
3. Ouvrir une **nouvelle session** : les variables d'environnement ne sont lues qu'au
   demarrage du conteneur, une session deja ouverte ne les verra pas.
4. Rejouer cette verification. Si elle echoue alors *apres* l'echange de jeton, le
   message renvoye par Google indiquera lequel des trois points non verifies est en
   cause.

La cle ne doit jamais etre collee dans la conversation, ni commitee dans le depot.

## Note sur l'environnement de la session

Le depot n'etait pas present dans le conteneur au demarrage de cette session : il a
fallu le cloner depuis `https://github.com/Stachmou34/tempo-assurance.git` avant de
pouvoir travailler. Sans rapport avec les acces Google, mais a savoir si la verification
est rejouee.

`scripts/gsc-token.mjs` existe sur la branche `claude/upbeat-cerf-yjyYC` mais **pas sur
`main`**. Sur `main`, `scripts/` ne contient que `verif-qualite.mjs`. A reproduire cette
verification depuis `main`, la commande echouerait avec « module introuvable », pour une
raison sans rapport avec les acces Google.
