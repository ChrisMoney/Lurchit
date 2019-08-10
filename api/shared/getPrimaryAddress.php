<?php
$env = $_GET['ENV'];
require '../connect.php';
require '../helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Address FROM CustomerAddress WHERE Member_ID = $id And IsPrimary = 1 ";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$address = $row['Address'];
$newAddress = strval($address);

echo $newAddress;