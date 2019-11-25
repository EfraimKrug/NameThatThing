<!DOCTYPE>
<html>
<head>
<link rel = "stylesheet" type = "text/css" href = "../css/namethatthing.css" />
</head>
<body>
<id=topDiv>
  <table>
    <tr>
    <td><img src="../images/dots.gif"></td>
    <td><img src="../images/NameTitle.gif"></td>
    <td><img src="../images/WavyDots.gif"></td>
    </tr>
  </table>
</div>
<?php
require 'openDB.php';
// This EntryKey is pointing to the email address of the user voting
function sendEmail($email){
  $to = $email;
  $subject = 'NAME THAT THING: Thanks for voting';
  $message = "<html>
              <body bgcolor=\"#DCEEFC\">
              <center>
              Hi! Thanks so much for voting for the name for the three wavy dots!
              <br><br>
              Remember, the more people who vote, the more money is available for the
              winner... Send this around! Invite your friends to participate!
              <br><br>
              Best of luck!
              <a href='https://NameThatThing.site'><img src='https://NameThatThing.site/images/FBAdvertisement.gif' alt='FB Advertisement' height=539 width=799/></a>
              </center>
              </body>
              </html>";

  $headers = "From: EfraimMKrug@GMail.com\r\n";
  $headers .= "Reply-To: EfraimMKrug@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else {
    return false;
  }
}

$EntryKey = $_REQUEST['EntryKey'];
$EntryEmail = $_REQUEST['EntryEmail'];
//echo $EntryKey;
$sql = "SELECT COUNT(*) AS RECORD_COUNT FROM NTTEntry WHERE NNTEntryKey = " . $EntryKey . " AND Voted = TRUE;";
// echo $sql;
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
if($row['RECORD_COUNT'] > 0){
  echo '<div id=formDiv>';
  echo "<br><br>Oh, I am so sorry! This entry combination has already voted once. You can only vote once, unless you make another entry.";
  echo "<br><br>But you are welcome to<a href='../index.html'> make another entry! </a>";
  echo '</div>';
  exit(1);
}

$sql = "SELECT * FROM NNTVoteNavigation";
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
$CycleCount = $row['NNTCycleCount'];

$counter = 0;
foreach ($_REQUEST as $Key => $Value){
  if($counter > 2) break;
  if($Value !== 'Yes') continue;  //this check should also knock out the EntryKey
  $sql = "SELECT * FROM NNTVoteCount WHERE NNTEntry = " . $Key;
  $resource = $conn->query($sql);

  while($row = $resource->fetch_assoc()){
     // $NNTVoteCount = $row['NNTVoteCount'] + $CycleCount;
     $NNTVoteCount = $row['NNTVoteCount'] + 1;
     $sql = "UPDATE NNTVoteCount SET NNTVoteCount = $NNTVoteCount WHERE NNTEntry = " . $Key;
     if($conn->query($sql) === true){
       $messageBack = "Update OK";
     } else {
       $messageBack = "Update Broke";
     }
   }
   $counter++;
 }

 # notice - we need a payment here!

 $sql = "UPDATE  NTTEntry SET Voted = TRUE WHERE  NNTEntryKey = " . $EntryKey;
 $conn->query($sql);

 #send email acknowledging the vote...

 sendEmail($EntryEmail);
 # clean up the DeadEmail - records...
 $oldDate = date("Y-m-d", strtotime("-7 day"));
 $sql = "SELECT * FROM NNTDeadEmail WHERE NNTDate < '" . $oldDate . "'";
 $resource = $conn->query($sql);
 $idList = [];
 while($row = $resource->fetch_assoc()){
   $idList[] = $row['NNTEntryKey'];
 }

 foreach($idList as $id){
   $sql = "DELETE FROM NTTEntry WHERE NNTEntryKey = " . $id;
   $conn->query($sql);
 }

 $sql = "DELETE FROM NNTDeadEmail WHERE NNTDate < '" . $oldDate . "';";
 $conn->query($sql);

 $conn->close();

?>

<div id=formDiv>
  <br>Now? Wait! We have your vote. We have your email. If you
  win, we will send you an email with "YOU NAMED IT! YOU WON!"
  in the subject line. If you didn't win, we will still send you
  an email with "YOU TRIED... BUT THE WINNING NAME WAS..."
  in the subject line.
  <br><br>
  Of course, you can put in as many entries as you want... but each
  one costs a dollar. If you suddenly come up with a brilliant idea,
  great! But if not, it's probably better to just wait...
  <br><br>
  And that's all there is!
  <br><br>
</div>
<div id=bottomDiv>
<table>
<tr>
  <td>
    <a href="../WhatAreWeDoing.html"><span class=white>What are we doing?</span></a><span class=white> | </span>
  </td>
  <td>
  </td>
  <td>
    <a href="../HowDoesThisWork.html"><span class=white>How does this work?</span></a><span class=white> | </span>
  </td>
  <td>
  </td>
  <td>
    <a href="../WhoAreWe.html"><span class=white>Who are we?</span></a><span class=white> | </span>
  </td>
  <td>
  </td>
  <td>
      <a href="StuffToRead.html"><span class=white>Stuff To Read</span><span class=white> | </span></a>
  </td>
  <td>
  </td>
  <td>
    <a href="https://slate.com/culture/2015/04/typing-indicator-bubbles-on-iphone-gchat-facebook-messenger-when-can-someone-see-you-typing-explained.html"><span class=white>Uh oh!</span><span class=white> | </span></a>
  </td>
  <td>
  </td>
</tr>
</table>
</div>
</body>
</html>
