<?php
require 'openYDB.php';

$YahrzeitID = "";

if(array_key_exists('YahrzeitID', $_POST)) $YahrzeitID = $_POST['YahrzeitID'];

$sql = "DELETE FROM Yahrzeits WHERE YahrzeitID = " . $YahrzeitID;

$resource = $conn->query($sql);
?>
