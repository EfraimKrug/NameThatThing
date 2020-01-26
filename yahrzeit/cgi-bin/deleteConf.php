<?php
require 'openYDB.php';
$ConfID = "";

if(array_key_exists('ConfID', $_POST)) $ConfID = $_POST['ConfID'];

$sql = "DELETE FROM Conf WHERE ConfID = " . $ConfID;

$resource = $conn->query($sql);
?>
