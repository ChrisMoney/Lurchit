<?php 
require '../api/connect.php';


$validated = 'false';

if ((isset($_POST['login']) && $_POST['login'] == "Login")) {

	$email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

	$sqlAuth = "SELECT ID FROM Members WHERE Email = '$email' AND Password = '$password' AND IsAdmin = 1 ";
	$resultAuth = mysqli_query($conn, $sqlAuth);

	if (mysqli_num_rows($resultAuth) > 0) {
		$validated = 'true';
	}
}

?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Lurchit</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/main.css" />

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

/* Loader spin action for Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding-left:10px;
  padding-right:10px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 25%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  span-size: 35px;
  span-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>

		<script type="text/javascript">
            function authenticate() { 
                
            // Get the modal
            var validated = "<?php echo $validated ?>";
           // alert(validated);
            var modal = document.getElementById('id01');

            if (validated == 'false') {
                modal.style.display = 'block';
            }
            else {
                modal.style.display = 'none';
            }          
        }
		</script>
		
	</head>

	<body onload="authenticate()">

		<!-- Header -->
			<header id="header">
				<nav class="left">
					<!-- <a href="#menu"><span>Menu</span></a>-->
				</nav>
				<a href="index.php" class="logo">Lurchit</a>
				<!--  <nav class="right">
					<a href="#" class="button alt">Log in</a>
				</nav>-->
			</header>

			<div id="id01" class="modal">
  
				<form class="modal-content animate" action="" method="post">
					<div class="imgcontainer">
					<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
					<img src="https://apilurchit.com/logo.png" alt="Avatar" class="avatar">
					</div>

					<div class="container">
					<input type="text" placeholder="Enter Email" name="email" id="email" required>

					<input type="password" placeholder="Enter Password" name="password" id="password" required>
						
					<input style="padding-left:10px;padding-right:10px;background:green;" type="submit" id="login" name="login" value = "Login" />
					</div>

					<div class="container" style="background-color:#f1f1f1">

					<input type="button" onclick="document.getElementById('id01').style.display='none'" 
					style="padding-left:10px;padding-right:10px;padding-bottom:10px;background:red;" onclick="goBack()" value = 'Cancel' />

					<span class="psw">Forgot <a href="https://accounts.apilurchit.com/password-reset.php">password?</a></span>

					<br/><br/>
					<span><a href="https://twitter.com/lurch_it" target="_blank">Need Help? Contact Us on Twitter <img src="https://apilurchit.com/twitter-logo.png" height="50" width="50"/></a>
					</div>
				</form>
				</div>

		<!-- One -->
			<section id="one" class="wrapper">
				<div class="inner flex flex-3">
					<div class="flex-item right">
						<div>
							<h3><a href='search.php'>Search</a></h3>
							<h3><a href='data.php?v=t'>Data</a></h3>
						</div>
						<div>
							<h3></h3>
					</div>
					<div class="flex-item image fit round">
					</div>
					<div class="flex-item right">
						<div>
							<h3></h3>
						</div>
						<div>
							<h3></h3>
						</div>
					</div>
				</div>
			</section>


		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<h2>Get In Touch</h2>
					<ul class="actions">
						<li><span class=""></span> <a href="mailto:info@lurchit.com">info@lurchit.com</a></li>
						<li><span class=""></span> 911 Washington Avenue, Suite 501, St. Louis, MO 63101</li>
					</ul>
				</div>
				<div class="copyright">
					&copy; 2020
				</div>
			</footer>

		<!-- Scripts -->
			<script src="js/jquery.min.js"></script>
			<script src="js/jquery.scrolly.min.js"></script>
			<script src="js/skel.min.js"></script>
			<script src="js/util.js"></script>
			<script src="js/main.js"></script>

	</body>
</html>