<?php


session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: eng_login.php"); // Redirecting To Home Page
}
?>