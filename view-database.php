<!DOCTYPE html>
<html>
<head>
  <title>Reservations</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }
    
    h1 {
      text-align: center;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    th,
    td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #f8f8f8;
      font-weight: bold;
    }
    
    tr:hover {
      background-color: #f5f5f5;
    }
    
    form {
      margin-top: 20px;
    }
    
    input[type="submit"] {
      display: inline-block;
      padding: 8px 12px;
      background-color: #4CAF50;
      color: #fff;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    
    .notification {
      display: none;
      padding: 20px;
      background-color: #f44336;
      color: white;
      font-weight: bold;
    }
    
    .success {
      background-color: #4CAF50;
    }
	
	.custom-button {
	  display: inline-block;
	  padding: 8px 12px;
	  background-color: #4CAF50;
	  color: #fff;
	  text-decoration: none;
	  border: none;
	  border-radius: 4px;
	  cursor: pointer;
	  margin-top: 10px;
	}

	.custom-button:hover {
	  background-color: #45a049;
	}

  </style>
</head>
<body>
  <h1>Reservations</h1>

<?php
$host = 'localhost';
$db = 'databasendgm';
$user = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['cancel_reservation'])) {
            $reservationId = $_POST['cancel_reservation'];

            // Delete the reservation from the database
            $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
            $stmt->execute([$reservationId]);

            echo "<script>alert('Reservation canceled successfully.');</script>";
        } elseif (isset($_POST['search_by_date'])) {
            $searchDate = $_POST['search_date'];

            // Retrieve reservations for the specified date
            $stmt = $conn->prepare("SELECT * FROM reservations WHERE reservation_date = ?");
            $stmt->execute([$searchDate]);
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } elseif (isset($_POST['search_by_venue'])) {
            $searchVenue = $_POST['search_venue'];

            // Retrieve reservations for the specified venue
            $stmt = $conn->prepare("SELECT * FROM reservations WHERE venue_name = ?");
            $stmt->execute([$searchVenue]);
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        // Retrieve all reservations by default
        $stmt = $conn->query("SELECT * FROM reservations");
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    echo '<h2>Search Reservations by Date</h2>';
    echo '<form action="" method="post">';
    echo '<input type="date" name="search_date" required>';
    echo '<input type="submit" name="search_by_date" value="Search">';
    echo '</form>';

    echo '<h2>Search Venue Availability</h2>';
    echo '<form action="" method="post">';
    echo '<input type="text" name="search_venue" placeholder="Enter venue name" required>';
    echo '<input type="submit" name="search_by_venue" value="Search">';
    echo '</form>';

    if (isset($reservations)) {
        echo '<h2>Reservations</h2>';
        echo '<table>';
        echo '<tr><th>ID</th><th>Venue</th><th>Purpose</th><th>Reservation Date</th><th>Start Time</th><th>End Time</th><th>Grace Period</th><th>Contact Person</th><th>Email</th><th>Sector</th><th>Date Reserved</th><th>Cancellation</th><th>Confirmation</th><th>Print</th></tr>';

        foreach ($reservations as $reservation) {
            echo '<tr>';
            echo '<td>' . $reservation['id'] . '</td>';
            echo '<td>' . $reservation['venue_name'] . '</td>';
            echo '<td>' . $reservation['purpose'] . '</td>';
            echo '<td>' . $reservation['reservation_date'] . '</td>';
            echo '<td>' . $reservation['start_time'] . '</td>';
            echo '<td>' . $reservation['end_time'] . '</td>';
            echo '<td>' . $reservation['grace_period'] . '</td>';
            echo '<td>' . $reservation['contact_person'] . '</td>';
            echo '<td>' . $reservation['email'] . '</td>';
            echo '<td>' . $reservation['sector'] . '</td>';
            echo '<td>' . $reservation['date_reserved'] . '</td>';
            echo '<td><form action="" method="post"><input type="hidden" name="cancel_reservation" value="' . $reservation['id'] . '"><button type="submit" onclick="return confirm(\'Are you sure you want to cancel this reservation?\')">Cancel</button></form></td>';
            echo '<td><button onclick="sendConfirmationEmail(\'' . $reservation['email'] . '\')">Send Confirmation</button></td>';
            echo '<td><button onclick="printReservation(' . $reservation['id'] . ')">Print</button></td>';
            echo '</tr>';
        }

        echo '</table>';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<script>
    function sendConfirmationEmail(email) {
        // AJAX request to send the confirmation email
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'send-email.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Confirmation email sent!');
            }
        };
        xhr.send('email=' + email);
    }

    function printReservation(reservationId) {
        // AJAX request to generate and print the reservation
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'print-reservation.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Open the generated file for printing
                window.open('print-reservation.php', '_blank');
            }
        };
        xhr.send('reservation_id=' + reservationId);
    }

    function printReservationsForMonth() {
        // AJAX request to generate and print the reservations for the month
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'print-reservations-month.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Open the generated file for printing
                window.open('print-reservations-month.php', '_blank');
            }
        };
        xhr.send();
    }

    function printReservationsPerVenue() {
        // AJAX request to generate and print the reservations per venue
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'print-reservations-venue.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Open the generated file for printing
                window.open('print-reservations-venue.php', '_blank');
            }
        };
        xhr.send();
    }
</script>

<form action="reservations.php" method="post">
  <input type="submit" value="Make Another Reservation">
</form>
	<br>
	<button class="custom-button" onclick="printReservationsForMonth()">Print Reservations for the Month</button>
	<br>
	<button class="custom-button" onclick="printReservationsPerVenue()">Print Reservations per Venue</button>


<form action="Act9-1Home.php" method="post">
  <input type="submit" value="Home">
</form>
</body>
</html>
