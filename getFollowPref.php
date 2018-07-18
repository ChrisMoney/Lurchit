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

$sql = "SELECT GenderFollow, AgeMinFollow, AgeMaxFollow, WhiteFollow, BlackFollow
                HispanicFollow, NativeAmericanFollow, MiddleEasternFollow, AsianFollow,
                PacificIslanderFollow, Distance FROM Members WHERE ID = $id ";

if (mysqli_num_rows($result) > 0) {
    $followPref = mysqli_fetch_assoc($result);
    
    $followPref['WhiteFollow'] = filter_var($followPref['WhiteFollow'], FILTER_VALIDATE_BOOLEAN);
    
    echo $followPref;
}
else {
    echo json_encode(http_response_code(500));
}

