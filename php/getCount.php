<?php
require 'openDB.php';
$sql = "SELECT COUNT(*) AS RECORD_COUNT FROM NTTEntry WHERE Voted = TRUE;";
$resource = $conn->query($sql);
if ($row = $resource->fetch_assoc()){
  echo $row['RECORD_COUNT'];
} else {
  echo 0;
}
?>
