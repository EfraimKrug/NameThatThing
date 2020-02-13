<?php
require 'openYDB.php';
$PeopleID = "";

// print_r($_POST);
if(array_key_exists('ID', $_POST)) $PeopleID = $_POST['ID'];

$sql = "SELECT * FROM People WHERE PeopleID = " . $PeopleID;
// $sql = "SELECT * FROM People";

$resource = $conn->query($sql);
$dset = $resource->fetch_all(MYSQLI_ASSOC);
echo json_encode($dset);
?>
