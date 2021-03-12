<?php 
include_once 'database.php';
if(isset($_POST['save'])){  //checks to see if the form was submitted
//variables for each section of form
    $name = $_POST['name'];
    $PIDC = $_POST['PIDC'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

  
//insertion into database
   
       $query = "REPLACE  INTO products(name,PIDC,price,quantity) VALUES('$name', '$PIDC', '$price', '$quantity')";
       
  //checks to see if
    if ((mysqli_query($conn, $query) && ("products(name,PIDC)== VALUES('$name', '$PIDC)"))) {
            echo "New record created successfully !";
         } else {
            echo "Error: " . $query . "
    " . mysqli_error($conn);
         }
         mysqli_close($conn);
    }
       
    ?>
