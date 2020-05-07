<?php

header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];

require 'connect.php';

$id = $_GET['ID'];

$sql = "SELECT IsFirstTime FROM Members WHERE ID = $id ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$isFirstTime = $row['IsFirstTime'];

echo $isFirstTime;