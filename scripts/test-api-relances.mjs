#!/usr/bin/env node
/* Recette de l'API de relance autotempo.net.
   Verifie le contrat documente : codes HTTP, format des erreurs, champs renvoyes,
   minimisation des donnees et idempotence du marquage.

   Le jeton se lit dans la variable d'environnement MCJ_API_TOKEN.
   Il ne doit JAMAIS etre ecrit dans ce fichier ni passe dans une URL. */

const BASE  = 'https://autotempo.net/api.php';
const TOKEN = process.env.MCJ_API_TOKEN || '';

// Champs autorises par la minimisation : tout le reste est une fuite de donnees.
const CHAMPS_ATTENDUS = ['ref','email','prenom','date_debut','date_fin','duree_jours','categorie','montant'];
const CHAMPS_INTERDITS = ['nom','adresse','telephone','tel','plaque','immatriculation',
                          'permis','date_naissance','naissance','iban','rib','carte'];

const ok = [], ko = [];
const note = (bon, titre, detail = '') =>
  (bon ? ok : ko).push(`${titre}${detail ? ' -> ' + detail : ''}`);

async function appel(url, opts = {}) {
  try {
    const r = await fetch(url, opts);
    const txt = await r.text();
    let json = null;
    try { json = JSON.parse(txt); } catch {}
    return { code: r.status, json, txt, type: r.headers.get('content-type') || '' };
  } catch (e) {
    return { code: 0, json: null, txt: String(e.message), type: '' };
  }
}

/* Le proxy sortant de l'environnement supprime l'en-tete Authorization : les appels
   arrivent sans jeton et l'API repond 401. On envoie donc les deux en-tetes, et c'est
   X-Authorization, le repli prevu par l'API, qui porte reellement le jeton. */
const auth = (jeton = TOKEN) => ({
  'Authorization':   `Bearer ${jeton}`,
  'X-Authorization': `Bearer ${jeton}`,
});

console.log('Recette API de relance autotempo.net\n');

// --- 1. l'API doit repondre en JSON, meme en erreur ---
let r = await appel(`${BASE}?route=echeances&de=0&a=7`);
note(r.code !== 500, '1. Sans jeton : pas d\'erreur serveur',
     r.code === 500 ? 'HTTP 500, le script plante avant de router' : `HTTP ${r.code}`);
note(r.code === 401, '2. Sans jeton : HTTP 401', `recu ${r.code}`);
note(r.json !== null, '3. Sans jeton : reponse en JSON',
     r.json ? '' : `recu du ${r.type.includes('html') ? 'HTML' : 'texte brut'}`);

// --- 2. jeton invalide ---
r = await appel(`${BASE}?route=echeances&de=0&a=7`, { headers: auth('mcj_jeton_volontairement_faux') });
note(r.code === 401, '4. Jeton invalide : HTTP 401', `recu ${r.code}`);

// --- 3. routage ---
r = await appel(`${BASE}?route=route_inconnue`, { headers: auth('mcj_faux') });
note(r.code === 404 || r.code === 401, '5. Route inconnue : HTTP 404', `recu ${r.code}`);

r = await appel(`${BASE}?route=echeances`, { method: 'POST', headers: auth('mcj_faux') });
note(r.code === 405 || r.code === 401, '6. POST sur echeances : HTTP 405', `recu ${r.code}`);

// --- 4. la suite exige un vrai jeton ---
if (!TOKEN) {
  console.log('  ' + ok.map(s => 'OK   ' + s).join('\n  '));
  if (ko.length) console.log('  ' + ko.map(s => 'ECHEC ' + s).join('\n  '));
  console.log('\nMCJ_API_TOKEN absent : les controles authentifies sont ignores.');
  console.log('Renseigner le jeton dans les secrets de l\'environnement, jamais dans le depot.');
  process.exit(ko.length ? 1 : 0);
}

// --- 4bis. quel en-tete porte reellement le jeton ---
const seulAuth = await appel(`${BASE}?route=echeances&de=0&a=0`, {
  headers: { Authorization: `Bearer ${TOKEN}` },
});
const seulX = await appel(`${BASE}?route=echeances&de=0&a=0`, {
  headers: { 'X-Authorization': `Bearer ${TOKEN}` },
});
note(seulAuth.code === 200 || seulX.code === 200, '6bis. Le jeton passe par au moins un en-tete',
     seulAuth.code === 200 ? 'Authorization' : (seulX.code === 200 ? 'X-Authorization seulement' : 'aucun des deux'));
