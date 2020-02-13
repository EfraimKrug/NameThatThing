function formatOrgs(Id, Rav, Email, Name, SAddress, City, State, Country) {
  var str = '';
  if(Id && Rav && Email && Name && SAddress && City && State && Country){
    str = "ID=" + Id;
    str += "&ORav=" + Rav;
    str += "&OEmail=" + Email;
    str += "&OName=" + Name;
    str += "&OStreetAddress=" + SAddress;
    str += "&OCity=" + City;
    str += "&OState=" + State;
    str += "&OCountry=" + Country;
    return str;
  }

  if(Array.isArray(Id)){
    str = "ID=" + Id[0];
    str += "&ORav=" + Id[1];
    str += "&OEmail=" + Id[2];
    str += "&OName=" + Id[3];
    str += "&OStreetAddress=" + Id[4];
    str += "&OCity=" + Id[5];
    str += "&OState=" + Id[6];
    str += "&OCountry=" + Id[7];
    return str;
  }

  if (Object.keys(Id).length > 3){
    str = "ID=" + Id['ID'];
    str += "&ORav=" + Id['ORav'];
    str += "&OEmail=" + Id['OEmail'];
    str += "&OName=" + Id['OName'];
    str += "&OStreetAddress=" + Id['OStreetAddress'];
    str += "&OCity=" + Id['OCity'];
    str += "&OState=" + Id['OState'];
    str += "&OCountry=" + Id['OCountry'];
    return str;
  }

}

function formatPeople(Id, FName, LName, EMail, Secret) {
  var str = '';
  if(Id && FName && LName && EMail && Secret){
    str = "ID=" + Id;
    str += "&FName=" + FName;
    str += "&LName=" + LName;
    str += "&EMail=" + EMail;
    str += "&Secret=" + Secret;
    return str;
  }
  if(Array.isArray(Id)){
    str = "ID=" + Id[0];
    str += "&FName=" + Id[1];
    str += "&LName=" + Id[2];
    str += "&EMail=" + Id[3];
    str += "&Secret=" + Id[4];
    return str;
  }
  if (Object.keys(Id).length > 2){
    str = "ID=" + Id['ID'];
    str += "&FName=" + Id['FName'];
    str += "&LName=" + Id['LName'];
    str += "&EMail=" + Id['EMail'];
    str += "&Secret=" + Id['Secret'];
    return str;
  }
}

// checkLogin("paid", [pid, oid, yid, amount]);
function formatPaid(pid, oid, yid, amount) {
  var str = '';
  if(pid && oid && yid && amount){
    str = "pid=" + pid;
    str += "&oid=" + oid;
    str += "&yid=" + yid;
    str += "&amount=" + amount;
    str += "&X=" + X;
    str += "&Y=" + Y;
    // console.log(str);
    return str;
  }
  if(Array.isArray(pid)){
    str = "pid=" + pid[0];
    str += "&oid=" + pid[1];
    str += "&yid=" + pid[2];
    str += "&amount=" + pid[3];
    str += "&X=" + pid[4];
    str += "&Y=" + pid[5];

    // console.log(str);
    return str;
  }
  if (Object.keys(pid).length > 2){
    str = "pid=" + pid['pid'];
    str += "&oid=" + pid['oid'];
    str += "&yid=" + pid['yid'];
    str += "&amount=" + pid['amount'];
    str += "&X=" + pid['X'];
    str += "&Y=" + pid['Y'];
    return str;
  }
}

function formatConf(Id, ConfKey, ConfDate, ConfPID, ConfTime) {
  var str = '';
  if(Id && ConfKey && ConfDate && ConfPID && ConfTime){
    str = "ID=" + Id;
    str += "&ConfKey=" + ConfKey;
    str += "&ConfDate=" + ConfDate;
    str += "&ConfPID=" + ConfPID;
    str += "&ConfTime=" + ConfTime;
    return str;
  }

  if(Array.isArray(Id)){
    str = "ID=" + Id[0];
    str += "&ConfKey=" + Id[1];
    str += "&ConfDate=" + Id[2];
    str += "&ConfPID=" + Id[3];
    str += "&ConfTime=" + Id[4];
    return str;
  }

  if (Object.keys(Id).length > 2){
    str = "ID=" + Id['ID'];
    str += "&ConfKey=" + Id['ConfKey'];
    str += "&ConfDate=" + Id['ConfDate'];
    str += "&ConfPID=" + Id['ConfPID'];
    str += "&ConfTime=" + Id['ConfTime'];
    return str;
  }
}

