<?php
header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Make, Model, Year, CarPhoto FROM Members WHERE ID = $id ";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$make = $row['Make'];
$model = $row['Model'];
$year = $row['Year'];
$carPhoto = $row['CarPhoto'];

if (strlen($make) < 1 || strlen($model) < 1 || strlen($carPhoto) < 1 || $year == 0) {
    echo json_encode(false);
}
else {
    echo json_encode(true);
}