  <!-- FOOTER -->
  <footer>
    <div class="foot-top">
      <div>
        <span class="foot-logo">
          <img src="img/logo.png" alt="Family Tree" class="logo-img">
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
          <li><a href="about.php">About Us</a></li>
          <li><a href="about.php">Our Story</a></li>
          <li><a href="about.php">Leadership</a></li>
          <li><a href="about.php">Annual Reports</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h5>Programs</h5>
        <ul>
          <li><a href="corporate.php">School Plantation</a></li>
          <li><a href="corporate.php">Community Greening</a></li>
          <li><a href="corporate.php">Urban Greening</a></li>
          <li><a href="corporate.php">Carbon Projects</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h5>Get Involved</h5>
        <ul>
          <li><a href="mailto:info@familytreeindia.org?subject=Donation Inquiry">Donate</a></li>
          <li><a href="mailto:info@familytreeindia.org">Volunteer</a></li>
          <li><a href="corporate.php">Corporate CSR</a></li>
          <li><a href="corporate.php">Partner With Us</a></li>
          <li><a href="mailto:info@familytreeindia.org">Media & Press</a></li>
        </ul>
      </div>
    </div>
    <div class="foot-btm">
      <span class="foot-copy">© <?php echo date('Y'); ?> Family Tree. Registered under Section 8. 80G Certified. FCRA Registered.</span>
      <div class="foot-legal">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="corporate.php">80G</a>
        <a href="corporate.php">FCRA</a>
      </div>
    </div>
  </footer>

  <script src="js/script.js"></script>
  <?php if(isset($extraJS)): foreach($extraJS as $js): ?>
  <script src="js/<?php echo $js; ?>"></script>
  <?php endforeach; endif; ?>
</body>

</html>
