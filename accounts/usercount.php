<?php 
require 'connect.php';

$query = "SELECT count(*) AS total FROM Members";
$result = mysqli_query($conn, $query);
$values = mysqli_fetch_assoc($result);
$num_rows = $values['total'];

$query2 = "SELECT count(*) AS total FROM Statuses";
$result2 = mysqli_query($conn, $query2);
$values2 = mysqli_fetch_assoc($result2);
$num_rows2 = $values2['total'];

echo '<h1>User count: <b>'. $num_rows.'</b></h1>';
echo '<h1>Status count: <b>'. $num_rows2.'</b></h1>';
?>