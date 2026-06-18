'use strict';
/* Dispatch JSON-RPC MCP partagé par les deux transports (stdio et HTTP).
   Renvoie l'objet réponse JSON-RPC, ou null pour une notification. */

const { TOOLS } = require('./tools');

const SERVER_INFO = { name: 'tempo-assurance', version: '0.1.0' };
const PROTOCOL_VERSION = '2024-11-05';

function res(id, result) { return { jsonrpc: '2.0', id: id, result: result }; }
function err(id, code, message) { return { jsonrpc: '2.0', id: id, error: { code: code, message: message } }; }

async function dispatch(msg) {
  const id = msg.id;
  switch (msg.method) {
    case 'initialize':
      return res(id, {
        protocolVersion: PROTOCOL_VERSION,
        capabilities: { tools: {} },
        serverInfo: SERVER_INFO
      });
    case 'notifications/initialized':
    case 'notifications/cancelled':
      return null; /* notifications : pas de réponse */
    case 'ping':
      return res(id, {});
    case 'tools/list':
      return res(id, {
        tools: TOOLS.map(function (t) {
          return {
            name: t.name,
            description: t.description,
            inputSchema: t.inputSchema,
            outputSchema: t.outputSchema,
            annotations: t.annotations
          };
        })
      });
    case 'tools/call': {
      const params = msg.params || {};
      const tool = TOOLS.find(function (t) { return t.name === params.name; });
      if (!tool) return err(id, -32602, 'Outil inconnu : ' + params.name);
      let out;
      try { out = await tool.handler(params.arguments || {}); }
      catch (e) { return err(id, -32603, 'Erreur outil : ' + e.message); }
      return res(id, {
        content: [{ type: 'text', text: out.message || JSON.stringify(out) }],
        structuredContent: out
      });
    }
    default:
      if (id !== undefined && id !== null) return err(id, -32601, 'Méthode inconnue : ' + msg.method);
      return null;
  }
}

module.exports = { dispatch, SERVER_INFO, PROTOCOL_VERSION };
