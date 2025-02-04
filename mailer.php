<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                         // Set mailer to use SMTP
    $mail->Host       = 'smtp.example.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                // Enable SMTP authentication
    $mail->Username   = 'your_email@example.com';            // SMTP username
    $mail->Password   = 'your_email_password';               // SMTP password
    $mail->SMTPSecure = 'tls';                               // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                 // TCP port to connect to

    // Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('recipient@example.com', 'Recipient Name');     // Add a recipient

    // Content
    $mail->isHTML(true);                                     // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
