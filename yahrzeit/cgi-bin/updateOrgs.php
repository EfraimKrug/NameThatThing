<?php
require 'openYDB.php';
$OrgID = "";
$ORav = "";
$OEmail = "";
$OName = "";
$OStreetAddress = "";
$OCity = "";
$OState = "";
$OCountry = "";

if(array_key_exists('ID', $_POST)) $OrgID = $_POST['ID'];
if(array_key_exists('ORav', $_POST)) $ORav = $_POST['ORav'];
if(array_key_exists('OEmail', $_POST)) $OEmail = $_POST['OEmail'];
if(array_key_exists('OName', $_POST)) $OName = $_POST['OName'];
if(array_key_exists('OStreetAddress', $_POST)) $OStreetAddress = $_POST['OStreetAddress'];
if(array_key_exists('OCity', $_POST)) $OCity = $_POST['OCity'];
if(array_key_exists('OState', $_POST)) $OState = $_POST['OState'];
if(array_key_exists('OCountry', $_POST)) $OCountry = $_POST['OCountry'];

$sql = "UPDATE Orgs SET ORav = " . "'" . $ORav . "'," .
                        "OEmail = " . "'" . $OEmail . "'," .
                        "OName = " . "'" . $OName . "'," .
                        "OStreetAddress = " . "'" . $OStreetAddress . "'," .
                        "OCity = " . "'" . $OCity . "'," .
                        "OState = " . "'" . $OState . "'," .
                        "OCountry = " . "'" . $OCountry . "'" .
              " WHERE OrgID = $OrgID";

echo $sql;
$resource = $conn->query($sql);
?>
