<?php


require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM eng_name WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error());
header("Location:add_eng.php"); 
?>