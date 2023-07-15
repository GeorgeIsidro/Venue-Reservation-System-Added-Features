<!DOCTYPE html>
<html>
<head>
    <title>Print Reservations per Venue</title>
</head>
<body>
    <h1>Print Reservations per Venue</h1>
    <form action="generate-reservations-file.php" method="post">
        <label for="venue">Select Venue:</label>
        <select name="venue" id="venue" required>
            <option value="">Select a venue</option>
			<option value="Gym">Gym</option>
			<option value="NDCPA">NDCPA</option>
			<option value="Barangay Court">Barangay Court</option>
			<option value="SHS Covered Court">SHS Covered Court</option>
			<option value="Dining Hall">Dining Hall</option>
			<option value="DM Function Hall">DM Function Hall</option>
			<option value="Dance Studio">Dance Studio</option>
			<option value="ES Basketball Court">ES Basketball Court</option>
			<option value="Badminton Court">Badminton Court</option>	
			<option value="TLE Laboratory">TLE Laboratory</option>
			<option value="Chapel">Chapel</option>
			<option value="Business Office Lobby">Business Office Lobby</option>
			<option value="ES Flagpole Area">ES Flagpole Area</option>
			<option value="Student's Lounge">Student's Lounge</option>
			<option value="Cookery">Cookery</option>
			<option value="Jose Ante Lounge">Jose Ante Lounge</option>
			<option value="Kinder Playground">Kinder Playground</option>
            <!-- Add more options for other venues -->
        </select>
        <br><br>
        <input type="submit" value="Print Reservations">
    </form>
</body>
</html>