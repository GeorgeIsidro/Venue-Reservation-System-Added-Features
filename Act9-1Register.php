<!DOCTYPE html>
	<head>
		<title>Venue Reservation System</title>
		<link rel="stylesheet" href="2homestyle.css">
		<link rel="stylesheet" href="equipment.css">
		<link rel="stylesheet" href="transition.css">
		<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
		<script src="popupscript.js"> </script>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 20px;
			
		}

		.container{
			position: absolute;
			left: 50%;
			top: 65%;
			max-width: 700px;
			height: 500px;
			width: 100%;
			transform: translate(-50%, -50%);
			padding: 25px 30px;
			border-radius: 5px;
			box-shadow: 0 5px 10px rgba(0,0,0,0.15);
			border-radius: 10px;
		}

		h2 {
			font-size: 24px;
			margin-bottom: 10px;
		}

		table {
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		table td {
			padding: 5px;
		}

		input[type="text"],
		input[type="password"] {
			padding: 5px;
			width: 200px;
		}

		.error {
			color: red;
			font-style: italic;
			margin-left: 5px;
		}

		.btn {
			padding: 8px 16px;
			background-color: #337ab7;
			color: white;
			border: none;
			cursor: pointer;
		}

		.btn:hover {
			background-color: #23527c;
		}
	</style>
	</head>
	<body>
		
	
	
	<?php 
		
		//Gets proper input format
		function formatdata($input){
			return htmlspecialchars(stripslashes(trim($input)));
		}
		
		//Connection to SQL
		$sqlconnect = mysqli_connect('localhost','root','');
		if(!$sqlconnect){
			die();
		}
		
		//Database init
		$selectDB = mysqli_select_db($sqlconnect,'Database1');
		if(!$selectDB){
			die("Database not connected." . mysqli_error());
		}
		
		// Get username-pw 
		$records = array(array("user"=> null, "pass"=> null,));	
		$recordsDB = mysqli_query($sqlconnect,"select * from Records");
		$count = 0;
		while($arr = mysqli_fetch_array($recordsDB)){
			$records[$count]["user"] = $arr['UserName'];
			$records[$count]["pass"] = $arr['Password'];
			$count++;
		}
		
		//variable init
		$lastname = $firstname = $email = $username = $password = $confirmpw = "";
		$lastErr = $firstErr = $emailErr = $userErr = $passErr = $confirmpwErr = "";
		//Verifs
		$error = 0;
		$passVer = 0;
		
		//Error check and catch
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			//Input Check
			if(empty($_POST["lastname"])){
				$lastErr = "Please input your Last Name!";
				$error = 1;
			}
			if(empty($_POST["firstname"])){
				$firstErr = "Please input your First Name!";
				$error = 1;
			}
			if(empty($_POST["email"])){
				$emailErr = "Please input your Email!";
				$error = 1;
			}
			if(empty($_POST["username"])){
				$userErr = "Please input your Username!";
				$error = 1;
			} else {
				//Check in db1
				$username = formatdata($_POST["username"]);
				for($idnum = 0; $idnum < $count; $idnum++){
					if($username == $records[$idnum]["user"]){
						$error = 1; //Found
						$userErr = "User already exists!";
						echo "<script>alert('User already exists!')</script>";
						break;
					}
				}
			}
			if(empty($_POST["password"])){
				$passErr = "Please input your Password!";
				$error = 1;
			}
			if(empty($_POST["confirmpw"])){
				$confirmpwErr = "Please input your Password!";
				$error = 1;
			}
			
			//Check if pw's are same
			if(!empty($_POST["password"]) && !empty($_POST["confirmpw"])) {
				if($_POST["password"]!=$_POST["confirmpw"]){
					$passErr = $confirmpwErr = "Password does not match";
					echo "<script>alert('Password does not match!')</script>";
				}
			}
			
			//No error = Add to db1
			if($error != 1) {
				$lastn = $_POST["lastname"];
				$firstn = $_POST["firstname"];
				$usern = $_POST["username"];
				$passw = $_POST["password"];
				$mail = $_POST["email"];
				mysqli_query($sqlconnect, "INSERT INTO RECORDS(LastName,FirstName,UserName,Password,Email)
											values('$lastn','$firstn','$usern','$passw','$mail');");
				$error = 2;
			}
		}
		
		
	?>
	
	
	<!-- Front-end -->
	<div class = "container">
		<h2> REGISTRATIONS </h2>
		Fill out all details below: <br>
		
		<form method = "post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		
			<table>
			<tr>
				<td>Last Name: </td>
				<td><input type="text" name="lastname" autocomplete="off"><span class="error"><?php echo $lastErr;?></span></td>
			</tr>
			<tr>
				<td>First Name: </td>
				<td><input type="text" name="firstname" autocomplete="off"><span class="error"><?php echo $firstErr;?></span></td>
			</tr>
			<tr>
				<td>Email: </td>
				<td><input type="text" name="email" autocomplete="off"><span class="error"><?php echo $emailErr;?></span></td>
			</tr>
			<tr>
				<td>Username: </td>
				<td><input type="text" name="username" autocomplete="off"><span class="error"><?php echo $userErr;?></span></td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input type="password" name="password" autocomplete="off"><span class="error"><?php echo $passErr;?></span></td>
			</tr>
			<tr>
				<td>Confirm Password: </td>
				<td><input type="password" name="confirmpw" autocomplete="off"><span class="error"><?php echo $confirmpwErr;?></span></td>
			</tr>
		</table>
		<input type="submit" value="Register" />
		</form>
			<br>
			<form action="home.php" method="post">
			<input type="submit" value="Back to Home"/>
		</form>
	</div>
	<!-- If right credentials were used, goes to homescreen -->
	<?php
	if ($error == 2){
		header("Location: home.php");
	}
	?>
	</body>
</html>
