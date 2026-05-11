<?php
include_once '../includes/config.php';

// Check if logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$admin_user = $_SESSION['admin_user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — Admin Panel</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>

<div class="admin-wrapper">
  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-brand">
      <img src="../img/logo.png" alt="Family Tree">
    </div>
    <ul class="nav-menu">
      <li class="nav-item-admin">
        <a href="dashboard.php" class="nav-link-admin active">
          <i class="fa-solid fa-gauge"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item-admin">
        <a href="#" class="nav-link-admin">
          <i class="fa-solid fa-tree"></i>
          <span>Tree Records</span>
        </a>
      </li>
      <li class="nav-item-admin">
        <a href="#" class="nav-link-admin">
          <i class="fa-solid fa-school"></i>
          <span>Schools</span>
        </a>
      </li>
      <li class="nav-item-admin">
        <a href="#" class="nav-link-admin">
          <i class="fa-solid fa-users"></i>
          <span>Guardians</span>
        </a>
      </li>
      <li class="nav-item-admin">
        <a href="#" class="nav-link-admin">
          <i class="fa-solid fa-newspaper"></i>
          <span>News & Field Field Stories</span>
        </a>
      </li>
      <li class="nav-item-admin">
        <a href="#" class="nav-link-admin">
          <i class="fa-solid fa-gear"></i>
          <span>Site Settings</span>
        </a>
      </li>
    </ul>
  </aside>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <header class="header-admin">
      <div class="welcome-msg">
        <h2>Hello, <?php echo ucfirst($admin_user); ?></h2>
        <p>Here's what's happening with Family Tree today.</p>
      </div>
      <div class="user-profile">
        <div class="user-name">
          <span><?php echo ucfirst($admin_user); ?></span>
          <a href="logout.php" class="btn-logout">Logout</a>
        </div>
        <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--yellow); display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--black);">
          <?php echo strtoupper(substr($admin_user, 0, 1)); ?>
        </div>
      </div>
    </header>

    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-card-title">Total Trees</div>
        <div class="stat-card-value">12,500</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-title">Student Guardians</div>
        <div class="stat-card-value">10,500</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-title">Survival Rate</div>
        <div class="stat-card-value">85%</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-title">Partner Schools</div>
        <div class="stat-card-value">125</div>
      </div>
    </div>

    <!-- RECENT ACTIVITY (Placeholder) -->
    <div style="background: #fff; padding: 32px; border-radius: 12px; border: 1px solid rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 24px; font-size: 1.4rem;">Recent Plantation Drives</h3>
        <p style="color: rgba(0,0,0,0.4); font-size: 0.9rem;">No recent drives recorded. Start by adding a new plantation record.</p>
    </div>

  </main>
</div>

</body>
</html>
