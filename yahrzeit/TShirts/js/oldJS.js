//<!-- shopping cart manipulation -->

function calcShoppingCartTotal(formatFlag){
  var shoppingCart = document.getElementById("shoppingCart");
  var payTotal = 0.00;
  for (var r=1; r < shoppingTable.rows.length; r++){
    payTotal += parseInt(shoppingTable.rows[r].cells[4].innerHTML * 100);
  }

  if(formatFlag) return "Total: $" + addDecimal(payTotal/100);
  return payTotal;
}

function decreaseBuy(lineMark){
  var shoppingCart = document.getElementById("shoppingCart");
  var lineNum = shoppingTable.rows.length - lineMark + 1;
  var totalCart = document.getElementById("total");
  // alert(lineNum);
  if (shoppingTable.rows[lineNum].cells[1].innerHTML > 0){
    shoppingTable.rows[lineNum].cells[1].innerHTML = parseInt(shoppingTable.rows[lineNum].cells[1].innerHTML) - 1;
    cost = shoppingTable.rows[lineNum].cells[3].innerHTML * 100;
    price = shoppingTable.rows[lineNum].cells[1].innerHTML * cost;
    price /= 100;
    shoppingTable.rows[lineNum].cells[4].innerHTML = addDecimal(price);
  }
  // alert(shoppingTable.rows[lineNum].cells[1].innerHTML);
  totalCart.innerHTML = calcShoppingCartTotal(true);
  // var payTotal = calcShoppingCartTotal();
  // totalCart.innerHTML = "Total: $" + addDecimal(payTotal/100);
}

function addDecimal(num){
  s = "" + num;
  if(s.indexOf(".") < 0){
    s = s + ".00";
  } else {
    if(s.substring(s.indexOf(".")).length < 3){
      s = s + "0";
    }
  }
return s;
}

var cartHeight = 10;
function addLine(type, count, size, price, prodID){
  var shoppingTable = document.getElementById("shoppingTable");
  var shoppingCart = document.getElementById("shoppingCart");
  var totalCart = document.getElementById("total");
  shoppingCart.style.visibility = "visible";

  var row = shoppingTable.insertRow(1);
  var cell0 = row.insertCell(0);
  var cell1 = row.insertCell(1);
  var cell2 = row.insertCell(2);
  var cell3 = row.insertCell(3);
  var cell4 = row.insertCell(4);
  var cell5 = row.insertCell(5);
  cell5.style.visibility = 'hidden';

  var p = price.replace("$","");
  var total = p * count;
  total *= 100;
  total = parseInt(total);
  total /= 100;


  cell0.innerHTML = "<i id=lineItem-" + shoppingTable.rows.length + " class='material-icons' onclick=decreaseBuy(" + shoppingTable.rows.length + ")></i> " + type;
  cell0.className = 'leftAlign';
  cell1.innerHTML = count;
  cell2.innerHTML = size;
  cell3.innerHTML = p;
  cell4.innerHTML = addDecimal(total);
  cell5.innerHTML = prodID;

  cartHeight += 24;
  if(cartHeight == 34){
    cartHeight += 48;
  }

  // var payTotal = calcShoppingCartTotal();
  // var payTotal = 0.00;
  // for (var r=1; r < shoppingTable.rows.length; r++){
  //   payTotal += parseInt(shoppingTable.rows[r].cells[4].innerHTML * 100);
  // }
  totalCart.innerHTML = calcShoppingCartTotal(true);
  // totalCart.innerHTML = "Total: $" + addDecimal(payTotal/100);

  shoppingCart.style.height = cartHeight + 'px';

}

// for(var i=0; i<22; i++)
//   addLine("T-Shirt", 3, "2XL", "59.88");
function getValues(sfx){
  var sName = "shirtName" + sfx;
  var sCount = "select" + sfx;
  var sPrice = "priceTag" + sfx;
  // alert([sName,sCount,sPrice]);
  var eName = document.getElementById(sName);
  var eCount = document.getElementById(sCount);
  // var ePrice = document.getElementById(sPrice);
  // console.log(ePrice.innerHTML)
  return [eName.innerHTML, eCount.options[eCount.selectedIndex].text];
}


function submitForm(sfx){
  var payButton = document.getElementById("payButton");
  var submitButton = document.getElementById("sButton"+sfx);


  payButton.disabled = false;

  buttonR = checkFields(sfx);
  if(!buttonR) return;
  var prodID = buttonR.getAttribute('prodID');
  // console.log(prodID);
  productValues = getValues(sfx);
  // console.log(buttonR.innerHTML);
  price = getPrice(buttonR.innerHTML, sfx);
  size = buttonR.innerHTML;
  // console.log(parseInt(productValues[1]));

  if(parseInt(productValues[1])){
    addLine(productValues[0], productValues[1], size, price, prodID);
    submitButton.classList.add('elementFade');
  }
}

function getPayPalInfo(){
  if (!calcShoppingCartTotal()) return;
  var totalCart = document.getElementById("total");
  var dataGather = document.getElementById("dataGather");
  var payButton = document.getElementById("payButton");

  var totalPay = totalCart.innerHTML;
  dataGather.style.visibility = "visible";

  var dGName = document.getElementById("dGName");
  var dGEMail = document.getElementById("dGEMail");
  var dGVerEMail = document.getElementById("dGVerEMail");

  // var dGAddress1 = document.getElementById("dGAddress1");
  // var dGAddress2 = document.getElementById("dGAddress2");
  // var dGAddress3 = document.getElementById("dGAddress3");
  var dGMName = document.getElementById("dGMName");
  var dGAddress4 = document.getElementById("dGAddress4");
  var dGAddress5 = document.getElementById("dGAddress5");
  var dGAddress6 = document.getElementById("dGAddress6");
  var dGAddress7 = document.getElementById("dGAddress7");
  var dGAddress8 = document.getElementById("dGAddress8");

  dGName.value = "";
  dGEMail.value = "";
  dGVerEMail.value = "";

  // dGAddress1.value = "";
  // dGAddress2.value = "";
  // dGAddress3.value = "";
  dGMName.value = "";
  dGAddress4.value = "";
  dGAddress5.value = "";
  dGAddress6.value = "";
  dGAddress7.value = "";
  dGAddress8.value = "";

  payButton.disabled = true;
  payButton.style.visible = "hidden";
}

