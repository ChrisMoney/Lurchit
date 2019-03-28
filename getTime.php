<?php

header("Content-Type: application/json;charset=utf-8");

date_default_timezone_set("America/Chicago");

$state = $_GET['State'];

$centralStates = array("ND","MO","SD","NE","KS","OK","TX","MN","IA","MO","AR","LA","WI","TN","MS","LA","AL");

$pacificStates = array("WA","OR","CA","NV");

$mountainStates = array("MT","ID","UT","AZ","WY","CO","NM");

$easternStates = array("MI","IN","OH","KY","ME","VT","NY","PA","VA","NC","SC","GA","FL","NH","MA","RI","CT","NJ","DE","MD","DC");

if (in_array($state, $centralStates)) {
    $currentTime = time();
}
elseif (in_array($state, $pacificStates)) {
    $currentTime = time() - 60*60*2;
}
elseif (in_array($state, $mountainStates)) {
    $currentTime = time() - 60*60;
}
else {
    $currentTime = time() + 60*60;
}

$time = date( "H",$currentTime);


echo json_encode($time, JSON_NUMERIC_CHECK); 