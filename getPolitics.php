<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/5/18
 * Time: 12:03 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Politics FROM Members WHERE ID = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $politics = $row['Politics'];
    $politics = trim($politics);
    echo $politics;
}
else {
    echo json_encode(http_response_code(500));
}