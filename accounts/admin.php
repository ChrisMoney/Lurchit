<?php 
$env = $_GET['ENV'];
require '../api/connect.php';
require '../api/email.php';
require_once '../api/helpers.php';

$lurchID = $_GET['ID'];

if (!isset($lurchID) || empty($lurchID)) {
    echo "<script>alert('member not found'); location = history.back(); </script>";
}

$sql = "SELECT FirstName, LastName, Email, Phone,
IsActive, IsLurch, IsLurchActive, Service, Blurb, Description, MinPrice FROM Members WHERE ID = $lurchID ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$firstName = $row['FirstName'];
$lastName = $row['LastName'];
$email = $row['Email'];
$phone = $row['Phone'];
$memberStatus = $row['IsActive'];
$lurchStatus = $row['IsLurch'];
$lurchActive = $row['IsLurchActive'];
$service = $row['Service'];
$blurb = $row['Blurb'];
$description = $row['Description'];
$minPrice = $row['MinPrice'];
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Lurchit - Admin</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/main.css" />
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
			
            <?php 
              //Detect special conditions devices
                $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
                $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
                $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
                $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
                $webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

                if( $iPod || $iPhone || $iPad || $Android){ 
    
            ?>
            <table>
                <tr>
                    <td>
                   
                    <?php if( $iPod || $iPhone || $iPad){ ?>
                         <a href="https://apps.apple.com/us/app/lurchit/id1462289389?ls=1">
                        <img src="http://apilurchit.com/appstore-badge.png" height="50" width="120">
                        </a>
                    <?php } elseif ($Android) { ?>
                       <!-- <a href="https://apps.apple.com/us/app/lurchit/id1462289389?ls=1">
                        <img src="http://apilurchit.com/appstore-badge.png" height="50" width="120">
                        </a>-->
                    <?php } } ?>
                    
                    </td>
                </tr>
            </table>

                <hr/>


					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Member Data</h2>
						
						 <form method = "post" action = "" >
                     
                    <h3>First Name: </h3>

                    <input style="max-width:50%" type = "text" name = "firstName" id = "firstName" value = "<?php echo $firstName ?>" />

                    <br/>
                    
                    <h3>Last Name: </h3>

                    <input style="max-width:50%" type = "text" name = "lastName" id = "lastName"  value = "<?php echo $lastName ?>" />

                    <br/>
                    
                    <h3>Email: </h3>

                    <input style="max-width:50%" type = "text" name = "email" id = "email" value = "<?php echo $email ?>" />

                    <br/>
                    
                    <br/>
                    
                    <h3>Phone: </h3>

                    <input style="max-width:50%" maxLength = "12" type = "text" name = "phone" id = "phone" value = "<?php echo $phone ?>" />

                    <br/>

                    <?php if ($lurchStatus == 1) { ?>
                        <h3>Service</h3>
                    <select class="form-control" style="max-width:50%" name="service" id="service">
                   		 <option value="Animal Care Specialist" <?php if($service=='Animal Care Specialist') echo 'selected'; ?>>Animal Care Specialist</option>
       					 <option value="Automotive Specialist" <?php if($service=='Automotive Specialist') echo 'selected'; ?>>Automative Specialist</option>
                         <option value="Barber" <?php if($service=='Barber') echo 'selected'; ?>>Barber</option>
                         <option value="Business Services" <?php if($service =='Business Services') echo 'selected'; ?>>Business Services</option>
                         <option value="Chef" <?php if($service==='Chef') echo 'selected'; ?>>Chef</option>
                         <option value="Childcare Specialist" <?php if($service=='Childcare Specialist') echo 'selected'; ?>>Childcare Specialist</option>
                         <option value="Computer & App Specialist" <?php if($service=='Computer & App Specialist') echo 'selected'; ?>>Computer & App Specialist</option>
                         <option value="Cosmetologist" <?php if($service=='Cosmetologist') echo 'selected'; ?>>Cosmetologist</option>
                         <option value="Delivery Specialist" <?php if($service==='Delivery Specialist') echo 'selected'; ?>>Delivery Specialist</option>
                         <option value="Entertainer" <?php if($service==='Entertainer') echo 'selected'; ?>>Entertainer</option>
                         <option value="Fashion & Design Specialist" <?php if($service=='Fashion & Design Specialist') echo 'selected'; ?>>Fashion & Design Specialist</option>
                         <option value="Financial Advisor" <?php if($service==='Financial Advisor') echo 'selected'; ?>>Financial Advisor</option>
                         <option value="Handyman" <?php if($service=='Handyman') echo 'selected'; ?>>Handyman</option>
                         <option value="Hospice Aide" <?php if($service=='Hospice Aide') echo 'selected'; ?>>Hospice Aide</option>
                         <option value="Insurance Agent" <?php if($service=='Insurance Agent') echo 'selected'; ?>>Insurance Agent</option>
                         <option value="Interior Design" <?php if($service=='Interior Design') echo 'selected'; ?>>Interior Design</option>
                         <option value="Landscaper" <?php if($service=='Landscaper') echo 'selected'; ?>>Landscaper</option>
                         <option value="Maid" <?php if($service=='Maid') echo 'selected'; ?>>Maid</option>
                         <option value="Masseuse" <?php if($service=='Masseuse') echo 'selected'; ?>>Masseuse</option>
                         <option value="Media & Production Specialist" <?php if($service=='Media & Production Specialist') echo 'selected'; ?>>Media & Production Specialist</option>
                         <option value="Occupational Specialist" <?php if($service=='Occupational Specialist') echo 'selected'; ?>>Occupational Specialist</option>
                         <option value="Personal Trainer" <?php if($service=='Personal Trainer') echo 'selected'; ?>>Personal Trainer</option>
                         <option value="Real Estate Specialist" <?php if($description=='Real Estate Specialist') echo 'selected'; ?>>Real Estate Specialist</option>
                         <option value="Therapist" <?php if($service=='Therapist') echo 'selected'; ?>>Therapist</option>
                         <option value="Tutor & Training Specialist" <?php if($service=='Tutor & Training Specialist') echo 'selected'; ?>>Tutor & Training Specialist</option>
                	</select>

                    <br/>

                    <h3>Service Summary (Blurb): </h3>

                    <input style="max-width:50%" type = "text" name = "blurb" id = "blurb" maxlength="40" value = "<?php echo $blurb ?>" />

                    <br/>

                    <h3>Full Service Description: </h3>

                    <textarea style="max-width:50%" type = "text" name = "description" id = "description"><?php echo $description ?></textarea>

                    <br/>

                    <h3>Min Price: </h3>

                    <input style="max-width:50%" maxLength = "12" type = "number" name = "minPrice" id = "minPrice" value = "<?php echo $minPrice ?>" />

                    <br/>
                                        
                    <?php } ?>
                   
                     <h3>Member Status</h3>
                   	<select class="form-control" style = "width:25%" name="memberStatus" id="memberStatus">
                   		 <option value="1" <?php if($memberStatus=='1') echo 'selected'; ?>>Active</option>
       					 <option value="0" <?php if($memberStatus=='0') echo 'selected'; ?>>Inactive</option>
                	</select>
                	
                	<br/>
                	
                    <h3>Lurch Status</h3>
                   	<select class="form-control" style = "width:25%" name="lurchStatus" id="lurchStatus">
                        <option value="1" <?php if($lurchStatus=='1') echo 'selected';?>>Active</option>
       					 <option value="0" <?php if($lurchStatus=='0') echo 'selected';?>>Inactive</option>
                	</select>
                    
                     <br/>
                    
                     <h3>Lurch Active</h3>
                   	<select class="form-control" style = "width:25%" name="lurchActive" id="lurchActive">
                        <option value="1" <?php if($lurchActive=='1') echo 'selected';?>>Active</option>
       					 <option value="0" <?php if($lurchActive=='0') echo 'selected';?>>Inactive</option>
                	</select>
                	
                	<br/>
                	
					
                    <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "save" id = "save" value = "Save Data" />
                    
              </form>
              
              </div>

 
  <?php 
 
 if (isset($_POST['save']) && $_POST['save'] == "Save Data") {
    
    // Update lurch info first if member is a lurch

        $service = $_POST['service'];
        $blurb = $_POST['blurb'];
        $description = $_POST['description'];
    
         $sql1 = "Update Members Set Service = '$service', Blurb = '$blurb', Description = '$description' WHERE ID = $lurchID ";
         if (!mysqli_query($conn, $sql1)) {
            echo "<script>alert('".mysqli_error($conn)."');</script>";
         }
            
          

     $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
     
     $email = $_POST['email'];
     $email = trim($email);
     $phone = $_POST['phone'];
     $phone = phone_number_format($phone);
     $memberStatus = $_POST['memberStatus'];
     $lurchStatus = $_POST['lurchStatus'];
     $lurchActive = $_POST['lurchActive'];
     
     $sql = "Update Members Set 
            FirstName = '$firstName',
            LastName = '$lastName',
            Email = '$email', 
            Phone = '$phone',
            IsActive = '$memberStatus',
            IsLurch = '$lurchStatus',
            IsLurchActive = '$lurchActive' 
            WHERE ID = $lurchID ";
     
     
     if (mysqli_query($conn, $sql)) {
         echo "<script>alert('Member data updated successfully'); location = '/admin.php?ID=$lurchID&ENV=$env' </script>";
     }
     else {
         echo "<script>alert('Member update failed!'); location = '/admin.php?ID=$lurchID&ENV=$env' </script>";
     }
 }

 ?>
                  


	</body>
</html>

