<?php

function sendPersonNotify($email){
  $to = $email;
  $subject = "Book launch invitation";
  $message = "<html class='no-js' lang='en' dir='ltr'><head><meta charset='utf-8'/></head>
              <body style='font-family:sans-serif;'>
                <div>
                  <table width=100%>
                    <tr>
                      <td>
                <table width=75%>
                  <tr width=50%>
                    <td align=center>
                      <br>
                       <font  size=5em color=orange>With great joy, after nearly a decade in collaboration,</font>
                    </td>
                  </tr>
                    <tr width=50%>
                    <td align=center>
                      <br>
                      <font  size=5em color=blue> we invite you</font>
                    </td>
                  </t>
                    <tr width=50%>
                    <td align=center>
                      <br>
                      <font size=5em color=blue> Sunday, April 12 at 2:00PM EST</font>
                    </td>
                  </tr>
                    <tr width=50%>
                    <td align=center>
                      <br>
                      <font size=3em color=black>to join Aubrey Glazer & Nehemia Polen</font>
                    </td>
                  </tr>
                    <tr width=50%>

                    <td>
                      <br>
                      <font size=4em color=blue>We will discuss the inaugural volume 'From Tiberias, With Love' and explore the history of the hasidic community in the Galilee.</font>
                      </td>
                    </tr>
                      <tr width=50%>

                      <td>
                      <br>
                      <font size=4em color=blue>In 1777 spiritual seekers from Eastern Europe sailed to Eretz Israel.</font>
                      </td>
                    </tr>
                      <tr width=50%>
                      <td>
                      <br>
                      <font size=4em color=blue>Weathering many challenges they established a center for the hasidic ethos to strike roots in the holy land and to radiate to the Diaspora.</font>
                      </td>
                    </tr>
                      <tr width=50%>
                      <td>
                      <br>
                      <font size=4em color=blue>Tiberean Hasidism exemplifies intensive contemplative life focusing on  mystical theology, devotional practice, and the ecstasy of deep friendship.</font>
                      </td>
                    </tr>
                      <tr width=50%>
                      <td>
                      <br>
                      <font size=4em color=blue>This first volume focuses on the teachings of Rabbi Menachem Mendel of Vitebsk (d. 1788) a foremost disciple of the Maggid of Meziretch and a mystic of incandescent intensity.</font>
                    </td>
                    </tr>
                    <tr width=50%>
                    <td>
                    <br>
                    <font size=4em color=blue>We will hear an authentic Vitebsk niggun and learn one of the Vitebsker's teachings from Pri Ha-Aretz on the Song at the Sea. The teaching explains why the return of the waters to their natural flow was the real miracle to be celebrated.</font>
                  </td>
                  </tr>

                    <tr width=50%>
                      <td>
                        <br>
                        <font size=4em color=blue>
                          Join Zoom Meeting
                          <a href='https://zoom.us/j/958788568'> https://zoom.us/j/958788568</a>
                          <br>Meeting ID: 958 788 568
                          <br>Password: 433062
                        </font>
                      </td>
                    </tr>
              </table>
              </td>
              <td align=top>
                <img src='https://NameThatThing.site/images/bookCover.png' alt-text='book cover'/>
              </td>
              </tr>
              </table>
              </div>
              </body>
              </html>";

  $headers = "From: nehiezra@GMail.com\r\n";
  $headers .= "Reply-To: efraimmkrug@GMail.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  if(mail($to, $subject, $message, $headers)){
    return true;
  } else{
    return false;
  }
}

// testEmail();
$emailList = ["efraimmkrug@gmail.com",
              "jeyges@gmail.com",
              "nehiezra@gmail.com"];

foreach ($emailList as $em) {
  echo($em);
  sendPersonNotify($em);
}
?>
