<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';

$jobID = $_GET['JobID'];

$sql = "SELECT Lurch_ID, Status
FROM Massage
WHERE ID = $jobID ";


$result = mysqli_query($conn, $sql);
$lurch = mysqli_fetch_assoc($result);
$lurchID = $lurch['Lurch_ID'];
echo $lurchID;






