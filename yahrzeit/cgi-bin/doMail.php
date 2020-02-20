<?php
require 'openYDB.php';
require 'email.php';

// echo "HERE";
$req = "";
$type = "";
$email = "";
$name = "";

// print_r($_REQUEST);

if(array_key_exists('type', $_REQUEST)) $type = $_REQUEST['type'];
if(array_key_exists('email', $_REQUEST)) $email = $_REQUEST['email'];
if(array_key_exists('name', $_REQUEST)) $name = $_REQUEST['name'];
if(array_key_exists('req', $_REQUEST)) $req = $_REQUEST['req'];

$sql = "SELECT * FROM Requests WHERE RID = " . $req;
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
$ReqAmount = $row['ReqAmount'];
$oid = $row['ReqOID'];
$yid = $row['ReqYID'];
$rType = $row['ReqType'];

$sql = "SELECT * FROM Conf, People WHERE PeopleID = ConfPID AND ConfPID = " . $row['ReqPID'];
$resource = $conn->query($sql);
$row1 = $resource->fetch_assoc();
$href = "https://www.NameThatThing.site/enterRequests.html?X=" . $row1['ConfKey'] . "&Y=" . $row1['FName'];

$sql = "SELECT * FROM Orgs WHERE OrgID = " . $oid;
$resource = $conn->query($sql);
$row2 = $resource->fetch_assoc();

$sql = "SELECT * FROM Yahrzeits WHERE YahrzeitID = " . $yid;
$resource = $conn->query($sql);
$row3 = $resource->fetch_assoc();
$ydate = $row3['YHDay'] . " " . $row3['YHMonth'];

if($type == "NextNoticeOrg") NextNoticeOrg($email, $row2['ORav'], $row2['OPayPalEmail'],$row2['OMailAddress']);
if($type == "CancelOrg") sendEmailCancelOrg($email);
if($type == "OrgCanceledPeople") sendEmailOrgCanceled($email, $name, $req, $href);
if($type == "ThanksPerson") sendPersonThanks($email, $name, $req, $href, $ReqAmount, $row2['OName'], $row3['YName']);
if($type == "OrgSchedule"){
  $href = "https://www.NameThatThing.site/accept.html?RID=" . $req . "&X=" . $row1['ConfKey'] . "&Y=" . $row1['FName'];
  sendEmailRequest($email, $href, $row2['ORav'], $rType, $row3['YName'], $ydate, $ReqAmount);
}
?>
