<?php
include_once '../includes/config.php';

$new_settings = [
    'about_intro_title_main' => 'Family Tree Foundation is a',
    'about_intro_title_highlight' => 'non-profit organisation',
    'about_intro_title_end' => 'building permanent green cover through schools and communities.',
    
    'about_mission_title_main' => 'Together, we can build a',
    'about_mission_title_highlight' => 'greener',
    'about_mission_title_end' => 'Bihar',
    
    'about_leader_title_main' => 'Leadership with',
    'about_leader_title_highlight' => 'Impact',
    'about_leader_title_end' => '',
    
    'contact_hero_title_main' => 'Let\'s grow something',
    'contact_hero_title_highlight' => 'meaningful',
    'contact_hero_title_end' => 'together.'
];

foreach ($new_settings as $key => $value) {
    $val = $conn->real_escape_string($value);
    $check = $conn->query("SELECT * FROM site_settings WHERE setting_key = '$key'");
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$val')");
        echo "Inserted $key<br>";
    } else {
        echo "$key already exists<br>";
    }
}

echo "Migration completed.";
?>
