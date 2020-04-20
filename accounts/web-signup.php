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
						<h2 id="content">Provider Signup</h2>

                        <div class="alert alert-warning">
                         <strong>Notice!</strong> You will receive customer service requests via text message to your mobile phone
                        </div>
   
						
                        <hr/>

						 <form method = "post" action = "" >
                     
                    <h3>First Name: </h3>

                    <input style="max-width:50%" type = "text" name = "firstName" id = "firstName" value = "<?php echo $_SESSION['firstName'] ?>" />

                    <br/>
                    
                    <h3>Last Name: </h3>

                    <input style="max-width:50%" type = "text" name = "lastName" id = "lastName" value = "<?php echo $_SESSION['lastName'] ?>" />

                    <br/>
                    
                    <h3>Username: </h3>

                    <input style="max-width:50%" type = "text" name = "username" id = "username" value = "<?php echo $_SESSION['username'] ?>" />

                    <br/>

                    <h3>Email: </h3>

                    <input style="max-width:50%" type = "text" name = "email" id = "email" value = "<?php echo $_SESSION['email'] ?>"  />

                    <br/>
                    
                    <br/>
                    
                    <h3>Phone: </h3>

                    <input style="max-width:50%" maxLength = "12" type = "text" name = "phone" id = "phone" value = "<?php echo $_SESSION['phone'] ?>" />

                    <br/>

                    <h3>Service</h3>
                    <select class="form-control" style="max-width:50%" name="service" id="service">
                   		 <option value="Animal Care Specialist">Animal Care Specialist</option>
       					 <option value="Automative Specialist">Automative Specialist</option>
                         <option value="Barber">Barber</option>
                         <option value="Business Services">Business Services</option>
                         <option value="Chef">Chef</option>
                         <option value="Childcare Specialist">Childcare Specialist</option>
                         <option value="Computer & App Specialist">Computer & App Specialist</option>
                         <option value="Cosmetologist">Cosmetologist</option>
                         <option value="Delivery Specialist">Delivery Specialist</option>
                         <option value="Entertainer">Entertainer</option>
                         <option value="Fashion & Design Specialist">Fashion & Design Specialist</option>
                         <option value="Financial Advisor">Financial Advisor</option>
                         <option value="Handyman">Handyman</option>
                         <option value="Hospice Aide">Hospice Aide</option>
                         <option value="Insurance Agent">Insurance Agent</option>
                         <option value="Interior Design">Interior Design</option>
                         <option value="Landscaper">Landscaper</option>
                         <option value="Maid">Maid</option>
                         <option value="Masseuse">Masseuse</option>
                         <option value="Media & Production Specialist">Media & Production Specialist</option>
                         <option value="Occupational Specialist">Occupational Specialist</option>
                         <option value="Personal Trainer">Personal Trainer</option>
                         <option value="Real Estate Specialist">Real Estate Specialist</option>
                         <option value="Therapist">Therapist</option>
                         <option value="Tutor & Training Specialist">Tutor & Training Specialist</option>
                	</select>

                    <br/>

                    <h3>Service Summary (Blurb): </h3>

                    <input style="max-width:50%" type = "text" name = "blurb" id = "blurb" maxlength="40" value = "<?php echo $_SESSION['blurb'] ?>" />

                    <br/>

                    <h3>Full Service Description: </h3>

                    <textarea style="max-width:50%" type = "text" name = "description" id = "description" value = <?php echo $_SESSION['description'] ?> ></textarea>

                    <br/>

                    <h3>Min Price: </h3>

                    <input style="max-width:50%" maxLength = "12" type = "number" name = "minPrice" id = "minPrice" value = "<?php echo $_SESSION['minPrice'] ?>" />

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
					
                    <button type="button" onclick="showPosition();" style="padding-left:10px;padding-right:10px;">Get Your Location</button>
                    
                    <br/><br/>
                    <div id="loader"></div>
                    <br/><br/>

                    <input type = "submit" name = "save" id = "save" value = "Add to Directory" style="padding-left:10px;padding-right:10px;" />
                    
              </form>
         
    <div id="result">
        <!--Position information will be inserted here-->

   

           

 
  <?php 
 
 if (isset($_POST['save']) && $_POST['save'] == "Add to Directory") {
    $lat = $_COOKIE['lat'];
    $long = $_COOKIE['long'];
     $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
     $userName = $_POST['username'];
     $email = $_POST['email'];
     $emailInsert = trim($email);
     $phone = $_POST['phone'];
     $service = $_POST['service'];
     $blurb = $_POST['blurb'];
     $description = $_POST['description'];
     $minPrice = $_POST['minPrice'];
     
     $password = $_POST['password'];
     $passwordInsert = md5($password);
     $description = $_POST['memberStatus'];
     $lurchStatus = $_POST['lurchStatus'];
     $lurchActive = $_POST['lurchActive'];
    
   // Session variables to maintain state if save fails
         $_SESSION['firstName'] = $firstName;
         $_SESSION['lastName'] = $lastName;
         $_SESSION['username'] = $userName;
         $_SESSION['email'] = $email;
         $_SESSION['phone'] = $phone;
         $_SESSION['service'] = $service;
         $_SESSION['blurb'] = $blurb;
         $_SESSION['description'] =  $description;
         $_SESSION['minPrice'] = $minPrice;
         $_SESSION['password'] = $password;
    // ---------------------------------------


     $sql = "INSERT INTO Members
            (FirstName,   LastName,  Username,     Email,         Phone,     Password,     Latitude, Longitude,     IsActive,       IsLurch,       IsLurchActive,    Service,     Blurb,    Description,   MinPrice,   SignupDate) Values
            ('$firstName','$lastName','$userName','$emailInsert','$phone', '$passwordInsert','$lat', '$long',    '$description','$lurchStatus', '$lurchActive',     '$service', '$blurb', '$description', '$minPrice', NOW())";
     
     
     if (mysqli_query($conn, $sql)) {
         $lurchID = mysqli_insert_id($conn);
         
         unset($_SESSION['firstName']);
         unset($_SESSION['lastName']);
         unset($_SESSION['username']);
         unset($_SESSION['email']);
         unset($_SESSION['phone']);
         unset($_SESSION['service']);
         unset($_SESSION['blurb']);
         unset($_SESSION['description']);
         unset($_SESSION['minPrice']);
         unset($_SESSION['password']);
         
         echo "<script>alert('Your service was added to the directory. Bookmark this page to edit your account.'); location = '/admin.php?ID=$lurchID&ENV=$env' </script>";

     }
     else {
         echo "<script>alert('Member creation failed!'); </script>";
     }
 }
  
 
 ?>
                  


	</body>
</html>
