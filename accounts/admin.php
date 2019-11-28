<?php 
$env = $_GET['ENV'];
require 'connect.php';
require 'email.php';

$lurchID = $_GET['ID'];

if (!isset($lurchID) || empty($lurchID)) {
    echo "<script>alert('member not found'); location = history.back(); </script>";
}

$sql = "SELECT FirstName, LastName, Email, Phone, 
(CASE WHEN Address IS NULL THEN '' ELSE Address END) as Address, 
(CASE WHEN Apt IS NULL THEN '' ELSE Apt END) As Apt, 
(CASE WHEN MailCity IS NULL THEN '' ELSE MailCity END) as MailCity, 
(CASE WHEN MailState IS NULL THEN '' ELSE MailState END) as MailState, 
(CASE WHEN MailZip IS NULL THEN '0' ELSE MailZip END) as MailZip, 
(CASE WHEN Gender IS NULL THEN '1' ELSE Gender END) as Gender,
(CASE WHEN SSN IS NULL THEN '' ELSE AES_DECRYPT(SSN, 'ssn') END) as SSN, 
(CASE WHEN BirthDay IS NULL THEN '0' ELSE BirthDay END) as BirthDay, 
(CASE WHEN BirthMonth IS NULL THEN '0' ELSE BirthMonth END) as BirthMonth, 
(CASE WHEN BirthYear IS NULL THEN '0' ELSE BirthYear END) as BirthYear, 
IsActive, IsLurch, IsLurchActive FROM Members m WHERE ID = $lurchID ";
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
$ssn = $row['SSN'];
$birthDay = $row['BirthDay'];
$birthMonth = $row['BirthMonth'];
$birthYear = $row['BirthYear'];
$memberStatus = $row['IsActive'];
$lurchStatus = $row['IsLurch'];
$lurchActive = $row['IsLurchActive'];
$gender = $row['Gender'];

$hasPaymentProcessing = false;

$sql2 = "SELECT (Select SUM(Total) FROM Massage WHERE Lurch_ID = $lurchID And PayStatus = 'processing') as Balance, 
        (SELECT SUM(Tip) FROM Massage WHERE Lurch_ID = $lurchID) as Tip, IsPayProcessing, IsLurch 
FROM Members WHERE ID = $lurchID ";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$total = $row2['Balance'];

if ($total > 0) {
    $hasPaymentProcessing = true;
}


if ($hasPaymentProcessing == true) {
    $balance = $row2['Balance'];
    $newBalance = $balance * 0.6;
    
    $newBalance = $newBalance;
    $balance = $newBalance;
    $tip = $row2['Tip'];
}
else {
    $balance = "$0";
    $tip = "$0";
}


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
                    
                    <!-- Address -->
                    <h3>Address: </h3>

                    <input style="max-width:50%" type = "text" name = "address" id = "address" value = "<?php echo $address ?>" />

                    <br/>
                    
                    <!-- Apt -->
                    <h3>Apt: </h3>

                    <input style="max-width:25%" type = "text" name = "apt" id = "apt" value = "<?php echo $apt ?>" />

                    <br/>
                    
                    <!-- City -->
                    <h3>City: </h3>

                    <input style="max-width:50%" type = "text" name = "city" id = "city" value = "<?php echo $city ?>" />

                    <br/>
                    
                    <h3>State: </h3>

                    <input style="max-width:25%" maxLength ="2" type = "text" name = "state" id = "state" value = "<?php echo $state ?>" />

                    <br/>
                    
                    <h3>Zip: </h3>

                    <input class="form-control" maxLength = "5" style="max-width: 25%" type = "number" name = "zip" id = "zip" value = "<?php echo $zip ?>" />
					
					<br/>
					
					<h3>SSN: </h3>

                    <input class="form-control" maxLength = "5" style="max-width: 25%" type = "text" name = "ssn" id = "ssn" value = "<?php echo $ssn ?>" />
                    
					<br/>
					
					<h3>Birthdate</h3>
					
					(Month)<input class="form-control" maxLength = "2" style="max-width: 25%" type= "number" name = "birthMonth" id = "birthMonth" value = "<?php echo $birthMonth ?>" /> <br/>
					(Day)<input class="form-control" maxLength = "2" style="max-width: 25%" type= "number" name = "birthDay" id = "birthDay" 	value = "<?php echo $birthDay ?>" /> <br/>
					(Year)<input class="form-control" maxLength = "4" style="max-width: 25%" type= "number" name = "birthYear" id = "birthYear" value = "<?php echo $birthYear ?>" /> 
                    <br/>
                    
                    <h3>Gender</h3>
                   	<select class="form-control" style = "width:25%" name="gender" id="gender">
                   		 <option value="Male" <?php if($gender=='Male') echo 'selected'; ?>>Male</option>
       					 <option value="Female" <?php if($gender=='Female') echo 'selected'; ?>>Female</option>
                	</select>
                	
                	<br/>
                	
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
                   
                   	 <hr/>
                   	 <br/>
                   	 
                    <h3>Total: </h3>
                    <input style="max-width:25%" type = "text" name = "total" id = "total" readonly = "readonly" value = "<?php echo $balance ?>" />
                   
               		<br/><br/> 
               		
               		<h3>Tips: </h3>
                    <input style="max-width:25%" type = "text" name = "total" id = "tips" readonly = "readonly" value = "<?php echo $tip ?>" />
                   
               		<br/><br/> 
                 

<br/><br/>

                     <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "process" id = "process" value = "Update Payment Records" onclick="return confirm('Are you sure you want to update this payment record ?');" />
                    
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
     $ssn = $_POST['ssn'];
     $gender = $_POST['gender'];
     $birthDay = $_POST['birthDay'];
     $birthMonth = $_POST['birthMonth'];
     $birthYear = $_POST['birthYear'];
     $memberStatus = $_POST['memberStatus'];
     $lurchStatus = $_POST['lurchStatus'];
     $lurchActive = $_POST['lurchActive'];
     
     $sql = "Update Members Set 
            FirstName = '$firstName',
            LastName = '$lastName',
            Email = '$email', 
            Address = '$address',
            Apt = '$apt',
            MailCity = '$city',
            MailState = '$state',
            MailZip = '$zip',
            Gender = '$gender',
            SSN = AES_ENCRYPT('$ssn', 'ssn'),
            BirthDay = '$birthDay',
            BirthMonth = '$birthMonth',
            BirthYear = '$birthYear',
            IsActive = '$memberStatus',
            IsLurch = '$lurchStatus',
            IsLurchActive = '$lurchActive' 
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
        // send payment processed email
        sendPaymentProcessedEmail($email);
        echo "<script>alert('Payment records updated successfully'); location = 'accounts/admin.php?ID=$lurchID' </script>";
    }
    else {
        echo "<script>alert('Payment records update failed!'); location = 'accounts/admin.php?ID=$lurchID' </script>";
    }
}
?>

	</body>
</html>

