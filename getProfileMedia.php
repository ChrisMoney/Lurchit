<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/9/18
 * Time: 4:58 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT MediaName FROM ProfileMedia WHERE Member_ID = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profileMedia = $row['MediaName'];
    $mediaUrl = "http://api.flickpitch.com/api/media/$profileMedia";
    echo $mediaUrl;
}
else {
    $mediaUrl = "http://api.flickpitch.com/api/images/default_profile_image.png";
    echo $mediaUrl;
}
