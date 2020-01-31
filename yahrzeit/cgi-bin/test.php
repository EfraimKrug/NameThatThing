<?php
require 'openYDB.php';

$email = mysqli_real_escape_string ($conn ,  'efraimmkrug@gmail.com');

$today = date("Y-m-d H:i:s");

$sql = "SELECT * FROM People WHERE EMail = '" . $email . "';";
echo $sql;

$last_id = 0;
$result = $conn->query($sql);
echo $result->num_rows;

if ($result->num_rows > 1) {
  echo "YUP";
}

print_r($result);
?>
