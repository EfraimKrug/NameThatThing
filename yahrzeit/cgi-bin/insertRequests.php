<?php
require 'openYDB.php';

// ReqPID, ReqType, ReqDate, ReqAmount, ReqPaidDate, ReqRequestSentDate,
// ReqRequestAcceptDate, ReqMoneySentDate, ReqCancelDate
//ID=0&ReqPID=49&ReqType=Yahrzeit&ReqDate=&ReqAmount=18.00&ReqPaidDate=&ReqRequestSentDate=&ReqRequestAcceptDate=&ReqMoneySentDate=&ReqCancelDate=
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


// if(array_key_exists('ReqPaidDate', $_POST)) $ReqPaidDate = $_POST['ReqPaidDate'];
// if(array_key_exists('ReqRequestSentDate', $_POST)) $ReqRequestSentDate = $_POST['ReqRequestSentDate'];
// if(array_key_exists('ReqRequestAcceptDate', $_POST)) $ReqRequestAcceptDate = $_POST['ReqRequestAcceptDate'];
// if(array_key_exists('ReqMoneySentDate', $_POST)) $ReqMoneySentDate = $_POST['ReqMoneySentDate'];
// if(array_key_exists('ReqCancelDate', $_POST)) $ReqCancelDate = $_POST['ReqCancelDate'];

$sql = "INSERT INTO `Requests` (`ReqPID`,`ReqType`,`ReqDate`,`ReqAmount`,`ReqPaidDate`,`ReqRequestSentDate`,`ReqRequestAcceptDate`,`ReqMoneySentDate`,`ReqCancelDate`, `ReqOID`, `ReqYID`) VALUES ('" . $ReqPID .  "','" . $ReqType . "','" . $ReqDate . "','" . $ReqAmount . "','" . $ReqPaidDate .   "','" . $ReqRequestSentDate .   "','" . $ReqRequestAcceptDate .   "','" . $ReqMoneySentDate . "','" . $ReqCancelDate . "','" . $ReqOID . "','" . $ReqYID . "')";
$resource = $conn->query($sql);
?>
