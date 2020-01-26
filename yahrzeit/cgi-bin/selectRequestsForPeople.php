<?php
require 'openYDB.php';

$PeopleID = "";

if(array_key_exists('PeopleID', $_POST)) $PeopleID = $_POST['PeopleID'];

$sql = "SELECT * FROM Requests WHERE ReqPID = " . $PeopleID;

$resource = $conn->query($sql);
$ret = $resource->fetch_all(MYSQLI_ASSOC);
echo json_encode($ret);
?>
