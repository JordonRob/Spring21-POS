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