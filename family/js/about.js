// CURSOR
const cur=document.getElementById('cur'),ring=document.getElementById('curRing');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{
  mx=e.clientX;my=e.clientY;
  cur.style.left=mx+'px';cur.style.top=my+'px';
});
(function tick(){rx+=(mx-rx)*0.12;ry+=(my-ry)*0.12;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(tick)})();
document.querySelectorAll('a,button,.abt-value-card,.abt-partner-logo,.abt-photo').forEach(el=>{
  el.addEventListener('mouseenter',()=>{cur.style.width='18px';cur.style.height='18px';ring.style.width='60px';ring.style.height='60px';ring.style.borderColor='rgba(240,193,50,0.8)'});
  el.addEventListener('mouseleave',()=>{cur.style.width='10px';cur.style.height='10px';ring.style.width='40px';ring.style.height='40px';ring.style.borderColor='rgba(240,193,50,0.5)'});
});

// SCROLL REVEAL
const obs=new IntersectionObserver(e=>e.forEach(x=>{if(x.isIntersecting){x.target.classList.add('in');obs.unobserve(x.target)}}),{threshold:0.1});
document.querySelectorAll('.abt-reveal').forEach(el=>obs.observe(el));

// NUMBER COUNTER
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
      document.querySelectorAll('.abt-stat-num').forEach(el => {
        const target = parseInt(el.dataset.target);
        animateNum(el, target);
      });
      statObs.unobserve(entry.target);
    }
  });
}, { threshold: 0.3 });

document.querySelectorAll('.abt-stats-grid, .comp-stats-grid').forEach(grid => {
  if (grid) statObs.observe(grid);
});

// MOBILE MENU
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
