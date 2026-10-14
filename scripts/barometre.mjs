#!/usr/bin/env node
/* Baromètre de l'assurance temporaire : agrégats publiables du portefeuille.

   CONFIDENTIALITÉ
   - Aucune donnée individuelle ne sort de ce script : ni email, ni prénom, ni référence.
     Les emails servent seulement à regrouper les contrats d'un même client, sous forme
     d'empreinte tronquée gardée en mémoire.
   - Ni le montant payé ni le nombre exact de contrats ne sont publiés : ensemble, ils
     permettraient de recalculer le chiffre d'affaires. Le fichier de sortie est public
     une fois déployé si le serveur sert donnees/ : il ne doit contenir que du publiable.
   - Toute case de moins de 20 contrats est fusionnée ou masquée (règle des petits effectifs).

   Sortie : donnees/barometre/AAAA-MM.json (pourcentages et comptages agrégés uniquement).
   Usage  : MCJ_API_TOKEN=... node scripts/barometre.mjs [--debut 2026-06-01] [--fin 2026-09-30]
   Le proxy sortant filtre l'en-tête Authorization : le jeton passe par X-Authorization. */

import { createHash } from 'node:crypto';
import { mkdirSync, writeFileSync } from 'node:fs';

const BASE = 'https://autotempo.net/api.php';
const TOKEN = process.env.MCJ_API_TOKEN;
if (!TOKEN) { console.error('MCJ_API_TOKEN absent.'); process.exit(1); }

const arg = (n, d) => { const i = process.argv.indexOf(n); return i > 0 ? process.argv[i + 1] : d; };
const DEBUT = arg('--debut', '2026-05-26');   // lancement de la marque
const FIN = arg('--fin', new Date(Date.now() - 86400000).toISOString().slice(0, 10));
const SEUIL = 20;

const cle = e => createHash('sha256').update(String(e).trim().toLowerCase()).digest('hex').slice(0, 16);
const JOUR = 86400000;

// L'API plafonne à 93 jours d'écart et 365 jours de recul : balayage par fenêtres.
const contrats = new Map();
let fenetres = 0, echecs = 0;
for (let de = -364; de <= 90; de += 90) {
  const a = Math.min(de + 89, 90);
  const r = await fetch(`${BASE}?route=echeances&de=${de}&a=${a}`, { headers: { 'X-Authorization': `Bearer ${TOKEN}` } });
  if (!r.ok) { echecs++; continue; }
  const j = await r.json();
  fenetres++;
  for (const c of j.contrats || []) contrats.set(c.ref, c);
}
if (echecs) console.error(`${echecs} fenêtre(s) en échec : les chiffres seraient incomplets, arrêt.`), process.exit(1);

// Période d'étude : contrats dont la couverture commence entre DEBUT et FIN inclus
const tous = [...contrats.values()].filter(c => c.date_debut >= DEBUT && c.date_debut <= FIN);
const N = tous.length;
if (N < 200) { console.error(`Seulement ${N} contrats sur la période : échantillon trop faible.`); process.exit(1); }

const pct = (n, d = N) => Math.round(1000 * n / d) / 10;
const med = a => { const s = [...a].sort((x, y) => x - y); return s.length ? s[s.length >> 1] : null; };

// Durées
const TRANCHES = [['1 jour', 1, 1], ['2 à 3 jours', 2, 3], ['4 à 7 jours', 4, 7], ['8 à 15 jours', 8, 15], ['16 à 30 jours', 16, 30], ['31 à 90 jours', 31, 90]];
const durees = tous.map(c => Number(c.duree_jours)).filter(x => Number.isFinite(x) && x > 0);
const parDuree = TRANCHES.map(([lib, a, b]) => {
  const n = durees.filter(x => x >= a && x <= b).length;
  return { tranche: lib, part: pct(n, durees.length) };
});
const duree = {
  mediane_jours: med(durees),
  part_1_jour: pct(durees.filter(x => x === 1).length, durees.length),
  part_7_jours_ou_moins: pct(durees.filter(x => x <= 7).length, durees.length),
  part_30_jours_ou_plus: pct(durees.filter(x => x >= 30).length, durees.length),
  tranches: parDuree,
  durees_les_plus_choisies: Object.entries(durees.reduce((m, x) => (m[x] = (m[x] || 0) + 1, m), {}))
    .sort((a, b) => b[1] - a[1]).slice(0, 5).filter(([, n]) => n >= SEUIL)
    .map(([d, n]) => ({ jours: Number(d), part: pct(n, durees.length) }))
};

