<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';


$id = $_GET['ID'];
$city = $_GET['City'];
$state = $_GET['State'];
$country = $_GET['Country'];


$sql = "Update Members
Set City = '$city', State = '$state', Country = '$country' WHERE ID = $id ";

if (mysqli_query($conn, $sql)) {
    // successful
    if (strlen($city) > 0) {
        echo json_encode($city .', ' . $state .' ' .$country);
    }
    else {
        echo 'Location Unavailable';
    }
}
else {
    // error saving data
    echo http_response_code(500);
}