<?php
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';
require 'email.php';

$jobID = $_GET['JobID'];
$newStatus = $_GET['Status'];


$sqlCustomer = "SELECT Customer_ID FROM Carwash WHERE ID = $jobID ";
$resultCustomer = mysqli_query($conn, $sqlCustomer);
$row = mysqli_fetch_assoc($resultCustomer);
$customerID = $row['Customer_ID'];

$sqlLurch = "SELECT Lurch_ID FROM Carwash WHERE ID = $jobID ";
$resultLurch = mysqli_query($conn, $sqlLurch);
$rowLurch = mysqli_fetch_assoc($resultLurch);
$lurchID = $rowLurch['Lurch_ID'];

if ($newStatus == 'Accept') {
    $status = "accepted";
    $message = "Your job has been accepted";
    $subjectText = "has accepted your job.";
}
elseif ($newStatus == "Arrived") {
    $status = "arrived";
    $message = "Your lurch has arrived";
    $subjectText = "has arrived.";
}
else {
    $status = "complete";
    $message = "Your job is complete";
    $subjectText = "has completed your job.";
}

$sql2 = "Select Username, Email, ProfilePhoto FROM Members WHERE ID = $lurchID ";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

$name = $row2['Username'];
$email = $row2['Email'];

$profilePhoto = $row2['ProfilePhoto'];
$profilePic = ProfileMediaPath.$profilePhoto;


$subject = $name . ' '.$subjectText;
$title = "Status Update";

$sql = "Update Carwash Set Status = '$status' WHERE ID = $jobID ";

$device = "iPhone";

if (mysqli_query($conn, $sql)) {
    
    // email consumer
    sendNewMessageMail($email, $name, $profilePic, $device, $subject, $title);
    
    // push notification to consumer
    pushNotification("Job Update", $message, $customerID);
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}