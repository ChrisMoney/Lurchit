<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$sql = "SELECT IsLurch, IsLurchActive FROM Members WHERE ID = $id";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    $status = mysqli_fetch_assoc($result);
    
    $isLurch = $status['IsLurch'];
    $isLurchActive = $status['IsLurchActive'];
    
    if ($isLurch == 1) {
        $status['IsLurch'] = 'true';
    }
    else {
        $status['IsLurch'] = 'false';
    }
    
    if ($isLurchActive == 1) {
        $status['IsLurchActive'] = 'true';
    }
    else {
        $status['IsLurchActive'] = 'false';
    }
    
    echo json_encode($status);
}
else {
    echo json_encode(http_response_code(500));
}

