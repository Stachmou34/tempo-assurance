# Tempo-Assurance — prototype d'app ChatGPT (MVP-light)

Serveur **MCP** (le socle de l'**Apps SDK** d'OpenAI) exposant 2 outils pour préparer
un devis d'assurance temporaire dans une conversation ChatGPT.

> **Tarif réel** via l'**API jlassure** si la clé `JLASSURE_API_KEY` est configurée,
> sinon **repli automatique** sur la grille indicative (`llms.txt`). Dans tous les cas,
> souscription et paiement restent sur le tarificateur jlassure (conformité DDA/ACPR —
> modèle de redirection identique à APRIL Moto). Voir `../docs/cadrage-app-chatgpt.md`.

## Configuration
```bash
export JLASSURE_API_KEY="<clé fournie par JL Assure>"   # tarif réel ; sinon mode indicatif
```
Endpoint : `POST https://www.jlassure.com/sousfiche/api_tarif_tempo.php`
(`Authorization: Bearer <clé>`). Sans clé, l'app fonctionne en tarif indicatif.

## Outils exposés
| Outil | Rôle |
|---|---|
| `devis_assurance_temporaire(profil)` | Tarif indicatif + lien pré-rempli vers le tarificateur |
| `tarifs_par_categorie(categorie_vehi)` | Grille de prix indicatifs par durée |

Aucune souscription / aucun paiement n'est effectué par l'app : elle **prépare**, le client finalise.

## Lancer / tester
```bash
cd chatgpt-app
node test.js          # 24 tests (logique, API mockée, repli, stdio, HTTP /mcp)
node server.js        # transport stdio (MCP Inspector / client local)
node server-http.js   # transport HTTP Apps SDK -> http://localhost:8788/mcp
```

## Deux transports
- **stdio** (`server.js`) : pour tester avec le **MCP Inspector** ou un client MCP local.
- **HTTP** (`server-http.js`) : transport « Streamable HTTP » attendu par l'**Apps SDK
  OpenAI**. Endpoint unique **`POST /mcp`** (JSON-RPC), `GET /` = health-check.
  Les deux partagent le même dispatch (`lib/rpc.js`) et les mêmes outils.

Essai manuel (stdio) :
```bash
printf '%s\n' \
  '{"jsonrpc":"2.0","id":1,"method":"initialize","params":{}}' \
  '{"jsonrpc":"2.0","id":2,"method":"tools/list","params":{}}' \
  '{"jsonrpc":"2.0","id":3,"method":"tools/call","params":{"name":"devis_assurance_temporaire","arguments":{"categorie_vehi":"VL-VL","puissance":"inf30","duree":15,"date_debut":"2026-07-01"}}}' \
  | node server.js
```

## Architecture
```
Utilisateur <-> ChatGPT <-> [ce serveur MCP] -> tarif indicatif
                                  |
                                  +-> lien jlassure pré-rempli -> souscription + paiement (client)
```

Fichiers :
- `lib/tarifs.js` — grille de prix indicatifs + mapping catégorie → grille.
- `lib/devis.js` — construction du lien pré-rempli + calcul du devis.
- `lib/jlassureApi.js` — client de l'API tarif jlassure (tarif réel).
- `lib/tools.js` — déclaration des 2 outils MCP (schémas + annotations + `_meta` widget).
- `lib/resources.js` — ressource widget UI (Apps SDK).
- `lib/rpc.js` — dispatch MCP partagé (tools + resources).
- `server.js` / `server-http.js` — transports stdio / HTTP.
- `web/devis.html` — widget UI (carte de devis) affiché dans ChatGPT.
- `test.js` — tests (28).

### Aperçu du widget
Ouvrir `web/devis.html` dans un navigateur affiche la **carte de devis** avec des
données d'exemple (en ChatGPT, les données réelles arrivent via `ui/notifications/tool-result`).

## Conformité Apps SDK (déjà en place)
- Transport **HTTP `/mcp`** (`server-http.js`).
- Outils avec **`inputSchema` + `outputSchema`** et **annotations** requises
  (`readOnlyHint: true`, `openWorldHint: false`, `destructiveHint: false` — outils de
  préparation, lecture seule, cible bornée).
- Tarif **réel** via l'API jlassure (validé en réel : HTTP 200, prix + durées + prefill_url).

## De ce prototype à la publication dans ChatGPT
1. **Déployer `server-http.js` derrière TLS** (HTTPS) sur un domaine joignable par OpenAI
   (faible latence sur `/mcp`, logs/metrics). ⚠️ nouvelle brique : le site est statique.
2. **Renseigner `JLASSURE_API_KEY`** en variable d'environnement de l'hôte.
3. (Optionnel) **Composant UI** (widget) via `openai/outputTemplate` + `_meta` pour un
   rendu enrichi dans ChatGPT (sinon ChatGPT affiche `structuredContent`/texte).
4. **Enregistrer le connecteur** (URL `/mcp`) dans ChatGPT (mode développeur), valider
   avec le **MCP Inspector**.
5. **Vérification de domaine** (tempo-assurance.com) + **soumission à la revue OpenAI**.

## Conformité
L'app n'effectue **aucune** souscription ni paiement. Elle fournit un tarif indicatif et
un lien pré-rempli ; le client vérifie, consulte l'IPID, signe et paie sur le tarificateur.
