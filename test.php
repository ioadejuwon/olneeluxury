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



// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php'; // Or adjust path to PHPMailer if not using Composer

// $mail = new PHPMailer(true);





$pwordhash = password_hash('Password', PASSWORD_BCRYPT);
echo $pwordhash;


echo '<br><br>';

echo password_verify('Password', $pwordhash);