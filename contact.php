<?php 
include_once 'includes/config.php';
require_once 'includes/MailHelper.php';

$pageTitle = "Contact Us";
$extraCSS = ["contact.css"];
$extraJS = ["contact.js"];
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

    // Save to database
    $sql = "INSERT INTO leads (name, email, phone, company, interest, message) VALUES ('$name', '$email', '$phone', '$company', '$interest', '$message')";
    
    if ($conn->query($sql)) {
        // Send Email
        $subject = "New Contact Lead: $name ($interest)";
        $body = "<h2>New Lead from Website</h2>
                 <p><strong>Name:</strong> $name</p>
                 <p><strong>Email:</strong> $email</p>
                 <p><strong>Phone:</strong> $phone</p>
                 <p><strong>Company:</strong> $company</p>
                 <p><strong>Interest:</strong> $interest</p>
                 <p><strong>Message:</strong> $message</p>";
        
        $mailResult = MailHelper::send($site['contact_email'], $subject, $body);
        
        $msg = "Thank you! Your message has been sent successfully.";
        $status = "success";
    } else {
        $msg = "Sorry, something went wrong. Please try again.";
        $status = "error";
    }
}

include_once 'includes/header.php'; 
?>

  <!-- CONTACT HERO -->
  <section class="cont-hero">
    <div class="cont-hero-inner">
      <p class="cont-eyebrow cont-reveal">GET IN TOUCH</p>
      <h1 class="cont-h1 cont-reveal">Let’s <i>grow</i> something<br>meaningful together.</h1>
      <p class="cont-sub cont-reveal">Whether you're a corporate partner, a donor agency, or a volunteer, we'd love to hear from you. Reach out and help us build a greener Bihar.</p>
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
              <label for="name">Names</label>
              <input type="text" id="name" name="name" placeholder="John Doe" required>
            </div>
            <div class="form-group">
              <label for="email">Email ID</label>
              <input type="email" id="email" name="email" placeholder="john@example.com" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="phone">Phone number</label>
              <input type="tel" id="phone" name="phone" placeholder="+91 XXXXX XXXXX" required>
            </div>
            <div class="form-group">
              <label for="company">Company name</label>
              <input type="text" id="company" name="company" placeholder="Your Organization">
            </div>
          </div>
          <div class="form-group">
            <label for="interest">Interested in</label>
            <select id="interest" name="interest" required>
              <option value="" disabled selected>Select an option</option>
              <option value="CSR">CSR</option>
              <option value="Employee Engagement">Employee Engagement</option>
              <option value="Volunteer program">Volunteer program</option>
              <option value="Partnership">Partnership</option>
              <option value="Others">Others</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message">Comments (optional)</label>
            <textarea id="message" name="message" rows="4" placeholder="How can we help you?"></textarea>
          </div>
          <button type="submit" name="submit_form" class="btn-y">Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <!-- MAP SECTION (OPTIONAL VISUAL) -->
  <section class="cont-map cont-reveal">
    <div class="map-placeholder">
       <div class="map-overlay">
          <p>Our initiatives span 125 schools across 4 districts in Bihar.</p>
          <a href="<?php echo SITE_URL; ?>/about" class="link-arr">See Our Impact</a>
       </div>
    </div>
  </section>

<?php include_once 'includes/footer.php'; ?>
