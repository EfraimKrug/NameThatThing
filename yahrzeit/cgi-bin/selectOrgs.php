<?php
require 'openYDB.php';
$OrgID = "";

if(array_key_exists('ID', $_POST)) $OrgID = $_POST['ID'];

$sql = "SELECT * FROM Orgs WHERE OrgID = " . $OrgID;

$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
echo json_encode($row);
?>
