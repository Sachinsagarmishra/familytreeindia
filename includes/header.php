<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?php echo htmlspecialchars($site['meta_description']); ?>" />
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
  <link rel="canonical" href="<?php echo SITE_URL . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>" />
  
  <title><?php echo isset($pageTitle) ? $pageTitle . " — " . $site['site_title'] : $site['site_title']; ?></title>

  <!-- Open Graph / Social Media -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php echo SITE_URL; ?>" />
  <meta property="og:title" content="<?php echo $site['site_title']; ?>" />
  <meta property="og:description" content="<?php echo htmlspecialchars($site['meta_description']); ?>" />
  <meta property="og:image" content="<?php echo SITE_URL; ?>/img/hero.jpeg" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:url" content="<?php echo SITE_URL; ?>" />
  <meta name="twitter:title" content="<?php echo $site['site_title']; ?>" />
  <meta name="twitter:description" content="<?php echo htmlspecialchars($site['meta_description']); ?>" />
  <meta name="twitter:image" content="<?php echo SITE_URL; ?>/img/hero.jpeg" />

  <!-- JSON-LD Structured Data (Schema.org) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "<?php echo $site['site_title']; ?>",
    "url": "<?php echo SITE_URL; ?>",
    "logo": "<?php echo SITE_URL; ?>/img/logo.png",
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "<?php echo $site['contact_phone']; ?>",
      "contactType": "customer service",
      "email": "<?php echo $site['contact_email']; ?>"
    },
    "sameAs": [
      "<?php echo $site['facebook_url']; ?>",
      "<?php echo $site['instagram_url']; ?>",
      "<?php echo $site['linkedin_url']; ?>"
    ]
  }
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "url": "<?php echo SITE_URL; ?>",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "<?php echo SITE_URL; ?>/search?q={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>
  <?php if(isset($pageTitle) && $pageTitle != "Home"): ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [{
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "<?php echo SITE_URL; ?>"
    },{
      "@type": "ListItem",
      "position": 2,
      "name": "<?php echo $pageTitle; ?>",
      "item": "<?php echo SITE_URL . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>"
    }]
  }
  </script>
  <?php endif; ?>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/style.css" />
  <?php if(isset($extraCSS)): foreach($extraCSS as $css): ?>
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/<?php echo $css; ?>" />
  <?php endforeach; endif; ?>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="icon" type="image/png" href="<?php echo SITE_URL; ?>/img/favicon.png" />
</head>

<body>

  <div class="cursor" id="cur"></div>
  <div class="cursor-ring" id="curRing"></div>

  <!-- NAV -->
  <nav class="main-nav <?php echo isset($navClass) ? $navClass : ''; ?>">
    <a href="<?php echo SITE_URL; ?>" class="nav-logo">
      <img src="<?php echo SITE_URL; ?>/img/logo.png" alt="Family Tree" class="logo-img">
    </a>
    <div class="nav-right">
      <div class="nav-item has-dropdown">
        <a href="#" class="nav-link">Take Action <i class="fa-solid fa-chevron-down dropdown-icon"></i></a>
        <div class="dropdown-menu">
          <div class="dropdown-inner">
            <a href="<?php echo SITE_URL; ?>/corporate" class="dropdown-link">
              <span class="dl-title">Sponsor a Tree</span>
              <span class="dl-desc">Direct environmental impact</span>
            </a>
            <a href="mailto:<?php echo $site['contact_email']; ?>" class="dropdown-link">
              <span class="dl-title">Volunteer</span>
              <span class="dl-desc">Join our ground team</span>
            </a>
            <a href="<?php echo SITE_URL; ?>/corporate" class="dropdown-link">
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
            <a href="<?php echo SITE_URL; ?>/about#story" class="dropdown-link">
              <span class="dl-title">Our Story</span>
              <span class="dl-desc">From one school to many</span>
            </a>
            <a href="<?php echo SITE_URL; ?>/about#leadership" class="dropdown-link">
              <span class="dl-title">Leadership</span>
              <span class="dl-desc">Meet the visionaries</span>
            </a>
            <a href="<?php echo SITE_URL; ?>/about#impact" class="dropdown-link">
              <span class="dl-title">Impact Reports</span>
              <span class="dl-desc">Transparency in action</span>
            </a>
          </div>
        </div>
      </div>
      <a href="<?php echo SITE_URL; ?>/contact" class="nav-link">Contact</a>
    </div>
    <a href="mailto:<?php echo $site['contact_email']; ?>?subject=Donation Inquiry" class="nav-donate btn-donate">Donate</a>
    <button class="nav-mob-btn" id="mobBtn">
      <div class="mob-line"></div>
      <div class="mob-line"></div>
    </button>
  </nav>

  <div class="mob-menu" id="mobMenu">
    <div class="mm-head">
      <img src="<?php echo SITE_URL; ?>/img/logo.png" alt="Family Tree" class="logo-img">
      <button class="mm-close" id="mmClose">✕</button>
    </div>
    <div class="mm-links">
      <a href="<?php echo SITE_URL; ?>/corporate" class="mm-link">Take Action</a>
      <a href="<?php echo SITE_URL; ?>/about" class="mm-link">About Us</a>
      <a href="<?php echo SITE_URL; ?>/contact" class="mm-link">Contact Us</a>
      <a href="mailto:<?php echo $site['contact_email']; ?>?subject=Donation Inquiry" class="mm-donate btn-donate">Donate Now</a>
    </div>
  </div>
