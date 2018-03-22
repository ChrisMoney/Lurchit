<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$hairBlack = $_GET['HairBlack'];
$hairBrown = $_GET['HairBrown'];
$hairBlonde = $_GET['HairBlonde'];
$hairWhite = $_GET['HairWhite'];
$hairGray = $_GET['HairGray'];
$hairOther = $_GET['HairOther'];
$hairNoPref = $_GET['HairNoPref'];

$eyesBlack = $_GET['EyesBlack'];
$eyesBrown = $_GET['EyesBrown'];
$eyesHazel = $_GET['EyesHazel'];
$eyesGreen = $_GET['EyesGreen'];
$eyesBlue = $_GET['EyesBlue'];
$eyesOther = $_GET['EyesOther'];
$eyesNoPref = $_GET['EyesNoPref'];

$sql = "Update MemberPref Set 
HairBlack = '$hairBlack',
HairBrown = '$hairBrown',
HairBlonde = '$hairBlonde',
HairWhite = '$hairWhite',
HairGray = '$hairGray',
HairOther = '$hairOther',
NoHairPref = '$hairNoPref',
EyesBlack = '$eyesBlack',
EyesBrown = '$eyesBrown',
EyesHazel = '$eyesHazel',
EyesGreen = '$yesGreen',
EyesBlue = '$eyesBlue',
EyesOther = '$eyesOther',
NoEyesPref = '$eyesNoPref'
WHERE Member_ID = $id ";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}