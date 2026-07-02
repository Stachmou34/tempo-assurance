#!/usr/bin/env node
'use strict';
/* Tests du prototype : logique métier (API réelle mockée + repli indicatif)
   + aller-retour JSON-RPC du serveur MCP. */

const assert = require('assert');
const { spawn } = require('child_process');
const path = require('path');
const { fetchTarif } = require('./lib/jlassureApi');
const { devisAssuranceTemporaire, tarifsParCategorie, buildDevisUrl } = require('./lib/devis');
const { buildSessionPayload, preparerSessionSouscription } = require('./lib/prefill');

let pass = 0;
function ok(cond, msg) { assert.ok(cond, msg); console.log('  ✓ ' + msg); pass++; }

(async function () {
  console.log('\n[Repli indicatif — sans clé API]');
  delete process.env.JLASSURE_API_KEY;

  const url = buildDevisUrl({ categorie_vehi: 'VL-VL', age_vehicule: 'moins10', puissance: 'inf30', ptac: 'inf3500', motif_assurance_temporaire: 'achat_vente', duree: 15, date_debut: '2026-07-01' });
  ok(url.indexOf('devis-ou-souscription.html?categorie_vehi=VL-VL') > -1 && url.indexOf('ptac=') === -1 && url.indexOf('motif') === -1, 'lien pré-rempli construit (ptac + motif retirés du lien)');
  const uDef = buildDevisUrl({ categorie_vehi: 'VL-VL', age_conducteur: 35 });
  ok(/date_naissance=\d{4}-\d{2}-\d{2}/.test(uDef), 'lien : date_naissance déduite de age_conducteur');
  ok(/date_debut=\d{4}-\d{2}-\d{2}/.test(uDef) && /heure_debut=\d{2}%3A\d{2}/.test(uDef), 'lien : date_debut + heure_debut par défaut');

  const FULL = { categorie_vehi: 'VL-VL', age_vehicule: 'moins10', puissance: 'inf30', pays_immatriculation: 'FRANCE METROPOLITAINE', pays_residence: 'FRANCE METROPOLITAINE', date_naissance: '1990-05-12', duree: 15 };
  const d = await devisAssuranceTemporaire(FULL);
  ok(d.source === 'indicatif', 'sans clé → source indicatif');
  ok(d.tarif_indicatif && d.tarif_indicatif.prix_indicatif === '107,81 €', 'voiture 15 j = 107,81 € (grille)');

  const inc = await devisAssuranceTemporaire({ categorie_vehi: 'VL-VL', duree: 15 });
  ok(inc.source === 'incomplet' && Array.isArray(inc.besoin_infos) && inc.besoin_infos.length >= 3, 'champs manquants → demande (AUCUNE hypothèse)');

  const dInvalide = await devisAssuranceTemporaire({ categorie_vehi: 'XXX' });
  ok(dInvalide.error && Array.isArray(dInvalide.categories_valides), 'catégorie inconnue → erreur + liste');

  const t = tarifsParCategorie({ categorie_vehi: 'REM-REM2' });
  ok(t.grille.length === 4 && t.grille[0].prix_indicatif === '57,66 €', 'grille remorque correcte');

  console.log('\n[Tarif réel — API jlassure mockée]');
  let captured = null;
  const fakeApi = {
    apiKey: 'TEST_KEY',
    fetchImpl: async function (endpoint, opts) {
      captured = { endpoint: endpoint, headers: opts.headers, body: JSON.parse(opts.body) };
      return { ok: true, json: async function () {
        return { prix_vente: 110.50, durees: [1, 2, 3, 5, 7, 10, 15, 30, 90], prefill_url: 'https://www.jlassure.com/sousfiche/assure_tempo_rapide_mb.php?cd=BLA1905B&id=43&categorie_vehi=VL-VL&duree=15' };
      } };
    }
  };
  const api = await fetchTarif({ categorie_vehi: 'VL-VL', age_conducteur: 35, duree: '15', date_debut: '2026-07-01' }, fakeApi);
  ok(api.ok && api.data.prix_vente === 110.50, 'fetchTarif renvoie le prix réel');
  ok(captured.endpoint.indexOf('api_tarif_tempo.php') > -1, 'appel sur le bon endpoint');
  ok(captured.headers['X-Api-Key'] === 'TEST_KEY', 'en-tête X-Api-Key transmis (recommandé)');
  ok(captured.headers.Authorization === 'Bearer TEST_KEY', 'en-tête Authorization Bearer transmis (doublon)');
  ok(captured.body.date_debut === undefined && captured.body.categorie_vehi === 'VL-VL', 'payload = champs API uniquement (pas de date_debut)');

  const dReal = await devisAssuranceTemporaire(Object.assign({}, FULL), fakeApi);
  ok(dReal.source === 'jlassure_api' && dReal.tarif.prix_vente === '110,50 €' && dReal.tarif.prix_reel === true, 'devis utilise le tarif réel (110,50 €)');
  ok(dReal.lien_devis_pre_rempli.indexOf('devis-ou-souscription.html') > -1, 'lien = page devis Tempo (params utilisateur)');
  ok(dReal.echo_args && dReal.echo_args.categorie_vehi === 'VL-VL' && dReal.echo_args.duree === 15, 'echo_args fourni (re-tarification dynamique du widget)');

  console.log('\n[OCR carte grise → champs de tarif]');
  let cap2 = null;
  const fakeCapture = { apiKey: 'K', fetchImpl: async function (e, o) { cap2 = JSON.parse(o.body); return { ok: true, json: async function () { return { prix_vente: 144.54, durees: [15], prefill_url: 'x' }; } }; } };
  const dCG = await devisAssuranceTemporaire({ genre_carte_grise: 'VP', puissance_cv: 35, ptac_kg: 1800, date_mise_circulation: '03/08/2014', age_conducteur: 40, pays_immatriculation: 'FRANCE METROPOLITAINE', pays_residence: 'FRANCE METROPOLITAINE', duree: 15 }, fakeCapture);
  ok(cap2.categorie_vehi === 'VL-VL', 'genre VP → categorie_vehi VL-VL');
  ok(cap2.puissance === 'sup30', 'P.6=35 CV → puissance sup30');
  ok(cap2.age_vehicule === 'plus10', 'mise en circulation 2014 → age_vehicule plus10');
  ok(dCG.source === 'jlassure_api' && dCG.tarif.prix_vente === '144,54 €', 'tarif réel calculé depuis la carte grise (144,54 €)');
  ok(/carte grise/i.test(dCG.message), 'message signale les champs lus sur la carte grise');
  const dCG2 = await devisAssuranceTemporaire({ genre_carte_grise: 'REM', ptac_kg: 600, age_vehicule: 'plus10', pays_immatriculation: 'FRANCE METROPOLITAINE', pays_residence: 'FRANCE METROPOLITAINE', age_conducteur: 40, duree: 5 }, fakeCapture);
  ok(cap2.categorie_vehi === 'REM-REM2' && cap2.puissance === '0', 'genre REM → remorque + puissance 0 (sans hypothèse)');

  const fakeHors = { apiKey: 'K', fetchImpl: async function () { return { ok: true, json: async function () { return { hors_perimetre: true }; } }; } };
  const dHors = await devisAssuranceTemporaire(Object.assign({}, FULL, { duree: 5 }), fakeHors);
  ok(dHors.hors_perimetre === true && /hors périmètre/i.test(dHors.message), 'hors périmètre géré');

  const fakeDown = { apiKey: 'K', fetchImpl: async function () { return { ok: false, status: 500 }; } };
  const dDown = await devisAssuranceTemporaire(Object.assign({}, FULL), fakeDown);
  ok(dDown.source === 'indicatif', 'API en erreur → repli indicatif (pas de crash)');

  console.log('\n[Phase 2 — prefill session (données perso)]');
  // minimisation : seuls les champs fournis sont conservés
  const pl = buildSessionPayload({ conducteur: { nom: 'X', truc: 'z' }, vehicule: { genre: 'VL-VL' }, profil_tarifaire: { duree: '7' } });
  ok(pl.conducteur && pl.conducteur.nom === 'X' && pl.conducteur.truc === undefined, 'payload : champs inconnus filtrés (minimisation)');
  ok(pl.vehicule.genre === 'VL-VL' && pl.profil_tarifaire.duree === '7', 'payload : conducteur/vehicule/profil structurés');
  const pl2 = buildSessionPayload({ conducteur: { date_naissance: '1990-05-12' }, vehicule: { genre: 'VL-VL', puissance_fiscale: 5, date_premiere_mec: '2019-03-15' } });
  ok(pl2.profil_tarifaire.categorie_vehi === 'VL-VL' && pl2.profil_tarifaire.puissance === 'inf30' && pl2.profil_tarifaire.age_vehicule === 'moins10' && pl2.profil_tarifaire.date_naissance === '1990-05-12', 'profil_tarifaire complété depuis conducteur/véhicule (tarif pré-rempli)');

  // interrupteur OFF -> désactivé
  delete process.env.ENABLE_PREFILL_SESSION;
  const off = await preparerSessionSouscription({ conducteur: { nom: 'X' }, vehicule: { genre: 'VL-VL' } });
  ok(off.disabled === true, 'OFF par défaut : outil désactivé (gate RGPD)');

  // interrupteur ON + API mockée -> session_url
  process.env.ENABLE_PREFILL_SESSION = '1';
  const fakeSession = { apiKey: 'K', fetchImpl: async function () {
    return { ok: true, status: 201, json: async function () { return { success: true, token: 't-123', session_url: 'https://www.jlassure.com/sousfiche/assure_tempo_rapide_mb.php?cd=BLA1905B&id=43&prefill_token=t-123', expires_at: '2026-06-19T14:00:00+02:00', ttl_seconds: 1800 }; } };
  } };
  const on = await preparerSessionSouscription({ conducteur: { nom: 'MARTIN', prenom: 'Sophie' }, vehicule: { genre: 'VL-VL' } }, fakeSession);
  ok(on.success === true && /prefill_token=t-123/.test(on.session_url), 'ON : renvoie la session_url (pas de donnée perso dans l\'URL)');
  ok(/usage unique/.test(on.message) && /IPID/.test(on.message), 'message : rappel conformité (usage unique + IPID)');

  console.log('\n[Phase 2bis — pièces jointes (photos -> dossier JL Assure)]');
  const SESSION_JSON = { success: true, token: 't-123', session_url: 'https://www.jlassure.com/sousfiche/assure_tempo_rapide_mb.php?cd=BLA1905B&id=43&prefill_token=t-123', ttl_seconds: 1800 };
  function fakeHttp(docsResponse) {
    const seen = { docsBody: null, downloads: [] };
    return { seen: seen, opts: { apiKey: 'K', fetchImpl: async function (url, o) {
      url = String(url);
      if (url.indexOf('api_prefill_session') > -1) return { ok: true, status: 201, json: async function () { return SESSION_JSON; } };
      if (url.indexOf('api_prefill_docs') > -1) { seen.docsBody = o.body; return { ok: docsResponse.ok !== false, status: docsResponse.status || 200, json: async function () { return docsResponse.json; } }; }
      /* URL de téléchargement ChatGPT (openai/fileParams) */
      seen.downloads.push(url);
      return { ok: true, headers: { get: function () { return 'image/jpeg'; } }, arrayBuffer: async function () { return new ArrayBuffer(4096); } };
    } } };
  }
  const ARGS_DOCS = {
    conducteur: { nom: 'MARTIN', prenom: 'Sophie' }, vehicule: { genre: 'VL-VL' },
    photo_permis: { file_id: 'f1', download_url: 'https://files.example/f1', mime_type: 'image/jpeg', file_name: 'permis.jpg' },
    photo_carte_grise: { file_id: 'f2', download_url: 'https://files.example/f2' }
  };
  // succès total : pièces téléchargées puis jointes
  let h = fakeHttp({ json: { success: true, pieces: ['permis', 'carte_grise'], documents: [] } });
  const okDocs = await preparerSessionSouscription(ARGS_DOCS, h.opts);
  ok(okDocs.success === true && h.seen.downloads.length === 2, 'pièces : les 2 photos sont téléchargées depuis les URLs ChatGPT');
  ok(h.seen.docsBody && typeof h.seen.docsBody.get === 'function' && h.seen.docsBody.get('prefill_token') === 't-123', 'pièces : multipart avec prefill_token vers api_prefill_docs');
  ok(okDocs.pieces_jointes.length === 2 && /déjà jointes/.test(okDocs.message), 'pièces : message « déjà jointes » (zéro re-téléversement)');
  // pièce illisible : 422 unreadable_document -> relance photo nette
  h = fakeHttp({ ok: false, status: 422, json: { success: false, details: [{ field: 'permis', code: 'unreadable_document', error: 'Image trop petite' }] } });
  const bad = await preparerSessionSouscription(ARGS_DOCS, h.opts);
  ok(bad.success === true && bad.pieces_en_echec && bad.pieces_en_echec[0].code === 'unreadable_document' && /nette/.test(bad.message), 'pièces : illisible -> session OK + consigne « photo nette »');
  // référence incomplète (bug mobile) : pas de download_url -> repli tunnel, session OK
  h = fakeHttp({ json: { success: true, pieces: ['carte_grise'], documents: [] } });
  const mob = await preparerSessionSouscription(Object.assign({}, ARGS_DOCS, { photo_permis: { file_id: 'f1' } }), h.opts);
  ok(mob.success === true && mob.pieces_en_echec.some(function (e) { return e.code === 'reference_incomplete'; }), 'pièces : référence mobile incomplète -> repli tunnel, session conservée');
  // outil : fileParams déclarés
  const { prefillTool } = require('./lib/prefill');
  ok(prefillTool._meta && Array.isArray(prefillTool._meta['openai/fileParams']) && prefillTool._meta['openai/fileParams'].indexOf('photo_permis') > -1, 'outil : _meta openai/fileParams déclare les photos');
  delete process.env.ENABLE_PREFILL_SESSION;

  console.log('\n[Serveur MCP — JSON-RPC stdio]');
  await new Promise(function (resolve) {
    const srv = spawn('node', [path.join(__dirname, 'server.js')], { stdio: ['pipe', 'pipe', 'inherit'] });
    let out = '';
    srv.stdout.on('data', function (c) { out += c; });
    const reqs = [
      { jsonrpc: '2.0', id: 1, method: 'initialize', params: {} },
      { jsonrpc: '2.0', id: 2, method: 'tools/list', params: {} },
      { jsonrpc: '2.0', id: 3, method: 'tools/call', params: { name: 'devis_assurance_temporaire', arguments: { categorie_vehi: 'VL-VL', age_vehicule: 'moins10', puissance: 'inf30', pays_immatriculation: 'FRANCE METROPOLITAINE', pays_residence: 'FRANCE METROPOLITAINE', date_naissance: '1990-05-12', duree: 7 } } }
    ];
    srv.stdin.write(reqs.map(function (r) { return JSON.stringify(r); }).join('\n') + '\n');
    setTimeout(function () {
      srv.kill();
      const byId = {};
      out.trim().split('\n').filter(Boolean).map(JSON.parse).forEach(function (l) { byId[l.id] = l; });
      ok(byId[1] && byId[1].result.serverInfo.name === 'tempo-assurance', 'initialize → serverInfo');
      ok(byId[2] && byId[2].result.tools.length === 2, 'tools/list → 2 outils');
      ok(byId[2].result.tools.every(function (t) { return t.inputSchema && t.inputSchema.type === 'object'; }), 'schémas valides (type object)');
      ok(byId[2].result.tools.every(function (t) { return t.annotations && t.annotations.readOnlyHint === true && t.annotations.destructiveHint === false; }), 'annotations Apps SDK (readOnlyHint/destructiveHint)');
      ok(byId[2].result.tools.every(function (t) { return t.outputSchema && t.outputSchema.type === 'object'; }), 'outputSchema présent sur chaque outil');
      ok(byId[3] && /83,59/.test(byId[3].result.content[0].text), 'tools/call (sans clé) → tarif indicatif 7 j (83,59 €)');
      resolve();
    }, 800);
  });

  console.log('\n[Serveur MCP — HTTP /mcp (Apps SDK)]');
  await new Promise(function (resolve) {
    const port = 8799;
    const env = Object.assign({}, process.env, { PORT: String(port), OPENAI_DOMAIN_VERIFICATION: 'tok-test-123' });
    const srv = spawn('node', [path.join(__dirname, 'server-http.js')], { stdio: ['ignore', 'ignore', 'inherit'], env });
    setTimeout(async function () {
      async function rpc(m) {
        const r = await fetch('http://localhost:' + port + '/mcp', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(m) });
        return r.status === 202 ? null : r.json();
      }
      try {
        const init = await rpc({ jsonrpc: '2.0', id: 1, method: 'initialize', params: {} });
        ok(init.result.serverInfo.name === 'tempo-assurance', 'HTTP initialize → serverInfo');
        const list = await rpc({ jsonrpc: '2.0', id: 2, method: 'tools/list', params: {} });
        ok(list.result.tools.length === 2, 'HTTP tools/list → 2 outils');
        const call = await rpc({ jsonrpc: '2.0', id: 3, method: 'tools/call', params: { name: 'tarifs_par_categorie', arguments: { categorie_vehi: 'VL-VL' } } });
        ok(/107,81/.test(call.result.content[0].text), 'HTTP tools/call → grille voiture (107,81 €)');
        const health = await (await fetch('http://localhost:' + port + '/')).json();
        ok(health.ok === true && health.endpoint === '/mcp', 'HTTP / health-check');
        const wk = await fetch('http://localhost:' + port + '/.well-known/openai-domain');
        ok(wk.status === 200 && (await wk.text()) === 'tok-test-123', 'HTTP /.well-known → token de vérification de domaine');
        const devisTool = list.result.tools.find(function (t) { return t.name === 'devis_assurance_temporaire'; });
        ok(devisTool._meta && devisTool._meta['openai/outputTemplate'] === 'ui://widget/devis.html', 'outil devis lié au widget (_meta outputTemplate)');
        const rlist = await rpc({ jsonrpc: '2.0', id: 4, method: 'resources/list', params: {} });
        ok(rlist.result.resources.some(function (r) { return r.uri === 'ui://widget/devis.html'; }), 'resources/list → widget exposé');
        const rread = await rpc({ jsonrpc: '2.0', id: 5, method: 'resources/read', params: { uri: 'ui://widget/devis.html' } });
        ok(/profile=mcp-app/.test(rread.result.contents[0].mimeType) && /Souscrire/.test(rread.result.contents[0].text), 'resources/read → HTML du widget (mimeType + contenu)');
        const dcall = await rpc({ jsonrpc: '2.0', id: 6, method: 'tools/call', params: { name: 'devis_assurance_temporaire', arguments: { categorie_vehi: 'VL-VL', age_vehicule: 'moins10', puissance: 'inf30', pays_immatriculation: 'FRANCE METROPOLITAINE', pays_residence: 'FRANCE METROPOLITAINE', date_naissance: '1990-05-12', duree: 15 } } });
        ok(dcall.result._meta && dcall.result._meta['openai/outputTemplate'] === 'ui://widget/devis.html', 'tools/call devis → _meta widget dans le résultat');
      } catch (e) { ok(false, 'HTTP erreur : ' + e.message); }
      srv.kill();
      resolve();
    }, 600);
  });

  console.log('\n[Serveur HTTP — outil prefill activé]');
  await new Promise(function (resolve) {
    const port = 8801;
    const env = Object.assign({}, process.env, { PORT: String(port), ENABLE_PREFILL_SESSION: '1' });
    const srv = spawn('node', [path.join(__dirname, 'server-http.js')], { stdio: ['ignore', 'ignore', 'inherit'], env });
    setTimeout(async function () {
      try {
        const r = await fetch('http://localhost:' + port + '/mcp', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ jsonrpc: '2.0', id: 1, method: 'tools/list', params: {} }) });
        const j = await r.json();
        const names = j.result.tools.map(function (t) { return t.name; });
        ok(names.indexOf('preparer_session_souscription') > -1, 'ENABLE_PREFILL_SESSION=1 → outil prefill exposé (' + names.length + ' outils)');
      } catch (e) { ok(false, 'HTTP prefill erreur : ' + e.message); }
      srv.kill();
      resolve();
    }, 600);
  });

  console.log('\n==== ' + pass + ' tests OK ====\n');
  process.exit(0);
})().catch(function (e) { console.error('ÉCHEC :', e.message); process.exit(1); });
