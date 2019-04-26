<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "Select ID as JobID, Customer_ID as CustomerID, Carwash, WashDate, Status
FROM Carwash 
WHERE Customer_ID = $id 
Order By ID Desc ";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_num_rows($result) > 0) {
    
    while ($summons = mysqli_fetch_assoc($result)) {
        $date = $summons['WashDate'];
        $date = date('M/d/Y', strtotime($date));
        $summons['WashDate'] = $date;
        $status = $summons['Status'];
        
        $displayString = "Carwash:  $date  Status: $status ";
        $summons['Status'] = $displayString;
        
        $myArray[] = $summons;
    }
    
    echo json_encode($myArray, JSON_NUMERIC_CHECK);
}
else {
    echo http_response_code(400);
}
