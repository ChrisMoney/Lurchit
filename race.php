<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$white = $_GET['White'];
$black = $_GET['Black'];
$hispanic = $_GET['Hispanic'];
$indian = $_GET['Indian'];
$middleEastern = $_GET['MiddleEastern'];
$nativeAmerican = $_GET['NativeAmerican'];
$asian = $_GET['Asian'];
$other = $_GET['RaceOther'];
$noPref = $_GET['RaceNoPref'];

$sql = "Update MemberPref Set
White = '$white',
Black = '$black',
Hispanic = '$hispanic',
MiddleEastern = '$middleEastern',
Indian = '$indian',
NativeAmerican = '$nativeAmerican',
Asian = '$asian',
RaceOther = '$other',
NoRacePref = '$noPref'
WHERE Member_ID = '$id' ";

 if (mysqli_query($conn, $sql)) {
        // successful
        echo http_response_code(200);
    }
    else {
        // error saving data
        echo http_response_code(500);
    }
