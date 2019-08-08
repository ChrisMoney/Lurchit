<?php

header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
require '../helpers.php';

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

$phoneFormat = phone_number_format($phone);
// $currentYear = date("Y");

if (strlen(trim($phoneFormat)) != 12) {
    echo http_response_code(500);
    exit;
}
//$age = $currentYear - $year;

$formattedSSN = $ssn;
$formattedSSN = preg_replace ('/[^\d]/', '', $formattedSSN);
$formattedSSN = preg_replace ('/^(\d{3})(\d{2})(\d{4})$/', '$1-$2-$3', $formattedSSN);


$sql = "Update Members Set Address = '$address', Apt = '$apt',
SSN = AES_ENCRYPT('$formattedSSN', 'ssn'), Phone = '$phoneFormat', MailCity = '$city', MailState = '$state', MailZip = '$zip',
BirthMonth = '$month', BirthDay = '$day', BirthYear = '$year'
WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    echo http_response_code(200);
}
else {
    echo http_response_code(500);
}