<?php
require 'openYDB.php';
require 'email.php';

$ReqPID = "";
$ReqType = "";
$ReqDate = "";
$ReqAmount = "";
$ReqPaidDate = "";
$ReqRequestSentDate = "";
$ReqRequestAcceptDate = "";
$ReqMoneySentDate = "";
$ReqCancelDate = "";
$ReqYID = "";
$ReqOID = "";

date_default_timezone_set("America/New_York");
$today = date("Y-m-d");

if(array_key_exists('ReqPID', $_POST)) $ReqPID = $_POST['ReqPID'];
if(array_key_exists('ReqType', $_POST)) $ReqType = $_POST['ReqType'];
if(array_key_exists('ReqDate', $_POST)) $ReqDate = $today;
if(array_key_exists('ReqAmount', $_POST)) $ReqAmount = $_POST['ReqAmount'];
if(array_key_exists('ReqYID', $_POST)) $ReqYID = $_POST['ReqYID'];
if(array_key_exists('ReqOID', $_POST)) $ReqOID = $_POST['ReqOID'];
###########################
$sql = "SELECT YName, YHDay, YHMonth, ORav, OEmail  FROM  `Yahrzeits`, `Orgs` WHERE YahrzeitID = " . $ReqYID . " AND OrgID = " . $ReqOID;
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
$ydate =  $row['YHDay'] . " " . $row['YHMonth'];

$sql = "INSERT INTO `Requests` (`ReqPID`,`ReqType`,`ReqDate`,`ReqAmount`,`ReqPaidDate`,`ReqRequestSentDate`,`ReqRequestAcceptDate`,`ReqMoneySentDate`,`ReqCancelDate`, `ReqOID`, `ReqYID`) VALUES ('" . $ReqPID .  "','" . $ReqType . "','" . $ReqDate . "','" . $ReqAmount . "','" . $ReqPaidDate .   "','" . $ReqRequestSentDate .   "','" . $ReqRequestAcceptDate .   "','" . $ReqMoneySentDate . "','" . $ReqCancelDate . "','" . $ReqOID . "','" . $ReqYID . "')";
$resource = $conn->query($sql);
$RID = $conn->insert_id;

$href = "https://www.NameThatThing.site/accept.html?RID=" . $RID;
sendEmailRequest($row['OEmail'], $href, $row['ORav'], $ReqType, $row['YName'], $ydate, $ReqAmount);

?>
