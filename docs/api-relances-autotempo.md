# API de relance client (autotempo.net)

Contrat **livré et vérifié le 26/09/2026**. Ce fichier remplace le cahier des charges
initial : il décrit l'API telle qu'elle existe, pas telle qu'elle avait été demandée.
Les noms de routes diffèrent de la demande d'origine, le fond est conforme.

Volume attendu : quelques dizaines d'enregistrements par jour. Une requête par jour.

---

## 1. Principe

Une assurance temporaire a une **date de fin connue à l'avance**. Un client qui a pris
30 jours aura un besoin dans 30 jours : reconduction, ou carte grise s'il vient
d'acheter le véhicule. C'est le déclencheur commercial le plus prévisible du métier.

L'agent tourne **sans mémoire d'un jour sur l'autre** : chaque exécution repart de zéro.
C'est pourquoi le back-office porte l'état « déjà relancé », sinon le même client serait
sollicité tous les jours.

---

## 2. Accès

| | |
| --- | --- |
| URL de base | `https://autotempo.net/api.php` |
| Format | JSON en UTF-8, dates en `AAAA-MM-JJ` |
| Transport | HTTPS obligatoire |
| Authentification | `Authorization: Bearer <jeton>`, ou `X-Authorization` en repli |

Le jeton se lit dans la variable d'environnement **`MCJ_API_TOKEN`**. Il n'est jamais
écrit dans le dépôt, ni passé dans une URL : il donne accès à des emails de clients.
Il est révocable à tout moment, auquel cas les appels suivants renvoient 401.

L'authentification est vérifiée **avant** le routage : un appel sans jeton renvoie 401
même sur une route inexistante. C'est le bon comportement, il ne révèle pas quelles
routes existent.

---

## 3. Lire les échéances

```
GET /api.php?route=echeances&de=0&a=7
```

Renvoie les contrats dont la date de fin tombe entre aujourd'hui + `de` jours et
aujourd'hui + `a` jours. Seuls les contrats valides avec un email exploitable sont
renvoyés, et un contrat déjà marqué comme relancé ne revient plus.

| Paramètre | Défaut | Règle |
| --- | --- | --- |
| `de` | 0 | entier, de -365 à 365 |
| `a` | 7 | entier, >= `de`, 93 jours d'écart maximum |

```json
{
  "du": "2026-09-26",
  "au": "2026-10-03",
  "nombre": 1,
  "contrats": [
    {
      "ref": "c_7a5e9d71a0d26f002b51d208",
      "email": "paul@exemple.fr",
      "prenom": "Paul",
      "date_debut": "2026-08-30",
      "date_fin": "2026-09-29",
      "duree_jours": 30,
      "categorie": "VP",
      "montant": 120.5
    }
  ]
}
```

| Champ | Type | Contenu |
| --- | --- | --- |
| `ref` | texte | identifiant opaque et stable, à renvoyer tel quel au marquage |
| `email` | texte | email du client |
| `prenom` | texte ou `null` | prénom, `null` si inconnu |
| `date_debut` | date | date d'effet |
| `date_fin` | date | date de fin |
| `duree_jours` | entier | jours entre `date_debut` et `date_fin` |
| `categorie` | texte | catégorie du véhicule (VP, CAM3, TCP...) |
| `montant` | nombre ou `null` | prix en euros, `null` si inconnu |

**Minimisation respectée.** Aucun nom de famille, adresse, téléphone, plaque, permis,
date de naissance ni coordonnée bancaire ne sort de l'API. `scripts/test-api-relances.mjs`
échoue si un de ces champs apparaît un jour dans une réponse.

---

## 4. Marquer une relance

```
POST /api.php?route=relances
Content-Type: application/json

{"ref": "c_7a5e9d71a0d26f002b51d208"}
```

```json
{
  "ref": "c_7a5e9d71a0d26f002b51d208",
  "relance_le": "2026-09-26T09:31:32+02:00",
  "deja_faite": false
}
```

**Idempotent** : renvoyer la même `ref` ne crée pas de doublon, la réponse reste 200 avec
`deja_faite: true` et la date de la première relance. On peut donc rejouer un appel en cas
de doute, ce qui est exactement ce qu'il faut pour un agent sans mémoire.

