<?php
require 'openYDB.php';

// ReqPID, ReqType, ReqDate, ReqAmount, ReqPaidDate, ReqRequestSentDate,
// ReqRequestAcceptDate, ReqMoneySentDate, ReqCancelDate

$RID = "";

if(array_key_exists('RID', $_POST)) $RID = $_POST['RID'];

$sql = "SELECT * FROM Requests WHERE RID = " . $RID;

$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
echo json_encode($row);
?>
