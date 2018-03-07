<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/7/18
 * Time: 10:11 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$email = $_GET['Email'];
$password = $_GET['Password'];

if (strlen($password) > 1) {
    // invalid email
    $query = ", Password = '" . md5($password) ."'";
}
else {
    $query = "";
}

$sql = "Update Members Set Email = '$email' $query WHERE ID = $id";

if (mysqli_query($conn, $sql) > 0) {

    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}