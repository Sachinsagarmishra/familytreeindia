<?php
include_once '../includes/config.php';

// Check if partners table exists
$checkTable = $conn->query("SHOW TABLES LIKE 'partners'");

if ($checkTable->num_rows == 0) {
    $sql = "CREATE TABLE partners (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        logo VARCHAR(255) NOT NULL,
        order_index INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table 'partners' created successfully.<br>";
        
        // Insert initial logos
        $initial_partners = [
            ['name' => 'Bihar Education Project Council', 'logo' => 'Bihar-Education-Project-Council.svg'],
            ['name' => 'AIIMS Delhi', 'logo' => 'aiims-delhi.svg'],
            ['name' => 'Ministry of Education', 'logo' => 'ministry of education.svg'],
            ['name' => 'Government of Bihar', 'logo' => 'Government-of-Bihar.svg'],
            ['name' => 'CMX Foundation', 'logo' => 'cmx-foundation.svg']
        ];

        foreach ($initial_partners as $p) {
            $name = $conn->real_escape_string($p['name']);
            $logo = $conn->real_escape_string($p['logo']);
            $conn->query("INSERT INTO partners (name, logo) VALUES ('$name', '$logo')");
        }
        echo "Initial partners seeded.<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
    echo "Table 'partners' already exists.";
}
?>
