<?php 
session_start();

$env = $_GET['ENV'];
require '../api/connect.php';
require '../api/email.php';
require_once '../api/helpers.php';

$lurchID = $_GET['ID'];
$v = $_SESSION['V'];

if ((isset($_POST['login']) && $_POST['login'] == "Login") Or ($v == 'true')) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);


        $sql = "SELECT FirstName, LastName, Email, Phone,
            IsActive, IsLurch, IsLurchActive, Service, Blurb, Description, MinPrice FROM Members WHERE (Email = '$email' And Password = '$password') Or (ID = $lurchID) ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if (mysqli_num_rows($result) > 0) {

            $firstName = $row['FirstName'];
            $lastName = $row['LastName'];
            $email = $row['Email'];
            $phone = $row['Phone'];
            $memberStatus = $row['IsActive'];
            $lurchStatus = $row['IsLurch'];
            $lurchActive = $row['IsLurchActive'];
            $service = $row['Service'];
            $blurb = $row['Blurb'];
            $description = $row['Description'];
            $description = stripcslashes($description);
            $minPrice = $row['MinPrice'];
            $validated = 'true';
            $_SESSION['V'] = 'true';

            }
    }


  $v = $_SESSION['V'];

if (isset($v) && !empty($v)) {
    if ($v == 'true') {
        $validated = 'true';
    }
    else { $validated = 'false';}
}
else {
    $validated = 'false';
} 

?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Lurchit - Admin</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/main.css" />
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

       

      

        <script>
            function goBack() {
                myWindow.close(); 
            }
        </script>

<style>

#loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Loader spin action for Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 25%%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>

        <script type="text/javascript">
            function authenticate() { 
                
            // Get the modal
            var validated = "<?php echo $validated ?>";
           // alert(validated);
            var modal = document.getElementById('id01');

            if (validated == 'false') {
                modal.style.display = 'block';
            }
            else {
                modal.style.display = 'none';
            }
                
                document.getElementById("save").disabled = true;
                document.getElementById("save").style.backgroundColor = 'gray';
                document.getElementById('loader').style.display = 'none';
                       
        }
        </script>

      <script type="text/javascript">
              function showPosition() {
                  if(navigator.geolocation) {
                      document.getElementById('loader').style.display = 'block';
                      navigator.geolocation.getCurrentPosition(function(position) {
                      document.cookie = "lat="+ position.coords.latitude;
                      document.cookie = "long="+ position.coords.longitude;
                      var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                      document.getElementById("save").disabled = false;
                      document.getElementById("save").style.backgroundColor = 'red';
                      document.getElementById('loader').style.display = 'none';

                  });
              } else {
                  alert("Sorry, your browser does not support HTML5 geolocation.");
              }
          }
                </script>
					
	</head>

	<body class="subpage" onload="authenticate()">


<div id="id01" class="modal">
  
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="https://apilurchit.com/logo.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <input type="text" placeholder="Enter Email" name="email" id="email" required>

      <input type="password" placeholder="Enter Password" name="password" id="password" required>
        
      <input style="padding-left:10px;padding-right:10px;background:green;" type="submit" id="login" name="login" value = "Login" />
    </div>

    <div class="container" style="background-color:#f1f1f1">

      <input style="padding-left:10px;padding-right:10px;padding-bottom:10px;background:red;" type="button" 
      onclick="document.getElementById('id01').style.display='none'" onclick="goBack()" value="Cancel" />

      <span class="psw">Forgot <a href="https://accounts.apilurchit.com/password-reset.php">password?</a></span>

      <br/><br/>
      <span><a href="https://twitter.com/lurch_it" target="_blank">Need Help? Contact Us on Twitter <img src="https://apilurchit.com/twitter-logo.png" height="50" width="50"/></a>
    </div>
  </form>
