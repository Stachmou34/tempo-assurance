// tempo-var-e.jsx — Variation E · "Plein champ"
// Swiss-poster confidence. Full-bleed deep-green colour field hero, oversized
// Bricolage display knocked out, the duration rendered as a horizontal TIME
// BAR that spans the width. Orange as the single hot accent.
// Responsive via container queries (.tpe).

(function injectE() {
  if (document.getElementById('tpe-styles')) return;
  const s = document.createElement('style');
  s.id = 'tpe-styles';
  s.textContent = `
  .tpe { container-type: inline-size; background: var(--paper); color: var(--ink);
         font-family: 'Schibsted Grotesk', sans-serif; -webkit-font-smoothing: antialiased;
         --field: #134E2A; --field-2: #0F3D21; }
  .tpe * { box-sizing: border-box; }
  .tpe .disp { font-family: 'Bricolage Grotesque', sans-serif; }
  .tpe .mono { font-family: 'JetBrains Mono', monospace; }
  .tpe .wrap { max-width: 1240px; margin: 0 auto; padding: 0 48px; }

  .tpe .btn { display: inline-flex; align-items: center; justify-content: center; gap: 9px; border: none;
              cursor: pointer; font-family: inherit; font-weight: 600; border-radius: 11px; white-space: nowrap;
              transition: transform .08s, background .15s, color .15s, box-shadow .15s; }
  .tpe .btn:active { transform: translateY(1px); }
  .tpe .btn-org { background: var(--orange); color: #fff; box-shadow: 0 10px 24px -10px rgba(242,129,29,.8); }
  .tpe .btn-org:hover { background: #dd7012; }
  .tpe .btn-paper { background: var(--paper); color: var(--field); }
  .tpe .btn-paper:hover { background: #fff; }
  .tpe .btn-line { background: transparent; color: #fff; border: 1.5px solid rgba(255,255,255,.3); }
  .tpe .btn-line:hover { border-color: #fff; }
  .tpe .btn-ink { background: var(--ink); color: #fff; }
  .tpe .btn-ink:hover { background: #000; }
  .tpe .btn-sm { padding: 10px 17px; font-size: 14.5px; }
  .tpe .btn-md { padding: 14px 22px; font-size: 16px; }

  /* FIELD hero */
  .tpe .field { background: var(--field); color: #fff; position: relative; overflow: hidden; }
  .tpe .field .nav { display: flex; align-items: center; gap: 30px; height: 84px; position: relative; z-index: 3; }
  .tpe .field .nav .links { display: flex; gap: 26px; margin-left: 12px; }
  .tpe .field .nav .links a { color: rgba(255,255,255,.7); text-decoration: none; font-size: 15px; font-weight: 500; }
  .tpe .field .nav .links a:hover { color: #fff; }
  .tpe .field .nav .right { margin-left: auto; display: flex; align-items: center; gap: 14px; }

  /* giant numeral watermark */
  .tpe .field .ghost { position: absolute; right: -3%; top: 50%; transform: translateY(-46%); z-index: 0;
     font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 560px; line-height: 1;
     color: rgba(255,255,255,.05); letter-spacing: -0.05em; pointer-events: none; user-select: none; }

  .tpe .field .htop { padding: 36px 0 18px; position: relative; z-index: 2; }
  .tpe .kick { display: inline-flex; align-items: center; gap: 9px; font-family: 'JetBrains Mono', monospace;
               font-size: 12px; letter-spacing: .09em; text-transform: uppercase; color: var(--field);
               background: var(--green-bright); padding: 8px 13px; border-radius: 999px; font-weight: 600; }
  .tpe h1 { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 104px; line-height: .9;
            letter-spacing: -0.045em; margin: 22px 0 0; text-wrap: balance; max-width: 14ch; }
  .tpe h1 .o { color: var(--orange); }
  .tpe .hlede { font-size: 20px; line-height: 1.5; color: rgba(255,255,255,.72); max-width: 46ch; margin: 24px 0 0; }

  /* TIME BAR */
  .tpe .timebar { position: relative; z-index: 2; margin: 44px 0 0; padding: 26px 0 40px; }
  .tpe .tbtop { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 16px; flex-wrap: wrap; }
  .tpe .tbtop .lab { font-family: 'JetBrains Mono', monospace; font-size: 12px; letter-spacing: .08em;
                     text-transform: uppercase; color: rgba(255,255,255,.6); }
  .tpe .tbtop .now { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 22px; letter-spacing: -0.02em; }
  .tpe .tbtop .now .o { color: var(--green-bright); }
  .tpe .bar { position: relative; height: 64px; border-radius: 14px; background: rgba(255,255,255,.1);
              border: 1px solid rgba(255,255,255,.18); overflow: hidden; }
  .tpe .bar .fill { position: absolute; left: 0; top: 0; bottom: 0; background: linear-gradient(90deg, var(--green-bright), var(--orange));
     border-radius: 14px; transition: width .25s cubic-bezier(.2,.7,.3,1); display: flex; align-items: center; justify-content: flex-end; }
  .tpe .bar .knob { width: 6px; height: 40px; background: #fff; border-radius: 3px; margin-right: 10px; box-shadow: 0 0 0 4px rgba(255,255,255,.2); }
  .tpe .bar .gridlines { position: absolute; inset: 0; display: flex; justify-content: space-between; pointer-events: none; }
  .tpe .bar .gridlines i { width: 1px; background: rgba(255,255,255,.12); }
  .tpe input[type=range].tbinput { -webkit-appearance: none; appearance: none; position: absolute; inset: 0; width: 100%;
     height: 100%; margin: 0; background: transparent; cursor: pointer; opacity: 0; z-index: 4; }
  .tpe .scaleticks { display: flex; justify-content: space-between; margin-top: 10px; font-family: 'JetBrains Mono', monospace;
                     font-size: 11px; color: rgba(255,255,255,.5); }

  .tpe .tbfoot { display: grid; grid-template-columns: auto 1fr auto; gap: 22px; align-items: center; margin-top: 26px; }
  .tpe .vehpills { display: flex; gap: 7px; flex-wrap: wrap; }
  .tpe .vp { border: 1.5px solid rgba(255,255,255,.25); background: transparent; color: rgba(255,255,255,.8);
             border-radius: 9px; padding: 9px 13px; font-family: 'JetBrains Mono', monospace; font-size: 12px; font-weight: 600;
             cursor: pointer; transition: all .12s; }
  .tpe .vp.on { background: #fff; color: var(--field); border-color: #fff; }
  .tpe .priceblk { text-align: right; }
  .tpe .priceblk .pl { font-family: 'JetBrains Mono', monospace; font-size: 11px; letter-spacing: .08em;
                       text-transform: uppercase; color: rgba(255,255,255,.55); }
  .tpe .priceblk .pv { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 44px;
                       letter-spacing: -0.03em; line-height: 1; white-space: nowrap; }

  /* sections */
  .tpe section.blk { padding: 90px 0; }
  .tpe .shead { max-width: 680px; margin-bottom: 48px; }
  .tpe .shead .k { font-family: 'JetBrains Mono', monospace; font-size: 12px; letter-spacing: .08em;
                   text-transform: uppercase; color: var(--green); margin-bottom: 14px; }
  .tpe .shead h2 { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 52px; line-height: 1;
                   letter-spacing: -0.035em; margin: 0; text-wrap: balance; }

  /* big color-block features */
  .tpe .blocks { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; }
  .tpe .block { border-radius: 20px; padding: 38px; min-height: 230px; display: flex; flex-direction: column;
                justify-content: space-between; position: relative; overflow: hidden; }
  .tpe .block .bn { font-family: 'JetBrains Mono', monospace; font-size: 12px; letter-spacing: .08em; opacity: .7; }
  .tpe .block h4 { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 30px; letter-spacing: -0.025em;
                   margin: 0 0 10px; line-height: 1.02; }
  .tpe .block p { font-size: 15.5px; line-height: 1.5; margin: 0; }
  .tpe .block.green { background: var(--field); color: #fff; }
  .tpe .block.green p { color: rgba(255,255,255,.72); }
  .tpe .block.orange { background: var(--orange); color: #fff; }
  .tpe .block.orange p { color: rgba(255,255,255,.85); }
  .tpe .block.paper { background: #fff; border: 1px solid var(--line); color: var(--ink); }
  .tpe .block.paper p { color: var(--muted); }
  .tpe .block.ink { background: var(--ink); color: #fff; }
  .tpe .block.ink p { color: rgba(255,255,255,.66); }
  .tpe .block .ic { align-self: flex-start; }

  /* vehicles big type list */
  .tpe .vstack { border-top: 2px solid var(--ink); }
  .tpe .vbig { display: grid; grid-template-columns: 1fr auto auto; gap: 28px; align-items: center; padding: 26px 4px;
               border-bottom: 1px solid var(--line); cursor: pointer; transition: background .14s, padding .14s, color .14s; }
  .tpe .vbig:hover { background: var(--field); color: #fff; padding-left: 22px; padding-right: 22px; border-radius: 4px; }
  .tpe .vbig .vname { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 40px; letter-spacing: -0.03em; }
  .tpe .vbig .vmeta { font-size: 14.5px; color: var(--muted); }
  .tpe .vbig:hover .vmeta { color: rgba(255,255,255,.7); }
  .tpe .vbig .vf { font-family: 'JetBrains Mono', monospace; font-weight: 600; font-size: 15px; color: var(--green); }
  .tpe .vbig:hover .vf { color: var(--green-bright); }

  /* cta */
  .tpe .ctaf { background: var(--orange); color: #fff; border-radius: 24px; padding: 64px; text-align: center; }
  .tpe .ctaf h2 { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 60px; letter-spacing: -0.04em;
                  line-height: .98; margin: 0 0 16px; text-wrap: balance; }
  .tpe .ctaf p { font-size: 18px; color: rgba(255,255,255,.88); margin: 0 auto 30px; max-width: 42ch; }

  /* footer */
  .tpe footer { background: var(--ink); color: rgba(255,255,255,.7); }
  .tpe footer .cols { display: grid; grid-template-columns: 1.6fr 1fr 1fr 1fr; gap: 32px; padding: 60px 0 36px; }
  .tpe footer .fh { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: #fff; margin-bottom: 14px; }
  .tpe footer a { display: block; color: rgba(255,255,255,.6); text-decoration: none; font-size: 14.5px; margin-bottom: 9px; }
  .tpe footer a:hover { color: #fff; }
  .tpe footer .legal { border-top: 1px solid rgba(255,255,255,.12); padding: 20px 0 32px; display: flex;
                       justify-content: space-between; font-size: 13px; flex-wrap: wrap; gap: 8px; }

  @container (max-width: 920px) {
    .tpe .wrap { padding: 0 28px; }
    .tpe .field .nav .links, .tpe .field .nav .right .btn-line { display: none; }
    .tpe .field .ghost { font-size: 360px; right: -10%; opacity: .6; }
    .tpe h1 { font-size: 68px; }
    .tpe .tbfoot { grid-template-columns: 1fr; gap: 18px; }
    .tpe .priceblk { text-align: left; }
    .tpe .blocks { grid-template-columns: 1fr; }
    .tpe .shead h2 { font-size: 40px; }
    .tpe .ctaf h2 { font-size: 44px; }
    .tpe footer .cols { grid-template-columns: 1fr 1fr; }
  }
  @container (max-width: 560px) {
    .tpe .wrap { padding: 0 20px; }
    .tpe .field .ghost { display: none; }
    .tpe h1 { font-size: 52px; }
    .tpe .hlede { font-size: 17px; }
    .tpe .vbig { grid-template-columns: 1fr auto; }
    .tpe .vbig .vmeta { display: none; }
    .tpe .vbig .vname { font-size: 30px; }
    .tpe .ctaf { padding: 36px; }
    .tpe .ctaf h2 { font-size: 36px; }
    .tpe footer .cols { grid-template-columns: 1fr; gap: 24px; }
    .tpe section.blk { padding: 56px 0; }
    .tpe .shead h2 { font-size: 34px; }
  }`;
  document.head.appendChild(s);
})();

