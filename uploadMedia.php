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

$id = $_GET['ID'];
$media = $_GET['Media'];
$isProfileMedia = $_GET['IsProfileMedia'];


define('UPLOAD_DIR', 'media/');
$img = $media;
$img = str_replace('data:image/png;base64,', '', $media);
$img = str_replace(' ', '+', $media);
$data = base64_decode($media);
$file = UPLOAD_DIR . uniqid() . '.png';
$success = file_put_contents($file, $data);

if ($success) {
    $sql = "Insert INTO Media (Member_ID, Media, IsProfileMedia, UploadDate) Values ($id, '$file', '$isProfileImage', NOW()) ";
    if (mysqli_query($conn, $sql)) {
        // successful
        echo http_response_code(200);
    }
    else {
        // error saving data
        echo http_response_code(500);
    }
}
else {

}

