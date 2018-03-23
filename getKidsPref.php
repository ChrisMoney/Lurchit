<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];

$sql = "SELECT HasKids, HasNoKids, NoHasKidsPref, WantsKids, WantsNoKids, NoWantsKidsPref 
FROM MemberPref WHERE Member_ID = $id ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $kids = mysqli_fetch_assoc($result);
    $kids['HasKids'] = filter_var($kids['HasKids'], FILTER_VALIDATE_BOOLEAN);
    $kids['HasNoKids'] = filter_var($kids['HasNoKids'], FILTER_VALIDATE_BOOLEAN);
    $kids['NoHasKidsPref'] = filter_var($kids['NoHasKidsPref'], FILTER_VALIDATE_BOOLEAN);
    $kids['WantsKids'] = filter_var($kids['WantsKids'], FILTER_VALIDATE_BOOLEAN);
    $kids['WantsNoKids'] = filter_var($kids['WantsNoKids'], FILTER_VALIDATE_BOOLEAN);
    $kids['NoWantsKidsPref'] = filter_var($kids['NoWantsKidsPref'], FILTER_VALIDATE_BOOLEAN);
    echo json_encode($kids);
}
else {
    echo json_encode(http_response_code(500));
}