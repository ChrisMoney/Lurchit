<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';

$id = $_GET['ID'];
$device = $_GET['DEVICE'];

$sql1 = "SELECT PayStatus FROM Massage WHERE Lurch_ID = $id AND PayStatus = 'processing' LIMIT 1 ";
$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result1);

$payStatus = $row['PayStatus'];

if (strlen($payStatus) && !is_null($payStatus)) {
    $payStatus = 'true';
}
else {
    $payStatus = 'false';
}

$sql = "SELECT (Select SUM(Total) FROM Massage WHERE Lurch_ID = $id And PayStatus = 'unpaid') as Balance, 
        (SELECT SUM(Tip) FROM Massage WHERE Lurch_ID = $id And PayStatus = 'unpaid') as Tip, IsPayProcessing, IsLurch, IsLurchActive 
FROM Members WHERE ID = $id ";

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $status = mysqli_fetch_assoc($result);
        
        
        $status['IsLurch'] = filter_var($status['IsLurch'], FILTER_VALIDATE_BOOLEAN);
        $status['IsLurchActive'] = filter_var($status['IsLurchActive'], FILTER_VALIDATE_BOOLEAN);
        
        $balance = $status['Balance'];
        $newBalance = $balance * 0.7;
        
        $newBalance = $newBalance + $status['Tip'];
        $status['Balance'] = "$".$newBalance;
        
        $status['IsPayProcessing'] = $payStatus;
        
        echo json_encode($status);
    }
    else {
        echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}


