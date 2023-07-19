<!DOCTYPE html>
<html>
<head>
  <title>Equipment Reservation</title>
  <title>Venue Reservation System</title>
  <style>
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
  <link rel="stylesheet" href="equipment.css">
	<link rel="stylesheet" href="transition.css">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	<script src="equipment.js"> </script>


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
                <li><a href="Act9-1Register.php">REGISTER</a></li>
                <li><a href="Act9-1Home.php">VENUES</a></li>
            </ul>
        </div>
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
		<button class = "custom-button" id="view" onclick= "window.location.replace('view_reservations.php');" class="reserve-button">View All Equipment Reservations<button>
        <button class = "custom-button" id="reservation" onclick="window.location.replace('reservation_form.php');" class="reserve-button">Reserve</button>
        <button class = "custom-button" id="home" onclick="window.location.replace('home-2.php');">Home</button>
    </div>
  </div>
  </div>
</body>
</html>
