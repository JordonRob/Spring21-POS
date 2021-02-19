

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

  function lockscreen(){
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


  function addNumber(element){
      document.getElementById('pic').value = document.getElementById('pic').value+element.value;
  }

  function backSpace(){
      document.getElementById('pic').value = document.getElementById('pic').value.substring(0, document.getElementById('pic').value.length-1);
  }

  function return_overlay(){
    document.getElementById('return').style.display="block";
    document.getElementById('main-container').style.display="none";


  }

function Openinventory() {
	document.getElementById("Inventoryform").style.display = "block";
}

function Closeinventory() {
	document.getElementById("Inventoryform").style.display = "none";
}

function doDate()
{
    var str = "";

    var days = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    var months = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    var now = new Date();

    str += "Today is: " + days[now.getDay()] + ", " + now.getDate() + " " + months[now.getMonth()] + " " + now.getFullYear() + " " + now.getHours() +":" + now.getMinutes() + ":" + now.getSeconds();
    document.getElementById("todaysDate").innerHTML = str;
}

setInterval(doDate, 1000);