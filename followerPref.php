<?php 

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';
$id = $_GET['ID'];
$genderMale = $_GET['GenderFollowerMale'];
$genderFemale = $_GET['GenderFollowerFemale'];
$ageMin = $_GET['AgeMinFollower'];
$ageMax = $_GET['AgeMaxFollower'];
$white = $_GET['WhiteFollower'];
$black = $_GET['BlackFollower'];
$hispanic = $_GET['HispanicFollower'];
$nativeAmerican = $_GET['NativeAmericanFollower'];
$asian = $_GET['AsianFollower'];
$pacificIslander = $_GET['PacificIslanderFollower'];
$middleEastern = $_GET['MiddleEasternFollower'];

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
        GenderFollowerMale = '$genderMale',
        GenderFollowerFemale = '$genderFemale',
        AgeMinFollower = '$ageMin',
        AgeMaxFollower = '$ageMax',
        WhiteFollower = '$white',
        BlackFollower = '$black',
        HispanicFollower = '$hispanic',
        NativeAmericanFollower = '$nativeAmerican',
        AsianFollower = '$asian',
        PacificIslanderFollower = '$pacificIslander',
        MiddleEasternFollower = '$middleEastern'
        WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    return http_response_code(200);
}
else {
    // error saving data
    return http_response_code(500);
}
?>