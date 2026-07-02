'use strict';
/* Client de l'API tarif jlassure (server-to-server).
   POST https://www.jlassure.com/sousfiche/api_tarif_tempo.php
   Header : Authorization: Bearer <CLÉ_API>  (clé via env JLASSURE_API_KEY)
   Entrée (sans données perso) : categorie_vehi, age_vehicule, puissance,
     pays_immatriculation, pays_residence, age_conducteur|date_naissance, duree?
   Sortie : prix_vente, durees, prefill_url, hors_perimetre */

const ENDPOINT = 'https://www.jlassure.com/sousfiche/api_tarif_tempo.php';
const SESSION_ENDPOINT = 'https://www.jlassure.com/sousfiche/api_prefill_session.php';
const API_KEYS = ['categorie_vehi', 'age_vehicule', 'puissance',
  'pays_immatriculation', 'pays_residence', 'age_conducteur', 'date_naissance', 'duree'];

function apiInput(profil) {
  const o = {};
  API_KEYS.forEach(function (k) {
    const v = profil[k];
    if (v !== undefined && v !== null && v !== '') o[k] = v;
  });
  return o;
}

/* Renvoie { ok, data } ou { ok:false, reason }. Jamais d'exception : l'appelant
   bascule sur la grille indicative en cas d'échec. fetchImpl/apiKey injectables
   pour les tests. */
async function fetchTarif(profil, opts) {
  opts = opts || {};
  const apiKey = opts.apiKey || process.env.JLASSURE_API_KEY;
  if (!apiKey) return { ok: false, reason: 'no_api_key' };
  const f = opts.fetchImpl || (typeof fetch === 'function' ? fetch : null);
  if (!f) return { ok: false, reason: 'no_fetch' };
  /* Timeout anti-blocage : si l'API ne répond pas à temps, on bascule en
     indicatif plutôt que de faire patienter ChatGPT. */
  const controller = (typeof AbortController === 'function') ? new AbortController() : null;
  const timer = controller ? setTimeout(function () { controller.abort(); }, opts.timeoutMs || 8000) : null;
  try {
    const res = await f(ENDPOINT, {
      method: 'POST',
      /* JL Assure recommande X-Api-Key ; on envoie aussi Authorization: Bearer
         en doublon pour rester compatible avec les deux schémas. */
      headers: {
        'Content-Type': 'application/json',
        'X-Api-Key': apiKey,
        'Authorization': 'Bearer ' + apiKey
      },
      body: JSON.stringify(apiInput(profil)),
      signal: controller ? controller.signal : undefined
    });
    if (!res.ok) return { ok: false, reason: 'http_' + res.status };
    const data = await res.json();
    return { ok: true, data: data };
  } catch (e) {
    return { ok: false, reason: 'exception:' + e.message };
  } finally {
    if (timer) clearTimeout(timer);
  }
}

/* Crée une session de pré-remplissage sécurisée (données personnelles).
   POST api_prefill_session.php (X-Api-Key). Renvoie token + session_url.
   Aucune donnée perso dans l'URL renvoyée (seulement cd/id/adrsite/prefill_token). */
async function createPrefillSession(payload, opts) {
  opts = opts || {};
  const apiKey = opts.apiKey || process.env.JLASSURE_API_KEY;
  if (!apiKey) return { ok: false, reason: 'no_api_key' };
  const f = opts.fetchImpl || (typeof fetch === 'function' ? fetch : null);
  if (!f) return { ok: false, reason: 'no_fetch' };
  const controller = (typeof AbortController === 'function') ? new AbortController() : null;
  const timer = controller ? setTimeout(function () { controller.abort(); }, opts.timeoutMs || 10000) : null;
  try {
    const res = await f(SESSION_ENDPOINT, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-Api-Key': apiKey,
        'Authorization': 'Bearer ' + apiKey
      },
      body: JSON.stringify(payload),
      signal: controller ? controller.signal : undefined
    });
    let data = null;
    try { data = await res.json(); } catch (_) {}
    return { ok: res.ok, status: res.status, data: data };
  } catch (e) {
    return { ok: false, reason: 'exception:' + e.message };
  } finally {
    if (timer) clearTimeout(timer);
  }
}

