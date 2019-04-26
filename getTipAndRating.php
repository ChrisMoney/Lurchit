<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$jobID = $_GET['JobID'];
$id = $_GET['ID'];


$sql = "SELECT  Tip, Rating
    FROM Carwash
    WHERE ID = $jobID And Customer_ID = $id ";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    
    $tipAndRating = mysqli_fetch_assoc($result);
    
    echo json_encode($tipAndRating, JSON_NUMERIC_CHECK);
}
else {
    echo http_response_code(400);
}