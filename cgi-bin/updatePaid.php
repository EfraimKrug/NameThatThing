<?php
require 'openDB.php';
$sql = "UPDATE NTTEntry SET NNTPaid = TRUE WHERE NNTEntryKey = " . $_REQUEST['KEY'] . ";";
$resource = $conn->query($sql);
if ($row = $resource->fetch_assoc()){
  echo $_REQUEST['KEY'];
} else {
  echo 0;
}
?>
