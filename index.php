<?php 
$pageTitle = "Home";
include_once 'includes/header.php'; 
?>

  <!-- HERO -->
  <section class="hero" style="<?php if(isset($site['home_hero_bg'])) echo "background-image: linear-gradient(rgba(15, 35, 16, 0.4), rgba(15, 35, 16, 0.4)), url('".SITE_URL."/img/".$site['home_hero_bg']."');"; ?>">
    <div class="hero-bg"></div>
    <div class="hero-particles" id="particles"></div>

    <div class="hero-content">
      <p class="hero-tag"><?php echo htmlspecialchars($site['home_hero_tag'] ?? 'Bachpan Sang Hariyali'); ?></p>
      <h1 class="hero-h1">
        <?php echo ($site['home_hero_title_main'] ?? 'Planting trees.'); ?><br />
        <i><?php echo ($site['home_hero_title_highlight'] ?? 'Raising'); ?></i><br />
        <?php echo ($site['home_hero_title_end'] ?? 'guardians.'); ?>
      </h1>
      <div class="hero-bottom">
        <p class="hero-sub">
          <?php echo htmlspecialchars($site['home_hero_sub'] ?? "We don't just plant trees — we assign each one to a student. 8 lakh trees. 15000 schools. One generation taking responsibility for the next."); ?>
        </p>
        <div class="hero-btns">
          <a href="<?php echo SITE_URL; ?>/corporate" class="btn-y">Sponsor a Tree</a>
          <a href="<?php echo SITE_URL; ?>/about" class="btn-w">See Our Work</a>
        </div>
      </div>
    </div>
    <div class="scroll-hint">
      <span>Scroll</span>
      <div class="scroll-line"></div>
    </div>
  </section>

  <!-- PARTNERS STRIP -->
  <div class="partners">
    <span class="partners-lbl">Trusted by</span>
    <div class="partners-row">
      <div class="marquee-content">
        <?php 
        $partners_res = $conn->query("SELECT * FROM partners ORDER BY order_index ASC, id DESC");
        $all_partners = [];
        if ($partners_res && $partners_res->num_rows > 0) {
            while($p = $partners_res->fetch_assoc()) $all_partners[] = $p;
        }

        // Render twice for continuous loop
        for($i=0; $i<2; $i++):
          foreach($all_partners as $p):
            $logo_path = (file_exists("img/partners/" . $p['logo'])) 
                        ? SITE_URL . "/img/partners/" . $p['logo'] 
                        : SITE_URL . "/Icons/" . $p['logo']; // Note: index uses /Icons/
        ?>
          <img src="<?php echo $logo_path; ?>" alt="<?php echo htmlspecialchars($p['name']); ?>" class="partner-logo">
        <?php endforeach; endfor; ?>
      </div>
    </div>
  </div>

  <!-- STAT BAND -->
  <div class="stat-band">
    <div class="stat-cell reveal">
      <div class="stat-num"><?php echo ($site['home_stat1_val'] ?? '4.5M+'); ?></div>
      <div class="stat-lbl"><?php echo ($site['home_stat1_lbl'] ?? 'SAPLINGS PLANTED'); ?></div>
    </div>
    <div class="stat-cell reveal d1">
      <div class="stat-num"><?php echo ($site['home_stat2_val'] ?? '74%'); ?></div>
      <div class="stat-lbl"><?php echo ($site['home_stat2_lbl'] ?? 'AVERAGE SURVIVAL RATE'); ?></div>
    </div>
    <div class="stat-cell reveal d2">
      <div class="stat-num"><?php echo ($site['home_stat3_val'] ?? '83,600 <small>TCO₂</small>'); ?></div>
      <div class="stat-lbl"><?php echo ($site['home_stat3_lbl'] ?? 'SEQUESTERED ANNUALLY'); ?></div>
    </div>
    <div class="stat-cell reveal d3">
      <div class="stat-num"><?php echo ($site['home_stat4_val'] ?? '25K+'); ?></div>
      <div class="stat-lbl"><?php echo ($site['home_stat4_lbl'] ?? 'Community ENGAGED'); ?></div>
    </div>
  </div>
  <div class="stat-footnote reveal">
    <p><?php echo ($site['home_stat_footnote'] ?? '"The above impact metrics reflect the cumulative implementation experience of the leadership team behind Family Tree Foundation across large-scale social forestry and green infrastructure initiatives in Bihar to date."'); ?></p>
  </div>

  <!-- STORY / ABOUT -->
  <div class="story">
    <div class="story-vis">
      <div class="story-vis-inner">
        <p class="story-pull"><?php echo ($site['home_story_pull'] ?? 'A child who plants<br />a tree never lets<br />it <span>die.</span>'); ?></p>
      </div>
    </div>
    <div class="story-body-col">
      <p class="eyebrow reveal"><?php echo htmlspecialchars($site['home_story_eyebrow'] ?? 'Who We Are'); ?></p>
      <h2 class="story-h2 reveal">
        <?php echo ($site['home_story_title_main'] ?? 'Built on the'); ?><br />
        <i><?php echo ($site['home_story_title_highlight'] ?? 'belief'); ?></i><br />
        <?php echo ($site['home_story_title_end'] ?? 'that nature needs a champion.'); ?>
      </h2>
      <div class="story-p reveal"><?php echo ($site['home_story_text1'] ?? ''); ?></div>
      <div class="story-p reveal"><?php echo ($site['home_story_text2'] ?? ''); ?></div>
      <a href="<?php echo SITE_URL; ?>/about" class="link-arr reveal">Our full story</a>
    </div>
  </div>

  <!-- HARIT BIHAR MISSION -->
  <section class="hbm-sec">
    <div class="hbm-inner">
      <div class="hbm-left reveal">
        <div class="hbm-badge">
          <span class="hbm-badge-dot"></span>
          <span class="hbm-badge-txt"><?php echo htmlspecialchars($site['home_hbm_badge'] ?? 'Government Partnership'); ?></span>
        </div>
        <h2 class="hbm-h2">
          <?php echo ($site['home_hbm_title_main'] ?? 'Bachpan Sang'); ?><br />
          <i><?php echo ($site['home_hbm_title_highlight'] ?? 'Hariyali'); ?></i>
        </h2>
        <p class="hbm-subtitle"><?php echo htmlspecialchars($site['home_hbm_subtitle'] ?? 'An initiative by Family Tree Foundation'); ?></p>
      </div>
      <div class="hbm-right reveal">
        <div class="hbm-line"></div>
        <div class="hbm-p"><?php echo ($site['home_hbm_text'] ?? ''); ?></div>
        <div class="hbm-highlight"><?php echo ($site['home_hbm_highlight'] ?? ''); ?></div>
        <a href="<?php echo SITE_URL; ?>/corporate" class="link-arr">Learn About Corporate Partnerships</a>
      </div>
    </div>
  </section>

  <!-- TRANSFORMATION SLIDER SECTION -->
  <section class="transform-sec" id="transformSec">
    <div class="ts-bg-wrap">
      <div class="ts-bg ts-active" style="background-image:url('<?php echo SITE_URL; ?>/img/temp/44degree.png')"></div>
      <div class="ts-bg" style="background-image:url('<?php echo SITE_URL; ?>/img/temp/42degree.png')"></div>
      <div class="ts-bg" style="background-image:url('<?php echo SITE_URL; ?>/img/temp/39degree.png')"></div>
    </div>
    <div class="ts-overlay"></div>
    <div class="ts-top-area">
      <div class="ts-left-col">
        <h2 class="ts-h2" id="tsH2">More Trees,<br />Better Tomorrow</h2>
        <p class="ts-desc" id="tsDesc">See how a greener school<br />creates a healthier future.</p>
        <div class="ts-env-badge">
          <span class="ts-env-dot" id="tsEnvDot" style="background:#e05a1a"></span>
          <span class="ts-env-lbl" id="tsEnvLbl">Harsh Environment</span>
        </div>
      </div>
      <div class="ts-weather-card">
        <div class="ts-wc-top">
          <span class="ts-wc-ico" id="tsWIco">☀️</span>
          <span class="ts-wc-cond" id="tsWCond">Hot &amp; Harsh</span>
        </div>
        <div class="ts-wc-temp"><span id="tsTemp">38</span>°C</div>
        <div class="ts-wc-air">💨 <span id="tsAir">Dusty Air</span></div>
      </div>
    </div>
    <div class="ts-bottom-panel">
      <div class="ts-slider-area">
        <div class="ts-track-wrap" id="tsTrack">
          <div class="ts-track-fill" id="tsFill" style="width:0%"></div>
          <div class="ts-thumb" id="tsThumb" style="left:0%">🌳</div>
        </div>
      </div>
      <div class="ts-impacts-row">
        <div class="ts-impacts-lbl">IMPACTS</div>
        <div class="ts-impacts-grid" id="tsImpactsGrid"></div>
      </div>
    </div>
  </section>

  <!-- PROGRAM -->
  <section class="program">
    <div class="program-head reveal">
      <h2 class="program-h2">
        <?php echo ($site['home_prog_title_main'] ?? 'From your donation to a'); ?> 
        <i><?php echo ($site['home_prog_title_highlight'] ?? 'living tree.'); ?></i>
        <?php echo ($site['home_prog_title_end'] ?? ''); ?>
      </h2>
      <p class="program-note"><?php echo htmlspecialchars($site['home_prog_note'] ?? "Every rupee tracked. Every tree geo-tagged. You see exactly where your money goes — and who's looking after it."); ?></p>
    </div>
    <div class="how-steps reveal">
      <div class="how-step">
        <div class="how-dot"><span>💳</span></div>
        <div class="how-sn">Step 01</div>
        <div class="how-title">You Sponsor</div>
        <div class="how-desc">Choose trees, tiers, or a school to support</div>
      </div>
      <div class="how-step">
        <div class="how-dot"><span>📋</span></div>
        <div class="how-sn">Step 02</div>
        <div class="how-title">We Plan</div>
        <div class="how-desc">Site survey and species selection</div>
      </div>
      <div class="how-step">
        <div class="how-dot"><span>🌿</span></div>
        <div class="how-sn">Step 03</div>
        <div class="how-title">We Plant</div>
        <div class="how-desc">Community plantation drive happens</div>
      </div>
      <div class="how-step">
        <div class="how-dot"><span>🎒</span></div>
        <div class="how-sn">Step 04</div>
        <div class="how-title">Assigned</div>
        <div class="how-desc">Student becomes tree's guardian</div>
      </div>
      <div class="how-step">
        <div class="how-dot"><span>📍</span></div>
        <div class="how-sn">Step 05</div>
        <div class="how-title">Monitored</div>
        <div class="how-desc">Geo-tagged survival tracking begins</div>
      </div>
      <div class="how-step">
        <div class="how-dot"><span>📊</span></div>
        <div class="how-sn">Step 06</div>
        <div class="how-title">Reported</div>
        <div class="how-desc">Quarterly impact report sent to you</div>
      </div>
    </div>
  </section>

  <!-- PARTNER PATHWAYS -->
  <section class="part-sec">
    <div class="part-head reveal">
      <p class="eyebrow"><?php echo htmlspecialchars($site['home_part_eyebrow'] ?? 'Get Involved'); ?></p>
      <h2 class="part-h2">
        <?php echo ($site['home_part_title_main'] ?? 'Every kind of partner'); ?><br />
        <?php echo ($site['home_part_title_highlight'] ?? 'grows something'); ?> 
        <i><?php echo ($site['home_part_title_end'] ?? 'different.'); ?></i>
      </h2>
    </div>
    <div class="part-grid reveal">
      <div class="part-card">
        <div class="pc-bg bg0"></div>
        <div class="pc-ov"></div>
        <div class="pc-body">
          <div class="pc-title">Corporate</div>
          <div class="pc-sub">ESG-aligned green impact. Measurable outcomes with employee engagement built in.</div>
          <a href="<?php echo SITE_URL; ?>/corporate" class="pc-link">Partner With Us</a>
        </div>
      </div>
      <div class="part-card">
        <div class="pc-bg bg1"></div>
        <div class="pc-ov"></div>
        <div class="pc-body">
          <div class="pc-title">Donor Agency</div>
          <div class="pc-sub">Fund verified, geo-tagged plantation with full transparency and quarterly impact reports.
          </div>
          <a href="<?php echo SITE_URL; ?>/contact" class="pc-link">Fund a Project</a>
        </div>
      </div>
      <div class="part-card">
        <div class="pc-bg bg2"></div>
        <div class="pc-ov"></div>
        <div class="pc-body">
          <div class="pc-title">Institution</div>
          <div class="pc-sub">Schools, hospitals, universities — transform your campus into a living green corridor.
          </div>
          <a href="<?php echo SITE_URL; ?>/contact" class="pc-link">Join Program</a>
        </div>
      </div>
      <div class="part-card">
        <div class="pc-bg bg3"></div>
        <div class="pc-ov"></div>
        <div class="pc-body">
          <div class="pc-title">Individuals</div>
          <div class="pc-sub">Sponsor a tree. Track it growing. Know your guardian's name.</div>
          <a href="<?php echo SITE_URL; ?>/contact" class="pc-link">Start Here</a>
        </div>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section class="how-sec">
    <div class="how-inner">
      <div class="how-head reveal">
        <h2 class="how-h2">
          <?php echo ($site['home_hiw_title_main'] ?? 'What we'); ?><br />
          <i><?php echo ($site['home_hiw_title_highlight'] ?? 'deliver'); ?></i>
        </h2>
        <p class="how-note"><?php echo htmlspecialchars($site['home_hiw_note'] ?? 'Our five-step model is what separates us from every other plantation drive. Survival, not just numbers.'); ?></p>
      </div>
      <div class="prog-grid reveal">
        <div class="prog-item">
          <div class="prog-n">01</div>
          <span class="prog-ico">📚</span>
          <div class="prog-title">Awareness in Schools</div>
          <div class="prog-desc">Students learn ecology, climate, and why urban green cover has collapsed — before a
            single sapling is touched.</div>
        </div>
        <div class="prog-item">
          <div class="prog-n">02</div>
          <span class="prog-ico">🗺</span>
          <div class="prog-title">Plantation Planning</div>
          <div class="prog-desc">Site surveys, native species selection, soil prep. We plan for survival, not ceremony.
          </div>
        </div>
        <div class="prog-item">
          <div class="prog-n">03</div>
          <span class="prog-ico">🌱</span>
          <div class="prog-title">Tree Plantation</div>
          <div class="prog-desc">Organised drives with students, teachers, parents and local government — the whole
            community as stakeholder.</div>
        </div>
        <div class="prog-item">
          <div class="prog-n">04</div>
          <span class="prog-ico">🎒</span>
          <div class="prog-title">Student Ownership</div>
          <div class="prog-desc">Every tree is assigned to one student. Their name, their tree, their responsibility —
            for years.</div>
        </div>
        <div class="prog-item">
          <div class="prog-n">05</div>
          <span class="prog-ico">📡</span>
          <div class="prog-title">Monitor & Report</div>
          <div class="prog-desc">Geo-tagged trees, survival tracking, quarterly impact reports with photos and real data
            for every partner.</div>
        </div>
      </div>
      <div class="prog-foot reveal">
        <a href="<?php echo SITE_URL; ?>/about" class="btn-y">Explore the Full Program</a>
      </div>
    </div>
  </section>

  <!-- DONATE -->
  <div class="donate-sec">
    <div>
      <h2 class="donate-h2 reveal">
        <?php echo ($site['home_donate_title_main'] ?? 'Help grow the next'); ?><br />
        <i><?php echo ($site['home_donate_title_highlight'] ?? 'school forest.'); ?></i>
      </h2>
      <p class="donate-sub reveal"><?php echo htmlspecialchars($site['home_donate_sub'] ?? "Your support helps us reach more schools and empower more student guardians. Every contribution ensures a lasting green legacy for the next generation, where every tree is cared for and tracked for life."); ?></p>
    </div>
    <div class="donate-right reveal">
      <a href="mailto:info@familytreeindia.org?subject=Donation Inquiry" class="btn-b">Donate Now</a>
      <a href="<?php echo SITE_URL; ?>/corporate" class="link-arr"
        style="font-size:0.73rem;color:rgba(0,0,0,0.45);border-color:rgba(0,0,0,0.18);margin-top:20px;display:inline-block">Or
        sponsor a school</a>
    </div>
  </div>

<?php include_once 'includes/footer.php'; ?>
