<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if PHPMailer exists, otherwise we'll need the user to upload it
if (file_exists(__DIR__ . '/PHPMailer/src/Exception.php')) {
    require __DIR__ . '/PHPMailer/src/Exception.php';
    require __DIR__ . '/PHPMailer/src/PHPMailer.php';
    require __DIR__ . '/PHPMailer/src/SMTP.php';
}

class MailHelper {
    public static function send($to, $subject, $body) {
        global $conn;

        // Fetch SMTP settings from DB
        $settings = [];
        $res = $conn->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'smtp_%' OR setting_key = 'from_email'");
        while($row = $res->fetch_assoc()) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        if (empty($settings['smtp_user']) || empty($settings['smtp_pass'])) {
            return ["status" => false, "message" => "SMTP settings not configured."];
        }

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = $settings['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $settings['smtp_user'];
            $mail->Password   = $settings['smtp_pass'];
            $mail->SMTPSecure = $settings['smtp_encryption']; // 'tls' or 'ssl'
            $mail->Port       = $settings['smtp_port'];

            // Recipients
            $mail->setFrom($settings['from_email'], 'Family Tree India');
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return ["status" => true, "message" => "Email sent successfully."];
        } catch (Exception $e) {
            return ["status" => false, "message" => "Mailer Error: {$mail->ErrorInfo}"];
        }
    }
}
