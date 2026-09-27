#!/usr/bin/env node
/* Veille : collecte des sources institutionnelles par RSS.

   POURQUOI CES SOURCES ET PAS X : l'actualite de l'assurance auto francaise sort des
   institutions qui la produisent, pas de leur echo sur les reseaux. L'API X est passee
   en pay-per-use en 2026 (0,005 $ par post lu, plus de palier gratuit) et n'apporterait
   qu'une avance de quelques heures sur une veille hebdomadaire. Elle reste le seul
   moyen de voir ce qu'on dit de la marque, ce qui est un autre besoin.

   Sources retenues apres test : sur quatorze candidates, la plupart des sites de presse
   et Legifrance renvoient 403 aux robots, et plusieurs flux annonces n'existent plus.
   Trois repondent reellement. Ne pas en rajouter sans avoir verifie qu'elles renvoient
   des entrees, un HTTP 200 ne suffit pas : economie.gouv.fr/rss renvoie 200 sur une page
   qui LISTE des flux, sans en etre un.

   Usage :
     node scripts/veille-sources.mjs            nouveautes depuis le dernier passage
     node scripts/veille-sources.mjs --tout     tout ce que les flux contiennent
     node scripts/veille-sources.mjs --jours 14 fenetre de publication, defaut 10
*/

import { readFileSync, writeFileSync, mkdirSync, existsSync } from 'node:fs';

const SOURCES = [
  ['Securite routiere', 'https://www.securite-routiere.gouv.fr/rss.xml'],
  ['Bercy', 'https://www.economie.gouv.fr/rss/toutesactualites'],
  ['France Assureurs', 'https://www.franceassureurs.fr/feed/'],
];

const ETAT = 'donnees/veille/vus.json';
const tout = process.argv.includes('--tout');
const iJours = process.argv.indexOf('--jours');
const JOURS = iJours > -1 ? Number(process.argv[iJours + 1]) || 10 : 10;

/* Deux axes, pas une liste de mots-cles.

   Une premiere version donnait 4 points a tout titre contenant « assurance » : le
   photovoltaique, le ramonage et l'assurance-vie de Bercy arrivaient en tete d'une
   veille auto. Le mot « assurance » seul ne dit rien, il faut la CONJONCTION des deux
   axes, ou un terme intrinsequement automobile. */
const AUTO = ['automobile', 'vehicule', 'voiture', 'conducteur', 'carburant', 'radar',
  'permis de conduire', 'carte grise', 'immatriculation', 'controle technique',
  'code de la route', 'securite routiere', 'circulation', 'peage', 'autoroute',
  'stationnement', 'deux-roues', 'moto', 'poids lourd', 'utilitaire'];

/* Termes qui suffisent seuls : ils n'existent que dans le domaine automobile. */
const AUTO_FORT = ['carte grise', 'immatriculation', 'permis de conduire', 'radar',
  'controle technique', 'code de la route', 'securite routiere', 'carburant'];

const ASSUR = ['assurance', 'assureur', 'malus', 'bonus', 'sinistre', 'resilie',
  'indemnis', 'prime d', 'franchise', 'fichier des vehicules assures', 'fva'];

/* Sujets d'assurance qui ne sont pas les notres. Sans cette liste, France Assureurs
   et Bercy remontent surtout de l'habitation, de la sante et de l'epargne. */
const EXCLU = ['assurance-vie', 'assurance vie', 'habitation', 'photovoltaique',
  'ramonage', 'emprunteur', 'obseques', 'sante', 'mutuelle', 'retraite', 'epargne',
  'feux de foret', 'inondation', 'secheresse', 'agricole', 'cheque energie'];

