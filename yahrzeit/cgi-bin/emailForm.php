<?php
function sendReturnEmailInvite($email, $href, $fname){
  $to = $email;
  $subject = 'Yahrzeit Holder: link to return';
  $message = "<html>
              <style>
              body {
                background-color: #DCEEFC;
                max-width: 565px;
                color: #f98e3f;
              }

              .grid-container {
                background-color: #DCEEFC;
                max-width: 565px;
                color: #f98e3f;
                background: url('https://www.NameThatThing.site/images/yahrzeit-candles.jpg?v1') no-repeat right;
              }
              
              .grid-x {
                background-color: #DCEEFC;
                max-width: 565px;
                color: #f98e3f;
              }

              </style>
              <body>
<!-- ----------------------------------------------- -->
          <div class=\"grid-container\">
            <div class=\"grid-x grid-padding-x\">
              <div class=\"large-12 cell\">
                <h1><font color=#f98e3f>Yahrzeit</font></h1>
              </div>
            </div>

            <div class=\"grid-x grid-padding-x\">
              <div class=\"large-8 medium-8 cell\">
                <h5>We will email two weeks before each yahrzeit</h5>
              <form method=\"GET\" action=\"http://NameThatThing.site/cgi-bin/getYahrzeit.php\">
              <div class=\"grid-x grid-padding-x\">
                <div class=\"large-8 medium-8 cell\">
                    <label class=flabel>Whole name? (as on a memorial plaque)</label>
                    <input id=yname name=yname type=\"text\" placeholder=\"Yahrzeit Name\" />
                 </div>
               </div>

               <div class=\"grid-x grid-padding-x\">
                  <div class=\"large-4 medium-4 small-4 cell\">
                      <label class=flabel>Gregorian month?</label>
                      <select id=gmonth name=gmonth>
                          <option value=\"01\">January</option>
                          <option value=\"02\">February</option>
                          <option value=\"03\">March</option>
                          <option value=\"04\">April</option>
                          <option value=\"05\">May</option>
                          <option value=\"06\">June</option>
                          <option value=\"07\">July</option>
                          <option value=\"08\">August</option>
                          <option value=\"09\">September</option>
                          <option value=\"10\">October</option>
                          <option value=\"11\">November</option>
                          <option value=\"12\">December</option>
                      </select>
                  </div>
                  <div class=\"large-4 medium-4 small-4 cell\">
                      <label class=flabel>Gregorian day?</label>
                      <input id=gday name=gday type=\"text\" placeholder=\"1-31\" />
                  </div>
                  <div class=\"large-4 medium-4 small-4 cell\">
                      <label class=flabelb>Gregorian year?</label>
                      <input id=gyear name=gyear type=\"text\" placeholder=\"Four digit year\" />
                  </div>
                </div>


                <div class=\"grid-x grid-padding-x\">
                  <div class=\"large-4 medium-4 small-4 cell\">
                      <label class=flabel>Hebrew month?</label>
                      <select id=hmonth name=hmonth>
                          <option value=\"Tishrei\">Tishrei</option>
                          <option value=\"Cheshvan\">Cheshvan</option>
                          <option value=\"Kislev\">Kislev</option>
                          <option value=\"Tevet\">Tevet</option>
                          <option value=\"Shvat\">Shvat</option>
                          <option value=\"Adar\">Adar</option>
                          <option value=\"AdarII\">AdarII</option>
                          <option value=\"Nissan\">Nissan</option>
                          <option value=\"Iyar\">Iyar</option>
                          <option value=\"Sivan\">Sivan</option>
                          <option value=\"Tammuz\">Tammuz</option>
                          <option value=\"Av\">Av</option>
                          <option value=\"Elul\">Elul</option>
                      </select>
                  </div>
                  <div class=\"large-4 medium-4 small-4 cell\">
                      <label class=flabel>Hebrew day?</label>
                      <input id=hday name=hday type=\"text\" placeholder=\"1-31\" />
                  </div>
                  <div class=\"large-4 medium-4 small-4 cell\">
                      <label class=flabelb>Hebrew year?</label>
                      <input id=hyear name=hyear type=\"text\" placeholder=\"Four digit year\" />
                  </div>
                    <input type=hidden name=email value=efraimmkrug@Gmail.com>
                    <input type=submit value=\"Enter\">
                </div>
              </form>
            </div>
  <!-- ----------------------------------------------- -->

              </body>
              </html>";

  $headers = "From: mahtzevah@GMail.com\r\n";
  $headers .= "Reply-To: mahtzevah@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}

sendReturnEmailInvite("efraimmkrug@gmail.com", "https://NameThatThing.site/welcomeBack.html", "Efraim");
?>
