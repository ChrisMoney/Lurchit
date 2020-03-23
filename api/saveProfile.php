<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];

require 'connect.php';

$id = $_GET['ID'];

$firstName = $_GET['FirstName'];
$lastName = $_GET['LastName'];
$userName = $_GET['Username'];
$email = $_GET['Email'];
$phone = $_GET['Phone'];
$password = $_GET['Password'];



$sql = "Update Members Set FirstName = '$firstName', LastName = '$lastName',
Username = '$userName', Email = '$email', Phone = '$phone' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    
    if ($password > 1) {
        $password = md5($password);
        $sql1 = "Update Members Set Password = '$password' WHERE ID = $id ";
        mysqli_query($conn, $sql1);
    }
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}




