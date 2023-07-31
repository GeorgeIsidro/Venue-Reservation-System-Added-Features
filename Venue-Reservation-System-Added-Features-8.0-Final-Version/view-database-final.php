<!DOCTYPE html>
<html>

<head>
  <title>Bootstrap Navbar</title>
  <link rel = "stylesheet" href="view-database-final.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>

<body>
  <!-- NavBar -->
  <nav class="navbar navbar-expand-lg navbar-#0F5401 bg-#0F5401">
      <a class="navbar-brand" href="#">
        <img src="notre-dame.png" width="30" height="30" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="navbar-practice.html">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Act9-1Register.php">Register</a>
          </li>
          <li class = "nav-item">
            <a class = "nav-link" href="reservations.php"> Reserve a Venue</a>
          </li>
          <li class = "nav-item">
            <a class = "nav-link" href="reservation_form_final.php"> Reserve Equipment</a>
          </li>
          <li class = "nav-item">
            <a class = "nav-link" href="view-reservations-final.php"> View Equipment Reservations</a>
          </li>
        </ul>
      </div>
  </nav>

  <!-- Main Function -->
  
  <h2>Reserved Venues</h2>

  <div class = "main">

    
      <!--First Modal-->
      <div class = "col-md-4">
        <div class = "modal fade" id="myModal">
          <div class = "modal-dialog">
            <div class = "modal-content">
              <div class = "modal-header">
                <h1 style="text-align: center;
                font-family: 'Montserrat';
                font-size: 15px;"> Print Reservations for the Month</h1>
              </div>
              <div class = "modal-body">
                <form action="generate-reservations-file-month.php" method="post">
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
              </div>
              <div class = "modal-footer">
                  <input class = "btn btn-default" data-dismiss="modal" value = "Close">
              </div>

            </div>
          </div>
        </div>
      
        
        





      </div>
      <!--Second Modal-->
        <div class = "col-md-13">
          <div class = "modal fade" id="ModalmeDaddy">
            <div class = "modal-dialog">
              <div class = "modal-content">
                <div class = "modal-header">
                  <h1 style="text-align: center;
                  font-family: 'Montserrat';
                  font-size: 15px;"> Print Reservations for the Venue</h1>
                </div>
                <div class = "modal-body">
                  <form action="generate-reservations-file.php" method="post">
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
          
                    <input type="submit" value="Print Reservations">
                    </form>
                </div>
                <div class = "modal-footer">
                    <input class = "btn btn-default" data-dismiss="modal" value = "Close">
                </div>
              </div>
            </div>
        </div>
      
    









    <h2 class = "header-2">Search Reservations by Date</h2>
    <form action="" class = "header-2"  method="post">
    <input type="date" name="search_date" required>
    <input type="submit" name="search_by_date" value="Search">
    </form>    
    </form>    

    <?php
    $host = 'localhost';
    $db = 'databasendgm';
    $user = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

        // Check if a reservation cancellation request was made
        if (isset($_POST['cancel_reservation'])) {
            $reservationId = $_POST['cancel_reservation'];

            // Delete the reservation from the database
            $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
            $stmt->execute([$reservationId]);

            echo "<script>alert('Reservation canceled successfully.');</script>";
        }

        // Check if a search by date request was made
        if (isset($_POST['search_by_date'])) {
            $searchDate = $_POST['search_date'];

            // Retrieve reservations for the specified date
            $stmt = $conn->prepare("SELECT * FROM reservations WHERE reservation_date = ?");
            $stmt->execute([$searchDate]);
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Check if a search by venue request was made
        if (isset($_POST['search_by_venue'])) {
            $searchVenue = $_POST['search_venue'];

            // Retrieve reservations for the specified venue
            $stmt = $conn->prepare("SELECT * FROM reservations WHERE venue_name = ?");
            $stmt->execute([$searchVenue]);
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // If no specific search request, retrieve all reservations by default
        if (!isset($reservations)) {
            $stmt = $conn->query("SELECT * FROM reservations");
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if (!empty($reservations)) {
            echo '<h3 style="color: #ffffff;">Reservations</h3>';
            echo '<table style="border-radius: 10px;">';
            echo '<tr><th>ID</th><th>Venue</th><th>Purpose</th><th>Reservation Date</th><th>Start Time</th><th>End Time</th><th>Grace Period</th><th>Contact Person</th><th>Email</th><th>Sector</th><th>Date Reserved</th><th>Cancellation</th><th>Confirmation</th><th>Print</th></tr>';

            foreach ($reservations as $reservation) {
                // Display reservation details in rows
			echo '<tr>';
			echo '<td>' . $reservation['id'] . '</td>';
			echo '<td>' . $reservation['venue_name'] . '</td>';
			echo '<td>' . $reservation['purpose'] . '</td>';
			echo '<td>' . $reservation['reservation_date'] . '</td>';
			echo '<td>' . date('g:i A', strtotime($reservation['start_time'])) . '</td>'; // Display start time in 12-hour format
			echo '<td>' . date('g:i A', strtotime($reservation['end_time'])) . '</td>';   // Display end time in 12-hour format
			echo '<td>' . $reservation['grace_period'] . '</td>';
			echo '<td>' . $reservation['contact_person'] . '</td>';
			echo '<td>' . $reservation['email'] . '</td>';
			echo '<td>' . $reservation['sector'] . '</td>';
			echo '<td>' . $reservation['date_reserved'] . '</td>';
			echo '<td><form action="" method="post"><input type="hidden" name="cancel_reservation" value="' . $reservation['id'] . '"><button type="submit" onclick="return confirm(\'Are you sure you want to cancel this reservation?\')">Cancel</button></form></td>';
			echo '<td>';
			echo '<button style="border-radius: 5px;" onclick="sendConfirmation(\'' . $reservation['email'] . '\', ' . $reservation['id'] . ')">';
			echo 'Send Confirmation';
			echo '</button>';
			echo '</td>';
			echo '<td><button onclick="printReservation(' . $reservation['id'] . ')">Print</button></td>';
			echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No reservations found.</p>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    ?>


  <a href = "reservations.php"> <button class="btn btn-primary">Make A Reservation</button> </a>
  <a href = "" data-toggle="modal" data-target="#myModal"><button class="btn btn-secondary"> Print reservations for the Month</button></a>
  <a href = "" data-toggle="modal" data-target="#ModalmeDaddy"><button class="btn btn-success" type="print-reservations-venue.php">Print Reservations per Venue</button></a>
  <a href = "navbar-practice.html"><button class="btn btn-warning">Home</button></a>
    
   
  

    <script>
		function sendConfirmation(email, reservationId) {
			const xhr = new XMLHttpRequest();
			xhr.open('POST', 'send-email.php', true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						alert('Confirmation email sent!');
					} else {
						alert('Failed to send confirmation email.');
					}
				}
			};
			xhr.send('email=' + email + '&reservation_id=' + reservationId);
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
    
  </div>


</body>

</html>