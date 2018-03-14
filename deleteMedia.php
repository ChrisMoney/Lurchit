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

$sql = "DELETE FROM MediaLibrary WHERE ID = '$mediaID' ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}