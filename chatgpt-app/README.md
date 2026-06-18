# Tempo-Assurance — prototype d'app ChatGPT (MVP-light)

Serveur **MCP** (le socle de l'**Apps SDK** d'OpenAI) exposant 2 outils pour préparer
un devis d'assurance temporaire dans une conversation ChatGPT.

> **MVP-light** : tarif **indicatif** (grille `llms.txt`) + **lien de devis pré-rempli**.
> La souscription et le paiement restent sur le tarificateur jlassure (conformité
> DDA/ACPR — modèle de redirection identique à APRIL Moto). Voir `../docs/cadrage-app-chatgpt.md`.

## Outils exposés
| Outil | Rôle |
|---|---|
| `devis_assurance_temporaire(profil)` | Tarif indicatif + lien pré-rempli vers le tarificateur |
| `tarifs_par_categorie(categorie_vehi)` | Grille de prix indicatifs par durée |

Aucune souscription / aucun paiement n'est effectué par l'app : elle **prépare**, le client finalise.

## Lancer / tester
```bash
cd chatgpt-app
node test.js     # 14 tests (logique + aller-retour JSON-RPC)
node server.js   # serveur MCP en stdio (JSON-RPC délimité par des sauts de ligne)
```

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
- `lib/tools.js` — déclaration des 2 outils MCP (schémas JSON).
- `server.js` — serveur MCP stdio (sans dépendance).
- `test.js` — tests.

## De ce prototype à la production
1. **Tarif réel (V2)** : remplacer la grille de `lib/tarifs.js` par un appel à l'**API
   tarif jlassure** (à demander — voir `../docs/note-jlassure-api-tarif.md`).
2. **Apps SDK OpenAI** : envelopper ces outils avec le transport **HTTP** de l'Apps SDK,
   ajouter le **manifest** de l'app et d'éventuels **composants UI**.
3. **Hébergement** : déployer le serveur sur un hôte Node joignable par OpenAI.
4. **Vérification de domaine** (tempo-assurance.com) + **soumission à la revue OpenAI**.

## Conformité
L'app n'effectue **aucune** souscription ni paiement. Elle fournit un tarif indicatif et
un lien pré-rempli ; le client vérifie, consulte l'IPID, signe et paie sur le tarificateur.
