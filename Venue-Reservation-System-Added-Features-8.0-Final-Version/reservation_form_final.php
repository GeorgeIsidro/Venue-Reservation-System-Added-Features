<?php
// Check if the equipment name is provided in the query parameter
if (isset($_POST['equipment_name'])) {
  $equipmentName = $_POST['equipment_name'];

  // Establish the database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "databasendgm";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
  }

  // Fetch the equipment data from the equipment table based on the equipment name
  $stmt = $conn->prepare("SELECT available_quantity FROM equipment WHERE name = ?");
  $stmt->execute([$equipmentName]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $availableQuantity = $row['available_quantity'];

    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $quantity = $_POST['quantity'];
      $place = $_POST['place'];
      $dateNeeded = $_POST['date_needed'];
	  $timeNeeded = $_POST['time_needed'];
      $dateReserved = $_POST['date_reserved'];
      $contactPerson = $_POST['contact_person'];
	  $email = $_POST['email'];
      $sector = $_POST['sector'];

      // Check if the requested quantity is available
      if ($quantity <= $availableQuantity) {
        // Deduct the reserved quantity from the available quantity in the equipment table
        $updatedQuantity = $availableQuantity - $quantity;
        $stmt = $conn->prepare("UPDATE equipment SET available_quantity = ? WHERE name = ?");
        $stmt->execute([$updatedQuantity, $equipmentName]);

        // Insert the reservation details into the reservations table
        $stmt = $conn->prepare("INSERT INTO equipment_reservation (equipment_name, quantity, place, date_needed, time_needed, date_reserved, contact_person, email, sector) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$equipmentName, $quantity, $place, $dateNeeded, $timeNeeded, $dateReserved, $contactPerson, $email, $sector]);

        // Redirect back to equipment.php after successful reservation
        header("Location: equipment_final.php");
        exit;
      } else {
        echo '<p style="background-color: red; color: white; padding: 10px;">Insufficient quantity available. Please choose a lower quantity.</p>';

      }
    }
  } else {
    echo '<p style="background-color: red; color: white; padding: 10px;">Invalid Equipment Name.</p>';
  }
}
?>



<!DOCTYPE html>
<html>
<head>
  <title>View Reservations</title>
  <style>
    input[type="time"] {
      padding: 8px;
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
  </style>
  <link rel="stylesheet" href = "reservation_form_final.css">
	<link rel="stylesheet" href="transition.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

</head>
<body>
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
            <a class = "nav-link" href="reservations.php"> Reserve Venue</a>
          </li>
          <li class = "nav-item">
            <a class = "nav-link" href="view-database-final.php"> View Venue Reservations</a>
          </li>
		  <li class = "nav-item">
            <a class = "nav-link" href="equipment_final.php"> View Equipment List</a>
          </li>
          <li class = "nav-item">
            <a class = "nav-link" href="view-reservations-final.php"> View Equipment Reservations</a>
          </li>
        </ul>
      </div>
  </nav>
  
  <!-- CONTAINER --->


  <div class="container">
    <h2>Equipment Reservation</h2>
    <form method="POST" action="">
      <label for="equipment_name">Equipment Name:</label>
      <select id="equipment_name" name="equipment_name">
        <!-- Populate the dropdown menu options dynamically from the equipment table -->
        <option value="">Select an equipment</option>
		<option value="Big Movable White Board">Big Movable White Board</option>
		<option value="Big Monoblock Table">Big Monoblock Table</option>
		<option value="Brown Round Table Cloth">Brown Round Table Cloth</option>
		<option value="Circular Platform">Circular Platform</option>
		<option value="Fender">Fender</option>
		<option value="Gooseneck Microphone">Gooseneck Microphone</option>
		<option value="Green Carpet">Green Carpet</option>
		<option value="LED Lights">LED Lights</option>
		<option value="Loose Board">Loose Board</option>
		<option value="Long Rectangular Table">Long Rectangular Table</option>
		<option value="Monoblock Chairs">Monoblock Chairs</option>
		<option value="Monoblock Seat Cover">Monoblock Seat Cover</option>
        <option value="Moving Heads">Moving Heads</option>
		<option value="Podium">Podium</option>
		<option value="Red Carpet">Red Carpet</option>
		<option value="RGB Lights">RGB Lights</option>
        <option value="Round Table">Round Table</option>
		<option value="Small Monoblock Table">Small Monoblock Table</option>
		<option value="Small Movable White Board">Small Movable White Board</option>
		<option value="Square Platform">Square Platform</option>
		<option value="White Round Table Cloth">White Round Table Cloth</option>
		<option value="Wired Microphone">Wired Microphone</option>
        <option value="Wireless Microphone">Wireless Microphone</option>
      </select>
      <br>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" min="1" required>
      <br>

      <label for="place">Place to be Assigned:</label>
      <input type="text" id="place" name="place" required>
      <br>

      <label for="date_needed">Date Needed:</label>
      <input type="date" id="date_needed" name="date_needed" required>
      <br>
	  
	  <label for="time_needed">Time Needed:</label>
      <input type="time" id="time_needed" name="time_needed">
      <br>

      <label for="date_reserved">Date Reserved:</label>
      <input type="date" id="date_reserved" name="date_reserved" required>
      <br>

      <label for="contact_person">Contact Person:</label>
      <input type="text" id="contact_person" name="contact_person" required>
      <br>
	  
	  <label for="email">Email:</label>
      <input type="text" id="email" name="email" required>
      <br>

      <label for="sector">Sector:</label>
      <input type="text" id="sector" name="sector" required>
      <br>

      <input type="submit" value="Reserve">
    </form>

      <div class="view-reservations">
        <!-- Add a button for viewing all equipment reservations -->
        <form action="view-reservations-final.php" method="post">
		  <input type="submit" value="View All Equipment Reservations">
		</form>
		
		<form action="equipment_final.php" method="post">
		  <input type="submit" value="View Equipment List">
		</form>
      </div>
  </div>



</body>
</html>