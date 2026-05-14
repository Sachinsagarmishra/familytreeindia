<?php
include_once '../includes/config.php';

$seo_settings = [
    'site_title' => 'Family Tree Foundation — Sustainable Campus Greening in Bihar',
    'meta_description' => 'Family Tree Foundation transforms government school campuses in Bihar into climate-resilient green spaces. Through our flagship "Bachpan Sang Hariyali" initiative, we empower students as guardians of native trees for long-term environmental impact.'
];

foreach ($seo_settings as $key => $value) {
    $val = $conn->real_escape_string($value);
    $check = $conn->query("SELECT * FROM site_settings WHERE setting_key = '$key'");
    if ($check->num_rows > 0) {
        $conn->query("UPDATE site_settings SET setting_value = '$val' WHERE setting_key = '$key'");
    } else {
        $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$val')");
    }
}

echo "SEO settings updated successfully.";
?>
