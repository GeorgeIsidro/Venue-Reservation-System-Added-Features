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

// Fetch all reservations from the reservations table
$stmt = $conn->query("SELECT * FROM equipment_reservation");
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Reservations</title>
  <link rel="stylesheet" href="view_reservations.css">
	<link rel="stylesheet" href="transition.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

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
                <li><a href="home-2.php">HOME</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="reservations.php">RESERVE A VENUE</a></li>
				<li><a href="equipment.php">VIEW AVAILABLE EQUIPMENT</a></li>
				<li><a href="reservation_form.php">RESERVE EQUIPMENT</a></li>
            </ul>
        </div>
    <div class="container">
  <div class="container">
    <h2>Equipment Reservations</h2>
    <table>
      <thead>
        <tr>
          <th>Reservation ID</th>
          <th>Equipment Name</th>
          <th>Quantity</th>
          <th>Place</th>
          <th>Date Needed</th>
          <th>Date Reserved</th>
          <th>Contact Person</th>
          <th>Sector</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($reservations as $reservation) : ?>
          <tr>
            <td><?php echo $reservation['reservation_id']; ?></td>
            <td><?php echo $reservation['equipment_name']; ?></td>
            <td><?php echo $reservation['quantity']; ?></td>
            <td><?php echo $reservation['place']; ?></td>
            <td><?php echo $reservation['date_needed']; ?></td>
            <td><?php echo $reservation['date_reserved']; ?></td>
            <td><?php echo $reservation['contact_person']; ?></td>
            <td><?php echo $reservation['sector']; ?></td>
            <td>
              <form method="POST" action="delete_reservation.php">
                <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                <input type="submit" value="Delete">
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <form action="equipment.php" method="post">
      <input type="submit" value="Back">
    </form>
  </div>
</body>
</html>
