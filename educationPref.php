<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/9/18
 * Time: 12:45 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$highSchool = $_GET['HighSchool'];
$someCollege = $_GET['SomeCollege'];
$bachelor = $_GET['Bachelor'];
$master = $_GET['Master'];
$doctorate = $_GET['Doctorate'];
$noEducationPref = $_GET['NoEducationPref'];

$sql = "Update MemberPref Set HighSchool = '$highSchool', SomeCollege = '$someCollege', Bachelor = '$bachelor', Master = '$master', Doctorate = '$doctorate', NoEducationPref = '$noEducationPref' ";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}