// Jour de début de la couverture (0 = dimanche)
const NOMS = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
const jours = new Array(7).fill(0);
for (const c of tous) jours[new Date(c.date_debut + 'T12:00:00Z').getUTCDay()]++;
const jourDebut = {
  repartition: [1, 2, 3, 4, 5, 6, 0].map(k => ({ jour: NOMS[k], part: pct(jours[k]) })),
  part_vendredi_samedi_dimanche: pct(jours[5] + jours[6] + jours[0]),
  part_samedi_dimanche: pct(jours[6] + jours[0])
};

// Durée selon le jour de début : départs du week-end plus courts ?
const dureeWeekend = med(tous.filter(c => [5, 6, 0].includes(new Date(c.date_debut + 'T12:00:00Z').getUTCDay())).map(c => Number(c.duree_jours)));
const dureeSemaine = med(tous.filter(c => [1, 2, 3, 4].includes(new Date(c.date_debut + 'T12:00:00Z').getUTCDay())).map(c => Number(c.duree_jours)));

// Catégories de véhicules (codes du tarificateur), petites cases fusionnées
const LIB = { VP: 'Voiture', VU: 'Utilitaire', CTTE: 'Utilitaire', CAM3: 'Camion', CAM4: 'Camion', TCP: 'Bus et autocar',
  REM2: 'Remorque et caravane', REM3: 'Remorque et caravane', CC: 'Camping-car', CC1: 'Camping-car', CC2: 'Camping-car' };
const cat = {};
for (const c of tous) { const l = LIB[c.categorie] || 'Autres'; cat[l] = (cat[l] || 0) + 1; }
let autres = cat.Autres || 0; delete cat.Autres;
for (const [l, n] of Object.entries(cat)) if (n < SEUIL) { autres += n; delete cat[l]; }
const categories = Object.entries(cat).sort((a, b) => b[1] - a[1]).map(([l, n]) => ({ categorie: l, part: pct(n) }));
if (autres) categories.push({ categorie: 'Autres (quad, tracteur, voiturette...)', part: pct(autres) });
const dureeParCategorie = Object.keys(cat).map(l => {
  const d = tous.filter(c => (LIB[c.categorie] || 'Autres') === l).map(c => Number(c.duree_jours));
  return { categorie: l, mediane_jours: med(d) };
});

// Saisonnalité : indice mensuel (moyenne des mois = 100), pas de volume publié
const mois = {};
for (const c of tous) { const m = c.date_debut.slice(0, 7); mois[m] = (mois[m] || 0) + 1; }
const moyM = Object.values(mois).reduce((s, x) => s + x, 0) / Object.keys(mois).length;
const saison = Object.entries(mois).sort().map(([m, n]) => ({ mois: m, indice: Math.round(100 * n / moyM) }));

// Retour des clients : parmi les clients dont le premier contrat date de plus de 90 jours
const aujourd = new Date();
const parClient = new Map();
for (const c of contrats.values()) {
  const k = cle(c.email);
  if (!parClient.has(k)) parClient.set(k, []);
  parClient.get(k).push(c.date_debut);
}
let anciens = 0, revenus = 0; const ecarts = [];
for (const dates of parClient.values()) {
  dates.sort();
  const premier = new Date(dates[0] + 'T00:00:00Z');
  if ((aujourd - premier) / JOUR > 90) { anciens++; if (dates.length > 1) revenus++; }
  for (let i = 1; i < dates.length; i++) ecarts.push(Math.round((new Date(dates[i] + 'T00:00:00Z') - new Date(dates[i - 1] + 'T00:00:00Z')) / JOUR));
}
const retour = anciens >= 100 ? {
  part_clients_revenus: pct(revenus, anciens),
  base: 'clients dont le premier contrat date de plus de 90 jours',
  ecart_median_jours_entre_deux_contrats: med(ecarts.filter(x => x > 0))
} : null;

const sortie = {
  titre: "Baromètre de l'assurance temporaire Tempo-Assurance",
  periode: { debut: DEBUT, fin: FIN },
  echantillon: N >= 2000 ? 'des milliers de contrats' : 'plus de mille contrats',   // volume exact jamais publié
  calcule_le: new Date().toISOString().slice(0, 10),
  regles: ['aucune donnée individuelle', 'montants non publiés', `cases de moins de ${SEUIL} contrats fusionnées ou masquées`],
  duree, jour_de_debut: jourDebut,
  duree_mediane_selon_depart: { vendredi_au_dimanche: dureeWeekend, lundi_au_jeudi: dureeSemaine },
  categories, duree_mediane_par_categorie: dureeParCategorie,
  saisonnalite_indice_100: saison,
  retour_clients: retour
};

mkdirSync('donnees/barometre', { recursive: true });
const f = `donnees/barometre/${new Date().toISOString().slice(0, 7)}.json`;
writeFileSync(f, JSON.stringify(sortie, null, 2) + '\n');
console.log(`${f} écrit (${fenetres} fenêtres lues).`);
console.log(JSON.stringify(sortie, null, 2));
