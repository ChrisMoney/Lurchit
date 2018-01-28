<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/28/18
 * Time: 3:36 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$month = $_GET['Month'];
$day = $_GET['Day'];
$year = $_GET['Year'];
$id = $_GET['ID'];

$currentYear = date("Y");

$age = $currentYear - $year;

$birthdate = $year ."-". $month."-". $day;

if ($age < 18) {
    // user too young
    return http_response_code(400);
}
else {
    $sql = "Update Members Set Birthdate = '$birthDate' WHERE Member_ID = $id";

    if (mysqli_query($conn, $sql)) {
        // update successful
        return http_response_code(200);
    }
    else {
        // internal error
        return http_response_code(500);
    }


}


