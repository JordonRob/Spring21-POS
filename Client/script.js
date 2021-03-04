
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
	document.getElementById("pidc").value =
		document.getElementById("pidc").value + element.value;
}

function backSpace() {
	document.getElementById("pidc").value = document
		.getElementById("pidc")
		.value.substring(0, document.getElementById("pidc").value.length - 1);
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
	document.getElementById("Inventoryform").style.display = "block";
}

function Closeinventory() {
	document.getElementById("Inventoryform").style.display = "none";
}


function Openvoid() {
	document.getElementById("Voidform").style.display = "block";
}

function Closevoid() {
	document.getElementById("Voidform").style.display = "none";
}


var dt = new Date();
document.getElementById("datetime").innerHTML = dt.toLocaleString();