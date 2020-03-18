<?php
require 'openYDB.php';
$FName = "";
$LName = "";
$EMail = "";
$Secret = "";
$PeopleID = "";

if(array_key_exists('PeopleID', $_POST)) $PeopleID = $_POST['PeopleID'];
if(array_key_exists('FName', $_POST)) $FName = urldecode($_POST['FName']);
if(array_key_exists('LName', $_POST)) $LName = urldecode($_POST['LName']);
if(array_key_exists('EMail', $_POST)) $EMail = urldecode($_POST['EMail']);
if(array_key_exists('Secret', $_POST)) $Secret = urldecode($_POST['Secret']);

$sql = "UPDATE People SET FName = " . "'" . $FName . "'," .
                        "LName = " . "'" . $LName . "'," .
                        "EMail = " . "'" . $EMail . "'," .
                        "Secret = '" . $Secret . "'" .
              " WHERE PeopleID = $PeopleID";

$resource = $conn->query($sql);
?>
