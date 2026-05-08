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
  {title:'More Trees,<br/>Better Tomorrow',desc:'See how a greener school<br/>creates a healthier future.',envLbl:'Harsh Environment',envColor:'#e05a1a',wIco:'☀️',wCond:'Hot & Harsh',temp:38,air:'Dusty Air',stage:'No Trees',thumb:'🌵',
   impacts:[{i:'🌡️',t:'Higher Temperature',d:'Hotter environment makes learning difficult.'},{i:'💨',t:'Poor Air Quality',d:'More dust, less oxygen, more pollution.'},{i:'☁️',t:'More CO₂',d:'Less trees mean more carbon and poor air quality.'},{i:'🌿',t:'Less Biodiversity',d:'Fewer birds, insects and natural life around.'},{i:'😟',t:'Poor Well-being',d:'Heat, stress and discomfort affect health and focus.'}]},
  {title:'First Steps,<br/>Saplings Planted',desc:'Young saplings take root,<br/>a change begins.',envLbl:'Early Recovery',envColor:'#8a7a2a',wIco:'🌤️',wCond:'Still Warm',temp:34,air:'Improving',stage:'Few Trees',thumb:'🌱',
   impacts:[{i:'🌡️',t:'Slightly Cooler',d:'Young shade trees begin reducing ground heat.'},{i:'💨',t:'Less Dust',d:'Roots hold soil, reducing dust in the air.'},{i:'☁️',t:'CO₂ Reducing',d:'Saplings begin absorbing carbon dioxide.'},{i:'🦋',t:'Wildlife Returns',d:'Insects and small birds start to appear.'},{i:'😊',t:'Better Mood',d:'Green spaces improve focus and mood.'}]},
  {title:'Growing Green,<br/>Thriving Campus',desc:'Trees grow, shade spreads,<br/>life returns to the school.',envLbl:'Green Recovery',envColor:'#3a7a42',wIco:'⛅',wCond:'Comfortable',temp:30,air:'Cleaner Air',stage:'Growing Forest',thumb:'🌳',
   impacts:[{i:'🌡️',t:'Natural Cooling',d:'Dense canopy reduces ambient temperature.'},{i:'💨',t:'Fresh Air',d:'Trees purify air, increasing oxygen levels.'},{i:'☁️',t:'Carbon Stored',d:'Significant CO₂ absorbed and locked in biomass.'},{i:'🦅',t:'Biodiversity',d:'Birds, butterflies and insects thrive here.'},{i:'😄',t:'Healthy Students',d:'Children focus better, play outdoors more.'}]},
  {title:'Full Forest,<br/>Transformed School',desc:'A living forest shades<br/>every corner of the campus.',envLbl:'Thriving Ecosystem',envColor:'#1a6a28',wIco:'🌿',wCond:'Cool & Green',temp:26,air:'Pure Air',stage:'Full Forest',thumb:'🌲',
   impacts:[{i:'🌡️',t:'Cool Microclimate',d:'10°C cooler than surrounding bare areas.'},{i:'💨',t:'Pure Air',d:'Air quality rivals open countryside.'},{i:'☁️',t:'Net Carbon Sink',d:'This forest actively fights climate change.'},{i:'🦜',t:'Rich Biodiversity',d:'A complete urban ecosystem flourishes.'},{i:'🌟',t:'Thriving Community',d:'Students, teachers, families all benefit.'}]}
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
  tsStagePill.textContent=d.stage;tsThumb.textContent=d.thumb;
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