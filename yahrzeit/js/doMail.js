function __doMail(type, email, name, req) {
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
      // if(typeof(callback) == 'function'){
      //   callback(X, Y, outData);
      // }
      returnVal = 0;
    }
    else
      returnVal = this.status;
  };
  // console.log(phpProg);
  // console.log([type, email, name, req]);
  xhttp.open("POST", phpProg, true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("type=" + type + "&email=" + email + "&name=" + name + "&req=" + req);
}

function doMail(type, email, name, req){
  // console.log(type);
  __doMail(type, email, name, req);
}
