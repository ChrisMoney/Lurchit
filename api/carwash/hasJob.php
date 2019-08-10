<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$id = $_GET['ID'];


$sql = "SELECT ID, Status FROM Carwash WHERE (Lurch_ID = $id) And (Status = 'accepted' Or Status = 'arrived') ";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) > 0) {
    
    $row['Status'] = 'true';
    $row['Status'] = filter_var($row['Status'], FILTER_VALIDATE_BOOLEAN);
}
else {
    $row['Status'] = 'false';
    $row['Status'] = filter_var($row['Status'], FILTER_VALIDATE_BOOLEAN);
    $row['ID'] = 0; 
}
    echo json_encode($row, JSON_NUMERIC_CHECK);

