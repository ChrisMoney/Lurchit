<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/25/18
 * Time: 11:41 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$about = $_GET['About'];

$sql = "Update Members Set About = '$about' WHERE ID = $id ";
$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}
