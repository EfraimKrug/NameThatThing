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
    <link rel="stylesheet" href="../css/yahrzeit.css">
  </head>
<body>
<script src="../js/cookieControl.js"></script>
<?php
require 'openYDB.php';
require 'email.php';
date_default_timezone_set("America/New_York");
$today = date("Y-m-d H:i:s");

$logon = TRUE;
$reason = "";
$ConfKey = $ConfEmail = "";
$ConfPID = 0;

if(isset($_REQUEST['ConfKey']))   $ConfKey = mysqli_real_escape_string ($conn ,  $_REQUEST['ConfKey']);
if(isset($_REQUEST['ConfEmail'])) $ConfEmail = mysqli_real_escape_string ($conn ,  $_REQUEST['ConfEmail']);
if(isset($_REQUEST['ConfPID']))   $ConfPID = mysqli_real_escape_string ($conn , $_REQUEST['ConfPID']);

$sql = "SELECT * FROM People WHERE PeopleID = " . $ConfPID;
$reason .= $ConfPID;
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
$NewConfKey = "";
$PeopleID = $row['PeopleID'];
$reason .= "[ $PeopleID ]";
if(isset($row['FName'])){
      $fname = $row['FName'];
      $NewConfKey = crypt($today . $email . $fname);
}

$reason .= "[ $fname ]";
$sql = "SELECT * FROM Conf WHERE ConfKey = '" . $ConfKey . "'";
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
$reason .= "[ $ConfKey ]";
//prepare for later comparison
$CompConfTime = $row['ConfTime'] ? new DateTime($row['ConfTime'], new DateTimeZone('America/New_York')) : new DateTime($today, new DateTimeZone('America/New_York'));
$confPID = $row['ConfPID'];
$CompToday = new DateTime($today, new DateTimeZone('America/New_York'));
$CompToday->modify('-2 hours');

if(isset($row['ConfKey']) && !$row['ConfTime']){
  $sql = "UPDATE Conf SET ConfTime = '" . $today . "' WHERE ConfKey = '" . $ConfKey . "'";
  $resource = $conn->query($sql);
  // $logon = TRUE;
  $reason = "No Conftime";
  $CARRY_STRING = "?X=" . $ConfKey . "&Y=" . $fname;
}

if($CompToday < $CompConfTime){
  // $logon = TRUE;
  $reason .= "::time correct";
  $CARRY_STRING = "?X=" . $ConfKey . "&Y=" . $fname;
}

if($PeopleID != $ConfPID){
  $reason .= "::IDs not the same";
  $logon = FALSE;
}
//time up - log him off
// if(isset($row['ConfKey']) && isset($row['ConfTime']) ){
//   if($CompToday > $CompConfTime){
//     $sql = "UPDATE Conf SET ConfKey = '" . $NewConfKey . "', ConfTime = '" . $CompToday->format('Y-m-d H:i:s') . "' WHERE ConfKey = '" . $ConfKey . "'";
//     $resource = $conn->query($sql);
//     $ConfKey = $NewConfKey; // for cookie setting below...
//   }
// }

if(!$logon){
  echo "<div>That didn't work... your login is wonkey![ $reason ]</div>";
  die();
}


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
              <a href='https://www.NameThatThing.site/enterYahrzeits.html<?php echo $CARRY_STRING ?>' class="button"><font color=yellow>Yahrzeits</font></a>
            </li>
            <li>
              <a href='https://www.NameThatThing.site/enterOrgs.html<?php echo $CARRY_STRING ?>' class="button"><font color=yellow>Organizations</font></a>
            </li>
            <li>
              <!-- <a href='https://www.NameThatThing.site/enterRequests.html<?php #echo $CARRY_STRING ?>' class="button"><font color=yellow>Requests</font></a> -->
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
<script>setConfKey("<?php echo $ConfKey; ?>"); setFName("<?php echo $fname; ?>");</script>
</html>
