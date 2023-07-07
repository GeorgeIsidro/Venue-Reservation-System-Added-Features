<?php
$host = 'localhost';
$db = 'databasendgm';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

    // Retrieve the venue name from the query parameter
    $venue = isset($_GET['venue']) ? $_GET['venue'] : '';

    // Fetch the month-long reservations for the selected venue
    if (!empty($venue)) {
        $stmt = $conn->prepare("SELECT * FROM reservations WHERE venue_name = ? AND MONTH(reservation_date) = ?");
        $stmt->execute([$venue, date('m')]);
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retrieve the venue details
        $stmt = $conn->prepare("SELECT location, capacity FROM venues WHERE venue_name = ?");
        $stmt->execute([$venue]);
        $venueDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        // Display the venue details
        echo '<h2>Venue: ' . $venue . '</h2>';
        echo '<p>Location: ' . $venueDetails['location'] . '</p>';
        echo '<p>Capacity: ' . $venueDetails['capacity'] . '</p>';

        // Display the table header
        echo '<table>';
        echo '<tr><th>ID</th><th>Purpose</th><th>Reservation Date</th><th>Start Time</th><th>End Time</th><th>Grace Period</th><th>Contact Person</th><th>Sector</th><th>Date Reserved</th></tr>';

        // Display each reservation as a table row
        foreach ($reservations as $reservation) {
            echo '<tr>';
            echo '<td>' . $reservation['id'] . '</td>';
            echo '<td>' . $reservation['purpose'] . '</td>';
            echo '<td>' . $reservation['reservation_date'] . '</td>';
            echo '<td>' . $reservation['start_time'] . '</td>';
            echo '<td>' . $reservation['end_time'] . '</td>';
            echo '<td>' . $reservation['grace_period'] . '</td>';
            echo '<td>' . $reservation['contact_person'] . '</td>';
            echo '<td>' . $reservation['sector'] . '</td>';
            echo '<td>' . $reservation['date_reserved'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No venue selected.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<a href="reservations.php">Back to Reservations</a>
