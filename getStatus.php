<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$sql = "SELECT (Select SUM(Total) FROM Carwash WHERE Customer_ID = $id) as Balance, PaypalEmail, IsLurch 
FROM Members WHERE ID = $id ";

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $status = mysqli_fetch_assoc($result);
        $status['IsLurch'] = filter_var($status['IsLurch'], FILTER_VALIDATE_BOOLEAN);
        
        $status['Balance'] = money_format('$%i', $status['Balance']);
        echo json_encode($status, JSON_NUMERIC_CHECK);
    }
    else {
        echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}


