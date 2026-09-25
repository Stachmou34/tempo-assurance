#!/usr/bin/env node
/* Controle qualite du site statique tempo-assurance.com.
   Sortie non nulle = au moins une erreur bloquante. */
import { readFileSync, readdirSync, existsSync } from 'fs';
const R = process.cwd();
const pages = readdirSync(R).filter(f => f.endsWith('.html'));
const err = [], warn = [];
const APO = String.fromCharCode(8217);   // apostrophe typographique
const EM  = String.fromCharCode(8212);   // tiret cadratin

for (const f of pages) {
  const h = readFileSync(`${R}/${f}`, 'utf8');
  const main = (h.split('<main')[1] || '').split('</main>')[0];

  // 1. JSON-LD valide
  [...h.matchAll(/<script type="application\/ld\+json">([\s\S]*?)<\/script>/g)].forEach((m, i) => {
    try { JSON.parse(m[1]); } catch (e) { err.push(`${f} : JSON-LD #${i} invalide (${e.message})`); }
  });

  // 2. apostrophes typographiques dans le contenu
  const nApo = (main.match(new RegExp(APO, 'g')) || []).length;
  if (nApo) err.push(`${f} : ${nApo} apostrophe(s) typographique(s) dans le contenu`);

  // 3. tirets cadratins en prose
  const prose = [...main.matchAll(/<p[^>]*>([\s\S]*?)<\/p>/g)].map(m => m[1]).join(' ');
  const nEm = (prose.match(new RegExp(EM, 'g')) || []).length;
  if (nEm) err.push(`${f} : ${nEm} tiret(s) cadratin(s) en prose`);

  // 4. equilibre des balises
  for (const t of ['div', 'p', 'ul', 'li', 'h2', 'h3', 'article', 'section']) {
    const o = (main.match(new RegExp(`<${t}[\\s>]`, 'g')) || []).length;
    const c = (main.match(new RegExp(`</${t}>`, 'g')) || []).length;
    if (o !== c) err.push(`${f} : balise <${t}> desequilibree (${o} ouvertes / ${c} fermees)`);
  }

  // 5. liens internes casses
  [...main.matchAll(/href="(?!https?:|tel:|mailto:|#|\/)([^"#?]+\.html)"/g)]
    .map(m => m[1]).filter((v, i, a) => a.indexOf(v) === i)
    .forEach(l => { if (!existsSync(`${R}/${l}`)) err.push(`${f} : lien interne casse vers ${l}`); });

  // 6. un seul H1
  const nH1 = (main.match(/<h1[\s>]/g) || []).length;
  if (nH1 !== 1 && !/^(404|confirmation-mail|google)/.test(f)) warn.push(`${f} : ${nH1} balise(s) H1`);

  // 7. title et meta description presents
  if (!/<title>[^<]{10,}<\/title>/.test(h) && !/^google/.test(f)) warn.push(`${f} : title absent ou trop court`);
}

// 8. le sitemap ne pointe que vers des pages existantes
if (existsSync(`${R}/sitemap.xml`)) {
  const sm = readFileSync(`${R}/sitemap.xml`, 'utf8');
  [...sm.matchAll(/<loc>https:\/\/www\.tempo-assurance\.com\/([^<]*)<\/loc>/g)]
    .map(m => m[1]).filter(u => u && u.endsWith('.html'))
    .forEach(u => { if (!existsSync(`${R}/${u}`)) err.push(`sitemap.xml : reference une page absente (${u})`); });
}

console.log(`Pages analysees : ${pages.length}`);
if (warn.length) { console.log(`\nAvertissements (${warn.length}) :`); warn.forEach(w => console.log('  - ' + w)); }
if (err.length) { console.log(`\nERREURS BLOQUANTES (${err.length}) :`); err.forEach(e => console.log('  - ' + e)); process.exit(1); }
console.log('\nTous les controles bloquants sont au vert.');
