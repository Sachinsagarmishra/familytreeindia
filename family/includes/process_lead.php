<?php
include_once 'config.php';
require_once 'MailHelper.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $company = $conn->real_escape_string($_POST['company']);
    $interest = $conn->real_escape_string($_POST['interest']);
    $message = $conn->real_escape_string($_POST['message']);

    // Save to database
    $sql = "INSERT INTO leads (name, email, phone, company, interest, message) VALUES ('$name', '$email', '$phone', '$company', '$interest', '$message')";
    
    if ($conn->query($sql)) {
        // Send Email notification
        $subject = "New Inquiry: $interest ($name)";
        $body = "<h2>Website Inquiry Received</h2>
                 <p><strong>Name:</strong> $name</p>
                 <p><strong>Email:</strong> $email</p>
                 <p><strong>Phone:</strong> $phone</p>
                 <p><strong>Company:</strong> $company</p>
                 <p><strong>Interest:</strong> $interest</p>
                 <p><strong>Message:</strong> $message</p>";
        
        MailHelper::send('info@familytreeindia.org', $subject, $body);
        
        echo json_encode(["status" => "success", "message" => "Thank you! We'll get back to you soon."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error. Please try again."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
