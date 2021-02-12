<?php

session_start();

$_SESSION = array();

session_destroy();
//redirect to login screen
header('Location: login.php');
exit();

?>