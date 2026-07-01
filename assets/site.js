/* tempo-assurance.com — JS du site (vanilla, sans dépendance) */
(function () {
  'use strict';

  /* ---------- Pré-remplissage du tarificateur via paramètres d'URL ---------- */
  /* Les paramètres sont validés côté JL Assure ; ici on se contente de relayer
     une liste blanche vers le tarificateur (page devis + modale). */
  var PREFILL_KEYS = ['categorie_vehi', 'age_vehicule', 'puissance',
    'pays_immatriculation', 'pays_residence', 'date_naissance',
    'duree', 'date_debut', 'heure_debut'];
  function prefillQuery() {
    var sp;
    try { sp = new URLSearchParams(location.search); } catch (_) { return ''; }
    var out = [];
    PREFILL_KEYS.forEach(function (k) {
      var v = sp.get(k);
      /* v peut valoir "0" (ex. puissance=0 pour une remorque) : ne rejeter que null/vide */
      if (v !== null && v !== '') out.push(k + '=' + encodeURIComponent(v));
    });
    /* Heure de début par défaut : si une date de début est fournie sans heure,
       on propose l'heure courante + 15 min (le client peut la modifier). */
    if (sp.get('date_debut') && !sp.get('heure_debut')) {
      var d = new Date(Date.now() + 15 * 60000);
      var hh = ('0' + d.getHours()).slice(-2), mm = ('0' + d.getMinutes()).slice(-2);
      out.push('heure_debut=' + encodeURIComponent(hh + ':' + mm));
    }
    return out.join('&');
  }
  function withPrefill(url) {
    var q = prefillQuery();
    if (!q || !url) return url;
    return url + (url.indexOf('?') > -1 ? '&' : '?') + q;
  }

  /* ---------- Menu mobile (tiroir) ---------- */
  var toggle = document.querySelector('.menu-toggle');
  var nav = document.querySelector('.nav');
  var overlay = document.querySelector('.nav-overlay');
  var closeBtn = document.querySelector('.nav-close');

  function openNav() {
    nav.classList.add('open');
    if (overlay) overlay.classList.add('show');
    document.body.classList.add('no-scroll');
    if (toggle) toggle.setAttribute('aria-expanded', 'true');
    if (closeBtn) closeBtn.focus();
  }
  function closeNav() {
    if (!nav) return;
    nav.classList.remove('open');
    if (overlay) overlay.classList.remove('show');
    document.body.classList.remove('no-scroll');
    if (toggle) { toggle.setAttribute('aria-expanded', 'false'); }
  }
  if (toggle && nav) {
    toggle.addEventListener('click', openNav);
    if (closeBtn) closeBtn.addEventListener('click', closeNav);
    if (overlay) overlay.addEventListener('click', closeNav);
  }

  /* ---------- Modale tarificateur ---------- */
  var modal = document.getElementById('modal-souscription');
  var modalClose = document.getElementById('btn-fermer-modal');
  var lastModalFocus = null;

  function openModal(extra) {
    if (!modal) return;
    lastModalFocus = document.activeElement;
    var frame = modal.querySelector('iframe[data-src]');
    if (frame && !frame.src) {
      var url = withPrefill(frame.getAttribute('data-src'));
      /* pré-remplissage propre à un bouton (ex. data-prefill="categorie_vehi=VL-VU") */
      if (extra) url += (url.indexOf('?') > -1 ? '&' : '?') + extra;
      frame.src = url;
    }
    /* Démarrer l'iframe COMPACTE (avant que jlassure mesure sa hauteur) :
       le contenu remplit l'iframe, donc une iframe petite => hauteur compacte
       postée par jlassure, puis ça grandit selon l'étape. */
    if (frame) {
      var c = modal.querySelector('.modal-content');
      var bd = modal.querySelector('.modal-body');
      if (c) { c.style.height = 'auto'; c.style.maxHeight = '92vh'; }
      if (bd) { bd.style.overflow = 'auto'; bd.style.minHeight = '0'; }
      frame.style.transition = 'height .25s ease';
      frame.style.height = '420px';
    }
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('no-scroll');
    if (modalClose) modalClose.focus(); /* focus initial dans la modale */
  }
  function closeModal() {
    if (!modal) return;
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('no-scroll');
    if (lastModalFocus && lastModalFocus.focus) { lastModalFocus.focus(); lastModalFocus = null; } /* restaure le focus sur le déclencheur */
  }
  if (modal) {
    if (modalClose) modalClose.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
    /* piège du focus : Tab/Shift+Tab bouclent dans la modale */
    modal.addEventListener('keydown', function (e) {
      if (e.key !== 'Tab' || !modal.classList.contains('show')) return;
      var f = modal.querySelectorAll('button, a[href], iframe, input, select, textarea, [tabindex]:not([tabindex="-1"])');
      if (!f.length) return;
      var first = f[0], last = f[f.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { closeModal(); closeNav(); }
    });
  }

  /* ---------- Tarificateur inline (page devis) : relaie les paramètres d'URL ---------- */
  (function () {
    var inline = document.querySelector('iframe.quote-frame');
    if (!inline) return;
    if (!prefillQuery()) return; /* aucun pré-remplissage demandé : on garde le chargement initial */
    inline.setAttribute('src', withPrefill(inline.getAttribute('src')));
  })();

  /* ---------- Tarificateur inline : redimensionnement dynamique ---------- */
  /* jlassure poste sa hauteur via postMessage ; on l'applique (transition douce).
     PAS de hauteur de départ imposée + anti-rebond → aucun "saut" à l'ouverture. */
  (function () {
    var f = document.querySelector('iframe.quote-frame');
    if (!f) return;
    f.style.transition = 'height .25s ease';
    var t;
    window.addEventListener('message', function (e) {
      if (e.origin !== 'https://www.jlassure.com') return;
      var h = Number(e.data);
      if (isNaN(h) || h < 200) return;
      clearTimeout(t);
      t = setTimeout(function () { f.style.height = h + 'px'; }, 250);
    }, false);
  })();

  /* ---------- Tarificateur en modale : redimensionnement dynamique ---------- */
  /* Même principe pour la modale : on ajuste sa hauteur à celle postée par
     jlassure, plafonnée à 92vh (scroll au-delà) pour ne pas déborder. */
  (function () {
    var modalEl = document.getElementById('modal-souscription');
    if (!modalEl) return;
    var content = modalEl.querySelector('.modal-content');
    var body = modalEl.querySelector('.modal-body');
    var frame = modalEl.querySelector('iframe');
    if (!content || !frame) return;
    frame.style.transition = 'height .25s ease';
    if (body) { body.style.overflow = 'auto'; body.style.minHeight = '0'; }
    var t;
    window.addEventListener('message', function (e) {
      if (e.origin !== 'https://www.jlassure.com') return;
      if (!modalEl.classList.contains('show')) return; /* seulement modale ouverte */
      var h = Number(e.data);
      if (isNaN(h) || h < 200) return;
      clearTimeout(t);
      t = setTimeout(function () {
        content.style.height = 'auto';
        content.style.maxHeight = '92vh';
        frame.style.height = h + 'px';
      }, 250);
    }, false);
  })();

  /* ---------- Clic souscription : ouverture + mesure ---------- */
  document.addEventListener('click', function (e) {
    if (!modal) return; /* page sans modale : ne pas neutraliser le bouton ni fausser la mesure */
    var b = e.target.closest ? e.target.closest('.cta-btn-modal') : null;
    if (!b) return;
    e.preventDefault();
    openModal(b.getAttribute('data-prefill'));
    var label = (b.textContent || '').replace(/\s+/g, ' ').trim().slice(0, 80);
    if (typeof window.gtag === 'function') {
      window.gtag('event', 'ouverture_tarificateur', { bouton: label, page_path: location.pathname });
    }
    if (typeof window.clarity === 'function') {
      try { window.clarity('event', 'ouverture_tarificateur'); window.clarity('set', 'tarificateur', 'ouvert'); } catch (_) {}
    }
  }, true);

  /* ---------- WebMCP : outils pour agents IA (expérimental) ---------- */
  /* Expose des « outils » que les agents IA compatibles WebMCP peuvent appeler
     directement via navigator.modelContext (équivalent de MCP, mais dans le
     navigateur). L'API est encore expérimentale et son contour peut évoluer :
     tout est encapsulé dans des gardes (feature-detection + try/catch) pour ne
     JAMAIS casser la page si l'API est absente ou différente.
     Conformité : ces outils ne font que préparer (lien de devis, pré-remplissage
     du formulaire). Aucune souscription, aucun paiement, aucun envoi n'est
     effectué sans l'action explicite du visiteur. */
  (function registerWebMCP() {
    var mc = navigator.modelContext;
    if (!mc || typeof mc.registerTool !== 'function') return;

    var DEVIS_URL = 'https://www.tempo-assurance.com/devis-ou-souscription.html';
    function txt(s) { return { content: [{ type: 'text', text: s }] }; }

    /* Construit l'URL de devis pré-rempli à partir d'un objet de paramètres
       (même liste blanche que le relais d'URL ci-dessus). */
    function buildDevisUrl(params) {
      params = params || {};
      var out = [];
      PREFILL_KEYS.forEach(function (k) {
        var v = params[k];
        if (v === undefined || v === null || v === '') return;
        out.push(k + '=' + encodeURIComponent(String(v)));
      });
      return out.length ? DEVIS_URL + '?' + out.join('&') : DEVIS_URL;
    }

    /* Outil 1 — préparer un devis pré-rempli (disponible sur toutes les pages). */
    try {
      mc.registerTool({
        name: 'preparer_devis_temporaire',
        description: "Prépare un devis d'assurance auto temporaire (1 à 90 jours) sur " +
          "tempo-assurance.com. Renvoie une URL de devis pré-remplie d'après le profil " +
          "fourni (tous les champs sont optionnels ; pour afficher un tarif, fournir au " +
          "minimum categorie_vehi, age_vehicule, puissance, pays_immatriculation, " +
          "pays_residence et date_naissance). Le visiteur vérifie les informations, " +
          "consulte l'IPID, confirme et règle lui-même : aucune souscription n'est finalisée par l'outil.",
        inputSchema: {
          type: 'object',
          additionalProperties: false,
          properties: {
            categorie_vehi: { type: 'string',
              enum: ['VL-VL', 'VL-VU', 'VSP-VSP', 'QM-QM', 'QMQLEM-QMQLEM', 'CC-Cap', 'CAM-Fou', 'CAM-CAM3', 'TRA-TRA', 'TCP-TCP', 'REM-REM2', 'REM-REM3'],
              description: 'Catégorie : VL-VL voiture · VL-VU utilitaire · VSP-VSP voiturette sans permis · QM-QM quad · QMQLEM-QMQLEM buggy sans permis · CC-Cap camping-car ≤3,5 t · CAM-Fou camping-car >3,5 t · CAM-CAM3 camion/poids lourd >3,5 t · TRA-TRA tracteur agricole · TCP-TCP bus/car · REM-REM2 remorque/semi-remorque · REM-REM3 caravane' },
            age_vehicule: { type: 'string', enum: ['moins10', 'plus10'], description: 'Âge du véhicule : moins10 (<10 ans) ou plus10' },
            puissance: { type: 'string', enum: ['inf30', 'sup30', '0'], description: 'Puissance : inf30 (≤30 CV) · sup30 (>30 CV) · 0 (remorque/caravane)' },
            pays_immatriculation: { type: 'string', description: "Pays d'immatriculation en MAJUSCULES (ex. FRANCE METROPOLITAINE, FRANCE REUNION). Pologne, Roumanie et Italie exclues." },
            pays_residence: { type: 'string', description: 'Pays de résidence du conducteur, en MAJUSCULES' },
            date_naissance: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$', description: 'Date de naissance AAAA-MM-JJ (conducteur de 21 à 90 ans)' },
            duree: { type: 'integer', minimum: 1, maximum: 90, description: 'Durée en jours (1 à 90) ; doit exister dans la grille du profil, sinon ignorée' },
            date_debut: { type: 'string', pattern: '^\\d{4}-\\d{2}-\\d{2}$', description: "Date de début AAAA-MM-JJ (≥ aujourd'hui)" },
            heure_debut: { type: 'string', pattern: '^\\d{2}:\\d{2}$', description: 'Heure de début HH:MM' }
          }
        },
        execute: function (params) {
          var url = buildDevisUrl(params);
          return Promise.resolve(txt(
            'Devis pré-rempli prêt : ' + url + '\n' +
            "Ouvrir cette URL affiche le tarificateur déjà rempli. Le visiteur vérifie les " +
            "informations, consulte l'IPID, confirme et règle par carte bancaire — aucune " +
            "souscription n'est finalisée sans son action."
          ));
        }
      });
    } catch (_) {}

    /* Outil 2 — pré-remplir le formulaire de contact (seulement si présent). */
    var form = document.getElementById('form-contact');
    if (form) {
      try {
        mc.registerTool({
          name: 'preparer_message_contact',
          description: "Pré-remplit le formulaire de contact de tempo-assurance.com. " +
            "N'envoie PAS le message : le visiteur doit répondre à la question anti-spam et " +
            "cliquer sur « Envoyer » lui-même.",
          inputSchema: {
            type: 'object',
            additionalProperties: false,
            properties: {
              nom: { type: 'string', maxLength: 120, description: 'Nom du visiteur' },
              email: { type: 'string', format: 'email', maxLength: 160, description: 'Adresse e-mail' },
              telephone: { type: 'string', maxLength: 30, description: 'Numéro de téléphone (optionnel)' },
              message: { type: 'string', maxLength: 5000, description: 'Contenu du message' }
            }
          },
          execute: function (p) {
            p = p || {};
            function set(name, val) {
              var el = form.elements[name];
              if (el && val !== undefined && val !== null) el.value = String(val);
            }
            set('nom', p.nom); set('email', p.email);
            set('telephone', p.telephone); set('message', p.message);
            return Promise.resolve(txt(
              'Formulaire de contact pré-rempli. Le visiteur doit répondre à la question ' +
              'anti-spam puis cliquer sur « Envoyer » pour transmettre le message.'
            ));
          }
        });
      } catch (_) {}
    }
  })();
})();
