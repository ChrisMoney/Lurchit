<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT NoSmoking, SocialSmoker, DailySmoker, NoSmokingPref, 
NoDrinking, SocialDrinker, DailyDrinker, NoDrinkingPref
FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $habits = mysqli_fetch_assoc($result);
    $habits['NoSmoking'] = filter_var($habits['NoSmoking'], FILTER_VALIDATE_BOOLEAN);
    $habits['SocialSmoker'] = filter_var($habits['SocialSmoker'], FILTER_VALIDATE_BOOLEAN);
    $habits['DailySmoker'] = filter_var($habits['DailySmoker'], FILTER_VALIDATE_BOOLEAN);
    $habits['NoSmokingPref'] = filter_var($habits['NoSmokingPref'], FILTER_VALIDATE_BOOLEAN);
    $habits['NoDrinking'] = filter_var($habits['NoDrinking'], FILTER_VALIDATE_BOOLEAN);
    $habits['SocialDrinker'] = filter_var($habits['SocialDrinker'], FILTER_VALIDATE_BOOLEAN);
    $habits['DailyDrinker'] = filter_var($habits['DailyDrinker'], FILTER_VALIDATE_BOOLEAN);
    $habits['NoDrinkingPref'] = filter_var($habits['NoDrinkingPref'], FILTER_VALIDATE_BOOLEAN);
    echo json_encode($habits);
}
else {
    echo json_encode(http_response_code(500));
}