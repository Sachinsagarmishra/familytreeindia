<?php
include_once '../includes/config.php';

$contact_keys = [
    'contact_hero_eyebrow' => 'GET IN TOUCH',
    'contact_hero_title' => 'Let’s <i>grow</i> something<br>meaningful together.',
    'contact_hero_subtext' => "Whether you're a corporate partner, a donor agency, or a volunteer, we'd love to hear from you. Reach out and help us build a greener Bihar.",
    'contact_form_name_label' => 'Names',
    'contact_form_name_placeholder' => 'John Doe',
    'contact_form_email_label' => 'Email ID',
    'contact_form_email_placeholder' => 'john@example.com',
    'contact_form_phone_label' => 'Phone number',
    'contact_form_phone_placeholder' => '+91 XXXXX XXXXX',
    'contact_form_company_label' => 'Company name',
    'contact_form_company_placeholder' => 'Your Organization',
    'contact_form_interest_label' => 'Interested in',
    'contact_form_interest_placeholder' => 'Select an option',
    'contact_form_message_label' => 'Comments (optional)',
    'contact_form_message_placeholder' => 'How can we help you?',
    'contact_form_submit_text' => 'Send Message',
    'contact_map_text' => 'Our initiatives span 125 schools across 4 districts in Bihar.',
    'contact_map_link_text' => 'See Our Impact'
];

foreach ($contact_keys as $key => $value) {
    $check = $conn->query("SELECT id FROM site_settings WHERE setting_key = '$key'");
    if ($check->num_rows == 0) {
        $val = $conn->real_escape_string($value);
        $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$val')");
        echo "Inserted $key<br>";
    } else {
        echo "$key already exists<br>";
    }
}

echo "Done!";
?>
