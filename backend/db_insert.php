<?php

include '../backend/db_connection.php';

//Opens connection
openConn();

$firstname = mysqli_real_escape_string($link, $_REQUEST['firstname']);
$lastname = mysqli_real_escape_string($link, $_REQUEST['lastname']);
$is_management = mysqli_real_escape_string($link, $_REQUEST['is_management']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);
 
//Attempt insert will add info
        $sql = "INSERT INTO 'users'(first_name, last_name, is_management, password);  
        VALUES ('$firstname', '$lastname', '$is_management', '$password')";

if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
//Closes connection
closeConn($conn);
?>