<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/8/18
 * Time: 6:41 AM
 */


header("Content-Type: application/json;charset=utf-8");
$env = $_GET['ENV'];
require 'connect.php';
include_once 'email.php';
include_once 'helpers.php';

$firstName = ucfirst($_GET['FirstName']);
$lastName = ucfirst($_GET['LastName']);
$username = ucfirst($_GET['Username']);
$email = $_GET['Email'];
$phone = $_GET['Phone'];
$phoneFormat = phone_number_format($phone);
$password = $_GET['Password'];
$password = md5($password);

$device = $_GET['DEVICE'];

$email = trim($email);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   // invalid email
   return json_encode(http_response_code(406));
}

//echo 'test';
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

if (strlen($username) > 0 && strlen($email) > 0
       && strlen($password) >= 3) {

      $sql = "Insert Into Members (FirstName, LastName,    Username, Email, Password, Phone, SignupDate)
                        Values ('$firstName', '$lastName', '$username', '$email', '$password', '$phoneFormat', NOW())";


      if (mysqli_query($conn, $sql)) {

         sendIntroMail($email, $device);

         $id = mysqli_insert_id($conn);
         $id = intval($id);

         echo $id;
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