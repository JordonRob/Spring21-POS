<?php

require_once "../backend/product_functions.php";
require_once '../backend/db_connection.php';

//Define empty values
$result = $ID = $PIDC = $Name = $Price = "";
$ID_Error = $PIDC_Error = $Name_Error = $Price_Error = "";


//Process Data
//Check request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["ID"]))) {
        $ID_Error = "Please enter a ID #.";
    } else {
        $ID = trim($_POST["ID"]);
    }
    if (empty(trim($_POST["PIDC"]))) {
        $PIDC_Error = "Please enter the PIDC.";
    } else {
        $PIDC = trim($_POST["PIDC"]);
    }
    if (empty(trim($_POST["Name"]))) {
        $Name_Error = "Please enter the product name.";
    } else {
        $Name = trim($_POST["Name"]);
    }
    if (empty(trim($_POST["Price"]))) {
        $Price_Error = "Please enter the price.";
    } else {
        $Price = trim($_POST["Price"]);
    }

    $conn = openConn();
    if (!doesProductExist($conn, $PIDC, $Name)) {
        $product = createProduct($conn, $ID, $PIDC, $Name, $Price);
        $result = "Added new product with ID {$product["id"]}";
        header("location: index.php");
    }
    else {
        $result = "A product with that PIDC and Name already exists. If you'd like to create another product with that name please alter the PIDC and Name.";
    }
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">   

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title>Add Record Form</title>
<link rel="stylesheet" href="product_insert.css">
</head>

<body>
    <div class="new-product-container">


        <div class = "header">
                ADD PRODUCTS
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" autocomplete="off">   

            <div class = "center">
                <input type="int" name="ID" id="ID" placeholder = "ENTER ID"> 
                <p class="help-block"><?php echo $ID_error; ?></p> 
            </div>
            <div class = "center">
                <input class="text" name="PIDC" id="PIDC" placeholder = "ENTER PIDC"> 
                <p class="help-block"><?php echo $PIDC_error; ?></p> 
            </div>

            <div class = "center">
                <input class="text" name="Name" id="Name" placeholder = "ENTER NAME"> 
                <p class="help-block"><?php echo $Name_error; ?></p>  
            </div>

            <div class = "center">   
                <input type="double" name="Price" id="Price" placeholder = "ENTER PRICE">    
                <p class="help-block"><?php echo $Price_error; ?></p>
            </div>
    
            <input type="submit" class = "button" value="Add Product">
        </form>
    </div>

    <form method = "POST" action = "index.php">
            <div class="center">
                <input type = "submit" class = "button" id="returnbtn" value = "Return Home">
            </div>
    </form>

</body>
</html>