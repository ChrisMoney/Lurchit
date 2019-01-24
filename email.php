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
          $subject = "Thank you for signing up! Use Statuz to share your thoughts, information and what you are doing with other people in your local area, and never be bord again... EVER!";
          $toEmail = $email;
         
          $message = "<html><body>";
          $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'color:background:white;border-radius:10px;'><td>";
          $message .= "<tr><td><img src = 'http://api.statuz.net/logo.png' height = '200' width = '200' /></td></tr>";
          $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'>$subject<br/><br/></td></tr>";
          $message .= "<tr><td style = 'background-color:red;padding-left:20px;padding-right:10px;color:white'>If you received this email in error contact us at <mailto:info@statuz.net>info@statuz.net</a>";
          $message .= "<br/>Statuz, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
          $message .= "</table></body></html>"; 

          $header = "From: Statuz <no-reply@statuz.net> \r\n";
          $header .= "Content-type: text/html";
          ini_set('sendmail_from', 'no-reply@statuz.net');

          if (mail($toEmail, 'Statuz Notification', $message, $header)) {
              // mail sent
              return true;
          }
          else {
              // mail sending failed
              return false;
          }
}

function sendNewMessageMail($email, $senderName, $profilePhoto, $device, $subject, $title) {
    
    if ($device == "iPhone") {
        $link = "https://itunes.apple.com/us/app/statuz/id1420098825?ls=1&mt=8";
    }
    else if ($device == "Android") {
        $link = "https://play.google.com/store/apps/details?id=com.iam.statuz";
    }
    else {
        $link = "";
    }
    
    // send email
    $toEmail = $email;
    
    $message = "<html><body>";
    $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'color:background:white;border-radius:10px;'><td>";
    $message .= "<tr><td><img src = '".$profilePhoto."' height = '200' width = '200' /></td></tr>";
    $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'><a style='font-weight:bold;font-size:20px' href='$link'>$subject</a><br/><br/></td></tr>";
    $message .= "<tr><td style = 'background-color:red;padding-left:20px;padding-right:10px;color:white'>If you received this email in error contact us at <mailto:info@statuz.net>info@statuz.net</a>";
    $message .= "<br/>Statuz, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
    $message .= "</table></body></html>";
    
    $header = "From: Statuz <no-reply@statuz.net> \r\n";
    $header .= "Content-type: text/html";
    ini_set('sendmail_from', 'no-reply@statuz.net');
    
    if (mail($toEmail, $title, $message, $header)) {
        // mail sent
        return true;
    }
    else {
        // mail sending failed
        return false;
    }
}