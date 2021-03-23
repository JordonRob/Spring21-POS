<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "securepos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

require_once '../backend/db_connection.php';
require_once "../backend/conn.php";


//Define the empty values
$result = $PIDC = $Price = "";


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

<?php

$sql = "SELECT PIDC, price FROM strproducts";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $PIDC = $_POST['PIDC'];
    if (empty($PIDC)) {
      echo "PIDC is empty";
    } else {
      echo $Price;
    }
  }
        ?>

        <div class = "header">
                Price Check
        </div>
           <!-- <div class = "PIDCbox">
                <input class="text" name="PIDC" id="PIDC" placeholder = "ENTER PIDC">  
                <p class="help-block">
            </div> --->

            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                pidc: <input type="text" name="PIDC">
                <input type="submit">
            </form>

            <div class = "pricebox">   
                <input type="double" name="Price" id="Price"> <?php echo "$ ".$item["price"]; ?>
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