# Déployer Tempo-Assurance comme connecteur Claude (MCP)

> Objectif : rendre nos outils de devis disponibles dans **Claude** (claude.ai et
> applis), comme on l'a fait pour ChatGPT. **Bonne nouvelle : aucun nouveau serveur
> à écrire.** Claude et ChatGPT parlent le **même protocole (MCP)** — le serveur
> `chatgpt-app/` est déjà compatible. On réutilise la **même URL `/mcp`** déjà déployée
> sur Render pour l'app ChatGPT.

## Pourquoi ça marche sans recoder

L'**Apps SDK** d'OpenAI **est** du MCP (Model Context Protocol). Notre serveur
(`chatgpt-app/server-http.js` + `lib/rpc.js`) implémente le MCP standard :
`initialize`, `tools/list`, `tools/call`, `resources/*`. Les réponses renvoient
à la fois du **texte** (`content`) et du **JSON structuré** (`structuredContent`),
que Claude sait afficher. Le seul élément propre à OpenAI est le **widget visuel**
(`_meta` / `openai/outputTemplate`) : Claude l'**ignore** simplement, sans erreur —
il présente le résultat sous forme de texte/structure.

Deux petits réglages ont été ajoutés pour une compatibilité propre (déjà en place) :
- **Négociation de version** : le serveur renvoie la version de protocole demandée par
  le client si elle est connue (`2025-06-18`, `2025-03-26`, `2024-11-05`), sinon son défaut.
- **Découverte d'auth** : les sondes `/.well-known/oauth-*` renvoient `404`, ce qui
  indique à Claude un connecteur **sans authentification** (nos outils sont publics et
  en lecture seule).

## Outils exposés (identiques à ChatGPT)

| Outil | Rôle |
|---|---|
| `devis_assurance_temporaire(profil)` | Tarif (réel via API jlassure, sinon indicatif) + lien de devis pré-rempli |
| `tarifs_par_categorie(categorie_vehi)` | Grille de prix indicatifs par durée |

Aucune souscription ni paiement n'est effectué : l'outil **prépare**, le client
finalise sur le tarificateur (conformité DDA/ACPR — modèle de redirection).

## Étape 1 — Prérequis (déjà fait pour ChatGPT)

Le serveur tourne déjà sur Render à une URL HTTPS, p. ex. :

```
https://tempo-mcp.onrender.com/mcp        ← remplace par TON URL Render réelle
```

Vérifier qu'il répond :

```bash
# health-check
curl https://tempo-mcp.onrender.com/

# handshake MCP
curl -X POST https://tempo-mcp.onrender.com/mcp \
  -H 'Content-Type: application/json' \
  -d '{"jsonrpc":"2.0","id":1,"method":"initialize","params":{"protocolVersion":"2025-06-18"}}'
```

> Conseil prod : passer Render en plan **Starter** pour éviter le *cold start*
> (un connecteur lent dégrade l'expérience). Et **garder `JLASSURE_API_KEY` en
> variable d'environnement** uniquement.

## Étape 2 — Ajouter le connecteur dans Claude

Côté **claude.ai** (offres Pro / Max / Team / Enterprise selon l'activation des
connecteurs personnalisés) :

1. **Réglages → Connecteurs** (Connectors) → **Ajouter un connecteur personnalisé**
   (*Add custom connector*).
2. **Nom** : `Tempo-Assurance` · **URL du serveur** : `https://…/mcp` (ton URL Render).
3. **Authentification** : aucune (nos outils sont publics, en lecture seule).
4. Valider → Claude appelle `initialize` puis `tools/list` et affiche les 2 outils.
5. Dans une conversation, activer le connecteur et tester :
   « Prépare-moi un devis d'assurance temporaire pour une voiture, 15 jours,
   à partir du 1er juillet, conducteur né le 12/05/1990. »

> Côté **Team/Enterprise**, l'administrateur peut ajouter le connecteur au niveau de
> l'organisation pour le rendre disponible à tous les membres.

## Étape 3 (optionnel) — Annuaire de connecteurs Anthropic

Pour la **découvrabilité** (être trouvé sans coller l'URL à la main), on peut
soumettre le connecteur à l'**annuaire** Anthropic (*connector directory*), de la
même logique que la revue OpenAI : description, périmètre, conformité (lecture seule,
aucune donnée personnelle transmise, redirection pour la souscription). Réutiliser le
dossier `chatgpt-app/chatgpt-app-submission.json` comme base.

## Conformité (identique à l'app ChatGPT)

- **Lecture seule** : `readOnlyHint: true`, `openWorldHint: false`, `destructiveHint: false`.
- **Aucune donnée personnelle** transmise par les outils de devis (pas de nom,
  adresse, immatriculation, châssis). La Phase 2 (pré-remplissage avec données perso)
  reste **OFF** (`ENABLE_PREFILL_SESSION`) tant que le feu vert RGPD n'est pas donné.
- **Souscription/paiement** uniquement sur le tarificateur jlassure (le client finalise).

## Récap

- ✅ **Pas de nouveau code** : le serveur MCP de l'app ChatGPT est réutilisé tel quel.
- ✅ **Même URL `/mcp`** sur Render.
- ▶️ **À faire (toi)** : ajouter l'URL comme connecteur personnalisé dans Claude, tester,
  puis (optionnel) soumettre à l'annuaire Anthropic.
