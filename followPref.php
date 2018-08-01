<?php 

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$genderMale = $_GET['GenderFollowMale'];
$genderFemale = $_GET['GenderFollowFemale'];
$ageMin = $_GET['AgeMinFollow'];
$ageMax = $_GET['AgeMaxFollow'];
$white = $_GET['WhiteFollow'];
$black = $_GET['BlackFollow'];
$hispanic = $_GET['HispanicFollow'];
$nativeAmerican = $_GET['NativeAmericanFollow'];
$middleEastern = $_GET['MiddleEasternFollow'];
$asian = $_GET['AsianFollow'];
$pacificIslander = $_GET['PacificIslanderFollow'];
$distance = $_GET['Distance'];

if ($genderMale == 'false' && $genderFemale == 'false') {
    $genderMale = 'true';
    $genderFemale = 'true';
}

if ($white == 'false' && $black == 'false' && $hispanic == 'false' && $nativeAmerican == 'false'
    && $middleEastern == 'false' && $asian == 'false' && $pacificIslander == 'false') {
        $white = 'true';
        $black = 'true';
        $hispanic = 'true';
        $nativeAmerican = 'true';
        $middleEastern = 'true';
        $asian = 'true';
        $pacificIslander = 'true';
    }

$sql = "Update Members Set 
        GenderFollowMale = '$genderMale',
        GenderFollowFemale = '$genderFemale',
        AgeMinFollow = '$ageMin',
        AgeMaxFollow = '$ageMax',
        WhiteFollow = '$white',
        BlackFollow = '$black',
        HispanicFollow = '$hispanic',
        NativeAmericanFollow = '$nativeAmerican',
        MiddleEasternFollow = '$middleEastern',
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