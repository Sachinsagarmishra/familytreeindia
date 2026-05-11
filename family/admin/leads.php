<?php
include_once '../includes/config.php';
$pageTitle = "Contact Leads";
$activePage = "leads";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

// Fetch Leads
$result = $conn->query("SELECT * FROM leads ORDER BY created_at DESC");
?>

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <header class="header-admin">
      <div class="welcome-msg">
        <h2>Contact Leads</h2>
        <p>Manage and view website form submissions.</p>
      </div>
    </header>

    <div class="leads-table-container" style="background: #fff; border-radius: 12px; border: 1px solid rgba(0,0,0,0.05); overflow: hidden;">
      <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
        <thead>
          <tr style="background: var(--warm-white); text-align: left;">
            <th style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">Date</th>
            <th style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">Name</th>
            <th style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">Email / Phone</th>
            <th style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">Interest</th>
            <th style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">Message</th>
          </tr>
        </thead>
        <tbody>
          <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05); color: rgba(0,0,0,0.5);">
                  <?php echo date('d M, Y', strtotime($row['created_at'])); ?>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05); font-weight: 600;">
                  <?php echo htmlspecialchars($row['name']); ?>
                  <?php if($row['company']): ?><br><small style="font-weight: 400; color: rgba(0,0,0,0.4);"><?php echo htmlspecialchars($row['company']); ?></small><?php endif; ?>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                  <a href="mailto:<?php echo $row['email']; ?>" style="color: var(--green-mid); text-decoration: none;"><?php echo $row['email']; ?></a><br>
                  <small><?php echo $row['phone']; ?></small>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05);">
                  <span style="background: #eef2ff; color: #4338ca; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 700;"><?php echo $row['interest']; ?></span>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid rgba(0,0,0,0.05); max-width: 300px;">
                  <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" style="padding: 40px; text-align: center; color: rgba(0,0,0,0.4);">No leads found yet.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>

<?php include_once 'includes/footer.php'; ?>
