<?php
require 'openYDB.php';

$month1 = "";
$month2 = "";

if(array_key_exists('MonthL', $_REQUEST)) $month1 = $_REQUEST['MonthL'];
if(array_key_exists('MonthH', $_REQUEST)) $month2 = $_REQUEST['MonthH'];

$sql = "SELECT * FROM `Requests` as R, `People` as P, `Yahrzeits` as Y WHERE R.ReqPID = P.PeopleID AND R.ReqYID = Y.YahrzeitID  AND (Y.YHMonth = '" . $month1 . "' OR Y.YHMonth = '" . $month2 . "') ORDER BY R.ReqOID, R.ReqYID";
// echo $sql;
$resource = $conn->query($sql);
$ds = $resource->fetch_all(MYSQLI_ASSOC);
echo json_encode($ds);
?>
