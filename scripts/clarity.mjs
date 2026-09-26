#!/usr/bin/env node
/* Releve quotidien Microsoft Clarity.

   POURQUOI UN INSTANTANE QUOTIDIEN : l'API ne donne que les 1 a 3 derniers jours et
   plafonne a 10 requetes par jour. Clarity ne conserve aucun historique exploitable.
   On enregistre donc la reponse brute dans donnees/clarity/, un fichier par jour :
   c'est le seul historique dont on disposera. Une journee non relevee est perdue.

   Le jeton se lit dans CLARITY_API_TOKEN, jamais ecrit dans le depot.
   Budget : 2 requetes sur les 10 quotidiennes.

   Usage :
     node scripts/clarity.mjs           releve du jour, enregistre et resume
     node scripts/clarity.mjs --relire  resume le dernier instantane sans appeler l'API
     node scripts/clarity.mjs --brut    structure brute (mise au point)
*/

import { readFileSync, writeFileSync, mkdirSync, readdirSync, existsSync } from 'node:fs';

const BASE = 'https://www.clarity.ms/export-data/api/v1/project-live-insights';
const DOSSIER = 'donnees/clarity';
const TOKEN = process.env.CLARITY_API_TOKEN || '';
const brut = process.argv.includes('--brut');
const relire = process.argv.includes('--relire');

const auj = () => new Date().toISOString().slice(0, 10);
const nb = v => { const n = Number(v); return Number.isFinite(n) ? n : 0; };
const somme = (l, f) => l.reduce((s, x) => s + nb(f(x)), 0);

/* Les deux appels renvoient LES MEMES metricName, seule la cle de dimension change
   (Url ou Browser). Les indexer ensemble ferait perdre le premier jeu : on les garde
   separes. C'est le bug qui vidait le tableau des pages a friction. */
const indexer = reponse => {
  const par = {};
  for (const b of Array.isArray(reponse) ? reponse : []) (par[b.metricName] ||= []).push(...(b.information || []));
  return par;
};

const FRICTIONS = [
  ['RageClickCount', 'Rage clicks', 4],
  ['ScriptErrorCount', 'Erreurs JS', 3],
  ['ErrorClickCount', 'Clics en erreur', 2],
  ['DeadClickCount', 'Dead clicks', 1],
  ['QuickbackClick', 'Quickbacks', 1],
  ['ExcessiveScroll', 'Excessive scroll', 1],
];

async function appel(dimension) {
  // Le proxy sortant supprime Authorization sur certains hotes (constate le 26/09 sur
  // autotempo.net). On envoie les deux en-tetes.
  const r = await fetch(`${BASE}?numOfDays=1&dimension1=${dimension}`, {
    headers: {
      'Authorization': `Bearer ${TOKEN}`,
      'X-Authorization': `Bearer ${TOKEN}`,
      'Content-Type': 'application/json',
    },
  });
  const txt = await r.text();
  if (!r.ok) {
    const aide = {
      401: "jeton absent, invalide ou expire, OU en-tete Authorization filtre par le proxy",
      403: 'jeton non autorise pour cette operation',
      400: 'parametres invalides',
      429: 'quota de 10 requetes par jour depasse',
    }[r.status] || '';
    throw new Error(`HTTP ${r.status}${aide ? ` : ${aide}` : ''}\n${txt.slice(0, 300)}`);
  }
  try { return JSON.parse(txt); } catch { throw new Error(`reponse non JSON :\n${txt.slice(0, 300)}`); }
}

/* % de sessions touchees : moyenne PONDEREE de sessionsWithMetricPercentage par le
   nombre de sessions de chaque ligne. Diviser le nombre de clics par le nombre de
   sessions donnerait tout autre chose : un visiteur peut cliquer dix fois.

   Le denominateur est le total du trafic, PAS la somme des sessionsCount des lignes
   retenues. Les deux sont egaux sur la reponse complete (verifie : 415 = 415), mais
   l'instantane enregistre ne garde que les lignes non nulles. Prendre la somme des
   lignes restantes gonflerait le pourcentage a la relecture. */
function friction(lignes, sessionsTotal) {
  const touchees = somme(lignes, l => nb(l.sessionsCount) * nb(l.sessionsWithMetricPercentage) / 100);
  return { clics: somme(lignes, l => l.subTotal), touchees,
           pct: sessionsTotal ? 100 * touchees / sessionsTotal : 0 };
}

