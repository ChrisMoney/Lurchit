<?php 
$admin = $_GET['admin'];
?>

<!DOCTYPE HTML>
<!--
	Intensify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Statuz - View Counter</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<a href="index.php" class="logo">Statuz</a>
			</header>

		<!-- Menu -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">View Counter</a></li>
				</ul>
			</nav>
			

					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Likes</h2>
						
						 <form method = "post" action = "" >
                     
                    <h3>Email: </h3>

                    <input style="max-width:90%" type = "text" name = "email" id = "email" />

                    <br/>
                    
                     <h3>Password: </h3>
                    <input style="max-width:90%" type = "text" name = "password" id = "password" />
                    
                    <br/>
                    
                    <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "submit" id = "submit" value = "Get Likes" />
                    
                    <br/><br/>
                    
                    <h3>Request Redemption: </h3>  
                    
                     <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "request" id = "request" value = "Request Redemption" />
                     
                    <?php 
                    if ((isset($admin) && !empty($admin)) && ($admin == "1")) { ?>
                     <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "redeem" id = "redeem" value = "Redeem" />
                    <?php } ?>
                    
              </form>
              
              </div>

 <?php 
 
 if (isset($_POST['submit']) && $_POST['submit'] == "Get Likes") {
     require 'connect.php';
     
     $email = $_POST['email'];
     $password = $_POST['password'];
     
     $password = md5($password);
     
     $sql = "SELECT ID FROM Members WHERE Email = '$email' and Password = '$password'";
     $result1 = mysqli_query($conn, $sql);
     
     
     if (mysqli_num_rows($result1) > 0) {
         $query = "SELECT count(*) AS total FROM Likes WHERE Member_ID = (SELECT ID FROM Members WHERE Email = '$email') And Redeemed = 0";
         $result = mysqli_query($conn, $query);
         $values = mysqli_fetch_assoc($result);
         $num_rows = $values['total'];
         echo '<h2 style="margin-left:10px;">Total Likes: <b>'. $num_rows.'</b></h2>';
     }
     else {
        echo '<h2 style="margin-left:10px;">Could not validate your credentials';
    }
 }
 ?>

 <?php 
 
 if (isset($_POST['redeem']) && $_POST['redeem'] == "Redeem") {
     require 'connect.php';
     
     $email = $_POST['email'];
     $password = $_POST['password'];
     
     $password = md5($password);
     
     $sql = "SELECT ID FROM Members WHERE Email = '$email' and Password = '$password'";
     $result1 = mysqli_query($conn, $sql);
     
     
     if (mysqli_num_rows($result1) > 0) {
         
     $email = $_POST['email'];
     $query = "Update Likes Set Redeemed = 1 WHERE Member_ID = (SELECT ID FROM Members WHERE Username = '$email') ";
     $result = mysqli_query($conn, $query);
     $values = mysqli_fetch_assoc($result);
     $num_rows = $values['total'];
     echo '<h2 style="margin-left:10px">Redemption Successful! </h2>';
    }
    else {
     echo '<h2 style="margin-left:10px;">Unable to redeem likes </h2>';
    }
 }
 ?>
 
  <?php 
 
 if (isset($_POST['request']) && $_POST['request'] == "Request Redemption") {
     
     require 'connect.php';
     
     $email = $_POST['email'];
     $password = $_POST['password'];
     
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
     $subject = "Redemption Request by $username <br/><br/> Email: $email";
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

