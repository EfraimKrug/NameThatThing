<?php
require 'openDB.php';
#print_r($_SESSION);
#$_SESSION['ENTRY'] = "";
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
    return true;
  } else{
    return false;
  }
}

$email = mysqli_real_escape_string ($conn ,  $_POST['email']);
$suggestion = mysqli_real_escape_string ($conn ,  $_POST['suggestion']);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('Location:/index.html?RETURN=Email%20is%20not%20correct!%20Sorry!');
  exit(1);
}
if (preg_match("/^\b*$/",$suggestioname)) {
  header('Location:/index.html?RETURN=Entry%20is%20not%20correct!%20Sorry!!');
  exit(1);
}
$today = date("Y-m-d H:i:s");
$NNTKey = crypt($today . $email . $suggestion);

#check number of times that entry has been entered!
# block this entry if > 20
$sql = "SELECT COUNT(*) AS RECORD_COUNT FROM NTTEntry WHERE Voted = TRUE AND NNTEntrySuggestion = '" . $suggestion . "';";
$resource = $conn->query($sql);
if ($row = $resource->fetch_assoc()){
  $entryCount = $row['RECORD_COUNT'];
} else {
  $entryCount = 0;
}

if($entryCount > 0){
  header('Location:/index.html?RETURN=The entry:%20' . preg_replace('/\s/','%20', $suggestion) . '%20has%20been%20entered%20more%20than%20twenty%20times!!');
  exit(1);
}

$sql = "INSERT INTO `NTTEntry` (`NNTEntryEmail`, `NNTEntrySuggestion`, `Voted`) VALUES ('" . $email . "','" . $suggestion . "', false)";

$last_id = 0;
if ($conn->query($sql) === TRUE) {
   $last_id = $conn->insert_id;
   $messageBack = "New record created successfully";
} else {
   echo "Sorry: Something weird happened! Please come back later after we get this fixed...";
}


$sql2 = "INSERT INTO `NNTDeadEmail`(`NNTEmail`, `NNTKey`, `NNTDate`, `NNTEntryKey`) VALUES ('" .  $email . "','" . mysqli_real_escape_string ($conn ,  $NNTKey) . "','" . $today ."'," . $last_id . ")";
if ($conn->query($sql2) === TRUE) {
   $confirmationString = "NNTKey=" . $NNTKey . "&NNTEntryEmail=" . $email . "&NNTSuggestion=" . $suggestion .  "&NNTEntryKey=" . $last_id . "'";
   $href = "http://www.NameThatThing.site/cgi-bin/confirmationPage.php?" . $confirmationString;
   sendEmail($email, $href);
} else {
   echo "Sorry: Something weird happened! Please come back later after we get this fixed...";
}

$conn->close();
header("Location: http://www.NameThatThing.site/whatNext.html");
?>
