<?php
$servername = "efraimmkrug71828.domaincommysql.com";
$username = "namethatthingdb";
$password = "namethatthingdb";
$dbname = "namethatthingdb";
$messageBack = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
?>
