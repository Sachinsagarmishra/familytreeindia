<?php
include_once 'config.php';
require_once 'RazorpayHelper.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$donationId = intval($_POST['donation_id'] ?? 0);
$orderId = trim($_POST['razorpay_order_id'] ?? '');
$paymentId = trim($_POST['razorpay_payment_id'] ?? '');
$signature = trim($_POST['razorpay_signature'] ?? '');

if ($donationId <= 0 || $orderId === '' || $paymentId === '' || $signature === '') {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => 'Missing Razorpay payment details.']);
    exit;
}

try {
    $stmt = $conn->prepare("SELECT id, razorpay_order_id FROM donations WHERE id = ? LIMIT 1");
    $stmt->bind_param('i', $donationId);
    $stmt->execute();
    $stmt->bind_result($foundDonationId, $storedOrderId);
    $found = $stmt->fetch();
    $stmt->close();

    if (!$found || $storedOrderId !== $orderId) {
        throw new Exception('Donation order could not be verified.');
    }

    if (!RazorpayHelper::verifyCheckoutSignature($orderId, $paymentId, $signature)) {
        throw new Exception('Payment signature verification failed.');
    }

    $payment = RazorpayHelper::request('GET', '/payments/' . rawurlencode($paymentId));
    $status = $payment['status'] ?? 'verified';
    $method = $payment['method'] ?? null;
    $email = $payment['email'] ?? null;
    $contact = $payment['contact'] ?? null;
    $raw = json_encode($payment);

    $stmt = $conn->prepare("UPDATE donations SET razorpay_payment_id = ?, razorpay_signature = ?, status = ?, payment_method = ?, payer_email = ?, payer_contact = ?, raw_payload = ?, paid_at = IF(paid_at IS NULL, NOW(), paid_at) WHERE id = ?");
    $stmt->bind_param('sssssssi', $paymentId, $signature, $status, $method, $email, $contact, $raw, $donationId);
    $stmt->execute();
    $stmt->close();

    echo json_encode([
        'status' => 'success',
        'message' => 'Thank you. Your donation payment has been verified.',
        'payment_status' => $status,
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
