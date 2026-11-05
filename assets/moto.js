/* Questionnaire assurance moto (assurance-moto.html).
   Six étapes dans l'ordre des écrans APRIL Moto, contrôles à la sortie de chaque
   champ et au clic sur « Continuer », règles d'éligibilité du cahier des charges.
   Les mêmes contrôles sont refaits côté serveur (moto-form.php). */
(function () {
  "use strict";
  var form = document.getElementById("form-moto");
  if (!form) return;

  var STEPS = 6;
  var step = 1;
  var steps = form.querySelectorAll(".moto-step");
  var bar = document.getElementById("moto-bar");
  var count = document.getElementById("moto-count");
  var back = document.getElementById("moto-back");
  var next = document.getElementById("moto-next");
  var send = document.getElementById("moto-send");
  var stopBox = document.getElementById("moto-stop");
  var stopText = document.getElementById("moto-stop-texte");
  var statut = document.getElementById("m-statut");
  var motif = document.getElementById("m-motif");
  var horsCriteres = false;

  function $(id) { return document.getElementById(id); }
  function val(name) {
    var el = form.elements[name];
    if (!el) return "";
    if (el.length !== undefined && !el.tagName) {
      for (var i = 0; i < el.length; i++) if (el[i].checked) return el[i].value;
      return "";
    }
    return el.type === "checkbox" ? (el.checked ? el.value : "") : el.value.trim();
  }
  function track(nom, params) {
    if (typeof window.gtag === "function") window.gtag("event", nom, params || {});
  }

  /* ----- Listes ----- */
  var cyl = $("m-cylindree");
  [50, 80, 110, 125, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650, 700, 750, 800, 850, 900, 950, 1000,
    1100, 1200, 1250, 1300, 1400, 1500, 1600, 1700, 1800, 1900].forEach(function (c) {
    var o = document.createElement("option");
    o.value = String(c);
    o.textContent = (c === 1900 ? "1900 et plus" : String(c)) + " cm3";
    cyl.appendChild(o);
  });
  var COEFS = ["0,50", "0,51", "0,53", "0,54", "0,57", "0,60", "0,63", "0,64", "0,66", "0,68", "0,70", "0,72",
    "0,76", "0,80", "0,85", "0,90", "0,95", "1,00", "1,06", "1,12", "1,18", "1,25", "1,32", "1,40", "1,56", "1,95", "2,44", "3,05", "3,50"];
  form.querySelectorAll("[data-bonus]").forEach(function (sel) {
    var o0 = document.createElement("option");
    o0.value = ""; o0.textContent = "Choisir";
    sel.appendChild(o0);
    COEFS.forEach(function (c) {
      var n = parseFloat(c.replace(",", "."));
      var o = document.createElement("option");
      o.value = c;
      if (n < 1) o.textContent = c + " soit " + Math.round((1 - n) * 100) + " % de bonus";
      else if (n === 1) o.textContent = "1,00 (ni bonus ni malus)";
      else o.textContent = c + " soit " + Math.round((n - 1) * 100) + " % de malus";
      sel.appendChild(o);
    });
    var on = document.createElement("option");
    on.value = "Jamais assuré"; on.textContent = "Jamais assuré à mon nom";
    sel.appendChild(on);
  });

  /* ----- Dates JJ/MM/AAAA ----- */
  function parseDate(s) {
    var m = /^(\d{2})\/(\d{2})\/(\d{4})$/.exec(s || "");
    if (!m) return null;
    var d = new Date(+m[3], +m[2] - 1, +m[1]);
    if (d.getFullYear() !== +m[3] || d.getMonth() !== +m[2] - 1 || d.getDate() !== +m[1]) return null;
    return d;
  }
  function today() { var d = new Date(); d.setHours(0, 0, 0, 0); return d; }
  function fmt(d) {
    return ("0" + d.getDate()).slice(-2) + "/" + ("0" + (d.getMonth() + 1)).slice(-2) + "/" + d.getFullYear();
  }
  function addYears(d, n) { var x = new Date(d); x.setFullYear(x.getFullYear() + n); return x; }
  form.querySelectorAll("[data-date]").forEach(function (el) {
    el.addEventListener("input", function () {
      var v = el.value.replace(/\D/g, "").slice(0, 8);
      if (v.length > 4) v = v.slice(0, 2) + "/" + v.slice(2, 4) + "/" + v.slice(4);
      else if (v.length > 2) v = v.slice(0, 2) + "/" + v.slice(2);
      el.value = v;
    });
  });

  /* AB123CD, ab-123-cd -> AB-123-CD (format SIV) ; l'ancien format FNI est laissé tel quel */
  function normImmat(v) {
    var x = (v || "").toUpperCase().replace(/\s+/g, "");
    var m = /^([A-Z]{2})-?(\d{3})-?([A-Z]{2})$/.exec(x);
    return m ? m[1] + "-" + m[2] + "-" + m[3] : (v || "").toUpperCase().trim();
  }

  /* ----- Messages d'erreur sous les champs ----- */
  function setError(el, msg) {
    var box = el.closest(".form-row, .moto-yn, .moto-permis-row, .moto-sinistre") || el.parentNode;
    var key = el.type === "radio" ? el.name : (el.id || el.name);
    var p = null;
    box.querySelectorAll(".moto-err").forEach(function (x) { if (x.getAttribute("data-for") === key) p = x; });
    if (!msg) {
      if (p) p.remove();
      el.removeAttribute("aria-invalid");
      return true;
    }
    if (!p) {
      p = document.createElement("p");
      p.className = "moto-err";
      p.setAttribute("data-for", key);
      box.appendChild(p);
    }
    p.textContent = msg;
    el.setAttribute("aria-invalid", "true");
    return false;
  }

  /* ----- Règles par champ ----- */
  function visible(el) { return !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length); }

  function checkField(el) {
    if (!visible(el) && el.type !== "radio") return setError(el, "");
    var v = el.value.trim();
    if (el.type === "radio") {
      var group = form.elements[el.name];
      var shown = false;
      for (var i = 0; i < group.length; i++) if (visible(group[i])) shown = true;
      if (!shown) return setError(el, "");
      var ok = val(el.name) !== "";
      var req = el.hasAttribute("required") || el.closest("[data-req]") || group[0].hasAttribute("required");
      return setError(group[0], ok || !req ? "" : "Ce champ est obligatoire");
    }
    if (el.type === "checkbox") {
      return setError(el, el.required && !el.checked ? "Cette case est obligatoire" : "");
    }
    if (el.required && !v) return setError(el, "Ce champ est obligatoire");
    if (!v) return setError(el, "");
    if (el.hasAttribute("data-date")) {
      var d = parseDate(v);
      if (!d) return setError(el, "Date au format JJ/MM/AAAA");
      if (el.name !== "date_effet" && d > today()) return setError(el, "Cette date ne peut pas être dans le futur");
    }
    if (el.pattern && !new RegExp("^" + el.pattern + "$").test(v)) return setError(el, "Format attendu : 5 chiffres");
    if (el.type === "email" && !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v)) return setError(el, "Adresse e-mail invalide");
    if (el.hasAttribute("data-nom") && !/^[A-Za-zÀ-ÖØ-öø-ÿ' -]+$/.test(v)) return setError(el, "Lettres, espaces, tirets et apostrophes uniquement");
    return setError(el, "");
  }

  function checkAcquisition() {
    var mec = parseDate($("m-mec").value), acq = parseDate($("m-acq").value);
    if (mec && acq && acq < mec) return setError($("m-acq"), "La date d'acquisition ne peut pas précéder la 1re mise en circulation");
    if (acq) checkField($("m-acq"));
    return true;
  }

  /* 8. Cohérence bonus / ancienneté du permis : depuis 1,00, le coefficient baisse de 5 %
     par an (tronqué au centième) et plafonne à 0,50, atteint au bout de 13 ans. */
  function anneesPourCoef(c) {
    var x = 1, n = 0;
    while (x > c + 1e-9 && n < 40) { x = Math.max(0.5, Math.floor(x * 0.95 * 100 + 1e-9) / 100); n++; }
    return n;
  }
  function anneesDepuis(d) { return (today() - d) / (365.25 * 86400000); }
  function checkCoherenceBonus() {
    var ok = true;
    [["2r", ["AM", "A1", "A2", "A", "B"], "bonus_2roues_3ans", "d'un permis 2-roues (ou B)"],
     ["auto", ["B"], "bonus_auto_3ans", "du permis B"]].forEach(function (r) {
      var sel = $("m-bonus-" + r[0]);
      var c = parseFloat((sel.value || "").replace(",", "."));
      if (isNaN(c) || c >= 1) return;
      var plusAncien = null;
      r[1].forEach(function (p) {
        var cb = form.querySelector("[data-permis][value=" + p + "]");
        var d = cb && cb.checked ? parseDate(form.elements["date_permis_" + p].value) : null;
        if (d && (!plusAncien || d < plusAncien)) plusAncien = d;
      });
      if (!plusAncien) return;
      var besoin = anneesPourCoef(c) + (c === 0.5 && val(r[2]) === "Oui" ? 3 : 0);
      if (anneesDepuis(plusAncien) < besoin)
        ok = setError(sel, "Un coefficient de " + sel.value + " demande au moins " + besoin + " ans d'assurance sans sinistre responsable : vérifiez le coefficient ou la date " + r[3]) && ok;
    });
    return ok;
  }

  /* Contrôles qui dépendent de plusieurs champs. Renvoie false si une erreur bloque. */
  function crossChecks(n) {
    var ok = true;
    if (n === 1) {
      var inconnue = $("m-immat-inconnue").checked;
      var immat = $("m-immat");
      immat.value = normImmat(immat.value);
      if (!inconnue) {
        if (!immat.value) ok = setError(immat, "Saisissez l'immatriculation, ou cochez « Je ne la connais pas »") && ok;
        else if (!/^[A-Z]{2}-\d{3}-[A-Z]{2}$/.test(immat.value) && !/^\d{1,4}\s?[A-Z]{1,3}\s?\d{2,3}$/.test(immat.value))
          ok = setError(immat, "Format attendu : AA-123-BB") && ok;
      }
      /* Sans immatriculation, la marque, la cylindrée et le modèle identifient le véhicule. */
      ["m-marque", "m-cylindree", "m-modele"].forEach(function (id) {
        var el = $(id);
        if (!immat.value && !el.value) ok = setError(el, "Obligatoire sans immatriculation") && ok;
        else if (el.value) setError(el, "");
      });
      ok = checkAcquisition() && ok;
    }
    if (n === 2) {
      var cp = $("m-cp-stat");
      if (cp.value && !$("m-commune-stat").value) ok = setError($("m-commune-stat"), "Choisissez la commune dans la liste") && ok;
    }
    if (n === 3) {
      var nais = parseDate($("m-naissance").value);
      var coches = form.querySelectorAll("[data-permis]:checked");
      if (!coches.length) ok = setError(form.querySelector("[data-permis]"), "Cochez au moins un permis") && ok;
      else setError(form.querySelector("[data-permis]"), "");
      var AGES = { AM: 14, A1: 16, A2: 18, A: 20, B: 17 };
      coches.forEach(function (c) {
        var dateEl = form.elements["date_permis_" + c.value];
        var d = parseDate(dateEl.value);
        if (!dateEl.value) { ok = setError(dateEl, "Date d'obtention obligatoire") && ok; return; }
        if (!d) { ok = setError(dateEl, "Date au format JJ/MM/AAAA") && ok; return; }
        if (d > today()) { ok = setError(dateEl, "Cette date ne peut pas être dans le futur") && ok; return; }
        if (nais && d < addYears(nais, AGES[c.value])) {
          ok = setError(dateEl, "Impossible avant " + AGES[c.value] + " ans : vérifiez la date") && ok; return;
        }
        setError(dateEl, "");
      });
      ["2r", "auto"].forEach(function (k) {
        var sel = $("m-bonus-" + k);
        var wrap = $(k === "2r" ? "w-bonus-2r-3ans" : "w-bonus-auto-3ans");
        var name = k === "2r" ? "bonus_2roues_3ans" : "bonus_auto_3ans";
        if (sel.value === "0,50" && !val(name)) ok = setError(wrap.querySelector("input"), "Ce champ est obligatoire") && ok;
      });
      ok = checkCoherenceBonus() && ok;
    }
    if (n === 4) {
      form.querySelectorAll(".moto-sinistre").forEach(function (s) {
        s.querySelectorAll("select, input[type=text]").forEach(function (el) {
          if (!visible(el)) return;
          if (!el.value) { ok = setError(el, "Ce champ est obligatoire") && ok; return; }
          if (el.hasAttribute("data-date")) {
            var d = parseDate(el.value);
            var limite = new Date(today()); limite.setMonth(limite.getMonth() - 24);
            if (!d) ok = setError(el, "Date au format JJ/MM/AAAA") && ok;
            else if (d > today() || d < limite) ok = setError(el, "Le sinistre doit dater des 24 derniers mois") && ok;
            else setError(el, "");
          }
        });
        s.querySelectorAll(".moto-choices").forEach(function (g) {
          if (!visible(g)) return;
          var r = g.querySelector("input");
          if (!g.querySelector("input:checked")) ok = setError(r, "Ce champ est obligatoire") && ok;
          else setError(r, "");
        });
      });
      if (val("sinistres") === "Oui" && !form.querySelector(".moto-sinistre"))
        ok = setError(form.elements["sinistres"][0], "Ajoutez au moins un sinistre") && ok;
      if (val("assure_2roues_2ans") === "Oui") {
        var mois = $("m-mois-2r");
        var m = mois.value === "" ? NaN : Number(mois.value);
        if (isNaN(m) || m < 0 || m > 24 || Math.floor(m) !== m) ok = setError(mois, "Un nombre de mois entre 0 et 24") && ok;
        else setError(mois, "");
        if (!val("anciennete_contrat")) ok = setError(form.elements["anciennete_contrat"][0], "Ce champ est obligatoire") && ok;
        if (val("anciennete_contrat") === "Plus d'un an") {
          ["m-assureur", "m-num-contrat"].forEach(function (id) {
            if (!$(id).value.trim()) ok = setError($(id), "Ce champ est obligatoire") && ok; else setError($(id), "");
          });
        }
      }
      if (val("assure_auto_2ans") === "Oui") {
        var moisA = $("m-mois-auto");
        var ma = moisA.value === "" ? NaN : Number(moisA.value);
        if (isNaN(ma) || ma < 0 || ma > 24 || Math.floor(ma) !== ma) ok = setError(moisA, "Un nombre de mois entre 0 et 24") && ok;
        else setError(moisA, "");
      }
    }
    if (n === 5) {
      var eff = parseDate($("m-effet").value);
      var max = new Date(today()); max.setDate(max.getDate() + 60);
      if (eff && eff < today()) ok = setError($("m-effet"), "La date d'effet ne peut pas être passée") && ok;
      else if (eff && eff > max) ok = setError($("m-effet"), "La date d'effet doit être dans les 60 prochains jours") && ok;
    }
    if (n === 6) {
      var tel = $("m-tel");
      tel.value = tel.value.replace(/[\s.\-]/g, "");
      if (tel.value && !/^0\d{9}$/.test(tel.value)) ok = setError(tel, "10 chiffres, format 0606060606") && ok;
      if ($("m-email").value && $("m-email2").value && $("m-email").value.trim().toLowerCase() !== $("m-email2").value.trim().toLowerCase())
        ok = setError($("m-email2"), "Les deux adresses e-mail sont différentes") && ok;
      if ($("m-cp").value && !$("m-ville").value) ok = setError($("m-ville"), "Choisissez la ville dans la liste") && ok;
    }
    return ok;
  }

  /* ----- Éligibilité : un blocage arrête le parcours et propose un rappel ----- */
  function eligibilite(n) {
    if (n === 3) {
      var nais = parseDate($("m-naissance").value);
      if (nais && addYears(nais, 18) > today())
        return "L'assurance moto que nous proposons est réservée aux conducteurs d'au moins 18 ans.";
      var type = val("type_vehicule");
      var c = Number($("m-cylindree").value || 0);
      var grosse = (type === "Moto" || type === "Scooter" || type === "Moto verte") && c > 125;
      var aA = !!form.querySelector("[data-permis][value=A]:checked");
      var aA2 = !!form.querySelector("[data-permis][value=A2]:checked");
      if (grosse && !aA && !(aA2 && $("m-a2").checked))
        return aA2
          ? "Avec un permis A2, seule une version bridée A2 (35 kW) peut être assurée pour un 2-roues de plus de 125 cm3."
          : "Un 2-roues de plus de 125 cm3 demande le permis A, ou le permis A2 sur une version bridée 35 kW.";
      var malus = ["1,95", "2,44", "3,05", "3,50"];
      if (malus.indexOf($("m-bonus-2r").value) > -1 || malus.indexOf($("m-bonus-auto").value) > -1)
        return "Avec un coefficient supérieur à 1,56, notre partenaire ne peut pas proposer de tarif en ligne.";
    }
    return "";
  }
  /* Profils « à étudier » : le parcours continue, le courtier regarde le dossier. */
  function aEtudier() {
    var m = [];
    if (val("suspension") === "Oui") m.push("suspension de permis");
    if (val("annulation") === "Oui") m.push("annulation de permis");
    if (val("resiliation") === "Oui") m.push("résiliation assureur");
    if (val("carte_grise") === "Étrangère") m.push("carte grise étrangère");
    if (val("titulaire_cg") === "Autre") m.push("carte grise au nom d'un tiers");
    return m;
  }

  /* ----- Champs conditionnels ----- */
  function syncImmat() {
    var inconnue = $("m-immat-inconnue").checked;
    $("m-immat").disabled = inconnue;
    if (inconnue) { $("m-immat").value = ""; setError($("m-immat"), ""); }
  }
  $("m-immat-inconnue").addEventListener("change", syncImmat);
  $("m-pas-achete").addEventListener("change", function () {
    if (this.checked) { $("m-acq").value = fmt(today()); checkField($("m-acq")); }
  });
  form.querySelectorAll("[data-permis]").forEach(function (c) {
    c.addEventListener("change", function () {
      var d = form.elements["date_permis_" + c.value];
      d.hidden = !c.checked;
      if (!c.checked) { d.value = ""; setError(d, ""); }
    });
  });
  ["2r", "auto"].forEach(function (k) {
    $("m-bonus-" + k).addEventListener("change", function () {
      $(k === "2r" ? "w-bonus-2r-3ans" : "w-bonus-auto-3ans").hidden = this.value !== "0,50";
      syncAlerteBonus();
    });
  });
  function syncAlerteBonus() {
    $("alerte-bonus").hidden = !($("m-bonus-2r").value === "0,50" && val("assure_2roues_2ans") === "Non");
  }
  function onRadio(name, fn) {
    var g = form.elements[name];
    for (var i = 0; i < g.length; i++) g[i].addEventListener("change", fn);
  }
  onRadio("sinistres", function () {
    var oui = val("sinistres") === "Oui";
    $("w-sinistres").hidden = !oui;
    if (oui && !form.querySelector(".moto-sinistre")) addSinistre();
  });
  onRadio("assure_2roues_2ans", function () {
    $("w-assure-2r").hidden = val("assure_2roues_2ans") !== "Oui";
    syncAlerteBonus();
  });
  onRadio("anciennete_contrat", function () { $("w-hamon").hidden = val("anciennete_contrat") !== "Plus d'un an"; });
  onRadio("assure_auto_2ans", function () { $("w-assure-auto").hidden = val("assure_auto_2ans") !== "Oui"; });

  /* 9. Rachat de franchise selon la formule */
  var RACHAT = { "Essentielle": ["Aucun"], "Équilibre": ["Aucun", "Vol, incendie, forces de la nature (franchise 650 €)"] };
  function syncRachat() {
    var permis = RACHAT[val("formule")];
    var sel = $("m-rachat");
    for (var i = 0; i < sel.options.length; i++) {
      var o = sel.options[i];
      o.disabled = !!permis && permis.indexOf(o.value || o.text) === -1;
    }
    if (sel.selectedOptions[0] && sel.selectedOptions[0].disabled) sel.value = "Aucun";
  }
  onRadio("formule", syncRachat);

  /* 10. Nom de naissance pré-rempli avec le nom d'usage, tant qu'on ne l'a pas modifié */
  $("m-nom-naiss").addEventListener("input", function () { this.setAttribute("data-modifie", "1"); });
  $("m-nom").addEventListener("input", function () {
    if (!$("m-nom-naiss").hasAttribute("data-modifie")) $("m-nom-naiss").value = this.value;
  });

  /* Sinistres répétables */
  var nbSin = 0;
  function addSinistre() {
    nbSin++;
    var i = nbSin;
    var box = document.createElement("div");
    box.className = "moto-sinistre";
    box.innerHTML =
      "<p class=\"moto-label\">Sinistre n° " + i + " <button type=\"button\" class=\"moto-suppr\">Retirer</button></p>" +
      "<div class=\"form-grid\">" +
      "<div class=\"form-row\"><label for=\"s-type-" + i + "\">Type *</label><select id=\"s-type-" + i + "\" name=\"sinistre_type[]\"><option value=\"\">Choisir</option>" +
      ["Bris de glace", "Circulation", "Stationnement", "Vol", "Vandalisme", "Incendie", "Événement naturel"].map(function (t) { return "<option>" + t + "</option>"; }).join("") +
      "</select></div>" +
      "<div class=\"form-row\"><label for=\"s-date-" + i + "\">Date *</label><input type=\"text\" id=\"s-date-" + i + "\" name=\"sinistre_date[]\" placeholder=\"JJ/MM/AAAA\" inputmode=\"numeric\" maxlength=\"10\" data-date></div>" +
      "<div class=\"form-row\"><label for=\"s-veh-" + i + "\">Véhicule impliqué *</label><select id=\"s-veh-" + i + "\" name=\"sinistre_vehicule[]\"><option value=\"\">Choisir</option><option>Auto</option><option>Moto</option></select></div>" +
      "</div>" +
      "<div class=\"moto-circ\" hidden><div class=\"form-grid\">" +
      "<div class=\"form-row\"><label for=\"s-resp-" + i + "\">Taux de responsabilité *</label><select id=\"s-resp-" + i + "\" name=\"sinistre_responsabilite[]\"><option value=\"\">Choisir</option><option>0 %</option><option>50 %</option><option>100 %</option></select></div>" +
      "<div class=\"form-row\"><label for=\"s-corp-" + i + "\">Dommage(s) corporel(s) *</label><select id=\"s-corp-" + i + "\" name=\"sinistre_corporel[]\"><option value=\"\">Choisir</option><option>Non</option><option>Oui</option></select></div>" +
      "</div></div>";
    $("liste-sinistres").appendChild(box);
    var dateEl = box.querySelector("[data-date]");
    dateEl.addEventListener("input", function () {
      var v = dateEl.value.replace(/\D/g, "").slice(0, 8);
      if (v.length > 4) v = v.slice(0, 2) + "/" + v.slice(2, 4) + "/" + v.slice(4);
      else if (v.length > 2) v = v.slice(0, 2) + "/" + v.slice(2);
      dateEl.value = v;
    });
    var typeSel = box.querySelector("select");
    var circ = box.querySelector(".moto-circ");
    typeSel.addEventListener("change", function () {
      var c = typeSel.value === "Circulation";
      circ.hidden = !c;
      /* Les champs masqués ne sont pas envoyés : on garde l'alignement des listes. */
      circ.querySelectorAll("select").forEach(function (s) { if (!c) s.value = ""; });
    });
    box.querySelector(".moto-suppr").addEventListener("click", function () { box.remove(); });
    box.querySelectorAll("select, input").forEach(function (el) {
      el.addEventListener("blur", function () { if (el.value) setError(el, ""); });
    });
  }
  $("ajout-sinistre").addEventListener("click", addSinistre);

  /* Code postal -> communes (API Géo de l'État, sans cookie) */
  form.querySelectorAll("[data-commune]").forEach(function (cp) {
    var sel = $(cp.getAttribute("data-commune"));
    var last = "";
    function remplir(noms) {
      sel.innerHTML = "";
      if (!noms.length) {
        var o = document.createElement("option");
        o.value = ""; o.textContent = "Aucune commune pour ce code postal";
        sel.appendChild(o);
        return;
      }
      if (noms.length > 1) {
        var o0 = document.createElement("option");
        o0.value = ""; o0.textContent = "Choisir la commune";
        sel.appendChild(o0);
      }
      noms.forEach(function (n) {
        var o = document.createElement("option");
        o.value = n; o.textContent = n;
        sel.appendChild(o);
      });
      var r = sel.getAttribute("data-restaurer");
      if (r && noms.indexOf(r) > -1) { sel.value = r; sel.removeAttribute("data-restaurer"); }
    }
    cp.addEventListener("input", function () {
      cp.value = cp.value.replace(/\D/g, "").slice(0, 5);
      if (cp.value.length !== 5 || cp.value === last) return;
      last = cp.value;
      fetch("https://geo.api.gouv.fr/communes?codePostal=" + cp.value + "&fields=nom&format=json")
        .then(function (r) { return r.json(); })
        .then(function (l) { remplir(l.map(function (c) { return c.nom.toUpperCase(); }).sort()); setError(sel, ""); })
        .catch(function () {
          /* API indisponible : saisie libre */
          var input = document.createElement("input");
          input.type = "text"; input.id = sel.id; input.name = sel.name; input.required = true; input.maxLength = 80;
          sel.replaceWith(input);
          sel = input;
        });
    });
  });

  /* ----- Navigation ----- */
  function show(n, init) {
    step = n;
    steps.forEach(function (s) { s.hidden = Number(s.getAttribute("data-step")) !== n; });
    bar.style.width = ((n - 1) / STEPS * 100) + "%";
    count.textContent = "Étape " + n + " sur " + STEPS;
    back.hidden = n === 1;
    next.hidden = n === STEPS;
    send.hidden = n !== STEPS;
    stopBox.hidden = true;
    if (n === 6) {
      if (!$("m-immat2").value && $("m-immat").value) $("m-immat2").value = normImmat($("m-immat").value);
    }
    if (init) return;
    var legend = steps[n - 1].querySelector("legend");
    if (legend) { legend.setAttribute("tabindex", "-1"); legend.focus({ preventScroll: true }); }
    form.scrollIntoView({ behavior: "smooth", block: "start" });
    track("moto_etape", { etape: n });
  }
  function validate(n) {
    var ok = true;
    steps[n - 1].querySelectorAll("input, select, textarea").forEach(function (el) {
      if (el.closest(".moto-sinistre") || el.type === "hidden" || el.closest(".hp-field")) return;
      if (el.closest("[hidden]") && el.type !== "radio") { setError(el, ""); return; }
      if (el.type === "radio" && el.closest("[hidden]")) return;
      if (!checkField(el)) ok = false;
    });
    if (!crossChecks(n)) ok = false;
    return ok;
  }
  next.addEventListener("click", function () {
    if (!validate(step)) {
      var first = steps[step - 1].querySelector("[aria-invalid=true]");
      if (first) first.focus();
      return;
    }
    var stop = eligibilite(step);
    if (stop) {
      horsCriteres = true;
      stopText.textContent = stop + " Un courtier peut regarder votre situation avec vous.";
      stopBox.hidden = false;
      next.hidden = true;
      track("moto_hors_criteres", { etape: step });
      stopBox.setAttribute("tabindex", "-1");
      stopBox.focus();
      return;
    }
    show(step + 1);
  });
  function majEligibilite() {
    if (stopBox.hidden) return;
    var stop = eligibilite(step);
    if (stop) { stopText.textContent = stop + " Un courtier peut regarder votre situation avec vous."; return; }
    stopBox.hidden = true;
    next.hidden = false;
  }
  form.addEventListener("input", majEligibilite);
  form.addEventListener("change", majEligibilite);
  $("moto-rappel").addEventListener("click", function () {
    statut.value = "Non éligible";
    motif.value = stopText.textContent;
    show(6);
  });
  back.addEventListener("click", function () {
    if (!stopBox.hidden) { stopBox.hidden = true; next.hidden = false; return; }
    show(step - 1);
  });

  /* Le champ ne perd pas le focus au moment du clic sur un bouton de navigation :
     sinon un message d'erreur qui disparaît décale le bouton et le clic tombe à côté. */
  [next, back, send, $("moto-rappel")].forEach(function (btn) {
    btn.addEventListener("pointerdown", function (e) { e.preventDefault(); });
  });
  form.addEventListener("focusout", function (e) {
    var el = e.target;
    if (!el.matches || !el.matches("input, select, textarea") || el.closest(".moto-sinistre")) return;
    if (el.type === "radio" || el.type === "checkbox") return;
    if (el.id === "m-immat" || el.id === "m-immat2") el.value = normImmat(el.value);
    if (el.value) checkField(el);
    if ((el.id === "m-acq" || el.id === "m-mec") && $("m-mec").value && $("m-acq").value) checkAcquisition();
    if (/^m-bonus-|^date_permis_/.test(el.id || el.name) && step === 3) checkCoherenceBonus();
  });
  form.addEventListener("change", function (e) {
    if (e.target.type === "radio") setError(form.elements[e.target.name][0], "");
  });

  /* ----- Envoi ----- */
  $("m-time").value = Math.floor(Date.now() / 1000);
  form.addEventListener("submit", function (e) {
    if (!validate(6)) {
      e.preventDefault();
      var first = steps[5].querySelector("[aria-invalid=true]");
      if (first) first.focus();
      return;
    }
    if (statut.value !== "Non éligible") {
      var m = aEtudier();
      if (m.length) { statut.value = "À étudier"; motif.value = m.join(", "); }
    }
    /* Les étapes déjà passées restent dans le formulaire : elles partent avec l'envoi. */
    steps.forEach(function (s) { s.disabled = false; });
    $("m-immat").disabled = false;
    sauver();
    if (!window.fetch || !window.FormData) {   /* très vieux navigateur : envoi classique */
      send.disabled = true;
      send.textContent = "Envoi en cours…";
      return;
    }
    /* Envoi en arrière-plan : en cas d'échec, le visiteur reste sur le formulaire,
       avec un message clair et toutes ses réponses (le brouillon n'est effacé qu'après « envoi ok »). */
    e.preventDefault();
    var donnees = new FormData(form);
    syncImmat();
    send.disabled = true;
    send.textContent = "Envoi en cours…";
    fetch(form.action, { method: "POST", body: donnees, credentials: "same-origin" })
      .then(function (r) {
        if (r.ok && r.url.indexOf("envoi=ok") > -1) {
          track("moto_envoi", { statut: statut.value });
          location.href = r.url;
          return;
        }
        var code = (/[?&]erreur=([^&]+)/.exec(r.url) || [])[1] || (r.ok ? "inconnue" : "serveur-" + r.status);
        echecEnvoi(decodeURIComponent(code));
      })
      .catch(function () { echecEnvoi("reseau"); });
  });

  var MOTIFS = {
    email: "les deux adresses e-mail ne correspondent pas ou sont invalides",
    telephone: "le numéro de téléphone doit compter 10 chiffres",
    consentement: "la case d'accord pour être recontacté doit être cochée",
    date_effet: "la date d'effet doit être comprise entre aujourd'hui et 60 jours",
    reseau: "la connexion a été interrompue"
  };
  function echecEnvoi(code) {
    send.disabled = false;
    send.textContent = "Envoyer ma demande";
    var box = $("moto-erreur-serveur");
    var motifTxt = MOTIFS[code] ? " Motif : " + MOTIFS[code] + "." : "";
    box.textContent = "Votre demande n'a pas pu être envoyée." + motifTxt +
      " Vos réponses sont conservées : vous pouvez réessayer dans un instant, ou nous appeler au 09 78 31 02 93.";
    box.hidden = false;
    box.focus();
    track("moto_envoi_echec", { code: code });
  }

  /* ----- 12. Brouillon : les réponses survivent à un rechargement de la page ----- */
  /* sessionStorage : gardé tant que l'onglet reste ouvert, jamais envoyé, effacé après l'envoi. */
  var CLE_BROUILLON = "tempo-moto-brouillon";
  var IGNORES = { t: 1, site_web: 1, statut: 1, motif_statut: 1, email_confirmation: 1 };
  function sauver() {
    var v = {};
    Array.prototype.forEach.call(form.elements, function (el) {
      if (!el.name || IGNORES[el.name] || el.type === "button" || el.type === "submit") return;
      if ((el.type === "radio" || el.type === "checkbox") && !el.checked) return;
      (v[el.name] = v[el.name] || []).push(el.value);
    });
    try {
      sessionStorage.setItem(CLE_BROUILLON, JSON.stringify({ v: v, etape: step, sin: form.querySelectorAll(".moto-sinistre").length }));
    } catch (e) { /* stockage indisponible : pas de brouillon */ }
  }
  var minuterie = null;
  form.addEventListener("input", function () { clearTimeout(minuterie); minuterie = setTimeout(sauver, 400); });
  form.addEventListener("change", function () { clearTimeout(minuterie); minuterie = setTimeout(sauver, 100); });

  function restaurer() {
    var b = null;
    try { b = JSON.parse(sessionStorage.getItem(CLE_BROUILLON) || "null"); } catch (e) { b = null; }
    if (!b || !b.v) return 0;
    for (var i = 0; i < (b.sin || 0); i++) addSinistre();
    var vus = {};
    Array.prototype.forEach.call(form.elements, function (el) {
      var liste = b.v[el.name];
      if (!el.name || !liste) return;
      if (el.type === "radio" || el.type === "checkbox") { el.checked = liste.indexOf(el.value) > -1; return; }
      var k = vus[el.name] || 0;
      vus[el.name] = k + 1;
      if (liste[k] === undefined) return;
      if (el.tagName === "SELECT" && el.hasAttribute("required") && el.options.length <= 1 && liste[k]) {
        el.setAttribute("data-restaurer", liste[k]);   /* communes : remplies après l'appel à l'API */
        return;
      }
      el.value = liste[k];
    });
    /* Réafficher les champs conditionnels, puis recharger les communes. */
    form.querySelectorAll("input[type=radio]:checked, input[type=checkbox], select").forEach(function (el) {
      el.dispatchEvent(new Event("change", { bubbles: true }));
    });
    form.querySelectorAll("[data-commune]").forEach(function (cp) { if (cp.value) cp.dispatchEvent(new Event("input", { bubbles: true })); });
    if (b.v.nom_naissance && b.v.nom && b.v.nom_naissance[0] !== b.v.nom[0]) $("m-nom-naiss").setAttribute("data-modifie", "1");
    return Math.min(Math.max(1, b.etape || 1), STEPS);
  }
  $("moto-effacer").addEventListener("click", function () {
    try { sessionStorage.removeItem(CLE_BROUILLON); } catch (e) {}
    location.href = location.pathname;
  });

  /* Retour du serveur */
  var q = location.search;
  if (q.indexOf("envoi=ok") > -1) {
    try { sessionStorage.removeItem(CLE_BROUILLON); } catch (e) {}
    form.hidden = true;
    $("moto-ok").hidden = false;
    $("moto-ok").setAttribute("tabindex", "-1");
    $("moto-ok").focus();
  } else if (q.indexOf("erreur=") > -1) {
    $("moto-erreur-serveur").hidden = false;
  }
  var reprise = q.indexOf("envoi=ok") > -1 ? 0 : restaurer();
  syncImmat();
  syncRachat();
  show(reprise || 1, true);
  if (reprise) $("moto-brouillon").hidden = false;
  if (q.indexOf("erreur=") > -1) $("moto-erreur-serveur").focus();
})();
