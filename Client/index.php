<?php
require_once "../backend/login_check.php"
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>SecurePOS</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<div class="main-container"><!-- main container to hold all the elements of the SecurePOS-->

<!-- this set of code belongs to the left side/static side of the POS-->
<div class="left-side">
<div class="static-container"><!-- this container will contain mostly static elements on the applcation-->
<div class="function-buttons"> <!-- This div is for the function buttons-->
    <button class="button" id="transaction-function" onclick="on_transaction()">Transaction Functions</button>
    <button class="button" id="item-function" onclick="on_item()">Item Functions</button>
    <button class="button" id="management-function" onclick="on_management()">Management Functions</button>
    <a href="logout.php"><button class="button" id="lock-button">🔒</button></a>
</div>

<div class="item-description"><!--This div is for the item description-->
    <form>
        <input type="search" id="pic" name="pic" placeholder="Please enter Product Identification Code 'PIDC'">
    </form>
    

</div>
</div>
<div class="info-container"><!--this container will contain employee and system information-->


</div>
</div><!--END OF LEFT-SIDE DIV-->

<!-- this set of code will belong to the right side/dynamic side of the POS-->
<div class="right-side">
    <div class="functions">
        <div id="transaction-overlay" onclick="off_transaction()">
            <div class="functional-buttons">
                <button class="button2" id="discount">Employee Discount</button>
                <button class="button2" id="return">Return</button><br/>
                <button class="button2" id="Open">Open Register</button>
                <button class="button2" id="Miscellaneous">Misc.</button>
            </div>
        
        </div>
        <div id="item-overlay" onclick="off_item()">
            <div class="functional-buttons">
                <button class="button2" id="price-check">Price Check</button>
                <button class="button2" id="add-inventory">Add to Inventory</button><br/>
                <button class="button2" id="receipt">Receipt</button>
                <button class="button2" id="Miscellaneous">Misc.</button>
            </div>
        </div> <!--THESE ARE OVERLAYS, THAT WILL SHOW ADDITIONAL FUNCTION BUTTONS-->
        <div id="management-overlay" onclick="off_management()">
            <div class="functional-buttons">
                <button class="button2" id="void">Void Transaction</button>
                <button class="button2" id="add-user">Add User</button><br/>
                <button class="button2" id="z-report">Z-report</button>
                <button class="button2" id="end-of-day">End of Day Report</button>
            </div></div>
    </div>

    <div class="keypad">
        <!-- The following code represents our number pad with button press functionality-->
        <ul id="numpad">   
            <li class="letter" name="1" value="1" id="1" onclick="addNumber(this)">1</li>
            <li class="letter" name="2" value="2" id="2" onclick="addNumber(this)">2</li>  
            <li class="letter" name="3" value="3" id="3" onclick="addNumber(this)">3</li>
             
            <li class="letter clearl" name="4" value="4" id="4" onclick="addNumber(this)">4</li>  
            <li class="letter" name="5" value="5" id="5" onclick="addNumber(this)">5</li>  
            <li class="letter" name="6" value="6" id="6" onclick="addNumber(this)">6</li> 
          
            <li class="letter clearl" name="7" value="7" id="7" onclick="addNumber(this)">7</li>  
            <li class="letter " name="8" value="8" id="8" onclick="addNumber(this)">8</li>  
            <li class="letter" name="9" value="9" id="9" onclick="addNumber(this)">9</li>  

            <li class="switch" name="." value="." id="." onclick="addNumber(this)">.</li>  <!--There is a bug with this button needs to be fixed-->
             <li class="letter" name="0" value="0" id="0" onclick="addNumber(this)">0</li>
             <li class="delete" onclick="backSpace()"><</li> 
             
             <li class="enter">ENTER</li>
        </ul>  

    </div>

    <div class="checkout">
        <button class="button3" id="cash-button">Cash</button>
        <button class="button3" id="credit-button">Credit</button>
        <button class="button3" id="debit-button">Debit</button>
    </div>






    
</div><!--END OF RIGHT-SIDE DIV-->
</div><!--END OF MAIN-CONTAINER-->


<script src="script.js"></script>

</body>

</html>