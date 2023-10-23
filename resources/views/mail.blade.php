<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Path to the Composer autoloader

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 0; // Set to 2 for detailed debugging
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'harshraikwar42@gmail.com'; // Your Gmail email address
    $mail->Password = 'uuvg xrxo bfgz xgxl'; // Your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient information
    $mail->setFrom('harshraikwar42@gmail.com', 'Harsh Raikwar');
    $mail->addAddress('harshraikwar42@gmail.com', 'Harsh Raikwar');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Subject';
    $mail->Body = 'This is the HTML message body';
    $mail->AltBody = 'This is the plain text message body';

    // Send the email
    $mail->send();
    echo 'Message has been sent';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}