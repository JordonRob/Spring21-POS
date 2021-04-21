
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecurePOS</title>
    <link rel="stylesheet" href="Vendors.css">
<script src="script.js"></script>

</head>

<body>
    <div class="new-vendor-container">


        <div class="header">
          <b>VENDORS </b>
<table>
<col span="1" class="wide">
<tr>
<th>VID</th>
<th> company</th>
<th>EIN</th>
<th>street1</th>
<th>street2</th>
<th>city</th>
<th>state</th>
<th>zip</th>
<th>phone</th>
<th>fax</th>
<th>contact</th>
<th>email</th>
<th>website</th>
</tr>
<?php
    //Vendors table
    $conn = mysqli_connect("localhost", "root","","securepos");
    
    $sql= "SELECT VID, company, EIN,street1,street2,city,state,zip,phone,fax,contact,email,website from vendors";
    $result = $conn-> query($sql);
    if($result-> num_rows > 0){
        while ($row = $result-> fetch_assoc()){
            echo "<tr><td>" . $row["VID"] . "</td><td>" . $row["company"] . "</td><td>" .$row["EIN"] . "</td><td>" .$row["street1"] . "</td><td>" .$row["street2"] . "</td><td>" .$row["city"] . "</td><td>" .$row["state"] . "</td><td>" .$row["zip"] . "</td><td>" .$row["phone"] . "</td><td>" .$row["fax"] . "</td><td>" .$row["contact"] . "</td><td>" .$row["email"] . "</td><td>" .$row["website"] . "</td></tr>";
        }
        echo "</table>";
    }
    else {
        echo "";
    }
    $conn-> close();
    ?>
</table>
</div>
<body>
//vendors form
     <div class="vendorsform-popup" id="Vendorsform">
        <form action="Vendors.php" method="post" class="vendorsform-container">
            <h1>Vendors</h1>
            <label><b>Company Name</b></label> <input type="text" placeholder="Enter Company Name" name="company" required />
            <br>
            <label><b>EIN</b></label>
            <input type="text" placeholder="EIN" name="EIN" required>
            <br>
            <label><b>Street 1</b></label>
            <input type="text" placeholder="Street" name="Street1" required>
            <br>
            <label><b>Street 2</b></label>
            <input type="text" placeholder="Street" name="Street2">
            <br>
            <label><b>City</b></label>
            <input type="text" placeholder="City" name="City" required>
            <br>
            <label><b>State</b></label>
            <input type="text" placeholder="State" name="State" required>
            <br>
            <label><b>Zipcode</b></label>
            <input type="text" placeholder="Zipcode" name="Zip">
            <br>
            <label><b>Phone</b></label>
            <input type="text" placeholder="Phone" name="Phone" required>
            <br>
            <label><b>Fax</b></label>
            <input type="text" placeholder="Fax" name="Fax" >
            <br>
            <label><b>Contact</b></label>
            <input type="text" placeholder="Contact" name="Contact">
            <br>
            <label><b>Email</b></label>
            <input type="text" placeholder="Email" name="Email" required>
            <br>
            <label><b>Website</b></label>
            <input type="text" placeholder="Website" name="Website">
            <br>
            <button type="submit" name="save" class="btn">Save</button>
            <button type="submit" name="remove" class="btn">Remove</button>
            <button type="button" id="Close" class="btn_cancel" onclick="CloseVendors()">Close</button>
        </form>
        </div>
 
        
    </div>

</body>
<div>
<button class="openButton" id="Open" onclick="OpenVendors()">Vendorsform</button>
</div>
</html>


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
