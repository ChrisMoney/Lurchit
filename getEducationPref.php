<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT HighSchool, SomeCollege, Bachelor, Master, Doctorate, NoEducationPref
FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $education = mysqli_fetch_assoc($result);
    $education['HighSchool'] = filter_var($education['HighSchool'], FILTER_VALIDATE_BOOLEAN);
    $education['SomeCollege'] = filter_var($education['SomeCollege'], FILTER_VALIDATE_BOOLEAN);
    $education['Bachelor'] = filter_var($education['Bachelor'], FILTER_VALIDATE_BOOLEAN);
    $education['Master'] = filter_var($education['Master'], FILTER_VALIDATE_BOOLEAN);
    $education['Doctorate'] = filter_var($education['Doctorate'], FILTER_VALIDATE_BOOLEAN);
    $education['NoEducationPref'] = filter_var($education['NoEducationPref'], FILTER_VALIDATE_BOOLEAN);
    
    echo json_encode($education);
}
else {
    echo json_encode(http_response_code(400));
}
