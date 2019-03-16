<?php

header("Content-Type: application/json;charset=utf-8");

require 'connect.php';
mysqli_set_charset($conn, "utf8mb4");
require 'helpers.php';
include_once 'email.php';

$data = json_decode(file_get_contents('php://input'), true);

$make = $data['Make'];
$model = $data['Model']; 
$year = $data['Year'];
$media = $data['CarPhoto'];
$hasMedia = $data['HasPhoto'];
$id = $data['ID'];
$mediaName = "";

if (($hasMedia == 'true' || $hasMedia == 1 || $hasMedia == '1' || $hasMedia == true)) {
        // save media to file server
        $mediaName = uniqid().'img.png';
        file_put_contents('../api/cars/'.$mediaName, base64_decode($media));
        $carPhotoUpdate = ", CarPhoto = '$mediaName' ";
    }
    else {
        $carPhotoUpdate = "";
    }
    
$sql = "Update Members Set Make = '$make', Model = '$model', Year = '$year' $carPhotoUpdate 
WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
