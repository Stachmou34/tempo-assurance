#!/usr/bin/env node
'use strict';
/* Transport stdio (JSON-RPC MCP délimité par des sauts de ligne).
   Utile pour le MCP Inspector / un client MCP local. Le dispatch est partagé
   avec le serveur HTTP (lib/rpc.js). */

const { dispatch } = require('./lib/rpc');

function send(msg) { process.stdout.write(JSON.stringify(msg) + '\n'); }

let buffer = '';
process.stdin.setEncoding('utf8');
process.stdin.on('data', function (chunk) {
  buffer += chunk;
  let nl;
  while ((nl = buffer.indexOf('\n')) >= 0) {
    const line = buffer.slice(0, nl).trim();
    buffer = buffer.slice(nl + 1);
    if (!line) continue;
    let msg;
    try { msg = JSON.parse(line); }
    catch (e) { send({ jsonrpc: '2.0', id: null, error: { code: -32700, message: 'JSON invalide' } }); continue; }
    Promise.resolve(dispatch(msg)).then(function (r) { if (r) send(r); });
  }
});

if (require.main === module) {
  process.stderr.write('[tempo-assurance MCP] prêt (stdio)\n');
}
