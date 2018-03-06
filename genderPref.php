<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/9/18
 * Time: 2:48 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$male = $_GET['Male'];
$female = $_GET['Female'];
$noGenderPref = $_GET['NoGenderPref'];

$sql = "Update MemberPref Set Male = '$male', Female = '$female', NoGender = '$noGenderPref' WHERE Member_ID = $id ";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}