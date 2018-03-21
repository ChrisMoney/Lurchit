<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/12/18
 * Time: 10:25 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$mediaID = $_GET['MediaID'];

$sql1 = "SELECT MediaName FROM MediaLibrary WHERE ID = $mediaID ";
$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result1);
$mediaName = $row['MediaName'];

$sql = "DELETE FROM MediaLibrary WHERE ID = '$mediaID' ";

if (mysqli_query($conn, $sql)) {
    unlink("http://api.flickpitch.com/media/$mediaName");
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}