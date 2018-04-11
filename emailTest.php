<?php
ini_set('display_errors',1);
 $email = $_GET['email'];
 
 $subject = "Please validate your email";
 $message   = "Validation info, blah blah. 2nd msg";
 $Header = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 $Header .= 'From: Flickpitch <flickpitch@flickpitch.com >' . "\r\n";
 
 if(mail($email, $subject, $message, $Header))
     
     echo "email sent";
     
     else
         
         echo "email sending fail";