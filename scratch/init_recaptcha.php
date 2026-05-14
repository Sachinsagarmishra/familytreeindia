<?php
include_once '../includes/config.php';

$recaptcha_keys = [
    'recaptcha_site_key' => '6LfuQuksAAAAAJy0P7X2Wo63oVyp6JnnUuSlmJ2c',
    'recaptcha_secret_key' => '6LfuQuksAAAAAGPmoaTGEIweMoZiU7f1laUk2ccX'
];

foreach ($recaptcha_keys as $key => $value) {
    $check = $conn->query("SELECT id FROM site_settings WHERE setting_key = '$key'");
    if ($check->num_rows == 0) {
        $val = $conn->real_escape_string($value);
        $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$val')");
        echo "Inserted $key<br>";
    } else {
        $val = $conn->real_escape_string($value);
        $conn->query("UPDATE site_settings SET setting_value = '$val' WHERE setting_key = '$key'");
        echo "Updated $key<br>";
    }
}

echo "Done!";
?>
