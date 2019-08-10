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
    
    $device = "iPhone";
    if ($device == "iPhone") {
        $link = "https://apps.apple.com/us/app/lurchit/id1462289389?ls=1";
    }
    else if ($device == "Android") {
        $link = "https://play.google.com/store/apps/details?id=com.iam.statuz";
    }
    else {
        $link = "";
    }
    
     // send email
          $subject = "Thank you for signing up! Use Lurchit to request personal services and save time, be more productive and get things done wherever you are! 
                        <a href='".$link."'>Login now</a> a start making your life easier.";
          $toEmail = $email;
         
          $message = "<html><body>";
          $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'color:background:white;border-radius:10px;'><td>";
          $message .= "<tr><td><img src = 'http://apilurchit.com/logo.png' height = '200' width = '200' /></td></tr>";
          $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'>$subject<br/><br/></td></tr>";
          $message .= "<tr><td style = 'background-color:red;padding-left:20px;padding-right:10px;color:white'>If you received this email in error contact us at <mailto:info@statuz.net>info@statuz.net</a>";
          $message .= "<br/>Lurchit, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
          $message .= "</table></body></html>"; 

          $header = "From: Lurchit <no-reply@lurchit.com> \r\n";
          $header .= "Content-type: text/html";
          ini_set('sendmail_from', 'no-reply@lurchit.com');

          if (mail($toEmail, 'Lurchit Notification', $message, $header)) {
              // mail sent
              return true;
          }
          else {
              // mail sending failed
              return false;
          }
}

function sendNewMessageMail($email, $senderName, $profilePhoto, $device, $subject, $title) {
    
   
    
    // send email
    $toEmail = $email;
    
    $message = "<html><body>";
    $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'color:background:white;border-radius:10px;'><td>";
    $message .= "<tr><td><img src = '".$profilePhoto."' height = '200' width = '200' /></td></tr>";
    $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'><a style='font-weight:bold;font-size:20px' href='$link'>$subject</a><br/><br/></td></tr>";
    $message .= "<tr><td style = 'background-color:black;padding-left:20px;padding-right:10px;color:white'>If you received this email in error contact us at <mailto:info@lurchit.com>info@lurchit.com</a>";
    $message .= "<br/>Lurchit, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
    $message .= "</table></body></html>";
    
    $header = "From: Lurchit <no-reply@lurchit.com> \r\n";
    $header .= "Content-type: text/html";
    ini_set('sendmail_from', 'no-reply@lurchit.com');
    
    if (mail($toEmail, $title, $message, $header)) {
        // mail sent
        return true;
    }
    else {
        // mail sending failed
        return false;
    }
}

function sendRequestPaymentEmail($email, $lurchID, $env) {
    
    // send email
    $subject = "<a href='http://accounts.apilurchit.com/admin.php?ID=$lurchID&ENV=$env'>Click here to process payment</a>";
    $toEmail = $email;
    
    $message = "<html><body>";
    $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'border-radius:10px;'><td>";
    $message .= "<tr><td><img src = 'http://apilurchit.com/logo.jpg' height = '200' width = '200' style='padding-left:10px' /></td></tr>";
    $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'>$subject<br/><br/></td></tr>";
    $message .= "<tr><td style = 'background-color:red;color:white;padding-left:10px;'>If you received this email in error contact us at <mailto:info@lurchit.com>info@lurchit.com</a>";
    $message .= "<br/>Lurchit, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
    $message .= "</table></body></html>";
    
    $header = "From: Lurchit <no-reply@lurchit.com> \r\n";
    $header .= "Content-type: text/html";
    ini_set('sendmail_from', 'no-reply@lurchit.com');
    
    if (mail($toEmail, 'Payment Request', $message, $header)) {
        // mail sent
        return true;
    }
    else {
        // mail sending failed
        return false;
    }
}