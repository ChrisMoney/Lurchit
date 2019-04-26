<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$sql1 = "SELECT PayStatus FROM Carwash WHERE Lurch_ID = $id AND PayStatus = 'processing' LIMIT 1 ";
$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result1);

$payStatus = $row['PayStatus'];

if (strlen($payStatus) && !is_null($payStatus)) {
    $payStatus = 'true';
}
else {
    $payStatus = 'false';
}

$sql = "SELECT (Select SUM(Total) FROM Carwash WHERE Lurch_ID = $id) as Balance, 
        (SELECT SUM(Tip) FROM Carwash WHERE Lurch_ID = $id) as Tip, IsPayProcessing, IsLurch 
FROM Members WHERE ID = $id And PayStatus == 'unpaid' ";

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $status = mysqli_fetch_assoc($result);
        $status['IsLurch'] = filter_var($status['IsLurch'], FILTER_VALIDATE_BOOLEAN);
        
        $balance = $status['Balance'];
        $newBalance = round(60 / ($balance / 100),2);
        
        $newBalance = $newBalance + $status['Tip'];
        $status['Balance'] = money_format('$%i', $newBalance);
        
        $status['IsPayProcessing'] = $payStatus;
        
        echo json_encode($status, JSON_NUMERIC_CHECK);
    }
    else {
        echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}


