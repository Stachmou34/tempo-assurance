'use strict';
/* Ressources MCP (widgets UI Apps SDK). Le widget est servi en HTML autonome. */

const fs = require('fs');
const path = require('path');

const WIDGET_URI = 'ui://widget/devis.html';
const SOUSCRIPTION_URI = 'ui://widget/souscription.html';
const MIME = 'text/html;profile=mcp-app';
const FILE = path.join(__dirname, '..', 'web', 'devis.html');
const SOUS_FILE = path.join(__dirname, '..', 'web', 'souscription.html');

const RESOURCES = [
  { uri: WIDGET_URI, name: 'Carte de devis Tempo', mimeType: MIME },
  { uri: SOUSCRIPTION_URI, name: 'Carte de souscription Tempo', mimeType: MIME }
];

function readResource(uri) {
  if (uri === WIDGET_URI) {
    return { uri: WIDGET_URI, mimeType: MIME, text: fs.readFileSync(FILE, 'utf8') };
  }
  if (uri === SOUSCRIPTION_URI) {
    return { uri: SOUSCRIPTION_URI, mimeType: MIME, text: fs.readFileSync(SOUS_FILE, 'utf8') };
  }
  return null;
}

module.exports = { RESOURCES, WIDGET_URI, SOUSCRIPTION_URI, MIME, readResource };
