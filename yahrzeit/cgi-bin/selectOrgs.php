<?php
require 'openYDB.php';
$OrgID = "";

if(array_key_exists('ID', $_REQUEST)) $OrgID = $_REQUEST['ID'];

$sql = "SELECT * FROM Orgs, POConn WHERE OrgID = OID AND OrgID = " . $OrgID;

$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
echo json_encode($row);
?>
