<?php
require 'openYDB.php';

$PeopleID = "";

if(array_key_exists('ID', $_POST)) $PeopleID = $_POST['ID'];;

$sql = "SELECT RID, ReqType, YName, OName FROM Requests, Yahrzeits, Orgs WHERE ReqYID = YahrzeitID AND ReqOID = OrgID AND ReqPID = " . $PeopleID;

$resource = $conn->query($sql);
$ret = $resource->fetch_all(MYSQLI_ASSOC);
echo json_encode($ret);
?>
