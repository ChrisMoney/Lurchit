<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 2/9/18
 * Time: 10:16 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';

$id = $_GET['ID'];
$slim = $_GET['Slim'];
$average = $_GET['Average'];
$athletic = $_GET['Athletic'];
$plump = $_GET['Plump'];
$heavy = $_GET['Heavy'];
$overweight = $_GET['Overweight'];
$noPref = $_GET['NoPref'];
$minHeightFeet = $_GET['MinHeightFeet'];
$minHeightInches = $_GET['MinHeightInches'];
$maxHeightFeet = $_GET['MaxHeightFeet'];
$maxHeightInches = $_GET['MaxHeightInches'];
$noPref = $_GET['NoPref'];

$sql = "Update MemberPref Set Slim = '$slim', Average = '$average', Plump = '$plump', Heavy = '$heavy' Overweight = '$overweight', NoPref = '$noPref', MinHeightFeet = '$minHeightFeet', MinHeightInches = '$minHeightInches', MaxHeightFeet = '$maxHeightFeet', MaxHeightInches = '$maxHeightInches' WHERE Member_ID = $id ";
