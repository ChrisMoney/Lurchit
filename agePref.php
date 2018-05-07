<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/3/18
 * Time: 3:14 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$ageMin = $_GET['AgeMin'];
$ageMax = $_GET['AgeMax'];

$sqlCheck = "SELECT ID FROM MemberPref WHERE Member_ID = $id ";
$result = mysqli_query($conn, $sqlCheck);
$count = mysqli_num_rows($result);

if ($count == 0) {
    $sql = "INSERT INTO MemberPref (Member_ID, AgeMin, AgeMax)
Values ('$id', '$ageMin', '$ageMax') ";
}
else {
    $sql = "Update MemberPref Set AgeMin = '$ageMin', AgeMax = '$ageMax' WHERE Member_ID = $id ";
}


if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}