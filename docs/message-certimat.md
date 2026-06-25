# Message à envoyer à Certimat / AssuCarteGrise

> Objet : Intégration iframe carte grise sur tempo-assurance.com — whitelist domaine + conditions partenaire (partner=7999)

Bonjour,

Nous sommes **Tempo-Assurance** (marque de **MCJ Courtage**, ORIAS n° 26008651), courtier spécialisé en assurance temporaire. Nous souhaitons proposer votre service de carte grise **en marque blanche sur notre site**, via votre iframe prescripteur (notre identifiant : **partner=7999**).

Nous avons préparé la page d'intégration. Il nous reste **un point technique bloquant** + quelques questions :

## 1. Whitelist `frame-ancestors` (bloquant)
Votre iframe `https://certimat.fr/iframe/prescripteurs?partner=7999` renvoie un en-tête
`Content-Security-Policy: frame-ancestors …` qui **n'autorise que les domaines de votre liste blanche**.
Notre domaine n'y figure pas → le navigateur bloque l'affichage.

➡️ **Merci d'ajouter nos deux domaines à votre `frame-ancestors` :**
- `https://www.tempo-assurance.com`
- `https://tempo-assurance.com`

## 2. Questions partenaire
1. **Commission** : quel est notre montant/% par dossier, et qui fixe le prix client (le prescripteur ?) ? Modulation possible comme indiqué (coût opérateur ~24,90 € → prix client libre) ?
2. **Personnalisation** : peut-on afficher **notre logo / nos couleurs** dans l'iframe (vrai marque blanche), ou reste-t-elle au branding Certimat ?
3. **Paramètres d'URL** : peut-on **pré-remplir** (type de démarche, plaque) via l'URL de l'iframe ?
4. **Redimensionnement** : l'iframe envoie-t-elle sa hauteur au parent (postMessage) pour un resize automatique ? Si oui, quel est l'événement/format ?
5. **Suivi** : comment suivons-nous les dossiers et la facturation (back-office, reporting) ?
6. **RGPD / contrat** : modèle de **convention d'apporteur**, responsabilités sur les données client, mentions à afficher.
7. **Habilitation** : numéro d'habilitation/agrément à indiquer sur notre page (pour la conformité).

## 3. Ce qui est prêt de notre côté
- Page dédiée `carte-grise.html` (iframe + habillage à nos couleurs, badges « habilité Ministère de l'Intérieur / CPI immédiat / 24–72 h / paiement en plusieurs fois »).
- `certimat.fr` autorisé dans notre propre CSP `frame-src`.
- Entrée « Carte grise » au menu + liens depuis nos pages achat-vente, import, plaque WW, carte grise barrée.

Dès que nos domaines sont whitelistés, l'intégration est immédiatement opérationnelle.

Merci d'avance,
[Nom] — Tempo-Assurance / MCJ Courtage
09 78 31 02 93 — contact@mcj-courtage.com
