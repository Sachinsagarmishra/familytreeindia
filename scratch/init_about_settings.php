<?php
include_once '../includes/config.php';

$about_keys = [
    'about_intro_eyebrow' => 'ABOUT US',
    'about_intro_title' => 'Family Tree Foundation is a<br />non-profit organisation building<br /><i>permanent green cover</i> through<br />schools and communities.',
    'about_intro_img1' => '4.jpeg',
    'about_intro_img2' => 'twogirlplanting.jpeg',
    'about_intro_img3' => '11.jpeg',
    
    'about_marquee_img1' => '1.jpeg',
    'about_marquee_img2' => '3.jpeg',
    'about_marquee_img3' => 'insitute.jpeg',
    'about_marquee_img4' => 'indi.png',
    'about_marquee_img5' => '12.jpeg',
    'about_marquee_img6' => '4.jpeg',
    'about_marquee_img7' => '8.jpeg',
    'about_marquee_img8' => '11.jpeg',

    'about_mission_title' => 'Together, we can build a<br /><i>greener</i> Bihar',
    'about_mission_text' => 'Since Family Tree Foundation began, we\'ve been chasing one ambitious goal: ensuring every government school in Bihar has a thriving green campus. And while the environmental crisis is massive, we\'re optimistic. We know how to solve the problem, and we make progress every day thanks to the dedication of student guardians, local communities, and generous supporters. If we work together, we believe every child will grow up surrounded by trees within our lifetime.',

    'about_target_districts' => '10',
    'about_target_blocks' => '149',
    'about_target_schools' => '15402',
    'about_target_plants' => '770100',

    'about_completed_districts' => '4',
    'about_completed_blocks' => '13',
    'about_completed_schools' => '125',
    'about_completed_guardians' => '10500',
    'about_completed_trees' => '12500',

    'about_founder_title' => 'Founder',
    'about_founder_text' => 'Dr. Ajay Sinha, Chairman of CMX Group and an MBA graduate, is a committed leader in environmental and social impact. He has led the plantation of over 10 million trees through the Social Forestry Program and created sustainable livelihoods for thousands, driving inclusive growth and climate action.',
    'about_founder_name' => 'Dr. Ajay Sinha,',
    'about_founder_designation' => 'Environmentalist and Director',
    'about_founder_img' => 'ajay-sinha-founder.jpeg',

    'about_leader_name' => 'Riya Kriti',
    'about_leader_designation' => 'Executive Director',
    'about_leader_img' => 'founderimage.jpg',
    'about_leader_eyebrow' => 'LEADERSHIP',
    'about_leader_title' => 'Leadership with<br /><i>Impact</i>',
    'about_leader_text1' => 'Family Tree Foundation was founded with a single, powerful conviction — that <strong>lasting green cover</strong> isn\'t built by organisations alone, it\'s built by communities. What started as a vision to plant trees in a single school has grown into a proven model that has already transformed <strong>125 government schools</strong> across <strong>4 districts</strong> and <strong>13 blocks</strong>.',
    'about_leader_text2' => 'Under our leadership, we pioneered the <strong>student guardianship model</strong> — assigning each tree to one of our <strong>10,500 student guardians</strong>. With an ambitious target to reach <strong>15,402 schools</strong> and plant <strong>7,70,100 trees</strong> across <strong>10 districts (in the next 2 years)</strong>, we are building a generation of environmental stewards.',

    'about_partners_title' => 'Backed by institutions<br />that <i>matter.</i>',
    'about_partners_eyebrow' => 'OUR PARTNERS & SUPPORTERS'
];

foreach ($about_keys as $key => $value) {
    $check = $conn->query("SELECT id FROM site_settings WHERE setting_key = '$key'");
    if ($check->num_rows == 0) {
        $val = $conn->real_escape_string($value);
        $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$val')");
        echo "Inserted $key<br>";
    } else {
        // Optional: Update if exists to sync defaults? No, let's just insert missing ones.
        // Or update if you want to force current values into DB for the first time.
        // For now, only insert if missing.
        echo "Skipped $key (already exists)<br>";
    }
}

echo "Done!";
?>
