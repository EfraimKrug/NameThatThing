<!DOCTYPE>
<html>
<head>
<link rel = "stylesheet" type = "text/css" href = "../css/namethatthing.css" />
<style>
  #EntryDisplay {
    color:blue;
  }
  #paypal-button-container {
    width: 150px;
  }
</style>
</head>
<body>
  <script>
    function completePaymentAction(){
      document.getElementById("SubmitButton").disabled = false;
      updateNNTPaid();
    }

    function release(){
      completePaymentAction();
    }
  </script>
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
#$NNTSuggestion = preg_replace('/\s*/', ' ', $NNTSuggestion);
#$NNTSuggestion = strtolower($NNTSuggestion);

$NNTEntryKey = mysqli_real_escape_string ($conn , $_REQUEST['NNTEntryKey']);

# check if the user is coming back for a second vote... not nice!

$sql = "SELECT * FROM NTTEntry WHERE NNTEntryKey = " . $NNTEntryKey;
#echo "<div id=EntryDisplay onclick=release()>Your entry: '" . $NNTSuggestion . "' (You can vote for it!)</div>";
echo "<div id=EntryDisplay>Your entry: '" . $NNTSuggestion . "' (You can vote for it!)<br><br><i>Enter your vote for $1.00. Only one vote per entry!</i><br><br></div>";
$resource = $conn->query($sql);
if ($row = $resource->fetch_assoc()){
  if ($row['Voted']){
      echo '<div id=formDiv>';
      echo "<br><br>Oh, I am so sorry! You can only vote once for each entry...";
      echo "<br><br>But you are welcome to enter <a href='../index.html'> again! </a>";
      echo '</div>';
      exit(1);
  }

  $NNTPaid = $row['NNTPaid'];
  if (!$row['NNTConfirmed']){
      setConfirmation($conn, $NNTEntryEmail, $NNTKey, $NNTEntryKey);
  }

  if (!$NNTPaid){
    echo '<div id="paypal-button-container"></div>';
    echo '<script>var NOT_PAID = true;</script>';
  } else {
    echo '<script>var NOT_PAID = false;</script>';
  }
}

