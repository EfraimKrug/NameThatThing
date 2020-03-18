<?php
require 'openYDB.php';
require 'email.php';

// echo "HERE";
$RID = "";
$PID = "";
$OID = "";
$YID = "";
$data = "";

$rejReason = "";

if(array_key_exists('type', $_REQUEST)) $type = $_REQUEST['type'];
if(array_key_exists('RID',  $_REQUEST)) $RID =  $_REQUEST['RID'];
if(array_key_exists('PID',  $_REQUEST)) $PID =  $_REQUEST['PID'];
if(array_key_exists('OID',  $_REQUEST)) $OID =  $_REQUEST['OID'];
if(array_key_exists('YID',  $_REQUEST)) $YID =  $_REQUEST['YID'];
if(array_key_exists('data', $_REQUEST)) $data = $_REQUEST['data'];

if($RID){
  $sql = "SELECT * FROM Requests WHERE RID = " . $RID;
  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();
  $ReqAmount = $row['ReqAmount'];
  $OID = $row['ReqOID'];
  $YID = $row['ReqYID'];
  $PID = $row['ReqPID'];
  $rType = $row['ReqType'];
}

if($RID){
  $sql = "SELECT * FROM RejectReason WHERE RejRID = " . $RID;
  $resource5 = $conn->query($sql);
  $row5 = $resource5->fetch_assoc();
  $rejReason = $row5['RejReason'];
}

if($PID){
  $sql = "SELECT * FROM Conf, People WHERE PeopleID = ConfPID AND ConfPID = " . $PID;
  $resource1 = $conn->query($sql);
  $row1 = $resource1->fetch_assoc();
  // $href = "https://www.NameThatThing.site/enterRequests.html?X=" . $row1['ConfKey'] . "&Y=" . $row1['FName'];
  $today = date("Y-m-d H:i:s");
  $ConfKey = crypt($today . $row1['EMail'] . $row1['FName']);
  $sql2 = "UPDATE `Conf` SET ConfKey = '" . $ConfKey . "', ConfTime = NULL WHERE ConfPID = " . $PID;
  $resource4 = $conn->query($sql2);
}

if($OID){
  $sql = "SELECT * FROM Orgs WHERE OrgID = " . $OID;
  $resource2 = $conn->query($sql);
  $row2 = $resource2->fetch_assoc();
}

if($YID){
  $sql = "SELECT * FROM Yahrzeits WHERE YahrzeitID = " . $YID;
  $resource3 = $conn->query($sql);
  $row3 = $resource3->fetch_assoc();
  $ydate = $row3['YHDay'] . " " . $row3['YHMonth'];
  // $yname = $row3['YName'];
}

$confirmationString = "ConfKey=" . $ConfKey . "&ConfEmail=" . $row1['EMail'] . "&ConfPID=" . $PID;
$href = "http://www.NameThatThing.site/cgi-bin/welcomeBackPage.php?" . $confirmationString;
// $reason = "NO WAY DUDE";
if($type == "OrgCanceledPeople") OrgCanceledPeople($row1['EMail'], $row1['FName'], $href, $rejReason);
if($type == "OrgAcceptedPeople") OrgAcceptedPeople($row1['EMail'], $row1['FName'], $row2['ORav'], $row2['OName'], $row3['YName'], $row['ReqType'], $ydate);
if($type == "sendPersonNotify") sendPersonNotify($row1['EMail'], $row1['FName'], $row2['OName'], $row2['ORav'], $href);
if($type == "NextNoticeOrg") NextNoticeOrg($row2['OEmail'], $row2['ORav'], $row2['OPayPalEmail'], $row2['OMailAddress'], $row2['OrgID'], $row2['OrgKey']);

//OrgAcceptedPeople($email, $name, $orav, $oname, $yname, $rType, $ydate)
?>