function TempoVarE() {
  const [veh, setVeh] = React.useState('vl');
  const [days, setDays] = React.useState(21);
  const v = TEMPO_VEHICLES.find((x) => x.id === veh);
  const total = tempoPrice(v.rate, days);
  const pct = ((days - 1) / 89) * 100;

  return (
    <div className="tpe">
      {/* FIELD HERO */}
      <div className="field">
        <div className="ghost disp">{String(days).padStart(2, '0')}</div>
        <div className="wrap">
          <nav className="nav">
            <Wordmark size={22} tone="light" />
            <div className="links">
              {['Devis', 'Tarifs', 'Véhicules', 'FAQ', 'Espace pro'].map((l) => <a key={l} href="#">{l}</a>)}
            </div>
            <div className="right">
              <button className="btn btn-line btn-sm">Espace pro</button>
              <button className="btn btn-org btn-sm">Mon devis</button>
            </div>
          </nav>

          <div className="htop">
            <span className="kick"><Clock size={14} stroke="var(--field)" /> Assurance 1 → 90 jours</span>
            <h1 className="disp">Le temps<br />que vous <span className="o">voulez.</span></h1>
            <p className="hlede">L'assurance auto temporaire au plus juste : vous réglez la durée, le tarif suit. Attestation éditée à l'instant, sans engagement.</p>
          </div>

          {/* TIME BAR CALCULATOR */}
          <div className="timebar">
            <div className="tbtop">
              <span className="lab">Glissez pour fixer la durée de garantie</span>
              <span className="now disp">{days} jour{days > 1 ? 's' : ''} <span className="o">· {v.code}</span></span>
            </div>
            <div className="bar">
              <div className="gridlines">{Array.from({ length: 12 }).map((_, i) => <i key={i} />)}</div>
              <div className="fill" style={{ width: `calc(${pct}% )` }}><div className="knob"></div></div>
              <input className="tbinput" type="range" min="1" max="90" value={days} onChange={(e) => setDays(+e.target.value)} />
            </div>
            <div className="scaleticks"><span>1 jour</span><span>30 jours</span><span>60 jours</span><span>90 jours</span></div>

            <div className="tbfoot">
              <div className="vehpills">
                {TEMPO_VEHICLES.map((x) => (
                  <button key={x.id} className={'vp' + (x.id === veh ? ' on' : '')} onClick={() => setVeh(x.id)}>{x.code}</button>
                ))}
              </div>
              <div></div>
              <div style={{ display: 'flex', alignItems: 'center', gap: 22 }}>
                <div className="priceblk">
                  <div className="pl">{v.name} · {days} j</div>
                  <div className="pv disp">{tempoEuro(total)}</div>
                </div>
                <button className="btn btn-paper btn-md">Souscrire <ArrowR size={18} /></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* FEATURE BLOCKS */}
      <section className="blk">
        <div className="wrap">
          <div className="shead">
            <div className="k">Pourquoi Tempo</div>
            <h2 className="disp">Quatre raisons d'arrêter le compteur quand vous voulez</h2>
          </div>
          <div className="blocks">
            <div className="block green">
              <div className="ic"><Bolt size={26} stroke="var(--green-bright)" /></div>
              <div><h4 className="disp">Attestation immédiate</h4><p>Éditée et envoyée par e-mail dès le paiement, 24h/24 et 7j/7. Valable sur-le-champ.</p></div>
            </div>
            <div className="block orange">
              <div className="ic"><Clock size={26} stroke="#fff" /></div>
              <div><h4 className="disp">De 1 à 90 jours</h4><p>Vous fixez la durée au jour près. Pas d'abonnement, pas de reconduction tacite.</p></div>
            </div>
            <div className="block paper">
              <div className="ic"><Shield size={26} stroke="var(--green)" /></div>
              <div><h4 className="disp">Garantie RC conforme</h4><p>Responsabilité civile au code des assurances, en France et aux frontières.</p></div>
            </div>
            <div className="block ink">
              <div className="ic"><Check size={24} stroke="var(--green-bright)" /></div>
              <div><h4 className="disp">Les cas qui coincent</h4><p>Permis étranger, plaque de transit, carte grise barrée, import-export : on assure.</p></div>
            </div>
          </div>
        </div>
      </section>

      {/* VEHICLES */}
      <section className="blk" style={{ paddingTop: 0 }}>
        <div className="wrap">
          <div className="shead">
            <div className="k">Véhicules couverts</div>
            <h2 className="disp">Six familles, un tarif net</h2>
          </div>
          <div className="vstack">
            {TEMPO_VEHICLES.map((x) => (
              <div className="vbig" key={x.id}>
                <span className="vname disp">{x.name}</span>
                <span className="vmeta">{x.sub} · code {x.code}</span>
                <span className="vf mono">dès {tempoEuro(tempoPrice(x.rate, 1))}/j</span>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA */}
      <section className="blk" style={{ paddingTop: 0 }}>
        <div className="wrap">
          <div className="ctaf">
            <h2 className="disp">Réglez la durée. Roulez couvert.</h2>
            <p>Votre devis en 30 secondes, votre attestation dans la foulée. Sans engagement.</p>
            <button className="btn btn-ink btn-md">Démarrer mon devis <ArrowR size={18} /></button>
          </div>
        </div>
      </section>

      {/* FOOTER */}
      <footer>
        <div className="wrap">
          <div className="cols">
            <div>
              <Wordmark size={20} tone="light" />
              <p style={{ fontSize: 14.5, lineHeight: 1.5, marginTop: 14, maxWidth: '30ch' }}>
                Assurance automobile temporaire et frontière, de 1 à 90 jours. Édition immédiate, 24h/24.
              </p>
            </div>
            <div><div className="fh">Produits</div>
              <a href="#">Auto temporaire</a><a href="#">Poids lourd</a><a href="#">Camping-car</a><a href="#">Frontière</a></div>
            <div><div className="fh">Aide</div>
              <a href="#">FAQ</a><a href="#">Documentation</a><a href="#">Contact</a><a href="#">Espace pro</a></div>
            <div><div className="fh">Légal</div>
              <a href="#">Mentions légales</a><a href="#">CGV</a><a href="#">Confidentialité</a></div>
          </div>
          <div className="legal">
            <span>© 2026 Tempo-Assurance — JL Assure</span>
            <span className="mono">Garantie RC · CIC · 24/7</span>
          </div>
        </div>
      </footer>
    </div>
  );
}

window.TempoVarE = TempoVarE;
