<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Send the confirmation email to the provided email address
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'george_isidro@dlsu.edu.ph'; // Replace with your SMTP username
        $mail->Password   = 'mhjouvwfaqhgbumu'; // Replace with your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender and recipient
        $mail->setFrom('george_isidro@dlsu.edu.ph', 'George Isidro'); // Replace with your email and name
        $mail->addAddress($email);

        // Email content
        $mail->isHTML(false);
        $mail->Subject = 'Reservation Confirmation';
        $mail->Body    = 'Your reservation has been confirmed.';

        $mail->send();
        echo 'Email sent!';
    } catch (Exception $e) {
        echo 'Error: Failed to send the email. ' . $mail->ErrorInfo;
    }
}
?>