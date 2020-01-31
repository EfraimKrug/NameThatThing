<?php
require 'openYDB.php';
$FName = "";
$LName = "";
$EMail = "";
$Secret = "";

if(array_key_exists('FName', $_POST)) $FName = $_POST['FName'];
if(array_key_exists('LName', $_POST)) $LName = $_POST['LName'];
if(array_key_exists('EMail', $_POST)) $EMail = $_POST['EMail'];
if(array_key_exists('Secret', $_POST)) $Secret = $_POST['Secret'];

$sql = "INSERT INTO `People` (`FName`,`LName`,`EMail`,`Secret`) VALUES ('" . $FName .  "','" . $LName .  "','" . $EMail .  "','" . $Secret . "')";
// echo $sql;
$resource = $conn->query($sql);
?>
