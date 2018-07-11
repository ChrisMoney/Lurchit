

<!DOCTYPE HTML>
<!--
	Intensify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Flickpitch - View Counter</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<a href="index.php" class="logo">Flickpitch</a>
			</header>

		<!-- Menu -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">View Counter</a></li>
				</ul>
			</nav>
			

					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Flickviews</h2>
						
						 <form method = "post" action = "" >
                     
                    <h3>Username: </h3>

                    <input style="max-width:90%" type = "text" name = "username" id = "username" />

                    <br/>
                     
                    <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "submit" id = "submit" value = "Get Views" />
                     
              </form>
              
              </div>

 <?php 
 
 if (isset($_POST['submit']) && $_POST['submit'] == "Get Views") {
     require 'connect.php';
     
     $username = $_POST['username'];
     $query = "SELECT count(*) AS total FROM FlickpitchViews WHERE Owner_ID = (SELECT ID FROM Members WHERE Username = '$username') ";
     $result = mysqli_query($conn, $query);
     $values = mysqli_fetch_assoc($result);
     $num_rows = $values['total'];
     echo '<h2>FlickpitchViews: <b>'. $num_rows.'</b></h2>';
 }
 ?>

                    
		<!-- Scripts -->

	</body>
</html>

