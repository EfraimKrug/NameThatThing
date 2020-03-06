<?php
function sendReturnEmailInvite($email, $href, $fname){
  $to = $email;
  $subject = 'Yahrzeit Holder: link to return';
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>
              <!-- <center> -->
              <div class=d>
              Hi $fname! Please <a href=$href><font color=blue>click on the link.</font></a>
              <br>
              The way this works:
              <br>
              You are welcome to enter your yahrzeits... we will keep them for you.<br>
              Two weeks before the yahrzeit, we will send you an email reminding you that <br>
              your yahrzeit is coming up.
              <br>
              That's it.
              <br>
              Best,
              <br>
              Efraim
              <!-- </center> -->
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}


function sendEmailInvite($email, $href, $fname){
  $to = $email;
  $subject = 'Yahrzeit Holder: Verifying your email address';
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>

              <div class=d>
              Hi $fname! Please <a href=$href><font color=white>click on the link</font></a> to verify your email address...
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
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
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
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>

              <div class=d>
              Hi $fname! Please <a href=$href><font color=white>click on the link</font></a> to log on.
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
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}


function sendEmailRequest($email, $href, $fname, $type, $yname, $ydate, $amount){
  // print_r([$email, $href, $fname, $type, $yname, $ydate, $amount]);
  $to = $email;
  $subject = 'YAHRZEIT Donation Request: for Kaddish';
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>

              <!-- <center> -->
              <div class=d>
              Hi $fname!
              <br>
              Someone has come to our website to ask you to have someone say $type
              for $yname on $ydate in return they are pledging $amount.
              <br>
              Please remember, we will be taking a small fee from the amount.
              <br>
              If you are willing to accept this respsonsibility in exchange for their
              donation, please <a href=$href><font color=white>click here</font></a>.
              <br>
              When you have accepted, we will send the money via your paypal account. If you do
              not have a paypal account, PayPal will be send you instructions how to create one.
              <br>
              If you prefer to receive a check, this is also possible. We will write checks once
              each month (again, there is a small processing fee). Please give us your mailing
              address when you click the link above.
              <br>
              Best,
              <br>
              Efraim
              <!-- </center> -->
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}


function sendEmailCancelOrg($email){
  $to = $email;
  $subject = 'We have canceled your donations on your request';
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>

              <div class=d>
              We are so sorry to see you leave!
              <br>
              We are honoring your request to be left alone.
              <br>
              Best,
              <br>
              Efraim
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}

function sendEmailOrgCanceled($email, $name, $req, $href, $reason){
  $to = $email;
  $subject = 'Your donation was not accepted';
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>

              <div class=d>
              Dear $name:
              <br>
              The place you wanted to give money to in honor of your yahrzeit has asked
              that they not receive donations at this time. The reason they gave was:
              <br>
              $reason
              <br>
              Please follow this <a href=$href><font color=white>link</font></a>, and choose another place!
              <br>
              Best,
              <br>
              Efraim
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}


function sendPersonThanks($email, $name, $req, $href, $amount, $oname, $yname){
  $to = $email;
  $subject = 'Thanks for your donation';
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>

              <div class=d>
              Dear $name,
              <br>
              You have given a donation of $amount to $oname in honor of the yahrzeit of $yname.
              We will send you another email when they have accepted the responsibility for the mitzvah.
              <br>
              Best,
              <br>
              Efraim
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}


function sendEmailPersonAccepted($email, $name, $req, $href, $orav, $oname, $yname, $rType, $ydate){
  $msg =  "$yname.";
  if($rType == "Kaddish")
    $msg =  "$yname for the year.";
  if($rType == "Yahrzeit")
    $msg =  "$yname on $ydate.";
  // if($rType == "Yizkor")
  //   $msg =  "$yname.";

  $to = $email;
  $subject = 'Thanks for your donation';
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>

              <div class=d>
              Dear $name,
              <br>Your donation to $oname in honor of the yahrzeit of $yname has been accepted.
              $orav has assured me that $rType will be said for $msg
              <br>
              Best,
              <br>
              Efraim
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}


function WelcomeOrg($email, $rname, $OID, $OKey, $href){
  $to = $email;
  $subject = 'Someone wants to give donations';
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>

              <div class=d>
              Dear $rname,
              <br>
              Someone recently came to our website, and gave us your name and contact information.
              <br>
              Our website allows individuals who need Kaddish, K'eil Malei Harachamim, or Yizkor observances
              to enter organization names they would like to donate to, in trade.
              <br>
              The way it works: Someone comes to our website, and enters their Yahrzeit information. Two
              weeks before the yahrzeit, we send email asking them if they need someone to say Kaddish
              for them. If they respond, they give a donation and specify the place to say Kaddish.
              <br>
              When they specify the place to say Kaddish, we send an email to that organization asking
              them (you) to acknowledge the Yahrzeit (by clicking on the link sent).
              <br>
              They make the donation. You say Kaddish. And we send you the donation(s) at the end of the
              month. (I make a living my taking a small percentage of the donation).
              <br>
              Some organizations use PayPal, and we send them the donation that way. Others ask for a
              check, and we mail them the check.
              <br>
              In either case, we need to know you would like to be involved in this venture. Please
              <a href=$href><font color=white>click here and follow the link</font></a>

              Best,
              <br>
              Efraim
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}

function NextNoticeOrg($email, $rname, $ppemail, $maddress){
  $info = "check payment to your " . $maddress . " mailing ";
  if($ppemail) $info = "paypal payment to your " . $ppemail . " email ";
  $to = $email;
  $subject = 'We got your update';
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body>
              <style>
                .d {
                  font-size:12px;
                  background-color:#f98e3f;
                  color:#87605c;
                  width:500px;
                  height:400px;
                  padding:36px;
                }
              </style>

              <div class=d>
              Dear $rname,
              <br>
              Thanks for your update information. The next time we pay you, we will
              send a $info address. You should get it near the end of each month.
              <br>
              Best,
              <br>
              Efraim
              </div>
              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}

// sendEmailRequest("EfraimMKrug@GMail.com","https://www.NameThatThing.site/accept.html?RID=3&X=$1$h99zZovM$rSFy9JHuBvrO5fM7GODVi/&Y=Efraim","Rabbi Efraim","Kaddish","Happy Go Lucky","14 AdarII","18.00");
?>
