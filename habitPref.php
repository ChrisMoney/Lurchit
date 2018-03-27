<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/19/18
 * Time: 3:51 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$noSmoking = $_GET['NoSmoking'];
$socialSmoker = $_GET['SocialSmoker'];
$dailySmoker = $_GET['DailySmoker'];
$noSmokingPref = $_GET['NoSmokingPref'];
$noDrinking = $_GET['NoDrinking'];
$socialDrinker = $_GET['SocialDrinker'];
$dailyDrinker = $_GET['DailyDrinker'];
$noDrinkingPref = $_GET['NoDrinkingPref'];

$sql = "Update MemberPref Set 
NoSmoking = '$noSmoking', 
SocialSmoker = '$socialSmoker', 
DailySmoker = '$dailySmoker', 
NoSmokingPref = '$noSmokingPref', 
NoDrinking = '$noDrinking',
SocialDrinker = '$socialDrinker', 
DailyDrinker = '$dailyDrinker', 
NoDrinkingPref = '$noDrinkingPref' WHERE Member_ID = $id ";

if (mysqli_query($conn, $sql)) {
    // successful
    echo http_response_code(200);
}
else {
    // error saving data
    echo http_response_code(500);
}