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
  "efraimmkrug@gmail.com"
);

echo "<html><body>";
foreach ($emailList as $e){
  sendEmail($e);
  echo "<br>" . $e;
}

echo "</body></html>";

?>
