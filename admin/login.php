
<!DOCTYPE html>
<html>


<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>login Home</title>

</head>
<body  >
     <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
                             <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
                                       
                             
            </div> 


<div class="w3-container w3-animate-right" id="main">
             <?php include 'header.php';
			    include 'db.php';
			 ?>



   <?php
	require('db.php');
	
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['pass'] )){
		
		//$br=stripslashes($_REQUEST['pass']);
		$pass=$_REQUEST['pass'];
		if($pass=='dcmelab')
		{
		
	    $_SESSION['pass']='NG SWAMY';
			header("Location:index.php"); // Redirect user to index.php
        }
else{
	echo'<h1 class="w3-bold w3-red">ERROR! ENTER CORRECT PASSWORD</h1>';
}		
    }
?>  

<div class="w3-container" >
<br/><br/>
<center>


  











<form  action="" method="POST" >



<input type="password" placeholder="ENTER PASSWORD" name="pass" class="w3-input w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
</center>



<br /><br />
<center>
<button type="submit" name="login" class="w3-button w3-theme-d4">LOGIN</button></center>
<br /><br />
</form>
<!--<center><div ><a class="w3-button w3-blue" align="center" href="/asset/admin" style="width:auto;">ADMIN LOGIN</a></div></center>-->

<?php include 'footer.php';?>
<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>
</div>
 </body>



</html>
