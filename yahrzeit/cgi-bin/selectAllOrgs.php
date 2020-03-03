<?php
require 'openYDB.php';
$OrgID = "";

// print_r( $_REQUEST );
// if(array_key_exists('ID', $_POST)) $OrgID = $_POST['ID'];
//
$sql = "SELECT OrgID, OName FROM Orgs WHERE OFirstContact = TRUE";
// echo $sql;
$resource = $conn->query($sql);
$ds = $resource->fetch_all(MYSQLI_ASSOC);
echo json_encode($ds);
?>
