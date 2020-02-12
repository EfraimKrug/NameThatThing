var popUpReturn = "";
var popUpCallbackOK = "";
var popUpCallbackNo = "";

function popUpOK(val){
  if(val){
    if(popUpCallbackOK) popUpCallbackOK();
  } else {
    if(popUpCallbackNo) popUpCallbackNo();
  }
  closePopUp();
}

function popUpTextOK(val){
  var popUpTextBox = document.getElementById("popUpInput");
  if(val){
    if(popUpCallbackOK){
      popUpReturn = popUpTextBox.value;
      popUpCallbackOK();
    }
  }
  closePopUp();
}

function openPopUpText(msg, pholder, callbackOK, callbackNo){
  if(callbackOK) popUpCallbackOK = callbackOK;
  if(callbackNo) popUpCallbackNo = callbackNo;

  var popUpBox = document.getElementById("popUpBox");
  var popUpMessage = document.getElementById("popUpMessage");
  var popUpInput = document.getElementById("popUpInput");

  popUpMessage.innerHTML = msg;
  popUpBox.style.visibility = 'visible';
  popUpInput.placeholder = pholder;
  popUpInput.value = "";
  popUpInput.style.visibility = 'visible';
}

function openPopUp(msg, callbackOK, callbackNo){
  if(callbackOK) popUpCallbackOK = callbackOK;
  if(callbackNo) popUpCallbackNo = callbackNo;
  var popUpBox = document.getElementById("popUpBox");
  var popUpMessage = document.getElementById("popUpMessage");
  var popUpInput = document.getElementById("popUpInput");

  popUpMessage.innerHTML = msg;
  popUpBox.style.visibility = 'visible';
  popUpInput.style.visibility = 'hidden';
}

function closePopUp(){
  var popUpBox = document.getElementById("popUpBox");
  var popUpMessage = document.getElementById("popUpMessage");
  popUpMessage.innerHTML = "";
  popUpBox.style.visibility = 'hidden';
  popUpInput.style.visibility = 'hidden';
}
