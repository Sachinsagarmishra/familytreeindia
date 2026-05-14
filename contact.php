<?php 
include_once 'includes/config.php';
require_once 'includes/MailHelper.php';

$pageTitle = "Contact Us";
$extraCSS = ["contact.css"];
$extraJS = ["contact.js", "https://www.google.com/recaptcha/api.js"];
$navClass = "cont-nav";

$msg = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_form'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $company = $conn->real_escape_string($_POST['company']);
    $interest = $conn->real_escape_string($_POST['interest']);
    $message = $conn->real_escape_string($_POST['message']);

    $ip = $_SERVER['REMOTE_ADDR'];
    $state = "Unknown";
    $source = "contact_page";
    
    // Simple Geolocation (Optional: use a library or API)
    $geo = file_get_contents("http://ip-api.com/json/$ip?fields=regionName");
    if($geo) {
        $geo_data = json_decode($geo, true);
        if(isset($geo_data['regionName'])) $state = $geo_data['regionName'];
    }

    // Verify reCAPTCHA
    $recaptcha_secret = $site['recaptcha_secret_key'];
    $recaptcha_response = $_POST['g-recaptcha-response'];
    
    $verify_url = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response";
    $response = file_get_contents($verify_url);
    $response_keys = json_decode($response, true);
    
    if(!$response_keys["success"]) {
        $msg = "Please complete the reCAPTCHA to prove you're not a robot.";
        $status = "error";
    } else {
        // Save to database
        $sql = "INSERT INTO leads (name, email, phone, company, interest, message, state, source, ip_address) 
                VALUES ('$name', '$email', '$phone', '$company', '$interest', '$message', '$state', '$source', '$ip')";
        
        if ($conn->query($sql)) {
            // Send Email
            $subject = "New Contact Lead: $name ($interest)";
            $body = "<h2>New Lead from Website</h2>
                     <p><strong>Name:</strong> $name</p>
                     <p><strong>Email:</strong> $email</p>
                     <p><strong>Phone:</strong> $phone</p>
                     <p><strong>Company:</strong> $company</p>
                     <p><strong>Interest:</strong> $interest</p>
                     <p><strong>Message:</strong> $message</p>
                     <hr>
                     <p><strong>State:</strong> $state</p>
                     <p><strong>Source:</strong> $source</p>
                     <p><strong>IP:</strong> $ip</p>";
            
            $mailResult = MailHelper::send($site['contact_email'], $subject, $body);
            
            $msg = "Thank you! Your message has been sent successfully.";
            $status = "success";
        } else {
            $msg = "Sorry, something went wrong. Please try again.";
            $status = "error";
        }
    }
}

