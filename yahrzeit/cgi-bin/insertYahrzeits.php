<?php
require 'openYDB.php';
//Yahrzeits(YName, YGDate, YHMonth, YHDay, YHYear)
$YName = "";
$YGDate = "";
$YHMonth = "";
$YHDay = "";
$YHYear = "";
$YPID = "";
//ID=0&YName=Timmy Ticker&YGDate=1905-5-5&YHMonth=Adar II&YHDay=5&YHYear=5665
$X = "";
$Y = "";

if (count($_POST) < 5) die();

if(array_key_exists('YName', $_POST))$YName = urldecode($_POST['YName']);
if(array_key_exists('YGDate', $_POST))$YGDate = $_POST['YGDate'];
if(array_key_exists('YHMonth', $_POST))$YHMonth = $_POST['YHMonth'];
if(array_key_exists('YHDay', $_POST))$YHDay = $_POST['YHDay'];
if(array_key_exists('YHYear', $_POST)) $YHYear = $_POST['YHYear'];
if(array_key_exists('YPID', $_POST)) $YPID = $_POST['YPID'];

if(array_key_exists('X', $_POST)) $X = urldecode($_POST['X']);
if(array_key_exists('Y', $_POST)) $Y = urldecode($_POST['Y']);

$sql = "SELECT * FROM Conf WHERE ConfKey = '" . $X . "'";

$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
$ConfPID = $row['ConfPID'];

if(isset($row['ConfKey'])){
  $sql = "SELECT * FROM People WHERE PeopleID = " . $row['ConfPID'];
  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();
  if($row['FName'] != $Y){
      echo "There seems to be a security problem...";
      die();
  }
}

$sql = "INSERT INTO `Yahrzeits` (`YName`,`YGDate`,`YHMonth`,`YHDay`,`YHYear`) VALUES ('" . $YName .  "','" . $YGDate . "','" . $YHMonth . "','" . $YHDay . "','" . $YHYear . "')";
$resource = $conn->query($sql);
// echo $sql;
$YID = $conn->insert_id;
$sql = "INSERT INTO `PYConn` (`PID`,`YID`) VALUES ('" . $ConfPID .  "','" . $YID . "')";
$resource = $conn->query($sql);
?>
