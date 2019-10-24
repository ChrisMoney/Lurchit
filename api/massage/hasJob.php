<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$id = $_GET['ID'];
$device = $_GET['DEVICE'];

$sql = "SELECT ID, Status FROM Massage WHERE (Lurch_ID = $id) And (Status = 'accepted' Or Status = 'arrived') ";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$row['ID'] = 0;
$row['Status'] = 'false';

if (mysqli_num_rows($result) > 0) {
    
    $row['Status'] = 'true';
    $row['Status'] = filter_var($row['Status'], FILTER_VALIDATE_BOOLEAN);
}
    echo json_encode($row, JSON_NUMERIC_CHECK);

