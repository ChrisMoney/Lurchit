<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];


$sql = "DELETE FROM Members WHERE ID = '$id' ";
mysqli_query($conn, $sql);

$sql2 = "DELETE FROM ProfileMedia WHERE Member_ID = '$id' ";
mysqli_query($conn, $sql2);

$sql3 = "DELETE FROM Messages WHERE Owner_ID = '$id' Or Other_ID = '$id' ";
mysqli_query($conn, $sql3);

$sql4 = "DELETE FROM Likes WHERE Member_ID = '$id' ";
mysqli_query($conn, $sql4);