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
          <li><a href="mailto:info@familytreeindia.org?subject=Donation Inquiry" class="btn-donate">Donate</a></li>
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
    .modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background: rgba(15,35,16,0.9); backdrop-filter: blur(12px); align-items: center; justify-content: center; padding: 20px; }
    .modal.active { display: flex; }
    .modal-content { background: #fff; width: 100%; max-width: 600px; padding: 60px 48px; border-radius: 24px; position: relative; max-height: 90vh; overflow-y: auto; box-shadow: 0 32px 64px rgba(0,0,0,0.4); }
    .modal-close { position: absolute; right: 28px; top: 28px; background: rgba(0,0,0,0.05); border: none; font-size: 1.5rem; cursor: pointer; color: #000; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: 0.3s; }
    .modal-close:hover { background: rgba(0,0,0,0.1); transform: rotate(90deg); }
    .modal-header { margin-bottom: 40px; text-align: center; }
    .modal-header h2 { font-family: 'Fraunces', serif; font-size: 2.5rem; font-weight: 900; margin-bottom: 12px; color: #0f2310; letter-spacing: -0.02em; }
    .modal-header p { color: rgba(0,0,0,0.5); font-size: 1rem; line-height: 1.6; max-width: 400px; margin: 0 auto; }
    
    /* FORM STYLES */
    .modal .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
    .modal .form-group { margin-bottom: 20px; display: flex; flex-direction: column; gap: 8px; }
    .modal .form-group label { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #0f2310; opacity: 0.6; }
    .modal .form-group input, 
    .modal .form-group select, 
    .modal .form-group textarea { width: 100%; padding: 14px 18px; border: 1.5px solid rgba(0,0,0,0.08); border-radius: 10px; font-family: inherit; font-size: 0.95rem; background: #f9f9f9; transition: all 0.3s; color: #000; }
    .modal .form-group input:focus, 
    .modal .form-group select:focus, 
    .modal .form-group textarea:focus { outline: none; border-color: #2d6b35; background: #fff; box-shadow: 0 0 0 4px rgba(45, 107, 53, 0.1); }
    .modal .btn-y { background: #f0c132; color: #000; border: none; padding: 18px; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: 0.3s; margin-top: 10px; }
    .modal .btn-y:hover { background: #e0b020; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(240, 193, 50, 0.3); }

    @media (max-width: 600px) {
      .modal-content { padding: 40px 24px; border-radius: 16px; }
      .modal-header h2 { font-size: 1.8rem; }
      .modal-header p { font-size: 0.88rem; }
      .modal .form-row { grid-template-columns: 1fr; gap: 0; }
    }
  </style>

  <script src="<?php echo SITE_URL; ?>/js/script.js"></script>
  <?php if(isset($extraJS)): foreach($extraJS as $js): ?>
  <script src="<?php echo SITE_URL; ?>/js/<?php echo $js; ?>"></script>
  <?php endforeach; endif; ?>
</body>
</html>
