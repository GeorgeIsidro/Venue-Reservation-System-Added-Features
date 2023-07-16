<?php
$host = 'localhost';
$db = 'databasendgm';
$user = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected venue
    $selectedVenue = $_POST['venue'];

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

        // Fetch reservations for the selected venue
        $stmt = $conn->prepare("SELECT * FROM reservations WHERE venue_name = ?");
        $stmt->execute([$selectedVenue]);
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($reservations) {
            // Generate the content for the text file
            $content = "Reservations for Venue: " . $selectedVenue . "\r\n";
            $content .= "=========================\r\n\r\n";

            foreach ($reservations as $reservation) {
                $content .= "Reservation ID: " . $reservation['id'] . "\r\n";
                $content .= "Purpose: " . $reservation['purpose'] . "\r\n";
                $content .= "Reservation Date: " . $reservation['reservation_date'] . "\r\n";
                $content .= "Start Time: " . $reservation['start_time'] . "\r\n";
                $content .= "End Time: " . $reservation['end_time'] . "\r\n";
                $content .= "Grace Period: " . $reservation['grace_period'] . "\r\n";
                $content .= "Contact Person: " . $reservation['contact_person'] . "\r\n";
                $content .= "Email: " . $reservation['email'] . "\r\n";
                $content .= "Sector: " . $reservation['sector'] . "\r\n";
                $content .= "Date Reserved: " . $reservation['date_reserved'] . "\r\n\r\n";
            }

            // Set the appropriate headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="reservations_venue_' . $selectedVenue . '.txt"');
            header('Content-Length: ' . strlen($content));
            header('Pragma: no-cache');
            header('Expires: 0');

            // Output the content to the file
            echo $content;
        } else {
            echo 'No reservations found for the selected venue.';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>