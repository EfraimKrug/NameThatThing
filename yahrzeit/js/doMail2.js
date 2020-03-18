function __doMail2(type, RID, PID, OID, YID, data, callback) {
  // console.log([type, email, name, req]);
  var xhttp;
  var returnVal;
  var func = "";
  phpProg = "cgi-bin/doMail2.php";

  // if(array_key_exists('type', $_REQUEST)) $type = $_REQUEST['type'];
  // if(array_key_exists('RID',  $_REQUEST)) $RID =  $_REQUEST['RID'];
  // if(array_key_exists('PID',  $_REQUEST)) $PID =  $_REQUEST['PID'];
  // if(array_key_exists('OID',  $_REQUEST)) $OID =  $_REQUEST['OID'];
  // if(array_key_exists('YID',  $_REQUEST)) $YID =  $_REQUEST['YID'];
  // if(array_key_exists('data', $_REQUEST)) $data = $_REQUEST['data'];


  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
      outData = this.responseText;
      if(typeof(callback) == 'function'){
        callback(type, RID, PID, OID, YID, data);
      }
      returnVal = 0;
    }
    else
      returnVal = this.status;
  };

  xhttp.open("POST", phpProg, true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  if(Array.isArray(RID)){
    xhttp.send("type=" + type + "&RID=" + RID[0] + "&PID=" + RID[1] + "&OID=" + RID[2]  + "&YID=" + RID[3] + "&data=" + RID[4]);
  }
  else
      console.log("type=" + type + "&RID=" + RID + "&PID=" + PID + "&OID=" + OID + "&YID=" + YID + "&data=" + data);
      xhttp.send("type=" + type + "&RID=" + RID + "&PID=" + PID + "&OID=" + OID + "&YID=" + YID + "&data=" + data);
}

function doMail2(type, RID, PID, OID, YID, data, callback){
  // console.log(type);
  __doMail2(type, RID, PID, OID, YID, data, callback);
}
