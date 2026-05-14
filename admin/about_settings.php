<?php
include_once '../includes/config.php';
$pageTitle = "About Us Page Settings";
$activePage = "about_settings";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_about_settings'])) {
    // Handle Text Settings
    if(isset($_POST['settings'])) {
        foreach($_POST['settings'] as $key => $value) {
            $val = $conn->real_escape_string($value);
            $conn->query("UPDATE site_settings SET setting_value = '$val' WHERE setting_key = '$key'");
        }
    }

    // Handle Image Uploads
    if(isset($_FILES['images'])) {
        $targetDir = "../img/";
        foreach($_FILES['images']['name'] as $key => $name) {
            if($_FILES['images']['error'][$key] == 0) {
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                $newName = "about_" . $key . "_" . time() . "." . $ext;
                $targetFile = $targetDir . $newName;
                
                if(move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFile)) {
                    $conn->query("UPDATE site_settings SET setting_value = '$newName' WHERE setting_key = '$key'");
                }
            }
        }
    }
    $msg = "About Us page settings updated successfully!";
}

// Fetch current settings
$settings = [];
$res = $conn->query("SELECT * FROM site_settings WHERE setting_key LIKE 'about_%'");
while($row = $res->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

  <main class="main-content">
    <header class="header-admin">
      <div class="welcome-msg">
        <h2>About Us Page Settings</h2>
        <p>Manage all text content and images on your About Us page.</p>
      </div>
    </header>

    <?php if($msg): ?>
      <div style="padding: 16px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
        <?php echo $msg; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data" class="settings-form-grid">
      
      <!-- INTRO SECTION -->
      <div class="settings-card">
        <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-star"></i> Intro Section</h3>
        <div class="form-group">
          <label>Eyebrow Text</label>
          <input type="text" name="settings[about_intro_eyebrow]" class="form-control" value="<?php echo htmlspecialchars($settings['about_intro_eyebrow'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Intro Title (Three parts for styling)</label>
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <input type="text" name="settings[about_intro_title_main]" class="form-control" placeholder="Main text..." value="<?php echo htmlspecialchars($settings['about_intro_title_main'] ?? ''); ?>">
            <input type="text" name="settings[about_intro_title_highlight]" class="form-control" style="border-color: #2d6b35; color: #2d6b35; font-weight: bold;" placeholder="Green/Italic part..." value="<?php echo htmlspecialchars($settings['about_intro_title_highlight'] ?? ''); ?>">
            <input type="text" name="settings[about_intro_title_end]" class="form-control" placeholder="End text..." value="<?php echo htmlspecialchars($settings['about_intro_title_end'] ?? ''); ?>">
          </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-top: 20px;">
          <div class="form-group">
            <label>Hero Image 1</label>
            <?php if(!empty($settings['about_intro_img1'])): ?>
              <img src="../img/<?php echo $settings['about_intro_img1']; ?>" style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; margin-bottom: 8px;">
            <?php endif; ?>
            <input type="file" name="images[about_intro_img1]" class="form-control">
          </div>
          <div class="form-group">
            <label>Hero Image 2 (Tall)</label>
            <?php if(!empty($settings['about_intro_img2'])): ?>
              <img src="../img/<?php echo $settings['about_intro_img2']; ?>" style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; margin-bottom: 8px;">
            <?php endif; ?>
            <input type="file" name="images[about_intro_img2]" class="form-control">
          </div>
          <div class="form-group">
            <label>Hero Image 3</label>
            <?php if(!empty($settings['about_intro_img3'])): ?>
              <img src="../img/<?php echo $settings['about_intro_img3']; ?>" style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px; margin-bottom: 8px;">
            <?php endif; ?>
            <input type="file" name="images[about_intro_img3]" class="form-control">
          </div>
        </div>
      </div>

      <!-- MOBILE MARQUEE IMAGES -->
      <div class="settings-card">
        <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-mobile-screen-button"></i> Mobile Marquee Images</h3>
        <p style="font-size: 0.8rem; color: #888; margin-bottom: 15px;">These images will loop on mobile devices.</p>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
          <?php for($i=1; $i<=8; $i++): $k = "about_marquee_img$i"; ?>
            <div class="form-group">
              <label>Img <?php echo $i; ?></label>
              <?php if(!empty($settings[$k])): ?>
                <img src="../img/<?php echo $settings[$k]; ?>" style="width: 100%; height: 60px; object-fit: cover; border-radius: 4px; margin-bottom: 5px;">
              <?php endif; ?>
              <input type="file" name="images[<?php echo $k; ?>]" class="form-control" style="font-size: 0.7rem;">
            </div>
          <?php endfor; ?>
        </div>
      </div>

      <!-- MISSION & IMPACT SECTION -->
      <div class="settings-card">
        <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-bullseye"></i> Mission & Impact</h3>
        <div class="form-group">
          <label>Mission Title (Three parts for styling)</label>
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <input type="text" name="settings[about_mission_title_main]" class="form-control" placeholder="Main text..." value="<?php echo htmlspecialchars($settings['about_mission_title_main'] ?? ''); ?>">
            <input type="text" name="settings[about_mission_title_highlight]" class="form-control" style="border-color: #2d6b35; color: #2d6b35; font-weight: bold;" placeholder="Green/Italic part..." value="<?php echo htmlspecialchars($settings['about_mission_title_highlight'] ?? ''); ?>">
            <input type="text" name="settings[about_mission_title_end]" class="form-control" placeholder="End text..." value="<?php echo htmlspecialchars($settings['about_mission_title_end'] ?? ''); ?>">
          </div>
        </div>
        <div class="form-group">
          <label>Mission Description</label>
          <textarea name="settings[about_mission_text]" class="form-control tinymce-editor" rows="5"><?php echo htmlspecialchars($settings['about_mission_text'] ?? ''); ?></textarea>
        </div>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
          <h4 style="margin-bottom: 15px;">Impact Targets</h4>
          <div class="form-row-grid">
            <div class="form-group"><label>Districts</label><input type="text" name="settings[about_target_districts]" class="form-control" value="<?php echo htmlspecialchars($settings['about_target_districts'] ?? ''); ?>"></div>
            <div class="form-group"><label>Blocks</label><input type="text" name="settings[about_target_blocks]" class="form-control" value="<?php echo htmlspecialchars($settings['about_target_blocks'] ?? ''); ?>"></div>
            <div class="form-group"><label>Schools</label><input type="text" name="settings[about_target_schools]" class="form-control" value="<?php echo htmlspecialchars($settings['about_target_schools'] ?? ''); ?>"></div>
            <div class="form-group"><label>Plants</label><input type="text" name="settings[about_target_plants]" class="form-control" value="<?php echo htmlspecialchars($settings['about_target_plants'] ?? ''); ?>"></div>
          </div>
        </div>

        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee;">
          <h4 style="margin-bottom: 15px;">Completed Plantation</h4>
          <div class="form-row-grid">
            <div class="form-group"><label>Districts</label><input type="text" name="settings[about_completed_districts]" class="form-control" value="<?php echo htmlspecialchars($settings['about_completed_districts'] ?? ''); ?>"></div>
            <div class="form-group"><label>Blocks</label><input type="text" name="settings[about_completed_blocks]" class="form-control" value="<?php echo htmlspecialchars($settings['about_completed_blocks'] ?? ''); ?>"></div>
            <div class="form-group"><label>Schools</label><input type="text" name="settings[about_completed_schools]" class="form-control" value="<?php echo htmlspecialchars($settings['about_completed_schools'] ?? ''); ?>"></div>
          </div>
          <div class="form-row-grid" style="margin-top: 10px;">
            <div class="form-group"><label>Guardians</label><input type="text" name="settings[about_completed_guardians]" class="form-control" value="<?php echo htmlspecialchars($settings['about_completed_guardians'] ?? ''); ?>"></div>
            <div class="form-group"><label>Trees Planted</label><input type="text" name="settings[about_completed_trees]" class="form-control" value="<?php echo htmlspecialchars($settings['about_completed_trees'] ?? ''); ?>"></div>
          </div>
        </div>
      </div>

      <!-- FOUNDER SECTION -->
      <div class="settings-card">
        <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-user-tie"></i> Founder Section</h3>
        <div class="form-group">
          <label>Section Title</label>
          <input type="text" name="settings[about_founder_title]" class="form-control" value="<?php echo htmlspecialchars($settings['about_founder_title'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Founder Image</label>
          <?php if(!empty($settings['about_founder_img'])): ?>
            <img src="../img/<?php echo $settings['about_founder_img']; ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px; display: block;">
          <?php endif; ?>
          <input type="file" name="images[about_founder_img]" class="form-control">
        </div>
        <div class="form-group">
          <label>Founder Name</label>
          <input type="text" name="settings[about_founder_name]" class="form-control" value="<?php echo htmlspecialchars($settings['about_founder_name'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Founder Designation</label>
          <input type="text" name="settings[about_founder_designation]" class="form-control" value="<?php echo htmlspecialchars($settings['about_founder_designation'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Founder Bio</label>
          <textarea name="settings[about_founder_text]" class="form-control tinymce-editor" rows="4"><?php echo htmlspecialchars($settings['about_founder_text'] ?? ''); ?></textarea>
        </div>
      </div>

      <!-- LEADERSHIP SECTION -->
      <div class="settings-card">
        <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-users-gear"></i> Leadership Section</h3>
        <div class="form-group">
          <label>Leader Image</label>
          <?php if(!empty($settings['about_leader_img'])): ?>
            <img src="../img/<?php echo $settings['about_leader_img']; ?>" style="width: 100%; height: 150px; object-fit: cover; border-radius: 12px; margin-bottom: 10px;">
          <?php endif; ?>
          <input type="file" name="images[about_leader_img]" class="form-control">
        </div>
        <div class="form-row-grid">
          <div class="form-group">
            <label>Leader Name</label>
            <input type="text" name="settings[about_leader_name]" class="form-control" value="<?php echo htmlspecialchars($settings['about_leader_name'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label>Designation</label>
            <input type="text" name="settings[about_leader_designation]" class="form-control" value="<?php echo htmlspecialchars($settings['about_leader_designation'] ?? ''); ?>">
          </div>
        </div>
        <div class="form-group">
          <label>Section Eyebrow</label>
          <input type="text" name="settings[about_leader_eyebrow]" class="form-control" value="<?php echo htmlspecialchars($settings['about_leader_eyebrow'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Section Title (Three parts for styling)</label>
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <input type="text" name="settings[about_leader_title_main]" class="form-control" placeholder="Main text..." value="<?php echo htmlspecialchars($settings['about_leader_title_main'] ?? ''); ?>">
            <input type="text" name="settings[about_leader_title_highlight]" class="form-control" style="border-color: #2d6b35; color: #2d6b35; font-weight: bold;" placeholder="Green/Italic part..." value="<?php echo htmlspecialchars($settings['about_leader_title_highlight'] ?? ''); ?>">
            <input type="text" name="settings[about_leader_title_end]" class="form-control" placeholder="End text..." value="<?php echo htmlspecialchars($settings['about_leader_title_end'] ?? ''); ?>">
          </div>
        </div>
        <div class="form-group">
          <label>Paragraph 1</label>
          <textarea name="settings[about_leader_text1]" class="form-control tinymce-editor" rows="4"><?php echo htmlspecialchars($settings['about_leader_text1'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
          <label>Paragraph 2</label>
          <textarea name="settings[about_leader_text2]" class="form-control tinymce-editor" rows="4"><?php echo htmlspecialchars($settings['about_leader_text2'] ?? ''); ?></textarea>
        </div>
      </div>

      <!-- PARTNERS SECTION -->
      <div class="settings-card">
        <h3 style="margin-bottom: 24px;"><i class="fa-solid fa-handshake"></i> Partners Section</h3>
        <div class="form-group">
          <label>Eyebrow</label>
          <input type="text" name="settings[about_partners_eyebrow]" class="form-control" value="<?php echo htmlspecialchars($settings['about_partners_eyebrow'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Title (Three parts for styling)</label>
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <input type="text" name="settings[about_partners_title_main]" class="form-control" placeholder="Main text..." value="<?php echo htmlspecialchars($settings['about_partners_title_main'] ?? ''); ?>">
            <input type="text" name="settings[about_partners_title_highlight]" class="form-control" style="border-color: #2d6b35; color: #2d6b35; font-weight: bold;" placeholder="Green/Italic part..." value="<?php echo htmlspecialchars($settings['about_partners_title_highlight'] ?? ''); ?>">
            <input type="text" name="settings[about_partners_title_end]" class="form-control" placeholder="End text..." value="<?php echo htmlspecialchars($settings['about_partners_title_end'] ?? ''); ?>">
          </div>
        </div>
      </div>

      <div class="settings-actions">
        <button type="submit" name="update_about_settings" class="btn-login" style="width: auto; padding: 16px 48px;">Save About Us Changes</button>
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
    height: 200
  });
</script>
