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
$type = $data['MediaType'];

// save media to file server
file_put_contents('../api/media/'.$mediaName, base64_decode($media));

// save reference to media
$sql1 = "SELECT ID FROM ProfileMedia WHERE Member_ID = '$id' ";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) > 0) {
    // update
    $sql = "Update ProfileMedia Set MediaName = '$mediaName', Type = '$type', UploadDate = NOW() WHERE Member_ID = '$id' ";
    if (mysqli_query($conn, $sql)) {
        // successful
        $sql1 = "Insert INTO MediaLibrary (Member_ID, MediaName, Source, UploadDate) Values ('$id','$mediaName', '$type', NOW()) ";
        if (mysqli_query($conn, $sql1)) {
            echo http_response_code(200);
        }
    }
    else {
        // error saving data
        echo http_response_code(500);
    }
}
else {
    // insert new record
    $sql = "Insert INTO ProfileMedia (Member_ID, MediaName, UploadDate) Values ('$id','$mediaName', NOW()) ";
    if (mysqli_query($conn, $sql)) {
        // successful
        $sql1 = "Insert INTO MediaLibrary (Member_ID, MediaName, Source, UploadDate) Values ('$id','$mediaName', '$type', NOW()) ";
        if (mysqli_query($conn, $sql1)) {
            echo http_response_code(200);
        }
    }
    else {
        // error saving data
        echo http_response_code(500);
    }
}


