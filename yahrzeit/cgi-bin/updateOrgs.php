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
$OPayPalEmail = "";
$OMailAddress = "";
$OrgKey = "";
$OOwnerPID = "";

if(array_key_exists('ID', $_POST)) $OrgID = $_POST['ID'];
if(array_key_exists('ORav', $_POST)) $ORav = urldecode($_POST['ORav']);
if(array_key_exists('OEmail', $_POST)) $OEmail = urldecode($_POST['OEmail']);
if(array_key_exists('OName', $_POST)) $OName = urldecode($_POST['OName']);
if(array_key_exists('OStreetAddress', $_POST)) $OStreetAddress = urldecode($_POST['OStreetAddress']);
if(array_key_exists('OCity', $_POST)) $OCity = urldecode($_POST['OCity']);
if(array_key_exists('OState', $_POST)) $OState = urldecode($_POST['OState']);
if(array_key_exists('OCountry', $_POST)) $OCountry = urldecode($_POST['OCountry']);
if(array_key_exists('OPayPalEmail', $_POST)) $OPayPalEmail = urldecode($_POST['OPayPalEmail']);
if(array_key_exists('OMailAddress', $_POST)) $OMailAddress = urldecode($_POST['OMailAddress']);
if(array_key_exists('OrgKey', $_POST)) $OrgKey = urldecode($_POST['OrgKey']);
if(array_key_exists('OOwnerPID', $_POST)) $OOwnerPID = urldecode($_POST['OOwnerPID']);

$sql = "UPDATE Orgs SET ORav = " . "'" . $ORav . "'," .
                        "OEmail = " . "'" . $OEmail . "'," .
                        "OName = " . "'" . $OName . "'," .
                        "OStreetAddress = " . "'" . $OStreetAddress . "'," .
                        "OCity = " . "'" . $OCity . "'," .
                        "OState = " . "'" . $OState . "'," .
                        "OCountry = " . "'" . $OCountry . "', " .
                        "OPayPalEmail = " . "'" . $OPayPalEmail . "', " .
                        "OMailAddress = " . "'" . $OMailAddress . "', " .
                        "OrgKey = " . "'" . $OrgKey . "', " .
                        "OOwnerPID = " . "'" . $OOwnerPID . "', " .                        
                        "OFirstContact = TRUE " .

              " WHERE OrgID = $OrgID";

// echo $sql;
$resource = $conn->query($sql);
?>
