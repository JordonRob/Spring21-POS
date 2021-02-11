<?php

$link = mysqli_connect("localhost", "root", "", "securepos");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
//$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
//$password = mysqli_real_escape_string($link, $_REQUEST['password']);
 
//Attempt insert will add info
        //$sql = "INSERT INTO USERS(first_name, last_name, password)  
        //VALUES ('$first_name', '$last_name', '$password')";

if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>