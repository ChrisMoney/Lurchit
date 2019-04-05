<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$month = $_GET['Month'];
$day = $_GET['Day'];
$year = $_GET['Year'];

$ssn = $_GET['SSN'];
$address = $_GET['Address'];
$apt = $_GET['Apt'];
$city = $_GET['City'];
$state = $_GET['State'];
$phone = $_GET['Phone'];
$zip = $_GET['Zip'];
$id = $_GET['ID'];

if (strlen($address) == 0) {
    echo http_response_code(500);
    exit;
}

$phoneFormat = substr($phone,2,3)."-".substr($phone,6,3)."-".substr($phone,10,4);
// $currentYear = date("Y");

if (strlen(trim($phoneFormat)) != 10) {
    echo http_response_code(500);
    exit;
}
//$age = $currentYear - $year;

$fooA = $ssn;
$foo = preg_replace ('/[^\d]/', '', $fooA);
$foo = preg_replace ('/^(\d{3})(\d{2})(\d{4})$/', '$1-$2-$3', $foo);

$birthDate = $year ."-". $month."-". $day;
$birthDate = trim($birthDate);

if (strlen($birthDate) < 8) {
    echo http_response_code(500);
    exit;
}



$sql = "Update Members Set Birthdate = '$birthDate', Address = '$address', Apt = '$apt',
SSN = '$foo', Phone = '$phone', MailCity = '$city', MailState = '$state', MailZip = '$zip'
WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}