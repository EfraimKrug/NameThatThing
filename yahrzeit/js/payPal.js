function actionAfterPayment(amt, pid, oid, yid, X, Y){
  window.open("https://NameThatThing.site/paidDonation.html?AMOUNT=" + amt + "&PID=" + pid + "&OID=" + oid + "&YahrID=" + yid + "&X=" + X + "&Y=" + Y, "_blank", "resizable=yes");
}

function setUpPayPal(amt, pid, oid, yid, X, Y){
  actionAfterPayment(amt, pid, oid, yid, X, Y);
}

function __setUpPayPal(amt, pid, oid, yid, X, Y){
    var output = document.getElementById("output");
    var USDamount = amt ? amt : '18.00';
    var pid = pid;
    var oid = oid;
    var yid = yid;

    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'gold',
            layout: 'horizontal',
            label: 'pay',

        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: USDamount
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                actionAfterPayment(USDamount, pid, oid, yid, X, Y);
                //output.innerHTML = "[" + details.payer.name.given_name + "][" + details.purchase_units[0].payments.captures[0].amount.value  + "][" + details.purchase_units[0].payments.captures[0].amount.currency_code + "]";
                //window.open("https://NameThatThing.site/paidDonation.html?AMOUNT=" + USDamount + "&PID=" + pid + "&OID=" + oid + "&YahrID=" + yid, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
            });
        }
    }).render('#paypal-button-container');

}
