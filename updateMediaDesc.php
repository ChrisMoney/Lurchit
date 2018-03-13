<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/12/18
 * Time: 6:17 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$mediaDesc = $_GET['MediaDesc'];
$mediaID = $_GET['MediaID'];

$sql = "Update MediaLibrary Set MediaDescription = '$mediaDesc' WHERE ID = $mediaID ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}

