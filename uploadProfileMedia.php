<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/9/18
 * Time: 4:13 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';


$data = json_decode(file_get_contents('php://input'), true);

$id = $data["ID"];
$media = $data['Media'];
$mediaName = uniqid().'img.png';
//$type = $data['MediaType'];

// save media to file server
file_put_contents('../api/media/'.$mediaName, base64_decode($media));

// save reference to media
$sql = "Update Members Set ProfilePhoto = '$mediaName' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}


