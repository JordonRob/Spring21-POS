<?php

include '../backend/db_connection.php';

//Opens connection
openConn();

$ID = mysqli_real_escape_string($link, $_REQUEST['id']);
$PIDC = mysqli_real_escape_string($link, $_REQUEST['PIDC']);
$Name = mysqli_real_escape_string($link, $_REQUEST['name']);
$Price = mysqli_real_escape_string($link, $_REQUEST['price']);



//Attempt insert will add info
    $sql = "INSERT INTO 'strproducts'(id, PIDC, name, price);  
        VALUES ('$ID', '$PIDC', '$Name', '$Price')";

if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
//Closes connection
closeConn($conn);
?>
<!DOCTYPE html>
<html lang="en">    
<head>
<meta charset="UTF-8">    
<title>Add Record Form</title>

</head>

<body>
<form action="products_insert.php" method="post">

    <p>
        <label for="ID">ID:</label>
        <input type="int" name="ID" id="ID">    
    </p>

    <p>
        <label for="PIDC">PIDC:</label>
        <input type="text" name="PIDC" id="PIDC">    
    </p>

    <p>
        <label for="Name">Name:</label>
        <input type="text" name="Name" id="Name">    
    </p>

    <p>    
        <label for="Price">Price:</label>
        <input type="double" name="Price" id="Price">    
    </p>
    
    <input type="submit" value="Submit">
</form>
</body>
</html>