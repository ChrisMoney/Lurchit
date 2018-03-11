<?php
/**
 * Created by PhpStorm.
 * User: chrismoney
 * Date: 1/8/18
 * Time: 6:41 AM
 */

header("Content-Type: application/json;charset=utf-8");
require 'connect.php';
require 'helpers.php';


$firstName = $_GET['FirstName'];
$firstName = ucfirst(strtolower($firstName));
$lastName = $_GET['LastName'];
$lastName = ucfirst(strtolower($lastName));
$username = $_GET['Username'];
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

          // send email
          $subject = "Thank you for signing up to Flickpitch. Start building rapport in real time with the type of people you want to date and network with using photos and videos.";
          $toEmail = $email;
          $message = "<html><body>";
          $message .= "<table style = 'background:red;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'color:white;border-radius:10px;'><td>";
          $message .= "<tr><td><img src = 'http://flickpitch.com/images/logo.jpg' height = '200' width = '200' style = 'border:2px solid black' /></td></tr>";
          $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'>$subject<br/><br/></td></tr>";
          $message .= "<tr><td style = 'background-color:red;color:white'>If you received this email in error contact us at <mailto:info@flickpitch.com>info@flickpitch.com</a>";
          $message .= "<br/>Flickpitch, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
          $message .= "</table></body></html>";

          $header = "From: Flickpitch <no-reply@flickpitch.com.com> \r\n";
          $header .= "Content-type: text/html";
          ini_set('sendmail_from', 'no-reply@flickpitch.com');

          if (mail($toEmail, 'Flickpitch Notification', $message, $header)) {
              // mail sent
          }
          else {
              echo 'mail sending failed';
          }

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