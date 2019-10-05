<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$jobID = $_GET['JobID'];
$tip = $_GET['Tip'];
$lurchID = $_GET['LurchID'];

$sql = "UPDATE Massage Set Tip = '$tip' WHERE ID = $jobID ";

if (mysqli_query($conn, $sql)) {
    
    $sql2 = "INSERT INTO Tips (Job_ID, Lurch_ID, Job, Tip, IsTipPaid, TipDate) Values ('$jobID', '$lurchID', 'Massage', '$tip', '0', NOW()) ";
    
    if (mysqli_query($conn, $sql2)) {
        echo http_response_code(200);
    }
    else {
        echo http_response_code(500);
    }
}