function __doMail(type, email, name, req, callback) {
  // console.log([type, email, name, req]);
  var xhttp;
  var returnVal;
  var outData = "";
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
  // console.log(phpProg);
  // console.log("type=" + type + "&email=" + email + "&name=" + name + "&req=" + req);
  xhttp.open("POST", phpProg, true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  if(typeof(callback) == 'function')
    xhttp.send("type=" + type + "&email=" + email + "&name=" + name + "&req=" + req);
  else
    xhttp.send("type=" + type + "&email=" + email + "&name=" + name + "&req=" + req + "&data=" + callback);
}

function doMail(type, email, name, req, callback){
  // console.log(type);
  __doMail(type, email, name, req, callback);
}
