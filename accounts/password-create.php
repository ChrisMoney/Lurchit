 <?php 
 session_start();
 
 if (!isset($_SESSION['Email']) && empty($_SESSION['Email'])) {
     $_SESSION['Email'] = $_GET['email'];
 }
 else {
     
 }
 
 if (isset($_POST['submit']) && $_POST['submit'] == "Create Password") {
     require 'connect.php';
     $email = $_GET['email'];
     $pass = $_POST['password'];
     $pass = md5($pass);
     
     
     if ($email == $_SESSION['Email']) {
         $sql = "UPDATE Members SET Password = '$pass' WHERE Email = '$email' ";
         mysqli_query($conn, $sql) or die(mysqli_error());
         echo "<h3 style='padding-left:10px;color:green;'>Your password has been updated </h3>";
     }
     else { echo "<h3 style='padding-left:10px;color:red;'>Invalid Account</h3>"; }
 }
 ?>

<!DOCTYPE HTML>
<!--
	Intensify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Statuz - Create Password</title>
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
					<li><a href="index.php">Home</a></li>
				</ul>
			</nav>
			

					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Create a new password</h2>
						
						 <form method = "post" action = "" >
                     
                    <h3>Password : </h3>

                    <input style="max-width:90%" type = "password" name = "password" id = "password" />

                    <br/>
                     
                    <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "submit" id = "submit" value = "Create Password" />
                     
              </form>
              
              </div>


                    
		<!-- Scripts -->

	</body>
</html>

