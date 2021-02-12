<?php
//start session
session_start();
//user logged in check, if yes redirect
if( isset($_SESSION["id"]) && $_SESSION["id"]== true)
{
    //redirect to navigation page goes here
    header('Location: navigation.html');
    exit();
}
?>