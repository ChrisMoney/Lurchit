<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT White, Black, Hispanic, MiddleEastern, Indian, NativeAmerican, Asian, 
PacificIslander, RaceOther, NoRacePref
FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $race = mysqli_fetch_assoc($result);
    $race['White'] = filter_var($race['White'], FILTER_VALIDATE_BOOLEAN);
    $race['Black'] = filter_var($race['Black'], FILTER_VALIDATE_BOOLEAN);
    $race['Hispanic'] = filter_var($race['Hispanic'], FILTER_VALIDATE_BOOLEAN);
    $race['MiddleEastern'] = filter_var($race['MiddleEastern'], FILTER_VALIDATE_BOOLEAN);
    $race['Indian'] = filter_var($race['Indian'], FILTER_VALIDATE_BOOLEAN);
    $race['NativeAmerican'] = filter_var($race['NativeAmerican'], FILTER_VALIDATE_BOOLEAN);
    $race['Asian'] = filter_var($race['Asian'], FILTER_VALIDATE_BOOLEAN);
    $race['PacificIslander'] = filter_var($race['PacificIslander'], FILTER_VALIDATE_BOOLEAN);
    $race['RaceOther'] = filter_var($race['RaceOther'], FILTER_VALIDATE_BOOLEAN);
    $race['NoRacePref'] = filter_var($race['NoRacePref'], FILTER_VALIDATE_BOOLEAN);

    echo json_encode($race);
}
else {
    echo json_encode(http_response_code(500));
}