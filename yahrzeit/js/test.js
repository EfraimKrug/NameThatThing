function dbGo(outDiv, callback) {
  var phpProg = "cgi-bin/selectPeople.php";

  // console.log(phpProg);
  var xhttp;
  var returnVal;
  var outData = "";
  var func = "";

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
      try {
        outData = this.responseText;
        // outData = JSON.parse(this.responseText);
      } catch (e) {
        outData = this.responseText;
      }
      outDiv.innerHTML = outData;
      returnVal = 0;
      if(typeof(callback) == 'function'){
        callback();
      }

    }
    else
      returnVal = this.status;
  };

  // console.log("FIRE");
  xhttp.open("POST", phpProg, true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  // xhttp.send("X=" +  X + "&Y=" + Y + "&" + func(rowVars));
  xhttp.send();
}
