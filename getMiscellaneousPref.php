<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT HairBlack, HairBrown, HairBlonde, HairWhite, HairGray, HairOther, NoHairPref,
EyesBlack, EyesBrown, EyesHazel, EyesGreen, EyesBlue, EyesOther, NoEyesPref 
FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $misc = mysqli_fetch_assoc($result);
    $misc['HairBlack'] = filter_var($misc['HairBlack'], FILTER_VALIDATE_BOOLEAN);
    $misc['HairBrown'] = filter_var($misc['HairBrown'], FILTER_VALIDATE_BOOLEAN);
    $misc['HairBlonde'] = filter_var($misc['HairBlonde'], FILTER_VALIDATE_BOOLEAN);
    $misc['HairWhite'] = filter_var($misc['HairWhite'], FILTER_VALIDATE_BOOLEAN);
    $misc['HairGray'] = filter_var($misc['HairGray'], FILTER_VALIDATE_BOOLEAN);
    $misc['HairOther'] = filter_var($misc['HairOther'], FILTER_VALIDATE_BOOLEAN);
    $misc['NoHairPref'] = filter_var($misc['NoHairPref'], FILTER_VALIDATE_BOOLEAN);
    $misc['EyesBlack'] = filter_var($misc['EyesBlack'], FILTER_VALIDATE_BOOLEAN);
    $misc['EyesBrown'] = filter_var($misc['EyesBrown'], FILTER_VALIDATE_BOOLEAN);
    $misc['EyesHazel'] = filter_var($misc['EyesHazel'], FILTER_VALIDATE_BOOLEAN);
    $misc['EyesGreen'] = filter_var($misc['EyesGreen'], FILTER_VALIDATE_BOOLEAN);
    $misc['EyesBlue'] = filter_var($misc['EyesBlue'], FILTER_VALIDATE_BOOLEAN);
    $misc['EyesOther'] = filter_var($misc['EyesOther'], FILTER_VALIDATE_BOOLEAN);
    $misc['NoEyesPref'] = filter_var($misc['NoEyesPref'], FILTER_VALIDATE_BOOLEAN);
    echo json_encode($misc);
}
else {
    echo json_encode(http_response_code(500));
}