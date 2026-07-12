<?php
include_once '../includes/config.php';
$pageTitle = "Payments";
$activePage = "payments";
include_once 'includes/header.php';
include_once 'includes/sidebar.php';

$deleteMsg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_payment'])) {
    $deleteId = intval($_POST['payment_id'] ?? 0);
    if ($deleteId > 0) {
        $stmt = $conn->prepare("DELETE FROM donations WHERE id = ?");
        $stmt->bind_param('i', $deleteId);
        if ($stmt->execute()) {
            $deleteMsg = "Payment entry deleted successfully.";
        } else {
            $deleteMsg = "Unable to delete payment entry.";
        }
        $stmt->close();
    }
}

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
    .payment-table { width: 100%; border-collapse: collapse; min-width: 760px; font-size: 0.88rem; }
    .payment-table th { text-align: left; padding: 16px; color: var(--green-dark); font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 1px solid #eee; }
    .payment-table td { padding: 16px; border-bottom: 1px solid #f1f1f1; vertical-align: middle; }
    .status-pill { display: inline-flex; padding: 5px 9px; border-radius: 999px; font-size: 0.72rem; font-weight: 800; text-transform: uppercase; background: #f3f4f6; color: #374151; }
    .status-pill.captured, .status-pill.authorized, .status-pill.paid { background: #dcfce7; color: #166534; }
    .status-pill.failed { background: #fee2e2; color: #991b1b; }
    .status-pill.order_created, .status-pill.created { background: #eff6ff; color: #1d4ed8; }
    .muted { color: rgba(0,0,0,0.45); font-size: 0.8rem; }
    .payment-actions { display: flex; gap: 8px; align-items: center; }
    .icon-btn { width: 36px; height: 36px; border: 1px solid rgba(0,0,0,0.08); border-radius: 8px; background: #fff; color: var(--green-dark); cursor: pointer; display: inline-flex; align-items: center; justify-content: center; transition: 0.2s; }
    .icon-btn:hover { background: var(--warm-white); transform: translateY(-1px); }
    .icon-btn.delete { color: #b91c1c; }
    .icon-btn.delete:hover { background: #fee2e2; }
    .payment-modal { display: none; position: fixed; inset: 0; z-index: 1000; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 24px; }
    .payment-modal.active { display: flex; }
    .payment-modal-content { width: min(860px, 100%); max-height: 90vh; overflow-y: auto; background: #fff; border-radius: 12px; box-shadow: 0 30px 80px rgba(0,0,0,0.25); }
    .payment-modal-head { display: flex; align-items: center; justify-content: space-between; gap: 20px; padding: 24px 28px; border-bottom: 1px solid #eee; }
    .payment-modal-head h3 { font-size: 1.6rem; margin: 0; }
    .payment-detail-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; padding: 28px; }
    .payment-detail { background: #fafaf9; border: 1px solid rgba(0,0,0,0.05); border-radius: 8px; padding: 14px; min-width: 0; }
    .payment-detail.full { grid-column: 1 / -1; }
    .payment-detail span { display: block; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: var(--green-mid); margin-bottom: 6px; }
    .payment-detail strong, .payment-detail pre { font: inherit; color: var(--black); overflow-wrap: anywhere; white-space: pre-wrap; }
    .payment-detail pre { max-height: 160px; overflow: auto; margin: 0; }
    @media (max-width: 800px) { .payment-stats { grid-template-columns: 1fr; } }
    @media (max-width: 700px) { .payment-detail-grid { grid-template-columns: 1fr; } }
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

  <?php if($deleteMsg): ?>
    <div style="padding: 16px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 24px; font-weight: 600;">
      <?php echo htmlspecialchars($deleteMsg); ?>
    </div>
  <?php endif; ?>

  <div class="payment-table-wrap">
    <table class="payment-table">
      <thead>
        <tr>
          <th>Donor</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Mode</th>
          <th>Paid</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($payments && $payments->num_rows > 0): ?>
          <?php while($row = $payments->fetch_assoc()): ?>
            <?php
              $detailPayload = [
                  'id' => $row['id'],
                  'name' => $row['donor_name'],
                  'mobile' => $row['donor_mobile'],
                  'address' => $row['donor_address'],
                  'state' => $row['donor_state'] ?? 'Unknown',
                  'ip_address' => $row['ip_address'] ?? '',
                  'amount' => '₹' . number_format((float)$row['amount'], 2),
                  'currency' => $row['currency'],
                  'status' => $row['status'],
                  'mode' => strtoupper($row['razorpay_mode']),
                  'order_id' => $row['razorpay_order_id'] ?? 'Pending',
                  'payment_id' => $row['razorpay_payment_id'] ?? 'Pending',
                  'signature' => $row['razorpay_signature'] ?? '',
                  'method' => $row['payment_method'] ?? '',
                  'payer_email' => $row['payer_email'] ?? '',
                  'payer_contact' => $row['payer_contact'] ?? '',
                  'receipt' => $row['receipt'] ?? '',
                  'source' => $row['source'] ?? '',
                  'webhook' => !empty($row['webhook_event_id']) ? 'Synced' : 'Awaiting',
                  'webhook_event_id' => $row['webhook_event_id'] ?? '',
                  'created_at' => $row['created_at'] ?? '',
                  'paid_at' => $row['paid_at'] ?? 'Pending',
                  'updated_at' => $row['updated_at'] ?? '',
                  'raw_payload' => $row['raw_payload'] ?? '',
              ];
            ?>
            <tr>
              <td>
                <strong><?php echo htmlspecialchars($row['donor_name']); ?></strong><br>
                <span class="muted"><?php echo htmlspecialchars($row['donor_mobile']); ?></span>
              </td>
              <td><strong>₹<?php echo number_format((float)$row['amount'], 2); ?></strong><br><span class="muted"><?php echo htmlspecialchars($row['currency']); ?></span></td>
              <td><span class="status-pill <?php echo htmlspecialchars($row['status']); ?>"><?php echo htmlspecialchars(str_replace('_', ' ', $row['status'])); ?></span></td>
              <td><?php echo strtoupper(htmlspecialchars($row['razorpay_mode'])); ?></td>
              <td>
                <?php echo htmlspecialchars($row['paid_at'] ?? 'Pending'); ?>
              </td>
              <td class="payment-actions">
                <button type="button" class="icon-btn view-payment-btn" title="View details" data-payment='<?php echo htmlspecialchars(json_encode($detailPayload), ENT_QUOTES, 'UTF-8'); ?>'>
                  <i class="fa-regular fa-eye"></i>
                </button>
                <form method="POST" action="" onsubmit="return confirm('Delete this payment entry permanently?')" style="display:inline;">
                  <input type="hidden" name="payment_id" value="<?php echo intval($row['id']); ?>">
                  <button type="submit" name="delete_payment" class="icon-btn delete" title="Delete payment">
                    <i class="fa-regular fa-trash-can"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" style="text-align: center; padding: 40px; color: rgba(0,0,0,0.45);">No donation payments found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="payment-modal" id="paymentModal">
    <div class="payment-modal-content">
      <div class="payment-modal-head">
        <h3>Payment Details</h3>
        <button type="button" class="icon-btn" id="closePaymentModal" title="Close">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <div class="payment-detail-grid" id="paymentDetailGrid"></div>
    </div>
  </div>
</main>

<script>
const paymentModal = document.getElementById('paymentModal');
const paymentDetailGrid = document.getElementById('paymentDetailGrid');
const closePaymentModal = document.getElementById('closePaymentModal');

const paymentLabels = {
  id: 'Record ID',
  name: 'Name',
  mobile: 'Mobile',
  address: 'Address',
  state: 'Location (State)',
  ip_address: 'IP Address',
  amount: 'Amount',
  currency: 'Currency',
  status: 'Status',
  mode: 'Mode',
  order_id: 'Razorpay Order ID',
  payment_id: 'Razorpay Payment ID',
  signature: 'Razorpay Signature',
  method: 'Payment Method',
  payer_email: 'Payer Email',
  payer_contact: 'Payer Contact',
  receipt: 'Receipt',
  source: 'Source',
  webhook: 'Webhook Status',
  webhook_event_id: 'Webhook Event ID',
  created_at: 'Created At',
  paid_at: 'Paid At',
  updated_at: 'Updated At',
  raw_payload: 'Raw Payload'
};

function escapeHtml(value) {
  return String(value || '').replace(/[&<>"']/g, char => ({
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  }[char]));
}

document.querySelectorAll('.view-payment-btn').forEach(button => {
  button.addEventListener('click', () => {
    const data = JSON.parse(button.getAttribute('data-payment'));
    paymentDetailGrid.innerHTML = Object.keys(paymentLabels).map(key => {
      const value = data[key] || 'Not available';
      const full = ['address', 'signature', 'raw_payload'].includes(key) ? ' full' : '';
      const content = key === 'raw_payload' ? `<pre>${escapeHtml(value)}</pre>` : `<strong>${escapeHtml(value)}</strong>`;
      return `<div class="payment-detail${full}"><span>${paymentLabels[key]}</span>${content}</div>`;
    }).join('');
    paymentModal.classList.add('active');
  });
});

if (closePaymentModal) {
  closePaymentModal.addEventListener('click', () => paymentModal.classList.remove('active'));
}

if (paymentModal) {
  paymentModal.addEventListener('click', event => {
    if (event.target === paymentModal) paymentModal.classList.remove('active');
  });
}
</script>

<?php include_once 'includes/footer.php'; ?>