include_once 'includes/header.php'; 
?>

  <!-- CONTACT HERO -->
  <section class="cont-hero">
    <div class="cont-hero-inner">
      <p class="cont-eyebrow cont-reveal"><?php echo isset($site['contact_hero_eyebrow']) ? htmlspecialchars($site['contact_hero_eyebrow']) : 'GET IN TOUCH'; ?></p>
      <h1 class="cont-h1 cont-reveal">
        <?php echo ($site['contact_hero_title_main'] ?? 'Let\'s grow something'); ?> 
        <i><?php echo ($site['contact_hero_title_highlight'] ?? 'meaningful'); ?></i> 
        <?php echo ($site['contact_hero_title_end'] ?? 'together.'); ?>
      </h1>
      <div class="cont-sub cont-reveal"><?php echo ($site['contact_hero_subtext'] ?? "Whether you're a corporate partner, a donor agency, or a volunteer, we'd love to hear from you. Reach out and help us build a greener Bihar."); ?></div>
    </div>
  </section>

  <!-- CONTACT GRID -->
  <section class="cont-grid-sec">
    <div class="cont-grid">
      <!-- LEFT: INFO -->
      <div class="cont-info-col cont-reveal">
        <div class="info-card">
          <span class="info-ico">📧</span>
          <div class="info-body">
            <h5>Email ID</h5>
            <a href="mailto:<?php echo $site['contact_email']; ?>" class="info-link"><?php echo $site['contact_email']; ?></a>
          </div>
        </div>
        
        <div class="info-card">
          <span class="info-ico">📞</span>
          <div class="info-body">
            <h5>Mobile</h5>
            <a href="tel:<?php echo str_replace(' ', '', $site['contact_phone']); ?>" class="info-link"><?php echo $site['contact_phone']; ?></a>
          </div>
        </div>

        <div class="info-card">
          <span class="info-ico">📍</span>
          <div class="info-body">
            <h5>Head office</h5>
            <p class="info-text"><?php echo nl2br(htmlspecialchars($site['address'])); ?></p>
          </div>
        </div>

        <div class="cont-socials">
          <p class="soc-label">Follow our journey</p>
          <div class="soc-links">
            <?php if(!empty($site['facebook_url'])): ?>
            <a href="<?php echo $site['facebook_url']; ?>" target="_blank" class="soc-item"><i class="fa-brands fa-facebook-f"></i></a>
            <?php endif; ?>
            <?php if(!empty($site['instagram_url'])): ?>
            <a href="<?php echo $site['instagram_url']; ?>" target="_blank" class="soc-item"><i class="fa-brands fa-instagram"></i></a>
            <?php endif; ?>
            <?php if(!empty($site['linkedin_url'])): ?>
            <a href="<?php echo $site['linkedin_url']; ?>" target="_blank" class="soc-item"><i class="fa-brands fa-linkedin-in"></i></a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- RIGHT: FORM -->
      <div class="cont-form-col cont-reveal">
        <?php if($msg): ?>
          <div class="form-feedback <?php echo $status; ?>" style="padding: 20px; border-radius: 8px; margin-bottom: 24px; background: <?php echo ($status == 'success') ? '#dcfce7' : '#fee2e2'; ?>; color: <?php echo ($status == 'success') ? '#166534' : '#991b1b'; ?>; font-weight: 600;">
            <?php echo $msg; ?>
          </div>
        <?php endif; ?>

        <form class="cont-form" action="" method="post">
          <div class="form-row">
            <div class="form-group">
              <label for="name"><?php echo isset($site['contact_form_name_label']) ? htmlspecialchars($site['contact_form_name_label']) : 'Names'; ?></label>
              <input type="text" id="name" name="name" placeholder="<?php echo isset($site['contact_form_name_placeholder']) ? htmlspecialchars($site['contact_form_name_placeholder']) : 'John Doe'; ?>" required>
            </div>
            <div class="form-group">
              <label for="email"><?php echo isset($site['contact_form_email_label']) ? htmlspecialchars($site['contact_form_email_label']) : 'Email ID'; ?></label>
              <input type="email" id="email" name="email" placeholder="<?php echo isset($site['contact_form_email_placeholder']) ? htmlspecialchars($site['contact_form_email_placeholder']) : 'john@example.com'; ?>" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="phone"><?php echo isset($site['contact_form_phone_label']) ? htmlspecialchars($site['contact_form_phone_label']) : 'Phone number'; ?></label>
              <input type="tel" id="phone" name="phone" placeholder="<?php echo isset($site['contact_form_phone_placeholder']) ? htmlspecialchars($site['contact_form_phone_placeholder']) : '+91 XXXXX XXXXX'; ?>" required>
            </div>
            <div class="form-group">
              <label for="company"><?php echo isset($site['contact_form_company_label']) ? htmlspecialchars($site['contact_form_company_label']) : 'Company name'; ?></label>
              <input type="text" id="company" name="company" placeholder="<?php echo isset($site['contact_form_company_placeholder']) ? htmlspecialchars($site['contact_form_company_placeholder']) : 'Your Organization'; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="interest"><?php echo isset($site['contact_form_interest_label']) ? htmlspecialchars($site['contact_form_interest_label']) : 'Interested in'; ?></label>
            <select id="interest" name="interest" required>
              <option value="" disabled selected><?php echo isset($site['contact_form_interest_placeholder']) ? htmlspecialchars($site['contact_form_interest_placeholder']) : 'Select an option'; ?></option>
              <option value="CSR">CSR</option>
              <option value="Employee Engagement">Employee Engagement</option>
              <option value="Volunteer program">Volunteer program</option>
              <option value="Partnership">Partnership</option>
              <option value="Others">Others</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message"><?php echo isset($site['contact_form_message_label']) ? htmlspecialchars($site['contact_form_message_label']) : 'Comments (optional)'; ?></label>
            <textarea id="message" name="message" rows="4" placeholder="<?php echo isset($site['contact_form_message_placeholder']) ? htmlspecialchars($site['contact_form_message_placeholder']) : 'How can we help you?'; ?>"></textarea>
          </div>
          
          <?php if(isset($site['recaptcha_site_key'])): ?>
          <div class="form-group" style="margin-bottom: 20px;">
            <div class="g-recaptcha" data-sitekey="<?php echo $site['recaptcha_site_key']; ?>"></div>
          </div>
          <?php endif; ?>

          <button type="submit" name="submit_form" class="btn-y"><?php echo isset($site['contact_form_submit_text']) ? htmlspecialchars($site['contact_form_submit_text']) : 'Send Message'; ?></button>
        </form>
      </div>
    </div>
  </section>

  <!-- MAP SECTION (OPTIONAL VISUAL) -->
  <section class="cont-map cont-reveal">
    <div class="map-placeholder">
       <div class="map-overlay">
          <p><?php echo isset($site['contact_map_text']) ? htmlspecialchars($site['contact_map_text']) : 'Our initiatives span 125 schools across 4 districts in Bihar.'; ?></p>
          <a href="<?php echo SITE_URL; ?>/about" class="link-arr"><?php echo isset($site['contact_map_link_text']) ? htmlspecialchars($site['contact_map_link_text']) : 'See Our Impact'; ?></a>
       </div>
    </div>
  </section>

<?php include_once 'includes/footer.php'; ?>
