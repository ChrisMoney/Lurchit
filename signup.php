<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/8/18
 * Time: 6:41 AM
 */

header('Content-Type: application/json');
require 'connect.php';
require 'helpers.php';



$firstName = $_GET['FirstName'];
$lastName = $_GET['LastName'];
$username = $_GET['Username'];
$email = $_GET['Email'];
$password = $_GET['Password'];
$password = md5($password);


/*if (strlen($firstName) > 0 && strlen($lastName) > 0 && strlen($username) > 0 && strlen($email) > 0
&& strlen($password) > 0) {*/

   $sql = "Insert Into Members (FirstName, LastName, Username, Email, Password)
                        Values ('$firstName', '$lastName', '$username', '$email', '$password')";

   if (mysqli_query($conn, $sql)) {
      return json_encode($ID);
   }
   else {
      // insert login failed
      return json_encode(http_response_code(204));
   }


/*}
else {
   return json_encode(http_response_code(204));
}*/





