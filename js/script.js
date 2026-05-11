(function() {
  // CURSOR
  const cur = document.getElementById('cur'),
        ring = document.getElementById('curRing');
  
  if (cur && ring) {
    let mx = 0, my = 0, rx = 0, ry = 0;
    document.addEventListener('mousemove', e => {
      mx = e.clientX;
      my = e.clientY;
      cur.style.left = mx + 'px';
      cur.style.top = my + 'px';
    });
    
    (function tick() {
      rx += (mx - rx) * 0.12;
      ry += (my - ry) * 0.12;
      ring.style.left = rx + 'px';
      ring.style.top = ry + 'px';
      requestAnimationFrame(tick);
    })();
    
    document.querySelectorAll('a, button, .part-card, .upd-card, .prog-item, .stat-cell, .imp-card, .abt-value-card, .abt-partner-logo, .abt-photo').forEach(el => {
      el.addEventListener('mouseenter', () => {
        cur.style.width = '18px';
        cur.style.height = '18px';
        ring.style.width = '60px';
        ring.style.height = '60px';
        ring.style.borderColor = 'rgba(240,193,50,0.8)';
      });
      el.addEventListener('mouseleave', () => {
        cur.style.width = '10px';
        cur.style.height = '10px';
        ring.style.width = '40px';
        ring.style.height = '40px';
        ring.style.borderColor = 'rgba(240,193,50,0.5)';
      });
    });
  }

  // PARTICLES (Homepage only)
  const pc = document.getElementById('particles');
  if (pc) {
    for (let i = 0; i < 20; i++) {
      const p = document.createElement('div');
      p.className = 'particle';
      const s = Math.random() * 5 + 3;
      p.style.cssText = `width:${s}px;height:${s}px;left:${Math.random() * 100}%;animation-duration:${Math.random() * 14 + 10}s;animation-delay:${Math.random() * 10}s`;
      pc.appendChild(p);
    }
  }

  // GLOBAL SCROLL REVEAL
  const obs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in');
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });
  
  document.querySelectorAll('.reveal, .abt-reveal, .cont-reveal, .corp-reveal').forEach(el => obs.observe(el));

  // TRANSFORMATION SLIDER (Homepage only)
  const tsTrack = document.getElementById('tsTrack');
  if (tsTrack) {
    const tsData = [
      {
        title: 'More Trees,<br/>Better Tomorrow',
        desc: 'See how a greener school<br/>creates a healthier future.',
        envLbl: 'Harsh Environment',
        envColor: '#e05a1a',
        wIco: '☀️',
        wCond: 'Extreme Heat',
        temp: 44,
        air: 'Dusty Air',
        stage: '44°C',
        impacts: [
          { i: '🌡️', t: 'Extreme Temperature', d: '44°C makes outdoor activity nearly impossible for students.' },
          { i: '💨', t: 'Poor Air Quality', d: 'High dust concentration and very low humidity.' },
          { i: '☁️', t: 'No Carbon Sink', d: 'Barren land contributes to the local heat island effect.' },
          { i: '🦋', t: 'No Biodiversity', d: 'Zero shade means no birds or local fauna can survive.' },
          { i: '😫', t: 'High Heat Stress', d: 'Students face fatigue and severe lack of concentration.' }
        ]
      },
      {
        title: 'More Trees,<br/>Better Tomorrow',
        desc: 'See how a greener school<br/>creates a healthier future.',
        envLbl: 'Moderate Environment',
        envColor: '#f0c132',
        wIco: '⛅',
        wCond: 'Hot & Dry',
        temp: 42,
        air: 'Moderate Air',
        stage: '42°C',
        impacts: [
          { i: '🌡️', t: 'Partial Cooling', d: 'Early growth starts to bring the temperature down to 42°C.' },
          { i: '💨', t: 'Reduced Dust', d: 'Young saplings begin filtering some wind-borne dust.' },
          { i: '☁️', t: 'Early Carbon Fix', d: 'Small trees begin their journey of carbon absorption.' },
          { i: '🕊️', t: 'Signs of Life', d: 'A few insects and hardy birds start visiting the campus.' },
          { i: '😊', t: 'Growing Comfort', d: 'The presence of green starts to improve student morale.' }
        ]
      },
      {
        title: 'More Trees,<br/>Better Tomorrow',
        desc: 'See how a greener school<br/>creates a healthier future.',
        envLbl: 'Balanced Environment',
        envColor: '#4a9e55',
        wIco: '🍃',
        wCond: 'Warm & Shady',
        temp: 39,
        air: 'Cleaner Air',
        stage: '39°C',
        impacts: [
          { i: '🌡️', t: 'Significant Cooling', d: 'Full canopy reduces ground temperature significantly to 39°C.' },
          { i: '💨', t: 'Filtered Fresh Air', d: 'Mature trees provide much cleaner, oxygen-rich air.' },
          { i: '☁️', t: 'Active Carbon Sink', d: 'The mini-forest effectively offsets local emissions.' },
          { i: '🌿', t: 'Rich Biodiversity', d: 'A thriving ecosystem with birds, butterflies, and shade.' },
          { i: '😁', t: 'Healthy Learning', d: 'Improved focus, better health, and a happier school life.' }
        ]
      }
    ];

    const tsBgs = document.querySelectorAll('.ts-bg');
    const tsH2 = document.getElementById('tsH2'),
          tsDesc = document.getElementById('tsDesc'),
          tsEnvDot = document.getElementById('tsEnvDot'),
          tsEnvLbl = document.getElementById('tsEnvLbl'),
          tsWIco = document.getElementById('tsWIco'),
          tsWCond = document.getElementById('tsWCond'),
          tsTemp = document.getElementById('tsTemp'),
          tsAir = document.getElementById('tsAir'),
          tsThumb = document.getElementById('tsThumb'),
          tsFill = document.getElementById('tsFill'),
          tsImpactsGrid = document.getElementById('tsImpactsGrid');

    let tsActive = 0;

    function tsApply(idx) {
      const d = tsData[idx];
      tsBgs.forEach((b, i) => { b.classList.toggle('ts-active', i === idx) });
      if (tsH2) tsH2.innerHTML = d.title;
      if (tsDesc) tsDesc.innerHTML = d.desc;
      if (tsEnvDot) tsEnvDot.style.background = d.envColor;
      if (tsEnvLbl) tsEnvLbl.textContent = d.envLbl;
      if (tsWIco) tsWIco.textContent = d.wIco;
      if (tsWCond) tsWCond.textContent = d.wCond;
      if (tsTemp) tsTemp.textContent = d.temp;
      if (tsAir) tsAir.textContent = d.air;
      
      const pct = (idx / (tsData.length - 1) * 100).toFixed(1);
      if (tsFill) tsFill.style.width = pct + '%';
      if (tsThumb) tsThumb.style.left = pct + '%';
      if (tsImpactsGrid) tsImpactsGrid.innerHTML = d.impacts.map(x => `<div class="ts-imp"><div class="ts-imp-ico">${x.i}</div><div><div class="ts-imp-title">${x.t}</div><div class="ts-imp-desc">${x.d}</div></div></div>`).join('');
    }

    function tsFromPct(pct) {
      pct = Math.max(0, Math.min(100, pct));
      const idx = Math.round(pct / 100 * (tsData.length - 1));
      if (idx !== tsActive) { tsActive = idx; tsApply(idx); }
      if (tsFill) tsFill.style.width = pct + '%';
      if (tsThumb) tsThumb.style.left = pct + '%';
    }

    function tsPctFromEvent(e, rect) { return ((e.clientX - rect.left) / rect.width) * 100; }

    tsTrack.addEventListener('click', e => {
      const r = tsTrack.getBoundingClientRect();
      tsFromPct(tsPctFromEvent(e, r));
    });

    if (tsThumb) {
      tsThumb.addEventListener('mousedown', e => {
        e.preventDefault();
        const move = mv => { const r = tsTrack.getBoundingClientRect(); tsFromPct(tsPctFromEvent(mv, r)); };
        const up = () => { document.removeEventListener('mousemove', move); document.removeEventListener('mouseup', up); };
        document.addEventListener('mousemove', move);
        document.addEventListener('mouseup', up);
      });
      tsThumb.addEventListener('touchstart', e => {
        e.preventDefault();
        const move = mv => { const r = tsTrack.getBoundingClientRect(); const t = mv.touches[0]; tsFromPct(((t.clientX - r.left) / r.width) * 100); };
        const up = () => { document.removeEventListener('touchmove', move); document.removeEventListener('touchend', up); };
        document.addEventListener('touchmove', move, { passive: false });
        document.addEventListener('touchend', up);
      }, { passive: false });
    }
    tsApply(0);
  }

  // MOBILE MENU (Universal)
  const mobBtn = document.getElementById('mobBtn'),
        mobMenu = document.getElementById('mobMenu'),
        mmClose = document.getElementById('mmClose');

  if (mobBtn && mobMenu && mmClose) {
    mobBtn.onclick = () => mobMenu.classList.add('active');
    mmClose.onclick = () => mobMenu.classList.remove('active');
    mobMenu.querySelectorAll('.mm-link, .mm-donate').forEach(link => {
      link.onclick = () => mobMenu.classList.remove('active');
    });
  }

  // DONATE MODAL LOGIC
  const donateModal = document.getElementById("donateModal");
  const closeDonate = document.getElementById("closeDonate");
  const donateForm = document.getElementById("donateForm");
  const donateFeedback = document.getElementById("donateFeedback");

  document.querySelectorAll('a[href*="Donate"], a[href*="donate"], .btn-donate').forEach(btn => {
    btn.addEventListener("click", (e) => {
      const href = btn.getAttribute("href");
      if (href && (href.includes("mailto") || href === "#" || href === "")) {
        e.preventDefault();
        if (donateModal) donateModal.classList.add("active");
      }
    });
  });

  if (closeDonate) {
    closeDonate.onclick = () => donateModal.classList.remove("active");
  }

  window.addEventListener("click", (e) => {
    if (e.target === donateModal) donateModal.classList.remove("active");
  });

  if (donateForm) {
    donateForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const submitBtn = donateForm.querySelector('button[type="submit"]');
      const originalBtnText = submitBtn.innerText;
      submitBtn.innerText = "Processing...";
      submitBtn.disabled = true;

      const formData = new FormData(donateForm);

      try {
        const response = await fetch("includes/process_lead.php", {
          method: "POST",
          body: formData
        });
        const result = await response.json();

        if (donateFeedback) {
          donateFeedback.style.display = "block";
          donateFeedback.innerText = result.message;
          donateFeedback.style.background = result.status === "success" ? "#dcfce7" : "#fee2e2";
          donateFeedback.style.color = result.status === "success" ? "#166534" : "#991b1b";
        }

        if (result.status === "success") {
          donateForm.reset();
          setTimeout(() => {
            if (donateModal) donateModal.classList.remove("active");
            if (donateFeedback) donateFeedback.style.display = "none";
          }, 3000);
        }
      } catch (err) {
        if (donateFeedback) {
          donateFeedback.style.display = "block";
          donateFeedback.innerText = "Error connecting to server.";
          donateFeedback.style.background = "#fee2e2";
          donateFeedback.style.color = "#991b1b";
        }
      } finally {
        submitBtn.innerText = originalBtnText;
        submitBtn.disabled = false;
      }
    });
  }
})();