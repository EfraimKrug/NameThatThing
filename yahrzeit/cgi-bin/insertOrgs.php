<?php
require 'openYDB.php';
$ORav = "";
$OEmail = "";
$OName = "";
$OStreetAddress = "";
$OCity = "";
$OState = "";
$OCountry = "";
$OPayPalEmail = "";
$OMailAddress = "";

if (count($_POST) < 5) die();

if(array_key_exists('ORav', $_POST)) $ORav = $_POST['ORav'];
if(array_key_exists('OEmail', $_POST)) $OEmail = $_POST['OEmail'];
if(array_key_exists('OName', $_POST)) $OName = $_POST['OName'];
if(array_key_exists('OStreetAddress', $_POST)) $OStreetAddress = $_POST['OStreetAddress'];
if(array_key_exists('OCity', $_POST)) $OCity = $_POST['OCity'];
if(array_key_exists('OState', $_POST)) $OState = $_POST['OState'];
if(array_key_exists('OCountry', $_POST)) $OCountry = $_POST['OCountry'];
if(array_key_exists('OPayPalEmail', $_POST)) $OPayPalEmail = $_POST['OPayPalEmail'];
if(array_key_exists('OMailAddress', $_POST)) $OMailAddress = $_POST['OMailAddress'];

if(array_key_exists('X', $_POST)) $X = $_POST['X'];
if(array_key_exists('Y', $_POST)) $Y = $_POST['Y'];

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

$sql = "INSERT INTO `Orgs` (`ORav`,`OEmail`,`OName`,`OStreetAddress`,`OCity`,`OState`,`OCountry`) VALUES ('" . $ORav .  "','" . $OEmail .  "','" . $OName .  "','" . $OStreetAddress .  "','" . $OCity .  "','" . $OState .  "','" . $OCountry . "')";
$resource = $conn->query($sql);

$OID = $conn->insert_id;
$sql = "INSERT INTO `POConn` (`PID`,`OID`) VALUES ('" . $ConfPID .  "','" . $OID . "')";
$resource = $conn->query($sql);
?>
