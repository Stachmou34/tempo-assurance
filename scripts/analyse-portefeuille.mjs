#!/usr/bin/env node
/* Analyse agregee du portefeuille de contrats temporaires, via l'API autotempo.net.

   CONFIDENTIALITE : ce script n'affiche et n'ecrit JAMAIS d'email, de prenom ni de
   ref. Les emails ne servent qu'a regrouper les contrats d'un meme client, sous forme
   d'empreinte tronquee gardee en memoire. La sortie ne contient que des comptages.

   Le proxy sortant filtre l'en-tete Authorization : le jeton passe par X-Authorization. */

import { createHash } from 'node:crypto';

const BASE  = 'https://autotempo.net/api.php';
const TOKEN = process.env.MCJ_API_TOKEN;
if (!TOKEN) { console.error('MCJ_API_TOKEN absent.'); process.exit(1); }

const cle = e => createHash('sha256').update(String(e).trim().toLowerCase()).digest('hex').slice(0, 16);
const jour = 86400000;
const auj = new Date(); auj.setHours(0, 0, 0, 0);
const enJours = d => Math.round((new Date(d + 'T00:00:00') - auj) / jour);

// L'API plafonne a 93 jours d'ecart et 365 jours de recul : on balaie par fenetres.
const contrats = new Map();               // ref -> contrat, dedoublonne
let fenetres = 0, echecs = 0;
for (let de = -364; de <= 90; de += 90) {
  const a = Math.min(de + 89, 90);
  const r = await fetch(`${BASE}?route=echeances&de=${de}&a=${a}`, {
    headers: { 'X-Authorization': `Bearer ${TOKEN}` },
  });
  if (!r.ok) { echecs++; continue; }
  const j = await r.json();
  fenetres++;
  for (const c of j.contrats || []) contrats.set(c.ref, c);
}

const tous = [...contrats.values()];
if (!tous.length) { console.log('Aucun contrat renvoye.'); process.exit(0); }

const pc = n => `${(100 * n / tous.length).toFixed(1)} %`;
const tri = o => Object.entries(o).sort((x, y) => y[1] - x[1]);
const compte = (arr, f) => arr.reduce((m, x) => { const k = f(x); m[k] = (m[k] || 0) + 1; return m; }, {});
const somme  = a => a.reduce((s, x) => s + x, 0);
const med    = a => { const s = [...a].sort((x, y) => x - y); return s.length ? s[s.length >> 1] : 0; };

console.log(`\n=== PORTEFEUILLE : ${tous.length} contrats sur ${fenetres} fenetres` +
            `${echecs ? ` (${echecs} fenetre(s) en echec)` : ''} ===\n`);

// --- clients ---
const parClient = new Map();
for (const c of tous) {
  const k = cle(c.email);
  if (!parClient.has(k)) parClient.set(k, []);
  parClient.get(k).push(c);
}
const clients = [...parClient.values()];
const recurrents = clients.filter(l => l.length > 1);
console.log('CLIENTS');
console.log(`  clients distincts          ${clients.length}`);
console.log(`  contrats par client        ${(tous.length / clients.length).toFixed(2)} en moyenne`);
console.log(`  clients a contrat unique   ${clients.length - recurrents.length} (${(100 * (clients.length - recurrents.length) / clients.length).toFixed(1)} %)`);
console.log(`  clients recurrents         ${recurrents.length} (${(100 * recurrents.length / clients.length).toFixed(1)} %)`);
const maxi = Math.max(...clients.map(l => l.length));
console.log(`  maximum pour un client     ${maxi} contrats`);

