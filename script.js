// CURSOR
const cur=document.getElementById('cur'),ring=document.getElementById('curRing');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{
  mx=e.clientX;my=e.clientY;
  cur.style.left=mx+'px';cur.style.top=my+'px';
});
(function tick(){rx+=(mx-rx)*0.12;ry+=(my-ry)*0.12;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(tick)})();
document.querySelectorAll('a,button,.part-card,.upd-card,.prog-item,.stat-cell,.imp-card').forEach(el=>{
  el.addEventListener('mouseenter',()=>{cur.style.width='18px';cur.style.height='18px';ring.style.width='60px';ring.style.height='60px';ring.style.borderColor='rgba(240,193,50,0.8)'});
  el.addEventListener('mouseleave',()=>{cur.style.width='10px';cur.style.height='10px';ring.style.width='40px';ring.style.height='40px';ring.style.borderColor='rgba(240,193,50,0.5)'});
});

// PARTICLES
const pc=document.getElementById('particles');
for(let i=0;i<20;i++){
  const p=document.createElement('div');p.className='particle';
  const s=Math.random()*5+3;
  p.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}%;animation-duration:${Math.random()*14+10}s;animation-delay:${Math.random()*10}s`;
  pc.appendChild(p);
}

// SCROLL REVEAL
const obs=new IntersectionObserver(e=>e.forEach(x=>{if(x.isIntersecting){x.target.classList.add('in');obs.unobserve(x.target)}}),{threshold:0.1});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));

// TRANSFORMATION SLIDER
const tsData=[
  {title:'More Trees,<br/>Better Tomorrow',desc:'See how a greener school<br/>creates a healthier future.',envLbl:'Moderate Environment',envColor:'#f0c132',wIco:'☀️',wCond:'Warm & Dry',temp:33,air:'Moderate Air',stage:'33°C',thumb:'🌳',
   impacts:[
     {i:'🌡️',t:'Slightly Higher Temperature',d:'Warmer environment affects focus and comfort.'},
     {i:'💨',t:'Moderate Air Quality',d:'Some dust and less oxygen. Room for improvement.'},
     {i:'☁️',t:'Moderate CO₂',d:'Fewer trees mean moderate carbon absorption.'},
     {i:'🦋',t:'Limited Biodiversity',d:'Fewer birds and insects. Less natural life around.'},
     {i:'🙁',t:'Average Well-being',d:'Comfort is okay, but more trees can improve health.'}
   ]},
  {title:'More Trees,<br/>Better Tomorrow',desc:'See how a greener school<br/>creates a healthier future.',envLbl:'Moderate Environment',envColor:'#f0c132',wIco:'⛅',wCond:'Warm & Pleasant',temp:28,air:'Good Air Quality',stage:'28°C',thumb:'🌳',
   impacts:[
     {i:'🌡️',t:'Moderate Temperature',d:'Comfortable environment for better learning.'},
     {i:'💨',t:'Good Air Quality',d:'Better air with more oxygen. Less dust and pollution.'},
     {i:'☁️',t:'Lower CO₂',d:'Some trees absorb carbon and improve air quality.'},
     {i:'🕊️',t:'Moderate Biodiversity',d:'Some birds and insects with limited natural life around.'},
     {i:'😊',t:'Better Well-being',d:'Good comfort and focus. More positivity for students.'}
   ]},
  {title:'More Trees,<br/>Better Tomorrow',desc:'See how a greener school<br/>creates a healthier future.',envLbl:'Moderate Environment',envColor:'#f0c132',wIco:'🌤️',wCond:'Warm & Pleasant',temp:25,air:'Good Air Quality',stage:'25°C',thumb:'🌳',
   impacts:[
     {i:'🌡️',t:'Better Temperature',d:'Increasing shade starts to balance the campus heat.'},
     {i:'💨',t:'Improving Air',d:'Growing canopy filters more dust and pollutants.'},
     {i:'☁️',t:'Carbon Storage',d:'Larger trees begin capturing significant CO₂.'},
     {i:'🦋',t:'Healthy Ecosystem',d:'More varieties of birds and insects are spotted.'},
     {i:'😄',t:'Positive Outlook',d:'A greener view boosts student morale and focus.'}
   ]},
  {title:'More Trees,<br/>Better Tomorrow',desc:'See how a greener school<br/>creates a healthier future.',envLbl:'Great Environment',envColor:'#4a9e55',wIco:'🍃',wCond:'Cool & Pleasant',temp:23,air:'Clean Air',stage:'23°C',thumb:'🌳',
   impacts:[
     {i:'🌡️',t:'Lower Temperature',d:'Cooler environment for better learning.'},
     {i:'💨',t:'Cleaner Air',d:'More oxygen, less pollution.'},
     {i:'☁️',t:'Less CO₂',d:'Trees absorb carbon and reduce emissions.'},
     {i:'🌿',t:'More Biodiversity',d:'Birds, butterflies & more bring life around.'},
     {i:'😁',t:'Better Well-being',d:'Better health, focus and happiness.'}
   ]}
];
const tsBgs=document.querySelectorAll('.ts-bg');
const tsH2=document.getElementById('tsH2'),tsDesc=document.getElementById('tsDesc');
const tsEnvDot=document.getElementById('tsEnvDot'),tsEnvLbl=document.getElementById('tsEnvLbl');
const tsWIco=document.getElementById('tsWIco'),tsWCond=document.getElementById('tsWCond');
const tsTemp=document.getElementById('tsTemp'),tsAir=document.getElementById('tsAir');
const tsStagePill=document.getElementById('tsStagePill'),tsThumb=document.getElementById('tsThumb');
const tsFill=document.getElementById('tsFill'),tsTrack=document.getElementById('tsTrack');
const tsImpactsGrid=document.getElementById('tsImpactsGrid');
let tsActive=0;
function tsApply(idx){
  const d=tsData[idx];
  tsBgs.forEach((b,i)=>{b.classList.toggle('ts-active',i===idx)});
  tsH2.innerHTML=d.title;tsDesc.innerHTML=d.desc;
  tsEnvDot.style.background=d.envColor;tsEnvLbl.textContent=d.envLbl;
  tsWIco.textContent=d.wIco;tsWCond.textContent=d.wCond;
  tsTemp.textContent=d.temp;tsAir.textContent=d.air;
  tsThumb.textContent=d.thumb;
  const pct=(idx/(tsData.length-1)*100).toFixed(1);
  tsFill.style.width=pct+'%';tsThumb.style.left=pct+'%';
  tsImpactsGrid.innerHTML=d.impacts.map(x=>`<div class="ts-imp"><div class="ts-imp-ico">${x.i}</div><div><div class="ts-imp-title">${x.t}</div><div class="ts-imp-desc">${x.d}</div></div></div>`).join('');
}
function tsFromPct(pct){
  pct=Math.max(0,Math.min(100,pct));
  const idx=Math.round(pct/100*(tsData.length-1));
  if(idx!==tsActive){tsActive=idx;tsApply(idx);}
  tsFill.style.width=pct+'%';tsThumb.style.left=pct+'%';
}
function tsPctFromEvent(e,rect){return((e.clientX-rect.left)/rect.width)*100;}
tsTrack.addEventListener('click',e=>{const r=tsTrack.getBoundingClientRect();tsFromPct(tsPctFromEvent(e,r));});
tsThumb.addEventListener('mousedown',e=>{
  e.preventDefault();
  const move=mv=>{const r=tsTrack.getBoundingClientRect();tsFromPct(tsPctFromEvent(mv,r));};
  const up=()=>{document.removeEventListener('mousemove',move);document.removeEventListener('mouseup',up);};
  document.addEventListener('mousemove',move);document.addEventListener('mouseup',up);
});
tsThumb.addEventListener('touchstart',e=>{
  e.preventDefault();
  const move=mv=>{const r=tsTrack.getBoundingClientRect();const t=mv.touches[0];tsFromPct(((t.clientX-r.left)/r.width)*100);};
  const up=()=>{document.removeEventListener('touchmove',move);document.removeEventListener('touchend',up);};
  document.addEventListener('touchmove',move,{passive:false});document.addEventListener('touchend',up);
},{passive:false});
tsApply(0);

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