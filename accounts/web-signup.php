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

input::-webkit-input-placeholder {
    font-size: 20px;
    line-height: 2;
}


.selectdiv {
  position: relative;
  /*Don't really need this just for demo styling*/
  min-width: 50%;
}

/*To remove button from IE11, thank you Matt */
select::-ms-expand {
     display: none;
}

.selectdiv:after {
  content: '<>';
  font: 17px "Consolas", monospace;
  color: #333;
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
  left: 0px;
  /*Adjust for position however you want*/
  
  top: 18px;
  padding: 0 0 2px;
  border-bottom: 1px solid #999;
  /*left line */
  
  position: absolute;
  pointer-events: none;
}

.selectdiv select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  /* Add some styling */
  
  display: block;
  width: 50%;
  max-width: 50%;
  height: 50px;
  float: left;
  margin: 5px 0px 20px;
  padding: 0px 24px;
  font-size: 16px;
  line-height: 1.75;
  color: #333;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #cccccc;
  -ms-word-break: normal;
  word-break: normal;
}
</style>



		<title>Join Our Directory</title>
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
			<header id="header" style="background-color:grey">
				<a href="index.php" class="logo"><img src="http://apilurchit.com/logo.png" height="40" width="40" style="margin-right: 5px;"/>Lurchit</a>
			</header>

		<!-- Menu -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">Member Manager</a></li>
				</ul>
			</nav>
			

					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Service Directory Signup</h2>

                        <div class="alert alert-warning" style="max-width:90%">
                         <strong>Notice!</strong> You will receive service inquiries via text message to your mobile phone
                        </div>
   
						
                        <hr/>

						 <form method = "post" action = "" >
                     
                    <input style="max-width:50%" type = "text" name = "firstName" id = "firstName" placeholder = "First Name" value = "<?php echo $_SESSION['firstName'] ?>" />

                    <br/>

                    <input style="max-width:50%" type = "text" name = "lastName" id = "lastName" placeholder = "Last Name" value = "<?php echo $_SESSION['lastName'] ?>" />

                    <br/>
                    
                    <input style="max-width:80%" type = "text" name = "username" id = "username" placeholder = "Username/Company Name" value = "<?php echo $_SESSION['username'] ?>" />

                    <br/>

                    <input style="max-width:50%" type = "text" name = "email" id = "email" placeholder = "Email" value = "<?php echo $_SESSION['email'] ?>"  />

                    <br/>

                    <input style="max-width:50%" maxLength = "12" type = "text" name = "phone" placeholder = "Phone" id = "phone" value = "<?php echo $_SESSION['phone'] ?>" />

                    <br/>

                    <div class="selectdiv">
                        <select class="form-control" style="max-width:50%" placeholder = "Service" name="service" id="service">
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
                    </div>

                    <br/><br/>

                    <input style="max-width:80%" type = "text" name = "blurb" id = "blurb" placeholder = "Service Summary/Blurb" maxlength="40" value = "<?php echo $_SESSION['blurb'] ?>" />

                    <br/>

                    <textarea style="max-width:80%" type = "text" name = "description" id = "description" placeholder = "Full Description" value = <?php echo $_SESSION['description'] ?> ></textarea>

                    <br/>

                    <input style="max-width:50%" type = "password" name = "password" id = "password" placeholder = "Password" />

                    <br/>
                   
                    <h3>Minimum Price</h3>
                    <input style="max-width:50%;" maxLength = "12" type = "number" name = "minPrice" id = "minPrice" value = "<?php echo $_SESSION['minPrice'] ?>" />

                    <hr/>

                     <h3>Member Status</h3>
                   	<select class="form-control" style = "width:25%" name="memberStatus" id="memberStatus" placeholder = "Member Status">
                   		 <option value="1">Active</option>
       					 <option value="0">Inactive</option>
                	</select>
                	
                	<hr/>
                	
                    <h3>Provider Status</h3>
                   	<select class="form-control" style = "width:25%" name="lurchStatus" id="lurchStatus" placeholder = "Provider Status">
                        <option value="1">Active</option>
       					 <option value="0">Inactive</option>
                	</select>
                    
                     <hr/>
                    
                     <h3>Provider Active</h3>
                   	<select class="form-control" style = "width:25%" name="lurchActive" id="lurchActive">
                        <option value="1">Active</option>
       					 <option value="0">Inactive</option>
                	</select>
                	
                	
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
					
                    <hr/>

                    <button type="button" onclick="showPosition();" style="padding-left:10px;padding-right:10px;">Get Your Location</button>
                    
                    <br/>
                    <div id="loader"></div>
                    <br/>

                    <input type = "submit" name = "save" id = "save" value = "Add to Directory" style="padding-left:10px;padding-right:10px;" 
                    onclick = "return confirm('By clicking Add to Directory, you are stating that any service you elect to provide, you can produce with the upmost quality. If the service requires a certificate or any form of accreditation or insurance, you are stating that you have possession of said entities. Any misrepresentation of the ability to deliver services or the ownership of necessary certifications or insurances, etc, is punishable to the fullest degree of the law.');" />
                    
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
