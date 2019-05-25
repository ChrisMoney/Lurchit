<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/28/18
 * Time: 3:36 PM
 */

header("Content-Type: application/json;charset=utf-8");
require '../connect.php';
require '../helpers.php';

$month = $_GET['Month'];
$day = $_GET['Day'];
$year = $_GET['Year'];
$id = $_GET['ID'];

$currentYear = date("Y");

$age = $currentYear - $year;

$birthDate = $year ."-". $month."-". $day;
$birthDate = trim($birthDate);

if ($age < 18) {
    // user too young
    echo http_response_code(400);
}


    $sql = "Update Members Set Birthdate = '$birthDate' WHERE ID = $id";

if (mysqli_query($conn, $sql)) {
    // update successful
    echo http_response_code(200);
} else {
    // internal error
    echo http_response_code(500);
}