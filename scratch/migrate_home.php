<?php
include_once '../includes/config.php';

$home_settings = [
    // HERO
    'home_hero_tag' => 'Bachpan Sang Hariyali',
    'home_hero_title_main' => 'Planting trees.',
    'home_hero_title_highlight' => 'Raising',
    'home_hero_title_end' => 'guardians.',
    'home_hero_sub' => "We don't just plant trees — we assign each one to a student. 8 lakh trees. 15000 schools. One generation taking responsibility for the next.",

    // STATS
    'home_stat1_val' => '4.5M+', 'home_stat1_lbl' => 'SAPLINGS PLANTED',
    'home_stat2_val' => '74%', 'home_stat2_lbl' => 'AVERAGE SURVIVAL RATE',
    'home_stat3_val' => '83,600 <small>TCO₂</small>', 'home_stat3_lbl' => 'SEQUESTERED ANNUALLY',
    'home_stat4_val' => '25K+', 'home_stat4_lbl' => 'Community ENGAGED',
    'home_stat_footnote' => '"The above impact metrics reflect the cumulative implementation experience of the leadership team behind Family Tree Foundation across large-scale social forestry and green infrastructure initiatives in Bihar to date."',

    // STORY
    'home_story_pull' => 'A child who plants<br />a tree never lets<br />it <span>die.</span>',
    'home_story_eyebrow' => 'Who We Are',
    'home_story_title_main' => 'Built on the',
    'home_story_title_highlight' => 'belief',
    'home_story_title_end' => 'that nature needs a champion.',
    'home_story_text1' => 'Family Tree grew from a simple conviction: that lasting green cover isn\'t built by organisations — it\'s built by communities. We began with one school in Bihar. Today, 125 schools across 10 districts are home to student-tended forests that are alive, growing, and tracked in real time.',
    'home_story_text2' => 'We are the only plantation initiative in the region where every single tree has a named guardian — a student responsible for its survival.',

    // HARIT BIHAR MISSION (HBM)
    'home_hbm_badge' => 'Government Partnership',
    'home_hbm_title_main' => 'Bachpan Sang',
    'home_hbm_title_highlight' => 'Hariyali',
    'home_hbm_title_end' => '',
    'home_hbm_subtitle' => 'An initiative by Family Tree Foundation',
    'home_hbm_text' => '“Harit Bihar Mission” is a large-scale green infrastructure initiative focused on creating greener, healthier, and climate-resilient public spaces across Bihar. As part of this vision, Family Tree Foundation is implementing “Bachpan Sang Hariyali” — a flagship school-based initiative that engages students in the plantation and long-term stewardship of trees, fostering environmental awareness and community ownership, helping build a generation that is more connected to nature and environmental responsibility.',
    'home_hbm_highlight' => 'Through this public-private partnership, we work towards a single goal — to transform government school campuses across the state through a shared vision of survival-first plantation and sustainable campus greening.',

    // TRANSFORMATION
    'home_ts_title' => 'More Trees, Better Tomorrow',
    'home_ts_desc' => 'See how a greener school creates a healthier future.',

    // PROGRAM STEPS
    'home_prog_title_main' => 'From your donation to a',
    'home_prog_title_highlight' => 'living tree.',
    'home_prog_title_end' => '',
    'home_prog_note' => 'Every rupee tracked. Every tree geo-tagged. You see exactly where your money goes — and who\'s looking after it.',
    
    // PARTNER PATHWAYS
    'home_part_eyebrow' => 'Get Involved',
    'home_part_title_main' => 'Every kind of partner',
    'home_part_title_highlight' => 'grows something',
    'home_part_title_end' => 'different.',

    // HOW IT WORKS / DELIVERABLES
    'home_hiw_title_main' => 'What we',
    'home_hiw_title_highlight' => 'deliver',
    'home_hiw_title_end' => '',
    'home_hiw_note' => 'Our five-step model is what separates us from every other plantation drive. Survival, not just numbers.',

    // DONATE
    'home_donate_title_main' => 'Help grow the next',
    'home_donate_title_highlight' => 'school forest.',
    'home_donate_title_end' => '',
    'home_donate_sub' => 'Your support helps us reach more schools and empower more student guardians. Every contribution ensures a lasting green legacy for the next generation, where every tree is cared for and tracked for life.'
];

foreach ($home_settings as $key => $value) {
    $val = $conn->real_escape_string($value);
    $check = $conn->query("SELECT * FROM site_settings WHERE setting_key = '$key'");
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$val')");
    }
}

echo "Home settings migration completed.";
?>
