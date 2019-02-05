<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$month = $_GET['Month'];
$day = $_GET['Day'];
$year = $_GET['Year'];

$ssn = $_GET['SSN'];
$address = $_GET['Address'];
$apt = $_GET['Apt'];
$phone = $_GET['Phone'];
$id = $_GET['ID'];

$phone = substr($phone,2,3)."-".substr($phone,6,3)."-".substr($phone,10,4);
// $currentYear = date("Y");

//$age = $currentYear - $year;

$fooA = $ssn;
$foo = preg_replace ('/[^\d]/', '', $fooA);
$foo = preg_replace ('/^(\d{3})(\d{2})(\d{4})$/', '$1-$2-$3', $foo);

$birthDate = $year ."-". $month."-". $day;
$birthDate = trim($birthDate);

$sql = "Update Members Set Birthdate = '$birthDate', Address = '$address', Apt = '$apt',
SSN = '$foo', Phone = '$phone'
WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}