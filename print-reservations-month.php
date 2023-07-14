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

<!DOCTYPE html>
<html>
<head>
    <title>Print Reservations for Month</title>
</head>
<body>
    <h1>Print Reservations for Month</h1>
    <form action="" method="post">
        <label for="month">Select Month:</label>
        <select name="month" id="month" required>
            <option value="">Select a month</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
			<option value="04">April</option>
			<option value="05">May</option>
			<option value="06">June</option>
			<option value="07">July</option>
			<option value="08">August</option>
			<option value="09">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
            <!-- Add more options for the remaining months -->
        </select>
        <br><br>
        <input type="submit" value="Print Reservations">
    </form>
	<br><br>
	<button onclick="window.open('view-database.php')">Back</button>
	<button onclick="window.open('home-2.php')">Home</button>
	<button onclick="window.open('reservations.php')">Reserve Venue</button>
</body>
</html>
