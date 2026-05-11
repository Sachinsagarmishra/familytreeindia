(function() {
  // NUMBER COUNTER (About Page Specific)
  function animateNum(el, target) {
    const dur = 2000;
    const start = performance.now();
    const format = (n) => n.toLocaleString('en-IN');
    function step(now) {
      const progress = Math.min((now - start) / dur, 1);
      const ease = 1 - Math.pow(1 - progress, 3);
      el.textContent = format(Math.floor(ease * target));
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = format(target);
    }
    requestAnimationFrame(step);
  }

  const statObs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.querySelectorAll('.abt-stat-num').forEach(el => {
          const target = parseInt(el.dataset.target);
          if (!isNaN(target)) animateNum(el, target);
        });
        statObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 });

  document.querySelectorAll('.abt-stats-grid, .comp-stats-grid').forEach(grid => {
    if (grid) statObs.observe(grid);
  });
})();
