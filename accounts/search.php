

<!DOCTYPE HTML>
<!--
	Intensify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Lurchit - Search</title>
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
					<li><a href="index.php">Home</a></li>
				</ul>
			</nav>
			

					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Search for Member</h2>
						
						 <form method = "post" action = "" >
                     
                    <h3>Email : </h3>

                    <input style="max-width:90%" type = "email" name = "email" id = "email" />

                    <br/>
                     
                    <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "submit" id = "submit" value = "Search" />
                     
              </form>
              
              <?php 
							
              if (isset($_POST['submit']) && $_POST['submit'] == "Search") {
                
                    require '../api/connect.php';
							
							
    				$email = $_POST['email'];
    				$email = trim($email);
    				
    				$sql = "SELECT ID, FirstName, LastName, Username FROM Members WHERE Email = '$email' ";
    				$result = mysqli_query($conn, $sql);
    				
    				if (mysqli_num_rows($result) > 0) {
    				    
    				   $row = mysqli_fetch_assoc($result);
    			   
    				   $id = $row['ID'];
    			       $firstName = $row['FirstName'];
    			       $lastName = $row['LastName'];
    			       $username = $row['Username'];
    			        
    			       echo "<a href = '/admin.php?ID=$id'>".$firstName . " ". $lastName .": ". $username ."</a> <br/>";
    				    
    				}
    				    else {
    				        echo "No employee found.";
    				    }
                  }
              ?>
              
              </div>


                    
		<!-- Scripts -->

	</body>
</html>

