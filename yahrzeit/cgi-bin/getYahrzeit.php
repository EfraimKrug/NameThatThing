<?php
# $_REQUEST:
# Array ( [yname] => Whole Name [gmonth] => March [gday] => 4 [gyear] => 1975 [hmonth] => Adar [hday] => 7 [hyear] => 5758 [email] => Happy@Gmail.com )
#
require 'openYDB.php';
require 'email.php';

$yname = mysqli_real_escape_string ($conn ,  $_REQUEST['yname']);
$gmonth = mysqli_real_escape_string ($conn ,  $_REQUEST['gmonth']);
$gday = mysqli_real_escape_string ($conn ,  $_REQUEST['gday']);
$gyear = mysqli_real_escape_string ($conn ,  $_REQUEST['gyear']);
$hmonth = mysqli_real_escape_string ($conn ,  $_REQUEST['hmonth']);
$hday = mysqli_real_escape_string ($conn ,  $_REQUEST['hday']);
$hyear = mysqli_real_escape_string ($conn ,  $_REQUEST['hyear']);

$email = mysqli_real_escape_string ($conn ,  $_REQUEST['email']);
$YGDate = $gyear . "-" . $gmonth . "-" . $gday;

$sql = "SELECT * FROM People WHERE EMail = '" . $email . "';";
// echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  // print_r($row);
  $sql = "INSERT INTO `Yahrzeits` (`YName`,`YGDate`,`YHMonth`,`YHDay`,`YHYear`) VALUES ('" . $yname .  "','" . $YGDate . "','" . $hmonth . "','" . $hday . "','" . $hyear . "')";
  $resource = $conn->query($sql);

  $YID = $conn->insert_id;
  $sql = "INSERT INTO `PYConn` (`PID`,`YID`) VALUES ('" . $row['PeopleID'] .  "','" . $YID . "')";
  $resource = $conn->query($sql);
  echo "<body><p>Thanks so much</p></body>";
  die();
}
echo "<body><p>Something went a little wrong...</p></body>";
?>
