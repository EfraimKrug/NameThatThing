<?php
$servername = "efraimmkrug71828.domaincommysql.com";
$username = "yahrzeit";
$password = "Y#hrze1tdb";
$dbname = "yahrzeitdb";
$messageBack = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
?>
