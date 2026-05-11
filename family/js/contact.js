// CURSOR
const cur=document.getElementById('cur'),ring=document.getElementById('curRing');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{
  mx=e.clientX;my=e.clientY;
  cur.style.left=mx+'px';cur.style.top=my+'px';
});
(function tick(){rx+=(mx-rx)*0.12;ry+=(my-ry)*0.12;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(tick)})();
document.querySelectorAll('a,button,.info-card,.soc-item').forEach(el=>{
  el.addEventListener('mouseenter',()=>{cur.style.width='18px';cur.style.height='18px';ring.style.width='60px';ring.style.height='60px';ring.style.borderColor='rgba(240,193,50,0.8)'});
  el.addEventListener('mouseleave',()=>{cur.style.width='10px';cur.style.height='10px';ring.style.width='40px';ring.style.height='40px';ring.style.borderColor='rgba(240,193,50,0.5)'});
});

// SCROLL REVEAL
const obs=new IntersectionObserver(e=>e.forEach(x=>{if(x.isIntersecting){x.target.classList.add('in');obs.unobserve(x.target)}}),{threshold:0.1});
document.querySelectorAll('.cont-reveal').forEach(el=>obs.observe(el));

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
