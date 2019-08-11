<?php

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$id = $data["ID"];
$media = $data['Media'];
$env = $data['ENV'];

$mediaName = uniqid().'img.png';

// save media to file server
if ($env == "DEV") {
    file_put_contents('cars-dev/'.$mediaName, base64_decode($media));
}
else {
    file_put_contents('cars/'.$mediaName, base64_decode($media));
}


require 'connect.php';
$sql = "Update Members Set CarPhoto = '$mediaName'
WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
