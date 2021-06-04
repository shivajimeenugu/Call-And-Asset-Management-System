<?php

?>

<?php
session_start();
if(!isset($_SESSION["eng_username"])){
header("Location: eng_login.php");
exit(); }
?>
