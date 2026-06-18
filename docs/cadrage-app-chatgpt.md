# Cadrage — Application ChatGPT « Tempo Assurance »

> Document interne. Créé : 2026-06-18.
> Déclencheur : APRIL Moto a lancé une app de souscription assurance dans ChatGPT (15/06/2026).

## Objectif
Ouvrir un **canal conversationnel** (ChatGPT) où l'IA prépare un devis d'assurance
temporaire, puis **redirige vers le tarificateur jlassure pré-rempli** pour finaliser
(souscription + paiement restent sur le tunnel régulé — modèle identique à APRIL).

## Distinction avec le WebMCP déjà livré
- **WebMCP** (fait) : outils déclarés par le **site**, pour les agents **dans le navigateur**.
- **App ChatGPT** (ce projet) : **serveur MCP hébergé** par nous, intégré **dans ChatGPT**
  via l'Apps SDK d'OpenAI. Canaux **complémentaires**.

## Architecture
```
Utilisateur <-> ChatGPT <-> [Serveur MCP Tempo (hébergé)] -> tarif
                                   |
                                   +-> lien jlassure pré-rempli -> souscription + paiement
```

## Composants
| Brique | Détail | Réutilise |
|---|---|---|
| Serveur MCP (Node) | 2 outils : `devis_assurance_temporaire`, `tarifs_par_categorie` | schémas WebMCP |
| Source de prix | MVP-light : **grille `llms.txt`** → V2 : **API jlassure** | grille existante |
| Sortie | tarif + **lien pré-rempli** vers le tarificateur | recette de lien testée |
| Conformité | souscription/paiement = redirection (modèle APRIL) | — |

## Deux versions
- **MVP-light** : prix **indicatif** (grille), zéro dépendance jlassure. Faisable vite.
- **V2 « comme APRIL »** : prix **temps réel** → dépend de l'**API tarif jlassure**
  (voir `note-jlassure-api-tarif.md`).

## Étapes
1. Dev serveur MCP + 2 outils (prototype dans `chatgpt-app/`). ← démarré
2. **Hébergement** d'un serveur Node joignable par OpenAI (⚠️ nouveau : le site est
   statique Apache aujourd'hui — brique serveur en plus).
3. Compte développeur OpenAI + **manifest de l'app** + **vérification de domaine**.
4. **Soumission à la revue OpenAI** → publication.
5. Bascule **temps réel** dès que jlassure fournit l'API.

## Effort réaliste
- Prototype MVP-light : ~2–4 j de dev.
- Version publiable (hébergement, manifest, branding, revue OpenAI) : ~2–4 semaines
  (la revue OpenAI est le facteur le moins maîtrisable).
- V2 temps réel : + intégration API jlassure (dépend de leur délai).

## Conformité (DDA / ACPR)
L'app **prépare** uniquement (profil + tarif + lien). **Aucune souscription, aucun
paiement** sans l'action du client sur le tunnel jlassure.

## État
- [x] Cadrage + note jlassure rédigés
- [x] Prototype MVP-light (`chatgpt-app/`) : 2 outils + grille + lien pré-rempli + tests
- [ ] Demande API tarif envoyée à jlassure
- [ ] Hébergement + manifest Apps SDK + revue OpenAI
