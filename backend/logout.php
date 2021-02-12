<?php

session_start();

//logout of session
if(session_destroy())
{
    //redirect to login screen
    header('Location: login.html');
}
exit();
?>