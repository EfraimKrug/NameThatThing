delete NNTDeadEmail if no matching NTTEntry
Send repeat email to any NNTDeadEmail with matching NTTEntry before max delay
Delete any NNTDeadEmail with matching NTTEntry after max delay
Delete NTTEntry with never voted

==================================================================
Delete NTTEntry more than 20 levels old, and only 1 vote
<?php
###################################################################
// //Delete NNTDeadEmail Records...
// $sql = "SELECT DE.NNTEntryKey AS EKey FROM `NNTDeadEmail` AS DE, `NTTEntry` AS E WHERE DE.NNTEntryKey = E.NNTEntryKey AND E.Voted = TRUE";
// $resource = $conn->query($sql);
// $wacks = 0;
// try {
//   if($resource)
//     while ( $row = $resource->fetch_assoc() ){
//       $sql2 = "DELETE FROM `NNTDeadEmail` WHERE NNTEntryKey = " . $row['EKey'];
//       $resource = $conn->query($sql2);
//       $wacks++;
//     }
// } catch (Exception $e){
//     $wacks = 0;
// }
###################################################################
//Delete Dead Email records if Entry was voted,
$sql = "SELECT * FROM `NNTVoteNavigation`;";
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
$sql = "DELETE FROM NNTDeadEmail WHERE NNTEntryKey IN (SELECT NNTEntryKey FROM NTTEntry WHERE Voted = TRUE);";
$resource = $conn->query($sql);
###################################################################
//Set all votes to same for redundant entries
$sql = "select MAX(NNTVoteCount) as Votes, NNTEntryKey, NNTEntrySuggestion, COUNT(*) as cnt from NTTEntry, NNTVoteCount WHERE NNTEntry = NNTEntryKey group by NNTEntrySuggestion;";
$resource = $conn->query($sql);
$row = $resource->fetch_assoc();
if($resource)
  while ( $row = $resource->fetch_assoc() ){
    if ($row['cnt'] > 1){
      $Votes = $row['Votes'];
      $sql2 = "UPDATE NNTVoteCount SET NNTVoteCount = " . $Votes . " WHERE NNTEntry IN (SELECT NNTEntryKey FROM NTTEntry WHERE NNTEntrySuggestion = '" . $row['NNTEntrySuggestion'] . "');";
      $resource = $conn->query($sql2);
  }

?>
