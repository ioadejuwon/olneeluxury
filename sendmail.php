<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer
// require 'drc.php'; // Load DRC
include_once 'admin/inc/env.php'; // Load DRC


function sendNewMail(
    $to,
    $toName,
    $subject,
    $bodyFile,
    &$response,
    $placeholders = [],
    $from = BRAND_EMAIL,
    $fromName = COMPANY,
    $replyTo = null,
    $cc = [],
    $bcc = [],
    $attachments = [],
    $headerFile = 'admin/email/header.html',
    $footerFile = 'admin/email/footer.html'
) {
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = 3; // Shows connection and authentication steps
    // $mail->Debugoutput = function ($str, $level) {
    //     error_log("SMTP Debug (level $level): $str");
    // };


    try {
        // SMTP Configuration
        $mail->CharSet = 'UTF-8'; // ✅ Ensure proper emoji encoding
        $mail->isSMTP();
        $mail->Host       = 'smtp.titan.email'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = BRAND_EMAIL; // Must match `setFrom`
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
        // if (!file_exists($htmlFile)) {
        //     throw new Exception("Email template file not found: $htmlFile");
        // }

        // $message = file_get_contents($htmlFile);

        // Replace placeholders in the HTML content
        // foreach ($placeholders as $key => $value) {
        //     $message = str_replace("{{{$key}}}", $value, $message);
        // }

        // Load header, body, and footer
        if (!file_exists($bodyFile)) {
            throw new Exception("Email body template not found: $bodyFile");
        }
        if (!file_exists($headerFile)) {
            throw new Exception("Email header template not found: $headerFile");
        }
        if (!file_exists($footerFile)) {
            throw new Exception("Email footer template not found: $footerFile");
        }

        $header = file_get_contents($headerFile);
        $body = file_get_contents($bodyFile);
        $footer = file_get_contents($footerFile);

        // Merge them together
        $message = $header . $body . $footer;


        foreach ($placeholders as $key => $value) {
            $message = str_replace("{{{$key}}}", $value ?? '', $message);
        }


        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Send email
        // error_log("Password: " . EMAIL_PASSWORD ." ". $mail->ErrorInfo);
        // error_log("SMTP Host: " . $mail->Host);
        // error_log("SMTP Username: " . $mail->Username);
        // error_log("SMTP Port: " . $mail->Port);
        // error_log("SMTP Secure: " . $mail->SMTPSecure);

        $mail->send();
        return true;
    } catch (Exception $e) {
        // $response['message'] = "Mail error: " . $mail->ErrorInfo;
        $response['message'] = "Mail errorp: " . ($mail->ErrorInfo ?: $e->getMessage());
        $response['email_error'] = $e->getMessage(); // Optional: store raw exception
        error_log("PHPMailer Exception: " . $e->getMessage()); // Optional: Log it for debugging

        return false;
    }
}
