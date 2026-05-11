<?php
include_once '../includes/config.php';
$pageTitle = "Site Settings";
$activePage = "settings";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_settings'])) {
    foreach($_POST['settings'] as $key => $value) {
        $val = $conn->real_escape_string($value);
        $conn->query("UPDATE site_settings SET setting_value = '$val' WHERE setting_key = '$key'");
    }
    $msg = "Settings updated successfully!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_test'])) {
    require_once '../includes/MailHelper.php';
    $test_email = $conn->real_escape_string($_POST['test_email']);
    $res = MailHelper::send($test_email, "Family Tree — SMTP Test", "This is a test email to verify your SMTP settings. If you received this, your email configuration is working correctly!");
    
    if ($res['status']) {
        $msg = "Test email sent successfully to $test_email!";
    } else {
        $msg = "Error: " . $res['message'];
    }
}

// Fetch current settings
$settings = [];
$res = $conn->query("SELECT * FROM site_settings");
while($row = $res->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

  <main class="main-content">
    <header class="header-admin">
      <div class="welcome-msg">
        <h2>Site Settings</h2>
        <p>Configure your website and SMTP email details.</p>
      </div>
    </header>

    <?php if($msg): ?>
      <div style="padding: 16px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
        <?php echo $msg; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="" class="settings-form-grid">
      
      <div class="settings-card">
        <h3 style="margin-bottom: 24px;">General Settings</h3>
        <div class="form-group">
          <label>Site Title</label>
          <input type="text" name="settings[site_title]" class="form-control" value="<?php echo isset($settings['site_title']) ? htmlspecialchars($settings['site_title']) : ''; ?>">
        </div>
        <div class="form-group">
          <label>Contact Email (Public)</label>
          <input type="email" name="settings[contact_email]" class="form-control" value="<?php echo isset($settings['contact_email']) ? htmlspecialchars($settings['contact_email']) : ''; ?>">
        </div>
        <div class="form-group">
          <label>Contact Phone</label>
          <input type="text" name="settings[contact_phone]" class="form-control" value="<?php echo isset($settings['contact_phone']) ? htmlspecialchars($settings['contact_phone']) : ''; ?>">
        </div>
        <div class="form-group">
          <label>Address</label>
          <textarea name="settings[address]" class="form-control" rows="3"><?php echo isset($settings['address']) ? htmlspecialchars($settings['address']) : ''; ?></textarea>
        </div>
      </div>

      <div class="settings-card">
        <h3 style="margin-bottom: 24px;">SMTP Configuration</h3>
        <div class="form-row-grid">
          <div class="form-group">
            <label>SMTP Host</label>
            <input type="text" name="settings[smtp_host]" class="form-control" value="<?php echo isset($settings['smtp_host']) ? $settings['smtp_host'] : ''; ?>" placeholder="smtp.gmail.com">
          </div>
          <div class="form-group">
            <label>SMTP Port</label>
            <input type="text" name="settings[smtp_port]" class="form-control" value="<?php echo isset($settings['smtp_port']) ? $settings['smtp_port'] : ''; ?>" placeholder="587">
          </div>
        </div>
        <div class="form-group">
          <label>SMTP Username (Email)</label>
          <input type="text" name="settings[smtp_user]" class="form-control" value="<?php echo isset($settings['smtp_user']) ? $settings['smtp_user'] : ''; ?>" placeholder="your-email@gmail.com">
        </div>
        <div class="form-group">
          <label>SMTP Password / App Password</label>
          <input type="password" name="settings[smtp_pass]" class="form-control" value="<?php echo isset($settings['smtp_pass']) ? $settings['smtp_pass'] : ''; ?>" placeholder="••••••••••••">
        </div>
        <div class="form-row-grid">
          <div class="form-group">
            <label>Encryption</label>
            <select name="settings[smtp_encryption]" class="form-control">
              <option value="tls" <?php echo (isset($settings['smtp_encryption']) && $settings['smtp_encryption'] == 'tls') ? 'selected' : ''; ?>>TLS</option>
              <option value="ssl" <?php echo (isset($settings['smtp_encryption']) && $settings['smtp_encryption'] == 'ssl') ? 'selected' : ''; ?>>SSL</option>
            </select>
          </div>
          <div class="form-group">
            <label>Sender Email</label>
            <input type="email" name="settings[from_email]" class="form-control" value="<?php echo isset($settings['from_email']) ? $settings['from_email'] : ''; ?>" placeholder="info@familytreeindia.org">
          </div>
        </div>
        <p style="font-size: 0.8rem; color: rgba(0,0,0,0.4); margin-top: 12px;">Tip: For Gmail, use an "App Password" if 2FA is enabled.</p>
      </div>

      <div class="settings-actions">
        <button type="submit" name="update_settings" class="btn-login" style="width: auto; padding: 16px 48px;">Save All Changes</button>
      </div>
    </form>

    <div style="background: #fff; padding: 32px; border-radius: 12px; border: 1px solid rgba(0,0,0,0.05); max-width: 500px;">
        <h3 style="margin-bottom: 16px;">Test SMTP Connection</h3>
        <p style="font-size: 0.85rem; color: rgba(0,0,0,0.4); margin-bottom: 24px;">Enter an email address to send a test message using the saved settings above.</p>
        <form method="POST" action="" style="display: flex; gap: 12px;">
            <input type="email" name="test_email" class="form-control" placeholder="test@example.com" required style="flex: 1;">
            <button type="submit" name="send_test" class="btn-login" style="width: auto; margin-top: 0; padding: 0 24px;">Send Test</button>
        </form>
    </div>
  </main>

<?php include_once 'includes/footer.php'; ?>
