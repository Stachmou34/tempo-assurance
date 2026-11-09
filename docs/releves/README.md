# Relevés quotidiens de la routine

Un fichier par jour, nommé `AAAA-MM-JJ.md` (date du jour de la session), créé par la routine.
Ne jamais modifier le fichier d'un autre jour : chaque branche ne crée que le sien, et deux PR
ouvertes en même temps ne peuvent donc pas entrer en conflit.

Les relevés jusqu'au 08/11/2026 sont dans `docs/webmaster-playbook.md`, section 9, chantier 1.

## Modèle

```markdown
# Relevé du JJ/MM/AAAA

**Relevé** : GA4 (veille) N sessions et N événements clés, contre N et N le même jour de la
semaine précédente (+/- %). Search Console (fenêtre) : N à N clics/jour, position N à N.
Surveillance : sans alerte (ou : l'alerte et ce qui a été fait).

**Chantier livré** : `page.html`, requête « … » (N impressions, position N, N clics, fenêtre) :
ce qui manquait, ce qui a été changé. À mesurer à partir du JJ/MM. PR #N.
```
