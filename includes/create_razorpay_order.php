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
$countryCode = trim($_POST['billing_country_code'] ?? '+91');
$phoneNumber = preg_replace('/\D+/', '', $_POST['billing_phone_number'] ?? '');
$mobile = trim($_POST['billing_mobile'] ?? '');
$amount = trim($_POST['amount'] ?? '');
$source = trim($_POST['source'] ?? 'website_donation');
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$state = 'Unknown';

if ($mobile === '' && $phoneNumber !== '') {
    $mobile = str_replace('-', '', $countryCode) . $phoneNumber;
}

if ($name === '' || $address === '' || $phoneNumber === '' || $amount === '') {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => 'Please fill name, address, mobile number and amount.']);
    exit;
}

if ($countryCode === '+91' && strlen($phoneNumber) !== 10) {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => 'Indian mobile number must be exactly 10 digits.']);
    exit;
}

if ($countryCode !== '+91' && (strlen($phoneNumber) < 5 || strlen($phoneNumber) > 15)) {
    http_response_code(422);
    echo json_encode(['status' => 'error', 'message' => 'Please enter a valid mobile number.']);
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

    if ($ip !== '') {
        $geo = @file_get_contents("http://ip-api.com/json/" . rawurlencode($ip) . "?fields=regionName");
        if ($geo) {
            $geoData = json_decode($geo, true);
            if (!empty($geoData['regionName'])) {
                $state = $geoData['regionName'];
            }
        }
    }

    $hasDonorState = false;
    $hasIpAddress = false;
    $columnRes = $conn->query("SHOW COLUMNS FROM donations");
    if ($columnRes) {
        while ($column = $columnRes->fetch_assoc()) {
            if ($column['Field'] === 'donor_state') $hasDonorState = true;
            if ($column['Field'] === 'ip_address') $hasIpAddress = true;
        }
    }

    if ($hasDonorState && $hasIpAddress) {
        $stmt = $conn->prepare("INSERT INTO donations (donor_name, donor_address, donor_mobile, donor_state, ip_address, amount, currency, razorpay_mode, status, receipt, source) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'created', ?, ?)");
        if (!$stmt) {
            throw new Exception('Donation insert could not be prepared: ' . $conn->error);
        }
        $stmt->bind_param('sssssdssss', $name, $address, $mobile, $state, $ip, $amountValue, $settings['currency'], $settings['mode'], $receipt, $source);
    } else {
        $stmt = $conn->prepare("INSERT INTO donations (donor_name, donor_address, donor_mobile, amount, currency, razorpay_mode, status, receipt, source) VALUES (?, ?, ?, ?, ?, ?, 'created', ?, ?)");
        if (!$stmt) {
            throw new Exception('Donation insert could not be prepared. Please run scratch/migrate_razorpay_donations.php once. Database error: ' . $conn->error);
        }
        $stmt->bind_param('sssdssss', $name, $address, $mobile, $amountValue, $settings['currency'], $settings['mode'], $receipt, $source);
    }
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
    if (!$stmt) {
        throw new Exception('Donation order update could not be prepared: ' . $conn->error);
    }
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
