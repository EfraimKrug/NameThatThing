// cookie control center
function setConfKey(Confkey){
    setCookie('ConfKey', Confkey);
}

function setFName(fname){
    setCookie('FName', fname);
}

function setCookie(cname, cvalue) {
  var d = new Date();
  // 4 hours
  d.setTime(d.getTime() + (24 * 7 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function deleteCookie(cname) {
  var d = new Date();
  d.setFullYear(1973, 8, 28);
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "='';" + expires + ";path=/";
}

function deleteConfKey(){
  deleteCookie('ConfKey', "")
}

function deleteFName(){
  deleteCookie('FName', "")
}

function getConfKey(){
    return getCookie('ConfKey');
}

function getFName(){
    return getCookie('FName');
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkConfKey(){
  var confKey = getCookie("ConfKey");
  if (confKey != "") {
    return true;
  }
  return false;
}

function checkfname(){
  var fname = getCookie("FName");
  if (fname != "") {
    return true;
  }
  return false;
}

// function checkCookie() {
//   var username = getCookie("username");
//   if (username != "") {
//    alert("Welcome again " + username);
//   } else {
//     username = prompt("Please enter your name:", "");
//     if (username != "" && username != null) {
//       setCookie("username", username, 365);
//     }
//   }
// }
