<?php

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$count = $_GET['Count'];

$count = $count--;
$count = max(0, $count);
echo $count;