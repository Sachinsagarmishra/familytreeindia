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
          <a href="https://www.facebook.com/share/1Cm7Tczmy6/" class="fsoc" target="_blank" aria-label="Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <a href="https://www.instagram.com/familytreeindia?igsh=MTVjcHVhZmo0aGJiYg==" class="fsoc" target="_blank"
            aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
        </div>
      </div>
      <div class="foot-col">
        <h5>Organisation</h5>
        <ul>
          <li><a href="<?php echo SITE_URL; ?>/about">About Us</a></li>
          <li><a href="<?php echo SITE_URL; ?>/about">Our Story</a></li>
          <li><a href="<?php echo SITE_URL; ?>/about">Leadership</a></li>
          <li><a href="<?php echo SITE_URL; ?>/about">Annual Reports</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h5>Programs</h5>
        <ul>
          <li><a href="<?php echo SITE_URL; ?>/corporate">School Plantation</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Community Greening</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Urban Greening</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Carbon Projects</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h5>Get Involved</h5>
        <ul>
          <li><a href="mailto:info@familytreeindia.org?subject=Donation Inquiry">Donate</a></li>
          <li><a href="mailto:info@familytreeindia.org">Volunteer</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Corporate CSR</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Partner With Us</a></li>
          <li><a href="mailto:info@familytreeindia.org">Media & Press</a></li>
        </ul>
      </div>
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
            <option value="Donation">Direct Donation</option>
            <option value="Sponsorship">Tree Sponsorship</option>
            <option value="CSR">CSR Partnership</option>
          </select>
        </div>
        <div class="form-group">
          <label>Message (Optional)</label>
          <textarea name="message" rows="3" placeholder="Tell us more..."></textarea>
        </div>
        <button type="submit" class="btn-y" style="width: 100%;">Submit Inquiry</button>
        <div id="donateFeedback" style="margin-top: 15px; font-size: 0.9rem; padding: 12px; border-radius: 6px; display: none;"></div>
      </form>
    </div>
  </div>

  <style>
    .modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background: rgba(15,35,16,0.9); backdrop-filter: blur(8px); align-items: center; justify-content: center; padding: 20px; }
    .modal.active { display: flex; }
    .modal-content { background: #fff; width: 100%; max-width: 600px; padding: 48px; border-radius: 20px; position: relative; max-height: 90vh; overflow-y: auto; }
    .modal-close { position: absolute; right: 24px; top: 24px; background: none; border: none; font-size: 2rem; cursor: pointer; color: #000; opacity: 0.3; transition: 0.3s; }
    .modal-close:hover { opacity: 1; }
    .modal-header { margin-bottom: 32px; text-align: center; }
    .modal-header h2 { font-family: 'Fraunces', serif; font-size: 2.2rem; margin-bottom: 8px; }
    .modal-header p { color: rgba(0,0,0,0.5); font-size: 0.95rem; }
    
    @media (max-width: 600px) {
      .modal-content { padding: 32px 24px; border-radius: 12px; }
      .modal-header h2 { font-size: 1.8rem; }
      .modal-header p { font-size: 0.85rem; }
    }
  </style>

  <script src="<?php echo SITE_URL; ?>/js/script.js"></script>
  <?php if(isset($extraJS)): foreach($extraJS as $js): ?>
  <script src="<?php echo SITE_URL; ?>/js/<?php echo $js; ?>"></script>
  <?php endforeach; endif; ?>
</body>
</html>
