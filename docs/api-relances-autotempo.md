# Cahier des charges : API de relance client (autotempo.net)

Destinataire : le developpeur de `autotempo.net` (back-office MCJ Courtage).
Objectif : permettre a un agent automatise de preparer chaque matin les relances
commerciales aupres des clients dont le contrat temporaire arrive a echeance.

Volume attendu : quelques dizaines d'enregistrements par jour au maximum.
Charge negligeable, une seule requete par jour.

---

## 1. Principe

Une assurance temporaire a une **date de fin connue a l'avance**. Un client qui
a pris 30 jours aura un besoin dans 30 jours : assurance annuelle, reconduction,
ou carte grise s'il vient d'acheter le vehicule. C'est le declencheur commercial
le plus previsible du metier, et il est aujourd'hui inexploite.

L'agent tourne **sans memoire d'un jour sur l'autre** : chaque execution repart de
zero. C'est pourquoi le back-office doit porter l'etat « deja relance », sinon le
meme client serait sollicite tous les jours.

---

## 2. Endpoint de lecture

```
GET /api/relances?fin_min=3&fin_max=10
Authorization: Bearer <jeton>
Accept: application/json
```

Retourne les contrats dont la date de fin tombe entre `aujourd'hui + fin_min` et
`aujourd'hui + fin_max` **et** qui n'ont pas deja ete relances.

### Reponse

```json
{
  "contrats": [
    {
      "ref": "a3f91c",
      "email": "client@example.com",
      "prenom": "Marc",
      "date_debut": "2026-09-02",
      "date_fin": "2026-10-02",
      "duree_jours": 30,
      "categorie": "CC-Cap",
      "montant": 199.15
    }
  ],
  "total": 1
}
```

### Champs

| Champ | Obligatoire | Usage |
|---|---|---|
| `ref` | oui | identifiant **opaque** du contrat, sert a marquer la relance. **Ne pas exposer l'identifiant reel en base.** |
| `email` | oui | destinataire de la relance |
| `prenom` | non | personnalisation du message. Omettre si vous preferez |
| `date_debut` | oui | comprendre le cas d'usage |
| `date_fin` | oui | le declencheur |
| `duree_jours` | oui | un client a 1 jour et un client a 90 jours n'ont pas le meme besoin |
| `categorie` | oui | code vehicule (`VL-VL`, `CC-Cap`, `CAM-CAM3`...) pour adapter l'offre |
| `montant` | non | prioriser les contrats a plus forte valeur |

### Ce qu'il ne faut PAS renvoyer

**Nom de famille, adresse postale, telephone, plaque d'immatriculation, numero de
permis, date de naissance, coordonnees bancaires.** Rien de tout cela n'est
necessaire pour envoyer une relance. Moins l'API en expose, moins une fuite coute.

---

## 3. Endpoint d'ecriture

```
POST /api/relances/{ref}/marquee
Authorization: Bearer <jeton>
```

Marque le contrat comme relance, avec la date. Il ne doit plus ressortir dans le
`GET`. Idempotent : un second appel ne provoque pas d'erreur.

C'est **indispensable**. Sans lui, l'agent n'a aucun moyen de savoir qui il a deja
sollicite, et le client recevrait une relance quotidienne.

---

## 4. Desinscription

Le back-office doit porter un indicateur **« ne plus demarcher »** par client.
Un contrat dont le client s'est desinscrit **ne doit jamais ressortir** dans le
`GET`, meme s'il n'a jamais ete relance.

Cote message, chaque relance comportera un lien de desinscription. Il faudra donc
aussi, a terme, un moyen de positionner cet indicateur depuis ce lien. Un simple
endpoint public avec un jeton signe par client suffit.

---

## 5. Authentification et securite

- **Jeton porteur** (`Authorization: Bearer`), genere cote back-office, revocable
  a tout moment. Il sera range dans le coffre de l'environnement, jamais dans un
  depot ni dans un message.
- **HTTPS obligatoire**, deja en place.
- **Lecture seule** pour le `GET`. Le `POST` ne doit pouvoir que positionner un
  indicateur de relance, rien d'autre.
- **Limitation de debit** : quelques requetes par jour suffisent, un plafond bas
  est une bonne protection.
- **Journalisation** des acces : date, endpoint, nombre d'enregistrements retournes.
- Le jeton ne doit donner acces **qu'a ces deux endpoints**, pas au reste du
  back-office.

---

## 6. Details qui evitent des surprises

- **Fuseau horaire** : preciser si les dates sont en UTC ou en heure de Paris.
  L'agent tourne le matin, un decalage d'un jour fausserait le ciblage.
- **Pagination** : inutile au volume attendu, mais si vous en mettez une,
  documentez-la.
- **Contrats sans email** : les exclure du `GET` plutot que renvoyer un champ vide.
- **Erreurs** : codes HTTP standards. `401` si le jeton est absent ou invalide,
  `403` s'il est valide mais non autorise, `404` si la `ref` n'existe pas.
- **Reponse vide** : renvoyer `{"contrats": [], "total": 0}` et non une erreur.

---

## 7. Comment on validera

1. `GET` sans jeton renvoie **401**
2. `GET` avec jeton renvoie du JSON conforme au schema ci-dessus
3. Les champs interdits (nom, adresse, plaque...) sont **absents**
4. Apres un `POST .../marquee`, le contrat **ne ressort plus** dans le `GET`
5. Un client desinscrit ne ressort jamais
6. Une plage sans contrat renvoie un tableau vide, pas une erreur

---

## 8. Ce que ca permettra ensuite

Une fois l'API en place, l'agent quotidien pourra segmenter les relances selon le
profil reel : un client camping-car a 15 jours n'a pas le meme besoin qu'un client
voiture a 1 jour qui vient manifestement d'acheter un vehicule d'occasion et aura
besoin d'une carte grise.

C'est la difference entre un mailing de masse et une relance pertinente.
