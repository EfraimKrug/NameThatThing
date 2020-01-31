<?php
require 'openYDB.php';
require 'email.php';
// print_r($_SESSION);

$email = mysqli_real_escape_string ($conn ,  $_POST['email']);
$fname = mysqli_real_escape_string ($conn ,  $_POST['fname']);
$lname = mysqli_real_escape_string ($conn ,  $_POST['lname']);
// $secret = mysqli_real_escape_string ($conn ,  $_POST['secret']);
$secret = "SECRET";

$today = date("Y-m-d H:i:s");
$ConfKey = crypt($today . $email . $fname);
$sql = "SELECT * FROM People WHERE EMail = '" . $email . "';";
$last_id = 0;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $last_id = $row['PeopleID'];
  // $sql2 = "INSERT INTO `Conf` (`ConfKey`, `ConfDate`, `ConfPID`) VALUES ('" . mysqli_real_escape_string ($conn ,  $ConfKey) . "','" . $today ."'," . $last_id . ")";
  $sql2 = "UPDATE Conf SET ConfKey = '" . mysqli_real_escape_string ($conn ,  $ConfKey)  . "', ConfDate = " . "'" . $today . "' WHERE ConfPID = " . $last_id;

  if ($conn->query($sql2) === TRUE) {
    $confirmationString = "ConfKey=" . $ConfKey . "&ConfEmail=" . $email . "&ConfPID=" . $last_id . "'";
    $href = "http://www.NameThatThing.site/cgi-bin/confirmationYPage.php?" . $confirmationString;
    sendEmailInvite($email, $href, $fname);
    header("Location: http://www.NameThatThing.site/nextAction.html?USER=RETURN");
  }

  // header('Location:/startYahr.html?RETURN=That%20Email%20is%20already%20registered!');
  // exit(1);
} else {
  $sql = "INSERT INTO `People` (`FName`, `LName`, `Email`, `Secret`)  VALUES ('" . $fname . "','" . $lname . "','" . $email . "','" . $secret . "')";
  if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    $sql2 = "INSERT INTO `Conf` (`ConfKey`, `ConfDate`, `ConfPID`) VALUES ('" . mysqli_real_escape_string ($conn ,  $ConfKey) . "','" . $today ."'," . $last_id . ")";
    if ($conn->query($sql2) === TRUE) {
      $confirmationString = "ConfKey=" . $ConfKey . "&ConfEmail=" . $email . "&ConfPID=" . $last_id . "'";
      $href = "http://www.NameThatThing.site/cgi-bin/confirmationYPage.php?" . $confirmationString;
      sendEmailInvite($email, $href, $fname);
    }
  } else {
    echo "Sorry: Something weird happened! Please come back later after we get this fixed...";
    exit(1);
  }
}

$conn->close();
header("Location: http://www.NameThatThing.site/nextAction.html");
?>
