<!DOCTYPE html>
<html>
<head>
  <title>Venue Reservation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }
    
    h1 {
      text-align: center;
    }
    
    form {
      margin-top: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 5px;
    }
    
    input[type="text"],
    input[type="date"],
    input[type="time"] {
      padding: 8px;
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
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
    
    button {
      display: inline-block;
      padding: 8px 12px;
      background-color: #ccc;
      color: #fff;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }
    
    button:hover {
      background-color: #999;
    }
    
    .notification {
      display: none;
      padding: 20px;
      background-color: #f44336;
      color: white;
      font-weight: bold;
      margin-top: 20px;
    }
    
    .success {
      background-color: #4CAF50;
    }
	.input-field {
	  width: 100%;
	  padding: 8px;
	  border: 1px solid #ccc;
	  border-radius: 4px;
	  box-sizing: border-box;
	}
  </style>
  <script>
    function showNotification(status) {
      const notification = document.getElementById('notification');
      if (status === 'accepted') {
        notification.textContent = 'Reservation successfully created!';
        notification.classList.remove('error');
        notification.classList.add('success');
      } else if (status === 'rejected') {
        notification.textContent = 'Selected time slot overlaps with an existing reservation or venue. Please choose a different time or venue.';
        notification.classList.remove('success');
        notification.classList.add('error');
      }

      notification.style.display = 'block';

      setTimeout(function () {
        notification.style.display = 'none';
      }, 5000); // Display for 5 seconds
    }
  </script>
</head>
<body>
  <h1>Venue Reservation</h1>
 
  <div id="notification" class="notification"></div>
 
  <form method="POST" action="" onsubmit="showNotification('');">
    <label for="venues">Venue:</label>
		<select id="venues" name="venues" required class = "input-field">
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
		</select>
		<br><br>


    <label for="purpose">Purpose:</label>
    <input type="text" id="purpose" name="purpose" required>
    <br><br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>
    <br><br>

    <label for="start_time">Start Time:</label>
    <input type="time" id="start_time" name="start_time">
    <br><br>

    <label for="end_time">End Time:</label>
    <input type="time" id="end_time" name="end_time">
    <br><br>

    <label for="contact_person">Contact Person:</label>
    <input type="text" id="contact_person" name="contact_person" required>
    <br><br>
	
	<label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br><br>

    <label for="sector">Sector:</label>
    <input type="text" id="sector" name="sector" required>
    <br><br>

    <label for="date_reserved">Date Reserved:</label>
    <input type="date" id="date_reserved" name="date_reserved" required>
    <br><br>

    <input type="submit" value="Submit">
  </form>
 
  <br>
  <button onclick="window.open('view-database.php')">View Database Contents</button>
 
  <?php
    // Establish the database connection
    $host = 'localhost';
    $db = 'databasendgm';
    $user = 'root';
    $password = '';

    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (
            isset($_POST['venues']) &&
            isset($_POST['purpose']) &&
            isset($_POST['date']) &&
            isset($_POST['start_time']) &&
            isset($_POST['end_time']) &&
            isset($_POST['contact_person']) &&
            isset($_POST['email']) &&
            isset($_POST['sector']) &&
            isset($_POST['date_reserved'])
        ) {
            $venueName = $_POST['venues'];
            $purpose = $_POST['purpose'];
            $date = $_POST['date'];
            $startTime = $_POST['start_time'];
            $endTime = $_POST['end_time'];
            $contactPerson = $_POST['contact_person'];
			$email = $_POST['email'];
            $sector = $_POST['sector'];
            $date_reserved = $_POST['date_reserved'];

            // Calculate the end time with grace period
            $gracePeriod = 60;
            $endTimeWithGrace = date('H:i:s', strtotime($endTime) + $gracePeriod * 60);

            // Check if any overlapping reservations exist for the same time slot and venue combination
            $stmt = $conn->prepare("SELECT COUNT(*) FROM reservations WHERE venue_name = ? AND reservation_date = ? AND ((start_time <= ? AND end_time >= ?) OR (start_time <= ? AND end_time >= ?) OR (start_time <= ? AND end_time >= ?) OR (start_time >= ? AND end_time <= ?))");
            $stmt->execute([$venueName, $date, $startTime, $startTime, $endTime, $endTime, $startTime, $endTime, $startTime, $endTimeWithGrace]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                echo "<script>showNotification('rejected');</script>";
            } else {
                // Insert the reservation into the database
                $stmt = $conn->prepare("INSERT INTO reservations (venue_name, purpose, reservation_date, start_time, end_time, grace_period, contact_person, email, sector, date_reserved) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$venueName, $purpose, $date, $startTime, $endTimeWithGrace, $gracePeriod, $contactPerson, $email, $sector, $date_reserved]);

                echo "<script>showNotification('accepted');</script>";
            }
        }
    }
  ?>

</body>
</html>
