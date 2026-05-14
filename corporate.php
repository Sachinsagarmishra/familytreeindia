<?php 
$pageTitle = "Corporate Partnerships";
$extraCSS = ["corporate.css"];
$extraJS = ["corporate.js"];
$navClass = "corp-nav";
include_once 'includes/header.php'; 
?>

  <!-- CORP HERO -->
  <section class="corp-hero">
    <div class="corp-hero-bg"></div>
    <div class="corp-hero-overlay"></div>
    <div class="corp-hero-content">
      <p class="corp-tag"><span class="corp-tag-line"></span><?php echo htmlspecialchars($site['corp_hero_tag'] ?? 'CSR Partnerships'); ?></p>
      <h1 class="corp-h1">
        <?php echo ($site['corp_hero_title_main'] ?? 'Corporate'); ?><br />
        <i><?php echo ($site['corp_hero_title_highlight'] ?? 'Partnerships'); ?></i>
        <?php echo ($site['corp_hero_title_end'] ?? ''); ?>
      </h1>
      <p class="corp-hero-sub"><?php echo htmlspecialchars($site['corp_hero_sub'] ?? 'Bachpan Sang Hariyali × Family Tree Foundation'); ?></p>
    </div>
  </section>

  <!-- INTRO -->
  <section class="corp-intro">
    <div class="corp-intro-inner">
      <div class="corp-intro-left corp-reveal">
        <p class="eyebrow"><span></span><?php echo htmlspecialchars($site['corp_intro_eyebrow'] ?? 'About the Program'); ?></p>
        <h2 class="corp-intro-h2">
          <?php echo ($site['corp_intro_title_main'] ?? 'Transforming school'); ?><br />
          <?php echo ($site['corp_intro_title_highlight'] ?? 'campuses into'); ?><br />
          <i><?php echo ($site['corp_intro_title_end'] ?? 'greener spaces.'); ?></i>
        </h2>
      </div>
      <div class="corp-intro-right corp-reveal">
        <div class="corp-intro-p"><?php echo ($site['corp_intro_text'] ?? 'Partner with us to help transform government school campuses across Bihar into greener, cooler, and climate-resilient spaces through survival-first plantation and sustainable campus greening.'); ?></div>
        <p class="corp-intro-note"><?php echo htmlspecialchars($site['corp_intro_note'] ?? 'Implemented in partnership with the Education Department, Government of Bihar.'); ?></p>
        <a href="#partnership-options" class="link-arr">Explore Partnership Options</a>
      </div>
    </div>
  </section>

  <!-- PARTNERSHIP OPTIONS -->
  <section class="corp-options" id="partnership-options">
    <div class="corp-options-head corp-reveal">
      <p class="eyebrow"><span></span><?php echo htmlspecialchars($site['corp_options_eyebrow'] ?? 'Partnership Options'); ?></p>
      <h2 class="corp-sec-h2">
        <?php echo ($site['corp_options_title_main'] ?? 'Choose your level'); ?><br />
        of <i><?php echo ($site['corp_options_title_highlight'] ?? 'impact.'); ?></i>
        <?php echo ($site['corp_options_title_end'] ?? ''); ?>
      </h2>
    </div>

    <div class="corp-cards corp-reveal">
      <!-- CARD 1 -->
      <div class="corp-card">
        <div class="corp-card-accent"></div>
        <div class="corp-card-badge">01</div>
        <h3 class="corp-card-title"><?php echo htmlspecialchars($site['corp_card1_title'] ?? 'Adopt a School'); ?></h3>
        <p class="corp-card-sub"><?php echo htmlspecialchars($site['corp_card1_sub'] ?? 'Support greening within a single government school campus.'); ?></p>
        <p class="corp-card-inc">This can include:</p>
        <ul class="corp-card-list">
          <?php echo ($site['corp_card1_list'] ?? '<li><span class="check-ico">🌳</span> 50–100 native and climate-adapted trees</li>'); ?>
        </ul>
        <a href="mailto:info@familytreeindia.org?subject=Inquiry: Adopt a School" class="corp-card-cta">Get Started →</a>
      </div>

      <!-- CARD 2 -->
      <div class="corp-card corp-card-featured">
        <div class="corp-card-accent"></div>
        <div class="corp-card-badge">02</div>
        <h3 class="corp-card-title"><?php echo htmlspecialchars($site['corp_card2_title'] ?? 'Adopt a Block / Cluster'); ?></h3>
        <p class="corp-card-sub"><?php echo htmlspecialchars($site['corp_card2_sub'] ?? 'Support implementation across multiple schools within a block or cluster.'); ?></p>
        <p class="corp-card-inc">This can include:</p>
        <ul class="corp-card-list">
          <?php echo ($site['corp_card2_list'] ?? '<li><span class="check-ico">🏫</span> Multi-school plantation rollout</li>'); ?>
        </ul>
        <a href="mailto:info@familytreeindia.org?subject=Inquiry: Adopt a Block" class="corp-card-cta">Get Started →</a>
      </div>

      <!-- CARD 3 -->
      <div class="corp-card">
        <div class="corp-card-accent"></div>
        <div class="corp-card-badge">03</div>
        <h3 class="corp-card-title"><?php echo htmlspecialchars($site['corp_card3_title'] ?? 'Adopt a District'); ?></h3>
        <p class="corp-card-sub"><?php echo htmlspecialchars($site['corp_card3_sub'] ?? 'Enable large-scale environmental impact across an entire district.'); ?></p>
        <p class="corp-card-inc">This can include:</p>
        <ul class="corp-card-list">
          <?php echo ($site['corp_card3_list'] ?? '<li><span class="check-ico">🗺️</span> District-wide plantation implementation</li>'); ?>
        </ul>
        <a href="mailto:info@familytreeindia.org?subject=Inquiry: Adopt a District" class="corp-card-cta">Get Started →</a>
      </div>
    </div>
  </section>

  <!-- ADD-ONS -->
  <section class="corp-addons">
    <div class="corp-addons-inner">
      <div class="corp-addons-head corp-reveal">
        <p class="eyebrow"><span></span><?php echo htmlspecialchars($site['corp_addons_eyebrow'] ?? 'Enhance Your Impact'); ?></p>
        <h2 class="corp-sec-h2">
          <?php echo ($site['corp_addons_title_main'] ?? 'Optional'); ?><br />
          <i><?php echo ($site['corp_addons_title_highlight'] ?? 'Add-Ons'); ?></i>
          <?php echo ($site['corp_addons_title_end'] ?? ''); ?>
        </h2>
        <p class="corp-addons-note"><?php echo htmlspecialchars($site['corp_addons_note'] ?? 'Partners may also choose to support:'); ?></p>
      </div>
      <div class="corp-addon-grid corp-reveal">
        <?php echo ($site['corp_addons_list'] ?? '<div class="corp-addon-item"><span class="addon-ico">🛡️</span><span class="addon-txt">Tree guards and protective fencing</span></div>'); ?>
      </div>
    </div>
  </section>

  <!-- WHAT PARTNERS RECEIVE -->
  <section class="corp-receive">
    <div class="corp-receive-inner">
      <div class="corp-receive-left corp-reveal">
        <p class="eyebrow"><span></span><?php echo htmlspecialchars($site['corp_receive_eyebrow'] ?? 'What Partners Receive'); ?></p>
        <h2 class="corp-sec-h2">
          <?php echo ($site['corp_receive_title_main'] ?? 'Everything you need'); ?><br />
          for <i><?php echo ($site['corp_receive_title_highlight'] ?? 'measurable'); ?></i><br />
          <?php echo ($site['corp_receive_title_end'] ?? 'impact.'); ?>
        </h2>
      </div>
      <div class="corp-receive-right corp-reveal">
        <div class="corp-receive-items">
          <?php echo ($site['corp_receive_list'] ?? ''); ?>
        </div>
        <p class="corp-receive-closing"><?php echo htmlspecialchars($site['corp_receive_closing'] ?? 'A measurable and long-term environmental initiative rooted in survival, not just plantation numbers.'); ?></p>
      </div>
    </div>
  </section>

  <!-- CERTIFICATIONS -->
  <section class="corp-certs">
    <div class="corp-certs-inner corp-reveal">
      <p class="eyebrow"><span></span><?php echo htmlspecialchars($site['corp_certs_eyebrow'] ?? 'Certifications & Registrations'); ?></p>
      <h2 class="corp-sec-h2">
        <?php echo ($site['corp_certs_title_main'] ?? 'Fully compliant.'); ?><br />
        <i><?php echo ($site['corp_certs_title_highlight'] ?? 'Fully transparent.'); ?></i>
        <?php echo ($site['corp_certs_title_end'] ?? ''); ?>
      </h2>
      <div class="corp-cert-grid">
        <div class="corp-cert-card">
          <div class="cert-icon">📋</div>
          <h4 class="cert-title"><?php echo htmlspecialchars($site['corp_cert1_title'] ?? 'CSR-1 Registration'); ?></h4>
          <p class="cert-desc"><?php echo htmlspecialchars($site['corp_cert1_desc'] ?? 'Registered under the Companies Act, 2013 for eligible CSR spending by corporate partners.'); ?></p>
        </div>
        <div class="corp-cert-card">
          <div class="cert-icon">🏛️</div>
          <h4 class="cert-title"><?php echo htmlspecialchars($site['corp_cert2_title'] ?? '80G Certification'); ?></h4>
          <p class="cert-desc"><?php echo htmlspecialchars($site['corp_cert2_desc'] ?? 'Donations are eligible for tax deduction under Section 80G of the Income Tax Act.'); ?></p>
        </div>
        <div class="corp-cert-card">
          <div class="cert-icon">🔖</div>
          <h4 class="cert-title"><?php echo htmlspecialchars($site['corp_cert3_title'] ?? 'DARPAN Registration'); ?></h4>
          <p class="cert-desc"><?php echo htmlspecialchars($site['corp_cert3_desc'] ?? 'Registered on the NITI Aayog DARPAN portal as a verified non-profit organisation.'); ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="corp-cta-sec">
    <div class="corp-cta-inner corp-reveal">
      <h2 class="corp-cta-h2">
        <?php echo ($site['corp_cta_title_main'] ?? 'Ready to create'); ?><br />
        a <i><?php echo ($site['corp_cta_title_highlight'] ?? 'lasting'); ?></i>
        <?php echo ($site['corp_cta_title_end'] ?? 'green legacy?'); ?>
      </h2>
      <p class="corp-cta-sub"><?php echo htmlspecialchars($site['corp_cta_sub'] ?? 'Start a conversation with our partnerships team and discover how your organisation can drive measurable environmental change.'); ?></p>
      <div class="corp-cta-btns">
        <a href="mailto:info@familytreeindia.org?subject=Corporate Partnership Inquiry" class="btn-y">Partner With Us</a>
        <a href="<?php echo SITE_URL; ?>" class="btn-w">Back to Home</a>
      </div>
    </div>
  </section>

<?php include_once 'includes/footer.php'; ?>
