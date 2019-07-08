<?php

require 'connect.php';


$json = file_get_contents("php://input");
$data = json_decode($json, true);

$id = $data["ID"];
$media = $data['Media'];

$mediaName = uniqid().'img.png';

// save media to file server
file_put_contents('cars/'.$mediaName, base64_decode($media));

$sql = "Update Members Set CarPhoto = '$mediaName'
WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