// --- delai de retour des recurrents : c'est lui qui dicte la fenetre de relance ---
const delais = [];
for (const l of recurrents) {
  const d = l.map(c => new Date(c.date_debut + 'T00:00:00')).sort((a, b) => a - b);
  for (let i = 1; i < d.length; i++) delais.push(Math.round((d[i] - d[i - 1]) / jour));
}
if (delais.length) {
  console.log('\nRETOUR DES CLIENTS RECURRENTS');
  console.log(`  intervalles observes       ${delais.length}`);
  console.log(`  mediane                    ${med(delais)} jours`);
  console.log(`  moyenne                    ${Math.round(somme(delais) / delais.length)} jours`);
  const tranches = { '0-7 j': 0, '8-30 j': 0, '31-90 j': 0, '91-180 j': 0, '> 180 j': 0 };
  for (const x of delais) {
    if (x <= 7) tranches['0-7 j']++; else if (x <= 30) tranches['8-30 j']++;
    else if (x <= 90) tranches['31-90 j']++; else if (x <= 180) tranches['91-180 j']++;
    else tranches['> 180 j']++;
  }
  for (const [k, v] of Object.entries(tranches))
    console.log(`    ${k.padEnd(10)} ${String(v).padStart(4)}  ${(100 * v / delais.length).toFixed(1)} %`);
}

// --- duree ---
console.log('\nDUREE DES CONTRATS');
const trD = { '1 j': 0, '2-3 j': 0, '4-7 j': 0, '8-15 j': 0, '16-30 j': 0, '31-90 j': 0 };
for (const c of tous) {
  const d = c.duree_jours;
  if (d <= 1) trD['1 j']++; else if (d <= 3) trD['2-3 j']++; else if (d <= 7) trD['4-7 j']++;
  else if (d <= 15) trD['8-15 j']++; else if (d <= 30) trD['16-30 j']++; else trD['31-90 j']++;
}
for (const [k, v] of Object.entries(trD))
  console.log(`  ${k.padEnd(8)} ${String(v).padStart(4)}  ${pc(v)}`);
console.log(`  duree mediane ${med(tous.map(c => c.duree_jours))} jours`);

// --- categories ---
console.log('\nCATEGORIES DE VEHICULE');
for (const [k, v] of tri(compte(tous, c => c.categorie)))
  console.log(`  ${String(k).padEnd(8)} ${String(v).padStart(4)}  ${pc(v)}`);

// --- panier ---
const montants = tous.map(c => c.montant).filter(m => m != null);
if (montants.length) {
  console.log('\nPANIER');
  console.log(`  contrats avec montant      ${montants.length} / ${tous.length}`);
  console.log(`  panier moyen               ${(somme(montants) / montants.length).toFixed(2)} EUR`);
  console.log(`  panier median              ${med(montants).toFixed(2)} EUR`);
  console.log(`  total sur la periode       ${somme(montants).toFixed(2)} EUR`);
  console.log('\n  PANIER MOYEN PAR CATEGORIE');
  const parCat = {};
  for (const c of tous) if (c.montant != null) (parCat[c.categorie] ||= []).push(c.montant);
  for (const [k, v] of Object.entries(parCat).sort((a, b) => b[1].length - a[1].length))
    console.log(`    ${String(k).padEnd(8)} ${String(v.length).padStart(4)} contrats  ${(somme(v) / v.length).toFixed(2)} EUR`);
}

// --- ce que la relance peut viser ---
console.log('\nGISEMENT DE RELANCE (contrats a venir, non encore relances)');
for (const [lib, min, max] of [['echeance passee', -365, -1], ['aujourd\'hui', 0, 0],
                               ['dans 1-3 j', 1, 3], ['dans 4-7 j', 4, 7],
                               ['dans 8-30 j', 8, 30], ['dans 31-90 j', 31, 90]]) {
  const l = tous.filter(c => { const j = enJours(c.date_fin); return j >= min && j <= max; });
  const u = new Set(l.map(c => cle(c.email))).size;
  console.log(`  ${lib.padEnd(16)} ${String(l.length).padStart(4)} contrats  ${String(u).padStart(4)} clients distincts`);
}

// --- doublons d'envoi evites par le regroupement ---
const aVenir = tous.filter(c => { const j = enJours(c.date_fin); return j >= 0 && j <= 7; });
const uniques = new Set(aVenir.map(c => cle(c.email))).size;
console.log(`\n  Sur la fenetre 0-7 j : ${aVenir.length} contrats pour ${uniques} clients.`);
console.log(`  Sans regroupement par email, ${aVenir.length - uniques} message(s) en trop.`);
console.log();

