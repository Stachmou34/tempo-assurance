'use strict';
/* Ressources MCP (widgets UI Apps SDK). Le widget est servi en HTML autonome. */

const fs = require('fs');
const path = require('path');

const WIDGET_URI = 'ui://widget/devis.html';
const SOUSCRIPTION_URI = 'ui://widget/souscription.html';
const MIME = 'text/html;profile=mcp-app';
const FILE = path.join(__dirname, '..', 'web', 'devis.html');
const SOUS_FILE = path.join(__dirname, '..', 'web', 'souscription.html');

/* Métadonnées requises pour la validation d'app (CSP + domaine du widget).
   Widgets 100 % autonomes : aucun fetch externe (connect/resource vides) ;
   redirect_domains = destinations autorisées pour window.openai.openExternal
   (lien de devis Tempo + session de souscription jlassure).
   Les deux conventions sont fournies : standard `ui` (camelCase) et
   compat OpenAI `openai/widget*` (snake_case, seule à porter redirect_domains). */
const WIDGET_META = {
  'openai/widgetDomain': 'https://tempo-assurance.com',
  'openai/widgetCSP': {
    connect_domains: [],
    resource_domains: [],
    redirect_domains: ['https://www.tempo-assurance.com', 'https://www.jlassure.com']
  },
  ui: {
    domain: 'https://tempo-assurance.com',
    csp: { connectDomains: [], resourceDomains: [] }
  }
};

const RESOURCES = [
  { uri: WIDGET_URI, name: 'Carte de devis Tempo', mimeType: MIME, _meta: WIDGET_META },
  { uri: SOUSCRIPTION_URI, name: 'Carte de souscription Tempo', mimeType: MIME, _meta: WIDGET_META }
];

function readResource(uri) {
  if (uri === WIDGET_URI) {
    return { uri: WIDGET_URI, mimeType: MIME, text: fs.readFileSync(FILE, 'utf8'), _meta: WIDGET_META };
  }
  if (uri === SOUSCRIPTION_URI) {
    return { uri: SOUSCRIPTION_URI, mimeType: MIME, text: fs.readFileSync(SOUS_FILE, 'utf8'), _meta: WIDGET_META };
  }
  return null;
}

module.exports = { RESOURCES, WIDGET_URI, SOUSCRIPTION_URI, MIME, WIDGET_META, readResource };
