<?php

?>

<?php
session_start();
if(!isset($_SESSION["cc_username"])){
header("Location: cc_login.php");
exit(); }
?>