const sansAccent = s => s.normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase();
const texte = s => String(s || '').replace(/<!\[CDATA\[|\]\]>/g, '')
  .replace(/<[^>]+>/g, ' ').replace(/&#?\w+;/g, ' ').replace(/\s+/g, ' ').trim();

const score = t => {
  const n = sansAccent(t);
  const a = m => n.includes(sansAccent(m));
  const auto = AUTO.some(a), autoFort = AUTO_FORT.some(a), assur = ASSUR.some(a);
  // L'exclusion ne s'applique qu'a defaut de signal automobile fort : un article sur
  // le malus d'un vehicule electrique parle d'energie sans cesser de nous concerner.
  if (EXCLU.some(a) && !autoFort) return 0;
  if (auto && assur) return 4;      // le coeur du sujet
  if (autoFort) return 3;           // automobile sans assurance, mais directement utile
  if (auto) return 2;               // contexte automobile
  return 0;                         // « assurance » seul ne veut rien dire ici
};

/* Parseur volontairement minimal : trois flux connus, pas de dependance a installer.
   Gere RSS (<item>) comme Atom (<entry>). */
function parser(xml, source) {
  const blocs = [...xml.matchAll(/<(item|entry)[\s>][\s\S]*?<\/\1>/g)].map(m => m[0]);
  return blocs.map(b => {
    const champ = re => (b.match(re) || [])[1];
    const lien = champ(/<link[^>]*href="([^"]+)"/) || champ(/<link[^>]*>([\s\S]*?)<\/link>/) || '';
    const date = champ(/<pubDate[^>]*>([\s\S]*?)<\/pubDate>/) ||
                 champ(/<updated[^>]*>([\s\S]*?)<\/updated>/) ||
                 champ(/<published[^>]*>([\s\S]*?)<\/published>/) || '';
    const titre = texte(champ(/<title[^>]*>([\s\S]*?)<\/title>/));
    const resume = texte(champ(/<description[^>]*>([\s\S]*?)<\/description>/) ||
                         champ(/<summary[^>]*>([\s\S]*?)<\/summary>/) || '');
    const d = date ? new Date(date) : null;
    return { source, titre, lien: texte(lien), resume: resume.slice(0, 220),
             date: d && !isNaN(d) ? d : null, score: score(`${titre} ${resume}`) };
  }).filter(x => x.titre && x.lien);
}

async function charger([nom, url]) {
  try {
    const c = new AbortController();
    const t = setTimeout(() => c.abort(), 15000);
    const r = await fetch(url, { signal: c.signal, headers: { 'User-Agent': 'Mozilla/5.0 (veille tempo-assurance)' } });
    clearTimeout(t);
    if (!r.ok) return { nom, erreur: `HTTP ${r.status}`, items: [] };
    const items = parser(await r.text(), nom);
    return { nom, items, erreur: items.length ? null : 'flux vide ou illisible' };
  } catch (e) {
    return { nom, erreur: String(e.message).slice(0, 60), items: [] };
  }
}

const res = await Promise.all(SOURCES.map(charger));

console.log('\n=== VEILLE : SOURCES INSTITUTIONNELLES ===\n');
for (const r of res)
  console.log(`  ${r.erreur ? 'ECHEC' : 'OK   '} ${r.nom.padEnd(20)} ${r.erreur || `${r.items.length} entrees`}`);

const vus = existsSync(ETAT) ? new Set(JSON.parse(readFileSync(ETAT, 'utf8'))) : new Set();
const limite = Date.now() - JOURS * 86400000;

let items = res.flatMap(r => r.items)
  .filter(x => !x.date || +x.date >= limite)
  .filter(x => x.score > 0);
const nouveaux = items.filter(x => !vus.has(x.lien));
const aMontrer = (tout ? items : nouveaux).sort((a, b) => b.score - a.score || (b.date || 0) - (a.date || 0));

console.log(`\n  ${items.length} entree(s) pertinente(s) sur ${JOURS} jours, dont ${nouveaux.length} jamais vue(s).`);
if (!aMontrer.length) {
  console.log('\n  Rien de neuf. Pour revoir le fonds, relancer avec --tout.\n');
} else {
  console.log(`\n=== ${tout ? 'TOUT LE FONDS' : 'NOUVEAUTES'} ===\n`);
  for (const x of aMontrer.slice(0, 25)) {
    const d = x.date ? x.date.toISOString().slice(0, 10) : '          ';
    const p = x.score >= 4 ? '***' : x.score === 3 ? '** ' : '*  ';
    console.log(`  ${p} ${d}  [${x.source}]`);
    console.log(`      ${x.titre}`);
    if (x.resume) console.log(`      ${x.resume.slice(0, 150)}`);
    console.log(`      ${x.lien}\n`);
  }
  console.log('  *** touche directement l\'assurance, ** l\'automobile, * le contexte.');
}

/* On memorise meme en mode --tout : le but est de ne pas resservir deux fois le meme
   sujet dans deux editions de la veille. */
mkdirSync('donnees/veille', { recursive: true });
writeFileSync(ETAT, JSON.stringify([...new Set([...vus, ...items.map(x => x.lien)])].slice(-600)));

console.log('\n  Une entree deja vue ne ressort plus : c\'est ce qui evite de publier');
console.log('  deux fois le meme sujet a deux semaines d\'intervalle.\n');
