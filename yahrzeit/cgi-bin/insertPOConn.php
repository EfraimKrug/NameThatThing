<?php
require 'openYDB.php';
$PID = "";
$OID = "";

if(array_key_exists('PID', $_POST)) $PID = $_POST['PID'];
if(array_key_exists('OID', $_POST)) $OID = $_POST['OID'];

$sql = "INSERT INTO `POConn` (`PID`,`OID`) VALUES ('" . $PID .  "','" . $OID . "')";
$resource = $conn->query($sql);
?>
