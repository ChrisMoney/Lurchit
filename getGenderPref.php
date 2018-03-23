<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Male, Female, NoGenderPref FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $gender = mysqli_fetch_assoc($result);
    $gender['Male'] = filter_var($gender['Male'], FILTER_VALIDATE_BOOLEAN);
    $gender['Female'] = filter_var($gender['Female'], FILTER_VALIDATE_BOOLEAN);
    $gender['NoGenderPref'] = filter_var($gender['NoGenderPref'], FILTER_VALIDATE_BOOLEAN);
    echo json_encode($gender);
}
else {
    echo json_encode(http_response_code(400));
}