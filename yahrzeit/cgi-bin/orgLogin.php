<?php
require 'openYDB.php';
$OrgID = "";
$OrgKey = "";
$sql = "";
// This guarantees that:
// X = OrgKey matches the Key in Orgs
// Y = OID
$Y = addslashes ($_REQUEST['Y']);
$logon = TRUE;
  if(array_key_exists('Y', $_REQUEST)){
    $Y = addslashes ($_REQUEST['Y']);
      if(array_key_exists('X', $_REQUEST)){
        $OrgKey = $_REQUEST['X'];
        $sql = "SELECT * FROM Orgs WHERE OrgID = " . $Y . " AND OrgKey = '" . $OrgKey . "'";
      } else {
        $logon = FALSE;
      }
  } else {
    $logon = FALSE;
  }


  if(!$resource = $conn->query($sql)){
    $logon = FALSE;
  } else {
    $row = $resource->fetch_assoc();
  }

  if(!$row) $logon = FALSE;

  $rObj = $logon ? (object) array('RETURN' => 'TRUE', 'OID' => $Y) : (object) array('RETURN' => 'FALSE');
  echo json_encode($rObj);
?>
