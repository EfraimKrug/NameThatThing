<?php
require 'openYDB.php';
$PID = "";
$YID = "";

if(array_key_exists('PID', $_POST)) $PID = $_POST['PID'];
if(array_key_exists('YID', $_POST)) $YID = $_POST['YID'];

$sql = "INSERT INTO `PYConn` (`PID`,`YID`) VALUES ('" . $PID .  "','" . $YID . "')";
$resource = $conn->query($sql);
?>
