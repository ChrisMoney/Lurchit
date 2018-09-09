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
$time = $data['Time'];
$source = $data['Source'];
$caption = $data['Caption'];

$time = date('Y-m-d H:i', $time);
$time = date('Y-m-d H:i',(strtotime ( '-5 hour' , strtotime ( $time) ) )); 

// save media to file server
file_put_contents('../api/media/'.$mediaName, base64_decode($media));

$sql = "Insert INTO MediaLibrary (Member_ID, MediaName, Caption, Source, UploadDate) Values ('$id','$mediaName', '$caption', '$source', '$time') ";
if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}