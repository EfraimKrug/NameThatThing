var LOGON_OK = "";
var LOGON_PID = "";
var FIRST_ENTRY = true;
var EDIT_FORM = false;
var EDIT_YID = 0;
var EDIT_OID = 0;
var EDIT_RID = 0;


var output = document.getElementById("output");
var output2 = document.getElementById("output2");
var output3 = document.getElementById("output3");
var output4 = document.getElementById("output4");

// utility code
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function querystring(key) {
  var re=new RegExp('(?:\\?|&)'+key+'=(.*?)(?=&|$)','gi');
  var r=[], m;
  // console.log("querystring: " + key);
  // console.log(document.location.search);
  while ((m=re.exec(document.location.search)) != null) r[r.length]=m[1];
  // console.log(r);
  return r;
}

function validateThruCookies(){
    return [getConfKey(), getFName()];
}

function gotoYahr(){
  var r = validateThruCookies();

  var x = r[0] ? r[0] : querystring('X'); //ConfKey
  var y = r[1] ? r[1] : querystring('Y'); //FName

  document.location = "enterYahrzeits.html?X=" + x + "&Y=" + y;
}

function gotoRequests(){
  var r = validateThruCookies();

  var x = r[0] ? r[0] : querystring('X'); //ConfKey
  var y = r[1] ? r[1] : querystring('Y'); //FName

  document.location = "enterRequests.html?X=" + x + "&Y=" + y;
}

function gotoOrgs(){
  var r = validateThruCookies();

  var x = r[0] ? r[0] : querystring('X'); //ConfKey
  var y = r[1] ? r[1] : querystring('Y'); //FName

  document.location = "enterOrgs.html?X=" + x + "&Y=" + y;
}

// checkLogin("paid", [pid, oid, yid, amount]);
function checkLogin(type, valArray){
  var r = validateThruCookies();

  var x = r[0] ? r[0] : querystring('X')[0]; //ConfKey
  var y = r[1] ? r[1] : querystring('Y')[0]; //FName
  // console.log("here: " + type);
  // OrgLog - cookies are impossible...
  if(type == "OrgLog"){
    y = querystring('Y')[0];
    x = querystring('X')[0];
    // console.log("yahrzeit.js: " + y + "//" + x);
    dbLogon("OrgLog", output, x, y, dbAccess, valArray);
  }
  else {
    if(type == "paid"){
      dbLogon("paid", output, x, y, dbAccess, valArray);
    }
    else dbLogon("check", output, x, y, dbAccess);
  }
  if(FIRST_ENTRY) initForm(type);
}

// form manipulation

function initForm(type){
  var SButton = document.getElementById("SButton");
  if(SButton){
    SButton.innerHTML = "Add New!"
    SButton.disabled = false;
  }
  if(type == "yahr"){
    EDIT_YID = 0;
    EDIT_FORM = false;
    var yname = document.getElementById("yname");
    var gmonth = document.getElementById("gmonth");
    var gday = document.getElementById("gday");
    var gyear = document.getElementById("gyear");
    var hmonth = document.getElementById("hmonth");
    var hday = document.getElementById("hday");
    var hyear = document.getElementById("hyear");
    yname.value = gyear.value = gday.value = hday.value = hyear.value = "";
    gmonth.selectedIndex = hmonth.selectedIndex = 0;
  }

  if(type == "org"){
    EDIT_OID = 0;
    EDIT_FORM = false;
    var oname = document.getElementById("oname");
    var ocity = document.getElementById("ocity");
    var ostate = document.getElementById("ostate");
    var ocountry = document.getElementById("ocountry");
    var ostreetaddress = document.getElementById("ostreetaddress");
    var orav = document.getElementById("orav");
    var oemail = document.getElementById("oemail");
    oname.value = ocountry.value = ostate.value = orav.value = oemail.value = "";
    ocity.value = ostreetaddress.value = "";
  }

  if(type == "req"){
    EDIT_RID = 0;
    EDIT_FORM = false;
    var rtype = document.getElementById("rtype");
    var ramount = document.getElementById("ramount");
    var rorg = document.getElementById("orgDropdown");
    var ryahr = document.getElementById("yahrDropdown");
    ramount.value = rorg.value = "";
    rtype.selectedIndex = 0;
    rorg.selectedIndex = 0;
    ryahr.selectedIndex = 0;
  }
}

