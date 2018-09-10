<?php 
require 'connect.php';

$query = "SELECT count(*) AS total FROM Members";
$result = mysqli_query($conn, $query);
$values = mysqli_fetch_assoc($result);
$num_rows = $values['total'];

$query2 = "SELECT count(*) AS total FROM Statuses WHERE Member_ID != 1";
$result2 = mysqli_query($conn, $query2);
$values2 = mysqli_fetch_assoc($result2);
$num_rows2 = $values2['total'];

$query3 = "SELECT SignupDate FROM Members Order By ID DESC LIMIT 1";
$result3 = mysqli_query($conn, $query3);
$values3 = mysqli_fetch_assoc($result3);
$signupDate = date_create($values3['SignupDate']);

echo '<h1>User count: <b>'. $num_rows.'</b></h1>';
echo '<h1>Status count: <b>'. $num_rows2.'</b></h1>';
echo '<h2>Last Sign Up: <b>'. date_format($signupDate, 'F j, Y, g:i a').'</b></h1>';
?>