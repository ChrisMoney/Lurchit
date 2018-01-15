<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/4/18
 * Time: 9:22 PM
 */

    $localhost = 'localhost';
    $username = 'Flickpitch';
    $pass = 'admin@10';
    $db = 'Flickpitch';

    $conn = mysqli_connect($localhost,$username,$pass, $db);

    if (!$conn) {
        echo "<script>alert('failed');</script>";
        die(mysqli_error());
    }



