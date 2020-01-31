<?php
require 'openYDB.php';
$ConfID = "";
$ConfKey = "";
// This guarantees that:
// X = ConfKey matches the ConfKey in Conf
// Y = FName matches FName in People
// and PeopleID = ConfPID

$FName = addslashes ($_POST['Y']);
$logon = TRUE;
  if(array_key_exists('Y', $_POST)){
    $FName = addslashes ($_POST['Y']);
  } else {
    $logon = FALSE;
  }

  if(array_key_exists('X', $_POST)){
    $ConfKey = $_POST['X'];
    $sql = "SELECT * FROM Conf WHERE ConfKey = '" . $ConfKey . "'";
  } else {
    $logon = FALSE;
  }

  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();

  // if(array_key_exists('ConfTime', $row) && $row['ConfTime']){
  //   date_default_timezone_set("America/New_York");
  //   $today = date("Y-m-d H:i:s");
  //   $CompConfTime = $row['ConfTime'] ? new DateTime($row['ConfTime'], new DateTimeZone('America/New_York')) : new DateTime($today, new DateTimeZone('America/New_York'));
  //   $CompToday = new DateTime($today, new DateTimeZone('America/New_York'));
  //   $CompToday->modify('-2 hours');
  //   if($CompToday > $CompConfTime){
  //     $logon = FALSE;
  //     }
  //   } else {
  //     $logon = FALSE;
  // }

  if(array_key_exists('ConfPID', $row)){
    $PeopleID = $row['ConfPID'];
    $sql = "SELECT * FROM People WHERE PeopleID = " . $PeopleID;
  } else {
    $logon = FALSE;
  }

  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();

  if($row['FName'] !== $FName){
    $logon = FALSE;
  }

  $rObj = $logon ? (object) array('RETURN' => 'TRUE', 'PID' => $PeopleID) : (object) array('RETURN' => 'FALSE');
  echo json_encode($rObj);
?>
