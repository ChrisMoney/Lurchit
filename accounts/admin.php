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
IsActive, IsLurch, IsLurchActive FROM Members m WHERE ID = $lurchID ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$firstName = $row['FirstName'];
$lastName = $row['LastName'];
$email = $row['Email'];
$phone = $row['Phone'];
$memberStatus = $row['IsActive'];
$lurchStatus = $row['IsLurch'];
$lurchActive = $row['IsLurchActive'];
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
         echo "<script>alert('Member data updated successfully'); location = '/admin.php?ID=$lurchID' </script>";
     }
     else {
         echo "<script>alert('Member update failed!'); location = '/admin.php?ID=$lurchID' </script>";
     }
 }
  
 
 ?>
                  


	</body>
</html>

