<?php 
require 'connect.php';

$query = "SELECT count(*) AS total FROM Members";
$result = mysqli_query($conn, $query);
$values = mysqli_fetch_assoc($result);
$num_rows = $values['total'];
echo '<h1>User count: <b>'. $num_rows.'</b></h1>';

?>