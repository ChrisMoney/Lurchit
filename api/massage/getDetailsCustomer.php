<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$jobID = $_GET['JobID'];
$id = $_GET['ID'];


$sql = "SELECT ID, Customer_ID as CustomerID, Lurch_ID as LurchID,
        Massage,
        Total, Tip, Status, MassageDate, Rating, (Select Username From Members WHERE ID = Lurch_ID) as Username,
        (Select Phone FROM Members WHERE ID = Lurch_ID) as Phone
    FROM Massage
    WHERE ID = $jobID And Customer_ID = $id ";

$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    
    $jobDetail = mysqli_fetch_assoc($result);
    
    $date = $jobDetail['MassageDate'];
    $date = date('M/d/Y', strtotime($date));
    $jobDetail['MassageDate'] = $date;
    
    $jobDetail['Massage'] = strval($jobDetail['Massage']);
    
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