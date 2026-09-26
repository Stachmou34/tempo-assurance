#!/usr/bin/env node
/* Surveillance quotidienne de tempo-assurance.com.
 *
 *   node scripts/surveillance.mjs
 *
 * Silencieux quand tout va bien : n'affiche que l'essentiel.
 * Sortie en code 1 s'il y a au moins une ALERTE.
 *
 * Trois controles :
 *   1. Disponibilite et temps de reponse des pages cles
 *   2. Ecart entre le depot (origin/main) et ce qui est reellement en ligne
 *   3. Expiration du certificat SSL
 */
import { createHash } from 'crypto';
import { connect } from 'tls';
import { existsSync } from 'node:fs';
import { execSync } from 'child_process';

const SITE = 'https://www.tempo-assurance.com';
const HOTE = 'www.tempo-assurance.com';

/* Pages surveillees : l'accueil et les pages qui convertissent le mieux. */
const PAGES = [
  '', 'devis-ou-souscription.html', 'tarif-assurance-temporaire.html',
  'assurance-temporaire-auto.html', 'assurance-temporaire-camping-car.html',
  'sitemap.xml', 'robots.txt',
];
/* Seuils : au-dela, on alerte. */
const SEUIL_LENT = 2.0;        // secondes
const SEUIL_SSL  = 15;         // jours restants

const alertes = [], infos = [];
const md5 = s => createHash('md5').update(s).digest('hex').slice(0, 12);

/* ---------- 1. Disponibilite ---------- */
let pire = 0;
for (const p of PAGES) {
  const t0 = Date.now();
  let code = 0, corps = '';
  try {
    const r = await fetch(`${SITE}/${p}`, { redirect: 'follow' });
    code = r.status;
    corps = await r.text();
  } catch (e) {
    alertes.push(`/${p} injoignable : ${e.message}`);
    continue;
  }
  const s = (Date.now() - t0) / 1000;
  pire = Math.max(pire, s);
  if (code !== 200) alertes.push(`/${p} repond HTTP ${code}`);
  if (s > SEUIL_LENT) alertes.push(`/${p} lente : ${s.toFixed(2)} s`);
  if (code === 200 && p.endsWith('.html') && corps.length < 2000)
    alertes.push(`/${p} suspecte : seulement ${corps.length} octets`);
}
infos.push(`Disponibilite : ${PAGES.length} URLs verifiees, plus lente ${pire.toFixed(2)} s`);

/* ---------- 2. Ecart depot / production ---------- */
/* Un ecart signifie presque toujours un « git pull » oublie sur le serveur. */
try {
  execSync('git fetch origin main -q', { stdio: 'ignore' });
  /* Trois pages fixes ne suffisent pas : le 26/09, tout le travail du jour portait sur
     carte-grise-barree.html et le controle annoncait « production conforme ». On verifie
     donc les pages de conversion ET celles reellement modifiees recemment, qui sont
     justement celles dont le deploiement peut manquer. */
  const socle = ['index.html', 'devis-ou-souscription.html', 'tarif-assurance-temporaire.html'];
  const recentes = execSync('git log --name-only --pretty=format: origin/main --since="14 days ago"')
    .toString().split('\n').map(s => s.trim())
    .filter(f => f.endsWith('.html') && existsSync(f));
  const aVerifier = [...new Set([...socle, ...recentes])].slice(0, 25);
  const ecarts = [];
  for (const f of aVerifier) {
    const depot = md5(execSync(`git show origin/main:${f}`, { maxBuffer: 5e7 }).toString());
    const prod = md5(await (await fetch(`${SITE}/${f}`)).text());
    if (depot !== prod) ecarts.push(f);
  }
  if (ecarts.length) {
    const n = execSync('git log --oneline origin/main --since="14 days ago" | wc -l').toString().trim();
    alertes.push(
      `DEPLOIEMENT EN RETARD : ${ecarts.length}/${aVerifier.length} page(s) en ligne different de main ` +
      `(${ecarts.join(', ')}). Un « git pull » sur le serveur est probablement en attente. ` +
      `${n} commit(s) sur main ces 14 derniers jours.`
    );
  } else {
    infos.push(`Deploiement : la production correspond a main (${aVerifier.length} page(s) verifiee(s))`);
  }
} catch (e) {
  infos.push(`Deploiement : controle impossible (${e.message.split('\n')[0]})`);
}

/* ---------- 3. Certificat SSL ---------- */
await new Promise(res => {
  const sock = connect({ host: HOTE, port: 443, servername: HOTE }, () => {
    const c = sock.getPeerCertificate();
    if (!c || !c.valid_to) { infos.push('SSL : certificat illisible'); sock.end(); return res(); }
    const jours = Math.floor((new Date(c.valid_to) - Date.now()) / 86400000);
    const d = new Date(c.valid_to).toISOString().slice(0, 10);
    if (jours <= SEUIL_SSL) alertes.push(`CERTIFICAT SSL : expire dans ${jours} jour(s), le ${d}`);
    else infos.push(`SSL : valide encore ${jours} jours (jusqu'au ${d})`);
    sock.end(); res();
  });
  sock.on('error', e => { infos.push(`SSL : verification impossible (${e.message})`); res(); });
  sock.setTimeout(8000, () => { infos.push('SSL : delai depasse'); sock.destroy(); res(); });
});

/* ---------- Rapport ---------- */
infos.forEach(i => console.log('  ' + i));
if (alertes.length) {
  console.log(`\nALERTES (${alertes.length}) :`);
  alertes.forEach(a => console.log('  - ' + a));
  process.exit(1);
}
console.log('\nAucune alerte.');
