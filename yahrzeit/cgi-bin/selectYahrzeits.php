<?php
require 'openYDB.php';

$YahrzeitID = "";

if(array_key_exists('ID', $_POST)) $YahrzeitID = $_POST['ID'];

$sql = "SELECT * FROM Yahrzeits WHERE YahrzeitID = " . $YahrzeitID;

$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
echo json_encode($row);
?>
