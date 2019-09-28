<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$jobID = $_GET['JobID'];
$id = $_GET['ID'];


$sql = "SELECT ID, Customer_ID as CustomerID, Lurch_ID as LurchID,
        Carwash, Interior,
        Wax, Total, Tip, Status, WashDate, Rating, (Select Username From Members WHERE ID = Lurch_ID) as Username,
        (Select Phone FROM Members WHERE ID = Lurch_ID) as Phone
    FROM Carwash 
    WHERE ID = $jobID And Customer_ID = $id ";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    
    $jobDetail = mysqli_fetch_assoc($result);
    
    $date = $jobDetail['WashDate'];
    $date = date('M/d/Y', strtotime($date));
    $jobDetail['WashDate'] = $date;
    
    $jobDetail['Carwash'] = strval($jobDetail['Carwash']);
    
    $phone = $jobDetail['Phone'];
    
    if (is_null($phone) || !isset($phone)) {
        $phone = "";
    }
    
    $jobDetail['Phone'] = $phone;
    
    echo json_encode($jobDetail);
}
else {
    echo http_response_code(400);
}