<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$sql = "SELECT IsLurch, IsLurchActive FROM Members WHERE ID = $id";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    $status = mysqli_fetch_assoc($result);
    
    $isLurch = $status['IsLurch'];
    $IsLurchActive = $status['IsLurchActive'];
    $lurchStatus = false;
    
    if ($isLurch == 1 && $IsLurchActive == 1) {
        $lurchStatus = true;
    }
    
    echo json_encode($lurchStatus);
}
else {
    echo json_encode(http_response_code(500));
}

