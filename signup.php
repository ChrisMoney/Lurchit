<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/8/18
 * Time: 6:41 AM
 */

//header('Content-Type: application/json');
require 'connect.php';

$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$username = $_POST['Username'];
$email = $_POST['Email'];
$password = $_POST['Password'];
$password = md5($password);

/*$gender = $_POST['Gender'];
$birthdate = $_POST['Birthdate'];
$education = $_POST['Education'];
$heightFeet = $_POST['HeightFeet'];
$heightInches = $_POST['HeightInches'];
$build = $_POST['Build'];*/

if (strlen($firstName) > 0 && strlen($lastName) > 0 && strlen($username) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)
&& strlen($password) > 4) {
   $sql = "Insert Into Members (FirstName, LastName, Username, Email, Password)
                        Values ('$firstName', '$lastName', '$username', '$email', '$password')";

   if (mysqli_query($conn, $sql)) {
      //echo "<script>alert('400');</script>";

      $ID = mysqli_insert_id($conn);
      return json_encode($ID);
   }
   else {
      //echo "<script>alert('204');</script>";
      return json_encode(http_response_code(204));
   }
}
else {
   return json_encode(http_response_code(204));
}






