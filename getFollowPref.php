<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/5/18
 * Time: 11:21 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT GenderFollowMale, GenderFollowFemale, AgeMinFollow, AgeMaxFollow, WhiteFollow, BlackFollow,
                HispanicFollow, NativeAmericanFollow, MiddleEasternFollow, AsianFollow,
                PacificIslanderFollow, Distance FROM Members WHERE ID = $id ";


if ($result = mysqli_query($conn, $sql)) {

    $followPref = mysqli_fetch_assoc($result);
    
    $followPref['GenderFollowMale'] = filter_var($followPref['GenderFollowMale'], FILTER_VALIDATE_BOOLEAN);
    $followPref['GenderFollowFemale'] = filter_var($followPref['GenderFollowFemale'], FILTER_VALIDATE_BOOLEAN);
    $followPref['WhiteFollow'] = filter_var($followPref['WhiteFollow'], FILTER_VALIDATE_BOOLEAN);
    $followPref['BlackFollow'] = filter_var($followPref['BlackFollow'], FILTER_VALIDATE_BOOLEAN);
    $followPref['HispanicFollow'] = filter_var($followPref['HispanicFollow'], FILTER_VALIDATE_BOOLEAN);
    $followPref['NativeAmericanFollow'] = filter_var($followPref['NativeAmericanFollow'], FILTER_VALIDATE_BOOLEAN);
    $followPref['MiddleEasternFollow'] = filter_var($followPref['MiddleEasternFollow'], FILTER_VALIDATE_BOOLEAN);
    $followPref['AsianFollow'] = filter_var($followPref['AsianFollow'], FILTER_VALIDATE_BOOLEAN);
    $followPref['PacificIslanderFollow'] = filter_var($followPref['PacificIslanderFollow'], FILTER_VALIDATE_BOOLEAN);
    
    echo json_encode($followPref);
}
else {
    echo json_encode(http_response_code(500));
}

