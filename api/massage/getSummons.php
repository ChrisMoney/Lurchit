<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$id = $_GET['ID'];

$sql = "Select ID as JobID, Customer_ID as CustomerID, Lurch_ID as LurchID, Massage, MassageDate, Status
FROM Massage
WHERE Customer_ID = $id 
Order By ID Desc ";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_num_rows($result) > 0) {
    
    while ($summons = mysqli_fetch_assoc($result)) {
        $date = $summons['MassageDate'];
        $date = date('M/d/Y', strtotime($date));
        $summons['MassageDate'] = $date;
        $status = $summons['Status'];
        
        $displayString = "Massage:  $date  Status: $status ";
        $summons['Status'] = $displayString;
        
        $myArray[] = $summons;
    }
    
    echo json_encode($myArray, JSON_NUMERIC_CHECK);
}
else {
    echo http_response_code(400);
}
