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

$sql = "SELECT * FROM Conf, People WHERE PeopleID = ConfPID AND ConfPID = " . $row['ReqPID'];
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();

$href = "https://www.NameThatThing.site/enterRequests.html?X=" . $row['ConfKey'] . "&Y=" . $row['FName'];

if($type == "CancelOrg") sendEmailCancelOrg($email);
if($type == "OrgCanceledPeople") sendEmailOrgCanceled($email, $name, $req, $href);
?>
