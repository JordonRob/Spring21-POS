/*eslint-env browser*/


function on_transaction() {
	document.getElementById("transaction-overlay").style.display = "block";
	document.getElementById("item-overlay").style.display = "none";
	document.getElementById("management-overlay").style.display = "none";
}

function on_item() {
	document.getElementById("item-overlay").style.display = "block";
	document.getElementById("transaction-overlay").style.display = "none";
	document.getElementById("management-overlay").style.display = "none";
}

function on_management() {
	document.getElementById("management-overlay").style.display = "block";
	document.getElementById("transaction-overlay").style.display = "none";
	document.getElementById("item-overlay").style.display = "none";
    
}

function open_register(){
alert("Please close register to continue!");

}

function lockscreen() {
	alert("This logs the user out");
}

function off_transaction() {
	document.getElementById("transaction-overlay").style.display = "none";
}

function off_item() {
	document.getElementById("item-overlay").style.display = "none";
}

function off_management() {
	document.getElementById("management-overlay").style.display = "none";
}

function addNumber(element) {
	document.getElementById("code").value =
		document.getElementById("code").value + element.value;
    
}

function backSpace() {
	document.getElementById("code").value = document
		.getElementById("code")
		.value.substring(0, document.getElementById("code").value.length - 1);
}

function return_overlay() {
	document.getElementById("return").style.display = "block"; 
	document.getElementById("main-container").style.display = "none"; 
  
}

function close_returns() {
	document.getElementById("return").style.display = "none";
	document.getElementById("main-container").style.display = null; 
}

function Openinventory() {
	document.getElementById("Inventoryform").style.display = "block"
    document.getElementById("transaction-overlay").style.display = "none";
	document.getElementById("item-overlay").style.display = "none";
    document.getElementById("management-overlay").style.display = "none";
    document.getElementsByClassName("functions").style.display = "none";
}

function disable(){
    
     $(document).on('click', ':button', function (e) {

            var btn = $(e.target);
            btn.attr("disabled", "disabled"); // disable button

        });

}






function OpenPriceCheck() {
	document.getElementById("PriceCheckform").style.display = "block"
    document.getElementsByClassName("functions").style.display = "none";
}


function Opencoupon() {
	document.getElementById("Couponform").style.display = "block";
}

function Closeinventory() {
	document.getElementById("Inventoryform").style.display = "none";
}

function Closepricecheck() {
	document.getElementById("PriceCheckform").style.display = "none";
}

function Closecoupon() {
	document.getElementById("Couponform").style.display = "none";
}

function Openvoid() {
	document.getElementById("Voidform").style.display = "block";
}

function Closevoid() {
	document.getElementById("Voidform").style.display = "none";
}


var dt = new Date();
document.getElementById("datetime").innerHTML = dt.toLocaleString();