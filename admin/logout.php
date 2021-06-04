<?php


session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: admin_login.php"); // Redirecting To Home Page
}
?>