---

## 5. Erreurs

Toute erreur renvoie `{"erreur": "code", "message": "texte"}`.

| Code | Cause |
| --- | --- |
| 400 | paramètre invalide : plage `de`/`a` incorrecte, `ref` absente ou mal formée |
| 401 | jeton absent, invalide ou révoqué |
| 403 | appel en HTTP, ou jeton non autorisé pour cette action |
| 404 | endpoint inconnu, ou `ref` jamais renvoyée par `echeances` |
| 405 | mauvaise méthode |
| 500 | erreur interne, réessayer plus tard |

---

## 6. Flux quotidien

1. `GET echeances` sur la plage voulue.
2. **Regrouper par email** avant d'écrire (voir §7).
3. Envoyer le message.
4. `POST relances` pour chaque message réellement parti. Le contrat ne reviendra plus.

Marquer **après** l'envoi, jamais avant : en cas d'échec d'envoi, mieux vaut relancer le
lendemain que perdre le client silencieusement.

---

## 7. Points ouverts avant le premier envoi

1. **Désabonnement — bloquant.** La documentation ne dit rien d'un client qui a demandé
   à ne plus être sollicité. Il faut un drapeau côté base, et que `echeances` ne renvoie
   **jamais** un contrat dont le client s'est désinscrit : l'agent n'a aucun autre moyen
   de le savoir. Pour de la prospection par email, même vers des clients existants, un
   lien de désinscription qui fonctionne n'est pas optionnel.
2. **Un client, plusieurs contrats.** L'API raisonne par contrat. Quelqu'un dont trois
   véhicules arrivent à échéance la même semaine recevra trois messages s'il n'y a pas
   de regroupement par email côté agent. C'est le meilleur moyen de se faire classer en
   spam.
3. **Adresse d'envoi.** À décider : boîte Google Workspace via le connecteur Gmail, ou
   serveur d'envoi du site.

---

## 8. Recette

```bash
MCJ_API_TOKEN=... node scripts/test-api-relances.mjs
```

Seize contrôles : codes HTTP, format JSON des erreurs, bornes de la plage de dates,
cohérence de `nombre`, opacité des `ref`, minimisation des données. Sans jeton, le script
s'arrête après les six contrôles non authentifiés plutôt que de faire semblant de passer.

### Journal

- **26/09/2026, matin** : première livraison. `api.php` déployé mais en erreur fatale sur
  tous les appels, y compris une route inconnue, donc avant le routage. Page d'erreur
  Apache par défaut au lieu du JSON documenté.
- **26/09/2026, après-midi** : corrigé. Les six contrôles non authentifiés passent, le JSON
  d'erreur est conforme, et le développeur a ajouté de lui-même `WWW-Authenticate`,
  `Cache-Control: no-store` et `X-Content-Type-Options: nosniff`. Les dix contrôles
  authentifiés restent à passer, jeton requis.
- **26/09/2026, soir** : recette relancée avec `MCJ_API_TOKEN` renseigné dans l'environnement
  (jeton bien formé : préfixe `mcj_`, 52 caractères, sans espace). Les six contrôles non
  authentifiés restent au vert, mais **le jeton est refusé** : 401 `non_autorise` sur les
  contrôles 7, 8, 9 et 16, aussi bien via `Authorization` que via `X-Authorization`. Ce n'est
  donc pas l'en-tête qui est filtré par Apache : le jeton n'est pas reconnu côté serveur
  (mauvais jeton, révoqué, ou non enregistré en base). À vérifier avec le développeur, puis
  relancer.
- **26/09/2026, nuit** : ✅ **recette validée, 16/16**. Le refus précédent venait de l'hébergeur,
  qui supprime l'en-tête `Authorization` avant PHP : le même jeton passe via `X-Authorization`.
  Le script envoie désormais les deux en-têtes. Le contrôle 13 donnait un faux positif
  (`prenom` contient `nom`) : les champs autorisés sont maintenant exclus de la recherche de
  fuite. Lecture nominale sur 7 jours : 103 contrats, uniquement les 8 champs du contrat,
  `ref` opaques, `Cache-Control: no-store`. Seul le marquage idempotent (`deja_faite`) reste
  non testé, pour ne pas consommer un vrai contrat.
