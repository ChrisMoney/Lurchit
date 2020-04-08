<?php 
$env = $_GET['ENV'];
require '../api/connect.php';
require '../api/email.php';
require_once '../api/helpers.php';
?>

<!DOCTYPE HTML>


<html>
	<head>

    <script type="text/javascript">
function disable() { 
document.getElementById("save").disabled = true;
document.getElementById("save").style.backgroundColor = 'gray';
document.getElementById('loader').style.display = 'none';
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

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>



		<title>Sign up</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/main.css" />
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	</head>
	<body class="subpage" onload="disable()">

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
			

					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Member Data</h2>
						
						 <form method = "post" action = "" >
                     
                    <h3>First Name: </h3>

                    <input style="max-width:50%" type = "text" name = "firstName" id = "firstName"  />

                    <br/>
                    
                    <h3>Last Name: </h3>

                    <input style="max-width:50%" type = "text" name = "lastName" id = "lastName" />

                    <br/>
                    
                    <h3>Username: </h3>

                    <input style="max-width:50%" type = "text" name = "username" id = "username"  />

                    <br/>

                    <h3>Email: </h3>

                    <input style="max-width:50%" type = "text" name = "email" id = "email"  />

                    <br/>
                    
                    <br/>
                    
                    <h3>Phone: </h3>

                    <input style="max-width:50%" maxLength = "12" type = "text" name = "phone" id = "phone" />

                    <br/>

                    <h3>Password: </h3>

                    <input style="max-width:50%" type = "password" name = "password" id = "password" />

                    <br/>
                   
                     <h3>Member Status</h3>
                   	<select class="form-control" style = "width:25%" name="memberStatus" id="memberStatus">
                   		 <option value="1">Active</option>
       					 <option value="0">Inactive</option>
                	</select>
                	
                	<br/>
                	
                    <h3>Lurch Status</h3>
                   	<select class="form-control" style = "width:25%" name="lurchStatus" id="lurchStatus">
                        <option value="1">Active</option>
       					 <option value="0">Inactive</option>
                	</select>
                    
                     <br/>
                    
                     <h3>Lurch Active</h3>
                   	<select class="form-control" style = "width:25%" name="lurchActive" id="lurchActive">
                        <option value="1">Active</option>
       					 <option value="0">Inactive</option>
                	</select>
                	
                	<br/>
                	
                    <script>
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
					
                    <button type="button" onclick="showPosition();">Get Your Location</button>
                    
                    <br/><br/>
                    <div id="loader"></div>
                    <br/><br/>

                    <input type = "submit" name = "save" id = "save" value = "Save Data" />
                    
              </form>
         
    <div id="result">
        <!--Position information will be inserted here-->

   

           

 
  <?php 
 
 if (isset($_POST['save']) && $_POST['save'] == "Save Data") {
    $lat = $_COOKIE['lat'];
    $long = $_COOKIE['long'];
     $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
     $userName = $_POST['username'];
     $email = $_POST['email'];
     $email = trim($email);
     $phone = $_POST['phone'];
     $phone = phone_number_format($phone);
     $password = $_POST['password'];
     $password = md5($password);
     $memberStatus = $_POST['memberStatus'];
     $lurchStatus = $_POST['lurchStatus'];
     $lurchActive = $_POST['lurchActive'];
    

     $sql = "INSERT INTO Members
            (FirstName,   LastName,  Username,  Email,  Phone, Password, Latitude, Longitude, IsActive, IsLurch, IsLurchActive, SignupDate) Values
            ('$firstName','$lastName','$userName','$email','$phone', '$password','$lat', '$long','$memberStatus','$lurchStatus','$lurchActive', NOW())";
     
     
     if (mysqli_query($conn, $sql)) {
         $lurchID = mysqli_insert_id($conn);
         echo "<script>alert('Member created successfully'); location = '/admin.php?ID=$lurchID&ENV=$env' </script>";

     }
     else {
         echo "<script>alert('Member creation failed!'); </script>";
     }
 }
  
 
 ?>
                  


	</body>
</html>
