<?php
require 'openYDB.php';
$ConfID = "";
$ConfKey = "";

$pid = "";
$oid = "";
$yid = "";
$amount = "";
$logon = TRUE;

if(array_key_exists('pid', $_REQUEST)){
  $pid = addslashes ($_REQUEST['pid']);
} else {
  $logon = FALSE;
}

if(array_key_exists('oid', $_REQUEST)){
  $oid = addslashes ($_REQUEST['oid']);
} else {
  $logon = FALSE;
}
if(array_key_exists('yid', $_REQUEST)){
  $yid = addslashes ($_REQUEST['yid']);
} else {
  $logon = FALSE;
}
if(array_key_exists('amount', $_REQUEST)){
  $amount = addslashes ($_REQUEST['amount']);
} else {
  $logon = FALSE;
}
if(array_key_exists('X', $_REQUEST)){
  $X = addslashes ($_REQUEST['X']);
} else {
  $logon = FALSE;
}
if(array_key_exists('Y', $_REQUEST)){
  $Y = addslashes ($_REQUEST['Y']);
} else {
  $logon = FALSE;
}

#Get the confKey from the Conf Table
  // $sql = "SELECT ConfKey FROM Conf WHERE ConfPID = " . $pid;
  // // echo "<br>NEXT";
  // $resource = $conn->query($sql);
  // $row = $resource->fetch_assoc();
  // $ConfKey = $row['ConfKey'];
  //
  // $sql = "SELECT FName FROM People WHERE PeopleID = " . $pid;
  // // echo "<br>NEXT";
  // $resource = $conn->query($sql);
  // $row = $resource->fetch_assoc();
  // $FName = $row['FName'];

  // // print_r($row);
  // // echo "<br>ROW above?";
  // #Check the time on the ConfTable
  // if(array_key_exists('ConfTime', $row) && $row['ConfTime']){
  //   date_default_timezone_set("America/New_York");
  //   $today = date("Y-m-d H:i:s");
  //   // echo "<br>" . $today;
  //   $CompConfTime = $row['ConfTime'] ? new DateTime($row['ConfTime'], new DateTimeZone('America/New_York')) : new DateTime($today, new DateTimeZone('America/New_York'));
  //   $CompToday = new DateTime($today, new DateTimeZone('America/New_York'));
  //   $CompToday->modify('-2 hours');
  //   if($CompToday > $CompConfTime){
  //     $logon = FALSE;
  //     }
  //   } else {
  //     $logon = FALSE;
  // }
  // echo "<BR>NEXT";
  #Check the People Record for first name
  // if(array_key_exists('ConfPID', $row)){
  //   $PeopleID = $row['ConfPID'];
  //   $sql = "SELECT * FROM People WHERE PeopleID = " . $PeopleID;
  // } else {
  //   $logon = FALSE;
  // }
  // echo "<BR>PeopleID: " . $PeopleID;
  // $resource = $conn->query($sql);
  // $row = $resource->fetch_assoc();
  // print_r($row);
  // echo "<BR>ROW?";
  // if($row['FName'] !== $FName){
  //   $logon = FALSE;
  // }
  $rObj = $logon ? (object) array('RETURN' => 'TRUE', 'PID' => $pid) : (object) array('RETURN' => 'FALSE');
  // $rObj = $_REQUEST;
  // $rObj = ['RETURN' => 'TRUE'];
  // echo $logon;
  // rObj->RETURN = $logon ? "TRUE" : "FALSE";
  // // echo $logon ?  "TRUE:" . $PeopleID : "FALSE" . $PeopleID;
  echo json_encode($rObj);
?>
