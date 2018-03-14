<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/11/18
 * Time: 4:33 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT * FROM MediaLibrary WHERE Member_ID = $id Order by ID DESC ";
$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($media = mysqli_fetch_assoc($result)) {
            $mediaName = $media['MediaName'];
            $media['MediaName'] = 'http://api.flickpitch.com/media/'.$mediaName;
            /*$media['ID'] = settype($media['ID'], string);
            $media['Member_ID'] = settype($media['Member_ID'], string);
            $media['UploadDate'] = settype($media['UploadDate'], string);
            $media['Description'] = settype($media['MediaDescription'], string);*/
            $myArray[] = $media;
        }
        echo json_encode($myArray, JSON_NUMERIC_CHECK);

    }
    else {
        echo http_response_code(400);
    }
}
else {
    echo http_response_code(500);
}
