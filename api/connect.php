<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/4/18
 * Time: 9:22 PM
 */

$localhost = 'localhost';
$username = 'lurchit';
$pass = '@Dmin10!';

if ($env == 'PROD') {
    $db = 'Lurchit';
}
elseif ($env == 'DEV') {
    $db = 'LurchitDev';
}
else {
    $db = 'Lurchit';
}

$conn = mysqli_connect ($localhost, $username, $pass, $db);


function connection ($env) {
    
    if ($env == 'PROD') {
        $db = 'Lurchit';
    }
    elseif ($env == 'DEV') {
        $db = 'LurchitDev';

    }
    else {
        $db = 'Lurchit';
    }
    
    $localhost = 'localhost:3306';
    $username = 'lurchit';
    $pass = '@Dmin10!';

    
    static $conn;
    if ($conn===NULL){
        $conn = mysqli_connect ($localhost, $username, $pass, $db);
    }
    return $conn;
}

