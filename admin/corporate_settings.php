<?php
include_once '../includes/config.php';
$pageTitle = "Corporate Page Settings";
$activePage = "corporate_settings";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_corporate'])) {
    foreach($_POST['settings'] as $key => $value) {
        $val = $conn->real_escape_string($value);
        $conn->query("UPDATE site_settings SET setting_value = '$val' WHERE setting_key = '$key'");
    }
    $msg = "Corporate page settings updated successfully!";
}

// Fetch current settings
$settings = [];
$res = $conn->query("SELECT * FROM site_settings WHERE setting_key LIKE 'corp_%'");
while($row = $res->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

<main class="main-content">
  <header class="header-admin">
    <div class="welcome-msg">
      <h2>Corporate Page Settings</h2>
      <p>Manage content, partnership cards, and certifications for the Corporate page.</p>
    </div>
  </header>

  <?php if($msg): ?>
    <div style="padding: 16px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
      <?php echo $msg; ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="" class="settings-form-grid">
    
    <!-- HERO SECTION -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-mountain-sun"></i> Hero Section</h3>
      <div class="form-group">
        <label>Hero Tag</label>
        <input type="text" name="settings[corp_hero_tag]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_hero_tag'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Hero Title (Split)</label>
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <input type="text" name="settings[corp_hero_title_main]" class="form-control" placeholder="Main..." value="<?php echo htmlspecialchars($settings['corp_hero_title_main'] ?? ''); ?>">
          <input type="text" name="settings[corp_hero_title_highlight]" class="form-control" style="color: var(--green-mid); font-weight: bold;" placeholder="Highlight..." value="<?php echo htmlspecialchars($settings['corp_hero_title_highlight'] ?? ''); ?>">
          <input type="text" name="settings[corp_hero_title_end]" class="form-control" placeholder="End..." value="<?php echo htmlspecialchars($settings['corp_hero_title_end'] ?? ''); ?>">
        </div>
      </div>
      <div class="form-group">
        <label>Hero Subtext</label>
        <input type="text" name="settings[corp_hero_sub]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_hero_sub'] ?? ''); ?>">
      </div>
    </div>

    <!-- INTRO SECTION -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-circle-info"></i> Intro Section</h3>
      <div class="form-group">
        <label>Eyebrow</label>
        <input type="text" name="settings[corp_intro_eyebrow]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_intro_eyebrow'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Title (Split)</label>
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <input type="text" name="settings[corp_intro_title_main]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_intro_title_main'] ?? ''); ?>">
          <input type="text" name="settings[corp_intro_title_highlight]" class="form-control" style="color: var(--green-mid); font-weight: bold;" value="<?php echo htmlspecialchars($settings['corp_intro_title_highlight'] ?? ''); ?>">
          <input type="text" name="settings[corp_intro_title_end]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_intro_title_end'] ?? ''); ?>">
        </div>
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea name="settings[corp_intro_text]" class="form-control tinymce-editor" rows="3"><?php echo htmlspecialchars($settings['corp_intro_text'] ?? ''); ?></textarea>
      </div>
      <div class="form-group">
        <label>Bottom Note</label>
        <input type="text" name="settings[corp_intro_note]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_intro_note'] ?? ''); ?>">
      </div>
    </div>

    <!-- PARTNERSHIP CARDS -->
    <div class="settings-card" style="grid-column: span 2;">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-handshake-angle"></i> Partnership Options (3 Cards)</h3>
      <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
        <!-- CARD 1 -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 12px; border: 1px solid #eee;">
          <h4 style="margin-bottom: 15px; color: var(--green-mid);">Card 01</h4>
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="settings[corp_card1_title]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_card1_title'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label>Subtitle</label>
            <textarea name="settings[corp_card1_sub]" class="form-control" rows="2"><?php echo htmlspecialchars($settings['corp_card1_sub'] ?? ''); ?></textarea>
          </div>
          <div class="form-group">
            <label>Features List (HTML <code>&lt;li&gt;</code>)</label>
            <textarea name="settings[corp_card1_list]" class="form-control tinymce-editor" rows="5"><?php echo htmlspecialchars($settings['corp_card1_list'] ?? ''); ?></textarea>
          </div>
        </div>
        <!-- CARD 2 -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 12px; border: 1px solid #eee;">
          <h4 style="margin-bottom: 15px; color: var(--green-mid);">Card 02 (Featured)</h4>
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="settings[corp_card2_title]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_card2_title'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label>Subtitle</label>
            <textarea name="settings[corp_card2_sub]" class="form-control" rows="2"><?php echo htmlspecialchars($settings['corp_card2_sub'] ?? ''); ?></textarea>
          </div>
          <div class="form-group">
            <label>Features List (HTML <code>&lt;li&gt;</code>)</label>
            <textarea name="settings[corp_card2_list]" class="form-control tinymce-editor" rows="5"><?php echo htmlspecialchars($settings['corp_card2_list'] ?? ''); ?></textarea>
          </div>
        </div>
        <!-- CARD 3 -->
        <div style="background: #f9f9f9; padding: 20px; border-radius: 12px; border: 1px solid #eee;">
          <h4 style="margin-bottom: 15px; color: var(--green-mid);">Card 03</h4>
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="settings[corp_card3_title]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_card3_title'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label>Subtitle</label>
            <textarea name="settings[corp_card3_sub]" class="form-control" rows="2"><?php echo htmlspecialchars($settings['corp_card3_sub'] ?? ''); ?></textarea>
          </div>
          <div class="form-group">
            <label>Features List (HTML <code>&lt;li&gt;</code>)</label>
            <textarea name="settings[corp_card3_list]" class="form-control tinymce-editor" rows="5"><?php echo htmlspecialchars($settings['corp_card3_list'] ?? ''); ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- ADD-ONS & RECEIVE -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-plus-circle"></i> Add-Ons & What Partners Receive</h3>
      <div class="form-group">
        <label>Add-ons List (HTML Structure)</label>
        <textarea name="settings[corp_addons_list]" class="form-control tinymce-editor" rows="10"><?php echo htmlspecialchars($settings['corp_addons_list'] ?? ''); ?></textarea>
      </div>
      <div class="form-group">
        <label>Receive Items (HTML Structure)</label>
        <textarea name="settings[corp_receive_list]" class="form-control tinymce-editor" rows="10"><?php echo htmlspecialchars($settings['corp_receive_list'] ?? ''); ?></textarea>
      </div>
      <div class="form-group">
        <label>Receive Closing Note</label>
        <input type="text" name="settings[corp_receive_closing]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_receive_closing'] ?? ''); ?>">
      </div>
    </div>

    <!-- CERTIFICATIONS -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-certificate"></i> Certifications</h3>
      <div style="display: grid; gap: 15px;">
        <div style="padding: 15px; border: 1px solid #eee; border-radius: 8px;">
          <input type="text" name="settings[corp_cert1_title]" class="form-control" placeholder="Cert 1 Title" value="<?php echo htmlspecialchars($settings['corp_cert1_title'] ?? ''); ?>" style="margin-bottom: 8px;">
          <textarea name="settings[corp_cert1_desc]" class="form-control" rows="2" placeholder="Cert 1 Desc"><?php echo htmlspecialchars($settings['corp_cert1_desc'] ?? ''); ?></textarea>
        </div>
        <div style="padding: 15px; border: 1px solid #eee; border-radius: 8px;">
          <input type="text" name="settings[corp_cert2_title]" class="form-control" placeholder="Cert 2 Title" value="<?php echo htmlspecialchars($settings['corp_cert2_title'] ?? ''); ?>" style="margin-bottom: 8px;">
          <textarea name="settings[corp_cert2_desc]" class="form-control" rows="2" placeholder="Cert 2 Desc"><?php echo htmlspecialchars($settings['corp_cert2_desc'] ?? ''); ?></textarea>
        </div>
        <div style="padding: 15px; border: 1px solid #eee; border-radius: 8px;">
          <input type="text" name="settings[corp_cert3_title]" class="form-control" placeholder="Cert 3 Title" value="<?php echo htmlspecialchars($settings['corp_cert3_title'] ?? ''); ?>" style="margin-bottom: 8px;">
          <textarea name="settings[corp_cert3_desc]" class="form-control" rows="2" placeholder="Cert 3 Desc"><?php echo htmlspecialchars($settings['corp_cert3_desc'] ?? ''); ?></textarea>
        </div>
      </div>
    </div>

    <!-- CTA SECTION -->
    <div class="settings-card" style="grid-column: span 2;">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-paper-plane"></i> CTA Section</h3>
      <div class="form-row-grid">
        <div class="form-group">
          <label>CTA Title (Split)</label>
          <input type="text" name="settings[corp_cta_title_main]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_cta_title_main'] ?? ''); ?>" style="margin-bottom: 8px;">
          <input type="text" name="settings[corp_cta_title_highlight]" class="form-control" style="color: var(--green-mid); font-weight: bold;" value="<?php echo htmlspecialchars($settings['corp_cta_title_highlight'] ?? ''); ?>" style="margin-bottom: 8px;">
          <input type="text" name="settings[corp_cta_title_end]" class="form-control" value="<?php echo htmlspecialchars($settings['corp_cta_title_end'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>CTA Subtext</label>
          <textarea name="settings[corp_cta_sub]" class="form-control" rows="4"><?php echo htmlspecialchars($settings['corp_cta_sub'] ?? ''); ?></textarea>
        </div>
      </div>
    </div>

    <div class="settings-actions">
      <button type="submit" name="update_corporate" class="btn-login" style="width: auto; padding: 16px 48px;">Save Corporate Page Changes</button>
    </div>
  </form>
</main>

<script>
  tinymce.init({
    selector: 'textarea.tinymce-editor',
    plugins: 'link lists autoresize code',
    toolbar: 'undo redo | bold italic | bullist numlist | link | code',
    menubar: false,
    statusbar: false,
    autoresize_bottom_margin: 20,
    branding: false,
    height: 150
  });
</script>

<?php include_once 'includes/footer.php'; ?>
