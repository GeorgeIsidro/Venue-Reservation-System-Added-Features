<?php
$host = 'localhost';
$db = 'databasendgm';
$user = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected month
    $selectedMonth = $_POST['month'];

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

        // Fetch reservations for the selected month
        $stmt = $conn->prepare("SELECT * FROM reservations WHERE MONTH(reservation_date) = ?");
        $stmt->execute([$selectedMonth]);
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($reservations) {
            // Generate the content for the text file
            $content = "Reservations for Month: " . $selectedMonth . "\r\n";
            $content .= "==========================\r\n\r\n";

            foreach ($reservations as $reservation) {
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
                $content .= "Date Reserved: " . $reservation['date_reserved'] . "\r\n\r\n";
            }

            // Set the appropriate headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="reservations_month_' . $selectedMonth . '.txt"');
            header('Content-Length: ' . strlen($content));
            header('Pragma: no-cache');
            header('Expires: 0');

            // Output the content to the file
            echo $content;
        } else {
            echo 'No reservations found for the selected month.';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>