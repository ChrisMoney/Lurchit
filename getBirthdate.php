<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/6/18
 * Time: 1:53 PM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "Select Birthdate FROM Members WHERE ID = $id ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $birthdate = $row['Birthdate'];
    $birthdate = trim($birthdate);
    
    $birthdateArray = explode("-", $birthdate);
    $month = (int)$birthdateArray[1];
    $day = (int)$birthdateArray[2];
    $year = $birthdateArray[0];
    
    $bDayArray = array();
    $bDayArray['Month'] = (string)$month;
    $bDayArray['Day'] = (string)$day;
    $bDayArray['Year'] = $year;
    
    echo json_encode($bDayArray);
}
else {
    echo http_response_code(500);
}