<?php 
session_start();
$env = $_GET['ENV'];
require '../api/connect.php';
require '../api/email.php';
require_once '../api/helpers.php';

// track IP addresses accessing this page.
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$sqlLog = "INSERT INTO SignupHits (IP, HitDate) Values ('$ip', NOW()) ";
mysqli_query($conn, $sqlLog);
?>

<!DOCTYPE HTML>


<html>
	<head>

    <script type="text/javascript">
function load() { 
document.getElementById("save").disabled = true;
document.getElementById("save").style.backgroundColor = 'gray';
document.getElementById('loader').style.display = 'none';
document.getElementById('gender').style.display = 'none';
var gender = document.getElementById('gender');

var serviceSession = "<?php echo $_SESSION['service'] ?>";

if (service !== null) {
    if (serviceSession == 'Childcare' || serviceSession == 'Fitness' || 
             serviceSession == 'Massage Therapy' || serviceSession == 'Mental Therapy') {
            if (genderView.style.display === "none") {
                genderView.style.display = "block";
            } else {
                genderView.style.display = "none";
            }
        }
    }
}
</script>

<script>
    function validateNumber(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>

<script>
    function showGender() {
        
        var x = document.getElementById('service');
        var service = x.options[x.selectedIndex].value;
        
        var gender = document.getElementById('gender');
        
        if (service == 'Childcare' || service == 'Fitness' || 
            service == 'Massage Therapy' || service == 'Mental Therapy') {
            if (gender.style.display === "none") {
                gender.style.display = "block";
            } else {
                gender.style.display = "none";
            }
        }
    } 
</script>

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

.div-round {
    overflow: hidden;
    position: relative;
    z-index: 10;
    -webkit-border-radius: 20px;
    border-radius: 20px;
}

.div-round::before {
    display: block;
    content: "";
}

.iframe-round {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10;
    width: 100%;
    height: 100%;
    border: 0;
    -webkit-border-radius: 20px;
    border-radius: 20px;
}


select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  /* Some browsers will not display the caret when using calc, so we put the fallback first */ 
  background: url("https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") white no-repeat 98.5% !important; /* !important used for overriding all other customisations */
  background: url("https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") white no-repeat calc(100% - 10px) !important; /* Better placement regardless of input width */
}
/*For IE*/
select::-ms-expand { display: none; }
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
	<body class="subpage" onload="load()">

		<!-- Header -->
			<header id="header" style="background-color:grey">
				<a href="https://lurchit.com" class="logo"><img src="https://apilurchit.com/logo.png" height="40" width="40" style="margin-right: 5px;"/>Lurchit</a>
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

                        <!--<div class="alert alert-warning" style="max-width:90%">
                         <strong>Notice!</strong> You will receive service inquiries via text message to your mobile phone
                        </div>-->

                        <div class="div-round" style="width:280px; height:315px;">
                            <iframe class="iframe-round" src="https://www.youtube.com/embed/cTy1Q3UY6kk" frameborder="0" 
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
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
                        <select style="max-width:50%" placeholder = "Service" name="service" id="service" onchange="showGender()">
                            <option value="Animal Care" <?php if ($_SESSION['service'] == 'Animal Care') echo 'selected';?>>Animal Care </option>
                            <option value="Arts & Entertainment" <?php if ($_SESSION['service'] == 'Arts & Entertainment') echo 'selected';?>>Arts & Entertainment</option>
                            <option value="Automotive" <?php if ($_SESSION['service'] == 'Automotive') echo 'selected';?>>Automotive</option>
                            <option value="Barber" <?php if ($_SESSION['service'] == 'Barber') echo 'selected';?>>Barber</option>
                            <option value="Business" <?php if ($_SESSION['service'] == 'Business') echo 'selected';?>>Business</option>
                            <option value="Childcare" <?php if ($_SESSION['service'] == 'Childcare') echo 'selected';?>>Childcare </option>
                            <option value="Cleaning" <?php if ($_SESSION['service'] == 'Cleaning') echo 'selected';?>>Cleaning</option>
                            <option value="Cosmetology" <?php if ($_SESSION['service'] == 'Cosmetology') echo 'selected';?>>Cosmetology</option>                 
                            <option value="Education" <?php if ($_SESSION['service'] == 'Education') echo 'selected';?>>Education</option>
                            <option value="Employment" <?php if ($_SESSION['service'] == 'Employment') echo 'selected';?>>Employment</option>
                            <option value="Fashion" <?php if ($_SESSION['service'] == 'Fashion') echo 'selected';?>>Fashion</option>
                            <option value="Finance" <?php if ($_SESSION['service'] == 'Finance') echo 'selected';?>>Finance</option>
                            <option value="Fitness" <?php if ($_SESSION['service'] == 'Fitness') echo 'selected';?>>Fitness</option>
                            <option value="Handyman" <?php if ($_SESSION['service'] == 'Handyman') echo 'selected';?>>Handyman</option>
                            <option value="Insurance" <?php if ($_SESSION['service'] == 'Insurance') echo 'selected';?>>Insurance</option>
                            <option value="Interior Design" <?php if ($_SESSION['service'] == 'Interior Design') echo 'selected';?>>Interior Design</option>
                            <option value="Landscaping" <?php if ($_SESSION['service'] == 'Landscaping') echo 'selected';?>>Landscaping</option>
                            <option value="Massage Therapy" <?php if ($_SESSION['service'] == 'Massage Therapy') echo 'selected';?>>Massage Therapy</option>
                            <option value="Media & Production" <?php if ($_SESSION['service'] == 'Media & Production') echo 'selected';?>>Media & Production</option>
                            <option value="Medical Care" <?php if ($_SESSION['service'] == 'Medical Care') echo 'selected';?>>Medical Care</option>
                            <option value="Mental Therapy" <?php if ($_SESSION['service'] == 'Mental Therapy') echo 'selected';?>>Mental Therapy</option>
                            <option value="Misc Services" <?php if ($_SESSION['service'] == 'Misc Services') echo 'selected';?>>Misc Services</option>
                            <option value="Moving & Delivery" <?php if ($_SESSION['service'] == 'Moving & Delivery') echo 'selected';?>>Moving & Delivery</option>
                            <option value="Night Life" <?php if ($_SESSION['service'] == 'Night Life') echo 'selected';?>>Night Life</option>
                            <option value="Photography" <?php if ($_SESSION['service'] == 'Photography') echo 'selected';?>>Photography</option>
                            <option value="Real Estate" <?php if ($_SESSION['service'] == 'Real Estate') echo 'selected';?>>Real Estate</option>
                            <option value="Restaurant & Food Services" <?php if ($_SESSION['service'] == 'Restaurant & Food Services') echo 'selected';?>>Restaurant & Food Services</option>
                            <option value="Technology" <?php if ($_SESSION['service'] == 'Technology') echo 'selected';?>>Technology</option>
                	    </select>
                    </div>

                    <br/><br/>

              
                        <select class="form-control" style = "width:25%" name="gender" id="gender" placeholder = "Gender">
                            <option value="M" <?php if ($_SESSION['gender'] == 'M') echo 'selected';?>>Male</option>
                            <option value="F" <?php if ($_SESSION['gender'] == 'F') echo 'selected';?>>Female</option>
                        </select>
           

                    <br/>

                    <input style="max-width:80%" type = "text" name = "blurb" id = "blurb" placeholder = "Service Summary/Blurb" maxlength="40" value = "<?php echo $_SESSION['blurb'] ?>" />

                    <br/>

                    <textarea style="max-width:80%" type = "text" name = "description" id = "description" placeholder = "Full Description"><?php echo $_SESSION['description'] ?></textarea>

                    <br/>

                    <input style="max-width:50%" type = "password" name = "password" id = "password" placeholder = "Password" />

                    <br/>
                   
                    <h3>Minimum Price</h3>
                    <input class="form-control" style="max-width:50%;" maxLength = "12" type='text' placeholder = "30" onkeypress='validateNumber(event)' name = "minPrice" id = "minPrice" value = "<?php echo $_SESSION['minPrice'] ?>" />

                    <hr/>

                     <h3>Is Your Service Mobile? </h3>
                     
                     <i>Would you come to a customer?</i>
                     <div class="dropdown">
                        <select class="form-control" style = "width:25%" name="mobileStatus" id="mobileStatus" placeholder = "Mobile Status">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

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
    </div>
           
    <span style="align:cener">Lurchit &#169; 2020 All Rights Reserved </span>
 
  <?php 
 
 if (isset($_POST['save']) && $_POST['save'] == "Add to Directory") {

     
     $lat = $_COOKIE['lat'];
     $long = $_COOKIE['long'];
     $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
     $email = $_POST['email'];
     $email = trim($email);
     $username = $_POST['username'];
     $username = trim($username);
     $phone = $_POST['phone'];
     $phoneFormat = phone_number_format($phone);
     $service = $_POST['service'];
     $gender = $_POST['gender'];
     $blurb = $_POST['blurb'];   
     $description = $_POST['description'];
     $minPrice = $_POST['minPrice'];
     $isMobile = $_POST['mobileStatus'];
     $password = $_POST['password'];
     $password = md5($password);
     $memberStatus = $_POST['memberStatus'];
     $lurchStatus = $_POST['lurchStatus'];
     $lurchActive = $_POST['lurchActive'];
    
   // Session variables to maintain state if save fails
         $_SESSION['firstName'] = $firstName;
         $_SESSION['lastName'] = $lastName;
         $_SESSION['username'] = $username;
         $_SESSION['email'] = $email;
         $_SESSION['phone'] = $phone;
         $_SESSION['service'] = $service;
         $_SESSION['blurb'] = $blurb;
         $_SESSION['description'] =  $description;
         $_SESSION['minPrice'] = $minPrice;
         $_SESSION['password'] = $password;
         $_SESSION['gender'] = $gender;
    // ---------------------------------------
      $sql1 = "Select ID From Members Where Email = '$email' ";
      $result1 = mysqli_query($conn, $sql1);
      
      if (mysqli_num_rows($result1)  > 0) {
         // account already exists
         echo "<script>alert('Email already exists!'); location = '/web-signup.php?ENV=$env';</script>";
         exit;
      }
     
      $sql2 = "Select ID From Members Where Username = '$username' ";
      $result2 = mysqli_query($conn, $sql2);
      
      if (mysqli_num_rows($result2)  > 0) {
         // username already in use
         echo "<script>alert('Username already exists!'); location = '/web-signup.php?ENV=$env';</script>";
         exit;
      }
     

     if (strlen($firstName) == 0 || strlen($lastName) == 0 || strlen($email) == 0 || strlen($phone) == 0 || strlen($blurb) == 0
     || strlen($password) == 0 || strlen($description) == 0 || strlen($minPrice) == 0) { 
         echo "<script>alert('One or more of your form fields are empty'); location = '/web-signup.php?ENV=$env';</script>";
        exit;
    }

    $blurb = mysqli_real_escape_string($conn,$blurb);
    $description = mysqli_real_escape_string($conn, $description);

    $sql1 = "Select ID From Members Where Email = '$email' ";
    $result1 = mysqli_query($conn, $sql1);
    
    if (mysqli_num_rows($result1)  > 0) {
       // account already exists
       echo "<script>alert('Email already exists'); location = '/web-signup.php?ENV=$env'</script>";
       exit;
    }

    $sql2 = "Select ID From Members Where Username = '$username' ";
    $result2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result2)  > 0) {
    // username already in use
    echo "<script>alert('Username already exists'); location = '/web-signup.php?ENV=$env'</script>";
    exit;
    }

     $sql = "INSERT INTO Members
            (FirstName,   LastName,  Username,     Email,    Phone,     Password,   Latitude, Longitude,     IsActive,       IsLurch,       IsLurchActive,    Service,    Gender,    Blurb,    Description,   MinPrice,    IsMobile,  SignupDate) Values
            ('$firstName','$lastName','$username','$email', '$phone', '$password',   '$lat',   '$long',         '1',            '1',               '1',     '$service',  '$gender', '$blurb', '$description', '$minPrice', '$isMobile', NOW())";
     
     
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
         
         if ($env == 'PROD') {
            providerSignupEmail($username, $service);
         }
         echo "<script>alert('Your service was added to the directory. Bookmark this page to edit your account.'); location = '/admin.php?ID=$lurchID&ENV=$env' </script>";

     }
     else {
         echo "<script>alert('Member creation failed!'); location = '/web-signup.php?ENV=$env'</script>";
     }
 }
  
 
 ?>
                  


	</body>
</html>
