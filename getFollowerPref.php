<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT GenderFollower, AgeMinFollower, AgeMaxFollower, WhiteFollower, BlackFollower,
                HispanicFollower, NativeAmericanFollower, MiddleEasternFollower, AsianFollower,
                PacificIslanderFollower FROM Members WHERE ID = $id ";


if ($result = mysqli_query($conn, $sql)) {
    
    $followerPref = mysqli_fetch_assoc($result);
    
    $followerPref['WhiteFollower'] = filter_var($followerPref['WhiteFollower'], FILTER_VALIDATE_BOOLEAN);
    $followerPref['BlackFollower'] = filter_var($followerPref['BlackFollower'], FILTER_VALIDATE_BOOLEAN);
    $followerPref['HispanicFollower'] = filter_var($followerPref['HispanicFollower'], FILTER_VALIDATE_BOOLEAN);
    $followerPref['NativeAmericanFollower'] = filter_var($followerPref['NativeAmericanFollower'], FILTER_VALIDATE_BOOLEAN);
    $followerPref['MiddleEasternFollower'] = filter_var($followerPref['MiddleEasternFollower'], FILTER_VALIDATE_BOOLEAN);
    $followerPref['AsianFollower'] = filter_var($followerPref['AsianFollower'], FILTER_VALIDATE_BOOLEAN);
    $followerPref['PacificIslanderFollower'] = filter_var($followerPref['PacificIslanderFollower'], FILTER_VALIDATE_BOOLEAN);
    
    echo json_encode($followerPref);
}
else {
    echo json_encode(http_response_code(500));
}

