'use strict';
/* Dispatch JSON-RPC MCP partagé par les deux transports (stdio et HTTP).
   Renvoie l'objet réponse JSON-RPC, ou null pour une notification. */

const { TOOLS } = require('./tools');
const { RESOURCES, readResource } = require('./resources');

const SERVER_INFO = { name: 'tempo-assurance', version: '0.1.0' };
const PROTOCOL_VERSION = '2024-11-05';
/* Versions du protocole MCP que ce serveur sait honorer. On renvoie celle demandée
   par le client si elle est connue (négociation conforme à la spec), sinon le défaut.
   Permet à la fois ChatGPT (Apps SDK) et Claude (connecteurs MCP) de se connecter. */
const SUPPORTED_PROTOCOLS = ['2025-06-18', '2025-03-26', '2024-11-05'];

function res(id, result) { return { jsonrpc: '2.0', id: id, result: result }; }
function err(id, code, message) { return { jsonrpc: '2.0', id: id, error: { code: code, message: message } }; }

async function dispatch(msg) {
  const id = msg.id;
  switch (msg.method) {
    case 'initialize': {
      const requested = (msg.params || {}).protocolVersion;
      const negotiated = SUPPORTED_PROTOCOLS.indexOf(requested) !== -1 ? requested : PROTOCOL_VERSION;
      return res(id, {
        protocolVersion: negotiated,
        capabilities: { tools: {}, resources: {} },
        serverInfo: SERVER_INFO
      });
    }
    case 'notifications/initialized':
    case 'notifications/cancelled':
      return null; /* notifications : pas de réponse */
    case 'ping':
      return res(id, {});
    case 'tools/list':
      return res(id, {
        tools: TOOLS.map(function (t) {
          const def = {
            name: t.name,
            title: t.title,
            description: t.description,
            inputSchema: t.inputSchema,
            outputSchema: t.outputSchema,
            annotations: t.annotations
          };
          if (t._meta) def._meta = t._meta;
          return def;
        })
      });
    case 'resources/list':
      return res(id, { resources: RESOURCES });
    case 'resources/read': {
      const c = readResource((msg.params || {}).uri);
      if (!c) return err(id, -32602, 'Ressource inconnue : ' + ((msg.params || {}).uri));
      return res(id, { contents: [c] });
    }
    case 'tools/call': {
      const params = msg.params || {};
      const tool = TOOLS.find(function (t) { return t.name === params.name; });
      if (!tool) return err(id, -32602, 'Outil inconnu : ' + params.name);
      let out;
      try { out = await tool.handler(params.arguments || {}); }
      catch (e) { return err(id, -32603, 'Erreur outil : ' + e.message); }
      const result = {
        content: [{ type: 'text', text: out.message || JSON.stringify(out) }],
        structuredContent: out
      };
      if (tool._meta) result._meta = tool._meta; /* lie le widget au résultat */
      return res(id, result);
    }
    default:
      if (id !== undefined && id !== null) return err(id, -32601, 'Méthode inconnue : ' + msg.method);
      return null;
  }
}

module.exports = { dispatch, SERVER_INFO, PROTOCOL_VERSION };
