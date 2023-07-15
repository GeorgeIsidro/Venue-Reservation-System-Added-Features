<!DOCTYPE html>
<html>
<head>
    <title>Print Reservations for Month</title>
</head>
<body>
    <h1>Print Reservations for Month</h1>
    <form action="generate-reservations-file-month.php" method="post">
        <label for="month">Select Month:</label>
        <select name="month" id="month" required>
            <option value="">Select a month</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
			<option value="04">April</option>
			<option value="05">May</option>
			<option value="06">June</option>
			<option value="07">July</option>
			<option value="08">August</option>
			<option value="09">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
            <!-- Add more options for the remaining months -->
        </select>
        <br><br>
        <input type="submit" value="Print Reservations">
    </form>
	<br><br>
	<button onclick="window.open('view-database.php')">Back</button>
	<button onclick="window.open('home-2.php')">Home</button>
	<button onclick="window.open('reservations.php')">Reserve Venue</button>
</body>
</html>
