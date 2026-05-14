  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <img src="../img/logo.png" alt="Family Tree">
    </div>
    <ul class="nav-menu">
      <li class="nav-item-admin">
        <a href="dashboard.php" class="nav-link-admin <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">
          <i class="fa-solid fa-gauge"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item-admin">
        <a href="leads.php" class="nav-link-admin <?php echo ($activePage == 'leads') ? 'active' : ''; ?>">
          <i class="fa-solid fa-envelope-open-text"></i>
          <span>Contact Leads</span>
        </a>
      </li>
      <li class="nav-item-admin">
        <a href="contact_settings.php" class="nav-link-admin <?php echo ($activePage == 'contact_settings') ? 'active' : ''; ?>">
          <i class="fa-solid fa-file-signature"></i>
          <span>Contact Page</span>
        </a>
      </li>
      <li class="nav-item-admin">
        <a href="about_settings.php" class="nav-link-admin <?php echo ($activePage == 'about_settings') ? 'active' : ''; ?>">
          <i class="fa-solid fa-file-invoice"></i>
          <span>About Us Page</span>
        </a>
      </li>
      <li class="nav-item-admin">
        <a href="settings.php" class="nav-link-admin <?php echo ($activePage == 'settings') ? 'active' : ''; ?>">
          <i class="fa-solid fa-gear"></i>
          <span>Site Settings</span>
        </a>
      </li>
    </ul>
  </aside>
