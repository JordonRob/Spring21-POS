<?php

$db = mysqli_connect("localhost","root","theultimate50","securepos");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>