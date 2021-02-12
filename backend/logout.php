<?php

session_start();
unset($_SESSION["id"]);
unset($_SESSION["password"]);
//redirect to login screen
header('Location: login.html');

?>