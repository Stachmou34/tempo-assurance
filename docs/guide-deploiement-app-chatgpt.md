# Guide pas-à-pas — Publier l'app Tempo dans ChatGPT

> Pour : Christophe (MCJ Courtage). Le **code est prêt** (`chatgpt-app/`). Ce guide
> couvre ce qui reste, et que **toi seul** peux faire (comptes, hébergement, revue OpenAI).
> Mis à jour : 2026-06-18.

## Ce dont tu as besoin avant de commencer
- La **clé API jlassure** (à faire **régénérer**, l'actuelle a circulé par chat).
- Un **compte OpenAI développeur** (platform.openai.com / developers.openai.com).
- Un **compte d'hébergement** pour faire tourner un petit serveur Node (voir Phase 1).
- Accès au **DNS** de tempo-assurance.com (pour la vérification de domaine, Phase 5).
- Une carte bancaire (l'hébergement coûte ~0–7 €/mois selon l'offre).

---

## Phase 1 — Héberger le serveur (`server-http.js`)
Le serveur doit tourner en **HTTPS**, en continu, et exposer `…/mcp`.

1. Choisir un hébergeur Node simple (au choix) : **Render**, **Railway**, **Fly.io**,
   **Google Cloud Run**. (Render et Railway sont les plus simples ; offres gratuites/petites.)
2. Y déposer le dossier `chatgpt-app/` (connecter le dépôt GitHub, ou upload).
3. Réglages du service :
   - **Commande de démarrage** : `node server-http.js`
   - **Variable d'environnement** : `JLASSURE_API_KEY = <ta clé>` (⚠️ jamais dans le code)
   - **Port** : l'hébergeur fournit `PORT` automatiquement (le serveur le lit déjà).
4. Déployer → tu obtiens une URL HTTPS, ex. `https://tempo-mcp.onrender.com`.
   Ton endpoint sera donc **`https://tempo-mcp.onrender.com/mcp`**.

> 💡 L'HTTPS est fourni automatiquement par ces hébergeurs. Rien à configurer.

---

## Phase 2 — Vérifier que ça répond
Depuis ton terminal (remplace l'URL) :
```bash
# health-check
curl https://tempo-mcp.onrender.com/

# liste des outils (doit renvoyer devis_assurance_temporaire + tarifs_par_categorie)
curl -X POST https://tempo-mcp.onrender.com/mcp \
  -H "Content-Type: application/json" \
  -d '{"jsonrpc":"2.0","id":1,"method":"tools/list","params":{}}'
```
Pour un test plus visuel, utiliser l'outil officiel **MCP Inspector** :
```bash
npx @modelcontextprotocol/inspector
# puis y entrer l'URL https://…/mcp et tester les outils + le widget
```

---

## Phase 3 — Brancher l'app dans ChatGPT (mode développeur)
1. Dans **ChatGPT** : Paramètres → **Apps & Connecteurs** → activer le **mode développeur**.
2. **Ajouter un connecteur / app** → coller l'URL **`https://…/mcp`**.
3. ChatGPT découvre les 2 outils et le widget. Le devis s'affichera via la **carte UI**
   (celle de l'aperçu).

---

## Phase 4 — Tester dans la conversation
1. Lancer un prompt du type :
   *« Assure ma voiture 15 jours, conducteur 35 ans, immatriculée et résidant en France. »*
2. Vérifier : l'app appelle `devis_assurance_temporaire`, affiche la **carte de devis**
   (prix réel + durées), et le bouton **Souscrire** ouvre le tarificateur pré-rempli.
3. **Capturer des captures d'écran** du widget en fonctionnement (demandées à la revue).

---

## Phase 5 — Publier (revue OpenAI)
1. **Vérification de domaine** : OpenAI demande de prouver que tu possèdes
   tempo-assurance.com (ajout d'un enregistrement **DNS TXT** fourni par eux).
2. Compléter la **fiche de l'app** : nom, description, logo, politique de confidentialité,
   mentions légales (tu as déjà les pages sur le site).
3. **Soumettre à la revue OpenAI**. Après validation → l'app est **distribuable** dans ChatGPT.

---

## Coûts, maintenance, conformité
- **Coût** : hébergement ~0–7 €/mois. La revue OpenAI est gratuite.
- **Maintenance** : garder le serveur en ligne ; si jlassure change l'API, ajuster `lib/jlassureApi.js`.
- **Sécurité** : la clé jlassure reste **uniquement** en variable d'environnement de l'hébergeur.
- **Conformité (DDA/ACPR)** : l'app **prépare** (tarif + lien). **Souscription + paiement
  restent sur le tarificateur jlassure** — comme le modèle APRIL Moto. Rien à changer.

## Récap de qui fait quoi
| Étape | Qui |
|---|---|
| Code (serveur, outils, widget, API) | ✅ fait |
| Régénérer la clé API jlassure | toi + jlassure |
| Héberger `server-http.js` (HTTPS + clé en env) | toi |
| Brancher le connecteur dans ChatGPT | toi |
| Vérif domaine + soumission à la revue | toi |

Je peux t'aider à chaque étape (config de l'hébergeur, test du endpoint, ajustements).
