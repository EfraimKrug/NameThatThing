<?php
require 'openYDB.php';
// $_POST['PeopleID'] = 44;
$PeopleID = "";

if(array_key_exists('ID', $_POST)) $PeopleID = $_POST['ID'];

$sql = "SELECT * FROM Yahrzeits, PYConn WHERE YahrzeitID = YID AND PID = " . $PeopleID;

$resource = $conn->query($sql);
$ds = $resource->fetch_all(MYSQLI_ASSOC);
echo json_encode($ds);
?>
