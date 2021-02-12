<?php
include 'session.php';
include '../backend/db_connection.php';
openCon();

//checks if id and password sent from form - login

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $myid=mysqli_real_escape_string($db,$_POST['id']);
    $mypassword=mysqli_real_escape_string($db,$_POST['password']);


}