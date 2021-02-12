<?php

session_start();
$_SESSION['user'] = array();
$id=$_POST['id'];
$password=$_POST['password'];
array_push($_SESSION['user'],$id,$password);
unset($_SESSION['user']);

//redirect to login screen
header('Location: login.html');

?>