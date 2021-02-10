

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