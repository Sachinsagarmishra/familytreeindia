<?php 
$pageTitle = "Privacy Policy";
include_once 'includes/header.php'; 
?>

<div style="background: var(--white); padding: 120px 20px 80px;">
  <div style="max-width: 800px; margin: 0 auto; line-height: 1.8; color: #444;">
    <h1 style="font-family: 'Fraunces', serif; color: var(--black); font-size: 3rem; margin-bottom: 40px;">Privacy Policy</h1>
    
    <p>Last updated: <?php echo date('F d, Y'); ?></p>

    <h2 style="color: var(--black); margin-top: 40px;">1. Introduction</h2>
    <p>Welcome to Family Tree Foundation. We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, and share information when you visit our website.</p>

    <h2 style="color: var(--black); margin-top: 40px;">2. Information We Collect</h2>
    <p>We collect personal information that you voluntarily provide to us when you express an interest in obtaining information about us or our services, when you participate in activities on the Website or otherwise when you contact us.</p>
    <ul>
      <li>Name and Contact Data (Email, Phone Number)</li>
      <li>Payment Data (for donations, processed securely by our payment partners)</li>
      <li>Inquiry Details (Company name, interest area)</li>
    </ul>

    <h2 style="color: var(--black); margin-top: 40px;">3. How We Use Your Information</h2>
    <p>We use the information we collect to provide, improve, and personalize our services, to process donations, to send you updates about our tree plantation projects, and to comply with legal obligations.</p>

    <h2 style="color: var(--black); margin-top: 40px;">4. AI Data Usage</h2>
    <p>As part of our commitment to transparency, we declare that non-personal, environmental impact data (like tree growth stats and geo-tagging locations) may be shared with environmental AI models for research and monitoring purposes.</p>

    <h2 style="color: var(--black); margin-top: 40px;">5. Contact Us</h2>
    <p>If you have questions or comments about this policy, you may email us at <?php echo $site['contact_email']; ?>.</p>
  </div>
</div>

<?php include_once 'includes/footer.php'; ?>
