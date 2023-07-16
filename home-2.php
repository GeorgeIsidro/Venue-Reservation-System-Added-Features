<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Venue Reservation System</title>
    <link rel="stylesheet" href="2homestyle.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	<link rel="stylesheet" href="transition.css">
	<script src="popupscript.js"> </script>
  
</head>
<body>
    


  <div class="main">
    <div class="navbar">
        <div class="icon">
            <h2 class="logo">Venue Reservation</h2>
        </div>


    
      

    </div> 
    
    <div class="menu">
        <ul>
            <li><a href="home.php">LOGOUT</a></li>
            <li><a href="#">ABOUT</a></li>
            <li><a href="reservations.php">RESERVE VENUE</a></li>
			<li><a href="view-database.php">VIEW VENUE RESERVATIONS</a></li>
            <li><a href="Act9-1Home.php">VENUES</a></li>
			<li><a href="reservation_form.php">RESERVE EQUIPMENT</a></li>
			<li><a href="view_reservations.php">VIEW EQUIPMENT RESERVATION</a></li>
        </ul>
    </div>

        <div class="slider">
            <div class="slides">
              <!--radio buttons start-->
              <input type="radio" name="radio-btn" id="radio1">
              <input type="radio" name="radio-btn" id="radio2">
              <input type="radio" name="radio-btn" id="radio3">
              <input type="radio" name="radio-btn" id="radio4">
              <!--radio buttons end-->
              <!--slide images start-->
              <div class="slide first">
                <img src="Chapel.jpg" alt="">
              </div>
              <div class="slide">
                <img src="de-mazenod.jpg" alt="">
              </div>
              <div class="slide">
                <img src="gym-shs.jpg" alt="">
              </div>
              <div class="slide">
                <img src="room-2.jpg" alt="">
              </div>
              <!--slide images end-->
              <!--automatic navigation start-->
              <div class="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
                <div class="auto-btn4"></div>
              </div>
              <!--automatic navigation end-->
            </div>
            <!--manual navigation start-->
            <div class="navigation-manual">
              <label for="radio1" class="manual-btn"></label>
              <label for="radio2" class="manual-btn"></label>
              <label for="radio3" class="manual-btn"></label>
              <label for="radio4" class="manual-btn"></label>
            </div>
            <!--manual navigation end-->
          </div>
          <!--image slider end-->
      
          <script type="text/javascript">
          var counter = 1;
          setInterval(function(){
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if(counter > 4){
              counter = 1;
            }
          }, 5000);
          </script>
          <div class = "container-box">
            <div class="box-images">
              <div class = "outline-images-1">
                
                
                
                <div class="image-1"> 
                  <img src="Chapel.jpg" class="img-back" > 
                  
                  <img src="Chapel-door.jpg" class="img-front" onclick="openChapel()"> 
                  
                </div>
              
              </div>
              <div class = "outline-images-2">
                <div class = "image-2">
                  <img src="room-2.jpg" class="img-back">
                  <img src="room.jpg" class = "img-front"> 
                </div>
              </div>
              <div class = "outline-images-3">
                <div class = "image-3">
                    <img src="de-mazenod.jpg" class="img-back">
                    <img src="de-mazenod-door.jpg" class="img-front" onclick="openDemazenod()">
                </div>
              </div>
              <div class = "outline-images-4">
                <div class = "image-4">
                  <img src="gym-shs.jpg" class="img-back">
                  <img src="gym-shs-2.jpg" class="img-front"> 
                </div>
              </div>
              <div class = "outline-images-5">
                <div class = "image-5">
                    <img src = "ndcpa.jpg" class = "img-back"> 
                    <img src="ndcpa-door.jpg" class = "img-front">
                    
                </div>
               
                
              </div>
              <div class = "outline-images-6">
                <div class = "image-6"></div>
                <img src="dance-studio.jpg" alt="" style="width: 285px;
                  height: 365px;
                  border-radius: 10px;"> 
              </div>  
              <div class = "outline-images-7">
                <div class = "image-7">
                  <img src="kitchen.jpg" class="img-back">
                  <img src="kitchen-2.jpg" class = "img-front">
                </div> 
              </div>  
              <div class = "outline-images-8">
                <div class = "image-8">
                  <img src="dentist.jpg" class = "img-back">
                  <img src="dentist-door.jpg" class="img-front"> 
                </div>
              </div>  
              </div>
            </div>
          </div>
        </div> 

        

        </div>
        
        <div id = "overlay-chapel" class="overlay-chapel">
          <div class = "popup-container-chapel">
            <div class = "header-chapel">
                <div class="title">Chapel</div>
                <button class="close-button-demazenod" onclick="closeChapel()">&times;</button>
            </div>
              <div class = "body-chapel"> Images:
                <div class = "image-border"> 
                  <div class = "images-1"> 
                    <img src="Chapel.jpg" alt="photo"  
                    style="width: 150px; height: 200px; object-fit: contain;
                    overflow: hidden;
                    border-radius: 10px;
                    position: absolute;
                    top: 285px;">
                  </div>

                </div>
                <div class = "text-chapel">
                 Sample Text <br> Sample Text
                </div>
                <button class = "reserve-button"> Reserve </button>
              

                <div class = "photo-2">
                  <img src="Chapel-door.jpg" alt="photo" 
                  style="width: 150px; height: 200px; object-fit: contain;
                  position: absolute;
                  left: 860px;
                  border-radius: 10px;
                  top: 285px;"
                  />
                </div>
              
                <div class = "photo-3">
                  <img src="chapel-4.jpg" alt="photo" 
                  style="width: 150px; height: 200px; object-fit: contain;
                  position: absolute;
                  left: 1015px;
                  border-radius: 10px;
                  top: 285px;"
                 
                  />
                </div>
              </div>

            </div>
        </div>

        <!-- POP UP FOR DE MAZENOD-->

        <div id = "overlay-demazenod" class="overlay-demazenod">
          <div class = "popup-demazenod">
            <div class = "header-demazenod">
                <div class="title">De-Mazenod Function Hall</div>
                <button class="close-button-demazenod" onclick="closeDemazenod()">&times;</button>
            </div>
              <div class = "body-demazenod"> Images:
                <div class = "image-border"> 
                  <div class = "images-1"> 
                    <img src="de-mazenod-2.jpg" alt="photo"  
                    style="width: 150px; height: 200px; object-fit: contain;
                    overflow: hidden;
                    border-radius: 10px;
                    position: absolute;
                    top: 285px;">
                  </div>

                </div>
                <div class = "text-demazenod">
                 Sample Text <br> Sample Text
                </div>
                <button class = "reserve-button"> Reserve </button>
              

                <div class = "photo-2">
                  <img src="de-mazenod.jpg" alt="photo" 
                  style="width: 150px; height: 200px; object-fit: contain;
                  position: absolute;
                  left: 860px;
                  border-radius: 10px;
                  top: 285px;"
                  />
                </div>
              
                <div class = "photo-3">
                  <img src="de-mazenod-door.jpg" alt="photo" 
                  style="width: 150px; height: 200px; object-fit: contain;
                  position: absolute;
                  left: 1015px;
                  border-radius: 10px;
                  top: 285px;"
                  />
                </div>
              </div>

            </div>
        </div>

        
        <!--
                </div>
				<div id="overlay" class="overlay">
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
				
				
                    </div>
                </div>
				
        </div>
    </div>
    -->
    


    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
	
</body>
</html>