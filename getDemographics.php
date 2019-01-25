<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';

$id = $_GET['ID'];

$sql = "SELECT Birthdate, Address, Apt, SSN FROM Members WHERE ID = $id";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    $demographics = mysqli_fetch_assoc($result);
    
    $birthdate = $demographics['Birthdate'];
    $birthdate = trim($birthdate);
    
    $birthdateArray = explode("-", $birthdate);
    $month = (int)$birthdateArray[1];
    $day = (int)$birthdateArray[2];
    $year = $birthdateArray[0];
    

    $demographics['Month'] = (string)$month;
    $demographics['Day'] = (string)$day;
    $demographics['Year'] = $year;

    echo json_encode($demographics);
}