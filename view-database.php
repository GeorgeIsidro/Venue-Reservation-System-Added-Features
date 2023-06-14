<!DOCTYPE html>
<html>
<head>
  <title>Reservations</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
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
    
    tr:hover {
      background-color: #f5f5f5;
    }
    
    form {
      margin-top: 20px;
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
    
    .notification {
      display: none;
      padding: 20px;
      background-color: #f44336;
      color: white;
      font-weight: bold;
    }
    
    .success {
      background-color: #4CAF50;
    }
  </style>
</head>
<body>
  <h1>Reservations</h1>

  <?php
  $host = 'localhost';
  $db = 'databasendgm';
  $user = 'root';
  $password = '';

  try {
      $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

      // Fetch all records from the reservations table
      $stmt = $conn->query("SELECT * FROM reservations");
      $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Display the table header
      echo '<table>';
      echo '<tr><th>ID</th><th>Venue Name</th><th>Purpose</th><th>Reservation Date</th><th>Start Time</th><th>End Time</th><th>Grace Period</th><th>Contact Person</th><th>Sector</th><th>Date Reserved</th><th>Action</th></tr>';

      // Display each reservation as a table row
      foreach ($reservations as $reservation) {
          echo '<tr>';
          echo '<td>' . $reservation['id'] . '</td>';
          echo '<td>' . $reservation['venue_name'] . '</td>';
          echo '<td>' . $reservation['purpose'] . '</td>';
          echo '<td>' . $reservation['reservation_date'] . '</td>';
          echo '<td>' . $reservation['start_time'] . '</td>';
          echo '<td>' . $reservation['end_time'] . '</td>';
          echo '<td>' . $reservation['grace_period'] . '</td>';
          echo '<td>' . $reservation['contact_person'] . '</td>';
          echo '<td>' . $reservation['sector'] . '</td>';
          echo '<td>' . $reservation['date_reserved'] . '</td>';
          echo '<td>';
          echo '<form action="cancel_reservation.php" method="post">';
          echo '<input type="hidden" name="reservation_id" value="' . $reservation['id'] . '">';
          echo '<input type="submit" value="Cancel">';
          echo '</form>';
          echo '</td>';
          echo '</tr>';
      }

      echo '</table>';
  } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
  }
  ?>

  <form action="reservation_form.php" method="post">
    <input type="submit" value="Make Another Reservation">
  </form>

  <form action="Act9-1Home.php" method="post">
    <input type="submit" value="Home">
  </form>

</body>
</html>
