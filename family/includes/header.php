<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($pageTitle) ? $pageTitle . " — Family Tree" : "Family Tree"; ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <?php if(isset($extraCSS)): foreach($extraCSS as $css): ?>
  <link rel="stylesheet" href="css/<?php echo $css; ?>" />
  <?php endforeach; endif; ?>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="icon" type="image/png" href="img/favicon.png" />
</head>

<body>

  <div class="cursor" id="cur"></div>
  <div class="cursor-ring" id="curRing"></div>

  <!-- NAV -->
  <nav class="<?php echo isset($navClass) ? $navClass : ''; ?>">
    <a href="index.php" class="nav-logo">
      <img src="img/logo.png" alt="Family Tree" class="logo-img">
    </a>
    <div class="nav-right">
      <div class="nav-item has-dropdown">
        <a href="#" class="nav-link">Take Action <i class="fa-solid fa-chevron-down dropdown-icon"></i></a>
        <div class="dropdown-menu">
          <div class="dropdown-inner">
            <a href="corporate.php" class="dropdown-link">
              <span class="dl-title">Sponsor a Tree</span>
              <span class="dl-desc">Direct environmental impact</span>
            </a>
            <a href="mailto:info@familytreeindia.org" class="dropdown-link">
              <span class="dl-title">Volunteer</span>
              <span class="dl-desc">Join our ground team</span>
            </a>
            <a href="corporate.php" class="dropdown-link">
              <span class="dl-title">Corporate CSR</span>
              <span class="dl-desc">ESG aligned partnerships</span>
            </a>
          </div>
        </div>
      </div>
      <div class="nav-item has-dropdown">
        <a href="#" class="nav-link">About Us <i class="fa-solid fa-chevron-down dropdown-icon"></i></a>
        <div class="dropdown-menu">
          <div class="dropdown-inner">
            <a href="about.php#story" class="dropdown-link">
              <span class="dl-title">Our Story</span>
              <span class="dl-desc">From one school to many</span>
            </a>
            <a href="about.php#leadership" class="dropdown-link">
              <span class="dl-title">Leadership</span>
              <span class="dl-desc">Meet the visionaries</span>
            </a>
            <a href="about.php#impact" class="dropdown-link">
              <span class="dl-title">Impact Reports</span>
              <span class="dl-desc">Transparency in action</span>
            </a>
          </div>
        </div>
      </div>
      <a href="contact.php" class="nav-link">Contact</a>
    </div>
    <a href="mailto:info@familytreeindia.org?subject=Donation Inquiry" class="nav-donate">Donate</a>
    <button class="nav-mob-btn" id="mobBtn">
      <div class="mob-line"></div>
      <div class="mob-line"></div>
    </button>
  </nav>

  <div class="mob-menu" id="mobMenu">
    <div class="mm-head">
      <img src="img/logo.png" alt="Family Tree" class="logo-img">
      <button class="mm-close" id="mmClose">✕</button>
    </div>
    <div class="mm-links">
      <a href="corporate.php" class="mm-link">Take Action</a>
      <a href="about.php" class="mm-link">About Us</a>
      <a href="contact.php" class="mm-link">Contact Us</a>
      <a href="mailto:info@familytreeindia.org?subject=Donation Inquiry" class="mm-donate">Donate Now</a>
    </div>
  </div>
