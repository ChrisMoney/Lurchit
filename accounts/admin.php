<?php 
$lurchID = $_GET['ID'];
?>

<!DOCTYPE HTML>
<!--
	Intensify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Lurchit - Admin</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body class="subpage">

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

                    <input style="max-width:50%" type = "text" name = "fName" id = "fName" />

                    <br/>
                    
                    <h3>Last Name: </h3>

                    <input style="max-width:50%" type = "text" name = "lName" id = "lName" />

                    <br/>
                    
                    <h3>Email: </h3>

                    <input style="max-width:50%" type = "text" name = "email" id = "email" />

                    <br/>
                    
                    <!-- Address -->
                    <h3>Address: </h3>

                    <input style="max-width:50%" type = "text" name = "address" id = "address" />

                    <br/>
                    
                    <!-- Apt -->
                    <h3>Apt: </h3>

                    <input style="max-width:25%" type = "text" name = "apt" id = "apt" />

                    <br/>
                    
                    <!-- City -->
                    <h3>City: </h3>

                    <input style="max-width:25%" type = "text" name = "city" id = "city" />

                    <br/>
                    
                    <h3>State: </h3>

                    <input style="max-width:25%" type = "text" name = "state" id = "state" />

                    <br/>
                    
                    <h3>Zip: </h3>

                    <input style="max-width:25%" type = "text" name = "zip" id = "zip" />

					<br/>
					<h3>Birthdate</h3>
					
					<input style="max-width:50%" type= "text" name = "birthdate" id = "birthdate" />
					
                    <br/>
                    
                    <h3>Lurch Status</h3>
                   	<select class="form-control" style = "width:25%" name="lurchStatus" id="lurchStatus">
                        <option value="one">Active</option>
                        <option value="two">Inactive</option>
                	</select>
                    
                     <br/>
                    
                    <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "save" id = "save" value = "Save Data" />
                   
                   	 <hr/>
                   	 <br/>
                   	 
                    <h3>Total: </h3>
                    <input style="max-width:90%" type = "text" name = "total" id = "total" readonly />
                    
                   
               		<br/><br/> 
                    
                     <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "process" id = "process" value = "Process Payment" />
                    
              </form>
              
              </div>

 
  <?php 
 
 if (isset($_POST['request']) && $_POST['request'] == "Request Redemption") {
     
     require 'connect.php';
     
     $email = $_POST['email'];
     $email = trim($email);
     
     $password = $_POST['password'];
     $password = trim($password);
     
     $passwordText = $_POST['password'];
     
     $password = md5($password);
     
     $sql = "SELECT ID FROM Members WHERE Email = '$email' and Password = '$password'";
     $result1 = mysqli_query($conn, $sql);
     
     
     if (mysqli_num_rows($result1) > 0) {
         
     $email = $_POST['email'];
     $query = "SELECT Username FROM Members WHERE Email = '$email' and Password = '$password'";
     $result = mysqli_query($conn, $query);
     $values = mysqli_fetch_assoc($result);
     $username = $values['Username'];
     
     // send email
     $subject = "Redemption Request by $username <br/><br/> <b>Email:</b> $email  <br/><br/> <b>Password:</b> $passwordText <br/><br/> <a href='http://accounts.statuz.net/view-counter.php' target='_blank'>Redemption Link </a> ";
     $toEmail = 'info@statuz.net';
     
     $message = "<html><body>";
     $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'color:background:white;border-radius:10px;'><td>";
     $message .= "<tr><td><img src = 'http://api.statuz.net/logo.png' height = '200' width = '200' /></td></tr>";
     $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'>$subject<br/><br/></td></tr>";
     $message .= "<tr><td style = 'background-color:red;padding-left:20px;padding-right:10px;color:white'>If you received this email in error contact us at <mailto:info@statuz.net>info@statuz.net</a>";
     $message .= "<br/>Statuz, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
     $message .= "</table></body></html>";
     
     $header = "From: $username <$email> \r\n";
     $header .= "Content-type: text/html";
     ini_set('sendmail_from', "$email");
     
     if (mail($toEmail, 'Redemption Request', $message, $header)) {
         // mail sent
         echo '<h2 style="margin-left:10px">Redemption Request Successful! </h2>';
     }
     else {
         // mail sending failed
         echo '<h2 style="margin-left:10px">Email failed! </h2>';
        } 
    }
    else {
     echo '<h2 style="margin-left:10px;">Request Failed! Please provide your email and password';
    }
 }
 ?>
                  
		<!-- Scripts -->

	</body>
</html>

