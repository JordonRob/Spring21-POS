<?php 
require_once "../backend/database.php";
if(isset($_POST['save'])){  //checks to see if the form was submitted
//variables for each section of form
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

  
//insertion into database
   
       $query = "REPLACE INTO products(name,price,quantity) VALUES('$name','$price', '$quantity')";
   
       
  //checks to see if any errors
    if ((mysqli_query($conn, $query))){
            echo "New record created successfully !";
         }
    else {
            echo "Error: " . $query . "
    " . mysqli_error($conn);
         }
         mysqli_close($conn);
    }
    
   // REMOVE Function
if(isset($_POST['remove'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

  $sql = "DELETE FROM products WHERE name='" . $_POST["name"] . "'";
//checks to see if any errors
if(mysqli_query($conn,$sql)) {
         echo "New record created successfully !";
      } else {
         echo "Error: " . $sql . "
 " . mysqli_error($conn);
      }
      mysqli_close($conn);
 }
    ?>
