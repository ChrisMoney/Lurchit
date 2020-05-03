<?php
require '../api/connect.php';
// track IP addresses accessing this page.
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

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
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
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
  font-size: 35px;
  font-weight: bold;
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

	<div id="id01" class="modal">
  
	<form class="modal-content animate" action="" method="post">
		<div class="imgcontainer">
		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		<img src="https://apilurchit.com/logo.png" alt="Avatar" class="avatar">
		</div>

		<div class="container">
		<label for="uname"><b>Email<b></label>
		<input type="text" placeholder="Enter Username" name="email" id="email" required>

		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="password" id="password" required>
			
		<input style="padding-left:10px;padding-right:10px" type="submit" id="login" name="login" value = "Login" />
		</div>

		<div class="container" style="background-color:#f1f1f1">
		<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn" onclick="goBack()">Cancel</button>
		<span class="psw">Forgot <a href="https://accounts.apilurchit.com/password-reset.php">password?</a></span>

		<br/><br/>
		<span><a href="https://twitter.com/lurch_it" target="_blank">Need Help? Contact Us on Twitter <img src="https://apilurchit.com/twitter-logo.png" height="50" width="50"/></a>
		</div>
	</form>
	</div>

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

		
		<!-- One -->
			<section id="one" class="wrapper">
				<div class="inner flex flex-3">
					<div class="flex-item left">
						<div>
							
							<?php if ($validated == 'true') { ?>

							<?php 
							$newDate = mktime(0,0,0,date("m"),date("d"),date("Y"));
							$today = date("Y-m-d", $newDate);

							$sql = "SELECT ID FROM Members WHERE DATE_FORMAT(SignupDate, '%Y-%m-%d') = CURDATE() ";
							$result = mysqli_query($conn, $sql);
							$count = mysqli_num_rows($result);
							
							$sql1 = "SELECT ID FROM Members";
							$result1 = mysqli_query($conn, $sql1);
							$count1 = mysqli_num_rows($result1);
							
							$sql2 = "SELECT ID FROM Members WHERE IsLurch = 1";
							$result2 = mysqli_query($conn, $sql2);
							$count2 = mysqli_num_rows($result2);
							
							$sql3 = "SELECT ID FROM Members WHERE IsLurch = 1 AND IsLurchActive = 1";
							$result3 = mysqli_query($conn, $sql3);
							$count3 = mysqli_num_rows($result3);
							
							$sql4 = "SELECT ID FROM LogServiceSearch";
							$result4 = mysqli_query($conn, $sql4);
							$count4 = mysqli_num_rows($result4);
							
							$sql5 = "SELECT ID FROM LogServiceRequest";
							$result5 = mysqli_query($conn, $sql5);
							$count5 = mysqli_num_rows($result5);
							?>
	
                            <table>
                                <tr>
                                    <td>
                                     <font style='color:black'>Today's signups: <b><?php echo $count ?></b></font> 
							        </td>
						        </tr>
						        <tr>
                                    <td>
                                     <font style='color:black'>Total Members: <b><?php echo $count1 ?></b></font> 
							        </td>
						        </tr>
						       
							     <tr>
							        <td>
							        <font style='color:black'>Total Service Searches: <b><?php echo $count4 ?></b></font>
							        </td>
							    </tr>
							     <tr>
							        <td>
							        <font style='color:black'>Total Service Requests: <b><?php echo $count5 ?></b></font>
							        </td>
							    </tr>
							    
							     <tr>
							        <td>
							        <font style='color:black'>Total Service Providers: <b><?php echo $count2 ?></b></font>
							        </td>
							    </tr>
							     <tr>
							        <td>
							        <font style='color:black'>Total Active Service Providers: <b><?php echo $count3 ?></b></font>
							        </td>
							    </tr>
						    </table>
							
							
							<?php 
							
							// Animal Care Specialist
							$sqlAnimalCareSpecialist = "SELECT ID FROM Members WHERE Service = 'Animal Care Specialist' And IsLurchActive = 1 ";
							$resultAnimalCareSpecialist = mysqli_query($conn, $sqlAnimalCareSpecialist);
							if ($resultAnimalCareSpecialist) {
							    if (mysqli_num_rows($resultAnimalCareSpecialist) > 0) {
							        $animalCareSpecialist = mysqli_num_rows($resultAnimalCareSpecialist);
							    } else {
							        $animalCareSpecialist = 0;
							    }
							} 
							else {
							    $animalCareSpecialist = 0;
							}
							
							// Auto Specialist
							$sqlAutoSpecialist = "SELECT ID FROM Members WHERE Service = 'Automotive Specialist' And IsLurchActive = 1 ";
							$resultAutoSpecialist = mysqli_query($conn, $sqlAutoSpecialist);
							if ($resultAutoSpecialist) {
							    if (mysqli_num_rows($resultAutoSpecialist) > 0) {
							        $autoSpecialist = mysqli_num_rows($resultAutoSpecialist);
							    } else {
							        $autoSpecialist = 0;
							    }
							}
							else {
							    $autoSpecialist = 0;
							}
					
							// Childcare Specialist
							$sqlChildCareSpecialist = "SELECT ID FROM Members WHERE Service = 'Childcare Specialist' And IsLurchAcive = 1 ";
							$resultChildCareSpecialist = mysqli_query($conn, $sqlChildCareSpecialist);
							if ($resultChildCareSpecialist) {
							    if (mysqli_num_rows($resultChildCareSpecialist) > 0) {
							        $childCareSpecialist = mysqli_num_rows($resultChildCareSpecialist);
							    } else {
							        $childCareSpecialist = 0;
							    }
							}
							else {
							    $childCareSpecialist = 0;
							}
							
							// Barber
							$sqlBarber = "SELECT ID FROM Members WHERE Service = 'Barber' And IsLurchActive = 1 ";
							$resultBarber = mysqli_query($conn, $sqlBarber);
							if ($resultBarber) {
							    if (mysqli_num_rows($resultBarber) > 0) {
							        $barber = mysqli_num_rows($resultBarber);
							    } else {
							        $barber = 0;
							    }
							}
							else {
							    $barber = 0;
							}
							
							// Chef
							$sqlChef = "SELECT ID FROM Members WHERE Service = 'Chef' And IsLurchActive = 1 ";
							$resultChef = mysqli_query($conn, $sqlChef);
							if ($resultChef) {
							    if (mysqli_num_rows($resultChef) > 0) {
							        $chef = mysqli_num_rows($resultChef);
							    } else {
							        $chef = 0;
							    }
							}
							else {
							    $chef = 0;
							}
							
							// Computer & App Specialist
							$sqlComputerAppSpecialist = "SELECT ID FROM Members WHERE Service = 'Computer & App Specialist' And IsLurchActive = 1 ";
							$resultComputerAppSpecialist = mysqli_query($conn, $sqlComputerAppSpecialist);
							if ($resultComputerAppSpecialist) {
							    if (mysqli_num_rows($resultComputerAppSpecialist) > 0) {
							        $computerAppSpecialist = mysqli_num_rows($resultComputerAppSpecialist);
							    } else {
							        $computerAppSpecialist = 0;
							    }
							}
							else {
							    $computerAppSpecialist = 0;
							}
							
							// Delivery Specialist
							$sqlDelivery = "SELECT ID FROM Members WHERE Service = 'Delivery Specialist' And IsLurchActive = 1 ";
							$resultDelivery = mysqli_query($conn, $sqlDelivery);
							if ($resultDelivery) {
							    if (mysqli_num_rows($resultDelivery) > 0) {
							        $deliverySpecialist = mysqli_num_rows($resultDelivery);
							    } else {
							        $deliverySpecialist = 0;
							    }
							}
							else {
							    $deliverySpecialist = 0;
							}
							
							// Fashion & Design Specialist
							$sqlFashionDesignSpecialist = "SELECT ID FROM Members WHERE Service = 'Fashion & Design Specialist' And IsLurchActive = 1 ";
							$resultFashionDesignSpecialist = mysqli_query($conn, $sqlFashionDesignSpecialist);
							if ($resultFashionDesignSpecialist) {
							    if (mysqli_num_rows($resultFashionDesignSpecialist) > 0) {
							        $fashionDesignSpecialist = mysqli_num_rows($resultFashionDesignSpecialist);
							    } else {
							        $fashionDesignSpecialist = 0;
							    }
							}
							else {
							    $fashionDesignSpecialist = 0;
							}
							
							// Entertainer
							$sqlEntertainer = "SELECT ID FROM Members WHERE Service = 'Entertainer' And IsLurchActive = 1 ";
							$resultEntertainer = mysqli_query($conn, $sqlEntertainer);
							if ($resultEntertainer) {
							    if (mysqli_num_rows($resultEntertainer) > 0) {
							        $entertainer = mysqli_num_rows($resultEntertainer);
							    } else {
							        $entertainer = 0;
							    }
							}
							else {
							    $entertainer = 0;
							}
							
							// Financial Advisor
							$sqlFinancialAdvisor = "SELECT ID FROM Members WHERE Service = 'Financial Advisor' And IsLurchActive = 1 ";
							$resultFinancialAdvisor = mysqli_query($conn, $sqlFinancialAdvisor);
							if ($resultFinancialAdvisor) {
							    if (mysqli_num_rows($resultFinancialAdvisor) > 0) {
							        $financialAdvisor = mysqli_num_rows($resultFinancialAdvisor);
							    } else {
							        $financialAdvisor = 0;
							    }
							}
							else {
							    $financialAdvisor = 0;
							}
							
							// Handyman
							$sqlHandyman = "SELECT ID FROM Members WHERE Service = 'Handyman' And IsLurchActive = 1 ";
							$resultHandyman = mysqli_query($conn, $sqlHandyman);
							if ($resultHandyman) {
							    if (mysqli_num_rows($resultHandyman) > 0) {
							        $handyman = mysqli_num_rows($resultHandyman);
							    } else {
							        $handyman = 0;
							    }
							}
							else {
							    $handyman = 0;
							}
							
							// Hospice Aid
							$sqlHospiceAid = "SELECT ID FROM Members WHERE Service = 'Hospice Aid' And IsLurchActive = 1 ";
							$resultHospiceAid = mysqli_query($conn, $sqlHospiceAid);
							if ($resultHospiceAid) {
							    if (mysqli_num_rows($resultHospiceAid) > 0) {
							        $hospiceAid = mysqli_num_rows($resultHospiceAid);
							    } else {
							        $hospiceAid = 0;
							    }
							}
							else {
							    $hospiceAid = 0;
							}
							
							// Insurance Agent
							$sqlInsuranceAgent = "SELECT ID FROM Members WHERE Service = 'Insurance Agent' And IsLurchActive = 1 ";
							$resultInsuranceAgent = mysqli_query($conn, $sqlInsuranceAgent);
							if ($resultInsuranceAgent) {
							    if (mysqli_num_rows($resultInsuranceAgent) > 0) {
							        $insuranceAgent = mysqli_num_rows($resultInsuranceAgent);
							    } else {
							        $insuranceAgent = 0;
							    }
							}
							else {
							    $insuranceAgent = 0;
							}
							
							// Interior Designer
							$sqlInteriorDesigner = "SELECT ID FROM Members WHERE Service = 'Interior Designer' And IsLurchActive = 1 ";
							$resultInteriorDesigner = mysqli_query($conn, $sqlInteriorDesigner);
							if ($resultInteriorDesigner) {
							    if (mysqli_num_rows($resultInteriorDesigner) > 0) {
							        $interiorDesigner = mysqli_num_rows($resultInteriorDesigner);
							    } else {
							        $interiorDesigner = 0;
							    }
							}
							else {
							    $interiorDesigner = 0;
							}
							
							// Landscaper
							$sqlLandscaper = "SELECT ID FROM Members WHERE Service = 'Landscaper' And IsLurchActive = 1 ";
							$resultLandscaper = mysqli_query($conn, $sqlLandscaper);
							if ($resultLandscaper) {
							    if (mysqli_num_rows($resultLandscaper) > 0) {
							        $landscaper = mysqli_num_rows($resultLandscaper);
							    } else {
							        $landscaper = 0;
							    }
							}
							else {
							    $landscaper = 0;
							}
							
							// Maid
							$sqlMaid = "SELECT ID FROM Members WHERE Service = 'Maid' And IsLurchActive = 1 ";
							$resultMaid = mysqli_query($conn, $sqlMaid);
							if ($resultMaid) {
							    if (mysqli_num_rows($resultMaid) > 0) {
							        $maid = mysqli_num_rows($resultMaid);
							    } else {
							        $maid = 0;
							    }
							}
							else {
							    $maid = 0;
							}
							
							// Media & Production Specialist
							$sqlMediaProductionSpecialist = "SELECT ID FROM Members WHERE Service = 'Media & Production Specialist' And IsLurchActive = 1 ";
							$resultMediaProductionSpecialist = mysqli_query($conn, $sqlMediaProductionSpecialist);
							if ($resultMediaProductionSpecialist) {
							    if (mysqli_num_rows($resultMediaProductionSpecialist) > 0) {
							        $mediaProductionSpecialist = mysqli_num_rows($resultMediaProductionSpecialist);
							    } else {
							        $mediaProductionSpecialist = 0;
							    }
							}
							else {
							    $mediaProductionSpecialist = 0;
							}
							
							// Masseuse
							$sqlMasseuse = "SELECT ID FROM Members WHERE Service = 'Masseuse' And IsLurchActive = 1 ";
							$resultMasseuse = mysqli_query($conn, $sqlMasseuse);
							if ($resultMasseuse) {
							    if (mysqli_num_rows($resultMasseuse) > 0) {
							        $masseuse = mysqli_num_rows($resultMasseuse);
							    } else {
							        $masseuse = 0;
							    }
							}
							else {
							    $masseuse = 0;
							}
							
							// Occupational Specialist
							$sqlOccupationalTherapist = "SELECT ID FROM Members WHERE Service = 'Occupational Specialist' And IsLurchActive = 1 ";
							$resultOccupationalTherapist = mysqli_query($conn, $sqlOccupationalTherapist);
							if ($resultOccupationalTherapist) {
							    if (mysqli_num_rows($resultOccupationalTherapist) > 0) {
							        $occupationalTherapist = mysqli_num_rows($resultOccupationalTherapist);
							    } else {
							        $occupationalTherapist = 0;
							    }
							}
							else {
							    $occupationalTherapist = 0;
							}
							
							// Personal Trainer
							$sqlPersonalTrainer = "SELECT ID FROM Members WHERE Service = 'Personal Trainer' And IsLurchActive = 1 ";
							$resultPersonalTrainer = mysqli_query($conn, $sqlPersonalTrainer);
							if ($resultPersonalTrainer) {
							    if (mysqli_num_rows($resultPersonalTrainer) > 0) {
							        $personalTrainer = mysqli_num_rows($resultPersonalTrainer);
							    } else {
							        $personalTrainer = 0;
							    }
							}
							else {
							    $personalTrainer = 0;
							}
							
							// Real Estate Specialist
							$sqlRealEstateSpecialist = "SELECT ID FROM Members WHERE Service = 'Real Estate Specialist' And IsLurchActive = 1 ";
							$resultRealEstateSpecialist = mysqli_query($conn, $sqlRealEstateSpecialist);
							if ($resultRealEstateSpecialist) {
							    if (mysqli_num_rows($resultRealEstateSpecialist) > 0) {
							        $realEstateSpecialist = mysqli_num_rows($resultRealEstateSpecialist);
							    } else {
							        $realEstateSpecialist = 0;
							    }
							}
							else {
							    $realEstateSpecialist = 0;
							}
							
							// Therapist
							$sqlTherapist = "SELECT ID FROM Members WHERE Service = 'Therapist' And IsLurchActive = 1 ";
							$resultTherapist = mysqli_query($conn, $sqlTherapist);
							if ($resultRealEstateSpecialist) {
							    if (mysqli_num_rows($resultRealEstateSpecialist) > 0) {
							        $therapist = mysqli_num_rows($resultTherapist);
							    } else {
							        $therapist = 0;
							    }
							}
							else {
							    $therapist = 0;
							}
							
							// Tutor & Training Specialist
							$sqlTutorTrainingSpecialist = "SELECT ID FROM Members WHERE Service = 'Tutor & Training Specialist' And IsLurchActive = 1 ";
							$resultTutorTrainingSpecialist = mysqli_query($conn, $sqlTutorTrainingSpecialist);
							if ($resultTutorTrainingSpecialist) {
							    if (mysqli_num_rows($resultTutorTrainingSpecialist) > 0) {
							        $tutorTrainingSpecialist = mysqli_num_rows($resultTutorTrainingSpecialist);
							    } else {
							        $tutorTrainingSpecialist = 0;
							    }
							}
							else {
							    $tutorTrainingSpecialist = 0;
							}
							?>
							
							<table>
							<tr><td>Active Service Providers By Service</td></tr>
								<tr>
									<td>
							        <font style='color:black'>Animal Care Specialist: <b><?php echo $animalCareSpecialist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Automotive Specialist: <b><?php echo $autoSpecialist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Childcare Specialist: <b><?php echo $childCareSpecialist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Childcare Specialist: <b><?php echo $barber ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Chef: <b><?php echo $chef ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Computer & App Specialist: <b><?php echo $computerAppSpecialist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Delivery Specialist: <b><?php echo $deliverySpecialist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Fashion & Design Specialist: <b><?php echo $fashionDesignSpecialist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Entertainer: <b><?php echo $entertainer ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Financial Advisor: <b><?php echo $financialAdvisor ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Handyman: <b><?php echo $handyman ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Hospice Aid: <b><?php echo $hospiceAid ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Insurance Agent: <b><?php echo $insuranceAgent ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Interior Designer: <b><?php echo $interiorDesigner ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Landscaper: <b><?php echo $landscaper ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Maid: <b><?php echo $maid ?></b></font>
							        </td>
								</tr>
								
								<tr>
									<td>
							        <font style='color:black'>Masseuse: <b><?php echo $masseuse ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Media & Production Specialist: <b><?php echo $mediaProductionSpecialist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Occupational Therapist: <b><?php echo $occupationalTherapist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Personal Trainer: <b><?php echo $personalTrainer ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Occupational Therapist: <b><?php echo $realEstateSpecialist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Therapist <b><?php echo $therapist ?></b></font>
							        </td>
								</tr>
								<tr>
									<td>
							        <font style='color:black'>Tutor & Training Specialist <b><?php echo $tutorTrainingSpecialist ?></b></font>
							        </td>
								</tr>
							</table>
						</div>
						<div>
							<h3></h3>

						<?php 
							$validated = 'false';
							} ?>

					</div>
					<div class="flex-item image fit round">
						<img src="images/pic01.jpg" alt="" />
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
					<p>
					Unauthorized access of this page is punishable to the fullest extent of local and federal law.
					All IPs accessing this page are tracked, whether direct or VPN accessed.
					</p>
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