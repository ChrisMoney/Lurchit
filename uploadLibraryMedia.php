<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/14/18
 * Time: 11:08 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$data = json_decode(file_get_contents('php://input'), true);

$id = $data["ID"];
$media = $data['Media'];
$mediaName = uniqid().'img.png';
$type = $data['MediaType'];

// save media to file server
file_put_contents('../api/media/'.$mediaName, base64_decode($media));

$sql = "Insert INTO MediaLibrary (Member_ID, MediaName, MediaType, UploadDate) Values ('$id','$mediaName', '$type', NOW()) ";
if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}