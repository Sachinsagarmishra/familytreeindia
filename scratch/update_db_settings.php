<?php
include_once 'includes/config.php';

$settings_to_add = [
    'facebook_url' => 'https://facebook.com/familytreeindia',
    'instagram_url' => 'https://instagram.com/familytreeindia',
    'linkedin_url' => 'https://linkedin.com/company/familytreeindia',
    'twitter_url' => 'https://twitter.com/familytreeindia',
    'meta_description' => 'Family Tree Foundation is building permanent green cover through schools and communities in India.',
];

foreach ($settings_to_add as $key => $value) {
    $check = $conn->query("SELECT id FROM site_settings WHERE setting_key = '$key'");
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$value')");
        echo "Added: $key\n";
    } else {
        echo "Exists: $key\n";
    }
}
?>
