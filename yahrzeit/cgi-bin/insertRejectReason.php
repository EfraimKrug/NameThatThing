<?php
require 'openYDB.php';
$RID = "";
$RejectReason = "";

if(array_key_exists('rid', $_REQUEST)) $RID = $_REQUEST['rid'];
if(array_key_exists('rejectReason', $_REQUEST)) $RejectReason = urldecode($_REQUEST['rejectReason']);
print_r($_REQUEST);
$sql = "INSERT INTO `RejectReason` (`RejRID`,`RejReason`) VALUES (" . $RID .  ",'" . $RejectReason .  "')";
echo $sql;
$resource = $conn->query($sql);
?>
