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

$flickID = $_GET['FlickpitchID'];

$sql1 = "SELECT Flick FROM PitchDeck WHERE ID = $flickID ";
$result1 = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result1);
$flick = $row['Flick'];

$sql = "DELETE FROM PitchDeck WHERE ID = $flickID ";

if (mysqli_query($conn, $sql)) {
    unlink("http://api.flickpitch.com/flicks/$flick");
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
