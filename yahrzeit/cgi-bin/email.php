<?php
function sendEmailInvite($email, $href, $fname){
  $to = $email;
  $subject = 'Yahrzeit Holder: Verifying your email address';
  $message = "<html>
              <body bgcolor=\"#DCEEFC\">
              <center>
              Hi $fname! Please <a href='$href'>click on the link</a> to verify your email address...
              <br>
              The way this works:
              <br>
              You are welcome to enter your yahrzeits... we will keep them for you.
              Two weeks before the yahrzeit, we will send you an email reminding you that your
              yahrzeit is coming up.
              <br>
              That's it.
              <br>
              Best,
              <br>
              Efraim
              </center>
              </body>
              </html>";

  $headers = "From: EfraimMKrug@GMail.com\r\n";
  $headers .= "Reply-To: EfraimMKrug@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}

function sendEmailRenew($email, $href, $fname){
  $to = $email;
  $subject = 'Yahrzeit Holder: Link to get on';
  $message = "<html>
              <body bgcolor=\"#DCEEFC\">
              <center>
              Hi $fname! Please <a href='$href'>click on the link</a> to log on.
              <br>
              What you can do:
              <br>
              Add yahrzeits. Add organizations. Or change what you have already added.
              <br>
              That's it.
              <br>
              Best,
              <br>
              Efraim
              </center>
              </body>
              </html>";

  $headers = "From: EfraimMKrug@GMail.com\r\n";
  $headers .= "Reply-To: EfraimMKrug@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}


function sendEmailRequest($email, $href, $fname, $type, $yname, $ydate, $amount){
  $to = $email;
  $subject = 'Request for Kaddish with donation';
  $message = "<html>
              <body bgcolor=\"#DCEEFC\">
              <center>
              Hi $fname!
              <br>
              Someone has come to our website to ask you if someone can say $type
              for $yname on $ydate in return they are pledging $amount.
              <br>
              Please remember, we will be taking a small fee from the amount.
              <br>
              If you are willing to accept this respsonsibility in exchange for their
              donation, please <a href='$href'>click on the link</a>.
              <br>
              When you have accepted, we will send the money via your paypal account. If you do
              not have a paypal account, PayPal will be sending you instructions how to create one.
              <br>
              Best,
              <br>
              Efraim
              </center>
              </body>
              </html>";

  $headers = "From: EfraimMKrug@GMail.com\r\n";
  $headers .= "Reply-To: EfraimMKrug@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}

?>
