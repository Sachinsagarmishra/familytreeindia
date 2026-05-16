<?php 
$pageTitle = "About Us";
$extraCSS = ["about.css"];
$extraJS = ["about.js"];
$navClass = "abt-nav";
include_once 'includes/header.php'; 
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "<?php echo $site['about_founder_name'] ?? 'Ajay Sinha'; ?>",
  "jobTitle": "<?php echo $site['about_founder_designation'] ?? 'Founder'; ?>",
  "affiliation": {
    "@type": "NonprofitOrganization",
    "name": "Family Tree Foundation"
  },
  "description": "Founder of Family Tree Foundation, dedicated to building permanent green cover through schools and communities in India.",
  "image": "<?php echo SITE_URL; ?>/img/<?php echo $site['about_founder_img'] ?? 'ajay-sinha-founder.jpeg'; ?>"
}
</script>
<?php
?>

  <!-- SECTION 1: ABOUT INTRO + 3 PHOTOS -->
  <section class="abt-intro">
    <div class="abt-intro-inner">
      <p class="abt-eyebrow abt-reveal"><?php echo htmlspecialchars($site['about_intro_eyebrow'] ?? 'ABOUT US'); ?></p>
      <h1 class="abt-intro-h1 abt-reveal">
        <?php echo ($site['about_intro_title_main'] ?? 'Family Tree Foundation is a'); ?> 
        <i><?php echo ($site['about_intro_title_highlight'] ?? 'non-profit organisation'); ?></i> 
        <?php echo ($site['about_intro_title_end'] ?? 'building permanent green cover through schools and communities.'); ?>
      </h1>
      <div class="abt-photos abt-reveal">
        <div class="abt-photos-track">
          <div class="abt-photo">
            <img src="<?php echo SITE_URL; ?>/img/<?php echo $site['about_intro_img1'] ?? '4.jpeg'; ?>" alt="School students participating in tree plantation drive in Bihar" loading="lazy" />
          </div>
          <div class="abt-photo abt-photo-tall">
            <img src="<?php echo SITE_URL; ?>/img/<?php echo $site['about_intro_img2'] ?? 'twogirlplanting.jpeg'; ?>" alt="Two young students planting a native sapling together" loading="lazy" />
          </div>
          <div class="abt-photo">
            <img src="<?php echo SITE_URL; ?>/img/<?php echo $site['about_intro_img3'] ?? '11.jpeg'; ?>" alt="Family Tree Foundation green campus initiative" loading="lazy" />
          </div>
          <!-- Mobile only marquee images -->
          <?php for($i=1; $i<=8; $i++): $k = "about_marquee_img$i"; ?>
          <div class="abt-photo abt-photo-mob">
            <img src="<?php echo SITE_URL; ?>/img/<?php echo $site[$k] ?? '1.jpeg'; ?>" alt="Family Tree Impact" loading="lazy" />
          </div>
          <?php endfor; ?>
          <!-- Duplicates for loop (re-use same dynamic images) -->
          <?php for($i=1; $i<=8; $i++): $k = "about_marquee_img$i"; ?>
          <div class="abt-photo abt-photo-mob">
            <img src="<?php echo SITE_URL; ?>/img/<?php echo $site[$k] ?? '1.jpeg'; ?>" alt="Family Tree Impact" loading="lazy" />
          </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 2: MISSION + STATS -->
  <section class="abt-mission" id="story">
    <div class="abt-mission-inner abt-reveal">
      <h2 class="abt-mission-h2">
        <?php echo ($site['about_mission_title_main'] ?? 'Together, we can build a'); ?> 
        <i><?php echo ($site['about_mission_title_highlight'] ?? 'greener'); ?></i> 
        <?php echo ($site['about_mission_title_end'] ?? 'Bihar'); ?>
      </h2>
      <div class="abt-mission-p">
        <?php echo ($site['about_mission_text'] ?? ''); ?>
        <p style="margin-top: 15px; font-weight: 600; color: var(--green-mid);">Our initiative is supported by the <strong>Bihar Education Project Council (BEPC)</strong>, ensuring large-scale environmental impact across government schools in Bihar.</p>
      </div>
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
              <div class="abt-stat-num" data-target="<?php echo $site['about_target_districts'] ?? '0'; ?>">0</div>
              <div class="abt-stat-lbl">DISTRICTS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="<?php echo $site['about_target_blocks'] ?? '0'; ?>">0</div>
              <div class="abt-stat-lbl">BLOCKS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="<?php echo $site['about_target_schools'] ?? '0'; ?>">0</div>
              <div class="abt-stat-lbl">SCHOOLS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="<?php echo $site['about_target_plants'] ?? '0'; ?>">0</div>
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
              <div class="abt-stat-num" data-target="<?php echo $site['about_completed_districts'] ?? '0'; ?>">0</div>
              <div class="abt-stat-lbl">DISTRICTS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="<?php echo $site['about_completed_blocks'] ?? '0'; ?>">0</div>
              <div class="abt-stat-lbl">BLOCKS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="<?php echo $site['about_completed_schools'] ?? '0'; ?>">0</div>
              <div class="abt-stat-lbl">SCHOOLS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="<?php echo $site['about_completed_guardians'] ?? '0'; ?>">0</div>
              <div class="abt-stat-lbl">STUDENT GUARDIANS</div>
            </div>
            <div class="abt-stat">
              <div class="abt-stat-num" data-target="<?php echo $site['about_completed_trees'] ?? '0'; ?>">0</div>
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
        <h2 class="founder-h2"><?php echo ($site['about_founder_title'] ?? 'Founder'); ?></h2>
        <div class="abt-promise-p"><?php echo ($site['about_founder_text'] ?? ''); ?></div>
        <div class="founder-sign">
          <p class="fs-name"><?php echo htmlspecialchars($site['about_founder_name'] ?? ''); ?></p>
          <p class="fs-title"><?php echo htmlspecialchars($site['about_founder_designation'] ?? ''); ?></p>
          <?php if(!empty($site['founder_linkedin_url'])): ?>
          <a href="<?php echo $site['founder_linkedin_url']; ?>" target="_blank" class="founder-social" style="color: #0077b5; font-size: 1.2rem; margin-top: 10px; display: inline-block;">
            <i class="fa-brands fa-linkedin"></i>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="abt-promise-img abt-reveal">
        <img src="<?php echo SITE_URL; ?>/img/<?php echo $site['about_founder_img'] ?? 'ajay-sinha-founder.jpeg'; ?>" alt="Ajay Sinha, Founder of Family Tree Foundation" loading="lazy" />
      </div>
    </div>
  </section>

  <!-- SECTION 3: LEADERSHIP WITH IMPACT -->
  <section class="abt-promise" id="leadership">
    <div class="abt-promise-inner">
      <div class="abt-promise-img abt-reveal">
        <img src="<?php echo SITE_URL; ?>/img/<?php echo $site['about_leader_img'] ?? 'founderimage.jpg'; ?>" alt="Leadership team at Family Tree Foundation" loading="lazy" />
        <div class="abt-promise-overlay">
          <div class="abt-founder-name"><?php echo htmlspecialchars($site['about_leader_name'] ?? ''); ?></div>
          <div class="abt-founder-org"><?php echo htmlspecialchars($site['about_leader_designation'] ?? ''); ?></div>
        </div>
      </div>
      <div class="abt-promise-body abt-reveal">
        <p class="abt-eyebrow"><?php echo htmlspecialchars($site['about_leader_eyebrow'] ?? 'LEADERSHIP'); ?></p>
        <h2 class="abt-promise-h2">
          <?php echo ($site['about_leader_title_main'] ?? 'Leadership with'); ?> 
          <i><?php echo ($site['about_leader_title_highlight'] ?? 'Impact'); ?></i> 
          <?php echo ($site['about_leader_title_end'] ?? ''); ?>
        </h2>
        <div class="abt-promise-p"><?php echo ($site['about_leader_text1'] ?? ''); ?></div>
        <div class="abt-promise-p"><?php echo ($site['about_leader_text2'] ?? ''); ?></div>
      </div>
    </div>
  </section>

  <!-- SECTION 5: PARTNERS -->
  <section class="abt-partners">
    <div class="abt-partners-inner">
      <div class="abt-partners-head abt-reveal">
        <p class="abt-eyebrow"><?php echo htmlspecialchars($site['about_partners_eyebrow'] ?? 'OUR PARTNERS & SUPPORTERS'); ?></p>
        <h2 class="abt-partners-h2">
          <?php echo ($site['about_partners_title_main'] ?? 'Backed by institutions'); ?> 
          <i><?php echo ($site['about_partners_title_highlight'] ?? 'that matter.'); ?></i> 
          <?php echo ($site['about_partners_title_end'] ?? ''); ?>
        </h2>
      </div>
      <div class="abt-partners-logos abt-reveal">
        <?php 
        $partners_res = $conn->query("SELECT * FROM partners ORDER BY order_index ASC, id DESC");
        if ($partners_res && $partners_res->num_rows > 0):
          while($p = $partners_res->fetch_assoc()):
            // Check if it's a new upload (img/partners/) or legacy (Icons/black/)
            $logo_path = (file_exists("img/partners/" . $p['logo'])) 
                        ? SITE_URL . "/img/partners/" . $p['logo'] 
                        : SITE_URL . "/Icons/black/" . $p['logo'];
        ?>
        <div class="abt-partner-logo">
          <img src="<?php echo $logo_path; ?>" alt="<?php echo htmlspecialchars($p['name']); ?>" />
        </div>
        <?php endwhile; else: ?>
          <!-- Fallback if table is empty but seeding failed -->
          <div class="abt-partner-logo"><img src="<?php echo SITE_URL; ?>/Icons/black/Bihar-Education-Project-Council.svg" alt="Partner" /></div>
          <div class="abt-partner-logo"><img src="<?php echo SITE_URL; ?>/Icons/black/aiims-delhi.svg" alt="Partner" /></div>
          <div class="abt-partner-logo"><img src="<?php echo SITE_URL; ?>/Icons/black/Government-of-Bihar.svg" alt="Partner" /></div>
        <?php endif; ?>
      </div>
    </div>
  </section>

<?php include_once 'includes/footer.php'; ?>
