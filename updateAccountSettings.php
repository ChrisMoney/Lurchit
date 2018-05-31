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
$username = $_GET['Username'];

if (strlen($password) > 1) {
    // invalid email
    $query = ", Password = '" . md5($password) ."'";
}
else {
    $query = "";
}

if (strlen($username) > 1) {
    $sql1 = "SELECT Username FROM Members WHERE Username = '$username' And ID != $id ";
    $result = mysqli_query($conn, $sql1);
    $count = mysqli_num_rows($result);
    
    if ($count > 0) {
        echo http_response_code(400);
        exit;
    }
    else {
        $sql2 = "SELECT Username FROM Members WHERE Username = '$username' And ID = $id ";
        $result2 = mysqli_query($conn, $sql2);
        $count = mysqli_num_rows($result2);
        
        if ($count == 0) {
            $sql3 = "Update Members Set Username = '$username' WHERE ID = $id ";
            mysqli_query($conn, $sql3);
        }
    }
}

$sql = "Update Members Set Email = '$email' $query WHERE ID = $id";

if (mysqli_query($conn, $sql) > 0) {

    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}