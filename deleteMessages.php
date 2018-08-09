<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';

$id = $_GET['ID'];
$otherID = $_GET['OtherID'];

$sql = "DELETE FROM Messages 
WHERE Owner_ID = $id and Other_ID = $otherID ";

 if (mysqli_query($conn, $sql)) {
        // successful
        echo http_response_code(200);
    }
    else {
        // error saving data
        echo http_response_code(500);
    }