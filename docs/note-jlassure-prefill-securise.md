# Note à JL Assure — pré-remplissage sécurisé des pages conducteur & véhicule

> Document interne (brouillon à envoyer). Créé : 2026-06-18.
> Destinataire : christophe.p@jlassure.com — Compte : BLA1905B / id=43.

## Contexte
Sur l'app ChatGPT (et le site), on aimerait **réduire la saisie** des pages du tunnel
« Souscripteur-Conducteur » et « Véhicule » en les pré-remplissant à partir des
informations déjà collectées (et, à terme, d'une lecture OCR de la carte grise / du permis).

## Le blocage actuel
Le pré-remplissage existant (paramètres d'URL) ne couvre que des **données non
personnelles** (tarification). Votre doc **interdit explicitement** de transmettre
nom, e-mail, téléphone, immatriculation dans l'URL. Donc on **ne peut pas** pré-remplir
les champs **identité conducteur** ni **identité véhicule** par ce canal.

## Demande
Un **mécanisme de pré-remplissage sécurisé** (server-to-server), par exemple :
1. Notre serveur appelle un endpoint jlassure avec le **payload personnel** (auth par clé),
2. jlassure renvoie un **jeton à usage unique** / une **URL de session**,
3. le client est redirigé vers le tunnel **déjà pré-rempli**, **sans aucune donnée
   personnelle dans l'URL**.

Champs visés :
- **Conducteur** : nom, prénom, date de naissance, adresse, CP, ville, mobile, e-mail,
  type/nationalité/date d'obtention/n° de permis.
- **Véhicule** : immatriculation, date de 1re mise en circulation, marque (D.1),
  modèle (D.3), genre, puissance (P.6), PTAC (F.2), places, n° de châssis (E).

## Questions
1. Un tel **prefill sécurisé par jeton** est-il possible côté jlassure ? Sous quel délai ?
2. **Authentification**, **durée de vie** du jeton, **format** du payload ?
3. **Conservation** des données transmises côté jlassure (durée, finalité) ?
4. Qui est **responsable / sous-traitant** sur ce flux (pour notre registre RGPD) ?

## Important
- Les **pièces justificatives** (permis, carte grise) continueraient d'être **téléversées
  directement par le client sur votre tunnel** — nous ne souhaitons pas les héberger.
- Côté tarif, l'API `api_tarif_tempo.php` (déjà en place) suffit ; cette note concerne
  uniquement le **pré-remplissage des pages d'identité**.
