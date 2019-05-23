<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$firstName = $_GET['FirstName'];
$lastName = $_GET['LastName'];
$userName = $_GET['Username'];
$email = $_GET['Email'];
$phone = $_GET['Phone'];
$password = $_GET['Password'];



$sql = "Update Members Set FirstName = '$firstName', LastName = '$lastName',
Username = '$userName', Email = '$email', Phone = '$phone' ";

if (mysqli_query($conn, $sql)) {
    
    if (strlen($password) > 1) {
        $password = md5($password);
        $sql1 = "Update Members Set Password = '$password' ";
        mysqli_query($conn, $sql1);
    }
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}




