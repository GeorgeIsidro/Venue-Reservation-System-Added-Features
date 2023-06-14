<?php
// Check if the equipment name is provided in the query parameter
if (isset($_GET['equipment'])) {
  $equipmentName = $_GET['equipment'];

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
      $dateReserved = $_POST['date_reserved'];
      $contactPerson = $_POST['contact_person'];
      $sector = $_POST['sector'];

      // Check if the requested quantity is available
      if ($quantity <= $availableQuantity) {
        // Deduct the reserved quantity from the available quantity in the equipment table
        $updatedQuantity = $availableQuantity - $quantity;
        $stmt = $conn->prepare("UPDATE equipment SET available_quantity = ? WHERE name = ?");
        $stmt->execute([$updatedQuantity, $equipmentName]);

        // Insert the reservation details into the reservations table
        $stmt = $conn->prepare("INSERT INTO equipment_reservation (equipment_name, quantity, place, date_needed, date_reserved, contact_person, sector) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$equipmentName, $quantity, $place, $dateNeeded, $dateReserved, $contactPerson, $sector]);

        // Redirect back to equipment.php after successful reservation
        header("Location: equipment.php");
        exit;
      } else {
        echo "Insufficient quantity available. Please choose a lower quantity.";
      }
    }
  } else {
    echo "Invalid equipment name.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Equipment Reservation</title>
  <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
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
    input[type="number"],
    input[type="date"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-family: Arial, sans-serif;
      font-size: 14px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4caf50;
      color: #ffffff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-family: Arial, sans-serif;
      font-size: 14px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .view-reservations {
      text-align: center;
      margin-top: 20px;
    }

    .view-reservations a {
      color: #0000ff;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Equipment Reservation</h2>
    <form method="POST" action="">
      <label for="equipment_name">Equipment Name:</label>
      <select id="equipment_name" name="equipment_name">
        <!-- Populate the dropdown menu options dynamically from the equipment table -->
        <option value="Equipment A">Fender</option>
        <option value="Equipment B">Podium</option>
        <option value="Equipment C">Round Table</option>
        <option value="Equipment D">Long Rectangular Table</option>
        <option value="Equipment E">Monoblock Chairs</option>
        <option value="Equipment F">Wireless Microphone</option>
        <option value="Equipment G">Wired Microphone</option>
        <option value="Equipment H">Gooseneck Microphone</option>
        <option value="Equipment I">Circular Platform</option>
        <option value="Equipment J">Square Platform</option>
        <option value="Equipment K">Red Carpet</option>
        <option value="Equipment L">LED Lights</option>
        <option value="Equipment M">RGB Lights</option>
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

      <label for="date_reserved">Date Reserved:</label>
      <input type="date" id="date_reserved" name="date_reserved" required>
      <br>

      <label for="contact_person">Contact Person:</label>
      <input type="text" id="contact_person" name="contact_person" required>
      <br>

      <label for="sector">Sector:</label>
      <input type="text" id="sector" name="sector" required>
      <br>

      <input type="submit" value="Reserve">
    </form>

    <div class="view-reservations">
      <!-- Add a button for viewing all equipment reservations -->
      <a href="view_reservations.php">View Equipment Reservations</a>
    </div>
  </div>
</body>
</html>
