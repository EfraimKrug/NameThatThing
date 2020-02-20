function dbGo(TableName, type, outDiv, X, Y, rowVars, callback) {
  var phpProg = "";
  if(type.toLowerCase() == "insert") phpProg = "cgi-bin/insert" + TableName + ".php";
  if(type.toLowerCase() == "update") phpProg = "cgi-bin/update" + TableName + ".php";
  if(type.toLowerCase() == "delete") phpProg = "cgi-bin/delete" + TableName + ".php";
  if(type.toLowerCase() == "select") phpProg = "cgi-bin/select" + TableName + ".php";
  if(type.toLowerCase() == "check")  phpProg = "cgi-bin/checkLogin.php";
  if(type.toLowerCase() == "paid")   phpProg = "cgi-bin/paidLogin.php";

  var xhttp;
  var returnVal;
  var outData = "";
  var func = "";

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

  switch(TableName){
    case "Requests":          func = formatRequests; break;
    case "RequestsByPeople":  func = formatRequests; break;
    case "YahrzeitsByPeople": func = formatPeople; break;
    case "OrgsByPeople":      func = formatPeople; break;
    case "Orgs":              func = formatOrgs; break;
    case "Yahrzeits":         func = formatYahrzeits; break;
    case "Conf":              func = formatConf; break;
    case "People":            func = formatPeople; break;
    case "PYConn":            func = formatPYConn; break;
    case "checkLogin":        func = doNothing; break;
    case "paidLogin":         func = formatPaid;
                              X = rowVars['X']; Y = rowVars['Y'];
                              break;
    default:                  func = doNothing; break;
  }

  xhttp.open("POST", phpProg, true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  // console.log(func(rowVars));
  xhttp.send("X=" +  X + "&Y=" + Y + "&" + func(rowVars));
}

function dbYahrzeits(type, outDiv, X, Y, rowVars, callback) {
  dbGo("Yahrzeits", type, outDiv, X, Y, rowVars, callback);
}

function dbOrgs(type, outDiv, X, Y, rowVars, callback) {
  // console.log(rowVars);
  dbGo("Orgs", type, outDiv, X, Y, rowVars, callback);
}

function dbConf(type, outDiv, X, Y, rowVars, callback) {
  return dbGo("Conf", type, outDiv, X, Y, rowVars, callback);
}

function dbPeople(type, outDiv, X, Y, rowVars, callback) {
  // console.log("dbPeople: ");
  // console.log(X);
  // console.log(Y);
  return dbGo("People", type, outDiv, X, Y, rowVars, callback);
}

function dbYahrzeitsByPeople(type, outDiv, X, Y, rowVars, callback) {
  // console.log("dbYahrzeitsByPeople");
  return dbGo("YahrzeitsByPeople", type, outDiv, X, Y, rowVars, callback);
}

function dbOrgsByPeople(type, outDiv, X, Y, rowVars, callback) {
  return dbGo("OrgsByPeople", type, outDiv, X, Y, rowVars, callback);
}

function dbRequestsByPeople(type, outDiv, X, Y, rowVars, callback) {
  return dbGo("RequestsByPeople", type, outDiv, X, Y, rowVars, callback);
}

function dbRequests(type, outDiv, X, Y, rowVars, callback) {
  // console.log(rowVars);
  return dbGo("Requests", type, outDiv, X, Y, rowVars, callback);
}

function doNothing(rowVars){
    return "doNothing=doNothing";
}

function dbLogon(type, outDiv, X, Y, callback, valArray){
  if(type == "paid")
      return dbGo("paidLogin", type, outDiv, X, Y, valArray, callback);

  return dbGo("checkLogin", type, outDiv, X, Y, [], callback);
}

// function dbPYConn(type, outDiv, X, Y, rowVars, callback){
//   return dbGo("PYConn", type, outDiv, X, Y, rowVars, callback);
// }