function enterForm(type){
  var SButton = document.getElementById("SButton");
  SButton.innerHTML = "Enter New!"

  if(type == "yahr"){
    var yname = document.getElementById("yname");
    var gmonth = document.getElementById("gmonth");
    var gday = document.getElementById("gday");
    var gyear = document.getElementById("gyear");
    var hmonth = document.getElementById("hmonth");
    var hday = document.getElementById("hday");
    var hyear = document.getElementById("hyear");
    if(EDIT_FORM)
      dbYahrzeits("update", output, querystring('X'), querystring('Y'), [EDIT_YID, escape(yname.value), gyear.value + "-" + (gmonth.selectedIndex + 1) + "-" + gday.value, hmonth.options[hmonth.selectedIndex].text, hday.value, hyear.value]);
    else
      dbYahrzeits("insert", output, querystring('X'), querystring('Y'), [0, escape(yname.value), gyear.value + "-" + (gmonth.selectedIndex + 1) + "-" + gday.value, hmonth.options[hmonth.selectedIndex].text, hday.value, hyear.value]);
  }

  if(type == "org"){
    var oname = document.getElementById("oname");
    var ocity = document.getElementById("ocity");
    var ostate = document.getElementById("ostate");
    var ocountry = document.getElementById("ocountry");
    var ostreetaddress = document.getElementById("ostreetaddress");
    var orav = document.getElementById("orav");
    var oemail = document.getElementById("oemail");
    if(EDIT_FORM)
      dbOrgs("update", output, querystring('X'), querystring('Y'), [EDIT_OID, escape(orav.value), escape(oemail.value), escape(oname.value), escape(ostreetaddress.value), escape(ocity.value), escape(ostate.value), escape(ocountry.value)]);
    else
      dbOrgs("insert", output, querystring('X'), querystring('Y'), [0, escape(orav.value), escape(oemail.value), escape(oname.value), escape(ostreetaddress.value), escape(ocity.value), escape(ostate.value), escape(ocountry.value)]);
  }

  if(type == "req"){
    var rtype = document.getElementById("rtype");
    var ramount = document.getElementById("ramount");
    var rorg = document.getElementById("orgDropdown");
    var YahrzeitID = document.getElementById("yahrDropdown");

    var RRType = (rtype.options[rtype.selectedIndex].text).search("Kaddish") > -1 ? "Kaddish" : rtype.options[rtype.selectedIndex].text;
    if(EDIT_FORM)
      dbRequests("update", output, querystring('X'), querystring('Y'), [EDIT_RID,  LOGON_PID, RRType, '', escape(ramount.value), '',  '', '', '', '', rorg.value, YahrzeitID.options[YahrzeitID.selectedIndex].value]);
    else
      dbRequests("insert", output, querystring('X'), querystring('Y'), [0, LOGON_PID, RRType, '', escape(ramount.value), '',  '', '', '', '', rorg.value, YahrzeitID.options[YahrzeitID.selectedIndex].value]);
  }

  initForm(type);
}

// returns true/false
function isLoginPossible(output, x, y, callback){
  // console.log(x + ":" + y);
  dbLogon("check", output, x, y, callback);
}

var screenWidth = screen.width;
if(screenWidth > 800){
      var div = document.getElementsByClassName("grid-container");
      for(var i = 0; i < div.length; i++){
        div[i].classList.add("grid-container-pic");
        div[i].classList.remove("grid-container-plain");
      }
      // var div = document.getElementsByClassName("grid-x");
      // for(var i = 0; i < div.length; i++){
      //   div[i].classList.add("grid-container-alt");
      //   div[i].classList.remove("grid-container");
      // }
}
