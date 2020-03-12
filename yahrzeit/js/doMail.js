function __doMail(type, email, name, req, callback) {
  // console.log([type, email, name, req]);
  var xhttp;
  var returnVal;
  var func = "";
  phpProg = "cgi-bin/doMail.php";

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
      outData = this.responseText;
      // outDiv.innerHTML = outData;
      // this callback lets me fire two emails
      if(typeof(callback) == 'function'){
        callback(type, email, name, req);
      }
      returnVal = 0;
    }
    else
      returnVal = this.status;
  };

  xhttp.open("POST", phpProg, true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  if(Array.isArray(email)){
    xhttp.send("type=" + type + "&email=" + email[0] + "&name=" + email[1] + "&yname=" + email[2]  + "&ydate=" + email[3] + ",%20%" + email[4] + "&amount=" + email[5]  + "&rtype=" + email[6]);
  }
  else
    if(typeof(callback) == 'function')
      xhttp.send("type=" + type + "&email=" + email + "&name=" + name + "&req=" + req);
    else
      xhttp.send("type=" + type + "&email=" + email + "&name=" + name + "&req=" + req + "&data=" + callback);
}

function doMail(type, email, name, req, callback){
  // console.log(type);
  __doMail(type, email, name, req, callback);
}
