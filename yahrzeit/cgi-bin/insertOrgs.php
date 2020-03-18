<?php
require 'openYDB.php';
require 'email.php';

$ORav = "";
$OEmail = "";
$OName = "";
$OStreetAddress = "";
$OCity = "";
$OState = "";
$OCountry = "";
$OPayPalEmail = "";
$OMailAddress = "";

if (count($_REQUEST) < 4) die();

if(array_key_exists('ORav', $_REQUEST)) $ORav = urldecode($_REQUEST['ORav']);
if(array_key_exists('OEmail', $_REQUEST)) $OEmail = urldecode($_REQUEST['OEmail']);
if(array_key_exists('OName', $_REQUEST)) $OName = urldecode($_REQUEST['OName']);
if(array_key_exists('OStreetAddress', $_REQUEST)) $OStreetAddress = urldecode($_REQUEST['OStreetAddress']);
if(array_key_exists('OCity', $_REQUEST)) $OCity = urldecode($_REQUEST['OCity']);
if(array_key_exists('OState', $_REQUEST)) $OState = urldecode($_REQUEST['OState']);
if(array_key_exists('OCountry', $_REQUEST)) $OCountry = urldecode($_REQUEST['OCountry']);
if(array_key_exists('OPayPalEmail', $_REQUEST)) $OPayPalEmail = urldecode($_REQUEST['OPayPalEmail']);
if(array_key_exists('OMailAddress', $_REQUEST)) $OMailAddress = urldecode($_REQUEST['OMailAddress']);
if(array_key_exists('OrgKey', $_REQUEST)) $OrgKey = urldecode($_REQUEST['OrgKey']);
if(array_key_exists('OOwnerPID', $_POST)) $OOwnerPID = urldecode($_POST['OOwnerPID']);

if(array_key_exists('X', $_REQUEST)) $X = urldecode($_REQUEST['X']);
if(array_key_exists('Y', $_REQUEST)) $Y = urldecode($_REQUEST['Y']);

$today = date("Y-m-d H:i:s");
$OrgKey = crypt($today . $OEmail . $OName);

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

$sql = "INSERT INTO `Orgs` (`ORav`,`OEmail`,`OName`,`OStreetAddress`,`OCity`,`OState`,`OCountry`, `OrgKey`, `OOwnerPID`) VALUES ('" . $ORav .  "','" . $OEmail .  "','" . $OName .  "','" . $OStreetAddress .  "','" . $OCity .  "','" . $OState . "','" . $OCountry . "','" . $OrgKey . "','" . $ConfPID . "')";
$resource = $conn->query($sql);

$OID = $conn->insert_id;
$sql = "INSERT INTO `POConn` (`PID`,`OID`) VALUES ('" . $ConfPID .  "','" . $OID . "')";
$resource = $conn->query($sql);

echo "<html><body><pre>";

// echo "https://www.NameThatThing.site/acceptFirst.html?RID=0&PID=" . $ConfPID . "&X=" . $OrgKey . "&Y=" . $OID;
$href = "https://www.NameThatThing.site/acceptFirst.html?RID=0&PID=" . $ConfPID . "&X=" . $OrgKey . "&Y=" . $OID;
WelcomeOrg($OEmail, $ORav, $OID, $OrgKey, $href);
?>
