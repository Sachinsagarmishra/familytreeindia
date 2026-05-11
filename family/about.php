<?php 
$pageTitle = "About Us";
$extraCSS = ["about.css"];
$extraJS = ["about.js"];
$navClass = "abt-nav";
include_once 'includes/header.php'; 
?>

  <!-- SECTION 1: ABOUT INTRO + 3 PHOTOS -->
  <section class="abt-intro">
    <div class="abt-intro-inner">
      <p class="abt-eyebrow abt-reveal">ABOUT US</p>
      <h1 class="abt-intro-h1 abt-reveal">Family Tree Foundation is a<br />non-profit organisation
        building<br /><i>permanent green cover</i> through<br />schools and communities.</h1>
      <div class="abt-photos abt-reveal">
        <div class="abt-photos-track">
          <div class="abt-photo">
            <img src="img/4.jpeg" alt="Student reading with a plant" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-tall">
            <img src="img/twogirlplanting.jpeg" alt="Students gathered for plantation" loading="lazy" />
          </div>
          <div class="abt-photo">
            <img src="img/11.jpeg" alt="Student smiling at school campus" loading="lazy" />
          </div>
          <!-- Mobile only marquee images -->
          <div class="abt-photo abt-photo-mob">
            <img src="img/1.jpeg" alt="Plantation Activity" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/3.jpeg" alt="School Garden" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/insitute.jpeg" alt="Student Guardian" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/indi.png" alt="Green Campus" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/12.jpeg" alt="Community Support" loading="lazy" />
          </div>
          <!-- Duplicates for loop -->
          <div class="abt-photo abt-photo-mob">
            <img src="img/4.jpeg" alt="Student reading" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/8.jpeg" alt="Students gathered" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/11.jpeg" alt="Student smiling" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/1.jpeg" alt="Plantation Activity" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/3.jpeg" alt="School Garden" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/insitute.jpeg" alt="Student Guardian" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/indi.png" alt="Green Campus" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-mob">
            <img src="img/12.jpeg" alt="Community Support" loading="lazy" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 2: MISSION + STATS -->
  <section class="abt-mission" id="story">
    <div class="abt-mission-inner abt-reveal">
      <h2 class="abt-mission-h2">Together, we can build a<br /><i>greener</i> Bihar</h2>
      <p class="abt-mission-p">Since Family Tree Foundation began, we've been chasing one ambitious goal: ensuring every
        government school in Bihar has a thriving green campus. And while the environmental crisis is massive, we're
        optimistic. We know how to solve the problem, and we make progress every day thanks to the dedication of student
        guardians, local communities, and generous supporters. If we work together, we believe every child will grow up
        surrounded by trees within our lifetime.</p>
    </div>
  </section>

  <!-- SECTION: COMPARISON STATS -->
  <section class="abt-comp-sec" id="impact">
    <div class="abt-comp-grid">
      <!-- TARGET COLUMN -->
      <div class="abt-comp-col target-col">
        <div class="abt-comp-inner">
          <p class="abt-stats-tag abt-reveal">Our Mission Target</p>
          <div class="comp-stats-grid abt-reveal">
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="10">0</div>
              <div class="abt-stat-lbl">DISTRICTS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="149">0</div>
              <div class="abt-stat-lbl">BLOCKS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="15402">0</div>
              <div class="abt-stat-lbl">SCHOOLS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="770100">0</div>
              <div class="abt-stat-lbl">PLANTS</div>
            </div>
          </div>
        </div>
      </div>
      <!-- COMPLETED COLUMN -->
      <div class="abt-comp-col completed-col">
        <div class="abt-comp-inner">
          <p class="abt-stats-tag abt-reveal">COMPLETED PLANTATION</p>
          <div class="comp-stats-grid abt-reveal">
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="4">0</div>
              <div class="abt-stat-lbl">DISTRICTS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="13">0</div>
              <div class="abt-stat-lbl">BLOCKS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="125">0</div>
              <div class="abt-stat-lbl">SCHOOLS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="10500">0</div>
              <div class="abt-stat-lbl">STUDENT GUARDIANS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="12500">0</div>
              <div class="abt-stat-lbl">TREES PLANTED</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION: FOUNDER -->
  <section class="abt-promise">
    <div class="abt-promise-inner founder-inner">
      <div class="abt-promise-body abt-reveal">
        <h2 class="founder-h2">Founder</h2>
        <p class="abt-promise-p">Dr. Ajay Sinha, Chairman of CMX Group and an MBA graduate, is a committed leader in
          environmental and social impact. He has led the plantation of over 10 million trees through the Social
          Forestry Program and created sustainable livelihoods for thousands, driving inclusive growth and climate
          action.</p>
        <div class="founder-sign">
          <p class="fs-name">Dr. Ajay Sinha,</p>
          <p class="fs-title">Environmentalist and Director</p>
        </div>
      </div>
      <div class="abt-promise-img abt-reveal">
        <img src="img/ajay-sinha-founder.jpeg" alt="Dr. Ajay Sinha — Founder" loading="lazy" />
      </div>
    </div>
  </section>

  <!-- SECTION 3: LEADERSHIP WITH IMPACT -->
  <section class="abt-promise" id="leadership">
    <div class="abt-promise-inner">
      <div class="abt-promise-img abt-reveal">
        <img src="img/founderimage.jpg" alt="Founder of Family Tree Foundation" loading="lazy" />
        <div class="abt-promise-overlay">
          <div class="abt-founder-name">Riya Kriti</div>
          <div class="abt-founder-org">Executive Director</div>
        </div>
      </div>
      <div class="abt-promise-body abt-reveal">
        <p class="abt-eyebrow">LEADERSHIP</p>
        <h2 class="abt-promise-h2">Leadership with<br /><i>Impact</i></h2>
        <p class="abt-promise-p">Family Tree Foundation was founded with a single, powerful conviction — that
          <strong>lasting green cover</strong> isn't built by organisations alone, it's built by communities. What
          started as a vision to plant trees in a single school has grown into a proven model that has already
          transformed <strong>125 government schools</strong> across <strong>4 districts</strong> and <strong>13
            blocks</strong>.
        </p>
        <p class="abt-promise-p">Under our leadership, we pioneered the <strong>student guardianship
            model</strong> — assigning each tree to one of our <strong>10,500 student guardians</strong>. With an
          ambitious target to reach <strong>15,402 schools</strong> and plant <strong>7,70,100 trees</strong> across
          <strong>10 districts (in the next 2 years)</strong>, we are building a generation of environmental stewards.
        </p>
      </div>
    </div>
  </section>

  <!-- SECTION 5: PARTNERS -->
  <section class="abt-partners">
    <div class="abt-partners-inner">
      <div class="abt-partners-head abt-reveal">
        <p class="abt-eyebrow">OUR PARTNERS & SUPPORTERS</p>
        <h2 class="abt-partners-h2">Backed by institutions<br />that <i>matter.</i></h2>
      </div>
      <div class="abt-partners-logos abt-reveal">
        <div class="abt-partner-logo">
          <img src="Icons/black/Bihar-Education-Project-Council.svg" alt="Bihar Education Project Council" />
        </div>
        <div class="abt-partner-logo">
          <img src="Icons/black/aiims-delhi.svg" alt="AIIMS Delhi" />
        </div>
        <div class="abt-partner-logo">
          <img src="Icons/black/ministry of education.svg" alt="Ministry of Education" />
        </div>
        <div class="abt-partner-logo">
          <img src="Icons/black/Government-of-Bihar.svg" alt="Government of Bihar" />
        </div>
        <div class="abt-partner-logo">
          <img src="Icons/black/cmx-foundation.svg" alt="CMX Foundation" />
        </div>
      </div>
    </div>
  </section>

<?php include_once 'includes/footer.php'; ?>
