<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yahrzeits</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  <style>
    #EntryDisplay {
      color:blue;
    }
  </style>
  </head>
<body>
<?php
require 'openYDB.php';

$ConfKey = mysqli_real_escape_string ($conn ,  $_REQUEST['ConfKey']);
$ConfEmail = mysqli_real_escape_string ($conn ,  $_REQUEST['ConfEmail']);
$ConfPID = mysqli_real_escape_string ($conn , $_REQUEST['ConfPID']);

$sql = "SELECT * FROM People WHERE PeopleID = " . $ConfPID;
$resource = $conn->query($sql);
if ($row = $resource->fetch_assoc()){
      echo '<div id=formDiv>';
      echo "<br><br>Welcome back, $row['FName']!";
      echo "<br><br>Now we are happy to hold your yahrzeit info for you!";
      echo '</div>';
  }
?>
<div class="grid-container">
  <div id="bnr">
    <div class="row">
        <div class="small-12 columns">&nbsp;</div>
    </div>
  </div>

  <div class="grid-x grid-padding-x">
    <div class="large-12 cell">
      <h1><font color=#f98e3f>Please tell us your yahrzeit info</font></h1>
    </div>
  </div>

  <div class="grid-x grid-padding-x">
    <div class="large-8 medium-8 cell">
      <h5>We will email two weeks before each yahrzeit</h5>
    </div>
      <form id=YahrzeitForm action="cgi-bin/getYahrzeit.php" method="post">

      <div class="grid-x grid-padding-x">
        <div class="large-6 medium-6 cell">
          <div class="primary callout">
            <label>What is the whole name? (as you would like to see it on a memorial plaque)</label>
            <input name=yname type="text" placeholder="Name" />
          </div>
        </div>
      </div>

      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
        <div class="large-4 medium-4 cell">
          <div class="primary callout">
            <label>What is the Gregorian date?</label>
            <select>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
          </div>
        </div>
        <div class="large-4 medium-4 cell">
          <div class="primary callout">
            <label>What is the Gregorian day?</label>
            <input name=gday type="text" placeholder="Day" />
          </div>
        </div>
        <div class="large-4 medium-4 cell">
          <div class="primary callout">
            <label>What is the Gregorian year?</label>
            <input name=gyear type="text" placeholder="Year" />
          </div>
        </div>
      </div>

      <div class="grid-x grid-padding-x">
        <div class="large-6 medium-6 cell">
          <div class="primary callout">
            <label>And your email address?</label>
            <input name=email type="text" placeholder="Email address" />
          </div>
        </div>
        <div class="large-6 medium-6 cell">
          <div class="primary callout">
            <label>And choose a password - anything!</label>
            <input name=secret type="text" placeholder="Password" />
          </div>
        </div>
        <div class="large-4 medium-4 cell">
          <p><button class="button" type="submit">Submit</div><br/>
        </div>
      </div>

      </form>
      
  </div>
</div>
