<?php 
require_once "../backend/database.php";
if(isset($_POST['save'])){  //checks to see if the form was submitted
//variables for each section of form
    $name = $_POST['name'];
    $Code = $_POST['Code'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

  
//insertion into database
   
       $query = "INSERT INTO products(name,Code,price,quantity) VALUES('$name', '$Code', '$price', '$quantity') ON DUPLICATE KEY UPDATE name='$name', Code='$Code', price='$price', quantity='$quantity'";
       
  //checks to see if
    if ((mysqli_query($conn, $query))){ //&& (products(name,Code)== VALUES('$name', '$Code')))) {
            echo "New record created successfully !";
            header("location: index.php");
         } else {
            echo "Error: " . $query . "
    " . mysqli_error($conn);
         }
         mysqli_close($conn);
    }
if(isset($_POST['remove']))
    $name = $_POST['name'];
    $Code = $_POST['Code'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

  $sql = "DELETE FROM products WHERE Code=$Code";
//checks to see if
if(mysqli_query($conn,$sql)) {
         echo "New record created successfully !";
      } else {
         echo "Error: " . $query . "
 " . mysqli_error($conn);
      }
      mysqli_close($conn);
 
    ?>
