# Déployer le serveur MCP sur Render — pas à pas

> Objectif : mettre en ligne `chatgpt-app/server-http.js` en HTTPS, pour obtenir une
> URL `https://…/mcp` à brancher dans ChatGPT. Mis à jour : 2026-06-18.

## Avant de commencer
- **Merger la PR #43** sur `main` (pour déployer une branche stable). *(Render peut aussi
  déployer une autre branche si tu préfères.)*
- Avoir ta **clé API jlassure** (idéalement régénérée).
- Créer un compte sur **https://render.com** (connexion avec GitHub recommandée).

---

## Option A — Blueprint (recommandé, quasi 1 clic)
Le dépôt contient un fichier **`render.yaml`** qui décrit déjà le service.

1. Render → bouton **New +** → **Blueprint**.
2. **Connecter le dépôt** `Stachmou34/tempo-assurance` → Render lit `render.yaml`.
3. Render propose un service **`tempo-assurance-mcp`**. Cliquer **Apply**.
4. Une fois créé : ouvrir le service → **Environment** → vérifier/ajouter la variable
   **`JLASSURE_API_KEY`** = ta clé → **Save** (déclenche un redéploiement).
5. Attendre le déploiement (statut **Live**). Ton URL : ex. `https://tempo-assurance-mcp.onrender.com`.

➡️ Passer à **Vérifier** ci-dessous.

---

## Option B — Manuel (si tu préfères tout cliquer)
1. Render → **New +** → **Web Service**.
2. **Connecter** le dépôt `Stachmou34/tempo-assurance`, branche `main`.
3. Réglages :
   - **Root Directory** : `chatgpt-app`
   - **Runtime** : Node
   - **Build Command** : `npm install`
   - **Start Command** : `node server-http.js`
   - **Health Check Path** : `/`
   - **Instance Type** : *Free* pour tester, **Starter** (~7 €/mois) pour la prod.
4. **Advanced → Add Environment Variable** : `JLASSURE_API_KEY` = ta clé.
5. **Create Web Service** → attendre le statut **Live**.

---

## Vérifier que ça marche
Remplace l'URL par la tienne :
```bash
# 1) health-check → {"ok":true,...,"endpoint":"/mcp"}
curl https://tempo-assurance-mcp.onrender.com/

# 2) liste des outils → devis_assurance_temporaire + tarifs_par_categorie
curl -X POST https://tempo-assurance-mcp.onrender.com/mcp \
  -H "Content-Type: application/json" \
  -d '{"jsonrpc":"2.0","id":1,"method":"tools/list","params":{}}'

# 3) un vrai devis (tarif réel si la clé est bonne)
curl -X POST https://tempo-assurance-mcp.onrender.com/mcp \
  -H "Content-Type: application/json" \
  -d '{"jsonrpc":"2.0","id":2,"method":"tools/call","params":{"name":"devis_assurance_temporaire","arguments":{"categorie_vehi":"VL-VL","age_vehicule":"moins10","puissance":"inf30","pays_immatriculation":"FRANCE METROPOLITAINE","pays_residence":"FRANCE METROPOLITAINE","age_conducteur":35,"duree":15}}}'
```
- Le test 3 doit renvoyer un **prix réel** et un **`prefill_url`**. Si tu vois
  `"source":"indicatif"`, c'est que la variable `JLASSURE_API_KEY` n'est pas (bien) prise
  en compte → revérifier dans **Environment**.

---

## ⚠️ À savoir sur l'offre gratuite
Le plan **Free** **met le service en veille** après ~15 min d'inactivité (premier appel
ensuite = lent). C'est OK pour **tester**, mais pour la **production / la revue OpenAI**,
passer en **Starter** (Settings → Instance Type) pour qu'il reste toujours allumé.

---

## Ensuite
Une fois l'URL `https://…/mcp` en ligne et testée → suivre
`guide-deploiement-app-chatgpt.md` à partir de la **Phase 3** (brancher le connecteur
dans ChatGPT, tester, puis vérif domaine + revue OpenAI).
