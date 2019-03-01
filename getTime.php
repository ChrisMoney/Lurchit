<?php

header("Content-Type: application/json;charset=utf-8");

date_default_timezone_set("America/Chicago");

$var = time();
$time = date( "H",$var);


echo json_encode($time); 