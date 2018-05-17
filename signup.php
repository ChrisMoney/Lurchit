<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/8/18
 * Time: 6:41 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
include_once 'helpers.php';
include_once 'email.php';

$firstName = $_GET['FirstName'];
$firstName = ucfirst(strtolower($firstName));
$lastName = $_GET['LastName'];
$lastName = ucfirst(strtolower($lastName));
$username = ucfirst($_GET['Username']);
$email = $_GET['Email'];
$password = $_GET['Password'];
$password = md5($password);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   // invalid email
   return json_encode(http_response_code(406));
}

$sql1 = "Select ID From Members Where Email = '$email' ";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1)  > 0) {
   // account already exists
   echo json_encode(http_response_code(409));
   exit;
}

$sql2 = "Select ID From Members Where Username = '$username' ";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2)  > 0) {
   // username already in use
   echo json_encode(http_response_code(406));
   exit;
}

if (strlen($firstName) > 0 && strlen($lastName) > 0 && strlen($username) > 0 && strlen($email) > 0
       && strlen($password) >= 3) {

      $sql = "Insert Into Members (FirstName, LastName, Username, Email, Password, SignupDate)
                        Values ('$firstName', '$lastName', '$username', '$email', '$password', NOW())";


      if (mysqli_query($conn, $sql)) {

         sendIntroMail($email);

         $id = mysqli_insert_id($conn);
         $id = intval($id);

         echo $id;
         
         // create profile media instance
         $sql1 = "Insert Into ProfileMedia (Member_ID, UploadDate) Values ('$id', NOW())";
         mysqli_query($conn, $sql1);
      }
      else {
         // insert login failed
         echo json_encode(http_response_code(500));
      }
   }
   else {
      // user input bad
      echo json_encode(http_response_code(400));
   }