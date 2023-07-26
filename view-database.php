<!DOCTYPE html>
<html>
<head>
  <title>Reservations</title>
  <link rel="stylesheet" href="view-database.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <style>
    body {
      font-family: Arial, sans-serif;
        background: #0F5401;
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
      background-color: #050505;
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
	
	 h2 {
      text-align: center;
      font-family: 'Montserrat';
      color: #ffffff; /* Change the font color to white */
    }
    
    h3 {
      text-align: center;
      font-family: 'Montserrat';
      font-size: 24px; /* Increase the font size */
    }
	

  </style>
</head>
<body>
	<div class="main">
			<div class="navbar">
				<div class="icon">
					<img src = "icon-reservation.png" class = "picture-icon">
				</div>
				<div class = navbar-text>
					<h2 class="logo">Venue Reservation</h2>
				</div>
			  

			</div> 
			
			<div class="menu">
				<ul>
					<li><a href="#">HOME</a></li>
					<li><a href="#">ABOUT</a></li>
					<li><a href="Act9-1Register.php">REGISTER</a></li>
				</ul>
			</div>
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

            header("Location: view-database.php");
                exit();
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

    echo '<h2 class = "header-2" style="color: #ffffff;">Search Reservations by Date</h2>';
    echo '<form action="" class = "header-2"  method="post">';
    echo '<input type="date" name="search_date" required>';
    echo '<input type="submit" name="search_by_date" value="Search">';
    echo '</form>';
	echo '<br>';
  


    echo '<h2 class = "header-3" style="color: #ffffff;">Search Venue Availability</h2>';
    echo '<form class = "header-3" action="" method="post">';
    echo '<input type="text" name="search_venue" placeholder="Enter venue name" required>';
    echo '<input type="submit" name="search_by_venue" value="Search">';
    echo '</form>';
	echo '<br>';

    if (isset($reservations)) {
        echo '<h3 style="color: #ffffff;">Reservations</h3>';
        echo '<table style="border-radius: 10px;">';
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
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {
					// Open the generated file for printing
					window.open('print-reservation.php?reservation_id=' + reservationId, '_blank');
				} else {
					// Handle error or display a message
					alert('Failed to generate the reservation for ID: ' + reservationId);
				}
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


<form class = "reservation-button" action="reservations.php" method="post">
  <input type="submit" value="Make Another Reservation">
</form>
	
<form class = "print-reservations-month-button" action="print-reservations-month.php" method="post">
  <input type="submit" value="Print Reservations for the Month">
</form>
	
<form class = "print-reservations-venue-button" action="print-reservations-venue.php" method="post">
  <input type="submit" value="Print Reservations per Venue">
</form>
 
<form action="Act9-1Home.php" method="post">
  <input type="submit" value="Home">
</form>
</body>
</html>