</div>


		<!-- Header -->
			<header id="header">
				<a href="index.php" class="logo">Lurchit</a>
			</header>

		<!-- Menu -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">Member Manager</a></li>
				</ul>
			</nav>
			
            <?php 
              //Detect special conditions devices
                $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
                $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
                $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
                $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

                if( $iPod || $iPhone || $iPad || $Android){ 
    
            ?>
            <table>
                <tr>
                    <td>
                   
                    <?php if( $iPod || $iPhone || $iPad){ ?>
                         <a href="https://apps.apple.com/us/app/lurchit/id1462289389?ls=1">
                        <img src="https://apilurchit.com/appstore-badge.png" height="50" width="120">
                        </a>
                    <?php } elseif ($Android) { ?>
                       <!-- <a href="https://apps.apple.com/us/app/lurchit/id1462289389?ls=1">
                        <img src="https://apilurchit.com/appstore-badge.png" height="50" width="120">
                        </a>-->
                    <?php } } ?>
                    
                    </td>
                </tr>
            </table>

                <hr/>


					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Member Data</h2>
						
						 <form method = "post" action = "" >
                     
                    <h3>First Name: </h3>

                    <input style="max-width:50%" type = "text" name = "firstName" id = "firstName" value = "<?php echo $firstName ?>" />

                    <br/>
                    
                    <h3>Last Name: </h3>

                    <input style="max-width:50%" type = "text" name = "lastName" id = "lastName"  value = "<?php echo $lastName ?>" />

                    <br/>
                    
                    <h3>Email: </h3>

                    <input style="max-width:50%" type = "text" name = "email" id = "email" value = "<?php echo $email ?>" />

                    <br/>
                    
                    <br/>
                    
                    <h3>Phone: </h3>

                    <input style="max-width:50%" maxLength = "12" type = "text" name = "phone" id = "phone" value = "<?php echo $phone ?>" />

                    <br/>

                    <?php if ($lurchStatus == 1) { ?>
                        <h3>Service</h3>
                    <select class="form-control" style="max-width:50%" name="service" id="service">
                   		 <option value="Animal Care Specialist" <?php if($service=='Animal Care Specialist') echo 'selected'; ?>>Animal Care Specialist</option>
       					 <option value="Automotive Specialist" <?php if($service=='Automotive Specialist') echo 'selected'; ?>>Automative Specialist</option>
                         <option value="Barber" <?php if($service=='Barber') echo 'selected'; ?>>Barber</option>
                         <option value="Business Services" <?php if($service =='Business Services') echo 'selected'; ?>>Business Services</option>
                         <option value="Chef" <?php if($service==='Chef') echo 'selected'; ?>>Chef</option>
                         <option value="Childcare Specialist" <?php if($service=='Childcare Specialist') echo 'selected'; ?>>Childcare Specialist</option>
                         <option value="Computer & App Specialist" <?php if($service=='Computer & App Specialist') echo 'selected'; ?>>Computer & App Specialist</option>
                         <option value="Cosmetologist" <?php if($service=='Cosmetologist') echo 'selected'; ?>>Cosmetologist</option>
                         <option value="Delivery Specialist" <?php if($service==='Delivery Specialist') echo 'selected'; ?>>Delivery Specialist</option>
                         <option value="Entertainer" <?php if($service==='Entertainer') echo 'selected'; ?>>Entertainer</option>
                         <option value="Fashion & Design Specialist" <?php if($service=='Fashion & Design Specialist') echo 'selected'; ?>>Fashion & Design Specialist</option>
                         <option value="Financial Advisor" <?php if($service==='Financial Advisor') echo 'selected'; ?>>Financial Advisor</option>
                         <option value="Handyman" <?php if($service=='Handyman') echo 'selected'; ?>>Handyman</option>
                         <option value="Hospice Aide" <?php if($service=='Hospice Aide') echo 'selected'; ?>>Hospice Aide</option>
                         <option value="Insurance Agent" <?php if($service=='Insurance Agent') echo 'selected'; ?>>Insurance Agent</option>
                         <option value="Interior Design" <?php if($service=='Interior Design') echo 'selected'; ?>>Interior Design</option>
                         <option value="Landscaper" <?php if($service=='Landscaper') echo 'selected'; ?>>Landscaper</option>
                         <option value="Maid" <?php if($service=='Maid') echo 'selected'; ?>>Maid</option>
                         <option value="Masseuse" <?php if($service=='Masseuse') echo 'selected'; ?>>Masseuse</option>
                         <option value="Media & Production Specialist" <?php if($service=='Media & Production Specialist') echo 'selected'; ?>>Media & Production Specialist</option>
                         <option value="Occupational Specialist" <?php if($service=='Occupational Specialist') echo 'selected'; ?>>Occupational Specialist</option>
                         <option value="Personal Trainer" <?php if($service=='Personal Trainer') echo 'selected'; ?>>Personal Trainer</option>
                         <option value="Real Estate Specialist" <?php if($description=='Real Estate Specialist') echo 'selected'; ?>>Real Estate Specialist</option>
                         <option value="Therapist" <?php if($service=='Therapist') echo 'selected'; ?>>Therapist</option>
                         <option value="Tutor & Training Specialist" <?php if($service=='Tutor & Training Specialist') echo 'selected'; ?>>Tutor & Training Specialist</option>
                	</select>

                    <br/>

                    <h3>Service Summary (Blurb): </h3>

                    <input style="max-width:50%" type = "text" name = "blurb" id = "blurb" maxlength="40" value = "<?php echo $blurb ?>" />

                    <br/>

                    <h3>Full Service Description: </h3>

                    <textarea style="max-width:50%" type = "text" name = "description" id = "description"><?php echo $description ?></textarea>

                    <br/>

                    <h3>Min Price: </h3>

                    <input style="max-width:50%" maxLength = "12" type = "number" name = "minPrice" id = "minPrice" value = "<?php echo $minPrice ?>" />

                    <br/>
                                        
                    <?php } ?>
                   
                     <h3>Member Status</h3>
                   	<select class="form-control" style = "width:25%" name="memberStatus" id="memberStatus">
                   		 <option value="1" <?php if($memberStatus=='1') echo 'selected'; ?>>Active</option>
       					 <option value="0" <?php if($memberStatus=='0') echo 'selected'; ?>>Inactive</option>
                	</select>
                	
                	<br/>
                	
                    <h3>Lurch Status</h3>
                   	<select class="form-control" style = "width:25%" name="lurchStatus" id="lurchStatus">
                        <option value="1" <?php if($lurchStatus=='1') echo 'selected';?>>Active</option>
       					 <option value="0" <?php if($lurchStatus=='0') echo 'selected';?>>Inactive</option>
                	</select>
                    
                     <br/>
                    
                     <h3>Lurch Active</h3>
                   	<select class="form-control" style = "width:25%" name="lurchActive" id="lurchActive">
                        <option value="1" <?php if($lurchActive=='1') echo 'selected';?>>Active</option>
       					 <option value="0" <?php if($lurchActive=='0') echo 'selected';?>>Inactive</option>
                	</select>
                	
                	<br/>
                	
                    
                    <hr/>

                    <button type="button" onclick="showPosition();" style="padding-left:10px;padding-right:10px;width:40%">Get Your Location</button>
                    
                    <br/>
                    <div id="loader"></div>
                    <br/>
					
                    <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "save" id = "save" value = "Save Data" />
                    
              </form>
              
              </div>

 
  <?php 
 unset($_SESSION['V']);

 if (isset($_POST['save']) && $_POST['save'] == "Save Data") {
    
    // Update lurch info first if member is a lurch

        $service = $_POST['service'];
        $blurb = $_POST['blurb'];
        $description = $_POST['description'];
    
         $sql1 = "Update Members Set Service = '$service', Blurb = '$blurb', Description = '$description' WHERE ID = $lurchID ";
         if (!mysqli_query($conn, $sql1)) {
            echo "<script>alert('".mysqli_error($conn)."');</script>";
         }
            
          
         $lat = $_COOKIE['lat'];
         $long = $_COOKIE['long'];
     $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
     
     $email = $_POST['email'];
     $email = trim($email);
     $phone = $_POST['phone'];
     $phone = phone_number_format($phone);
     $memberStatus = $_POST['memberStatus'];
     $lurchStatus = $_POST['lurchStatus'];
     $lurchActive = $_POST['lurchActive'];
     
     $sql = "Update Members Set 
            FirstName = '$firstName',
            LastName = '$lastName',
            Email = '$email', 
            Phone = '$phone',
            Latitude = '$lat',
            Longitude = '$long',
            IsActive = '$memberStatus',
            IsLurch = '$lurchStatus',
            IsLurchActive = '$lurchActive'
            WHERE ID = $lurchID ";
     
            $_SESSION['V'] = 'true';

     if (mysqli_query($conn, $sql)) { 
         echo "<script>alert('Member data updated successfully'); location = '/admin.php?ID=$lurchID&ENV=$env' </script>";
     }
     else {
         echo "<script>alert('Member update failed!'); location = '/admin.php?ID=$lurchID&ENV=$env' </script>";
     }
 }

 ?>
                  


	</body>
</html>

