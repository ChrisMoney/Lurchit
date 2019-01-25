<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$month = $_GET['Month'];
$day = $_GET['Day'];
$year = $_GET['Year'];

$ssn = $_GET['SSN'];
$address = $_GET['Address'];
$apt = $_GET['Apt'];
$id = $_GET['ID'];


// $currentYear = date("Y");

//$age = $currentYear - $year;

$birthDate = $year ."-". $month."-". $day;
$birthDate = trim($birthDate);

$sql = "Update Members Set Birthdate = '$birthDate', Address = '$address', Apt = '$apt',
SSN = '$ssn'
WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}