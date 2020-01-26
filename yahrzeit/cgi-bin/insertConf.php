<?php
require 'openYDB.php';
$ConfEmail = "";
$ConfKeyIndex = "";
$ConfDateIndex = "";
$ConfPID = "";

if(array_key_exists('ConfEmail', $_POST)) $ConfEmail = $_POST['ConfEmail'];
if(array_key_exists('ConfKeyIndex', $_POST)) $ConfKeyIndex = $_POST['ConfKeyIndex'];
if(array_key_exists('ConfDateIndex', $_POST)) $ConfDateIndex = $_POST['ConfDateIndex'];
if(array_key_exists('ConfPID', $_POST)) $ConfPID = $_POST['ConfPID'];

$sql = "INSERT INTO `Conf` (`ConfEmail`,`ConfKeyIndex`,`ConfDateIndex`,`ConfPID`) VALUES ('" . $ConfEmail .  "','" . $ConfKeyIndex .  "','" . $ConfDateIndex .  "','" . $ConfPID . "')";
$resource = $conn->query($sql);
?>