// =====================================================================
// SEGMENTATION : les moyennes cachent deux populations tres differentes
// =====================================================================
const CA = l => somme(l.map(c => c.montant || 0));
const uniques1 = clients.filter(l => l.length === 1);
const rec2a4   = clients.filter(l => l.length >= 2 && l.length <= 4);
const rec5plus = clients.filter(l => l.length >= 5);
const caTotal  = CA(tous);

console.log('\n\n=== SEGMENTATION ===\n');
console.log('POIDS ECONOMIQUE');
console.log('  segment            clients  contrats       CA EUR   part CA   panier');
for (const [lib, seg] of [['1 contrat', uniques1], ['2 a 4 contrats', rec2a4], ['5 contrats et +', rec5plus]]) {
  const ct = seg.flat(), ca = CA(ct);
  console.log(`  ${lib.padEnd(17)} ${String(seg.length).padStart(6)} ${String(ct.length).padStart(9)} ` +
              `${ca.toFixed(0).padStart(11)} ${(100 * ca / caTotal).toFixed(1).padStart(8)} % ` +
              `${(ca / ct.length).toFixed(0).padStart(7)}`);
}

const part = (ct, f) => {
  const n = compte(ct, f), t = ct.length;
  return tri(n).slice(0, 5).map(([k, v]) => `${k} ${(100 * v / t).toFixed(0)}%`).join('  ');
};
console.log('\nPROFIL PAR SEGMENT');
for (const [lib, seg] of [['1 contrat', uniques1], ['2 a 4 contrats', rec2a4], ['5 contrats et +', rec5plus]]) {
  const ct = seg.flat();
  console.log(`  ${lib}`);
  console.log(`    vehicules : ${part(ct, c => c.categorie)}`);
  console.log(`    duree med : ${med(ct.map(c => c.duree_jours))} j   ` +
              `contrats d'1 jour : ${(100 * ct.filter(c => c.duree_jours <= 1).length / ct.length).toFixed(0)} %`);
}

// --- qui est concerne par la relance a 1-7 jours ---
console.log('\nQUI EST DANS LA FENETRE 1-7 JOURS');
const fen = tous.filter(c => { const j = enJours(c.date_fin); return j >= 1 && j <= 7; });
const dejaRec = fen.filter(c => parClient.get(cle(c.email)).length > 1);
console.log(`  ${fen.length} contrats`);
console.log(`    clients deja recurrents  ${dejaRec.length} (${(100 * dejaRec.length / fen.length).toFixed(0)} %) : ils reviennent souvent seuls`);
console.log(`    clients a contrat unique ${fen.length - dejaRec.length} (${(100 * (fen.length - dejaRec.length) / fen.length).toFixed(0)} %) : jamais revenus a ce jour`);

// --- dormants : dernier contrat termine, rien de prevu ---
console.log('\nBASE DORMANTE (dernier contrat termine, aucun contrat a venir)');
let dorm = 0, dormCA = 0;
const tranchesD = { '31-60 j': 0, '61-120 j': 0, '121-240 j': 0, '> 240 j': 0 };
for (const l of clients) {
  const fins = l.map(c => enJours(c.date_fin));
  const derniere = Math.max(...fins);
  if (derniere >= 0) continue;                 // a encore un contrat en cours ou a venir
  const depuis = -derniere;
  if (depuis < 31) continue;
  dorm++; dormCA += CA(l);
  if (depuis <= 60) tranchesD['31-60 j']++; else if (depuis <= 120) tranchesD['61-120 j']++;
  else if (depuis <= 240) tranchesD['121-240 j']++; else tranchesD['> 240 j']++;
}
console.log(`  ${dorm} clients dormants, ${dormCA.toFixed(0)} EUR deja depenses chez nous`);
for (const [k, v] of Object.entries(tranchesD)) console.log(`    inactifs depuis ${k.padEnd(10)} ${String(v).padStart(4)}`);
console.log();
