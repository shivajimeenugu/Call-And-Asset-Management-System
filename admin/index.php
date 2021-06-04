<?php include 'admin_auth.php'; 
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <meta http-equiv = "refresh" content = "1; url=dashboard.php" />
<title>Welcome Home</title>

</head>
<body  >
<div class="w3-sidebar w3-bar-block w3-white w3-card w3-animate-left" style="display:none" id="mySidebar">
                             <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
                                       <a class="w3-bar-item w3-button" href="index.php">HOME</a>
                                       <a class="w3-bar-item w3-button" href="dashboard.php">DASHBOARD</a>
                                       <a class="w3-bar-item w3-button" href="menue.php">MENU</a>
                                       <a class="w3-bar-item w3-button" href="logout.php">LOGOUT</a>
                             
            </div> 


<div class="w3-container w3-animate-right" id="main">
             <?php include 'header.php';?>



     

<div class="w3-container" >
<center><p><h1 class="w3-center w3-animate-right">Welcome,<?php echo $_SESSION["admin_username"]; ?>!</h1></p></center>
<center><img class="w3-center w3-animate-right" src="2.png" ></img></center>
<br\><br\><br\><br\><br\><br\><br\><br\>
<!---<center><img style="margin-top:150px;"src="down.gif"></img>
<h3 style="color:#ff0066;"><span class="blink_text"><a href="dashboard.php">DASHBOARD</a><span></h3></center>-->



<br /><br /><br /><br />



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
