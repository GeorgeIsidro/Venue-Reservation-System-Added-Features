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

<!DOCTYPE html>
<html>
<head>
    <title>Print Reservations per Venue</title>
</head>
<body>
    <h1>Print Reservations per Venue</h1>
    <form action="" method="post">
        <label for="venue">Select Venue:</label>
        <select name="venue" id="venue" required>
            <option value="">Select a venue</option>
			<option value="Gym">Gym</option>
			<option value="NDCPA">NDCPA</option>
			<option value="Barangay Court">Barangay Court</option>
			<option value="SHS Covered Court">SHS Covered Court</option>
			<option value="Dining Hall">Dining Hall</option>
			<option value="DM Function Hall">DM Function Hall</option>
			<option value="Dance Studio">Dance Studio</option>
			<option value="ES Basketball Court">ES Basketball Court</option>
			<option value="Badminton Court">Badminton Court</option>	
			<option value="TLE Laboratory">TLE Laboratory</option>
			<option value="Chapel">Chapel</option>
			<option value="Business Office Lobby">Business Office Lobby</option>
			<option value="ES Flagpole Area">ES Flagpole Area</option>
			<option value="Student's Lounge">Student's Lounge</option>
			<option value="Cookery">Cookery</option>
			<option value="Jose Ante Lounge">Jose Ante Lounge</option>
			<option value="Kinder Playground">Kinder Playground</option>
            <!-- Add more options for other venues -->
        </select>
        <br><br>
        <input type="submit" value="Print Reservations">
    </form>
</body>
</html>