<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/9/18
 * Time: 4:13 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';


$json = file_get_contents("php://input");
$data = json_decode($json, true);



//convert the string of data to an array


$id = $data["ID"];
$media = $data['Media'];

mysqli_query($conn, "INSERT INTO LogError (Log, Date) Values ('$media', NOW())");

$mediaName = uniqid().'img.png';
//$type = $data['MediaType'];

// save media to file server
file_put_contents('media/'.$mediaName, base64_decode($media));

// save reference to media
$sql = "Update Members Set ProfilePhoto = '$mediaName' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}


