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

if (strlen($email) <= 0 || strlen($password) <= 0) {
    echo json_encode(http_response_code(400));
    exit;
}

$password = md5($password);

    $sql = "SELECT ID, IsActive FROM Members WHERE Email = '$email' and Password = '$password' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $isActive = $row['IsActive'];
   
    if (mysqli_num_rows($result) == 0) {
        echo 400;  
    }
    elseif ($isActive == 0) {
            echo 401;
        }
        else {
            $ID = $row['ID'];
            echo $ID;  
        }

    



