<!DOCTYPE>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel = "stylesheet" type = "text/css" href = "css/namethatthing.css" />
  <style>
  #output {
    color: red;
  }
  #showCount {
    color: blue;
  }
  #formSubmit {
  	box-shadow: 0px 10px 14px -7px #3e7327;
  	background:linear-gradient(to bottom, #77b55a 5%, #72b352 100%);
  	background-color:#77b55a;
  	border-radius:4px;
  	border:1px solid #4b8f29;
  	display:inline-block;
  	cursor:pointer;
  	color:#ffffff;
  	font-family:Arial;
  	font-size:13px;
  	font-weight:bold;
  	padding:6px 12px;
  	text-decoration:none;
  	text-shadow:0px 1px 0px #5b8a3c;
  }
  #formSubmit:hover {
  	background:linear-gradient(to bottom, #72b352 5%, #77b55a 100%);
  	background-color:#72b352;
  }
  #formSubmit:active {
  	position:relative;
  	top:1px;
  }

  </style>
  <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
  async defer></script>
      <script type="text/javascript">
        var verifyCallback = function(response) {
          alert(response);
        };

        var onloadCallback = function() {
          grecaptcha.render('html_element', {
            'sitekey' : '6LewqMEUAAAAAJQ7wHGf4sYpLDQipBbgX2wPjHny'
          });
        };

        function isCaptchaChecked() {
          return grecaptcha && grecaptcha.getResponse().length !== 0;
        }

        function checkCaptcha(){
          if(isCaptchaChecked()) return true;
          return false;
        }
      </script>
</head>
<body onLoad="showCount('');">
<div id=topDiv>
<table>
<tr>
<td><img src="images/dots.gif"></td>
<td><img src="images/NameTitle.gif"></td>
<td><img src="images/WavyDots.gif"></td>
</tr>
</table>
</div>
<!-- captcha -->
<form action="javascript:alert(grecaptcha.getResponse(widgetId1));" method="POST">
  <div id="html_element"></div>
  <br>
  <!-- <input type="submit" value="Submit"> -->
</form>
<!-- <div onclick='checkCaptcha();'>Click Here</div> -->
<!--
<form action="cgi-bin/verify.php" method="POST">
   <div class="g-recaptcha" data-sitekey="6LewqMEUAAAAAJQ7wHGf4sYpLDQipBbgX2wPjHny"></div>
   <br/>
   <input type="submit" value="Submit">
</form>
-->
<!--
<form method="post" action="cgi-bin/verify.php">
  ?php
    require_once('cgi-bin/recaptchalib.php');
    $publickey = "6LewqMEUAAAAAJQ7wHGf4sYpLDQipBbgX2wPjHny"; // you got this from the signup page
    echo recaptcha_get_html($publickey);
  >

  <input type="submit" value="go"/>
</form>
-->
<div id=output></div>
<div id=formDiv>
<form id=SuggestionForm action="cgi-bin/getForm.php" method="post">
<!-- <div id="html_element"></div> -->
<table>
  <tr>
    <td></td><td><span id=showCount></span></td>
  </tr>
<tr>
 <td>Your email: </td><td><input type="text" name="email" placeholder="your email"/></td>
</tr>
<tr><td>Name Suggestion: </td><td><input type="text" name="suggestion" placeholder="for the three facebook messenger wavy dot things..." size="59" /></td>
</tr>
<tr>
</td><td><td><!-- <input type="submit" id="submitButton" value="Enter your suggestion!"/> --></td>
</tr>
</table>
</form>
<div id=formSubmit onclick='formSubmit();'>Enter your suggestion!</div>
</div>
<div id=bottomDiv>
<table>
<tr>
  <td>
    <a href="WhatAreWeDoing.html"><span class=white>What are we doing?</span></a><span class=white> | </span>
  </td>
  <td>
  </td>
  <td>
    <a href="HowDoesThisWork.html"><span class=white>How does this work?</span></a><span class=white> | </span>
  </td>
  <td>
  </td>
  <td>
    <a href="WhoAreWe.html"><span class=white>Who are we?</span></a><span class=white> | </span>
  </td>
  <td>
  </td>
  <td>
    <a href="https://slate.com/culture/2015/04/typing-indicator-bubbles-on-iphone-gchat-facebook-messenger-when-can-someone-see-you-typing-explained.html"><span class=white>Uh oh!</span><span class=white> | </span></a>
  </td>
  <td>
  </td>
  <td>
      <a href="StuffToRead.html"><span class=white>Stuff To Read</span><span class=white> | </span></a>
  </td>
  <td>
  </td>
</tr>
</table>
</div>
<script>
//var submitButton = document.getElementById("submitButton");
//submitButton.disabled = true;

var output = document.getElementById("output");

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

output.innerHTML = getUrlVars()["RETURN"] ? getUrlVars()["RETURN"].replace(/\%20/g, ' ') : "";

</script>
<script>
function showCount(str) {
  var xhttp;
  // if (str == "") {
  //   document.getElementById("showCount").innerHTML = "";
  //   return;
  // }

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText < 3000)
        document.getElementById("showCount").innerHTML = "We expect the winnings to be big... but we don't know how big";
      else
        document.getElementById("showCount").innerHTML = "So far the right entry could get you $" + parseInt(this.responseText/2) + "!";
    }
  };
  xhttp.open("GET", "cgi-bin/getCount.php?q="+str, true);
  xhttp.send();
}

function formSubmit(){
  if(checkCaptcha()){
    alert("submitting form");
    document.getElementById("SuggestionForm").submit();
  }
}
</script>

</body>
</html>
