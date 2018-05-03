<?php

/*if ( function_exists( 'mail' ) )
{
    echo 'mail() is available';
}
else
{
    echo 'mail() has been disabled';
} */

function sendIntroMail($email) {
    
     // send email
          $subject = "Thank you for signing up to Flickpitch. Start building rapport in real time with the type of people you want to date and network by sharing moments from your daily life.";
          $toEmail = $email;
         
          $message = "<html><body>";
          $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'color:background:white;border-radius:10px;'><td>";
          $message .= "<tr><td><img src = 'http://api.flickpitch.com/logo.png' height = '200' width = '200' /></td></tr>";
          $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'>$subject<br/><br/></td></tr>";
          $message .= "<tr><td style = 'background-color:red;padding-left:20px;padding-right:10px;color:white'>If you received this email in error contact us at <mailto:info@flickpitch.com>info@flickpitch.com</a>";
          $message .= "<br/>Flickpitch, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
          $message .= "</table></body></html>"; 

          $header = "From: Flickpitch <no-reply@flickpitch.com.com> \r\n";
          $header .= "Content-type: text/html";
          ini_set('sendmail_from', 'no-reply@flickpitch.com');

          if (mail($toEmail, 'Flickpitch Notification', $message, $header)) {
              // mail sent
              return true;
          }
          else {
              // mail sending failed
              return false;
          }
}