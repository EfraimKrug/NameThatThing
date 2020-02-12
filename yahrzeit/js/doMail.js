function __doMail() {
  var xhttp;
  var returnVal;
  var outData = "";
  var func = "";
  phpProg = "cgi-bin/doMail.php";

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
      outData = this.responseText;
      outDiv.innerHTML = outData;
      if(typeof(callback) == 'function'){
        callback(X, Y, outData);
      }
      returnVal = 0;
    }
    else
      returnVal = this.status;
  };

    xhttp.open("POST", dgphpProg = "cgi-bin/insert" + TableName + ".php";, true);
  x
  http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("X=" +  X + "&Y=" + Y + "&" + func(rowVars));
}

function doMail(){
  __doMail();
}
