<!DOCTYPE>
<html>
<head>
<link rel = "stylesheet" type = "text/css" href = "../css/namethatthing.css" />
<style>
  #EntryDisplay {
    color:blue;
  }
</style>
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

$NNTSuggestion = mysqli_real_escape_string ($conn , $_REQUEST['NNTSuggestion']);
$NNTEntryKey = mysqli_real_escape_string ($conn , $_REQUEST['NNTEntryKey']);

# check if the user is coming back for a second vote... not nice!
$sql = "SELECT * FROM NTTEntry WHERE NNTEntryKey = " . $NNTEntryKey;
echo "<div id=EntryDisplay onclick=release()>Your entry: '" . $NNTSuggestion . "' (You can not vote for it, but others will be able to!)</div>";
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
    $newCount = $row['NNTVoteCount'] + 1;
  }
  else {
      $sql = "INSERT INTO NNTVoteCount (NNTEntry, NNTVoteCount) VALUES (" . $NNTEntryKey . ", 0)";
      if ($conn->query($sql) === TRUE) {
        $errorMessage .= "INSERT GOOD";
      } else {
        $errorMessage .= "INSERT BAD";
      }
  }

  $sql = "SELECT * FROM NNTVoteNavigation";
  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();
  $LastDisplay = $row['NNTLastDisplay'];
  $LastLevel = $row['NNTLastLevel'];
  $CycleCount = $row['NNTCycleCount'];
  $sql = "SELECT DISTINCT(E.NNTEntrySuggestion) AS NNTEntrySuggestion, E.NNTEntryKey AS NNTEntryKey FROM NTTEntry AS E, NNTVoteCount AS VC WHERE VC.NNTEntry = E.NNTEntryKey  AND VC.NNTEntry > $LastDisplay AND Voted = TRUE LIMIT 17;";
  // $sql = "SELECT * FROM NTTEntry AS E, NNTVoteCount AS VC WHERE VC.NNTEntry = E.NNTEntryKey AND VC.NNTEntry > $LastDisplay AND Voted = TRUE LIMIT 17;";
  $resource = $conn->query($sql);
  echo '<div id=formDiv>';
  echo '<form action="voteForm.php" method="post">';
  echo '<input type="hidden" id="EntryKey" name="EntryKey" value="' . $NNTEntryKey . '">';
  echo '<input type="hidden" id="EntryEmail" name="EntryEmail" value="' . $NNTEntryEmail . '">';
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
        $LastDisplay = $row['NNTEntryKey'];
        $gotRows = true;
      }
  } catch (Exception $e){
      $gotRows = false;
  }

  $sql2 = "UPDATE NNTVoteNavigation SET NNTLastDisplay = " . $LastDisplay;

  if ($rowCount < 17){
    $rowsNeeded = 17 - $rowCount;
    // $sql = "SELECT * FROM NTTEntry AS E, NNTVoteCount AS VC WHERE VC.NNTEntry = E.NNTEntryKey AND Voted = TRUE LIMIT " . $rowsNeeded . ";";
    $sql = "SELECT DISTINCT(E.NNTEntrySuggestion) AS NNTEntrySuggestion, E.NNTEntryKey AS NNTEntryKey FROM NTTEntry AS E, NNTVoteCount AS VC WHERE VC.NNTEntry = E.NNTEntryKey AND Voted = TRUE LIMIT " . $rowsNeeded . ";";
    $resource = $conn->query($sql);
    try {
      if($resource)
        while ( $row = $resource->fetch_assoc() ){
          echo "<tr>";
          echo "<td>" . $row['NNTEntrySuggestion'] . "</td><td><input type='checkbox' name='" . $row['NNTEntryKey'] . "' value='Yes' /></td>";
          echo "</tr>";
          $LastDisplay = $row['NNTEntryKey'];
          $sql2 = "UPDATE NNTVoteNavigation SET NNTLastDisplay = " . $LastDisplay . ", NNTCycleCount = " . ($CycleCount + 1);
          $gotRows = true;
        }
    } catch (Exception $e){
        $gotRows = false;
    }
  }

  if ($gotRows){
      echo "<tr></td>Choose <b>three</b> entries! (Or more, but only the first three are counted!)<td><td></td></tr>";
  }

  if($gotRows){
    echo '<tr></td><td><td><input id="SubmitButton" type="submit" value="Enter your Vote!"/></td></tr>';
  } else {
    echo "<tr>";
    echo "<td>Sorry! No qualified entries yet... come back next week!</td>";
    echo "</tr>";
  }


  if($conn->query($sql2) === true){
    $errorMessage = "Successfully updated LastDisplay";
  }

  echo '</table>';
  echo '</form>';
  echo '<div id="paypal-button-container"></div>';
  echo '</div>';
  echo '</body></html>';
  $conn->close();
?>
<script src="https://www.paypal.com/sdk/js?client-id=AfcRF9xThrarQuF4-C34Jpk9dR3d8F71Lqlpjo-SeTW3c9BI12fF7Byz5Pp3fAkIhmxaMiqpnmVJ8KI5&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
    function release(){
      document.getElementById("SubmitButton").disabled = false;
    }

    document.getElementById("SubmitButton").disabled = true;

    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'gold',
            layout: 'vertical',
            label: 'paypal',

        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '1'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                document.getElementById("SubmitButton").disabled = false;
                alert('Transaction completed by ' + details.payer.name.given_name + '!');
            });
        }
    }).render('#paypal-button-container');
</script>
