# Branches obsoletes a supprimer (analyse du 25/09/2026)

> Analyse faite le 25/09/2026. La suppression n a PAS pu etre executee depuis
> l environnement agent (proxy git : HTTP 403, suppression de branche interdite).
> Les SHA sont conserves ci-dessous : restauration par `git push origin <sha>:refs/heads/<nom>`.

## Verification faite (suppression sure)

Chaque branche a ete comparee a `main` fichier par fichier. Les seuls fichiers
absents de `main` etaient `assets/site.css` et `assurance-temporaire-poids-lourd.html`,
deux suppressions **volontaires** : le CSS a ete inline dans les pages, et la page
poids lourd est redirigee en 301 vers `assurance-temporaire-camion.html` (voir .htaccess).
Aucun travail non merge n'a donc ete perdu.

| Branche | SHA | Dernier commit |
|---|---|---|
| `claude/a11y-liens-soulignes` | `f4fba92` | 2026-06-11 A11y : liens de contenu soulignes + (re)fix CSP |
| `claude/blog-301` | `7154991` | 2026-06-15 SEO : redirections 301 du vieux blog vers les p |
| `claude/geo-fondations` | `0ca6a2b` | 2026-06-11 GEO : fondations pour etre cite par les moteurs |
| `claude/geo-pages-reponses` | `42bc973` | 2026-06-14 docs : ajout de la vision cible (MCJ générali |
| `claude/hero-auto-titre` | `37a7549` | 2026-06-11 Hero : recentrage auto (titre 'Votre assurance  |
| `claude/hero-devis-uiux` | `67a5d7c` | 2026-06-11 Hero : titre 'Votre assurance auto temporaire,  |
| `claude/pages-categories` | `498bbcd` | 2026-06-14 Fix menu : sous-menu nav normalisé (12 items)  |
| `claude/perf-icones-svg` | `cac7154` | 2026-06-11 Fix CSP : autorise analytics.google.com (domain |
| `claude/refonte-statique` | `d6a4f3f` | 2026-06-10 Refonte complète : site statique fait main, sa |
| `claude/seo-canonical-liens` | `06459d7` | 2026-06-15 SEO : liens internes vers la racine / (au lieu  |
| `claude/tarifs-mobile` | `e047dd2` | 2026-06-15 Tarifs mobile : tableaux en cartes par durée ( |
| `claude/tel-unique` | `855d273` | 2026-06-18 Numéro de téléphone unique : 09 78 31 02 93  |
| `fix/seo-today` | `47a17df` | 2026-07-29 SEO title + design handoff Piste E |

## Branches CONSERVEES

| Branche | Raison |
|---|---|
| `main` | branche principale, protegee |
| `claude/upbeat-cerf-yjyYC` | branche de travail active |
| `sauvegarde-avant-seo` | sauvegarde de l'ancien site PHP (513 fichiers `admin/*.php`) |
| `sauvegarde-refonte-2026-06-07` | sauvegarde de l'ancien site PHP (515 fichiers) |
| `sauvegarde-x5` | sauvegarde de l'ancien site PHP (514 fichiers) |
| `claude/laughing-davinci-8Ft1H` | contient aussi l'ancien site PHP (524 fichiers), conservee par prudence |
