<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Slim, Average, Athletic, Curvy, Heavy, Overweight, NoAppearancePref, MinHeightFeet, MinHeightInches,
MaxHeightFeet, MaxHeightInches FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $appearance = mysqli_fetch_assoc($result);
    $appearance['Slim'] = filter_var($appearance['Slim'], FILTER_VALIDATE_BOOLEAN);
    $appearance['Average'] = filter_var($appearance['Average'], FILTER_VALIDATE_BOOLEAN);
    $appearance['Athletic'] = filter_var($appearance['Athletic'], FILTER_VALIDATE_BOOLEAN);
    $appearance['Curvy'] = filter_var($appearance['Curvy'], FILTER_VALIDATE_BOOLEAN);
    $appearance['Heavy'] = filter_var($appearance['Heavy'], FILTER_VALIDATE_BOOLEAN);
    $appearance['Overweight'] = filter_var($appearance['Overweight'], FILTER_VALIDATE_BOOLEAN);
    $appearance['NoAppearancePref'] = filter_var($appearance['NoAppearancePref'], FILTER_VALIDATE_BOOLEAN);
    echo json_encode($appearance);
}
else {
    echo json_encode(http_response_code(400));
}