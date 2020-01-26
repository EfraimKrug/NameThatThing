<?php
require 'openYDB.php';
$PeopleID = "";

if(array_key_exists('PeopleID', $_POST)) $PeopleID = $_POST['PeopleID'];

$sql = "DELETE FROM People WHERE PeopleID = " . $PeopleID;

$resource = $conn->query($sql);
?>