function resume(snap, etiquette) {
  const url = indexer(snap.url), nav = indexer(snap.browser);

  // Totaux du site : pris sur la vue par navigateur, dont les lignes sont propres.
  // La vue par URL contient une ligne Url:null qui fausserait les sommes.
  const traf = nav['Traffic'] || [];
  const sessions = somme(traf, l => l.totalSessionCount);
  const bots = somme(traf, l => l.totalBotSessionCount);
  const users = somme(traf, l => l.distinctUserCount);

  console.log(`\n=== CLARITY, dernieres 24 h (${etiquette}) ===\n`);
  if (!sessions) {
    console.log('  Aucune session. Metriques recues : ' + Object.keys(nav).join(', '));
    return { sessions: 0 };
  }

  const pps = traf.length
    ? somme(traf, l => nb(l.pagesPerSessionPercentage) * nb(l.totalSessionCount)) / sessions : 0;

  // Scroll pondere par les sessions de chaque navigateur, pas une moyenne de moyennes.
  const poids = Object.fromEntries(traf.map(l => [l.Browser, nb(l.totalSessionCount)]));
  const sd = nav['ScrollDepth'] || [];
  const pSd = somme(sd, l => poids[l.Browser] || 0);
  const scroll = pSd ? somme(sd, l => nb(l.averageScrollDepth) * (poids[l.Browser] || 0)) / pSd : null;

  const tTotal = somme(nav['EngagementTime'] || [], l => l.totalTime);
  const tActif = somme(nav['EngagementTime'] || [], l => l.activeTime);

  const L = (k, v) => console.log(`  ${k.padEnd(28)} ${v}`);
  L('Sessions', `${sessions}${bots ? ` (dont ${bots} de bots)` : ''}`);
  L('Utilisateurs distincts', users || '—');
  L('Pages par session', pps ? `~${pps.toFixed(2)}` : '—');
  L('Scroll moyen', scroll !== null ? `${scroll.toFixed(1)} %` : '—');
  L('Temps d\'engagement', tTotal ? `${tTotal} s au total, dont ${tActif} s actifs` : '—');

  const mesures = {};
  for (const [cle, lib] of FRICTIONS) {
    const f = friction(nav[cle] || [], sessions);
    mesures[cle] = f;
    L(lib, f.clics || f.pct ? `${f.pct.toFixed(1)} % des sessions (${f.clics})` : '0');
  }

  // Par page : la seule vue sur laquelle on peut agir directement.
  const parPage = {};
  for (const [cle, , poidsF] of FRICTIONS) {
    for (const l of url[cle] || []) {
      if (!l.Url) continue;
      const p = (parPage[l.Url] ||= { score: 0, sessions: nb(l.sessionsCount) });
      p[cle] = nb(l.subTotal);
      p.score += nb(l.subTotal) * poidsF;
    }
  }
  const chaudes = Object.entries(parPage).filter(([, v]) => v.score > 0)
    .sort((a, b) => b[1].score - a[1].score).slice(0, 8);
  if (chaudes.length) {
    console.log('\n  PAGES A FRICTION (rage et erreurs JS ponderes plus fort)');
    console.log(`    ${'page'.padEnd(42)} ${'sess'.padStart(5)} ${'rage'.padStart(5)} ${'JS'.padStart(4)} ${'dead'.padStart(5)} ${'qback'.padStart(6)}`);
    for (const [u, v] of chaudes) {
      const c = String(u).replace(/^https?:\/\/(www\.)?tempo-assurance\.com/, '') || '/';
      console.log(`    ${c.slice(0, 42).padEnd(42)} ${String(v.sessions).padStart(5)} ` +
        `${String(v.RageClickCount || 0).padStart(5)} ${String(v.ScriptErrorCount || 0).padStart(4)} ` +
        `${String(v.DeadClickCount || 0).padStart(5)} ${String(v.QuickbackClick || 0).padStart(6)}`);
    }
  }

  const navs = traf.map(l => [l.Browser, nb(l.totalSessionCount)])
    .filter(x => x[0] && x[1]).sort((a, b) => b[1] - a[1]).slice(0, 5);
  if (navs.length) console.log(`\n  Navigateurs : ${navs.map(([n, v]) => `${n} (${v})`).join(', ')}`);

  return { sessions, bots, users, scroll,
           dead: mesures.DeadClickCount.pct, rage: mesures.RageClickCount.pct,
           js: mesures.ScriptErrorCount.pct };
}

const muet = f => { const l = console.log; console.log = () => {}; try { return f(); } finally { console.log = l; } };

