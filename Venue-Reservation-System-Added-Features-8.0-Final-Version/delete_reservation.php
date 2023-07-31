<!DOCTYPE html>
<html>
<head>
  <title>Equipment Reservations</title>
</head>
<body>
<?php
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

// Check if the reservation ID is provided in the POST data
if (isset($_POST['reservation_id'])) {
  $reservationId = $_POST['reservation_id'];

  // Fetch the reserved equipment name and quantity from the reservations table based on the reservation ID
  $stmt = $conn->prepare("SELECT equipment_name, quantity FROM equipment_reservation WHERE reservation_id = :reservationId");
  $stmt->bindParam(':reservationId', $reservationId);
  $stmt->execute();
  $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

  // Retrieve the total quantity of the reserved equipment from all reservations in the equipment_reservation table
  $stmt = $conn->prepare("SELECT SUM(quantity) AS total_reserved_quantity FROM equipment_reservation WHERE equipment_name = :equipmentName");
  $stmt->bindParam(':equipmentName', $reservation['equipment_name']);
  $stmt->execute();
  $totalReservedQuantity = (int)$stmt->fetchColumn();

  // Retrieve the available quantity of the reserved equipment from the equipment table
  $stmt = $conn->prepare("SELECT available_quantity FROM equipment WHERE name = :equipmentName");
  $stmt->bindParam(':equipmentName', $reservation['equipment_name']);
  $stmt->execute();
  $equipment = $stmt->fetch(PDO::FETCH_ASSOC);

  // Calculate the new available quantity by subtracting the total reserved quantity
  $newAvailableQuantity = $equipment['available_quantity'] + $totalReservedQuantity;
  $stmt = $conn->prepare("UPDATE equipment SET available_quantity = :availableQuantity WHERE name = :equipmentName");
  $stmt->bindParam(':availableQuantity', $newAvailableQuantity);
  $stmt->bindParam(':equipmentName', $reservation['equipment_name']);
  $stmt->execute();

  // Delete the reservation from the reservations table
  $stmt = $conn->prepare("DELETE FROM equipment_reservation WHERE reservation_id = :reservationId");
  $stmt->bindParam(':reservationId', $reservationId);
  $stmt->execute();

  // Redirect back to the view_reservations page
  header("Location: view-reservations-final.php");
  exit;
} else {
  // If the reservation ID is not provided, redirect back to the view_reservations page
  header("Location: view-reservations-final.php");
  exit;
}
?>

</body>
</html>