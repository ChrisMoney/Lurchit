<?php 
require 'connect.php';

$sql = "Select Count(ID) FROM Members ";

if ($result = mysqli_query($conn, $sql)) {
    $count = mysqli_num_rows($result);
    // successful
    echo '<h1>User count: '. $count. '</h1>';
}



?>