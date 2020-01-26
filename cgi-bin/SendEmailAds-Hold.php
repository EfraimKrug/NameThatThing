<?php

function sendEmail($email){
  $to = $email;
  $subject = 'NAME THOSE DOTS: dots right... Clever? Try it!';
  $message = "<html>
              <body bgcolor=\"#DCEEFC\">
              <table>
              <tr>
              <td>
              <a href=\"https://www.NameThatThing.site/index.html\"><img src=\"https://www.NameThatThing.site/images/FBAdvertisement.gif\" alt=\"FB Advertisement\" height=512 width=512 /></a>
              </td>
              <td>
              <center>
              Hi!
              <br>
              You know those dots - on message apps - the dots that beckon you to
              wait for your friend who is still typing?
              <br>
              The dots in a bubble, that wave and undulate? You know?
              <br>
              What are they called? It turns out, NOBODY knows! They have no name!
              <br>
              My friend! We are conducting a contest to come up with the perfect name... People from
              everywhere are coming up with clever names... interesting names... profound names...
              <br>
              And the winner not only gets advertised as the most brilliant namer in the world, but also
              gets the pot of gold raised by all the hopeful entries!
              <br>
              Go ahead, make an entry, and try! Maybe the world will determine that your entry is
              indeed the most clever entry!
              <br>
              And best of luck! May the most clever entry win!
              </center>
              </td>
              </tr>
              </table>
              </body>
              </html>";

  $headers = "From: EfraimMKrug@GMail.com\r\n";
  $headers .= "Reply-To: EfraimMKrug@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    echo "Good...";
    return true;
  } else{
    echo "Not so good...";
    return false;
  }
}


