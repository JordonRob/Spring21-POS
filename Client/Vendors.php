<?php 
require_once "../backend/database.php";
    
if(isset($_POST['save'])){  //checks to see if the form was submitted
//variables for each section of form
    $Company = $_POST['company'];
    $EIN = $_POST['EIN'];
    $Street1 = $_POST['Street1'];
     $Street2 = $_POST['Street2'];
    $City = $_POST['City'];
    $State = $_POST['State']; 
    $Zip = $_POST['Zip'];
    $Phone = $_POST['Phone'];
    $Fax = $_POST['Fax'];
     $Contact = $_POST['Contact'];
    $Email = $_POST['Email'];
    $Website = $_POST['Website'];


//insertion into database
   
       $query = "REPLACE INTO vendors(company, EIN, Street1, Street2, City, State, Zip, Phone, Fax, Contact, Email, Website) VALUES('$Company','$EIN', '$Street1','$Street2', '$City','$State', '$Zip','$Phone', '$Fax','$Contact', '$Email', '$Website')";
   
       
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

	//variables for each section of form
    $Company = $_POST['company'];
    $EIN = $_POST['EIN'];
    $Street1 = $_POST['Street1'];
     $Street2 = $_POST['Street2'];
    $City = $_POST['City'];
    $State = $_POST['State']; 
    $Zip = $_POST['Zip'];
    $Phone = $_POST['Phone'];
    $Fax = $_POST['Fax'];
     $Contact = $_POST['Contact'];
    $Email = $_POST['Email'];
    $Website = $_POST['Website'];

$sql = "DELETE FROM vendors WHERE company='" . $_POST["company"] . "'";
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
