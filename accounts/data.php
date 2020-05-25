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

$v = $_GET['v'];

if ($v == 't') {
	$validated = 'true';
}
else {
	$validated = 'false';
}

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

							$sql6 = "SELECT ID FROM SignupHits WHERE DATE_FORMAT(HitDate, '%Y-%m-%d') = CURDATE()";
							//$sql6 = "SELECT ID FROM SignupHits WHERE DATE(HitDate) = DATE(NOW() - INTERVAL 1 DAY)";
							$result6 = mysqli_query($conn, $sql6);
							$count6 = mysqli_num_rows($result6);
							?>
	
                            <table>
                                <tr>
                                    <td>
                                     <span style='color:black'>Today's signups: <b><?php echo $count ?></b></span> 
							        </td>
						        </tr>
						        <tr>
                                    <td>
                                     <span style='color:black'>Total Members: <b><?php echo $count1 ?></b></span> 
							        </td>
						        </tr>
						       
							     <tr>
							        <td>
							        <span style='color:black'>Total Service Searches: <b><?php echo $count4 ?></b></span>
							        </td>
							    </tr>
							     <tr>
							        <td>
							        <span style='color:black'>Total Service Requests: <b><?php echo $count5 ?></b></span>
							        </td>
							    </tr>
							    
							     <tr>
							        <td>
							        <span style='color:black'>Total Service Providers: <b><?php echo $count2 ?></b></span>
							        </td>
							    </tr>
							     <tr>
							        <td>
							        <span style='color:black'>Total Active Service Providers: <b><?php echo $count3 ?></b></span>
							        </td>
							    </tr>
								<tr>
							        <td>
							        <span style='color:black'>Web Signup Hits: <b><?php echo $count6 ?></b></span>
							        </td>
							    </tr>
						    </table>
							
							
							<?php 
							
							// Animal Care 
							$sqlAnimalCare = "SELECT ID FROM Members WHERE Service = 'Animal Care' And IsLurchActive = 1 ";
							$resultAnimalCare = mysqli_query($conn, $sqlAnimalCare);
							if ($resultAnimalCare) {
							    if (mysqli_num_rows($resultAnimalCare) > 0) {
							        $animalCare = mysqli_num_rows($resultAnimalCare);
							    } else {
							        $animalCare= 0;
							    }
							} 
							else {
							    $animalCare = 0;
							}
							
							// Arts & Entertainment
							$sqlArtsEntertainment = "SELECT ID FROM Members WHERE Service = 'Arts & Entertainment' And IsLurchActive = 1 ";
							$resultArtsEntertainment = mysqli_query($conn, $sqlArtsEntertainment);
							if ($resultArtsEntertainment) {
							    if (mysqli_num_rows($resultArtsEntertainment) > 0) {
							        $artsEntertainment = mysqli_num_rows($resultArtsEntertainment);
							    } else {
							        $artsEntertainment = 0;
							    }
							}
							else {
							    $artsEntertainment = 0;
							}

							// Auto Specialist
							$sqlAutomotive = "SELECT ID FROM Members WHERE Service = 'Automotive' And IsLurchActive = 1 ";
							$resultAutomotive = mysqli_query($conn, $sqlAutomotive);
							if ($resultAutomotive) {
							    if (mysqli_num_rows($resultAutomotive) > 0) {
							        $automotive = mysqli_num_rows($resultAutomotive);
							    } else {
							        $automotive = 0;
							    }
							}
							else {
							    $automotive = 0;
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

							// Business
							$sqlBusiness = "SELECT ID FROM Members WHERE Service = 'Business' And IsLurchActive = 1 ";
							$resultBusiness= mysqli_query($conn, $sqlBusiness);
							if ($resultBusiness) {
							    if (mysqli_num_rows($resultBusiness) > 0) {
							        $business= mysqli_num_rows($resultBusiness);
							    } else {
							        $business = 0;
							    }
							}
							else {
							    $business = 0;
							}

							// Childcare 
							$sqlChildCare = "SELECT ID FROM Members WHERE Service = 'Childcare' And IsLurchActive = 1 ";
							$resultChildCare = mysqli_query($conn, $sqlChildCare);
							if ($resultChildCare) {
							    if (mysqli_num_rows($resultChildCare) > 0) {
							        $childCare = mysqli_num_rows($resultChildCare);
							    } else {
							        $childCare = 0;
							    }
							}
							else {
							    $childCare = 0;
							}
							
							// Cleaning
							$sqlCleaning = "SELECT ID FROM Members WHERE Service = 'Cleaning' And IsLurchActive = 1 ";
							$resultCleaning = mysqli_query($conn, $sqlCleaning);
							if ($resultCleaning) {
							    if (mysqli_num_rows($resultCleaning) > 0) {
							        $cleaning = mysqli_num_rows($resultCleaning);
							    } else {
							        $cleaning = 0;
							    }
							}
							else {
							    $cleaning = 0;
							}

							// Cosmetology
							$sqlCosmetology = "SELECT ID FROM Members WHERE Service = 'Cosmetology' And IsLurchActive = 1 ";
							$resultCosmetology = mysqli_query($conn, $sqlCosmetology);
							if ($resultCosmetology) {
								if (mysqli_num_rows($resultCosmetology) > 0) {
									$cosmetology = mysqli_num_rows($resultCosmetology);
								} else {
									$cosmetology = 0;
								}
							}
							else {
								$cosmetology = 0;
							}
								
							// Education
							$sqlEducation = "SELECT ID FROM Members WHERE Service = 'Education' And IsLurchActive = 1 ";
							$resultEducation = mysqli_query($conn, $sqlEducation);
							if ($resultEducation) {
							    if (mysqli_num_rows($resultEducation) > 0) {
							        $education = mysqli_num_rows($resultEducation);
							    } else {
							        $education = 0;
							    }
							}
							else {
							    $education = 0;
							}
							
							// Employment
							$sqlEmployment = "SELECT ID FROM Members WHERE Service = 'Employment' And IsLurchActive = 1 ";
							$resultEmployment = mysqli_query($conn, $sqlEmployment);
							if ($resultEmployment) {
							    if (mysqli_num_rows($resultEmployment) > 0) {
							        $employment = mysqli_num_rows($resultEmployment);
							    } else {
							        $employment = 0;
							    }
							}
							else {
							    $employment = 0;
							}

							// Fashion 
							$sqlFashion = "SELECT ID FROM Members WHERE Service = 'Fashion' And IsLurchActive = 1 ";
							$resultFashion = mysqli_query($conn, $sqlFashion);
							if ($resultFashion) {
							    if (mysqli_num_rows($resultFashion) > 0) {
							        $fashion = mysqli_num_rows($resultFashion);
							    } else {
							        $fashion = 0;
							    }
							}
							else {
							    $fashion = 0;
							}
							
							// Finance
							$sqlFinance = "SELECT ID FROM Members WHERE Service = 'Finance' And IsLurchActive = 1 ";
							$resultFinance = mysqli_query($conn, $sqlFinance);
							if ($resultFinance) {
							    if (mysqli_num_rows($resultFinance) > 0) {
							        $finance = mysqli_num_rows($resultFinance);
							    } else {
							        $finance = 0;
							    }
							}
							else {
							    $finance = 0;
							}
							
							// Fitness
							$sqlFitness = "SELECT ID FROM Members WHERE Service = 'Fitness' And IsLurchActive = 1 ";
							$resultFitness = mysqli_query($conn, $sqlFitness);
							if ($resultFitness) {
							    if (mysqli_num_rows($resultFitness) > 0) {
							        $fitness = mysqli_num_rows($resultFitness);
							    } else {
							        $fitness = 0;
							    }
							}
							else {
							    $fitness = 0;
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

							// Insurance
							$sqlInsurance = "SELECT ID FROM Members WHERE Service = 'Insurance' And IsLurchActive = 1 ";
							$resultInsurance = mysqli_query($conn, $sqlInsurance);
							if ($resultInsurance) {
							    if (mysqli_num_rows($resultInsurance) > 0) {
							        $insurance = mysqli_num_rows($resultInsurance);
							    } else {
							        $insurance = 0;
							    }
							}
							else {
							    $insurance = 0;
							}

							// Interior Design
							$sqlInteriorDesign = "SELECT ID FROM Members WHERE Service = 'Interior Design' And IsLurchActive = 1 ";
							$resultInteriorDesign = mysqli_query($conn, $sqlInteriorDesign);
							if ($resultInteriorDesign) {
							    if (mysqli_num_rows($resultInteriorDesign) > 0) {
							        $interiorDesign = mysqli_num_rows($resultInteriorDesign);
							    } else {
							        $interiorDesign = 0;
							    }
							}
							else {
							    $interiorDesign = 0;
							}

							// Landscaping
							$sqlLandscaping = "SELECT ID FROM Members WHERE Service = 'Landscaping' And IsLurchActive = 1 ";
							$resultLandscaping = mysqli_query($conn, $sqlLandscaping);
							if ($resultLandscaping) {
							    if (mysqli_num_rows($resultLandscaping) > 0) {
							        $landscaping = mysqli_num_rows($resultLandscaping);
							    } else {
							        $landscaping = 0;
							    }
							}
							else {
							    $landscaping = 0;
							}

							// Massage Therapy
							$sqlMassageTherapy = "SELECT ID FROM Members WHERE Service = 'Massage Therapy' And IsLurchActive = 1 ";
							$resultMassageTherapy = mysqli_query($conn, $sqlMassageTherapy);
							if ($resultMassageTherapy) {
							    if (mysqli_num_rows($resultMassageTherapy) > 0) {
							        $massageTherapy = mysqli_num_rows($resultMassageTherapy);
							    } else {
							        $massageTherapy = 0;
							    }
							}
							else {
							    $massageTherapy = 0;
							}

							// Media & Production
							$sqlMediaProduction = "SELECT ID FROM Members WHERE Service = 'Media & Production' And IsLurchActive = 1 ";
							$resultMediaProduction = mysqli_query($conn, $sqlMediaProduction);
							if ($resultMediaProduction) {
							    if (mysqli_num_rows($resultMediaProduction) > 0) {
							        $mediaProduction = mysqli_num_rows($resultMediaProduction);
							    } else {
							        $mediaProduction = 0;
							    }
							}
							else {
							    $mediaProduction = 0;
							}
							
							// Medical Care
							$sqlMedicalCare = "SELECT ID FROM Members WHERE Service = 'Medical Care' And IsLurchActive = 1 ";
							$resultMedicalCare = mysqli_query($conn, $sqlMedicalCare);
							if ($resultMedicalCare) {
							    if (mysqli_num_rows($resultMedicalCare) > 0) {
							        $medicalCare = mysqli_num_rows($resultMedicalCare);
							    } else {
							        $medicalCare = 0;
							    }
							}
							else {
							    $medicalCare = 0;
							}

							// Mental Therapy
							$sqlMentalTherapy = "SELECT ID FROM Members WHERE Service = 'Mental Therapy' And IsLurchActive = 1 ";
							$resultMentalTherapy = mysqli_query($conn, $sqlMentalTherapy);
							if ($resultMentalTherapy) {
							    if (mysqli_num_rows($resultMentalTherapy) > 0) {
							        $mentalTherapy = mysqli_num_rows($resultMentalTherapy);
							    } else {
							        $mentalTherapy = 0;
							    }
							}
							else {
							    $mentalTherapy = 0;
							}

							// Misc Services
							$sqlMiscServices = "SELECT ID FROM Members WHERE Service = 'Misc Services' And IsLurchActive = 1 ";
							$resultMiscServices = mysqli_query($conn, $sqlMiscServices);
							if ($resultMiscServices) {
							    if (mysqli_num_rows($resultMiscServices) > 0) {
							        $miscServices = mysqli_num_rows($resultMiscServices);
							    } else {
							        $miscServices = 0;
							    }
							}
							else {
							    $miscServices = 0;
							}

							// Moving & Delivery
							$sqlMovingDelivery = "SELECT ID FROM Members WHERE Service = 'Moving & Delivery' And IsLurchActive = 1 ";
							$resultMovingDelivery = mysqli_query($conn, $sqlMovingDelivery);
							if ($resultMovingDelivery) {
							    if (mysqli_num_rows($resultMovingDelivery) > 0) {
							        $movingDelivery = mysqli_num_rows($resultMovingDelivery);
							    } else {
							        $movingDelivery = 0;
							    }
							}
							else {
							    $movingDelivery = 0;
							}
							
							// Night Life
							$sqlNightLife = "SELECT ID FROM Members WHERE Service = 'Night Life' And IsLurchActive = 1 ";
							$resultNightLife = mysqli_query($conn, $sqlNightLife);
							if ($resultNightLife) {
							    if (mysqli_num_rows($resultNightLife) > 0) {
							        $nightLife = mysqli_num_rows($resultNightLife);
							    } else {
							        $nightLife = 0;
							    }
							}
							else {
							    $nightLife = 0;
							}

							// Photography
							$sqlPhotography = "SELECT ID FROM Members WHERE Service = 'Photography' And IsLurchActive = 1 ";
							$resultPhotography = mysqli_query($conn, $sqlPhotography);
							if ($resultPhotography) {
							    if (mysqli_num_rows($resultPhotography) > 0) {
							        $photography = mysqli_num_rows($resultPhotography);
							    } else {
							        $photography = 0;
							    }
							}
							else {
							    $photography = 0;
							}

							// Real Estate 
							$sqlRealEstate = "SELECT ID FROM Members WHERE Service = 'Real Estate' And IsLurchActive = 1 ";
							$resultRealEstate = mysqli_query($conn, $sqlRealEstate);
							if ($resultRealEstate) {
							    if (mysqli_num_rows($resultRealEstate) > 0) {
							        $realEstate = mysqli_num_rows($resultRealEstate);
							    } else {
							        $realEstate = 0;
							    }
							}
							else {
							    $realEstate = 0;
							}
							
							// Restaurant & Food Service
							$sqlRestaurantFoodServices = "SELECT ID FROM Members WHERE Service = 'Restaurant & Food Services' And IsLurchActive = 1 ";
							$resultRestaurantFoodServices = mysqli_query($conn, $sqlRestaurantFoodServices);
							if ($resultRestaurantFoodServices) {
							    if (mysqli_num_rows($resultRestaurantFoodServices) > 0) {
							        $restaurantFoodServices = mysqli_num_rows($resultRestaurantFoodServices);
							    } else {
							        $resultRestaurantFoodServices = 0;
							    }
							}
							else {
							    $resultRestaurantFoodServices = 0;
							}
							
							// Technology
							$sqlTechnology = "SELECT ID FROM Members WHERE Service = 'Technology' And IsLurchActive = 1 ";
							$resultTechnology = mysqli_query($conn, $sqlTechnology);
							if ($resultTechnology) {
							    if (mysqli_num_rows($resultTechnology) > 0) {
							        $technology = mysqli_num_rows($resultTechnology);
							    } else {
							        $technology = 0;
							    }
							}
							else {
							    $technology = 0;
							}
							
							
							?>
							
							<table>
							<tr><td>Active Service Providers By Service</td></tr>
								<tr>
									<td>
							        <span style='color:black'>Animal Care: <b><?php echo $animalCare ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Arts & Entertainment: <b><?php echo $artsEntertainment ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Automotive: <b><?php echo $automotive ?></b></span>
							        </td>
								</tr>
								<tr>
									<td>
							        <span style='color:black'>Barber: <b><?php echo $barber ?></b></span>
							        </td>
								</tr>
								<tr>
									<td>
							        <span style='color:black'>Business: <b><?php echo $business ?></b></span>
							        </td>
								</tr>
								<tr>
									<td>
							        <span style='color:black'>Childcare: <b><?php echo $childCare ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Cleaning: <b><?php echo $cleaning ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Cosmetology: <b><?php echo $cosmetology ?></b></span>
							        </td>
								</tr>
								
								<tr>
									<td>
							        <span style='color:black'>Education: <b><?php echo $education ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Employment: <b><?php echo $employment ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Fashion: <b><?php echo $fashion ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Finance: <b><?php echo $finance ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Fitness: <b><?php echo $fitness ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Handyman: <b><?php echo $handyman ?></b></span>
							        </td>
								</tr>
								
								<tr>
									<td>
							        <span style='color:black'>Insurance: <b><?php echo $insurance ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Interior Design: <b><?php echo $interiorDesign ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Landscaping: <b><?php echo $landscaping ?></b></span>
							        </td>
								</tr>
								
								
								<tr>
									<td>
							        <span style='color:black'>Massage Therapy: <b><?php echo $massageTherapy ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Media & Production: <b><?php echo $mediaProduction ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Medical Care: <b><?php echo $medicalCare ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Mental Therapy: <b><?php echo $mentalTherapy ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Misc Services: <b><?php echo $miscServices ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Moving & Delivery: <b><?php echo $movingDelivery ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Night Life: <b><?php echo $nightLife ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Photography: <b><?php echo $photography ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Real Estate: <b><?php echo $realEstate ?></b></span>
							        </td>
								</tr>
								
								<tr>
									<td>
							        <span style='color:black'>Restaurant & Food Services: <b><?php echo $restaurantFoodServices ?></b></span>
							        </td>
								</tr>

								<tr>
									<td>
							        <span style='color:black'>Technology: <b><?php echo $technology ?></b></span>
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