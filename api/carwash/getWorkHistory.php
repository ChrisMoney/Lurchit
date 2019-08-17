<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$id = $_GET['ID'];

$sql = "SELECT ID as JobID, Total, Tip, PayStatus, Rating, WashDate 
FROM Carwash 
WHERE Lurch_ID = $id 
Order By ID DESC ";

$result = mysqli_query($conn, $sql);
$myArray = array();

if (mysqli_num_rows($result) > 0) {
    
    while ($workHistory = mysqli_fetch_assoc($result)) {
    
    $date = $workHistory['WashDate'];
    $date = date('M/d/Y', strtotime($date));
    $workHistory['WashDate'] = $date;
    
    $total = $workHistory['Total'];
    $total = (60 / 100) * $total;
    $total = money_format('$%i', $total);
    
    
    $tip = $workHistory['Tip'];
    $tip = money_format('$%i', $tip);
    
    $payStatus = $workHistory['PayStatus'];
    
    $washDate = $workHistory['WashDate'];
    
    $rating = $workHistory['Rating'];
    
    if ($rating == 0 || $rating == "0") {
        $rating = 'N/A';
    }
    
    $rtnString = "Job: Carwash Total: $total Tip: $tip WashDate: $washDate Pay Status: $payStatus Rating: $rating";
    
    $workHistory['Total'] = $rtnString;
    $myArray[] = $workHistory;
    }
    
    echo json_encode($myArray, JSON_PRETTY_PRINT);
}
else {
    echo http_response_code(500);
}