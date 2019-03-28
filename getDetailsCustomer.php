<?php
header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$jobID = $_GET['JobID'];
$id = $_GET['ID'];


$sql = "SELECT ID, Customer_ID as CustomerID, Lurch_ID as LurchID,
        Carwash, Tires, Interior,
        Wax, Total, Tip, Status, WashDate, Rating, (Select Username From Members WHERE ID = Lurch_ID) as Username
    FROM Carwash 
    WHERE ID = $jobID And Customer_ID = $id ";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    
    $jobDetail = mysqli_fetch_assoc($result);
    
    $date = $jobDetail['WashDate'];
    $date = date('M/d/Y', strtotime($date));
    $jobDetail['WashDate'] = $date;
    
    echo json_encode($jobDetail, JSON_NUMERIC_CHECK);
}
else {
    echo http_response_code(400);
}