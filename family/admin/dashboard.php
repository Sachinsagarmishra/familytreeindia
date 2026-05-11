<?php
include_once '../includes/config.php';
$pageTitle = "Dashboard";
$activePage = "dashboard";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';
?>

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

<?php include_once 'includes/footer.php'; ?>
