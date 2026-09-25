#!/usr/bin/env node
/* Fabrique un jeton d'acces Google a partir d'une cle de compte de service.
 *
 * Variable d'environnement attendue : GOOGLE_SERVICE_ACCOUNT_JSON
 *   contenu = le fichier JSON de la cle, tel quel OU encode en base64 (une ligne).
 *
 * Usage :
 *   node scripts/gsc-token.mjs                 -> scope Search Console (lecture)
 *   node scripts/gsc-token.mjs analytics       -> scope GA4 (lecture)
 *
 * Sort le jeton sur stdout, rien d'autre, pour etre capturable :
 *   T=$(node scripts/gsc-token.mjs) && curl -H "Authorization: Bearer $T" ...
 *
 * Le jeton vaut 1 heure. Aucune cle n'est jamais affichee ni ecrite sur disque.
 */
import { createSign } from 'crypto';

const SCOPES = {
  search:    'https://www.googleapis.com/auth/webmasters.readonly',
  analytics: 'https://www.googleapis.com/auth/analytics.readonly',
};
const scope = SCOPES[process.argv[2] === 'analytics' ? 'analytics' : 'search'];

const raw = process.env.GOOGLE_SERVICE_ACCOUNT_JSON;
if (!raw) {
  console.error('GOOGLE_SERVICE_ACCOUNT_JSON absente.');
  console.error('A ajouter dans les variables d\'environnement du cloud (menu environnement > Edit).');
  console.error('Contenu attendu : le JSON de la cle du compte de service, tel quel.');
  process.exit(2);
}

/* La variable accepte deux formes, car les champs de configuration attendent
   souvent une seule ligne alors que le fichier telecharge en fait plusieurs :
     - le JSON tel quel (une ou plusieurs lignes)
     - le meme JSON encode en base64 (une seule ligne, recommande) */
let key, txt = raw.trim();
if (!txt.startsWith('{')) {
  try { txt = Buffer.from(txt, 'base64').toString('utf8'); }
  catch (e) { console.error('GOOGLE_SERVICE_ACCOUNT_JSON : ni du JSON, ni du base64 lisible.'); process.exit(2); }
}
try { key = JSON.parse(txt); }
catch (e) {
  console.error('GOOGLE_SERVICE_ACCOUNT_JSON ne contient pas du JSON valide : ' + e.message);
  console.error('Astuce : encoder le fichier en base64 sur une seule ligne evite tout probleme de format.');
  process.exit(2);
}
for (const f of ['client_email', 'private_key']) {
  if (!key[f]) { console.error(`Champ « ${f} » absent de la cle.`); process.exit(2); }
}

const b64 = o => Buffer.from(typeof o === 'string' ? o : JSON.stringify(o))
  .toString('base64').replace(/=/g, '').replace(/\+/g, '-').replace(/\//g, '_');

const now = Math.floor(Date.now() / 1000);
const header = b64({ alg: 'RS256', typ: 'JWT' });
const claims = b64({
  iss: key.client_email,
  scope,
  aud: 'https://oauth2.googleapis.com/token',
  iat: now,
  exp: now + 3600,
});
const sig = createSign('RSA-SHA256').update(`${header}.${claims}`).sign(key.private_key)
  .toString('base64').replace(/=/g, '').replace(/\+/g, '-').replace(/\//g, '_');

const res = await fetch('https://oauth2.googleapis.com/token', {
  method: 'POST',
  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
  body: new URLSearchParams({
    grant_type: 'urn:ietf:params:oauth:grant-type:jwt-bearer',
    assertion: `${header}.${claims}.${sig}`,
  }),
});
const j = await res.json();
if (!res.ok || !j.access_token) {
  console.error(`Echec de l'echange (HTTP ${res.status}) : ${j.error || ''} ${j.error_description || ''}`.trim());
  console.error('Verifier : API activee dans le projet Google Cloud, et compte de service ajoute');
  console.error('comme utilisateur dans Search Console (Parametres > Utilisateurs et autorisations).');
  process.exit(1);
}
process.stdout.write(j.access_token);
