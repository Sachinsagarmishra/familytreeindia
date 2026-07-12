<?php
include_once 'config.php';
require_once 'RazorpayHelper.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

$name = trim($_POST['billing_name'] ?? '');
$address = trim($_POST['billing_address'] ?? '');
$mobile = trim($_POST['billing_mobile'] ?? '');
$amount = trim($_POST['amount'] ?? '');
$source = trim($_POST['source'] ?? 'website_donation');

if ($name === '' || $address === '' || $mobile === '' || $amount === '') {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => 'Please fill name, address, mobile number and amount.']);
    exit;
}

if (!is_numeric($amount) || (float)$amount < 1) {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => 'Please enter a valid donation amount.']);
    exit;
}

try {
    if (!RazorpayHelper::isConfigured()) {
        throw new Exception('Razorpay keys are not configured in admin panel.');
    }

    $settings = RazorpayHelper::settings();
    $amountValue = round((float)$amount, 2);
    $amountPaise = (int) round($amountValue * 100);
    $receipt = 'FTI-' . date('ymdHis') . '-' . random_int(100, 999);

    $stmt = $conn->prepare("INSERT INTO donations (donor_name, donor_address, donor_mobile, amount, currency, razorpay_mode, status, receipt, source) VALUES (?, ?, ?, ?, ?, ?, 'created', ?, ?)");
    $stmt->bind_param('sssdssss', $name, $address, $mobile, $amountValue, $settings['currency'], $settings['mode'], $receipt, $source);
    $stmt->execute();
    $donationId = $stmt->insert_id;
    $stmt->close();

    $order = RazorpayHelper::request('POST', '/orders', [
        'amount' => $amountPaise,
        'currency' => $settings['currency'],
        'receipt' => $receipt,
        'notes' => [
            'donation_id' => (string)$donationId,
            'billing_name' => substr($name, 0, 256),
            'billing_mobile' => substr($mobile, 0, 256),
            'source' => substr($source, 0, 256),
        ],
    ]);

    $orderId = $order['id'];
    $stmt = $conn->prepare("UPDATE donations SET razorpay_order_id = ?, status = 'order_created' WHERE id = ?");
    $stmt->bind_param('si', $orderId, $donationId);
    $stmt->execute();
    $stmt->close();

    echo json_encode([
        'status' => 'success',
        'key_id' => $settings['key_id'],
        'mode' => $settings['mode'],
        'donation_id' => $donationId,
        'order_id' => $orderId,
        'amount' => $amountPaise,
        'display_amount' => number_format($amountValue, 2, '.', ''),
        'currency' => $settings['currency'],
        'name' => $site['site_title'] ?? 'Family Tree India',
        'description' => 'Donation',
        'prefill' => [
            'name' => $name,
            'contact' => $mobile,
        ],
        'notes' => [
            'address' => $address,
        ],
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
