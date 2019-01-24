<?php

header("Content-Type: application/json;charset=utf-8");

$timeStamp = $_GET['TimeStamp'];

$time = date('Y-m-d H:i:s', $timeStamp);
$time = date('Y-m-d H:i',(strtotime ( '-6 hour' , strtotime ( $time) ) )); 

$timeArray = array();
$timeArray = explode(" ", $time);

$hourArray = array();
$hourArray = explode(":", $timeArray[1]);

echo $hourArray[0]; 