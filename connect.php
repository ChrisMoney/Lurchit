<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/4/18
 * Time: 9:22 PM
 */

// use this to call connection in non function calls
    $localhost = 'localhost';
    $username = 'flickpitch';
    $pass = 'Manager@10';
    $db = 'Statuz';

    $conn = mysqli_connect ($localhost, $username, $pass, $db);

// use this function to pass to other functions
function connection () {
    $localhost = 'localhost';
    $username = 'flickpitch';
    $pass = 'Manager@10';
    $db = 'Statuz';

    static $conn;
    if ($conn===NULL){
        $conn = mysqli_connect ($localhost, $username, $pass, $db);
    }
    return $conn;
}



