<?php
require 'openYDB.php';
$OrgID = "";

if(array_key_exists('OrgID', $_POST)) $OrgID = $_POST['OrgID'];

$sql = "DELETE FROM Orgs WHERE OrgID = " . $OrgID;
echo $sql;
$resource = $conn->query($sql);
?>
