#!/usr/bin/env node
'use strict';
/* Tests du prototype : logique métier + aller-retour JSON-RPC du serveur MCP. */

const assert = require('assert');
const { spawn } = require('child_process');
const path = require('path');
const { devisAssuranceTemporaire, tarifsParCategorie, buildDevisUrl } = require('./lib/devis');

let pass = 0;
function ok(cond, msg) { assert.ok(cond, msg); console.log('  ✓ ' + msg); pass++; }

console.log('\n[Logique métier]');

/* 1. Lien pré-rempli identique à la recette site.js */
const url = buildDevisUrl({ categorie_vehi: 'VL-VL', age_vehicule: 'moins10', puissance: 'inf30', ptac: 'inf3500', duree: 15, date_debut: '2026-07-01' });
ok(url.indexOf('devis-ou-souscription.html?categorie_vehi=VL-VL') > -1, 'URL pointe vers la page devis');
ok(url.indexOf('ptac=inf3500') > -1 && url.indexOf('duree=15') > -1, 'paramètres encodés (dont ptac)');

/* 2. Tarif indicatif voiture 15 j = 107,81 € (grille llms.txt) */
const d = devisAssuranceTemporaire({ categorie_vehi: 'VL-VL', puissance: 'inf30', duree: 15, date_debut: '2026-07-01' });
ok(d.tarif_indicatif && d.tarif_indicatif.prix_indicatif === '107,81 €', 'voiture 15 j = 107,81 €');
ok(d.lien_devis_pre_rempli.indexOf('duree=15') > -1, 'devis renvoie le lien pré-rempli');
ok(/aucune souscription/i.test(d.message), 'mention conformité présente');

/* 3. Voiture >30 CV → autre grille */
const d2 = devisAssuranceTemporaire({ categorie_vehi: 'VL-VL', puissance: 'sup30', duree: 30 });
ok(d2.tarif_indicatif.prix_indicatif === '213,90 €', 'voiture >30 CV 30 j = 213,90 €');

/* 4. Durée hors grille → liste des durées dispo, pas d'erreur */
const d3 = devisAssuranceTemporaire({ categorie_vehi: 'CAM-CAM3', duree: 99 });
ok(d3.tarif_indicatif === null && Array.isArray(d3.durees_disponibles), 'durée invalide → liste des durées');

/* 5. Catégorie inconnue → erreur explicite */
const d4 = devisAssuranceTemporaire({ categorie_vehi: 'XXX' });
ok(d4.error && Array.isArray(d4.categories_valides), 'catégorie inconnue → erreur + liste');

/* 6. Grille remorque */
const t = tarifsParCategorie({ categorie_vehi: 'REM-REM2' });
ok(t.grille.length === 4 && t.grille[0].prix_indicatif === '57,66 €', 'grille remorque correcte');

console.log('\n[Serveur MCP — JSON-RPC stdio]');
const srv = spawn('node', [path.join(__dirname, 'server.js')], { stdio: ['pipe', 'pipe', 'inherit'] });
let out = '';
srv.stdout.on('data', function (c) { out += c; });

const reqs = [
  { jsonrpc: '2.0', id: 1, method: 'initialize', params: {} },
  { jsonrpc: '2.0', id: 2, method: 'tools/list', params: {} },
  { jsonrpc: '2.0', id: 3, method: 'tools/call', params: { name: 'devis_assurance_temporaire', arguments: { categorie_vehi: 'VL-VL', puissance: 'inf30', duree: 7, date_debut: '2026-07-01' } } }
];
srv.stdin.write(reqs.map(function (r) { return JSON.stringify(r); }).join('\n') + '\n');

setTimeout(function () {
  srv.kill();
  const lines = out.trim().split('\n').filter(Boolean).map(JSON.parse);
  const byId = {};
  lines.forEach(function (l) { byId[l.id] = l; });

  ok(byId[1] && byId[1].result.serverInfo.name === 'tempo-assurance', 'initialize → serverInfo');
  ok(byId[2] && byId[2].result.tools.length === 2, 'tools/list → 2 outils');
  ok(byId[2].result.tools.every(function (t) { return t.inputSchema && t.inputSchema.type === 'object'; }), 'schémas valides (type object)');
  const call = byId[3];
  ok(call && /83,59/.test(call.result.content[0].text), 'tools/call devis → tarif 7 j (83,59 €) dans la réponse');
  ok(/devis-ou-souscription\.html\?/.test(call.result.content[0].text), 'tools/call → lien pré-rempli dans la réponse');

  console.log('\n==== ' + pass + ' tests OK ====\n');
  process.exit(0);
}, 800);