function comparer(actuel) {
  if (!existsSync(DOSSIER)) return;
  const veille = readdirSync(DOSSIER).filter(f => f.endsWith('.json') && f < `${auj()}.json`).sort().pop();
  if (!veille) { console.log('\n  (premier releve : aucune comparaison possible)'); return; }
  const avant = muet(() => resume(JSON.parse(readFileSync(`${DOSSIER}/${veille}`, 'utf8')), ''));
  console.log(`\n  ECART AVEC ${veille.replace('.json', '')}`);
  for (const [lib, k, unite] of [['sessions', 'sessions', ''], ['scroll moyen', 'scroll', ' %'],
                                 ['dead clicks', 'dead', ' %'], ['rage clicks', 'rage', ' %'],
                                 ['erreurs JS', 'js', ' %']]) {
    const a = nb(avant[k]), b = nb(actuel[k]), d = b - a;
    const f = x => unite ? x.toFixed(1) : String(Math.round(x));
    console.log(`    ${lib.padEnd(14)} ${f(a).padStart(7)}${unite} -> ${f(b).padStart(7)}${unite}  ${Math.abs(d) < 0.05 ? '=' : (d > 0 ? '+' : '') + f(d)}`);
  }
}

// ---------------------------------------------------------------- execution

if (relire) {
  const l = existsSync(DOSSIER) ? readdirSync(DOSSIER).filter(f => f.endsWith('.json')).sort() : [];
  if (!l.length) { console.error(`Aucun instantane dans ${DOSSIER}`); process.exit(1); }
  const d = l[l.length - 1];
  resume(JSON.parse(readFileSync(`${DOSSIER}/${d}`, 'utf8')), d.replace('.json', ''));
  process.exit(0);
}

if (!TOKEN) {
  console.error('CLARITY_API_TOKEN absent.');
  console.error('Jeton a generer dans Clarity : Parametres > Data Export > Generer un jeton,');
  console.error('puis a deposer dans les variables d\'environnement. Jamais dans le depot.');
  console.error('Une session demarree avant l\'ajout de la variable ne la verra pas.');
  process.exit(1);
}

/* Le quota est de 10 requetes par PROJET et par JOUR, pas par session : deux sessions
   qui relancent le script le meme jour le vident a quatre. Si l'instantane du jour
   existe deja, on le relit au lieu de rappeler l'API. --force passe outre.
   Lecon du 26/09 : le quota a ete epuise en re-testant, et l'instantane du jour venait
   d'etre supprime. Les donnees de la journee ont ete perdues, definitivement. */
const cheminJour = `${DOSSIER}/${auj()}.json`;
if (existsSync(cheminJour) && !process.argv.includes('--force')) {
  console.log(`  Instantane du jour deja pris, aucun appel a l'API (quota : 10 par jour).`);
  console.log(`  Pour forcer un nouveau relevé : --force`);
  resume(JSON.parse(readFileSync(cheminJour, 'utf8')), auj());
  process.exit(0);
}

let snap;
try {
  snap = { date: auj(), url: await appel('URL'), browser: await appel('Browser') };
} catch (e) {
  console.error(`\nReleve Clarity impossible : ${e.message}\n`);
  if (String(e.message).includes('429')) {
    console.error('  Le quota de 10 requetes quotidiennes est epuise pour tout le projet.');
    console.error('  Il se reinitialise le lendemain. Demain, relancer avec numOfDays=2 ou 3');
    console.error('  permettrait de recuperer la journee manquante.');
  }
  process.exit(1);
}

if (brut) {
  for (const [vue, rep] of [['URL', snap.url], ['Browser', snap.browser]])
    for (const b of rep) console.log(`${vue.padEnd(8)} ${String(b.metricName).padEnd(18)} ${(b.information || []).length} lignes  ${Object.keys((b.information || [])[0] || {}).join(', ')}`);
  process.exit(0);
}

/* Compactage avant enregistrement. La reponse brute fait 124 Ko par jour, soit 45 Mo
   par an dans le depot, alors que l'ecrasante majorite des lignes ne porte que des
   zeros : une page sans friction n'apprend rien. On garde tout le trafic, le scroll et
   l'engagement, et on ne retient des frictions que les lignes non nulles. */
const CLES_FRICTION = new Set(FRICTIONS.map(f => f[0]));
const compacter = rep => (Array.isArray(rep) ? rep : []).map(b => !CLES_FRICTION.has(b.metricName) ? b : ({
  ...b,
  information: (b.information || []).filter(l => nb(l.subTotal) > 0 || nb(l.sessionsWithMetricPercentage) > 0),
})).filter(b => (b.information || []).length);

mkdirSync(DOSSIER, { recursive: true });
const chemin = `${DOSSIER}/${snap.date}.json`;
const r = resume(snap, snap.date);
comparer(r);
writeFileSync(chemin, JSON.stringify({ ...snap, url: compacter(snap.url), browser: compacter(snap.browser) }));
console.log(`\n  Instantane enregistre : ${chemin}`);
console.log('  Clarity ne garde que 3 jours : ce fichier est le seul historique dont on disposera.\n');
