<?php


session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: cc_login.php"); // Redirecting To Home Page
}
?>