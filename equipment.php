<!DOCTYPE html>
<html>
<head>
  <title>Equipment Reservation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
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
      background-color: #f8f8f8;
      font-weight: bold;
    }
    
    tbody tr:hover {
      background-color: #f5f5f5;
    }
    
    a {
      display: inline-block;
      padding: 8px 12px;
      background-color: #4CAF50;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
    }
    
    a:hover {
      background-color: #45a049;
    }
    
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Equipment Reservation</h1>

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
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($equipment as $item) : ?>
          <tr>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['available_quantity']; ?></td>
            <td><a href="reservation_form.php?equipment=<?php echo urlencode($item['name']); ?>">Reserve</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="view_reservations.php">View All Equipment Reservations</a>
	<a href="Act9-1Home.php">Home</a>
  </div>
</body>
</html>
