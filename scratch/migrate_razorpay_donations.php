<?php
include_once '../includes/config.php';

$queries = [
    "CREATE TABLE IF NOT EXISTS donations (
        id int(11) NOT NULL AUTO_INCREMENT,
        donor_name varchar(150) NOT NULL,
        donor_address text NOT NULL,
        donor_mobile varchar(30) NOT NULL,
        donor_state varchar(100) DEFAULT NULL,
        ip_address varchar(45) DEFAULT NULL,
        amount decimal(12,2) NOT NULL,
        currency varchar(10) NOT NULL DEFAULT 'INR',
        razorpay_mode enum('test','live') NOT NULL DEFAULT 'test',
        razorpay_order_id varchar(100) DEFAULT NULL,
        razorpay_payment_id varchar(100) DEFAULT NULL,
        razorpay_signature varchar(255) DEFAULT NULL,
        status varchar(40) NOT NULL DEFAULT 'created',
        payment_method varchar(50) DEFAULT NULL,
        payer_email varchar(150) DEFAULT NULL,
        payer_contact varchar(30) DEFAULT NULL,
        receipt varchar(100) DEFAULT NULL,
        source varchar(100) DEFAULT NULL,
        webhook_event_id varchar(150) DEFAULT NULL,
        raw_payload longtext DEFAULT NULL,
        paid_at datetime DEFAULT NULL,
        created_at timestamp NOT NULL DEFAULT current_timestamp(),
        updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (id),
        UNIQUE KEY razorpay_order_id (razorpay_order_id),
        KEY razorpay_payment_id (razorpay_payment_id),
        KEY status (status),
        KEY razorpay_mode (razorpay_mode)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS razorpay_webhook_events (
        id int(11) NOT NULL AUTO_INCREMENT,
        event_id varchar(150) NOT NULL,
        event_type varchar(100) DEFAULT NULL,
        payload longtext DEFAULT NULL,
        created_at timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (id),
        UNIQUE KEY event_id (event_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
];

$settings = [
    'razorpay_mode' => 'test',
    'razorpay_currency' => 'INR',
    'razorpay_test_key_id' => '',
    'razorpay_test_key_secret' => '',
    'razorpay_test_webhook_secret' => '',
    'razorpay_live_key_id' => '',
    'razorpay_live_key_secret' => '',
    'razorpay_live_webhook_secret' => '',
];

foreach ($queries as $query) {
    if ($conn->query($query)) {
        echo "Success: table migration complete.<br>";
    } else {
        echo "Error: " . htmlspecialchars($conn->error) . "<br>";
    }
}

$columns = [
    'donor_state' => "ALTER TABLE donations ADD COLUMN donor_state varchar(100) DEFAULT NULL AFTER donor_mobile",
    'ip_address' => "ALTER TABLE donations ADD COLUMN ip_address varchar(45) DEFAULT NULL AFTER donor_state",
];

foreach ($columns as $column => $query) {
    $safeColumn = $conn->real_escape_string($column);
    $check = $conn->query("SHOW COLUMNS FROM donations LIKE '$safeColumn'");
    if ($check && $check->num_rows == 0) {
        if ($conn->query($query)) {
            echo "Added column: " . htmlspecialchars($column) . "<br>";
        } else {
            echo "Error adding column " . htmlspecialchars($column) . ": " . htmlspecialchars($conn->error) . "<br>";
        }
    }
}

foreach ($settings as $key => $value) {
    $safeKey = $conn->real_escape_string($key);
    $safeValue = $conn->real_escape_string($value);
    $check = $conn->query("SELECT id FROM site_settings WHERE setting_key = '$safeKey'");
    if ($check && $check->num_rows == 0) {
        if ($conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$safeKey', '$safeValue')")) {
            echo "Added setting: " . htmlspecialchars($key) . "<br>";
        } else {
            echo "Error adding setting " . htmlspecialchars($key) . ": " . htmlspecialchars($conn->error) . "<br>";
        }
    }
}

echo "Razorpay donation migration complete.";
