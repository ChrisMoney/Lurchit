<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT Christian, Muslim, Spiritual, Agnostic, Atheist, NoReligousPref,
Liberal, Conservative, Moderate, NoPoliticalPref
FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $social = mysqli_fetch_assoc($result);
    $social['Christian'] = filter_var($social['Christian'], FILTER_VALIDATE_BOOLEAN);
    $social['Muslim'] = filter_var($social['Muslim'], FILTER_VALIDATE_BOOLEAN);
    $social['Spiritual'] = filter_var($social['Spiritual'], FILTER_VALIDATE_BOOLEAN);
    $social['Agnostic'] = filter_var($social['Agnostic'], FILTER_VALIDATE_BOOLEAN);
    $social['Atheist'] = filter_var($social['Atheist'], FILTER_VALIDATE_BOOLEAN);
    $social['NoReligiousPref'] = filter_var($social['NoReligiousPref'], FILTER_VALIDATE_BOOLEAN);
    $social['Liberal'] = filter_var($social['Liberal'], FILTER_VALIDATE_BOOLEAN);
    $social['Conservative'] = filter_var($social['Conservative'], FILTER_VALIDATE_BOOLEAN);
    $social['Moderate'] = filter_var($social['Moderate'], FILTER_VALIDATE_BOOLEAN);
    $social['NoPoliticalPref'] = filter_var($social['NoPoliticalPref'], FILTER_VALIDATE_BOOLEAN);
    echo json_encode($social);
}
else {
    echo json_encode(http_response_code(500));
}