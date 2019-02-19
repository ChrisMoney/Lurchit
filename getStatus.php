<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$sql = "SELECT City, State, FullLocation, IsLurch, CarWash, Gas FROM Members WHERE ID = $id ";

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $status = mysqli_fetch_assoc($result);
        $status['IsLurch'] = filter_var($status['IsLurch'], FILTER_VALIDATE_BOOLEAN);
        $status['CarWash'] = filter_var($status['CarWash'], FILTER_VALIDATE_BOOLEAN);
        $status['Gas'] = filter_var($status['Gas'], FILTER_VALIDATE_BOOLEAN);
        $status['FullLocation'] = $status['City'] + ', ' + $status['State'];
        
        echo json_encode($status);
    }
    else {
        echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}


