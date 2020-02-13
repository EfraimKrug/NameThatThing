<?php
require 'openYDB.php';
require 'email.php';

$email = "";
$type = "";
$name = "";
$req = "":

if(array_key_exists('type', $_POST)) $type = $_POST['type'];
if(array_key_exists('email', $_POST)) $email = $_POST['email'];
if(array_key_exists('name', $_POST)) $name = $_POST['name'];
if(array_key_exists('req', $_POST)) $req = $_POST['req'];

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
