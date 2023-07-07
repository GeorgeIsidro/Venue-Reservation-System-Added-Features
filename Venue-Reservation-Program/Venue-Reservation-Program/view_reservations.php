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
  <title>Equipment Reservations</title>
  <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #333333;
      color: #ffffff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #e0e0e0;
      cursor: pointer;
    }

    form {
      text-align: center;
      margin-top: 20px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-family: Arial, sans-serif;
      font-size: 16px;
      border-radius: 4px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
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
