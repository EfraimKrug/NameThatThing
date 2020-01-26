<?php
require 'openYDB.php';
$ConfID = "";
$ConfKey = "";
// $_POST['X']="$1$Q.x6nk2b$jQVuHdcqmCnFKYHBEx20a/";
// $_POST['Y']="Billy";
$FName = addslashes ($_POST['Y']);
$logon = TRUE;
  if(array_key_exists('Y', $_POST)){
    $FName = addslashes ($_POST['Y']);
  } else {
    $logon = FALSE;
  }

  // echo $FName;
#Get the confKey from the Conf Table
  if(array_key_exists('X', $_POST)){
    $ConfKey = $_POST['X'];
    $sql = "SELECT * FROM Conf WHERE ConfKey = '" . $ConfKey . "'";
    // echo "<br>" . $sql;
  } else {
    $logon = FALSE;
  }
  // echo "<br>NEXT";
  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();
  // print_r($row);
  // echo "<br>ROW above?";
  #Check the time on the ConfTable
  if(array_key_exists('ConfTime', $row) && $row['ConfTime']){
    date_default_timezone_set("America/New_York");
    $today = date("Y-m-d H:i:s");
    // echo "<br>" . $today;
    $CompConfTime = $row['ConfTime'] ? new DateTime($row['ConfTime'], new DateTimeZone('America/New_York')) : new DateTime($today, new DateTimeZone('America/New_York'));
    $CompToday = new DateTime($today, new DateTimeZone('America/New_York'));
    $CompToday->modify('-2 hours');
    if($CompToday > $CompConfTime){
      $logon = FALSE;
      }
    } else {
      $logon = FALSE;
  }
  // echo "<BR>NEXT";
  #Check the People Record for first name
  if(array_key_exists('ConfPID', $row)){
    $PeopleID = $row['ConfPID'];
    $sql = "SELECT * FROM People WHERE PeopleID = " . $PeopleID;
  } else {
    $logon = FALSE;
  }
  // echo "<BR>PeopleID: " . $PeopleID;
  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();
  // print_r($row);
  // echo "<BR>ROW?";
  if($row['FName'] !== $FName){
    $logon = FALSE;
  }

  $rObj = $logon ? (object) array('RETURN' => 'TRUE', 'PID' => $PeopleID) : (object) array('RETURN' => 'FALSE');
  // $rObj = ['RETURN' => 'TRUE'];
  // echo $logon;
  // rObj->RETURN = $logon ? "TRUE" : "FALSE";
  // // echo $logon ?  "TRUE:" . $PeopleID : "FALSE" . $PeopleID;
  echo json_encode($rObj);
?>
