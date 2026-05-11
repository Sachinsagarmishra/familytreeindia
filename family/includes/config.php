<?php
/**
 * Configuration file for Family Tree India
 * Contains Database and System settings
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'family_tree');

// SMTP Configuration (For future use)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', '');
define('SMTP_PASS', '');
define('SMTP_FROM_EMAIL', 'info@familytreeindia.org');
define('SMTP_FROM_NAME', 'Family Tree India');

// System Constants
define('SITE_URL', 'http://localhost/familytree/family');

// Establish Connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set Charset
$conn->set_charset("utf8mb4");

session_start();
?>
