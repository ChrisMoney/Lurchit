<?php

header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
require '../helpers.php';

$lurchID = $_GET['LurchID'];

$sql = "Select n.ID as NotificationID, n.Job_ID as JobID, n.Customer_ID as CustomerID, n.Job as Job, n.Message as Message, n.New as New,
c.Status
From Notifications n, Carwash c
WHERE c.Status = 'new'
And n.Job_ID = c.ID
And n.Lurch_ID = $lurchID 
Order By n.ID Desc ";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_num_rows($result) > 0) {
    
    while ($notifications = mysqli_fetch_assoc($result)) {
    
    $myArray[] = $notifications;
    }
    
    echo json_encode($myArray, JSON_NUMERIC_CHECK);
}
else {
    echo http_response_code(400);
}
