<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "Select ID as NotificationID, Job_ID as JobID, Customer_ID as CustomerID, Job, Message, New, NotificationDate
FROM Notifications 
WHERE Customer_ID = $id ";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_num_rows($result) > 0) {
    
    while ($notifications = mysqli_fetch_assoc($result)) {
        $date = $notifications['NotificationDate'];
        $date = date('M/d/Y', strtotime($date));
        $notifications['NotificationDate'] = $date;
        
        $myArray[] = $notifications;
    }
    
    echo json_encode($myArray, JSON_NUMERIC_CHECK);
}
else {
    echo http_response_code(400);
}
