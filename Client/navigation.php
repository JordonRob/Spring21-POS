<?php
    require_once "../backend/login_check.php";
    require_once "../backend/db_connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SecurePOS</title>
<link rel="stylesheet" type="text/css" href="navigation.css">
</head>

<body>
    <div class="flex-container"> <!---Create a container to hold the retail and management divs so they are aligned--> 
    <div class="retail-nav"> <!---Retail side--> 
        <button class="button" id="retail-button" onclick="on_main_page()">RETAIL</button> <!---Retail button to bring the user to the transaction page-->
    </div> 

        <div class="manager-nav"> <!---Management side-->
            <div class ="header"> 
             MANAGEMENT  
            </div>
            <form>
                <input class = "password" type= "password" id = "enter"  placeholder= "ENTER PASSWORD"/> <!---Management has to input their password to get to the management functions-->
            </form>
        </div>
    </div>
</body>
</html>