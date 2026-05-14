  <!-- FOOTER -->
  <footer>
    <div class="foot-top">
      <div>
        <span class="foot-logo">
          <img src="<?php echo SITE_URL; ?>/img/logo.png" alt="Family Tree" class="logo-img">
        </span>
        <p class="foot-desc">Building permanent green cover through schools and communities. Every tree has a name.
          Every guardian has a story.</p>
        <div class="foot-soc">
          <?php if(!empty($site['facebook_url'])): ?>
          <a href="<?php echo $site['facebook_url']; ?>" class="fsoc" target="_blank" aria-label="Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <?php endif; ?>
          <?php if(!empty($site['instagram_url'])): ?>
          <a href="<?php echo $site['instagram_url']; ?>" class="fsoc" target="_blank" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <?php endif; ?>
          <?php if(!empty($site['linkedin_url'])): ?>
          <a href="<?php echo $site['linkedin_url']; ?>" class="fsoc" target="_blank" aria-label="LinkedIn">
            <i class="fa-brands fa-linkedin-in"></i>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <nav class="foot-col" aria-label="Organization links">
        <h5>Organisation</h5>
        <ul>
          <li><a href="<?php echo SITE_URL; ?>/about">About Us</a></li>
          <li><a href="<?php echo SITE_URL; ?>/about">Our Story</a></li>
          <li><a href="<?php echo SITE_URL; ?>/about">Leadership</a></li>
          <li><a href="<?php echo SITE_URL; ?>/about">Annual Reports</a></li>
        </ul>
      </nav>
      <nav class="foot-col" aria-label="Program links">
        <h5>Programs</h5>
        <ul>
          <li><a href="<?php echo SITE_URL; ?>/corporate">School Plantation</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Community Greening</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Urban Greening</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Carbon Projects</a></li>
        </ul>
      </nav>
      <nav class="foot-col" aria-label="Involvement links">
        <h5>Get Involved</h5>
        <ul>
          <li><a href="mailto:<?php echo $site['contact_email']; ?>?subject=Donation Inquiry" class="btn-donate">Donate</a></li>
          <li><a href="mailto:<?php echo $site['contact_email']; ?>">Volunteer</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Corporate CSR</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Partner With Us</a></li>
          <li><a href="mailto:<?php echo $site['contact_email']; ?>">Media & Press</a></li>
        </ul>
      </nav>
    </div>
    <div class="foot-btm">
      <span class="foot-copy">© <?php echo date('Y'); ?> Family Tree. Registered under Section 8. 80G Certified. FCRA Registered.</span>
      <div class="foot-legal">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="<?php echo SITE_URL; ?>/corporate">80G</a>
        <a href="<?php echo SITE_URL; ?>/corporate">FCRA</a>
      </div>
    </div>
  </footer>


  <!-- DONATE MODAL -->
  <div id="donateModal" class="modal">
    <div class="modal-content">
      <button class="modal-close" id="closeDonate">&times;</button>
      <div class="modal-header">
        <h2>Support Our Mission</h2>
        <p>Your contribution helps us grow more trees and secure a greener future for Bihar.</p>
      </div>
      <form id="donateForm" class="cont-form">
        <div class="form-row">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" placeholder="John Doe" required>
          </div>
          <div class="form-group">
            <label>Email ID</label>
            <input type="email" name="email" placeholder="john@example.com" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Phone number</label>
            <input type="tel" name="phone" placeholder="+91 XXXXX XXXXX" required>
          </div>
          <div class="form-group">
            <label>Organization</label>
            <input type="text" name="company" placeholder="Organization (Optional)">
          </div>
        </div>
        <div class="form-group">
          <label>Interest</label>
          <select name="interest" required>
            <option value="" disabled selected>Select an option</option>
            <option value="CSR">CSR</option>
            <option value="Employee Engagement">Employee Engagement</option>
            <option value="Volunteer program">Volunteer program</option>
            <option value="Partnership">Partnership</option>
            <option value="Others">Others</option>
          </select>
        </div>
        <div class="form-group">
          <label>Message (Optional)</label>
          <textarea name="message" rows="3" placeholder="Tell us more..."></textarea>
        </div>
        <div class="form-group" style="margin-bottom: 15px;">
          <div class="g-recaptcha" data-sitekey="<?php echo $site['recaptcha_site_key']; ?>"></div>
        </div>
        <button type="submit" class="btn-y" style="width: 100%;">Submit Inquiry</button>
        <div id="donateFeedback" style="margin-top: 15px; font-size: 0.9rem; padding: 12px; border-radius: 6px; display: none;"></div>
      </form>
    </div>
  </div>

  <style>
    .modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background: rgba(10, 25, 12, 0.5); backdrop-filter: blur(3px); align-items: center; justify-content: center; padding: 20px; }
    .modal.active { display: flex; }
    .modal-content { background: #fff; width: 100%; max-width: 580px; padding: 48px 40px; border-radius: 24px; position: relative; max-height: 90vh; overflow-y: auto; box-shadow: 0 32px 64px rgba(0,0,0,0.4); }
    .modal-close { position: absolute; right: 24px; top: 24px; background: rgba(0,0,0,0.05); border: none; font-size: 1.2rem; cursor: pointer; color: #000; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: 0.3s; z-index: 10; }
    .modal-close:hover { background: rgba(0,0,0,0.1); transform: rotate(90deg); }
    .modal-header { margin-bottom: 28px; text-align: center; }
    .modal-header h2 { font-family: 'Fraunces', serif; font-size: 2.2rem; font-weight: 900; margin-bottom: 8px; color: #0f2310; letter-spacing: -0.02em; }
    .modal-header p { color: rgba(0,0,0,0.5); font-size: 0.95rem; line-height: 1.5; max-width: 400px; margin: 0 auto; }
    
    /* FORM STYLES */
    .modal .cont-form { gap: 16px !important; }
    .modal .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 0; }
    .modal .form-group { margin-bottom: 0; display: flex; flex-direction: column; gap: 6px; }
    .modal .form-group label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #0f2310; opacity: 0.5; }
    .modal .form-group input, 
    .modal .form-group select, 
    .modal .form-group textarea { width: 100%; padding: 12px 16px; border: 1.5px solid rgba(0,0,0,0.08); border-radius: 10px; font-family: inherit; font-size: 0.95rem; background: #f9f9f9; transition: all 0.3s; color: #000; }
    .modal .form-group input:focus, 
    .modal .form-group select:focus, 
    .modal .form-group textarea:focus { outline: none; border-color: #2d6b35; background: #fff; box-shadow: 0 0 0 4px rgba(45, 107, 53, 0.1); }
    .modal .btn-y { background: #f0c132; color: #000; border: none; padding: 16px; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: 0.3s; margin-top: 8px; }
    .modal .btn-y:hover { background: #e0b020; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(240, 193, 50, 0.3); }

    @media (max-width: 600px) {
      .modal-content { padding: 36px 20px; border-radius: 16px; }
      .modal-header h2 { font-size: 1.8rem; }
      .modal-header p { font-size: 0.88rem; }
      .modal .form-row { grid-template-columns: 1fr; gap: 16px; }
    }
  </style>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="<?php echo SITE_URL; ?>/js/script.js"></script>
  <?php if(isset($extraJS)): foreach($extraJS as $js): ?>
  <?php if(strpos($js, 'http') === 0): ?>
  <script src="<?php echo $js; ?>"></script>
  <?php else: ?>
  <script src="<?php echo SITE_URL; ?>/js/<?php echo $js; ?>"></script>
  <?php endif; ?>
  <?php endforeach; endif; ?>
</body>
</html>
