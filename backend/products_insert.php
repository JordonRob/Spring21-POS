<?php

include '../backend/db_connection.php';
include 'config.ini'

//Opens connection
openConn();

$PIDC = mysqli_real_escape_string($link, $_REQUEST['PIDC']);
$Name = mysqli_real_escape_string($link, $_REQUEST['Name']);
$Price = mysqli_real_escape_string($link, $_REQUEST['Price']);
$Quantity = mysqli_real_escape_string($link, $_REQUEST['Quantity']);
$Date_Added = mysqli_real_escape_string($link, $_REQUEST['Date_Added']);

//Attempt insert will add info
    $sql = "INSERT INTO 'Products'(PIDC, Name, Price, Quantity, Date_Added);  
        VALUES ('$PIDC', '$Name', '$Price', '$Quantity', '$Date_Added')";

if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
//Closes connection
closeConn($conn);
?>