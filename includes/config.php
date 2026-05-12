<?php
/**
 * Configuration file for Family Tree India
 * Contains Database and System settings
 */

// Enable Error Reporting for Debugging (Disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Configuration 
// IMPORTANT: Update these with your Hostinger DB details
define('DB_HOST', 'localhost');
define('DB_USER', 'u829703776_familytree');
define('DB_PASS', 'Mercedes@001');
define('DB_NAME', 'u829703776_familytree');

// SMTP Configuration (For future use)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', '');
define('SMTP_PASS', '');
define('SMTP_FROM_EMAIL', 'info@familytreeindia.org');
define('SMTP_FROM_NAME', 'Family Tree India');

// System Constants
// IMPORTANT: Update this to your live URL (e.g., https://mediumseagreen-reindeer-145910.hostingersite.com/family)
// Do NOT include a trailing slash at the end
define('SITE_URL', rtrim('https://familytreeindia.org', '/'));

// Establish Connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Database Connection Error: " . $conn->connect_error . ". Please check your credentials in config.php");
}

// Set Charset
$conn->set_charset("utf8mb4");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Global Site Settings Loader
$site = [];
$settings_res = $conn->query("SELECT setting_key, setting_value FROM site_settings");
if ($settings_res) {
    while($srow = $settings_res->fetch_assoc()) {
        $site[$srow['setting_key']] = $srow['setting_value'];
    }
}

// Fallbacks for critical keys
if(!isset($site['site_title'])) $site['site_title'] = 'Family Tree';
if(!isset($site['meta_description'])) $site['meta_description'] = '';
if(!isset($site['contact_email'])) $site['contact_email'] = 'info@familytreeindia.org';
