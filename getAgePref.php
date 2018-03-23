<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "Select AgeMin, AgeMax FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $ageRange = mysqli_fetch_assoc($result);
    echo json_encode($ageRange);
}
else {
    echo json_encode(http_response_code(400));
}