function formatPOConn(PID, OID) {
  var str = '';
  if(Array.isArray(PID)){
    str = "PID=" + PID[0];
    str += "&OID=" + PID[1];
    return str;
  }
  if (Object.keys(PID).length == 2){
    str = "PID=" + PID['PID'];
    str += "&OID=" + PID['OID'];
    return str;
  }
  str = "PID=" + PID;
  str += "&OID=" + OID;
  return str;
}

function formatPYConn(PID, YID) {
  var str = '';
  if(Array.isArray(PID)){
    str = "PID=" + PID[0];
    str += "&YID=" + PID[1];
    return str;
  }
  if (Object.keys(PID).length == 2){
    str = "PID=" + PID['PID'];
    str += "&YID=" + PID['YID'];
    return str;
  }
  str = "PID=" + PID;
  str += "&YID=" + YID;
  return str;
}

function formatYahrzeits(Id, YName, YGDate, YHMonth, YHDay, YHYear) {
  // console.log("formatYahrzeits");
  var str = '';
  if(Array.isArray(Id)){
    str = "ID=" + Id[0];
    str += "&YName=" + Id[1];
    str += "&YGDate=" + Id[2];
    str += "&YHMonth=" + Id[3];
    str += "&YHDay=" + Id[4];
    str += "&YHYear=" + Id[5];
    // str += "&YPID=" + Id[6];
    return str;
  }

  if (Object.keys(Id).length > 2){
    str = "ID=" + Id['ID'];
    str += "&YName=" + Id['YName'];
    str += "&YGDate=" + Id['YGDate'];
    str += "&YHMonth=" + Id['YHMonth'];
    str += "&YHDay=" + Id['YHDay'];
    str += "&YHYear=" + Id['YHYear'];
    // str += "&YPID=" + Id['YPID'];
    return str;
  }

  str += "ID=" + Id;
  str += "&YName=" + YName;
  str += "&YGDate=" + YGDate;
  str += "&YHMonth=" + YHMonth;
  str += "&YHDay=" + YHDay;
  str += "&YHYear=" + YHYear;
  // str += "&YPID=" + YPID;
  return str;
}

//Type: Yahrzeit(2), Everything(3), Yizkor YK(5), Yiskor Shavuos(7),
//Yizkor Sukkhos(11), Kaddish for Year(13)
function formatRequests(Id, ReqPID, ReqType, ReqDate, ReqAmount, ReqPaidDate, ReqRequestSentDate, ReqRequestAcceptDate, ReqMoneySentDate, ReqCancelDate, ReqOID, ReqYID) {
  var str = '';
  if(Array.isArray(Id)){
    str = "ID=" + Id[0];
    str += "&ReqPID=" + Id[1];
    str += "&ReqType=" + Id[2];
    str += "&ReqDate=" + Id[3];
    str += "&ReqAmount=" + Id[4];
    str += "&ReqPaidDate=" + Id[5];
    str += "&ReqRequestSentDate=" + Id[6];
    str += "&ReqRequestAcceptDate=" + Id[7];
    str += "&ReqMoneySentDate=" + Id[8];
    str += "&ReqCancelDate=" + Id[9];
    str += "&ReqOID=" + Id[10];
    str += "&ReqYID=" + Id[11];
    return str;
  }
  if (Object.keys(Id).length > 3){
    str = "ID=" + (Id['ID'] || Id['RID']);
    str += "&ReqPID=" + Id['ReqPID'];
    str += "&ReqType=" + Id['ReqType'];
    str += "&ReqDate=" + Id['ReqDate'];
    str += "&ReqAmount=" + Id['ReqAmount'];
    str += "&ReqPaidDate=" + Id['ReqPaidDate'];
    str += "&ReqRequestSentDate=" + Id['ReqRequestSentDate'];
    str += "&ReqRequestAcceptDate=" + Id['ReqRequestAcceptDate'];
    str += "&ReqMoneySentDate=" + Id['ReqMoneySentDate'];
    str += "&ReqCancelDate=" + Id['ReqCancelDate'];
    str += "&ReqOID=" + Id['ReqOID'];
    str += "&ReqYID=" + Id['ReqYID'];
    return str;
  }

  str = "ID=" + Id;
  str += "&ReqPID=" + ReqPID;
  str += "&ReqType=" + ReqType;
  str += "&ReqDate=" + ReqDate;
  str += "&ReqAmount=" + ReqAmount;
  str += "&ReqPaidDate=" + ReqPaidDate;
  str += "&ReqRequestSentDate=" + ReqRequestSentDate;
  str += "&ReqRequestAcceptDate=" + ReqRequestAcceptDate;
  str += "&ReqMoneySentDate=" + ReqMoneySentDate;
  str += "&ReqCancelDate=" + ReqCancelDate;
  str += "&ReqOID=" + ReqOID;
  str += "&ReqYID=" + ReqYID;
  return str;
}
