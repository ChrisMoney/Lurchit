<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 3/6/18
 * Time: 3:26 PM
 */

$id = $_GET['ID'];

$sql = "SELECT FirstName, LastName FROM Members WHERE ID = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['FirstName'] . ' '. $row['LastName'];
    echo $name . ' invited you to join Flickpitch. ';
}
else {
    echo json_encode(http_response_code(500));
}