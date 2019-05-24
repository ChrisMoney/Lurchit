<?php
header("Content-Type: application/json;charset=utf-8");
require '../connect.php';

$jobID = $_GET['JobID'];


a:

$sql = "SELECT Lurch_ID, Status
FROM Carwash
WHERE ID = $jobID ";


$result = mysqli_query($conn, $sql);
$lurch = mysqli_fetch_assoc($result);
$currentLurchID = $lurch['Lurch_ID'];
$status = $lurch['Status'];
$lurchID = 0;

if ($status != "accepted") {
    goto a;
    // $lurchID = $lurch['Lurch_ID'];
    
}
else {
    $lurchID = $currentLurchID;
    echo $lurchID;
}





