

<!DOCTYPE html>
<html>
<head>
  <title>View Reservations</title>
  <link rel="stylesheet" href = "equipment_final.css">
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
          <li class="nav-item">
            <a class="nav-link" href="#">Venues</a>
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
  <!-- Container -->
  <div class="container">
  <?php
    // Establish the database connection
    $host = 'localhost';
    $db = 'databasendgm';
    $user = 'root';
    $password = '';

    try {
      $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Retrieve the equipment data from the database
      // Fetch the equipment name and available quantity from the equipment table

      $stmt = $conn->prepare("SELECT name, available_quantity FROM equipment");
      $stmt->execute();
      $equipment = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    ?>

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Quantity Available</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($equipment as $item) : ?>
          <tr>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['available_quantity']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="button-container">
		<button class = "custom-button" id="view" onclick= "window.location.replace('view-reservations-final.php');" class="reserve-button">View All Equipment Reservations<button>
        <button class = "custom-button" id="reservation" onclick="window.location.replace('reservation_form_final.php');" class="reserve-button">Reserve</button>
        <button class = "custom-button" id="home" onclick="window.location.replace('navbar-practice.html');">Home</button>
    </div>
  </div>



</body>
</html>