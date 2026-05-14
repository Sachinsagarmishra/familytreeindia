<?php
include_once '../includes/config.php';
$pageTitle = "Global Site Settings";
$activePage = "site_settings";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_site'])) {
    foreach($_POST['settings'] as $key => $value) {
        $val = $conn->real_escape_string($value);
        // Check if exists
        $check = $conn->query("SELECT * FROM site_settings WHERE setting_key = '$key'");
        if ($check->num_rows > 0) {
            $conn->query("UPDATE site_settings SET setting_value = '$val' WHERE setting_key = '$key'");
        } else {
            $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$val')");
        }
    }
    $msg = "Global settings updated successfully!";
    // Refresh $site array
    $settings_res = $conn->query("SELECT setting_key, setting_value FROM site_settings");
    while($srow = $settings_res->fetch_assoc()) {
        $site[$srow['setting_key']] = $srow['setting_value'];
    }
}
?>

<main class="main-content">
  <header class="header-admin">
    <div class="welcome-msg">
      <h2>General Site Settings</h2>
      <p>Manage your website's identity, SEO meta tags, and global contact information.</p>
    </div>
  </header>

  <?php if($msg): ?>
    <div style="padding: 16px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
      <?php echo $msg; ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="" class="settings-form-grid">
    
    <!-- SEO & IDENTITY -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-search"></i> SEO & Identity</h3>
      <div class="form-group">
        <label>Site Title</label>
        <input type="text" name="settings[site_title]" class="form-control" value="<?php echo htmlspecialchars($site['site_title'] ?? 'Family Tree'); ?>">
      </div>
      <div class="form-group">
        <label>Meta Description (SEO)</label>
        <textarea name="settings[meta_description]" class="form-control" rows="4" placeholder="Enter a brief description of your website for Google search results..."><?php echo htmlspecialchars($site['meta_description'] ?? ''); ?></textarea>
      </div>
    </div>

    <!-- GLOBAL CONTACT INFO -->
    <div class="settings-card">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-address-book"></i> Global Contact Info</h3>
      <div class="form-group">
        <label>Contact Email</label>
        <input type="email" name="settings[contact_email]" class="form-control" value="<?php echo htmlspecialchars($site['contact_email'] ?? 'info@familytreeindia.org'); ?>">
      </div>
      <div class="form-group">
        <label>Contact Phone</label>
        <input type="text" name="settings[contact_phone]" class="form-control" value="<?php echo htmlspecialchars($site['contact_phone'] ?? ''); ?>">
      </div>
      <div class="form-group">
        <label>Office Address</label>
        <textarea name="settings[contact_address]" class="form-control" rows="2"><?php echo htmlspecialchars($site['contact_address'] ?? ''); ?></textarea>
      </div>
    </div>

    <!-- SOCIAL MEDIA -->
    <div class="settings-card" style="grid-column: span 2;">
      <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-share-nodes"></i> Social Media Links</h3>
      <div class="form-row-grid" style="grid-template-columns: 1fr 1fr 1fr;">
        <div class="form-group">
          <label><i class="fa-brands fa-facebook"></i> Facebook URL</label>
          <input type="text" name="settings[facebook_url]" class="form-control" value="<?php echo htmlspecialchars($site['facebook_url'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label><i class="fa-brands fa-instagram"></i> Instagram URL</label>
          <input type="text" name="settings[instagram_url]" class="form-control" value="<?php echo htmlspecialchars($site['instagram_url'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label><i class="fa-brands fa-linkedin"></i> LinkedIn URL</label>
          <input type="text" name="settings[linkedin_url]" class="form-control" value="<?php echo htmlspecialchars($site['linkedin_url'] ?? ''); ?>">
        </div>
      </div>
    </div>

    <div class="settings-actions">
      <button type="submit" name="update_site" class="btn-login" style="width: auto; padding: 16px 48px;">Update Global Settings</button>
    </div>
  </form>
</main>

<?php include_once 'includes/footer.php'; ?>
