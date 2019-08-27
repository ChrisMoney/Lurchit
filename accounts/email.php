<?php

function sendResetEmail($email) {
    
    // send email
    $subject = "<a href='http://accounts.apilurchit.com/password-create.php?email=$email'>Click here to reset your password</a>";
    $toEmail = $email;
    
    $message = "<html><body>";
    $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'border-radius:10px;'><td>";
    $message .= "<tr><td><img src = 'http://lurchit.com/logo.png' height = '200' width = '200' style='padding-left:10px' /></td></tr>";
    $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'>$subject<br/><br/></td></tr>";
    $message .= "<tr><td style = 'background-color:red;color:white;padding-left:10px;'>If you received this email in error contact us at <mailto:info@lurchit.com>info@lurchit.com</a>";
    $message .= "<br/>Lurchit, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
    $message .= "</table></body></html>";
    
    $header = "From: Lurchit <no-reply@lurchit.com> \r\n";
    $header .= "Content-type: text/html";
    ini_set('sendmail_from', 'no-reply@lurchit.com');
    
    if (mail($toEmail, 'Reset Password', $message, $header)) {
        // mail sent
        return true;
    }
    else {
        // mail sending failed
        return false;
    }
}


function sendPaymentProcessedEmail($email) {
    
    // send email
    $subject = "Payment has been processed. Your check will arrive within 3 business days.";
    $toEmail = $email;
    
    $message = "<html><body>";
    $message .= "<table style = 'background:white;height:400px;width:600px;border-radius:10px;border:2px solid black;'><tr style = 'border-radius:10px;'><td>";
    $message .= "<tr><td><img src = 'http://lurchit.com/logo.png' height = '200' width = '200' style='padding-left:10px' /></td></tr>";
    $message .= "<tr><td style = 'background:silver;padding:20px;border:2px solid black;'>$subject<br/><br/></td></tr>";
    $message .= "<tr><td style = 'background-color:red;color:white;padding-left:10px;'>If you received this email in error contact us at <mailto:info@lurchit.com>info@lurchit.com</a>";
    $message .= "<br/>Lurchit, 911 Washington Ave, St.Louis,MO 63101 USA </td></tr>";
    $message .= "</table></body></html>";
    
    $header = "From: Lurchit <no-reply@lurchit.com> \r\n";
    $header .= "Content-type: text/html";
    ini_set('sendmail_from', 'no-reply@lurchit.com');
    
    if (mail($toEmail, 'Reset Password', $message, $header)) {
        // mail sent
        return true;
    }
    else {
        // mail sending failed
        return false;
    }
}