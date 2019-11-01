<?php
require 'openDB.php';

function sendEmail($email, $href){
  $to = $email;
  $subject = 'Verify your email address';
  $message = "<html>
              <body bgcolor=\"#DCEEFC\">
              <center>
              Hi! Please <a href='$href'>click on the link</a> to verify your email address...
              And best of luck!
              </center>
              </body>
              </html>";

  $headers = "From: EfraimMKrug@GMail.com\r\n";
  $headers .= "Reply-To: EfraimMKrug@GMail.com\r\n";
  $headers .= "BCC: EfraimMKrug@gmail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
  // if(mail($to, $subject, $message)){
    // echo '<br>Your mail has been sent successfully.';
    return true;
  } else{
    // echo "Sorry: Something weird happened! Please come back later after we get this fixed...";
    return false;
  }
}

$email = mysqli_real_escape_string ($conn ,  $_POST['email']);
$suggestion = mysqli_real_escape_string ($conn ,  $_POST['suggestion']);

$today = date("Y-m-d H:i:s");
$NNTKey = crypt($today . $email . $suggestion);

$sql = "INSERT INTO `NTTEntry` (`NNTEntryEmail`, `NNTEntrySuggestion`, `Voted`) VALUES ('" . $email . "','" . $suggestion . "', false)";

$last_id = 0;
if ($conn->query($sql) === TRUE) {
   $last_id = $conn->insert_id;
   $messageBack = "New record created successfully";
} else {
   echo "Sorry: Something weird happened! Please come back later after we get this fixed...";
}


$sql2 = "INSERT INTO `NNTDeadEmail`(`NNTEmail`, `NNTKey`, `NNTDate`, `NNTEntryKey`) VALUES ('" .  $email . "','" . mysqli_real_escape_string ($conn ,  $NNTKey) . "','" . $today ."'," . $last_id . ")";
// echo $sql2;
if ($conn->query($sql2) === TRUE) {
   // echo "New record created successfully";
   $confirmationString = "NNTKey=" . $NNTKey . "&NNTEntryEmail=" . $email . "&NNTSuggestion=" . $suggestion .  "&NNTEntryKey=" . $last_id . "'";
   $href = "http://www.NameThatThing.site/cgi-bin/confirmationPage.php?" . $confirmationString;
   sendEmail($email, $href);
   // echo $href;
} else {
   echo "Sorry: Something weird happened! Please come back later after we get this fixed...";
}

$conn->close();
header("Location: http://www.NameThatThing.site/whatNext.html");
?>