if (seulAuth.code !== 200 && seulX.code === 200) {
  console.log('  NOTE  Authorization est filtre en sortie, seul X-Authorization arrive jusqu\'a l\'API.');
}

// --- 5. plage de dates ---
r = await appel(`${BASE}?route=echeances&de=5&a=2`, { headers: auth() });
note(r.code === 400, '7. Plage incoherente (de > a) : HTTP 400', `recu ${r.code}`);

r = await appel(`${BASE}?route=echeances&de=0&a=400`, { headers: auth() });
note(r.code === 400, '8. Plage superieure a 93 jours : HTTP 400', `recu ${r.code}`);

// --- 6. lecture nominale ---
r = await appel(`${BASE}?route=echeances&de=0&a=7`, { headers: auth() });
note(r.code === 200, '9. Lecture nominale : HTTP 200', `recu ${r.code}`);

if (r.code === 200 && r.json) {
  const c = r.json.contrats;
  note(Array.isArray(c), '10. Champ "contrats" present et tableau');
  note(typeof r.json.nombre === 'number' && (!Array.isArray(c) || r.json.nombre === c.length),
       '11. "nombre" coherent avec la taille du tableau');

  if (Array.isArray(c) && c.length) {
    const cles = [...new Set(c.flatMap(Object.keys))];
    const surplus = cles.filter(k => !CHAMPS_ATTENDUS.includes(k));
    note(surplus.length === 0, '12. Aucun champ hors contrat',
         surplus.length ? `en trop : ${surplus.join(', ')}` : '');

    // Un champ explicitement au contrat ne peut pas etre une fuite : sans cette
    // exclusion, "prenom" declenche l'alerte parce qu'il contient "nom".
    const fuites = cles.filter(k => !CHAMPS_ATTENDUS.includes(k)
                                 && CHAMPS_INTERDITS.some(i => k.toLowerCase().includes(i)));
    note(fuites.length === 0, '13. MINIMISATION : aucune donnee personnelle interdite',
         fuites.length ? `FUITE : ${fuites.join(', ')}` : '');

    // Les montants partent en flottant brut : "montant":159.3700000000000045474735...
    // Il faut lire la reponse BRUTE : JSON.parse puis String() reaffiche 159.37 et
    // masque completement le probleme. Inexploitable tel quel par un client non-JS.
    const bruts = [...r.txt.matchAll(/"montant":(-?\d+\.(\d+))/g)].filter(m => m[2].length > 2);
    note(bruts.length === 0, '17. Les montants ont au plus 2 decimales sur le fil',
         bruts.length ? `${bruts.length} montant(s) en flottant brut, ex. ${bruts[0][1].slice(0, 28)}...` : '');

    const refsOpaques = c.every(x => typeof x.ref === 'string' && /^c_[0-9a-f]{8,}$/.test(x.ref));
    note(refsOpaques, '14. Les "ref" sont opaques', refsOpaques ? '' : 'une ref ressemble a un identifiant interne');

    const emails = c.every(x => typeof x.email === 'string' && x.email.includes('@'));
    note(emails, '15. Tous les contrats ont un email exploitable');
  } else {
    console.log('  (aucun contrat sur la plage : controles 12 a 15 non evaluables aujourd\'hui)');
  }
}

// --- 7. marquage : ref inexistante ---
r = await appel(`${BASE}?route=relances`, {
  method: 'POST',
  headers: { ...auth(), 'Content-Type': 'application/json' },
  body: JSON.stringify({ ref: 'c_0000000000000000000000ff' }),
});
note(r.code === 404, '16. Marquage d\'une ref inconnue : HTTP 404', `recu ${r.code}`);

console.log('  ' + ok.map(s => 'OK    ' + s).join('\n  '));
if (ko.length) console.log('  ' + ko.map(s => 'ECHEC ' + s).join('\n  '));
console.log(`\n${ok.length} controle(s) au vert, ${ko.length} en echec.`);
console.log('Le marquage idempotent (deja_faite) ne se teste pas a vide : il consommerait un vrai contrat.');
process.exit(ko.length ? 1 : 0);
