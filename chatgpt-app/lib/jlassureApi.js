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

module.exports = { ENDPOINT, SESSION_ENDPOINT, apiInput, fetchTarif, createPrefillSession };
