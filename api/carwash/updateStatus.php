<?php
header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
require '../helpers.php';
require '../email.php';

$jobID = $_GET['JobID'];
$newStatus = $_GET['Status'];
$lurchID = $_GET['LurchID'];

$sqlCustomer = "SELECT Customer_ID FROM Carwash WHERE ID = $jobID ";
$resultCustomer = mysqli_query($conn, $sqlCustomer);
$row = mysqli_fetch_assoc($resultCustomer);
$customerID = $row['Customer_ID'];


if (strtolower($newStatus) == 'accept' || strtolower($newStatus) == 'accepted') {
    $status = "accepted";
    $message = "Your job has been accepted";
    $subjectText = "has accepted your job.";
}
elseif (strtolower($newStatus) == "arrived") {
    $status = "arrived";
    $message = "Your lurch has arrived";
    $subjectText = "has arrived.";
}
else {
    $status = "complete";
    $message = "Your job is complete";
    $subjectText = "has completed your job.";
}

$sql2 = "Select Username, ProfilePhoto FROM Members WHERE ID = $lurchID ";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

$username = $row2['Username'];

$profilePhoto = $row2['ProfilePhoto'];
$profilePic = ProfileMediaPath.$profilePhoto;


$subject = $username . ' '.$subjectText;
$title = "Status Update";

$sql = "Update Carwash Set Status = '$status', Lurch_ID = '$lurchID' WHERE ID = $jobID ";

$device = "iPhone";

if (mysqli_query($conn, $sql)) {
    
    // update new notifications
    $sql3 = "Update Notifications Set New = 0, Lurch_ID = '$lurchID' WHERE Job_ID = $jobID ";
    mysqli_query($conn, $sql3);
    
    // email consumer
    $sqlCustomerEmail = "Select Email FROM Members WHERE ID = $customerID ";
    $resultCustomerEmail = mysqli_query($conn, $sqlCustomerEmail);
    $rowCustomerEmail = mysqli_fetch_assoc($resultCustomerEmail);
    
    $email = $rowCustomerEmail['Email'];
      
    sendNewMessageMail($email, $username, $profilePic, $device, $subject, $title);
    
    // push notification to consumer
    pushNotification("Job Update", $message, $customerID);
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}