<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "securepos";

//Define the empty values
$result = $Code = $Price = "";

$sql = "SELECT PIDC, price FROM strproducts";


if (mysqli_connect_error()){
    die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
}
else{ 
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["Code"]))) {
            $Code_Error = "Please enter PIDC code.";
        } else {
        $Code = trim($_POST["Code"]);
        echo $Price;
    }
}
    // collect value of input field
    /*$Code = $_POST['Code'];
    if (empty($Code)) {
      echo "PIDC is empty";
    } else {
      echo $Price;
    }
  } 
} */

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
           <!-- <div class = "PIDCbox">
                <input class="text" name="PIDC" id="PIDC" placeholder = "ENTER PIDC">  
                <p class="help-block">
            </div> --->

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                PIDC: <input type="text" name="Code">
                <input type="submit">
            </form>

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