function setConfirmation($conn, $NNTEntryEmail, $NNTKey, $NNTEntryKey){
    $sql = "SELECT COUNT(*) AS RECORD_COUNT FROM NNTDeadEmail WHERE NNTEmail = '" . $NNTEntryEmail . "' AND NNTKey = '" . $NNTKey . "';";
    try {
      $resource = $conn->query($sql);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
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
    $sql = "UPDATE NTTEntry SET NNTConfirmed = TRUE WHERE NNTEntryKey = " . $NNTEntryKey . ";";
    $resource = $conn->query($sql);
  }

///////////////////////////////////////////////////////////////////////////////////////////////
//
#check number of times that entry has been entered!
# block this entry if > 20

$sql = "SELECT COUNT(*) AS RECORD_COUNT FROM NTTEntry WHERE Voted = TRUE AND NNTEntrySuggestion = '" . $NNTSuggestion . "';";
$resource = $conn->query($sql);
if ($row = $resource->fetch_assoc()){
  $entryCount = $row['RECORD_COUNT'];
} else {
  $entryCount = 0;
}

if($entryCount > 20){
  header('Location:/index.html?RETURN=The entry:%20' . preg_replace('/\s/','%20', $NNTSuggestion) . '%20has%20been%20entered%20more%20than%20twenty%20times!!');
  exit(1);
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

//get last voting position - to get a fresh 20 possibilities
  $sql = "SELECT * FROM NNTVoteNavigation";
  $resource = $conn->query($sql);
  $row = $resource->fetch_assoc();
  $LastDisplay = $row['NNTLastDisplay'];
  // $LastLevel = $row['NNTLastLevel'];
  $CycleCount = $row['NNTCycleCount'];
  // limit = 365: 20 rows / entry allowed (17 * 20 = 340)
  $sql = "SELECT E.NNTEntrySuggestion AS NNTEntrySuggestion, E.NNTEntryKey AS NNTEntryKey FROM NTTEntry AS E, NNTVoteCount AS VC WHERE VC.NNTEntry = E.NNTEntryKey  AND VC.NNTEntry > $LastDisplay AND Voted = TRUE LIMIT 365;";
  // $sql = "SELECT * FROM NTTEntry AS E, NNTVoteCount AS VC WHERE VC.NNTEntry = E.NNTEntryKey AND VC.NNTEntry > $LastDisplay AND Voted = TRUE LIMIT 17;";
  $resource = $conn->query($sql);
  echo '<div id=formDiv>';
  echo '<form action="voteForm.php" method="post">';
  echo '<input type="hidden" id="EntryKey" name="EntryKey" value="' . $NNTEntryKey . '">';
  echo '<input type="hidden" id="EntryEmail" name="EntryEmail" value="' . $NNTEntryEmail . '">';
  echo '<table>';
  echo "<tr><td><b>" . $NNTSuggestion . "</b></td><td><input type='checkbox' name='" . $NNTEntryKey . "' value='Yes' /></td></tr>";

  $gotRows = false;
  $rowCount = 0;
  $entryTrack = [];
  try {
    if($resource)
      while ( $row = $resource->fetch_assoc() ){
        if (in_array($row['NNTEntrySuggestion'], $entryTrack)){
          continue;
        }
        if($rowCount > 17) break;
        $entryTrack[] = $row['NNTEntrySuggestion'];
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
    $CycleCount+=1;
    $rowsNeeded = (17 - $rowCount);
    // $sql = "SELECT * FROM NTTEntry AS E, NNTVoteCount AS VC WHERE VC.NNTEntry = E.NNTEntryKey AND Voted = TRUE LIMIT " . $rowsNeeded . ";";
    $sql = "SELECT E.NNTEntrySuggestion AS NNTEntrySuggestion, E.NNTEntryKey AS NNTEntryKey FROM NTTEntry AS E, NNTVoteCount AS VC WHERE VC.NNTEntry = E.NNTEntryKey AND Voted = TRUE LIMIT " . ($rowsNeeded * 20) . ";";
    $resource = $conn->query($sql);
    try {
      if($resource)
        while ( $row = $resource->fetch_assoc() ){
          if (in_array($row['NNTEntrySuggestion'], $entryTrack)){
            continue;
          }
          if($rowsNeeded < 1) break;
          $rowsNeeded--;
          $entryTrack[] = $row['NNTEntrySuggestion'];
          echo "<tr>";
          echo "<td>" . $row['NNTEntrySuggestion'] . "</td><td><input type='checkbox' name='" . $row['NNTEntryKey'] . "' value='Yes' /></td>";
          echo "</tr>";
          $LastDisplay = $row['NNTEntryKey'];
          // $CycleCount+=1;
          // $sql2 = "UPDATE NNTVoteNavigation SET NNTLastDisplay = " . $LastDisplay . ", NNTCycleCount = " . $CycleCount;
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
    echo '<tr><td><span>By clicking this button, you agree that you have read <a href="../StuffToRead.html">our stuff here!</a></span></td><td><input id="SubmitButton" type="submit" value="Enter your Vote!"/></td></tr>';
  } else {
    echo "<tr>";
    echo "<td>Sorry! No qualified entries yet... come back next week!</td>";
    echo "</tr>";
  }

  echo '<input type="hidden" id="LastDisplay" name="LastDisplay" value="' . $LastDisplay . '">';
  echo '<input type="hidden" id="CycleCount" name="CycleCount" value="' . $CycleCount . '">';
  // moving this to the actually voteForm.php
  // if($conn->query($sql2) === true){
  //   $errorMessage = "Successfully updated LastDisplay";
  // }

  echo '</table>';
  echo '</form>';
  echo '</div>';
  ////////////////////////////////////////////////////////////////////////////////////////////////
  echo "<script>var entryKey=" . $NNTEntryKey . "</script>";
  echo '</body></html>';
  $conn->close();
 ?>
 <script src="https://www.paypal.com/sdk/js?client-id=AfcRF9xThrarQuF4-C34Jpk9dR3d8F71Lqlpjo-SeTW3c9BI12fF7Byz5Pp3fAkIhmxaMiqpnmVJ8KI5&currency=USD" data-sdk-integration-source="button-factory"></script>
 <script>
 function updateNNTPaid() {
      var xhttp;

      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          alert("Updated!");
       }
      };
     xhttp.open("GET", "updatePaid.php?KEY="+entryKey, true);
     xhttp.send();
   }

  document.getElementById("SubmitButton").disabled = NOT_PAID ? true:false;
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
           completePaymentAction();
           return actions.order.capture().then(function(details) {
                 alert("PAID");
           });
        }
   }).render('#paypal-button-container');
  </script>
