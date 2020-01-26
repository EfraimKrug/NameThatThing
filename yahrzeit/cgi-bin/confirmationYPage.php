<!doctype html>
<!--
This page is only accessible from email.
There are two reasons to get an email:
  1) Email confirmation - when the person first logs in, and
  2) When the person signs out - or gets logged out - they get a new email
-->
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yahrzeits</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
  <style>
    #EntryDisplay {
      color:blue;
    }
    .grid-container {
      width: 100%;
      height: 100%;
      min-height:900px;
      z-index:-990;
      background: url('https://www.NameThatThing.site/images/yahrzeit-candles.jpg?v1') no-repeat right;
    }
    body {
      z-index:-999;
      background-color: black;
    }
    #banner {
      width: 100%;
      height: 100%;
      min-height:50px;
      z-index:-990;
      background-color: black;
    }
  </style>
  </head>
<body>
<?php
require 'openYDB.php';
require 'email.php';
date_default_timezone_set("America/New_York");
$today = date("Y-m-d H:i:s");

$logon = FALSE;
$ConfKey = mysqli_real_escape_string ($conn ,  $_REQUEST['ConfKey']);
$ConfEmail = mysqli_real_escape_string ($conn ,  $_REQUEST['ConfEmail']);
$ConfPID = mysqli_real_escape_string ($conn , $_REQUEST['ConfPID']);

$sql = "SELECT * FROM People WHERE PeopleID = " . $ConfPID;
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
$NewConfKey = "";
if(isset($row['FName'])){
      $fname = $row['FName'];
      $NewConfKey = crypt($today . $email . $fname);
}

$sql = "SELECT * FROM Conf WHERE ConfKey = '" . $ConfKey . "'";
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
//prepare for later comparison
$CompConfTime = $row['ConfTime'] ? new DateTime($row['ConfTime'], new DateTimeZone('America/New_York')) : new DateTime($today, new DateTimeZone('America/New_York'));
$CompToday = new DateTime($today, new DateTimeZone('America/New_York'));
$CompToday->modify('-2 hours');

if(isset($row['ConfKey']) && !$row['ConfTime']){
  $sql = "UPDATE Conf SET ConfTime = '" . $today . "' WHERE ConfKey = '" . $ConfKey . "'";
  $resource = $conn->query($sql);
  $logon = TRUE;
  $CARRY_STRING = "?X=" . $ConfKey . "&Y=" . $fname;
}

if($CompToday < $CompConfTime){
  $logon = TRUE;
  $CARRY_STRING = "?X=" . $ConfKey . "&Y=" . $fname;
}

//time up - log him off
if(isset($row['ConfKey']) && isset($row['ConfTime']) ){
  if($CompToday > $CompConfTime){
    $sql = "UPDATE Conf SET ConfKey = '" . $NewConfKey . "', ConfTime = '" . $CompToday->format('Y-m-d H:i:s') . "' WHERE ConfKey = '" . $ConfKey . "'";
    $resource = $conn->query($sql);
  }
}

if(!$logon){
  echo "<div>That didn't work... your login is wonkey!</div>";
  die();
}

// else {
//   echo '<div id=formDiv>';
//   echo "<br><br>We got a problem here, please check your email for a new link...";
//   echo '</div>';
//   $sql = "UPDATE Conf SET ConfKey = '" . $NewConfKey . "' WHERE ConfEmail = '" . $ConfEmail . "'";
//   $resource = $conn->query($sql);
//   $confirmationString = "ConfKey=" . $NewConfKey . "&ConfEmail=" . $ConfEmail . "&ConfPID=" . $ConfPID;
//   $href = "https://www.NameThatThing.site/cgi-bin/confirmationYPage.php?" . $confirmationString;
//   sendEmailRenew($ConfEmail, $href, $fname);
//   die();
// }
?>
<div class="grid-container">
  <div id="bnr">
    <div class="row">
        <div class="small-12 columns">&nbsp;</div>
    </div>
  </div>
  <div class="grid-x grid-padding-x">
    <div class="large-8 cell">
      <div class="grid-x grid-padding-x">
        <div class="large-4 medium-4 cell">&nbsp;
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="large-4 medium-4 cell">

          <ul class="vertical menu" data-responsive-menu="drilldown medium-accordion" style="max-width: 250px;">
            <li>
              <a href='https://www.NameThatThing.site/enterYahrzeits.html<?php echo $CARRY_STRING ?>' class="button"><font color=yellow>Enter Yahrzeits</font></a>
              <ul class="vertical menu">
                <li>
                  <a href="#">Item 1A</a>
                  <ul class="vertical menu">
                    <li><a href="#">Item 1A</a></li>
                    <li><a href="#">Item 1B</a></li>
                    <li><a href="#">Item 1C</a></li>
                    <li><a href="#">Item 1D</a></li>
                    <li><a href="#">Item 1E</a></li>
                  </ul>
                </li>
                <li><a href="#">Item 1B</a></li>
              </ul>
            </li>
            <li>
              <a href='https://www.NameThatThing.site/enterOrgs.html<?php echo $CARRY_STRING ?>' class="button"><font color=yellow>Enter Organizations</font></a>
              <ul class="vertical menu">
                <li><a href="#">Item 2A</a></li>
                <li><a href="#">Item 2B</a></li>
              </ul>
            </li>
            <li>
              <a href='https://www.NameThatThing.site/enterRequests.html<?php echo $CARRY_STRING ?>' class="button"><font color=yellow>Enter Requests</font></a>
              <ul class="vertical menu">
                <li><a href="#">Item 3A</a></li>
                <li><a href="#">Item 3B</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="large-4 medium-4 cell">
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
