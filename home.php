<!DOCTYPE html>
<html lang="en">
<head>
    <title>Venue Reservation System</title>
    <link rel="stylesheet" href="homestyle.css">
	<link rel="stylesheet" href="transition.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	<script src="popupscript.js"> </script>
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
		if($_SERVER["REQUEST_METHOD"]=="POST"){
			//UserName Check
			if(empty($_POST["username"])){
				$userErr = "Please input a Username!";
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
				$userErr = "Username does not exist!";
			}
			
			//PW check
			if(empty($_POST["password"])){
				$passErr = "Please input a Password!";
			} else {
				$password = formatdata($_POST["password"]);
				if($userVer == 1){
					//If Found
					if($password == $records[$idNum]["pass"]){
						$passVer = 1;
					} else {
						$passErr = "Password does not match!";
						echo "<script>alert('Password does not match!')</script>";
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
            <div class = navbar-text>
                <h2 class="logo">Venue Reservation</h2>
            </div>


        
				  

        </div> 
        
        <div class="menu">
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="Act9-1Register.php">REGISTER</a></li>
            </ul>
        </div>
        <div class="content">
            <h1>Venue <br><span> Reservation </span> <br> System</h1>
            <p class="par"> <br>The Venue Reservation System is an efficient and user-friendly online platform designed to <br> simplify 
			and streamline the process of reserving and managing venues for various events.<br> Whether you're 
			organizing a corporate conference, wedding reception, concert, or any other <br> gathering, this system 
			provides a comprehensive solution to meet your venue needs.</p>

               

                <div class="form">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <h2>Login Here</h2>
                    <input type="text" name="username" class="input-field"><span class="error"><?php echo $userErr;?></span>
                    <input type="password" name="password" class="input-field"><span class="error"><?php echo $passErr;?></span>
                    <button class="btnn" onclick="ERROR()"><a href="home-2.php">Login</a></button>
					
                    

                    <p class="link">Don't have an account<br>
                    <a href = "Act9-1Register.php">Sign up here </a>
				</form>
                </div>
				<!--<div id="overlay" class="overlay">
                    <div class="popup-container">
                      
                      <form> 
                        <h6>Registration Form</h6>
                        <input name="FirstName" type="text" value="First Name" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
                        <input name="LastName" type="text" value="Last Name" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
                        <input name="Email" type="Email" value="Email" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
                        <input name="Password" type="text" value="Enter Password" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
                        <input name="Password2" type="text" value="Re-Enter Password" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
                        
                        <input type="submit" value="Register">
                      </form>
                      <button onclick="closeForm()">Close</button>
                    </div>
                </div>
				

                <div class = "institution-images">
                    <img src = "dlsu-logo.png" style="width: 200px; height: 200px;">
                    <img src = "notre-dame.png" style="width: 200px; height: 200px;">
                </div>


				
                    </div>
                </div>
				-->
        </div>
    </div>
	<?php
		// PHP code here
		if($userVer == 1 && $passVer == 1){
			header("Location: home-2.php");
		}
	?>

    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
	
</body>
</html>






<input type="text" name="username" class="input-field"><span class="error"><?php echo $userErr;?></span>