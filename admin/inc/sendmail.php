<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer
require 'drc.php'; // Load DRC
require 'env.php'; // Load DRC


function sendEmail($to, $toName, $subject, $htmlFile, &$response, $placeholders = [], $from = MAIL, $fromName = COMPANY, $replyTo = null, $cc = [], $bcc = [], $attachments = []) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->CharSet = 'UTF-8'; // ✅ Ensure proper emoji encoding
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL; // Must match `setFrom`
        $mail->Password   = EMAIL_PASSWORD; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587; // 465 for SSL, 587 for TLS

        // Sender & Recipient
        $mail->setFrom($from, $fromName);
        $mail->addAddress($to, $toName);

        // Optional Reply-To
        if ($replyTo) {
            $mail->addReplyTo($replyTo, COMPANY);
        }
      

        // Optional CC & BCC
        foreach ($cc as $email) {
            $mail->addCC($email);
        }
        foreach ($bcc as $email) {
            $mail->addBCC($email);
        }

        // Optional Attachments
        foreach ($attachments as $filePath) {
            $mail->addAttachment($filePath);
        }

        // Load email content from HTML file
        if (!file_exists($htmlFile)) {
            throw new Exception("Email template file not found: $htmlFile");
        }

        $message = file_get_contents($htmlFile);

        // Replace placeholders in the HTML content
        foreach ($placeholders as $key => $value) {
            $message = str_replace("{{{$key}}}", $value, $message);
        }

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        $response['message'] = "Mail error: " . $mail->ErrorInfo;
        return false;
    }
}
?>