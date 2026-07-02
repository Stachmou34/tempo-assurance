# Re-soumission de l'app ChatGPT après activation de la Phase 2 (pièces d'identité)

> Pourquoi : l'app était approuvée en déclarant **aucune donnée personnelle**. La Phase 2
> (lecture permis + carte grise, transmission des pièces) fait qu'elle **traite désormais des
> données personnelles et des pièces d'identité**. Il faut mettre la soumission en cohérence et
> **re-soumettre pour re-revue OpenAI**. Sources : docs OpenAI « Submit and maintain your app »
> et « App submission guidelines ».

## ⚠️ Point de vigilance immédiat
En passant `ENABLE_PREFILL_SESSION=1` sur Render, l'app **publiée** fait maintenant quelque chose
qui **n'était pas dans sa version approuvée** (traitement de pièces d'identité). OpenAI fait du
contrôle de conformité continu (« les apps trouvées en violation peuvent être retirées »).
→ **Recommandation** : soit re-soumettre **avant** de laisser la fonction ouverte au public, soit
re-soumettre **sans délai** maintenant qu'elle est active.

## Ce qui est déjà prêt (côté nous)
- ✅ Politique de confidentialité à jour (données, consentement, canal S2S, §9) — `confidentialite-ia.html`.
- ✅ Consentement explicite + récapitulatif + confirmation **dans le flux** (description de l'outil).
- ✅ Annotations correctes : `preparer_session_souscription` = **non read-only** (elle crée une session).
- ✅ Aucune donnée **interdite** collectée : pas de carte bancaire (paiement sur le tunnel), pas de
  n° de sécurité sociale, pas de données de santé, pas de credentials.
- ✅ Déclaration de données **mise à jour** : `chatgpt-app/chatgpt-app-submission.json`
  (`collects_personal_data: true`, `collects_sensitive_data: true`, sous-traitants, rétention).

## À faire dans le dashboard OpenAI (Platform → Apps)
1. Ouvrir l'app **« Assurance temporaire »** → **modifier la version (draft)**.
2. Reporter la **déclaration de données** du fichier `chatgpt-app-submission.json` :
   - « Collecte des données personnelles » → **Oui**
   - Décrire : option de souscription (permis + carte grise), **consentement explicite**,
     transmission **serveur-à-serveur** à JL Assure, **aucune conservation** côté assistant,
     **aucune donnée perso dans l'URL**, **pas de paiement** collecté.
   - Sous-traitants : **OpenAI**, **JL Assure**. Politique de confidentialité : déjà renseignée.
3. Le 3ᵉ outil `preparer_session_souscription` apparaît automatiquement (le serveur MCP le déclare) ;
   vérifier son annotation **non read-only** et sa description (nécessité + consentement).
4. **Re-soumettre pour revue**. Si une revue est déjà en cours, la **retirer** (« Cancel Review »
   dans le menu ⋯) puis re-soumettre la version à jour.
5. Attendre la validation OpenAI avant de communiquer publiquement sur la nouvelle fonction.

## Justification à donner si OpenAI questionne
- **Nécessité** : la souscription d'assurance impose légalement l'identité du conducteur et du
  véhicule (permis, carte grise) — données strictement nécessaires à la finalité.
- **Consentement** : demandé explicitement, récapitulé, confirmé avant tout envoi ; l'utilisateur
  peut refuser et saisir/téléverser lui-même sur le tunnel.
- **Minimisation & sécurité** : seuls les champs fournis sont transmis ; canal S2S/TLS ; aucune
  conservation côté assistant ; suppression auto côté assureur si la session expire.
- **Encadrement** : courtier ORIAS 26008651 ; souscription/paiement réalisés sur le tunnel régulé
  (DDA/ACPR), pas par l'app.

## Option de repli
Si la revue prend du temps ou pose problème, remettre `ENABLE_PREFILL_SESSION=0` sur Render :
l'app revient au **devis seul** (déjà approuvé), sans rupture.