$emailList = array (
  "efraimmkrug@gmail.com",
  "aacusner@gmail.com",
  "aaronb@media.mit.edu",
  "abernstein@vhb.com",
  "agerber@tisharon.org",
  "agreen@hebrewcollege.edu",
  "ajs1994@gmail.com",
  "alex@fliglaw.com",
  "alexliberman.personal@gmail.com",
  "allison.poirier@hebrewcollege.edu",
  "andrew.shooman@emc.com",
  "andrewjwarren@yahoo.com",
  "andy.shooman@emc.com",
  "apoirier@tisharon.org",
  "arbelnaomi@gmail.com",
  "avivaestherleah@yahoo.com",
  "avivaglenn@comcast.net",
  "bernardgreenberg@msn.com",
  "bernerdgreenberg@msn.com",
  "bernerdgreenburg@msn.com",
  "bfmeyernyc@aol.com",
  "bodymindwork@verizon.net",
  "btwerski@gmail.com",
  "cabressler@gmail.com",
  "chakira@gmail.com",
  "chananasia@gmail.com",
  "chananasia@icloud.com",
  "chiroctr@concentric.net",
  "chiroctr@gmail.com",
  "cwoolf@gmail.com",
  "cynthia.krug@tufts.edu",
  "d.schectman@gmail.com",
  "daniel22epstein@gmail.com",
  "david.schectman@gmail.com",
  "David@wintersolutions.com",
  "davidschacht@ymail.com",
  "dean.solomon@me.com",
  "deansolomon@rcn.com",
  "deb.raub@verizon.net",
  "deblappen@yahoo.com",
  "delsner@foxboroughrcs.org",
  "denn.villa@gmail.com",
  "des770@mail.harvard.edu",
  "dgilmusic@gmail.com",
  "dhalperrosenthal770@gmail.com",
  "dj1@djsnyder.com",
  "djkomisar@gmail.com",
  "dklapper@thebinahschool.org",
  "dmaayan7@gmail.com",
  "dovid@wintersolutions.com",
  "drosen77@gmail.com",
  "Dsctngil@aol.com",
  "dsctngil@verizon.net",
  "dsloane@partners.org",
  "dysl@verizon.net",
  "dyslepstein@gmail.com",
  "dzk100@gmail.com",
  "ehauser@solidworks.com",
  "Elana.kesselman001@umb.edu",
  "eleader@hebrewcollege.edu",
  "ellen.krausegrosman@gmail.com",
  "emunawitt14@yahoo.com",
  "enriquew9@gmail.com",
  "ethan.grayman@gmail.com",
  "freedman40@aol.com",
  "getzev@yahoo.com",
  "getzev@yahoo.com",
  "gildendebby@yahoo.com",
  "gilfamily.dsctn@gmail.com",
  "graymans@comcast.net",
  "hayyim@tikkun.org",
  "Hendi7@aol.com",
  "heyrabbi@gmail.com",
  "hf@world.std.com",
  "hillela@gmail.com",
  "hillisjaffe@verizon.net",
  "ilana.bkrug@gmail.com",
  "israel.d.gale@gmail.com",
  "istillma@bidmc.harvard.edu",
  "j.maeir@gmail.com",
  "jakomisar@gmail.com",
  "Janette@jstreet.org",
  "janetzimmern@gmail.com",
  "jeff.e.ellse@gmail.com",
  "jerry_golden@emc.com",
  "jesse.hefter@gmail.com",
  "jjasper@thebinahschool.org",
  "jkephart@safetynetaccess.com",
  "JKlerman@yahoo.com",
  "jl.houben@gmail.com",
  "jmaeir@gmail.com",
  "jmeszler@temple-sinai.com",
  "jn@forma-music.com",
  "joan.friedman2003@gmail.com",
  "joel@fortpoint.me",
  "joel@fortpointlegal.com",
  "joicethevoice@gmail.com",
  "jonathan49ellis@gmail.com",
  "jordanleewagner@gmail.com",
  "josalt17@gmail.com",
  "joshv2@gmail.com",
  "joylife7@gmail.com",
  "jtvoice@juno.com",
  "julie.krimsky@gmail.com",
  "Karen@positivepathwaysconsulting.com",
  "ketriellah@gmail.com",
  "kimelman@brandeis.edu",
  "koshermit@gmail.com",
  "lauroop@comcast.net",
  "lauroop@gmail.com",
  "ldelatb@verizon.net",
  "lfuld@aol.com",
  "lisawinner@comcast.net",
  "lizasilver613@gmail.com",
  "llnwlfsn@gmail.com",
  "LMFuld@gmail.com",
  "london.isaac@gmail.com",
  "ltannen@thebinahschool.org",
  "ltorleans@gmail.com",
  "maayan.zk10@gmail.com",
  "martin.liss@libertymutual.com",
  "matiarania@comcast.net",
  "matthew.ravitz.brown@gmail.com",
  "matthewncohen@gmail.com",
  "MCARose@Gmail.com",
  "meir@sendor.org",
  "menuchabendavid@yahoo.com",
  "merril.weiner@gmail.com",
  "merril.weiner@yahoo.com",
  "merrilllynchbenefitsonline@ml.com",
  "mgradel@foxboroughrcs.org",
  "mgrandel@foxboroughrcs.org",
  "mhirsh@rofehint.org",
  "mjmarkson11@yahoo.com",
  "mklausne@gmail.com",
  "mliss@alum.mit.edu",
  "moderntorahleadership@gmail.com",
  "mrackover@gmail.com",
  "mrackover@tisharon.org",
  "mrs.esglick@gmail.com",
  "mweiner@thebinahschool.org",
  "nancybn18@gmail.com",
  "nanef@juno.com",
  "navahlevine@yahoo.com",
  "norman@cybersecreport.com",
  "nossenschafer@gmail.com",
  "oleg.cohen@gmail.com",
  "orose@hebrewcollege.edu",
  "paul@weiss.name",
  "pella1@gmail.com",
  "Rabbi@bethelnewton.org",
  "rabbi@etzchaimsharon.com",
  "rabbi@koltikvahsharon.org",
  "rabbi@ktmshul.org",
  "rabbi@templebethdavid.com",
  "rabbi@yisharon.org",
  "RabbiGlass@adamsstreet.org",
  "rabbinavahlevine@gmail.com",
  "ravbensam@shaarei.org",
  "ravclaudia@tbzbrookline.org",
  "ravnatan@gmail.com",
  "RebMoshe@tbzbrookline.org",
  "reena.srulovich@gmail.com",
  "revahaselkorn@gmail.com",
  "rfish@tisharon.org",
  "rhoffman@thebinahschool.org",
  "richard.sosis@gmail.com",
  "rina.hoffman@hotmail.com",
  "rkafka613@gmail.com",
  "rlandes@bu.edu",
  "Robinkatz3741@gmail.com",
  "ronit.zivkreger@gmail.com",
  "rothenberg_marty@yahoo.com",
  "roy@strunin.com",
  "rsilverman@tisharon.org",
  "rspellma@verizon.net",
  "Ruth@renzcounseling.com",
  "sfeldstein@thebinahschool.org",
  "sgrayman@gmail.com",
  "shai@stonehill.edu",
  "shamrak@gmail.com",
  "shaynayarmush@gmail.com",
  "shooman@emc.com",
  "shulim26@shlomoyeshiva.org",
  "snf6@yahoo.com",
  "ssilberman@maimonides.org",
  "stankrug@gmail.com",
  "stats4096@yahoo.com",
  "strunin@yahoo.com",
  "Tamar@tandemarketing.com",
  "tanyaflig@yahoo.com",
  "tnh@designcoaches.com",
  "todd@safetynetaccess.com",
  "Tziporah.Michelle@gmail.com",
  "tzirlahirsch@prodigy.net",
  "uschafer@gmail.com",
  "woodshap@verizon.net",
  "ZivKreger@aol.com",
  "zuber.chana@gmail.com",
  "zuberco@sprintmail.com",
  "efraimmkrug@gmail.com"
);

echo "<html><body>";
foreach ($emailList as $e){
  sendEmail($e);
  echo "<br>" . $e;
}

echo "</body></html>";

?>
