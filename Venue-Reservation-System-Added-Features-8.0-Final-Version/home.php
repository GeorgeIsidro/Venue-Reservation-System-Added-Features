<!DOCTYPE html>
<html lang="en">
<head>
    <title>Venue Reservation System</title>
    <link rel="stylesheet" href="homestyle.css">
	<link rel="stylesheet" href="transition.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	<script src="popupscript.js"> </script>
	<style>
		.notification {
			background-color: #f44336;
			color: #ffffff;
			text-align: center;
			padding: 10px;
			margin-bottom: 10px;
			border-radius: 4px;
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
		$records = array( array("user"=> null, "pass"=> null,));	
		$recordsDB = mysqli_query($sqlconnect,"select * from Records");
		$count = 0;
		while($arr = mysqli_fetch_array($recordsDB)){
			$records[$count]["user"] = $arr['UserName'];
			$records[$count]["pass"] = $arr['Password'];
			$count++;
		}
		
		//Initializing Variables
		$username = $password = "";
		$userErr = $passErr = "";
		//Verifs
		$userVer = 0;
		$passVer = 0;
		$idNum = 0;
		
		//Error check and catch
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			//UserName Check
			if(empty($_POST["username"])){
				$userErr = "";
				echo '<div class="notification">Please input your username.</div>';

			} else {
				//Check if username is in DB1
				$username = formatdata($_POST["username"]);
				for($idNum; $idNum < $count; $idNum++){
					if($username == $records[$idNum]["user"]){
						$userVer = 1; //Found in Database
						break;
					}
				}
			}
			
			//Error message for UserName not found.
			if($userVer == 0 && !empty($_POST["username"])){
				$userErr = "";
				echo '<div class="notification">Username does not exist!</div>';


			}
			
			//PW check
			if(empty($_POST["password"])){
				$passErr = "";
				echo '<div class="notification">Username does not exist!</div>';

			} else {
				$password = formatdata($_POST["password"]);
				if($userVer == 1){
					//If Found
					if($password == $records[$idNum]["pass"]){
						$passVer = 1;
					} else {
						$passErr = "";
						echo '<div class="notification">Password does not match!.</div>';

					}
				}
			}
		}
		
	?>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <img src = "icon-reservation.png" class = "picture-icon">
            </div>
            <div class="navbar-text">
                <h2 class="logo">Venue Reservation</h2>
            </div>
        </div> 
        
        <div class="menu">
            <ul>
                <li><a href="home.php">HOME</a></li>
                <li><a href="Act9-1Register.php">REGISTER</a></li>
            </ul>
        </div>
        <div class="content">
            <h1>Venue <br><span> Reservation </span> <br> System</h1>
            <p class="par"> <br>The NDGM Venue Reservation System is a user-friendly, web-based platform that <br> 
			streamlines the process of reserving and managing school facilities for academic and<br>extracurricular activities. 
			Developed with the unique needs of educational institutions in <br> mind this system provides a seamless experience for students, faculty, staff, and,
			 <br> administrators, ensuring efficient and organized facility usage.</p>

            <div class="form">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <h2>Login Here</h2>
                    <input type="text" name="username" class="input-field" placeholder="Username">
					<span class="error"><?php echo $userErr;?></span>
                    <input type="password" name="password" class="input-field" placeholder="Password">
					<span class="error"><?php echo $passErr;?></span>
                    <button class="btnn" type="submit">Login</button>
                    <p class="link">Don't have an account<br>
                    <a href="Act9-1Register.php">Sign up here</a></p>
				</form>
            </div>
        </div>
    </div>

	<?php
		// PHP code here
		if($userVer == 1 && $passVer == 1){
			header("Location: navbar-practice.html");
		}
	?>

    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
	
</body>
</html>
