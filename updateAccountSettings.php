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
$filterStatuses = $_GET['FilterStatuses'];

if (strlen($password) > 1) {
    // invalid email
    $sql = "Update Members Set Password = '" . md5($password) ."' WHERE ID = $id ";
    mysqli_query($conn, $sql);
}
else {
    $query = "";
}

if (strlen($email) > 1) {
    $sql1 = "SELECT Email FROM Members WHERE Username = '$email' And ID != $id ";
    $result = mysqli_query($conn, $sql1);
    $count = mysqli_num_rows($result);
    
    if ($count > 0) {
        echo http_response_code(401);
        exit;
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo http_response_code(402);
    }
    else
        {
            $sql3 = "Update Members Set Email = '$email' WHERE ID = $id ";
            mysqli_query($conn, $sql3);
        }
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
            $sql3 = "Update Members Set Username = '$username' WHERE ID = $id ";
            mysqli_query($conn, $sql3);
        }
    }



    $sql4 = "Update Members SET FilterStatuses = '$filterStatuses' WHERE ID = $id ";
    if (mysqli_query($conn, $sql4)) {
    
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}

