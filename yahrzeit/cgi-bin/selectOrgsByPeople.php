<?php
require 'openYDB.php';
// essentially:
// select users orgs with a count on user connections UNION base orgs
$PeopleID = "";

if(array_key_exists('ID', $_POST)) $PeopleID = $_POST['ID'];

$sql = "SELECT * FROM Orgs, POConn WHERE OrgID = OID AND (PID = " . $PeopleID . " OR PID = 0) AND OFirstContact = TRUE ORDER BY PID DESC";

$resource = $conn->query($sql);
$ds = $resource->fetch_all(MYSQLI_ASSOC);
echo json_encode($ds);
?>
