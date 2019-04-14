<?php 
require 'connect.php';
include_once 'helpers.php';

$jobID = $_GET['JobID'];

$sql = "SELECT * FROM Carwash c, Members m 
WHERE c.ID = $jobID";

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
$total = $row['Total'];
$wasRefunded = $row['WasRefunded'];

$disabled = "";

if ($wasRefunded == '1') {
    $disabled = "disabled";
    $color = "#d3d3d3";
}
else {
    $color = "#ff0000";
}
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
					<li><a href="index.php">Home</a></li>
				</ul>
			</nav>
			

					<!-- Content -->
					<div style="padding-left:10px">
						<h2 id="content">Refund Data</h2>
						
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
                    
                   	 
                    <h3>Refund Amount: </h3>
                    <input style="max-width:25%" type = "text" name = "total" id = "total" readonly = "readonly" value = "<?php echo $total ?>" />
                   
               		<br/><br/> 


<br/><br/>

                     <input style="background:<?php echo $color ?>;padding-left:10px;padding-right:10px;" <?php echo $disabled ?>  type = "submit" name = "process" id = "process" value = "Update Refund Status" />
                    
              </form>
              
              </div>
                  
<?php 

if (isset($_POST['process']) && $_POST['process'] == "Update Refund Status") {
    
    $sql = "Update Carwash Set WasRefunded = '1' WHERE ID = $jobID ";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Refund record updated successfully'); location = '/job-overdue.php?JobID=$jobID' </script>";
    }
    else {
        echo "<script>alert('Refund record update failed!'); location = '/job-overdue.php?JobID=$jobID' </script>";
    }
}
?>

	</body>
</html>

