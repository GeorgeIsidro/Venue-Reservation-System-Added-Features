<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <style>
		body {
			background: #0F5401;
			font-family: Agency FB, sans-serif;
			
		}

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
        }

        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #dddddd;
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

		.menu-bar {
			display: flex;
			justify-content: center;
			margin-top: 20px;
		}

		.menu-bar a {
			padding: 10px 15px; /* Adjusted padding */
			background-color: #45B39D;
			color: #ffffff;
			text-decoration: none;
			margin: 0 5px; /* Adjusted margin */
			transition: background-color 0.3s ease;
			font-family: Arial, sans-serif;
			font-size: 16px;
			border-radius: 4px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		}

		.menu-bar a:hover {
			background-color: #138D75;
		}

    </style>
</head>
<body>
<div class="container">
    <h2>List of Available Venues</h2>

    <?php
    // Database connection
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'database1';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Failed to connect to the database: " . mysqli_connect_error());
    }

    // Retrieve data from a specific table
    $table = 'venues'; // Replace 'your_table' with the actual table name

    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Failed to fetch data from the database: " . mysqli_error($conn));
    }

    // Create array for values to be read from DB1
    $results = array();

    while ($row = mysqli_fetch_array($result)) {
        $results[] = array(
            "name" => $row['Name'],
            "capacity" => $row['Capacity']
        );
    }

    echo "<table>";
    echo "<tr>";
    echo "<th>Venue Name</th>";
    echo "<th>Capacity</th>";
    echo "</tr>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["capacity"] . "</td>";
        echo "</tr>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="menu-bar">
        <a href="home-2.php">Home</a>
        <a href="reservations.php">Make a Reservation</a>
        <a href="equipment.php">Reserve Equipment</a>
		<a href ="view-database.php"> View Venue Reservations</a>
		<a href="view_reservations.php">View Equipment Reservations</a>
    </div>
</div>

<script>
    const venueNameCells = document.querySelectorAll('.venue-name');
    const venueCapacityCells = document.querySelectorAll('.venue-capacity');

    // Array of image URLs corresponding to the venues (you can modify this as per your image URLs)
    const venueImages = [
        "Main_Gym.jpg",
        "Badminton.jpg",
        "Lounge.jpg"
    ];

    // Add click event listeners to each venue name cell
    venueNameCells.forEach((cell, index) => {
        cell.addEventListener('click', () => {
            const venueName = cell.innerText;
            const venueCapacity = venueCapacityCells[index].innerText;
            const imageUrl = venueImages[index];

            // Create and show the venue details with the image
            showVenueDetails(venueName, venueCapacity, imageUrl);
        });
    });

    // Function to display the venue details with the image
    function showVenueDetails(venueName, venueCapacity, imageUrl) {
        // Create a modal or display the details in a different way (e.g., a popup)
        // Here, we are just using the console to log the details
        console.log("Venue Name:", venueName);
        console.log("Capacity:", venueCapacity);
        console.log("Image URL:", imageUrl);
    }
</script>
</body>
</html>
