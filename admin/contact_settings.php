<?php
include_once '../includes/config.php';
$pageTitle = "Contact Page Settings";
$activePage = "contact_settings";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_contact_settings'])) {
    foreach($_POST['settings'] as $key => $value) {
        $val = $conn->real_escape_string($value);
        $conn->query("UPDATE site_settings SET setting_value = '$val' WHERE setting_key = '$key'");
    }
    $msg = "Contact page settings updated successfully!";
}

// Fetch current settings
$settings = [];
$res = $conn->query("SELECT * FROM site_settings WHERE setting_key LIKE 'contact_%'");
while($row = $res->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Ensure all keys exist (Fallback/Safety)
$contact_keys = [
    'contact_hero_eyebrow', 'contact_hero_title', 'contact_hero_subtext',
    'contact_form_name_label', 'contact_form_name_placeholder',
    'contact_form_email_label', 'contact_form_email_placeholder',
    'contact_form_phone_label', 'contact_form_phone_placeholder',
    'contact_form_company_label', 'contact_form_company_placeholder',
    'contact_form_interest_label', 'contact_form_interest_placeholder',
    'contact_form_message_label', 'contact_form_message_placeholder',
    'contact_form_submit_text', 'contact_map_text', 'contact_map_link_text'
];

foreach($contact_keys as $key) {
    if(!isset($settings[$key])) {
        $settings[$key] = '';
    }
}
?>

  <main class="main-content">
    <header class="header-admin">
      <div class="welcome-msg">
        <h2>Contact Page Settings</h2>
        <p>Edit the content, labels, and placeholders of your Contact Us page.</p>
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
          <label>Hero Eyebrow</label>
          <input type="text" name="settings[contact_hero_eyebrow]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_hero_eyebrow']); ?>">
        </div>
        <div class="form-group">
          <label>Hero Title (Use Bold/Italic for styling)</label>
          <textarea name="settings[contact_hero_title]" class="form-control tinymce-editor" rows="2"><?php echo htmlspecialchars($settings['contact_hero_title']); ?></textarea>
        </div>
        <div class="form-group">
          <label>Hero Subtext</label>
          <textarea name="settings[contact_hero_subtext]" class="form-control tinymce-editor" rows="3"><?php echo htmlspecialchars($settings['contact_hero_subtext']); ?></textarea>
        </div>
      </div>

      <!-- FORM FIELDS SECTION -->
      <div class="settings-card">
        <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-list-check"></i> Form Fields & Labels</h3>
        
        <div class="form-row-grid">
          <div class="form-group">
            <label>Name Field Label</label>
            <input type="text" name="settings[contact_form_name_label]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_name_label']); ?>">
          </div>
          <div class="form-group">
            <label>Name Placeholder</label>
            <input type="text" name="settings[contact_form_name_placeholder]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_name_placeholder']); ?>">
          </div>
        </div>

        <div class="form-row-grid">
          <div class="form-group">
            <label>Email Field Label</label>
            <input type="text" name="settings[contact_form_email_label]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_email_label']); ?>">
          </div>
          <div class="form-group">
            <label>Email Placeholder</label>
            <input type="text" name="settings[contact_form_email_placeholder]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_email_placeholder']); ?>">
          </div>
        </div>

        <div class="form-row-grid">
          <div class="form-group">
            <label>Phone Field Label</label>
            <input type="text" name="settings[contact_form_phone_label]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_phone_label']); ?>">
          </div>
          <div class="form-group">
            <label>Phone Placeholder</label>
            <input type="text" name="settings[contact_form_phone_placeholder]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_phone_placeholder']); ?>">
          </div>
        </div>

        <div class="form-row-grid">
          <div class="form-group">
            <label>Company Field Label</label>
            <input type="text" name="settings[contact_form_company_label]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_company_label']); ?>">
          </div>
          <div class="form-group">
            <label>Company Placeholder</label>
            <input type="text" name="settings[contact_form_company_placeholder]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_company_placeholder']); ?>">
          </div>
        </div>

        <div class="form-row-grid">
          <div class="form-group">
            <label>Interest Field Label</label>
            <input type="text" name="settings[contact_form_interest_label]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_interest_label']); ?>">
          </div>
          <div class="form-group">
            <label>Interest Default Option</label>
            <input type="text" name="settings[contact_form_interest_placeholder]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_interest_placeholder']); ?>">
          </div>
        </div>

        <div class="form-row-grid">
          <div class="form-group">
            <label>Message Field Label</label>
            <input type="text" name="settings[contact_form_message_label]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_message_label']); ?>">
          </div>
          <div class="form-group">
            <label>Message Placeholder</label>
            <input type="text" name="settings[contact_form_message_placeholder]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_message_placeholder']); ?>">
          </div>
        </div>

        <div class="form-group">
          <label>Submit Button Text</label>
          <input type="text" name="settings[contact_form_submit_text]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_form_submit_text']); ?>">
        </div>
      </div>

      <!-- MAP SECTION -->
      <div class="settings-card">
        <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-map-location-dot"></i> Map/Impact Section</h3>
        <div class="form-group">
          <label>Impact Text</label>
          <input type="text" name="settings[contact_map_text]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_map_text']); ?>">
        </div>
        <div class="form-group">
          <label>Impact Link Text</label>
          <input type="text" name="settings[contact_map_link_text]" class="form-control" value="<?php echo htmlspecialchars($settings['contact_map_link_text']); ?>">
        </div>
      </div>

      <div class="settings-actions">
        <button type="submit" name="update_contact_settings" class="btn-login" style="width: auto; padding: 16px 48px;">Save Contact Page Changes</button>
      </div>
    </form>
  </main>

<?php include_once 'includes/footer.php'; ?>

<script>
  tinymce.init({
    selector: 'textarea.tinymce-editor',
    plugins: 'link lists autoresize',
    toolbar: 'undo redo | bold italic | bullist numlist | link',
    menubar: false,
    statusbar: false,
    autoresize_bottom_margin: 20,
    branding: false,
    height: 150
  });
</script>
