/* tempo-assurance.com — JS du site (vanilla, sans dépendance) */
(function () {
  'use strict';

  /* ---------- Menu mobile (tiroir) ---------- */
  var toggle = document.querySelector('.menu-toggle');
  var nav = document.querySelector('.nav');
  var overlay = document.querySelector('.nav-overlay');
  var closeBtn = document.querySelector('.nav-close');

  function openNav() {
    nav.classList.add('open');
    if (overlay) overlay.classList.add('show');
    document.body.classList.add('no-scroll');
  }
  function closeNav() {
    nav.classList.remove('open');
    if (overlay) overlay.classList.remove('show');
    document.body.classList.remove('no-scroll');
  }
  if (toggle && nav) {
    toggle.addEventListener('click', openNav);
    if (closeBtn) closeBtn.addEventListener('click', closeNav);
    if (overlay) overlay.addEventListener('click', closeNav);
  }

  /* ---------- Modale tarificateur ---------- */
  var modal = document.getElementById('modal-souscription');
  var modalClose = document.getElementById('btn-fermer-modal');

  function openModal() {
    if (!modal) return;
    var frame = modal.querySelector('iframe[data-src]');
    if (frame && !frame.src) frame.src = frame.getAttribute('data-src');
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('no-scroll');
  }
  function closeModal() {
    if (!modal) return;
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('no-scroll');
  }
  if (modal) {
    if (modalClose) modalClose.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { closeModal(); closeNav(); }
    });
  }

  /* ---------- Clic souscription : ouverture + mesure ---------- */
  document.addEventListener('click', function (e) {
    var b = e.target.closest ? e.target.closest('.cta-btn-modal') : null;
    if (!b) return;
    e.preventDefault();
    openModal();
    var label = (b.textContent || '').replace(/\s+/g, ' ').trim().slice(0, 80);
    if (typeof window.gtag === 'function') {
      window.gtag('event', 'ouverture_tarificateur', { bouton: label, page_path: location.pathname });
    }
    if (typeof window.clarity === 'function') {
      try { window.clarity('event', 'ouverture_tarificateur'); window.clarity('set', 'tarificateur', 'ouvert'); } catch (_) {}
    }
  }, true);
})();
