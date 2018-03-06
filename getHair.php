<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/26/18
 * Time: 7:42 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Hair FROM Members WHERE ID = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hair = $row['Hair'];
    $hair = trim($hair);
    echo $hair;
}
else {
    echo json_encode(http_response_code(500));
}