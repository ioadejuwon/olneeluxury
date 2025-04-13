<?php
require 'sendmail.php';
require 'admin/inc/drc.php'; // Load DRC  



$fname = 'Isaac';
$to = "ioadejuwon@gmail.com"; // Replace with your email
$subject = "Registration Successful 2 🎉";
$replyTo = BRAND_EMAIL;


$response = [];
$emailSent = sendNewMail(
    $to,
    $fname,
    $subject,
    'email/registration.html', // Path to the email template
    $response,
    [
        'FIRST_NAME' => $fname,
        'YEAR' => FOOTERYEAR
    ],
    $from = BRAND_EMAIL,
    $fromName = COMPANY,
    $replyTo = BRAND_EMAIL,
);

if ($emailSent) {
    echo "Registration email sent!";
} else {
    echo "Email failed: " . ($response['email_error'] ?? 'Unknown error');
}
