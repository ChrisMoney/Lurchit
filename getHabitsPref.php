<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Christian, Muslim, Spiritual, Agnostic, Atheist, NoReligousPref
FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $habits = mysqli_fetch_assoc($result);
    $habits['Christian'] = filter_var($habits['Christian'], FILTER_VALIDATE_BOOLEAN);
    $habits['Muslim'] = filter_var($habits['Muslim'], FILTER_VALIDATE_BOOLEAN);
    $habits['Spiritual'] = filter_var($habits['Spiritual'], FILTER_VALIDATE_BOOLEAN);
    $habits['Agnostic'] = filter_var($habits['Agnostic'], FILTER_VALIDATE_BOOLEAN);
    $habits['Atheist'] = filter_var($habits['Atheist'], FILTER_VALIDATE_BOOLEAN);
    $habits['NoReligiousPref'] = filter_var($habits['NoReligiousPref'], FILTER_VALIDATE_BOOLEAN);
    echo json_encode($habits);
}
else {
    echo json_encode(http_response_code(500));
}