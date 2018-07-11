<?php 

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$gender = $_GET['Gender'];
$ageMin = $_GET['AgeMin'];
$ageMax = $_GET['AgeMax'];
$white = $_GET['White'];
$black = $_GET['Black'];
$hispanic = $_GET['Hispanic'];
$nativeAmerican = $_GET['NativeAmerican'];
$asian = $_GET['Asian'];
$pacificIslander = $_GET['PacificIslsander'];

$sql = "Update Members Set 
        GenderFollower = '$gender',
        AgeMinFollower = '$ageMin',
        AgeMaxFollower = '$ageMax',
        WhiteFollower = '$white',
        BlackFollower = '$black',
        HispanicFollower = '$hispanic',
        NativeAmericanFollower = '$nativeAmerican',
        AsianFollower = '$asian',
        PacificIslsanderFollower = '$pacificIslander'
        WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    return http_response_code(200);
}
else {
    // error saving data
    return http_response_code(500);
}
?>