<?php
require 'openYDB.php';
// ID=56&YName=Yada Yada Yada&YGDate=1802-2-5&YHMonth=Tishrei&YHDay=7&YHYear=5562
//Yahrzeits(YName, YGDate, YHMonth, YHDay, YHYear)
$YahrzeitID = "";
$YName = "";
$YGDate = "";
$YHMonth = "";
$YHDay = "";
$YHYear = "";

if(array_key_exists('ID', $_POST)) $YahrzeitID = $_POST['ID'];
if(array_key_exists('YName', $_POST)) $YName = urldecode($_POST['YName']);
if(array_key_exists('YGDate', $_POST)) $YGDate = $_POST['YGDate'];
if(array_key_exists('YHMonth', $_POST)) $YHMonth = $_POST['YHMonth'];
if(array_key_exists('YHDay', $_POST)) $YHDay = $_POST['YHDay'];
if(array_key_exists('YHYear', $_POST)) $YHYear = $_POST['YHYear'];

$sql = "UPDATE Yahrzeits SET YName = '" . $YName . "'," .
                        "YGDate = '" . $YGDate . "'," .
                        "YHMonth = '" . $YHMonth . "'," .
                        "YHDay = '" . $YHDay . "'," .
                        "YHYear = '" . $YHYear . "'" .
              " WHERE YahrzeitID = $YahrzeitID";
echo $sql;
$resource = $conn->query($sql);
?>
