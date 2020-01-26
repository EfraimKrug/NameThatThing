<?php
require 'openYDB.php';
// print_r($_SESSION);
$_SESSION['ENTRY'] = "";
function sendEmail($email, $href, $yahrName){
  $to = $email;
  $subject = 'Yahrzeit Holder: Verifying your email address';
  $message = "<html>
              <body bgcolor=\"#DCEEFC\">
              <center>
              Hi! Please <a href='$href'>click on the link</a> to verify your email address...
              <br>
              The way this works:
              <br>
              You have entered the name: '$yahrName'.
              <br>
              Once you have confirmed your email address you are done!
              <br>
              Best,
              <br>
              Efraim
              </center>
              </body>
              </html>";

  $headers = "From: EfraimMKrug@GMail.com\r\n";
  $headers .= "Reply-To: EfraimMKrug@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}

$email = mysqli_real_escape_string ($conn ,  $_POST['email']);
$fname = mysqli_real_escape_string ($conn ,  $_POST['fname']);
#$mname = mysqli_real_escape_string ($conn ,  $_POST['mname']);
$lname = mysqli_real_escape_string ($conn ,  $_POST['lname']);
$secret = mysqli_real_escape_string ($conn ,  $_POST['secret']);

// $yahrName = mysqli_real_escape_string ($conn ,  $_POST['yahrName']);
// $yahrDate = mysqli_real_escape_string ($conn ,  $_POST['yahrDate']);
// $yahrHDate = mysqli_real_escape_string ($conn ,  $_POST['yahrHDate']);
// $orgName = mysqli_real_escape_string ($conn ,  $_POST['orgName']);
// $orgEmail = mysqli_real_escape_string ($conn ,  $_POST['orgEmail']);
// $orgAddress = mysqli_real_escape_string ($conn ,  $_POST['orgAddress']);
// $orgCity = mysqli_real_escape_string ($conn ,  $_POST['orgCity']);
// $orgState = mysqli_real_escape_string ($conn ,  $_POST['orgState']);
// $orgPostalCode = mysqli_real_escape_string ($conn ,  $_POST['orgPostalCode']);
// $orgCountry = mysqli_real_escape_string ($conn ,  $_POST['orgCountry']);

// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//   header('Location:/index.html?RETURN=Email%20is%20not%20correct!%20Sorry!');
//   exit(1);
// }

// if (preg_match("/^\b*$/",$name)) {
//   header('Location:/index.html?RETURN=Entry%20is%20not%20correct!%20Sorry!!');
//   exit(1);
// }

$today = date("Y-m-d H:i:s");
$ConfKey = crypt($today . $email . $name);
$sql = "SELECT * FROM People WHERE EMail = '" . $email . "';";
$last_id = 0;
$result = $conn->query($sql);
if ($result->num_rows > 1) {
  header('Location:/startYahr.html?RETURN=That%20Email%20is%20already%20registered!');
  exit(1);
} else {
  $sql = "INSERT INTO `People` (`FName`, `LName`, `Email`, `Secret`)  VALUES ('" . $fname . "','" . $lname . "','" . $email . "','" . $secret . "')";
  if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    $sql2 = "INSERT INTO `Conf` (`ConfEmail`, `ConfKey`, `ConfDate`, `ConfPID`) VALUES ('" .  $email . "','" . mysqli_real_escape_string ($conn ,  $ConfKey) . "','" . $today ."'," . $last_id . ")";
    if ($conn->query($sql2) === TRUE) {
      $confirmationString = "ConfKey=" . $ConfKey . "&ConfEmail=" . $email . "&NNTEntryKey=" . $last_id . "'";
      $href = "http://www.yahrzeit.NameThatThing.site/yahrzeit/cgi-bin/confirmationPage.php?" . $confirmationString;
      sendEmail($email, $href, $yahrName);
    }
  } else {
    echo "Sorry: Something weird happened! Please come back later after we get this fixed...";
    exit(1);
  }
}

// else {
//    echo "Sorry: Something weird happened! Please come back later after we get this fixed...";
//    exit(1);
// }
// $sql3 = "INSERT INTO `Yahrzeits`(`YName`, `YGDate`, `YHMonth`, `YHDay`, `YHYear`) VALUES ('" .  $yahrName . "','" . $yahrDate . "','" . $yahrHDate ."'," . $last_id . ")";
// $conn->query($sql3);
// $sql4 = "INSERT INTO `Orgs`(`ORav`, `OEmail`, `OName`, `OAdmin`, `OAEmail`, `OStreetAddress`, `OCity`, `OState`, `OCountry`) VALUES ('" . $orgRav . "','" . $orgEmail . "','" . $orgName . "','" . $orgAdmin . "','" . $OrgAdminEmail .  "','" . $orgAddress . "','" . $orgCity .  "','" . $orgState . "','" . $orgCountry . "')";
// $conn->query($sql4);

$conn->close();
header("Location: http://www.NameThatThing.site/getYahrzeit.html");
?>
