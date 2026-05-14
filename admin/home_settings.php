<?php
include_once '../includes/config.php';
$pageTitle = "Home Page Settings";
$activePage = "home_settings";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

$msg = "";
$error = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_home'])) {
    // Update text settings
    if (isset($_POST['settings'])) {
        foreach($_POST['settings'] as $key => $value) {
            $val = $conn->real_escape_string($value);
            $conn->query("UPDATE site_settings SET setting_value = '$val' WHERE setting_key = '$key'");
        }
    }
    
    // Handle Hero Background Upload
    if (isset($_FILES['hero_bg']) && $_FILES['hero_bg']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($_FILES['hero_bg']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $new_name = "hero_bg_live." . $ext;
            if (move_uploaded_file($_FILES['hero_bg']['tmp_name'], "../img/" . $new_name)) {
                $conn->query("UPDATE site_settings SET setting_value = '$new_name' WHERE setting_key = 'home_hero_bg'");
            }
        }
    }

    $msg = "Home page settings updated successfully!";
}

// Fetch current settings
$settings = [];
$res = $conn->query("SELECT * FROM site_settings WHERE setting_key LIKE 'home_%'");
while($row = $res->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

<main class="main-content">
  <header class="header-admin">
    <div class="welcome-msg">
      <h2>Home Page Settings</h2>
      <p>Manage hero content, impact stats, and main sections of the homepage.</p>
    </div>
  </header>

  <?php if($msg): ?>
    <div style="padding: 16px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
      <?php echo $msg; ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="" enctype="multipart/form-data" class="settings-form-grid">
    
    <!-- HERO SECTION -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-star"></i> Hero Section</h3>
      <div class="form-group">
        <label>Hero Tag (Bachpan Sang...)</label>
        <input type="text" name="settings[home_hero_tag]" class="form-control" value="<?php echo htmlspecialchars($settings['home_hero_tag'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Hero Title (Split)</label>
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <input type="text" name="settings[home_hero_title_main]" class="form-control" placeholder="Main text..." value="<?php echo htmlspecialchars($settings['home_hero_title_main'] ?? ''); ?>">
          <input type="text" name="settings[home_hero_title_highlight]" class="form-control" style="color: var(--green-mid); font-weight: bold;" placeholder="Highlight (Green/Italic)..." value="<?php echo htmlspecialchars($settings['home_hero_title_highlight'] ?? ''); ?>">
          <input type="text" name="settings[home_hero_title_end]" class="form-control" placeholder="End text..." value="<?php echo htmlspecialchars($settings['home_hero_title_end'] ?? ''); ?>">
        </div>
      </div>
      <div class="form-group">
        <label>Hero Subtext</label>
        <textarea name="settings[home_hero_sub]" class="form-control" rows="3"><?php echo htmlspecialchars($settings['home_hero_sub'] ?? ''); ?></textarea>
      </div>
      <div class="form-group">
        <label>Hero Background Image</label>
        <input type="file" name="hero_bg" class="form-control" accept=".jpg,.jpeg,.png,.webp">
        <?php if(isset($settings['home_hero_bg'])): ?>
          <p style="font-size: 0.75rem; margin-top: 8px; color: #666;">Current: <code><?php echo $settings['home_hero_bg']; ?></code></p>
        <?php endif; ?>
      </div>
    </div>

    <!-- IMPACT STATS -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-chart-simple"></i> Impact Metrics (Stat Band)</h3>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div class="form-group">
          <label>Stat 1 Value</label>
          <input type="text" name="settings[home_stat1_val]" class="form-control" value="<?php echo htmlspecialchars($settings['home_stat1_val'] ?? ''); ?>">
          <input type="text" name="settings[home_stat1_lbl]" class="form-control" style="margin-top:4px; font-size:0.8rem;" value="<?php echo htmlspecialchars($settings['home_stat1_lbl'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Stat 2 Value</label>
          <input type="text" name="settings[home_stat2_val]" class="form-control" value="<?php echo htmlspecialchars($settings['home_stat2_val'] ?? ''); ?>">
          <input type="text" name="settings[home_stat2_lbl]" class="form-control" style="margin-top:4px; font-size:0.8rem;" value="<?php echo htmlspecialchars($settings['home_stat2_lbl'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Stat 3 Value</label>
          <input type="text" name="settings[home_stat3_val]" class="form-control" value="<?php echo htmlspecialchars($settings['home_stat3_val'] ?? ''); ?>">
          <input type="text" name="settings[home_stat3_lbl]" class="form-control" style="margin-top:4px; font-size:0.8rem;" value="<?php echo htmlspecialchars($settings['home_stat3_lbl'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Stat 4 Value</label>
          <input type="text" name="settings[home_stat4_val]" class="form-control" value="<?php echo htmlspecialchars($settings['home_stat4_val'] ?? ''); ?>">
          <input type="text" name="settings[home_stat4_lbl]" class="form-control" style="margin-top:4px; font-size:0.8rem;" value="<?php echo htmlspecialchars($settings['home_stat4_lbl'] ?? ''); ?>">
        </div>
      </div>
      <div class="form-group">
        <label>Stat Footnote</label>
        <textarea name="settings[home_stat_footnote]" class="form-control" rows="3"><?php echo htmlspecialchars($settings['home_stat_footnote'] ?? ''); ?></textarea>
      </div>
    </div>

    <!-- STORY SECTION -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-book-open"></i> Who We Are (Story)</h3>
      <div class="form-group">
        <label>Visual Pull-Quote (Left Side)</label>
        <input type="text" name="settings[home_story_pull]" class="form-control" value="<?php echo htmlspecialchars($settings['home_story_pull'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Eyebrow</label>
        <input type="text" name="settings[home_story_eyebrow]" class="form-control" value="<?php echo htmlspecialchars($settings['home_story_eyebrow'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Title (Split)</label>
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <input type="text" name="settings[home_story_title_main]" class="form-control" value="<?php echo htmlspecialchars($settings['home_story_title_main'] ?? ''); ?>">
          <input type="text" name="settings[home_story_title_highlight]" class="form-control" style="color: var(--green-mid); font-weight: bold;" value="<?php echo htmlspecialchars($settings['home_story_title_highlight'] ?? ''); ?>">
          <input type="text" name="settings[home_story_title_end]" class="form-control" value="<?php echo htmlspecialchars($settings['home_story_title_end'] ?? ''); ?>">
        </div>
      </div>
      <div class="form-group">
        <label>Paragraph 1</label>
        <textarea name="settings[home_story_text1]" class="form-control tinymce-editor" rows="4"><?php echo htmlspecialchars($settings['home_story_text1'] ?? ''); ?></textarea>
      </div>
      <div class="form-group">
        <label>Paragraph 2</label>
        <textarea name="settings[home_story_text2]" class="form-control tinymce-editor" rows="4"><?php echo htmlspecialchars($settings['home_story_text2'] ?? ''); ?></textarea>
      </div>
    </div>

    <!-- HBM SECTION -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-landmark"></i> Bachpan Sang Hariyali (HBM)</h3>
      <div class="form-group">
        <label>Badge Text</label>
        <input type="text" name="settings[home_hbm_badge]" class="form-control" value="<?php echo htmlspecialchars($settings['home_hbm_badge'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Title (Split)</label>
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <input type="text" name="settings[home_hbm_title_main]" class="form-control" value="<?php echo htmlspecialchars($settings['home_hbm_title_main'] ?? ''); ?>">
          <input type="text" name="settings[home_hbm_title_highlight]" class="form-control" style="color: var(--green-mid); font-weight: bold;" value="<?php echo htmlspecialchars($settings['home_hbm_title_highlight'] ?? ''); ?>">
          <input type="text" name="settings[home_hbm_title_end]" class="form-control" value="<?php echo htmlspecialchars($settings['home_hbm_title_end'] ?? ''); ?>">
        </div>
      </div>
      <div class="form-group">
        <label>Subtitle</label>
        <input type="text" name="settings[home_hbm_subtitle]" class="form-control" value="<?php echo htmlspecialchars($settings['home_hbm_subtitle'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea name="settings[home_hbm_text]" class="form-control tinymce-editor" rows="5"><?php echo htmlspecialchars($settings['home_hbm_text'] ?? ''); ?></textarea>
      </div>
      <div class="form-group">
        <label>Highlighted Note</label>
        <textarea name="settings[home_hbm_highlight]" class="form-control tinymce-editor" rows="3"><?php echo htmlspecialchars($settings['home_hbm_highlight'] ?? ''); ?></textarea>
      </div>
    </div>

    <!-- DONATE & FOOTER CTA -->
    <div class="settings-card" style="grid-column: span 2;">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-heart"></i> Donation Section (Bottom)</h3>
      <div class="form-row-grid">
        <div class="form-group">
          <label>Donate Title (Split)</label>
          <input type="text" name="settings[home_donate_title_main]" class="form-control" value="<?php echo htmlspecialchars($settings['home_donate_title_main'] ?? ''); ?>" style="margin-bottom: 8px;">
          <input type="text" name="settings[home_donate_title_highlight]" class="form-control" style="color: var(--green-mid); font-weight: bold;" value="<?php echo htmlspecialchars($settings['home_donate_title_highlight'] ?? ''); ?>" style="margin-bottom: 8px;">
          <input type="text" name="settings[home_donate_title_end]" class="form-control" value="<?php echo htmlspecialchars($settings['home_donate_title_end'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Donate Subtext</label>
          <textarea name="settings[home_donate_sub]" class="form-control" rows="4"><?php echo htmlspecialchars($settings['home_donate_sub'] ?? ''); ?></textarea>
        </div>
      </div>
    </div>

    <div class="settings-actions">
      <button type="submit" name="update_home" class="btn-login" style="width: auto; padding: 16px 48px;">Save Homepage Changes</button>
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
