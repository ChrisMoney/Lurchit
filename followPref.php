<?php 

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$gender = $_GET['GenderFollow'];
$ageMin = $_GET['AgeMinFollow'];
$ageMax = $_GET['AgeMaxFollow'];
$white = $_GET['WhiteFollow'];
$black = $_GET['BlackFollow'];
$hispanic = $_GET['HispanicFollow'];
$nativeAmerican = $_GET['NativeAmericanFollow'];
$middleEasternFollow = $_GET['MiddleEasternFollow'];
$asian = $_GET['AsianFollow'];
$pacificIslander = $_GET['PacificIslanderFollow'];
$distance = $_GET['Distance'];

$sql = "Update Members Set 
        GenderFollow = '$gender',
        AgeMinFollow = '$ageMin',
        AgeMaxFollow = '$ageMax',
        WhiteFollow = '$white',
        BlackFollow = '$black',
        HispanicFollow = '$hispanic',
        NativeAmericanFollow = '$nativeAmerican',
        MiddleEasternFollow = '$middleEasternFollow',
        AsianFollow = '$asian',
        PacificIslanderFollow = '$pacificIslander',
        Distance = '$distance'
        WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    return http_response_code(200);
}
else {
    // error saving data
    return http_response_code(500);
}
?>