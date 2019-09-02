<?php
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$id = $_GET['ID'];
$device = $_GET['DEVICE'];

$sql = "SELECT Address FROM CustomerAddress WHERE Member_ID = $id And IsPrimary = 1 ";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$address = $row['Address'];
$newAddress = strval($address);

if ($device == "IOS") {
    echo $newAddress;
}
elseif ($device == "ANDROID") {
    $newAddress = mysqli_escape_string($conn, $newAddress);
    echo json_encode($newAddress);
}
else {
    echo $newAddress;
}
