// tempo-shared.jsx — shared brand tokens, data, pricing, primitives for the
// Tempo-Assurance homepage redesign explorations. Exports to window.

// ── Pricing model (illustrative) ─────────────────────────────
const TEMPO_VEHICLES = [
  { id: 'vl',   name: 'Voiture',      sub: 'VL < 3,5 T',     code: 'VL',  rate: 5.9 },
  { id: 'util', name: 'Utilitaire',   sub: 'Camionnette',    code: 'UT',  rate: 7.2 },
  { id: 'pl',   name: 'Poids lourd',  sub: '> 3,5 T',        code: 'PL',  rate: 12.4 },
  { id: 'cc',   name: 'Camping-car',  sub: 'VASP',           code: 'CC',  rate: 8.4 },
  { id: 'moto', name: 'Moto',         sub: '2 & 3 roues',    code: 'MT',  rate: 4.6 },
  { id: 'rem',  name: 'Remorque',     sub: '& semi-remorque',code: 'RM',  rate: 3.2 },
];

// Simple, legible model: a fixed dossier fee + a per-day rate that tapers a
// little for longer durations. Returns whole euros.
function tempoPrice(rate, days) {
  const d = Math.max(1, Math.min(90, days || 1));
  const taper = d <= 7 ? 1 : d <= 30 ? 0.92 : 0.84;
  return Math.round(14 + rate * d * taper);
}
function tempoEuro(n) {
  return n.toLocaleString('fr-FR') + ' €';
}

// ── Minimal geometric primitives (no illustration; shapes only) ──
function Clock({ size = 22, stroke = 'currentColor', sw = 1.7 }) {
  return (
    <svg width={size} height={size} viewBox="0 0 24 24" fill="none"
      stroke={stroke} strokeWidth={sw} strokeLinecap="round">
      <circle cx="12" cy="12" r="9" />
      <path d="M12 7v5l3.5 2" />
    </svg>
  );
}
function Check({ size = 18, stroke = 'currentColor', sw = 2 }) {
  return (
    <svg width={size} height={size} viewBox="0 0 24 24" fill="none"
      stroke={stroke} strokeWidth={sw} strokeLinecap="round" strokeLinejoin="round">
      <path d="M4 12.5l5 5L20 6" />
    </svg>
  );
}
function ArrowR({ size = 18, stroke = 'currentColor', sw = 2 }) {
  return (
    <svg width={size} height={size} viewBox="0 0 24 24" fill="none"
      stroke={stroke} strokeWidth={sw} strokeLinecap="round" strokeLinejoin="round">
      <path d="M4 12h15M13 6l6 6-6 6" />
    </svg>
  );
}
function Shield({ size = 22, stroke = 'currentColor', sw = 1.7 }) {
  return (
    <svg width={size} height={size} viewBox="0 0 24 24" fill="none"
      stroke={stroke} strokeWidth={sw} strokeLinecap="round" strokeLinejoin="round">
      <path d="M12 3l7 3v5c0 4.4-3 8-7 10-4-2-7-5.6-7-10V6z" />
    </svg>
  );
}
function Bolt({ size = 22, stroke = 'currentColor', sw = 1.7 }) {
  return (
    <svg width={size} height={size} viewBox="0 0 24 24" fill="none"
      stroke={stroke} strokeWidth={sw} strokeLinecap="round" strokeLinejoin="round">
      <path d="M13 3L5 13h6l-1 8 8-10h-6z" />
    </svg>
  );
}

// Striped image placeholder with a monospace caption telling the user what
// real asset belongs here. Honest stand-in — never a fake illustration.
function Placeholder({ label, h = 200, radius = 14, tone = 'green', style = {} }) {
  const ink = tone === 'dark' ? 'rgba(255,255,255,.55)' : 'rgba(22,32,26,.42)';
  const stripeA = tone === 'dark' ? 'rgba(255,255,255,.05)' : 'rgba(22,32,26,.045)';
  const stripeB = tone === 'dark' ? 'rgba(255,255,255,.02)' : 'rgba(22,32,26,.015)';
  return (
    <div style={{
      height: h, borderRadius: radius, position: 'relative', overflow: 'hidden',
      background: `repeating-linear-gradient(135deg, ${stripeA} 0 12px, ${stripeB} 12px 24px)`,
      border: tone === 'dark' ? '1px solid rgba(255,255,255,.08)' : '1px solid rgba(22,32,26,.08)',
      display: 'flex', alignItems: 'center', justifyContent: 'center', ...style,
    }}>
      <span style={{
        fontFamily: "'JetBrains Mono', monospace", fontSize: 12, letterSpacing: '0.04em',
        color: ink, textAlign: 'center', padding: '0 14px',
      }}>{label}</span>
    </div>
  );
}

// Brand wordmark rendered in type (logo is orange→green TEMPO + script
// "Assurance"). Using the real PNG would lock the dated treatment; this is a
// cleaner type-built lockup in brand colors.
function Wordmark({ size = 22, tone = 'ink' }) {
  const main = tone === 'light' ? '#fff' : 'var(--ink)';
  return (
    <span style={{ display: 'inline-flex', alignItems: 'baseline', gap: 7, fontFamily: "'Schibsted Grotesk', sans-serif" }}>
      <span style={{ fontWeight: 800, fontSize: size, letterSpacing: '-0.03em', color: main, lineHeight: 1 }}>
        tempo<span style={{ color: 'var(--green)' }}>.</span>
      </span>
      <span style={{ fontWeight: 500, fontSize: size * 0.62, color: tone === 'light' ? 'rgba(255,255,255,.7)' : 'var(--muted)', letterSpacing: '0.02em' }}>
        assurance
      </span>
    </span>
  );
}

Object.assign(window, {
  TEMPO_VEHICLES, tempoPrice, tempoEuro,
  Clock, Check, ArrowR, Shield, Bolt, Placeholder, Wordmark,
});
