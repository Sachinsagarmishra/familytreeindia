<?php
$pageTitle = "Thank You";
include_once 'includes/header.php';

$amount = isset($_GET['amount']) ? preg_replace('/[^0-9.]/', '', $_GET['amount']) : '';
$paymentId = isset($_GET['payment_id']) ? preg_replace('/[^a-zA-Z0-9_\-]/', '', $_GET['payment_id']) : '';
$orderId = isset($_GET['order_id']) ? preg_replace('/[^a-zA-Z0-9_\-]/', '', $_GET['order_id']) : '';
$donation = null;

if ($paymentId || $orderId) {
    $safePaymentId = $conn->real_escape_string($paymentId);
    $safeOrderId = $conn->real_escape_string($orderId);
    $res = $conn->query("SELECT * FROM donations WHERE razorpay_payment_id = '$safePaymentId' OR razorpay_order_id = '$safeOrderId' ORDER BY id DESC LIMIT 1");
    if ($res) {
        $donation = $res->fetch_assoc();
    }
}

$displayAmount = $donation ? (float)$donation['amount'] : (float)$amount;
$displayPaymentId = $donation['razorpay_payment_id'] ?? $paymentId;
$displayOrderId = $donation['razorpay_order_id'] ?? $orderId;
$displayState = $donation['donor_state'] ?? '';
?>

<main class="thankyou-page">
  <section class="thankyou-hero">
    <div class="thankyou-card">
      <div class="thankyou-logo">
        <img src="<?php echo SITE_URL; ?>/img/new-familytreeindia-logo.svg" alt="Family Tree India">
      </div>
      <div class="thankyou-mark">
        <i class="fa-solid fa-check"></i>
      </div>
      <p class="thankyou-eyebrow">Donation received</p>
      <h1>Thank you for growing a greener tomorrow.</h1>
      <p class="thankyou-copy">Your contribution helps us plant and care for more trees with student guardians. Every donation becomes part of a living story.</p>

      <div class="thankyou-details">
        <?php if($donation): ?>
          <div>
            <span>Full Name</span>
            <strong><?php echo htmlspecialchars($donation['donor_name']); ?></strong>
          </div>
          <div>
            <span>Mobile Number</span>
            <strong><?php echo htmlspecialchars($donation['donor_mobile']); ?></strong>
          </div>
          <div class="full">
            <span>Address</span>
            <strong><?php echo nl2br(htmlspecialchars($donation['donor_address'])); ?></strong>
          </div>
          <div>
            <span>Amount Paid</span>
            <strong>₹<?php echo htmlspecialchars(number_format($displayAmount, 2)); ?></strong>
          </div>
          <div>
            <span>Payment Method</span>
            <strong><?php echo htmlspecialchars($donation['payment_method'] ? ucfirst($donation['payment_method']) : 'Processing'); ?></strong>
          </div>
          <div>
            <span>Status</span>
            <strong><?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $donation['status']))); ?></strong>
          </div>
          <div>
            <span>Mode</span>
            <strong><?php echo htmlspecialchars(strtoupper($donation['razorpay_mode'])); ?></strong>
          </div>
          <div>
            <span>Location (State)</span>
            <strong><?php echo htmlspecialchars($displayState ?: 'Not available'); ?></strong>
          </div>
          <div>
            <span>Payment ID</span>
            <strong><?php echo htmlspecialchars($displayPaymentId ?: 'Processing'); ?></strong>
          </div>
          <div class="full">
            <span>Order ID</span>
            <strong><?php echo htmlspecialchars($displayOrderId ?: 'Processing'); ?></strong>
          </div>
        <?php else: ?>
          <?php if($displayAmount): ?>
          <div>
            <span>Amount Paid</span>
            <strong>₹<?php echo htmlspecialchars(number_format($displayAmount, 2)); ?></strong>
          </div>
          <?php endif; ?>
          <?php if($displayPaymentId): ?>
          <div>
            <span>Payment ID</span>
            <strong><?php echo htmlspecialchars($displayPaymentId); ?></strong>
          </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>

      <a href="<?php echo SITE_URL; ?>" class="thankyou-btn">
        <i class="fa-solid fa-arrow-left"></i>
        Back to Home
      </a>
    </div>
  </section>
</main>

<style>
  .thankyou-page { min-height: 100vh; background: #f7f4ec; }
  .thankyou-hero { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 140px 20px 80px; background: linear-gradient(rgba(15, 35, 16, 0.55), rgba(15, 35, 16, 0.55)), url('<?php echo SITE_URL; ?>/img/hero.jpeg'); background-size: cover; background-position: center; }
  .thankyou-card { width: min(860px, 100%); text-align: center; background: rgba(255, 253, 247, 0.96); border: 1px solid rgba(255,255,255,0.55); border-radius: 24px; padding: 48px; box-shadow: 0 34px 90px rgba(0,0,0,0.28); }
  .thankyou-logo img { width: 150px; height: auto; margin-bottom: 24px; }
  .thankyou-mark { width: 74px; height: 74px; margin: 0 auto 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; background: linear-gradient(180deg, #47752c 0%, #1f4a18 100%); box-shadow: 0 12px 28px rgba(31,74,24,0.26); font-size: 2rem; }
  .thankyou-eyebrow { color: #2d6b35; text-transform: uppercase; letter-spacing: 0.14em; font-size: 0.78rem; font-weight: 800; margin-bottom: 12px; }
  .thankyou-card h1 { font-size: clamp(2.2rem, 5vw, 4rem); line-height: 1; color: #163515; margin-bottom: 18px; letter-spacing: 0; }
  .thankyou-copy { max-width: 560px; margin: 0 auto 28px; color: rgba(0,0,0,0.62); font-size: 1.06rem; line-height: 1.7; }
  .thankyou-details { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; max-width: 680px; margin: 0 auto 28px; text-align: left; }
  .thankyou-details div { background: #fff; border: 1px solid rgba(33,77,32,0.12); border-radius: 12px; padding: 16px; }
  .thankyou-details .full { grid-column: 1 / -1; }
  .thankyou-details span { display: block; color: #2d6b35; text-transform: uppercase; letter-spacing: 0.08em; font-size: 0.72rem; font-weight: 800; margin-bottom: 6px; }
  .thankyou-details strong { display: block; color: #111; overflow-wrap: anywhere; }
  .thankyou-btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; min-height: 52px; padding: 0 28px; border-radius: 10px; background: #f0c132; color: #111; text-decoration: none; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 900; transition: 0.25s; }
  .thankyou-btn:hover { transform: translateY(-2px); background: #111; color: #fff; }

  @media (max-width: 640px) {
    .thankyou-card { padding: 34px 22px; border-radius: 18px; }
    .thankyou-details { grid-template-columns: 1fr; }
  }
</style>

<?php include_once 'includes/footer.php'; ?>
