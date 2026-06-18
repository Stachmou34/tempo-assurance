#!/usr/bin/env node
'use strict';
/* Serveur MCP minimal (JSON-RPC 2.0 sur stdio, sans dépendance) pour le
   prototype de l'app ChatGPT Tempo-Assurance.

   Prototype : valide la logique des outils (devis + grille). Pour la mise en
   production dans ChatGPT, on enveloppe ces mêmes outils avec l'Apps SDK
   d'OpenAI (transport HTTP + manifest + composants UI). Voir README.md. */

const { TOOLS } = require('./lib/tools');

const SERVER_INFO = { name: 'tempo-assurance', version: '0.1.0' };
const PROTOCOL_VERSION = '2024-11-05';

function send(msg) { process.stdout.write(JSON.stringify(msg) + '\n'); }
function result(id, res) { send({ jsonrpc: '2.0', id: id, result: res }); }
function error(id, code, message) { send({ jsonrpc: '2.0', id: id, error: { code: code, message: message } }); }

async function handle(msg) {
  const id = msg.id;
  switch (msg.method) {
    case 'initialize':
      return result(id, {
        protocolVersion: PROTOCOL_VERSION,
        capabilities: { tools: {} },
        serverInfo: SERVER_INFO
      });
    case 'notifications/initialized':
      return; /* notification : pas de réponse */
    case 'tools/list':
      return result(id, {
        tools: TOOLS.map(function (t) {
          return { name: t.name, description: t.description, inputSchema: t.inputSchema };
        })
      });
    case 'tools/call': {
      const params = msg.params || {};
      const tool = TOOLS.find(function (t) { return t.name === params.name; });
      if (!tool) return error(id, -32602, 'Outil inconnu : ' + params.name);
      let out;
      try { out = await tool.handler(params.arguments || {}); }
      catch (e) { return error(id, -32603, 'Erreur outil : ' + e.message); }
      return result(id, {
        content: [{ type: 'text', text: out.message || JSON.stringify(out) }],
        structuredContent: out
      });
    }
    default:
      if (id !== undefined) return error(id, -32601, 'Méthode inconnue : ' + msg.method);
  }
}

/* Boucle stdio : messages JSON-RPC délimités par des sauts de ligne */
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
    catch (e) { error(null, -32700, 'JSON invalide'); continue; }
    handle(msg);
  }
});

if (require.main === module) {
  process.stderr.write('[tempo-assurance MCP] prêt (stdio)\n');
}
module.exports = { handle, TOOLS };
