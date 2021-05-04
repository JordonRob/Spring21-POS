<?php 
require_once "../backend/database.php";
    
if(isset($_POST['save'])){  //checks to see if the form was submitted
//variables for each section of form
    $name = $_POST['pname'];
    $sku = $_POST['sku'];
    $VID = $_POST['VID'];
    $quantity = $_POST['quantity'];
    $wholesale_price = $_POST['ws_cost'];
    $retail_price = $_POST['rt_cost'];
    $taxable = $_POST['is_taxable'];
    $perishable = $_POST['is_perishable'];
    



    

  
//insertion into database
   
       $query = "REPLACE INTO products_new(pname,sku,VID,quantity,ws_cost,rt_cost,is_taxable,is_perishable) VALUES('$name','$sku','$VID','$quantity','$wholesale_price','$retail_price','$taxable','$perishable')";
   
       
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
    $name = $_POST['pname'];
    //$price = $_POST['price'];
    //$quantity = $_POST['quantity'];

  $sql = "DELETE FROM products_new WHERE pname='" . $_POST["pname"] . "'";
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
