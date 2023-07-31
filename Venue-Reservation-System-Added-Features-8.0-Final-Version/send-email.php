<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if 'reservation_id' is set before using it
    if (isset($_POST['reservation_id'])) {
        $reservationId = $_POST['reservation_id'];

        // Database connection settings
        $host = 'localhost';
        $db = 'databasendgm';
        $user = 'root';
        $password = '';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Retrieve the reservation details from the database
            $stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ?");
            $stmt->execute([$reservationId]);
            $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$reservation) {
                echo 'Error: Reservation not found';
                exit;
            }

            // Send the confirmation email to the provided email address
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jsmujal@ndgm63.edu.ph'; // Replace with your SMTP username
            $mail->Password   = 'czpewllhyeikiltg'; // Replace with your SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Sender and recipient
            $mail->setFrom('jsmujal@ndgm63.edu.ph', 'Joy Mujal'); // Replace with your email and name
            $mail->addAddress($email);
			
			$start_time_12hr = date("h:i A", strtotime($reservation['start_time']));
			$end_time_12hr = date("h:i A", strtotime($reservation['end_time']));
            
			// Email content
            $mail->isHTML(false);
            $mail->Subject = 'Reservation Confirmation';

            // Build the email body with reservation details
            $emailBody = "Notre Dame Venue Reservation System\n\n";
			$emailBody = "Your Venue reservation has been confirmed. Thank you! Should you require any further action or additional information, please feel free to contact me. \n\n";
            $emailBody .= "Reservation ID: " . $reservation['id'] . "\n";
            $emailBody .= "Venue: " . $reservation['venue_name'] . "\n";
            $emailBody .= "Purpose: " . $reservation['purpose'] . "\n";
            $emailBody .= "Reservation Date: " . $reservation['reservation_date'] . "\n";
            $emailBody .= "Start Time: " . $start_time_12hr . "\n";
            $emailBody .= "End Time: " . $end_time_12hr . "\n";
            $emailBody .= "Contact Person: " . $reservation['contact_person'] . "\n";
            $emailBody .= "Sector: " . $reservation['sector'] . "\n";
            $emailBody .= "Date Reserved: " . $reservation['date_reserved'] . "\n";

            $mail->Body = $emailBody;

            $mail->send();
            echo 'Email sent!';
        } catch (Exception $e) {
            echo 'Error: Failed to send the email. ' . $mail->ErrorInfo;
        }
    }
}
?>
