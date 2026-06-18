'use strict';
/* Client de l'API tarif jlassure (server-to-server).
   POST https://www.jlassure.com/sousfiche/api_tarif_tempo.php
   Header : Authorization: Bearer <CLÉ_API>  (clé via env JLASSURE_API_KEY)
   Entrée (sans données perso) : categorie_vehi, age_vehicule, puissance,
     pays_immatriculation, pays_residence, age_conducteur|date_naissance, duree?
   Sortie : prix_vente, durees, prefill_url, hors_perimetre */

const ENDPOINT = 'https://www.jlassure.com/sousfiche/api_tarif_tempo.php';
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
      body: JSON.stringify(apiInput(profil))
    });
    if (!res.ok) return { ok: false, reason: 'http_' + res.status };
    const data = await res.json();
    return { ok: true, data: data };
  } catch (e) {
    return { ok: false, reason: 'exception:' + e.message };
  }
}

module.exports = { ENDPOINT, apiInput, fetchTarif };
