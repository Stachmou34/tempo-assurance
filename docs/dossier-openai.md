# Dossier de soumission — App ChatGPT « Assurance temporaire » (Tempo-Assurance)

> Tout le nécessaire pour la **revue OpenAI**. Phase 2 (zéro formulaire) **OFF** :
> l'app publique n'expose que le **devis** (pas de données d'identité). Créé : 2026-06-19.

## 1. Identité de l'app
| Champ | Valeur |
|---|---|
| **Nom** | Assurance temporaire (Tempo-Assurance) |
| **Description courte** | Devis d'assurance auto temporaire (1 à 90 jours) en quelques questions. |
| **Description longue** | Préparez en quelques secondes un devis d'assurance temporaire (voiture, utilitaire, camion, camping-car, moto exclue, remorque…) pour 1 à 90 jours. L'assistant pose les questions utiles (ou lit votre carte grise pour un tarif précis) et vous renvoie vers le tarificateur en ligne pour finaliser. Souscription et paiement 100 % sur le tunnel sécurisé du partenaire. |
| **Catégories** | Finance / Assurance · Automobile |
| **Éditeur** | MCJ Courtage (marque Tempo-Assurance) |
| **Contact** | contact@mcj-courtage.com |
| **Langue** | Français |

## 2. URLs techniques
| Élément | URL |
|---|---|
| **Serveur MCP** (connecteur) | `https://tempo-assurance-mcp.onrender.com/mcp` |
| **Politique de confidentialité** | `https://www.tempo-assurance.com/confidentialite-ia.html` |
| **Site / domaine à vérifier** | `tempo-assurance.com` |
| **Mentions légales** | `https://www.tempo-assurance.com/mentions-legales.html` |

## 3. Outils exposés (périmètre public, Phase 2 OFF)
| Outil | Type | Rôle |
|---|---|---|
| `devis_assurance_temporaire` | lecture seule | Tarif + lien de devis pré-rempli |
| `tarifs_par_categorie` | lecture seule | Grille de tarifs indicatifs |

> `preparer_session_souscription` (pré-remplissage d'identité) **n'est PAS exposé** :
> `ENABLE_PREFILL_SESSION` reste **non défini** sur l'hébergeur.

## 4. Exemples de prompts (pour la fiche / la revue)
- « Assure ma voiture 15 jours pour mes vacances. »
- « Combien pour assurer un utilitaire 1 mois ? »
- « Devis 7 jours, voiture immatriculée en France, conducteur 30 ans. »
- « Voici ma carte grise, fais-moi un tarif pour 15 jours. »

## 5. Conformité (arguments pour la revue)
- Outils **en lecture seule** (`readOnlyHint: true`), **aucune écriture**, **aucun paiement**.
- **Aucune donnée d'identité** traitée par l'app dans le périmètre public.
- Souscription/paiement réalisés par le client sur le **tunnel régulé** (JL Assure), pas par l'app.
- Politique de confidentialité publique sur le domaine vérifié.

## 6. Visuels à fournir
- **Icône** 256×256 px (PNG) — logo Tempo-Assurance.
- **Captures** : carte de devis (widget) — disponibles (`widget_v5`), + écran tarificateur pré-rempli.

## 7. Check-list de soumission (ordre)
1. [ ] **Render → Starter** (service toujours allumé, faible latence sur `/mcp`).
2. [ ] **Régénérer la clé** `JLASSURE_API_KEY` (l'actuelle a circulé) → mettre à jour dans Render.
3. [ ] Vérifier que **`ENABLE_PREFILL_SESSION` n'est PAS défini** (phase 2 OFF).
4. [ ] **Déployer** la page `confidentialite-ia.html` sur le site (merge + mise en ligne).
5. [ ] Compte **développeur OpenAI** → créer l'app, renseigner nom/description/catégories/contact.
6. [ ] Coller l'**URL du connecteur** `…/mcp` + l'**URL de confidentialité**.
7. [ ] **Vérification de domaine** `tempo-assurance.com` (enregistrement DNS TXT fourni par OpenAI).
8. [ ] Ajouter **icône + captures**.
9. [ ] Tester en mode dev (prompts ci-dessus), capturer le widget en fonctionnement.
10. [ ] **Soumettre à la revue** OpenAI.

## 8. Après publication
- L'app apparaît dans l'annuaire ChatGPT + suggestion contextuelle → accessible au grand public (1 clic, sans installation).
- Promotion : lien direct depuis le **site / mails / réseaux** (modèle APRIL Moto).
