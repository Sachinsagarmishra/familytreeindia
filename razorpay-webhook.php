<?php
include_once 'includes/config.php';
require_once 'includes/RazorpayHelper.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error']);
    exit;
}

$rawBody = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'] ?? '';
$eventId = $_SERVER['HTTP_X_RAZORPAY_EVENT_ID'] ?? '';

if ($signature === '' || !RazorpayHelper::verifyWebhookSignature($rawBody, $signature)) {
    http_response_code(400);
    echo json_encode(['status' => 'invalid_signature']);
    exit;
}

$payload = json_decode($rawBody, true);
if (!is_array($payload)) {
    http_response_code(400);
    echo json_encode(['status' => 'invalid_payload']);
    exit;
}

$event = $payload['event'] ?? 'unknown';

if ($eventId !== '') {
    $stmt = $conn->prepare("SELECT id FROM razorpay_webhook_events WHERE event_id = ? LIMIT 1");
    $stmt->bind_param('s', $eventId);
    $stmt->execute();
    $stmt->bind_result($existingEventId);
    $existing = $stmt->fetch();
    $stmt->close();

    if ($existing) {
        echo json_encode(['status' => 'duplicate_ignored']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO razorpay_webhook_events (event_id, event_type, payload) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $eventId, $event, $rawBody);
    $stmt->execute();
    $stmt->close();
}

$payment = $payload['payload']['payment']['entity'] ?? null;

if (is_array($payment)) {
    $paymentId = $payment['id'] ?? '';
    $orderId = $payment['order_id'] ?? '';
    $status = $payment['status'] ?? $event;
    $method = $payment['method'] ?? null;
    $email = $payment['email'] ?? null;
    $contact = $payment['contact'] ?? null;
    $amount = isset($payment['amount']) ? ((float)$payment['amount'] / 100) : null;

    if ($orderId !== '') {
        $stmt = $conn->prepare("UPDATE donations SET razorpay_payment_id = COALESCE(NULLIF(?, ''), razorpay_payment_id), status = ?, payment_method = ?, payer_email = ?, payer_contact = ?, amount = COALESCE(?, amount), webhook_event_id = ?, raw_payload = ?, paid_at = IF(? IN ('authorized', 'captured') AND paid_at IS NULL, NOW(), paid_at) WHERE razorpay_order_id = ?");
        $stmt->bind_param('sssssdssss', $paymentId, $status, $method, $email, $contact, $amount, $eventId, $rawBody, $status, $orderId);
        $stmt->execute();
        $stmt->close();
    }
}

echo json_encode(['status' => 'ok']);
