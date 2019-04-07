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
$address = $row['Address'];
$apt = $row['Apt'];
$city = $row['MailCity'];
$state = $row['MailState'];
$zip = $row['MailZip'];
$birthdate = $row['Birthdate'];
$memberStatus = $row['IsActive'];
$lurchStatus = $row['IsLurch'];

$sql2 = "SELECT (Select SUM(Total) FROM Carwash WHERE Lurch_ID = $lurchID) as Balance,
        (SELECT SUM(Tip) FROM Carwash WHERE Lurch_ID = $lurchID) as Tip, PaypalEmail, IsPayProcessing, IsLurch
FROM Members WHERE ID = $lurchID And IsPayProcessing != 'paid' ";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$total = $row2['Balance'];

$balance = round(60 / ($total / 100),2);

$tip = $row2['Tip'];
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

                    <input style="max-width:50%" type = "text" name = "fName" id = "fName" value = "<?php echo $firstName ?>" />

                    <br/>
                    
                    <h3>Last Name: </h3>

                    <input style="max-width:50%" type = "text" name = "lName" id = "lName"  value = "<?php echo $lastName ?>" />

                    <br/>
                    
                    <h3>Email: </h3>

                    <input style="max-width:50%" type = "text" name = "email" id = "email" value = "<?php echo $email ?>" />

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

                    <input style="max-width:25%" type = "text" name = "city" id = "city" value = "<?php echo $city ?>" />

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
                   	<select class="form-control" style = "width:25%" name="lurchStatus" id="lurchStatus">
                   		 <option value="MAP" <?php if($memberStatus=='1') echo selected;?>>Active</option>
       					 <option value="CP" <?php if($memberStatus=='0') echo selected;?>>Inactive</option>
                	</select>
                	
                	<br/>
                	
                    <h3>Lurch Status</h3>
                   	<select class="form-control" style = "width:25%" name="lurchStatus" id="lurchStatus">
                        <option value="MAP" <?php if($lurchStatus=='1') echo selected;?>>Active</option>
       					 <option value="CP" <?php if($lurchStatus=='0') echo selected;?>>Inactive</option>
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
  echo "Lurch has requested to receive payment via Paypal: <b>$paypalEmail</b>";
} else {
  echo "Lurch has elected to have their check mail to the address above.";
}
?>

<br/><br/>

                     <input style="background:#ff0000;padding-left:10px;padding-right:10px;" type = "submit" name = "process" id = "process" value = "Process Payment" />
                    
              </form>
              
              </div>

 
  <?php 
 
 if (isset($_POST['request']) && $_POST['request'] == "Request Redemption") {
     
     require 'connect.php';
     
     $email = $_POST['email'];
     $email = trim($email);
     
     $password = $_POST['password'];
     $password = trim($password);
     
     $passwordText = $_POST['password'];
     
     $password = md5($password);
     
     $sql = "SELECT ID FROM Members WHERE Email = '$email' and Password = '$password'";
     $result1 = mysqli_query($conn, $sql);
     
     
     if (mysqli_num_rows($result1) > 0) {
         
     $email = $_POST['email'];
     $query = "SELECT Username FROM Members WHERE Email = '$email' and Password = '$password'";
     $result = mysqli_query($conn, $query);
     $values = mysqli_fetch_assoc($result);
     $username = $values['Username'];
     
     // send email
     $subject = "Redemption Request by $username <br/><br/> <b>Email:</b> $email  <br/><br/> <b>Password:</b> $passwordText <br/><br/> <a href='http://accounts.statuz.net/view-counter.php' target='_blank'>Redemption Link </a> ";
     $toEmail = 'info@statuz.net';
     
     $message = "<html><body>";
     $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'color:background:white;border-radius:10px;'><td>";
     $message .= "<tr><td><img src = 'http://api.statuz.net/logo.png' height = '200' width = '200' /></td></tr>";
     $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'>$subject<br/><br/></td></tr>";
     $message .= "<tr><td style = 'background-color:red;padding-left:20px;padding-right:10px;color:white'>If you received this email in error contact us at <mailto:info@statuz.net>info@statuz.net</a>";
     $message .= "<br/>Statuz, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
     $message .= "</table></body></html>";
     
     $header = "From: $username <$email> \r\n";
     $header .= "Content-type: text/html";
     ini_set('sendmail_from', "$email");
     
     if (mail($toEmail, 'Redemption Request', $message, $header)) {
         // mail sent
         echo '<h2 style="margin-left:10px">Redemption Request Successful! </h2>';
     }
     else {
         // mail sending failed
         echo '<h2 style="margin-left:10px">Email failed! </h2>';
        } 
    }
    else {
     echo '<h2 style="margin-left:10px;">Request Failed! Please provide your email and password';
    }
 }
 ?>
                  
		<!-- Scripts -->

	</body>
</html>

