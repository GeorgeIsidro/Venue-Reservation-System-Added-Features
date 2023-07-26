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
  <link rel="stylesheet" href = "view-reservations-final.css">
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
        <img src="icon-reservation.png" width="30" height="30" alt="">
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
            <a class = "nav-link" href="reservation_form_final.php"> Reserve Equipment</a>
          </li>
          <li class = "nav-item">
            <a class = "nav-link" href="view-database-final.php"> View Reserve Database</a>
          </li>
        </ul>
      </div>
  </nav>
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
    <form action="equipment_final.php" method="post">
      <input type="submit" value="Back">
    </form>
  </div>
</body>
</html>