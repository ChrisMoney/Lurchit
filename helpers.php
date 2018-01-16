<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/15/18
 * Time: 3:05 PM
 */

function LogEvent($error) {
    require_once 'connect.php';

    $conn = connection();

    $sql = "Insert Into LogEvent (Log, LogDate) Values ('$error', CURRENT_TIMESTAMP )";
    mysqli_query($conn, $sql);
}