function verifyNameData(){
  var dGName = document.getElementById("dGName");
  var dGMName = document.getElementById("dGMName");
  if (dGMName.value.length < 1 && dGName.value.length > 0){
    dGMName.value = dGName.value;
  }
  if (dGName.value.length > 0) return true;
  return false;
}

function verifyEmailData(){
  var dGEMail = document.getElementById("dGEMail");
  var dGVerEMail = document.getElementById("dGVerEMail");
  if (dGEMail.value.toLowerCase() == dGVerEMail.value.toLowerCase() && dGEMail.value.length > 0) return true;
  return false;
}

function verifyBillingData(){
  var dGAddress4 = document.getElementById("dGAddress4");
  var dGAddress5 = document.getElementById("dGAddress5");
  var dGAddress6 = document.getElementById("dGAddress6");
  var dGAddress7 = document.getElementById("dGAddress7");
  var dGAddress8 = document.getElementById("dGAddress8");

  if (dGAddress4.value.length > 0 &&
      dGAddress5.value.length > 0 &&
      dGAddress6.value.length > 0 &&
      dGAddress7.value.length > 0 &&
      dGAddress8.value.length > 0 ) return true;

  return false;

}

//
// first store data - and get primary key - done
// pass primary key/amount to goToPayPal
// accept payment
// if payment works and everything is good
//  mark the record paid (with date)
// send record to T-Shirt web site... (api) - this is next...
// need better background for order page...
//

var merchPass = [];
function storeOrder(){
  var outDiv = document.getElementById("outdiv");
  var info = JSON.parse(outDiv.innerHTML);
  // console.log(info);
  for (var row=0; row < merchPass.length-1; row++){
    sendString = formatOrder(info.accountID,info.targetID,merchPass[row][4],merchPass[row][2],merchPass[row][1],merchPass[row][3],"false");
    dbOrder("insert", outDiv, sendString.replace(/\s/g,""), function(){})
  }
}

function storeAccount(email, merch, flag, name, street, city, state, zip, country){
  var outDiv = document.getElementById("outdiv");
  merchPass = merch;
  var parms = formatAccount(email, name, street, city, state, zip, country);
  dbAccount("insert", outDiv, parms, storeOrder);
}

function goToPayPal(){
  // setUpPayPal(amount, pid, oid, yid, X, Y, type, rid);
}

function getReadyForPayPal(flag){
  var dataGather = document.getElementById("dataGather");
  var shoppingTable = document.getElementById("shoppingTable");
  if(!flag){
    dataGather.style.visibility = "hidden";
    return;
  }
  var merch = [];
  var dataVerified = true;

  for (var r=1; r < shoppingTable.rows.length; r++){
    //Item Name, Count, Size, Cost, ProductID
    merch.push([shoppingTable.rows[r].cells[0].innerHTML,shoppingTable.rows[r].cells[1].innerHTML,shoppingTable.rows[r].cells[2].innerHTML,shoppingTable.rows[r].cells[3].innerHTML,shoppingTable.rows[r].cells[5].innerHTML]);
    // payTotal += parseInt(shoppingTable.rows[r].cells[4].innerHTML * 100);
  }

  // console.log(merch);
  var dGName = document.getElementById("dGName");
  var dGEMail = document.getElementById("dGEMail");
  var dGVerEMail = document.getElementById("dGVerEMail");

  dGName.style.border = "";
  if (!verifyNameData()){
    dGName.style.border = "2px solid red";
    dataVerified = false;
  }

  dGMName.style.border = "";
  dGEMail.style.border = "";
  dGVerEMail.style.border = "";

  if (!verifyEmailData()){
    dGEMail.style.border = "2px solid red";
    dGVerEMail.style.border = "2px solid red";
    dataVerified = false;
  }

  // var dGAddress1 = document.getElementById("dGAddress1");
  // var dGAddress2 = document.getElementById("dGAddress2");
  // var dGAddress3 = document.getElementById("dGAddress3");
  var dGAddress4 = document.getElementById("dGAddress4");
  var dGAddress5 = document.getElementById("dGAddress5");
  var dGAddress6 = document.getElementById("dGAddress6");
  var dGAddress7 = document.getElementById("dGAddress7");
  var dGAddress8 = document.getElementById("dGAddress8");

  dGAddress4.style.border = "";
  dGAddress5.style.border = "";
  dGAddress6.style.border = "";
  dGAddress7.style.border = "";
  dGAddress8.style.border = "";

  if (!verifyBillingData()){
    dGAddress4.style.border = "2px solid red";
    dGAddress5.style.border = "2px solid red";
    dGAddress6.style.border = "2px solid red";
    dGAddress7.style.border = "2px solid red";
    dGAddress8.style.border = "2px solid red";
    dataVerified = false;
  }

  if (dataVerified){
    // formatOrder(e,s,n,p,f,m,od,sd)
    // console.log(merch);
    storeAccount(dGEMail.value, merch, false, dGMName.value, dGAddress4.value, dGAddress5.value, dGAddress6.value, dGAddress7.value, dGAddress8.value);
    // goToPayPal();
  }
  // alert("Store and go to pay pal...");
}
