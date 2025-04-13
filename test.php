<?php
// require 'sendmail.php';
// require 'admin/inc/drc.php'; // Load DRC  



// $fname = 'Isaac';
// $to = "ioadejuwon@gmail.com"; // Replace with your email
// $subject = "Registration Successful 2 🎉";
// $replyTo = BRAND_EMAIL;


// $response = [];
// $emailSentp = sendNewMail(
//     $to,
//     $fname,
//     $subject,
//     'email/registration.html', // Path to the email template
//     $response,
//     [
//         'FIRST_NAME' => $fname,
//         'YEAR' => FOOTERYEAR
//     ],
//     $from = BRAND_EMAIL,
//     $fromName = COMPANY,
//     $replyTo = BRAND_EMAIL,
// );

// if ($emailSentp) {
//     echo "Registration email sent!";
// } else {
//     echo "Email failedm: " . ($response['email_error'] ?? 'Unknown error');
// }



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Or adjust path to PHPMailer if not using Composer

$mail = new PHPMailer(true);

// try {
//     // Server settings
//     $mail->isSMTP();
//     $mail->Host       = 'smtp.hostinger.com';
//     $mail->SMTPAuth   = true;
//     $mail->Username   = 'tech@olneeluxury.com'; // FULL email address
//     $mail->Password   = 'Juwon_Isaac'; // Be sure this is accurate
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//     $mail->Port       = 587;
//     $mail->CharSet    = 'UTF-8';

//     // Recipients
    // $mail->setFrom('tech@olneeluxury.com', 'Olnee Luxury');
    // $mail->addAddress('ioadejuwon@gmail.com'); // Your test receiver email

//     // Content
//     $mail->isHTML(true);
//     $mail->Subject = 'Test Email';
//     $mail->Body    = '<h1>Hello from PHPMailer</h1><p>This is a test.</p>';

//     $mail->send();
//     echo 'Message sent successfully';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }



try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.hostinger.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tech@olneeluxury.com'; // FULL email address
    $mail->Password   = 'Juwon_Isaac'; // Be sure this is accurate
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // ✅ SSL encryption
    $mail->Port       = 465;
    $mail->CharSet    = 'UTF-8';

    // Recipients
    $mail->setFrom('tech@olneeluxury.com', 'Olnee Luxury');
    $mail->addAddress('ioadejuwon@gmail.com'); // Your test receiver email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'PHPMailer SSL Test';
    $mail->Body    = '<p>This is a <b>test email</b> sent using <code>SSL</code> on port 465.</p>';

    $mail->send();
    echo '✅ Message sent successfully!';
} catch (Exception $e) {
    echo "❌ Message could not be sent. Error: {$mail->ErrorInfo}";
}
