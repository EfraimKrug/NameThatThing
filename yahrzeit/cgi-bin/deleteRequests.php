<?php
require 'openYDB.php';

// ReqPID, ReqType, ReqDate, ReqAmount, ReqPaidDate, ReqRequestSentDate,
// ReqRequestAcceptDate, ReqMoneySentDate, ReqCancelDate

$RID = "";

if(array_key_exists('RID', $_POST)) $RID = $_POST['RID'];
if(array_key_exists('ID', $_POST)) $RID = $_POST['ID'];

$sql = "DELETE FROM Requests WHERE RID = " . $RID;

$resource = $conn->query($sql);
?>
