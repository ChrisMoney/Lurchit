<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/4/18
 * Time: 9:22 PM
 */

if ($env == 'PROD') {
    // use this to call connection in non function calls
    $localhost = 'localhost';
    $username = 'lurchit';
    $pass = '@Dmin10!';
    $db = 'Lurchit';
    
    $conn = mysqli_connect ($localhost, $username, $pass, $db);
    
    // use this function to pass to other functions
    function connection () {
        $localhost = 'localhost:3306';
        $username = 'lurchit';
        $pass = '@Dmin10!';
        $db = 'Lurchit';
        
        static $conn;
        if ($conn===NULL){
            $conn = mysqli_connect ($localhost, $username, $pass, $db);
        }
        return $conn;
    }
    
}
elseif ($env == 'DEV') {
    // use this to call connection in non function calls
    $localhost = 'localhost';
    $username = 'lurchit';
    $pass = '@Dmin10!';
    $db = 'LurchitDev';
    
    $conn = mysqli_connect ($localhost, $username, $pass, $db);
    
    // use this function to pass to other functions
    function connection () {
        $localhost = 'localhost:3306';
        $username = 'lurchit';
        $pass = '@Dmin10!';
        $db = 'LurchitDev';
        
        static $conn;
        if ($conn===NULL){
            $conn = mysqli_connect ($localhost, $username, $pass, $db);
        }
        return $conn;
    }
    
}

else {
    // use this to call connection in non function calls
    $localhost = 'localhost';
    $username = 'lurchit';
    $pass = '@Dmin10!';
    $db = 'Lurchit';
    
    $conn = mysqli_connect ($localhost, $username, $pass, $db);
    
    // use this function to pass to other functions
    function connection () {
        $localhost = 'localhost:3306';
        $username = 'lurchit';
        $pass = '@Dmin10!';
        $db = 'Lurchit';
        
        static $conn;
        if ($conn===NULL){
            $conn = mysqli_connect ($localhost, $username, $pass, $db);
        }
        return $conn;
    }
}



