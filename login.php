<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 12/29/17
 * Time: 10:19 AM
 */
header('Content-Type: application/json');

require 'connect.php';


$email = trim($_GET['email']);
$password = trim($_GET['password']);
$password = md5($password);



    $sql = "SELECT ID FROM Members WHERE Email = '$email' and Password = '$password'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        //echo "<script>alert('200');</script>";
        $row = mysqli_fetch_assoc($result);
        $ID = $row['ID'];
        return json_encode($ID);
    }
    else {
        //echo "<script>alert('400');</script>";
        return json_encode(http_response_code(204));
    }




