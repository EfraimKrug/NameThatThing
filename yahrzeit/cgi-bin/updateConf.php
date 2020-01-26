<?php
require 'openYDB.php';
$ConfEmail = "";
$ConfKeyIndex = "";
$ConfDateIndex = "";
$ConfPID = "";
$ConfID = "";

if(array_key_exists('ConfEmail', $_POST)) $ConfEmail = $_POST['ConfEmail'];
if(array_key_exists('ConfKeyIndex', $_POST)) $ConfKeyIndex = $_POST['ConfKeyIndex'];
if(array_key_exists('ConfDateIndex', $_POST)) $ConfDateIndex = $_POST['ConfDateIndex'];
if(array_key_exists('ConfPID', $_POST)) $ConfPID = $_POST['ConfPID'];
if(array_key_exists('ConfID', $_POST)) $ConfID = $_POST['ConfID'];

$sql = "UPDATE Conf SET ConfEmail = " . "'" . $ConfEmail . "'," .
                        "ConfKeyIndex = " . "'" . $ConfKeyIndex . "'," .
                        "ConfDateIndex = " . "'" . $ConfDateIndex . "'," .
                        "ConfPID = " . $ConfPID . "," .
              " WHERE ConfID = $ConfID";

$resource = $conn->query($sql);
?>
