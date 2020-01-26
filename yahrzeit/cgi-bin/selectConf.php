<?php
require 'openYDB.php';
$ConfID = "";
if(array_key_exists('ID', $_POST) && ($_POST['ID'] > 0)){
  $ConfID = $_POST['ID'];
  $sql = "SELECT * FROM Conf WHERE ConfID = " . $ConfID;
}
else
  if(array_key_exists('ConfKey', $_POST)){
    $ConfKey = $_POST['ConfKey'];
    $sql = "SELECT * FROM Conf WHERE ConfKey = '" . $ConfKey . "'";
  }

$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
echo json_encode($row);
?>
