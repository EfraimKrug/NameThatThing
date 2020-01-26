<?php
require 'openYDB.php';

// ReqPID, ReqType, ReqDate, ReqAmount, ReqPaidDate, ReqRequestSentDate,
// ReqRequestAcceptDate, ReqMoneySentDate, ReqCancelDate

$RID = "";
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

if(array_key_exists('RID', $_POST)) $RID = $_POST['RID'];
if(array_key_exists('ReqPID', $_POST)) $ReqPID = $_POST['ReqPID'];
if(array_key_exists('ReqType', $_POST)) $ReqType = $_POST['ReqType'];
if(array_key_exists('ReqDate', $_POST)) $ReqDate = $_POST['ReqDate'];
if(array_key_exists('ReqAmount', $_POST)) $ReqAmount = $_POST['ReqAmount'];
if(array_key_exists('ReqPaidDate', $_POST)) $ReqPaidDate = $_POST['ReqPaidDate'];
if(array_key_exists('ReqRequestSentDate', $_POST)) $ReqRequestSentDate = $_POST['ReqRequestSentDate'];
if(array_key_exists('ReqRequestAcceptDate', $_POST)) $ReqRequestAcceptDate = $_POST['ReqRequestAcceptDate'];
if(array_key_exists('ReqMoneySentDate', $_POST)) $ReqMoneySentDate = $_POST['ReqMoneySentDate'];
if(array_key_exists('ReqCancelDate', $_POST)) $ReqCancelDate = $_POST['ReqCancelDate'];
if(array_key_exists('ReqYID', $_POST)) $ReqYID = $_POST['ReqYID'];
if(array_key_exists('ReqOID', $_POST)) $ReqOID = $_POST['ReqOID'];


$sql = "UPDATE Requests SET ReqPID = " . $ReqPID . "," .
                        "ReqType = " . $ReqType . "," .
                        "ReqDate = " . "'" . $ReqDate . "'," .
                        "ReqAmount = '" . $ReqAmount . "'," .
                        "ReqYID = " . $ReqYID . "," .
                        "ReqOID = " . $ReqOID . "," .
                        "ReqPaidDate = '" . $ReqPaidDate . "'," .
                        "ReqRequestSentDate = '" . $ReqRequestSentDate . "'," .
                        "ReqRequestAcceptDate = '" . $ReqRequestAcceptDate . "'," .
                        "ReqMoneySentDate = '" . $ReqMoneySentDate . "'," .
                        "ReqCancelDate = '" . $ReqCancelDate . "'" .

              " WHERE RID = $RID";
echo $sql;
$resource = $conn->query($sql);
?>
