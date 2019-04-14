<?php 
require 'connect.php';
include_once 'helpers.php';

$lurchID = $_GET['ID'];

$sql = "SELECT * FROM Members m WHERE m.ID = $lurchID ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$firstName = $row['FirstName'];
$lastName = $row['LastName'];
$email = $row['Email'];
$phone = $row['Phone'];
$address = $row['Address'];
$apt = $row['Apt'];
$city = $row['MailCity'];
$state = $row['MailState'];
$zip = $row['MailZip'];
$birthdate = $row['Birthdate'];
$memberStatus = $row['IsActive'];
$lurchStatus = $row['IsLurch'];


$sql2 = "SELECT (Select SUM(Total) FROM Carwash WHERE Lurch_ID = $lurchID) as Balance,
        (SELECT SUM(Tip) FROM Carwash WHERE Lurch_ID = $lurchID) as Tip, PaypalEmail, IsPayProcessing, IsLurch,
(SELECT ID FROM Carwash WHERE PayStatus = 'unpaid' AND Lurch_ID = $lurchID LIMIT 1) As HasPaymentProcessing
FROM Members WHERE ID = $lurchID ";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$total = $row2['Balance'];

$hasPaymentProcessing = $row2['HasPaymentProcessing'];

if (strlen($hasPaymentProcessing) > 1) {
    $balance = round(60 / ($total / 100),2);
    $tip = $row2['Tip'];
}
else {
    $balance = "$0";
    $tip = "$0";
}

$paypalEmail = $row2['PaypalEmail'];
?>

<!DOCTYPE HTML>

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

                    <input style="max-width:50%" type = "text" name = "phone" id = "phone" value = "<?php echo $phone ?>" />

                    <br/>
                    
                    <!-- Address -->
                    <h3>Address: </h3>

                    <input style="max-width:100%" type = "text" name = "address" id = "address" value = "<?php echo $address ?>" />

                    <br/>
                    
                    <!-- Apt -->
                    <h3>Apt: </h3>

                    <input style="max-width:25%" type = "text" name = "apt" id = "apt" value = "<?php echo $apt ?>" />

                    <br/>
                    
                    <!-- City -->
                    <h3>City: </h3>

                    <input style="max-width:100%" type = "text" name = "city" id = "city" value = "<?php echo $city ?>" />

                    <br/>
                    
                    <h3>State: </h3>

                    <input style="max-width:25%" type = "text" name = "state" id = "state" value = "<?php echo $state ?>" />

                    <br/>
                    
                    <h3>Zip: </h3>

                    <input style="max-width:25%" type = "text" name = "zip" id = "zip" value = "<?php echo $zip ?>" />

					<br/>
					<h3>Birthdate</h3>
					
					<input style="max-width:50%" type= "text" name = "birthdate" id = "birthdate" value = "<?php echo $birthdate ?>" />
					
                    <br/>
                    
                     <h3>Member Status</h3>
                   	<select class="form-control" style = "width:25%" name="memberStatus" id="memberStatus">
                   		 <option value="1" <?php if($memberStatus=='1') echo selected;?>>Active</option>
       					 <option value="0" <?php if($memberStatus=='0') echo selected;?>>Inactive</option>
                	</select>
                	
                	<br/>
                	
                    <h3>Lurch Status</h3>
                   	<select class="form-control" style = "width:25%" name="lurchStatus" id="lurchStatus">
                        <option value="1" <?php if($lurchStatus=='1') echo selected;?>>Active</option>
       					 <option value="0" <?php if($lurchStatus=='0') echo selected;?>>Inactive</option>
                	</select>
                    
                     <br/>
                    
                    <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "save" id = "save" value = "Save Data" />
                   
                   	 <hr/>
                   	 <br/>
                   	 
                    <h3>Total: </h3>
                    <input style="max-width:25%" type = "text" name = "total" id = "total" readonly = "readonly" value = "<?php echo $balance ?>" />
                   
               		<br/><br/> 
               		
               		<h3>Tips: </h3>
                    <input style="max-width:25%" type = "text" name = "total" id = "tips" readonly = "readonly" value = "<?php echo $tip ?>" />
                   
               		<br/><br/> 
                    
                   <?php  if (filter_var($paypalEmail, FILTER_VALIDATE_EMAIL)) {
                       $hasPaypal = 'true';
  echo "Lurch has requested to receive payment via Paypal: <b>$paypalEmail</b>";
} else {
    $hasPaypal = 'false';
  echo "Lurch has elected to have their check mailed to the address above.";
}
?>

<br/><br/>

                     <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "process" id = "process" value = "Update Payment Records" />
                    
              </form>
              
              </div>

 
  <?php 
 
 if (isset($_POST['save']) && $_POST['save'] == "Save Data") {
  
       
     $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
     
     $email = $_POST['email'];
     $email = trim($email);
     
     $address = $_POST['address'];
     $apt = $_POST['apt'];
     $city = $_POST['city'];
     $state = $_POST['state'];
     $zip = $_POST['zip'];
     $newdate = strtotime($_POST['birthdate']);
     $birthdate = date('Y-m-d', $newdate);
     $memberStatus = $_POST['memberStatus'];
     $lurchStatus = $_POST['lurchStatus'];
   
     
     $sql = "Update Members Set 
            FirstName = '$firstName',
            LastName = '$lastName',
            Email = '$email', 
            Address = '$address',
            Apt = '$apt',
            MailCity = '$city',
            MailState = '$state',
            MailZip = '$zip',
            Birthdate = '$birthdate',
            IsActive = '$memberStatus',
            IsLurchActive = '$lurchStatus' 
            WHERE ID = $lurchID ";
     
     
     if (mysqli_query($conn, $sql)) {
         echo "<script>alert('Member data updated successfully'); location = '/admin.php?ID=$lurchID' </script>";
     }
     else {
         echo "<script>alert('Member update failed!'); location = '/admin.php?ID=$lurchID' </script>";
     }
 }
       
 ?>
                  
<?php 

if (isset($_POST['process']) && $_POST['process'] == "Update Payment Records") {
    
    $sql = "Update Carwash Set PayStatus = 'paid' WHERE PayStatus = 'processing' AND Lurch_ID = $lurchID ";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Payment records updated successfully'); location = '/admin.php?ID=$lurchID' </script>";
    }
    else {
        echo "<script>alert('Payment records update failed!'); location = '/admin.php?ID=$lurchID' </script>";
    }
}
?>

	</body>
</html>

