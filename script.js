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
if (pc) {
  for(let i=0;i<20;i++){
    const p=document.createElement('div');p.className='particle';
    const s=Math.random()*5+3;
    p.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}%;animation-duration:${Math.random()*14+10}s;animation-delay:${Math.random()*10}s`;
    pc.appendChild(p);
  }
}

// SCROLL REVEAL
const obs=new IntersectionObserver(e=>e.forEach(x=>{if(x.isIntersecting){x.target.classList.add('in');obs.unobserve(x.target)}}),{threshold:0.1});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));

// TRANSFORMATION SLIDER
const tsData=[
  {title:'More Trees,<br/>Better Tomorrow',desc:'See how a greener school<br/>creates a healthier future.',envLbl:'Harsh Environment',envColor:'#e05a1a',wIco:'☀️',wCond:'Extreme Heat',temp:44,air:'Dusty Air',stage:'44°C',thumb:'🌳',
   impacts:[
     {i:'🌡️',t:'Extreme Temperature',d:'44°C makes outdoor activity nearly impossible for students.'},
     {i:'💨',t:'Poor Air Quality',d:'High dust concentration and very low humidity.'},
     {i:'☁️',t:'No Carbon Sink',d:'Barren land contributes to the local heat island effect.'},
     {i:'🦋',t:'No Biodiversity',d:'Zero shade means no birds or local fauna can survive.'},
     {i:'😫',t:'High Heat Stress',d:'Students face fatigue and severe lack of concentration.'}
   ]},
  {title:'More Trees,<br/>Better Tomorrow',desc:'See how a greener school<br/>creates a healthier future.',envLbl:'Moderate Environment',envColor:'#f0c132',wIco:'⛅',wCond:'Hot & Dry',temp:42,air:'Moderate Air',stage:'42°C',thumb:'🌳',
   impacts:[
     {i:'🌡️',t:'Partial Cooling',d:'Early growth starts to bring the temperature down to 42°C.'},
     {i:'💨',t:'Reduced Dust',d:'Young saplings begin filtering some wind-borne dust.'},
     {i:'☁️',t:'Early Carbon Fix',d:'Small trees begin their journey of carbon absorption.'},
     {i:'🕊️',t:'Signs of Life',d:'A few insects and hardy birds start visiting the campus.'},
     {i:'😊',t:'Growing Comfort',d:'The presence of green starts to improve student morale.'}
   ]},
  {title:'More Trees,<br/>Better Tomorrow',desc:'See how a greener school<br/>creates a healthier future.',envLbl:'Balanced Environment',envColor:'#4a9e55',wIco:'🍃',wCond:'Warm & Shady',temp:39,air:'Cleaner Air',stage:'39°C',thumb:'🌳',
   impacts:[
     {i:'🌡️',t:'Significant Cooling',d:'Full canopy reduces ground temperature significantly to 39°C.'},
     {i:'💨',t:'Filtered Fresh Air',d:'Mature trees provide much cleaner, oxygen-rich air.'},
     {i:'☁️',t:'Active Carbon Sink',d:'The mini-forest effectively offsets local emissions.'},
     {i:'🌿',t:'Rich Biodiversity',d:'A thriving ecosystem with birds, butterflies, and shade.'},
     {i:'😁',t:'Healthy Learning',d:'Improved focus, better health, and a happier school life.'}
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
if (tsTrack) {
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
}

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