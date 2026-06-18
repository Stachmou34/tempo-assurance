#!/usr/bin/env node
'use strict';
/* Transport HTTP « Streamable HTTP » pour l'Apps SDK OpenAI : un endpoint /mcp.
   Sans dépendance (http natif). Pour la prod, déployer derrière TLS (HTTPS) sur
   un domaine vérifié, puis enregistrer l'URL comme connecteur dans ChatGPT.

   - POST /mcp : un message JSON-RPC -> réponse JSON-RPC (application/json).
   - GET  /mcp : flux SSE (server->client) ; non utilisé par ces outils
                 synchrones, on garde la connexion ouverte par compat.
   - GET  /    : health-check. */

const http = require('http');
const { dispatch, SERVER_INFO } = require('./lib/rpc');

const PORT = process.env.PORT || 8788;
const MAX_BODY = 1 << 20; /* 1 Mo */

function json(res, status, obj) {
  const body = JSON.stringify(obj);
  res.writeHead(status, { 'Content-Type': 'application/json; charset=utf-8', 'Content-Length': Buffer.byteLength(body) });
  res.end(body);
}

const server = http.createServer(function (req, res) {
  const url = (req.url || '').split('?')[0];

  if (req.method === 'GET' && url === '/') {
    return json(res, 200, { ok: true, server: SERVER_INFO, endpoint: '/mcp' });
  }

  if (url !== '/mcp') { res.writeHead(404); return res.end('Not found'); }

  /* GET /mcp : ouverture du canal SSE (aucun message proactif à émettre ici) */
  if (req.method === 'GET') {
    res.writeHead(200, { 'Content-Type': 'text/event-stream', 'Cache-Control': 'no-cache', 'Connection': 'keep-alive' });
    res.write(': ok\n\n');
    return; /* laissé ouvert */
  }

  if (req.method !== 'POST') { res.writeHead(405); return res.end('Method not allowed'); }

  let body = '';
  let tooBig = false;
  req.on('data', function (c) {
    body += c;
    if (body.length > MAX_BODY) { tooBig = true; req.destroy(); }
  });
  req.on('end', function () {
    if (tooBig) return json(res, 413, { jsonrpc: '2.0', id: null, error: { code: -32600, message: 'Corps trop volumineux' } });
    let msg;
    try { msg = JSON.parse(body); }
    catch (e) { return json(res, 400, { jsonrpc: '2.0', id: null, error: { code: -32700, message: 'JSON invalide' } }); }
    Promise.resolve(dispatch(msg)).then(function (r) {
      if (!r) { res.writeHead(202); return res.end(); } /* notification : 202 sans corps */
      json(res, 200, r);
    }).catch(function (e) {
      json(res, 500, { jsonrpc: '2.0', id: msg && msg.id, error: { code: -32603, message: e.message } });
    });
  });
});

if (require.main === module) {
  server.listen(PORT, function () {
    process.stderr.write('[tempo-assurance MCP] HTTP prêt sur http://localhost:' + PORT + '/mcp\n');
  });
}

module.exports = { server };
