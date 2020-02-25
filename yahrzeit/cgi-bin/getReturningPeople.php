<?php
require 'openYDB.php';
require 'email.php';
// print_r($_SESSION);

$email = mysqli_real_escape_string ($conn ,  $_POST['email']);
$today = date("Y-m-d H:i:s");

$sql = "SELECT * FROM People, Conf WHERE ConfPID = PeopleID AND EMail = '" . $email . "';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $ConfKey = crypt($today . $email . $fname);
  $sql2 = "UPDATE `Conf` SET ConfKey = '" . $ConfKey . "', ConfTime = NULL WHERE ConfPID = " . $row['PeopleID'];
  $resource = $conn->query($sql2);

  $fname = $row['FName'];
  $confirmationString = "ConfKey=" . $ConfKey . "&ConfEmail=" . $email . "&ConfPID=" . $row['PeopleID'] . "'";
  $href = "http://www.NameThatThing.site/cgi-bin/welcomeBackPage.php?" . $confirmationString;
  sendReturnEmailInvite($email, $href, $fname);
  header("Location: https://www.NameThatThing.site/nextAction.html?USER=RETURN");
  } else {
    echo "Sorry: Something weird happened! Please come back later after we get this fixed...";
    exit(1);
}

$conn->close();
header("Location: http://www.NameThatThing.site/nextAction.html");
?>
