<?php
include_once '../includes/config.php';
$pageTitle = "Payments";
$activePage = "payments";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

$where = " WHERE 1=1 ";
if (!empty($_GET['status'])) {
    $status = $conn->real_escape_string($_GET['status']);
    $where .= " AND status = '$status' ";
}
if (!empty($_GET['mode'])) {
    $mode = $conn->real_escape_string($_GET['mode']);
    $where .= " AND razorpay_mode = '$mode' ";
}
if (!empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $where .= " AND (donor_name LIKE '%$search%' OR donor_mobile LIKE '%$search%' OR razorpay_order_id LIKE '%$search%' OR razorpay_payment_id LIKE '%$search%') ";
}

$summary = [
    'total_amount' => 0,
    'paid_count' => 0,
    'total_count' => 0,
];

$summarySql = "SELECT COALESCE(SUM(CASE WHEN status IN ('captured', 'authorized', 'paid') THEN amount ELSE 0 END), 0) AS total_amount, SUM(CASE WHEN status IN ('captured', 'authorized', 'paid') THEN 1 ELSE 0 END) AS paid_count, COUNT(*) AS total_count FROM donations $where";
$summaryRes = $conn->query($summarySql);
if ($summaryRes) {
    $summary = $summaryRes->fetch_assoc();
}

$payments = $conn->query("SELECT * FROM donations $where ORDER BY created_at DESC LIMIT 200");
?>

<main class="main-content">
  <header class="header-admin">
    <div class="welcome-msg">
      <h2>Donation Payments</h2>
      <p>Track Razorpay donations, donor billing details, status, and webhook sync.</p>
    </div>
  </header>

  <style>
    .payment-stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; margin-bottom: 24px; }
    .payment-stat { background: #fff; padding: 24px; border-radius: 12px; border: 1px solid rgba(0,0,0,0.05); }
    .payment-stat span { display: block; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: var(--green-mid); margin-bottom: 8px; }
    .payment-stat strong { font-size: 2rem; font-family: "Fraunces", serif; }
    .payment-filters { display: flex; gap: 16px; flex-wrap: wrap; align-items: flex-end; background: #fff; padding: 20px; border-radius: 12px; border: 1px solid rgba(0,0,0,0.05); margin-bottom: 24px; }
    .payment-table-wrap { background: #fff; border-radius: 12px; border: 1px solid rgba(0,0,0,0.05); overflow-x: auto; }
    .payment-table { width: 100%; border-collapse: collapse; min-width: 1100px; font-size: 0.88rem; }
    .payment-table th { text-align: left; padding: 16px; color: var(--green-dark); font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 1px solid #eee; }
    .payment-table td { padding: 16px; border-bottom: 1px solid #f1f1f1; vertical-align: top; }
    .status-pill { display: inline-flex; padding: 5px 9px; border-radius: 999px; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; background: #f3f4f6; color: #374151; }
    .status-pill.captured, .status-pill.authorized, .status-pill.paid { background: #dcfce7; color: #166534; }
    .status-pill.failed { background: #fee2e2; color: #991b1b; }
    .status-pill.order_created, .status-pill.created { background: #eff6ff; color: #1d4ed8; }
    .muted { color: rgba(0,0,0,0.45); font-size: 0.8rem; }
    @media (max-width: 800px) { .payment-stats { grid-template-columns: 1fr; } }
  </style>

  <div class="payment-stats">
    <div class="payment-stat">
      <span>Total Paid Amount</span>
      <strong>₹<?php echo number_format((float)$summary['total_amount'], 2); ?></strong>
    </div>
    <div class="payment-stat">
      <span>Successful Payments</span>
      <strong><?php echo intval($summary['paid_count']); ?></strong>
    </div>
    <div class="payment-stat">
      <span>Total Payment Records</span>
      <strong><?php echo intval($summary['total_count']); ?></strong>
    </div>
  </div>

  <form method="GET" class="payment-filters">
    <div class="form-group" style="margin-bottom: 0; min-width: 240px;">
      <label>Search</label>
      <input type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" placeholder="Name, mobile, order ID, payment ID">
    </div>
    <div class="form-group" style="margin-bottom: 0;">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="">All</option>
        <?php foreach(['created', 'order_created', 'authorized', 'captured', 'paid', 'failed'] as $opt): ?>
          <option value="<?php echo $opt; ?>" <?php echo (($_GET['status'] ?? '') == $opt) ? 'selected' : ''; ?>><?php echo ucfirst(str_replace('_', ' ', $opt)); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group" style="margin-bottom: 0;">
      <label>Mode</label>
      <select name="mode" class="form-control">
        <option value="">All</option>
        <option value="test" <?php echo (($_GET['mode'] ?? '') == 'test') ? 'selected' : ''; ?>>Test</option>
        <option value="live" <?php echo (($_GET['mode'] ?? '') == 'live') ? 'selected' : ''; ?>>Live</option>
      </select>
    </div>
    <button type="submit" class="btn-login" style="width: auto; margin-top: 0; padding: 14px 24px;">Filter</button>
    <a href="payments.php" class="btn-login" style="width: auto; margin-top: 0; padding: 14px 24px; background: #eee; color: #555; text-decoration: none;">Reset</a>
  </form>

  <div class="payment-table-wrap">
    <table class="payment-table">
      <thead>
        <tr>
          <th>Donor</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Mode</th>
          <th>Razorpay IDs</th>
          <th>Webhook</th>
          <th>Created / Paid</th>
        </tr>
      </thead>
      <tbody>
        <?php if($payments && $payments->num_rows > 0): ?>
          <?php while($row = $payments->fetch_assoc()): ?>
            <tr>
              <td>
                <strong><?php echo htmlspecialchars($row['donor_name']); ?></strong><br>
                <span class="muted"><?php echo htmlspecialchars($row['donor_mobile']); ?></span><br>
                <span class="muted"><?php echo nl2br(htmlspecialchars($row['donor_address'])); ?></span>
              </td>
              <td><strong>₹<?php echo number_format((float)$row['amount'], 2); ?></strong><br><span class="muted"><?php echo htmlspecialchars($row['currency']); ?></span></td>
              <td><span class="status-pill <?php echo htmlspecialchars($row['status']); ?>"><?php echo htmlspecialchars(str_replace('_', ' ', $row['status'])); ?></span></td>
              <td><?php echo strtoupper(htmlspecialchars($row['razorpay_mode'])); ?></td>
              <td>
                <span class="muted">Order</span><br><?php echo htmlspecialchars($row['razorpay_order_id'] ?? 'Pending'); ?><br>
                <span class="muted">Payment</span><br><?php echo htmlspecialchars($row['razorpay_payment_id'] ?? 'Pending'); ?>
              </td>
              <td>
                <?php if(!empty($row['webhook_event_id'])): ?>
                  <span class="status-pill captured">Synced</span><br>
                  <span class="muted"><?php echo htmlspecialchars($row['webhook_event_id']); ?></span>
                <?php else: ?>
                  <span class="status-pill">Awaiting</span>
                <?php endif; ?>
              </td>
              <td>
                <span class="muted">Created</span><br><?php echo htmlspecialchars($row['created_at']); ?><br>
                <span class="muted">Paid</span><br><?php echo htmlspecialchars($row['paid_at'] ?? 'Pending'); ?>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" style="text-align: center; padding: 40px; color: rgba(0,0,0,0.45);">No donation payments found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<?php include_once 'includes/footer.php'; ?>
