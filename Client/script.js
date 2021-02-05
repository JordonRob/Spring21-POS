

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