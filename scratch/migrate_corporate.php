<?php
include_once '../includes/config.php';

$corporate_settings = [
    // HERO
    'corp_hero_tag' => 'CSR Partnerships',
    'corp_hero_title_main' => 'Corporate',
    'corp_hero_title_highlight' => 'Partnerships',
    'corp_hero_title_end' => '',
    'corp_hero_sub' => 'Bachpan Sang Hariyali × Family Tree Foundation',

    // INTRO
    'corp_intro_eyebrow' => 'About the Program',
    'corp_intro_title_main' => 'Transforming school',
    'corp_intro_title_highlight' => 'campuses into',
    'corp_intro_title_end' => 'greener spaces.',
    'corp_intro_text' => 'Partner with us to help transform government school campuses across Bihar into greener, cooler, and climate-resilient spaces through survival-first plantation and sustainable campus greening.',
    'corp_intro_note' => 'Implemented in partnership with the Education Department, Government of Bihar.',

    // OPTIONS HEAD
    'corp_options_eyebrow' => 'Partnership Options',
    'corp_options_title_main' => 'Choose your level',
    'corp_options_title_highlight' => 'of impact.',
    'corp_options_title_end' => '',

    // OPTION CARD 1
    'corp_card1_title' => 'Adopt a School',
    'corp_card1_sub' => 'Support greening within a single government school campus.',
    'corp_card1_list' => '<li><span class="check-ico">🌳</span> 50–100 native and climate-adapted trees</li>
<li><span class="check-ico">🔧</span> Plantation and on-ground supervision</li>
<li><span class="check-ico">🎒</span> Student participation and stewardship</li>
<li><span class="check-ico">🛡️</span> Tree guards and survival support</li>
<li><span class="check-ico">📊</span> Monitoring and impact reporting</li>',

    // OPTION CARD 2
    'corp_card2_title' => 'Adopt a Block / Cluster',
    'corp_card2_sub' => 'Support implementation across multiple schools within a block or cluster.',
    'corp_card2_list' => '<li><span class="check-ico">🏫</span> Multi-school plantation rollout</li>
<li><span class="check-ico">📋</span> Standardised implementation and monitoring</li>
<li><span class="check-ico">📍</span> Survival tracking and reporting</li>
<li><span class="check-ico">📄</span> CSR documentation support</li>
<li><span class="check-ico">🤝</span> Local engagement and visibility opportunities</li>',

    // OPTION CARD 3
    'corp_card3_title' => 'Adopt a District',
    'corp_card3_sub' => 'Enable large-scale environmental impact across an entire district.',
    'corp_card3_list' => '<li><span class="check-ico">🗺️</span> District-wide plantation implementation</li>
<li><span class="check-ico">🔄</span> Coordinated rollout across schools</li>
<li><span class="check-ico">📡</span> Structured monitoring systems</li>
<li><span class="check-ico">📊</span> Impact reporting and documentation</li>
<li><span class="check-ico">🌍</span> Regional engagement and visibility support</li>',

    // ADD-ONS
    'corp_addons_eyebrow' => 'Enhance Your Impact',
    'corp_addons_title_main' => 'Optional',
    'corp_addons_title_highlight' => 'Add-Ons',
    'corp_addons_title_end' => '',
    'corp_addons_note' => 'Partners may also choose to support:',
    'corp_addons_list' => '<div class="corp-addon-item"><span class="addon-ico">🛡️</span><span class="addon-txt">Tree guards and protective fencing</span></div>
<div class="corp-addon-item"><span class="addon-ico">💧</span><span class="addon-txt">Water support / hydration points</span></div>
<div class="corp-addon-item"><span class="addon-ico">🌿</span><span class="addon-txt">Campus shade and greening enhancements</span></div>
<div class="corp-addon-item"><span class="addon-ico">🌳</span><span class="addon-txt">Mid-campus green spaces</span></div>
<div class="corp-addon-item"><span class="addon-ico">👥</span><span class="addon-txt">Employee volunteering drives</span></div>
<div class="corp-addon-item"><span class="addon-ico">🏷️</span><span class="addon-txt">Co-branded plantation boards</span></div>
<div class="corp-addon-item"><span class="addon-ico">🎉</span><span class="addon-txt">Launch and engagement events</span></div>
<div class="corp-addon-item"><span class="addon-ico">📍</span><span class="addon-txt">Geo-tagging and impact dashboards</span></div>
<div class="corp-addon-item"><span class="addon-ico">📈</span><span class="addon-txt">Extended survival monitoring support</span></div>',

    // RECEIVE
    'corp_receive_eyebrow' => 'What Partners Receive',
    'corp_receive_title_main' => 'Everything you need',
    'corp_receive_title_highlight' => 'for measurable',
    'corp_receive_title_end' => 'impact.',
    'corp_receive_list' => '<div class="corp-receive-item"><div class="cri-n">01</div><div><div class="cri-title">Structured implementation support</div></div></div>
<div class="corp-receive-item"><div class="cri-n">02</div><div><div class="cri-title">CSR-ready reporting and documentation</div></div></div>
<div class="corp-receive-item"><div class="cri-n">03</div><div><div class="cri-title">Plantation photos and impact updates</div></div></div>
<div class="corp-receive-item"><div class="cri-n">04</div><div><div class="cri-title">Employee engagement opportunities</div></div></div>
<div class="corp-receive-item"><div class="cri-n">05</div><div><div class="cri-title">Visibility through co-branded activities</div></div></div>',
    'corp_receive_closing' => 'A measurable and long-term environmental initiative rooted in survival, not just plantation numbers.',

    // CERTS
    'corp_certs_eyebrow' => 'Certifications & Registrations',
    'corp_certs_title_main' => 'Fully compliant.',
    'corp_certs_title_highlight' => 'Fully transparent.',
    'corp_certs_title_end' => '',
    
    // CERT CARDS
    'corp_cert1_title' => 'CSR-1 Registration',
    'corp_cert1_desc' => 'Registered under the Companies Act, 2013 for eligible CSR spending by corporate partners.',
    'corp_cert2_title' => '80G Certification',
    'corp_cert2_desc' => 'Donations are eligible for tax deduction under Section 80G of the Income Tax Act.',
    'corp_cert3_title' => 'DARPAN Registration',
    'corp_cert3_desc' => 'Registered on the NITI Aayog DARPAN portal as a verified non-profit organisation.',

    // CTA
    'corp_cta_title_main' => 'Ready to create',
    'corp_cta_title_highlight' => 'a lasting',
    'corp_cta_title_end' => 'green legacy?',
    'corp_cta_sub' => 'Start a conversation with our partnerships team and discover how your organisation can drive measurable environmental change.'
];

foreach ($corporate_settings as $key => $value) {
    $val = $conn->real_escape_string($value);
    $check = $conn->query("SELECT * FROM site_settings WHERE setting_key = '$key'");
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('$key', '$val')");
    }
}

echo "Corporate settings migration completed.";
?>
