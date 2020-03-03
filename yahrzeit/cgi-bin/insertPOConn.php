<?php
require 'openYDB.php';
$PID = "";
$OID = "";

if(array_key_exists('PID', $_POST)) $PID = $_POST['PID'];
if(array_key_exists('OID', $_POST)) $OID = $_POST['OID'];

$sql = "SELECT * FROM POConn WHERE PID = " . $PID . " AND OID = " . $OID;
$resource = $conn->query($sql);
$rowcount =  mysqli_num_rows($resource);
if ($rowcount == 0){
  $sql = "INSERT INTO `POConn` (`PID`,`OID`) VALUES ('" . $PID .  "','" . $OID . "')";
  $resource = $conn->query($sql);
}
?>
