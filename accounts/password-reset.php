 <?php

                        if (isset($_POST['submit']) && ($_POST['submit'] == "Reset Password")) {
 
                         require 'connect.php';
                         
                         $email = trim($_POST['email']);
                         
                        $sql = "SELECT Email FROM Members WHERE Email = '$email'";    
                        
                        $result = mysqli_query($conn, $sql);
                         // query results
                         if (mysqli_num_rows($result) == 0) {
                             
                           echo "<font color = 'red'>Your email was not found</font>";
             }
               // if email was found
              
             else {      
                include_once 'email.php';
                sendResetEmail($email);
                echo "<script>alert('A password reset link has been sent to your email on file');</script>";
             }
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
		<title>Statuz - Reset Password</title>
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
					<li><a href="password-reset.php">Password Reset</a></li>
				</ul>
			</nav>
			

					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Reset your password</h2>
						 <form method = "post" action = "" >
                     
                    <h3>Email : </h3>

                    <input style="max-width:90%" type = "email" name = "email" id = "email" />

                    <br/>
                     
                    <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "submit" id = "submit" value = "Reset Password" />
                     
              </form>
              
              </div>


                    
		<!-- Scripts -->
			

	</body>
</html>