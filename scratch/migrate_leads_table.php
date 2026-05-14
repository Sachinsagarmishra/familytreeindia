<?php
include_once '../includes/config.php';

$queries = [
    "ALTER TABLE leads ADD COLUMN state VARCHAR(100) DEFAULT NULL AFTER message",
    "ALTER TABLE leads ADD COLUMN source VARCHAR(100) DEFAULT 'contact_page' AFTER state",
    "ALTER TABLE leads ADD COLUMN ip_address VARCHAR(45) DEFAULT NULL AFTER source"
];

foreach ($queries as $query) {
    if ($conn->query($query)) {
        echo "Success: $query <br>";
    } else {
        echo "Error: " . $conn->error . " for query: $query <br>";
    }
}

echo "Migration Complete!";
?>