/* --- Phase 2bis : transmission des pièces (permis / carte grise) --- */

const DOCS_ENDPOINT = 'https://www.jlassure.com/sousfiche/api_prefill_docs.php';
const MAX_DOC_BYTES = 10 * 1024 * 1024; /* 10 Mo max par fichier (limite JL Assure) */

/* Télécharge une pièce depuis l'URL temporaire fournie par ChatGPT (openai/fileParams).
   Renvoie { ok, bytes, mimeType } ou { ok:false, reason }. Transit éphémère : rien n'est
   écrit sur disque, le buffer est transmis puis abandonné. */
async function downloadDocument(url, opts) {
  opts = opts || {};
  const f = opts.fetchImpl || (typeof fetch === 'function' ? fetch : null);
  if (!f) return { ok: false, reason: 'no_fetch' };
  const controller = (typeof AbortController === 'function') ? new AbortController() : null;
  const timer = controller ? setTimeout(function () { controller.abort(); }, opts.timeoutMs || 20000) : null;
  try {
    const res = await f(url, { signal: controller ? controller.signal : undefined });
    if (!res.ok) return { ok: false, reason: 'http_' + res.status };
    const buf = await res.arrayBuffer();
    if (buf.byteLength > MAX_DOC_BYTES) return { ok: false, reason: 'file_too_large' };
    if (buf.byteLength === 0) return { ok: false, reason: 'empty_file' };
    return { ok: true, bytes: buf, mimeType: res.headers && res.headers.get ? (res.headers.get('content-type') || null) : null };
  } catch (e) {
    return { ok: false, reason: 'exception:' + e.message };
  } finally {
    if (timer) clearTimeout(timer);
  }
}

/* Joint les pièces au dossier de la session (multipart/form-data).
   files : [{ field: 'permis'|'carte_grise'|'permis_verso'|'carte_grise_verso',
              bytes: ArrayBuffer, filename, mimeType }]
   Renvoie { ok, status, data } (200 succès, 207 partiel, 4xx/5xx erreurs — voir doc JL Assure). */
async function uploadPrefillDocs(prefillToken, files, opts) {
  opts = opts || {};
  const apiKey = opts.apiKey || process.env.JLASSURE_API_KEY;
  if (!apiKey) return { ok: false, reason: 'no_api_key' };
  const f = opts.fetchImpl || (typeof fetch === 'function' ? fetch : null);
  if (!f) return { ok: false, reason: 'no_fetch' };
  if (typeof FormData !== 'function' || typeof Blob !== 'function') return { ok: false, reason: 'no_formdata' };
  const fd = new FormData();
  fd.append('prefill_token', prefillToken);
  files.forEach(function (doc) {
    fd.append(doc.field, new Blob([doc.bytes], { type: doc.mimeType || 'application/octet-stream' }),
      doc.filename || (doc.field + '.jpg'));
  });
  const controller = (typeof AbortController === 'function') ? new AbortController() : null;
  const timer = controller ? setTimeout(function () { controller.abort(); }, opts.timeoutMs || 30000) : null;
  try {
    const res = await f(DOCS_ENDPOINT, {
      method: 'POST',
      /* Pas de Content-Type manuel : fetch pose le boundary multipart lui-même */
      headers: { 'X-Api-Key': apiKey, 'Authorization': 'Bearer ' + apiKey },
      body: fd,
      signal: controller ? controller.signal : undefined
    });
    let data = null;
    try { data = await res.json(); } catch (_) {}
    return { ok: res.ok, status: res.status, data: data };
  } catch (e) {
    return { ok: false, reason: 'exception:' + e.message };
  } finally {
    if (timer) clearTimeout(timer);
  }
}

module.exports = { ENDPOINT, SESSION_ENDPOINT, DOCS_ENDPOINT, MAX_DOC_BYTES,
  apiInput, fetchTarif, createPrefillSession, downloadDocument, uploadPrefillDocs };
