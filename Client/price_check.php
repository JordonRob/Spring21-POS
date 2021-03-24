<?php
require_once "../backend/database.php";

//Define the empty values
$result = $PIDC = $Price = "";

$db = mysql_connect("localhost","root","") or die("Database Error");
mysql_select_db("securepos",$db);

$PIDC = isset($_GET['PIDC']) ? (int)$_GET['PIDC'] : 0;

if($PIDC > 0)
{
    $resource = mysql_query("SELECT price FROM strproducts WHERE price = " . $price);
    if($resource === false)
    {
        die("Database Error");
    }

    if(mysql_num_rows($resource) == 0)
    {
        die("No Item Exists");
    }
    
    $Price = mysql_fetch_assoc($resource);
    echo "Price" . $Price['price'];
}

?>


<!DOCTYPE html>
<html lang="en">   

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title> Price Check Form</title>
<link rel="stylesheet" href="price_check.css">
</head>

<body>
    <div class="price-check-container">

        <div class = "header">
                Price Check
        </div>
           <div class = "PIDCbox">
                <input class="text" name="PIDC" id="PIDC" placeholder = "ENTER PIDC">  
                <p class="help-block">
            </div>

           <!--- <form method="POST" action="<
?php echo $_SERVER['PHP_SELF'];?>">
                PIDC: <input type="text" name="PIDC">
                <input type="submit">
            </form> --->

            <div class = "pricebox">   
                <input type="double" name="Price" id="Price"> 
                <p class="help-block">
            </div>
    
            <input type="find" class = "button" value="FindPrice">  
        </form>
    </div>


    <form method = "POST" action = "index.php">
            <div class="PIDCbox">
                <input type = "submit" class = "button" id="returnbtn" value = "Return Home">
            </div>
    </form>

</body>
</html>
