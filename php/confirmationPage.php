<!DOCTYPE>
<html>
<head>
<link rel = "stylesheet" type = "text/css" href = "../css/namethatthing.css" />
</head>
<body>
<id=topDiv>
  <table>
    <tr>
    <td><img src="../images/dots.gif"></td>
    <td><img src="../images/NameTitle.gif"></td>
    <td><img src="../images/WavyDots.gif"></td>
    </tr>
  </table>
</div>
<?php

require 'openDB.php';

$NNTKey = mysqli_real_escape_string ($conn ,  $_REQUEST['NNTKey']);
$NNTEntryEmail = mysqli_real_escape_string ($conn ,  $_REQUEST['NNTEntryEmail']);

$NNTKey = $_REQUEST['NNTKey'];
$NNTEntryEmail =  $_REQUEST['NNTEntryEmail'];
$NNTSuggestion = $_REQUEST['NNTSuggestion'];
$NNTEntryKey = $_REQUEST['NNTEntryKey'];

# check if the user is coming back for a second vote... not nice!
$sql = "SELECT * FROM NTTEntry WHERE NNTEntryKey = " . $NNTEntryKey;
$resource = $conn->query($sql);
if ($row = $resource->fetch_assoc()){
  if ($row['Voted']){
      echo '<div id=formDiv>';
      echo "<br><br>Oh, I am so sorry! You can only vote once for each entry...";
      echo "<br><br>But you are welcome to enter <a href='../index.html'> again! </a>";
      echo '</div>';
      exit(1);
  }
}

$sql = "SELECT COUNT(*) AS RECORD_COUNT FROM NNTDeadEmail WHERE NNTEmail = '" . $NNTEntryEmail . "' AND NNTKey = '" . $NNTKey . "'";
$resource = $conn->query($sql);
if ($row = $resource->fetch_assoc()){
  if ($row['RECORD_COUNT'] < 1){
      echo '<div id=formDiv>';
      echo "<br><br>Oh, I am so sorry! Your entry has timed out and been deleted...";
      echo "<br><br>But you are welcome to<a href='../index.html'> enter it again! </a>";
      echo '</div>';
      exit(1);
  }
}

$sql = "DELETE FROM NNTDeadEmail WHERE NNTEmail = '" . $NNTEntryEmail . "' AND NNTKey = '" . $NNTKey . "'";

if ($conn->query($sql) === TRUE) {
    $errorMessage = $NNTEntryEmail . " [" . $NNTKey . "] has been deleted";
 } else {
    $errorMessage = "<br>Error: " . $sql . "<br>" . $conn->error;
}


$sql = "SELECT * FROM NNTVoteCount WHERE NNTEntry = " . $NNTEntryKey;
$resource = $conn->query($sql);
if ($row = $resource->fetch_assoc()){
    // this update below works!
    $newCount = $row['NNTVoteCount'] + 1;
    // $sql = "UPDATE NNTVoteCount SET NNTVoteCount = " . $newCount . " WHERE  NNTENTRY = '" . $NNTSuggestion . "'";
    // echo "[" . $sql . "]";
    // $conn->query($sql);
  }
  else {
      $sql = "INSERT INTO NNTVoteCount (NNTEntry, NNTVoteCount) VALUES (" . $NNTEntryKey . ", 0)";
      // echo $sql;
      if ($conn->query($sql) === TRUE) {
        $errorMessage .= "INSERT GOOD";
      } else {
        $errorMessage .= "INSERT BAD";
      }
      // echo $errorMessage;
  }

  $sql = "SELECT * FROM NNTVoteNavigation";
  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();
  $LastDisplay = $row['NNTLastDisplay'];
  $LastLevel = $row['NNTLastLevel'];

  $sql = "SELECT * FROM NTTEntry AS E, NNTVoteCount AS VC WHERE VC.NNTEntry = E.NNTEntryKey AND VC.NNTEntry > $LastDisplay AND Voted = TRUE LIMIT 10;";
  $resource = $conn->query($sql);
  echo '<div id=formDiv>';
  echo '<form action="voteForm.php" method="post">';
  echo '<input type="hidden" id="EntryKey" name="EntryKey" value="' . $NNTEntryKey . '">';
  echo '<table>';

  $gotRows = false;
  $rowCount = 0;

  try {
    if($resource)
      while ( $row = $resource->fetch_assoc() ){
        $rowCount++;
        echo "<tr>";
        echo "<td>" . $row['NNTEntrySuggestion'] . "</td><td><input type='checkbox' name='" . $row['NNTEntryKey'] . "' value='Yes' /></td>";
        echo "</tr>";
        $gotRows = true;
      }
  } catch (Exception $e){
      // echo $e->getMessage();
      $gotRows = false;
  }

  if ($gotRows){
      echo "<tr></td>Choose <b>three</b> entries!<td><td></td></tr>";
  }

  if($gotRows){
    echo '<tr></td><td><td><input type="submit"  value="Enter your Vote!"/></td></tr>';
  } else {
    echo "<tr>";
    echo "<td>Sorry! No qualified entries yet... come back next week!</td>";
    echo "</tr>";
  }

  $sql = "SELECT MAX(NNTEntryKey) AS HIGH_ENTRY FROM NTTEntry WHERE Voted = TRUE;";
  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();
  $maxEntry = $row['HIGH_ENTRY'];

  // print_r($row);

#$lastDisplay is still pointing at the entry BEFORE the first entry being displayed
  $lastDisplayP10 = $LastDisplay + 10;
  // echo $lastDisplayP10;
  if($lastDisplayP10 >= $maxEntry){
    $LastDisplay = 0;
    // echo "if: [" . $lastDisplayP10 . "] >= [" . $maxEntry . "]";
  } else {
    $maxEntryM10 = $maxEntry - 10;
    $sql = "SELECT COUNT(*) AS NDISP_COUNT FROM NTTEntry WHERE Voted = FALSE AND NNTEntryKey > $maxEntryM10;";
    $resource = $conn->query($sql);
    $row = $resource->fetch_assoc();
    $skipCount = $row['NDISP_COUNT'];

    // echo "else: " . $maxEntryM10;
    if ($lastDisplayP10 >= $maxEntryM10){
      // echo "else/if: [" . $lastDisplayP10 . "] >= [" . $maxEntryM10 . "]";
      $LastDisplay = $maxEntry - (10 + $skipCount);
    } else {
      $LastDisplay += 10;
      // echo "else/else: " . $LastDisplay;
    }
  }
  // echo "after the mess: " . $LastDisplay;
  $sql = "UPDATE NNTVoteNavigation SET NNTLastDisplay = " . $LastDisplay;
  // echo "[" . $sql . "]";
  if($conn->query($sql) === true){
    $errorMessage = "Successfully updated LastDisplay";
  }

  echo '</table>';
  echo '</form>';
  echo '</div>';
  echo '</body></html>';
  $conn->close();
?>
