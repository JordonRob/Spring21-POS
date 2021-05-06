<?php

$db = mysqli_connect("localhost","root","","securepos");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>