<?php
$host = 'localhost';
$db = 'databasendgm';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

    // Retrieve the reservation ID from the query parameter
    $reservationId = isset($_GET['reservation_id']) ? $_GET['reservation_id'] : '';

    if (!empty($reservationId)) {
        // Fetch the reservation with the specified ID
        $stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ?");
        $stmt->execute([$reservationId]);
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reservation) {
            // Generate the content for the text file
            $content = "Reservation Details\r\n";
            $content .= "===================\r\n\r\n";
            $content .= "Reservation ID: " . $reservation['id'] . "\r\n";
            $content .= "Venue: " . $reservation['venue_name'] . "\r\n";
            $content .= "Purpose: " . $reservation['purpose'] . "\r\n";
            $content .= "Reservation Date: " . $reservation['reservation_date'] . "\r\n";
            $content .= "Start Time: " . $reservation['start_time'] . "\r\n";
            $content .= "End Time: " . $reservation['end_time'] . "\r\n";
            $content .= "Grace Period: " . $reservation['grace_period'] . "\r\n";
            $content .= "Contact Person: " . $reservation['contact_person'] . "\r\n";
            $content .= "Email: " . $reservation['email'] . "\r\n";
            $content .= "Sector: " . $reservation['sector'] . "\r\n";
            $content .= "Date Reserved: " . $reservation['date_reserved'] . "\r\n";

            // Set the appropriate headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="reservation_' . $reservationId . '.txt"');
            header('Content-Length: ' . strlen($content));
            header('Pragma: no-cache');
            header('Expires: 0');

            // Output the content to the file
            echo $content;
        } else {
            echo 'Reservation not found.';
        }
    } else {
        echo 'Invalid reservation ID.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
