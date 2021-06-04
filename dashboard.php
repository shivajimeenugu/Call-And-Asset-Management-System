<?php

 
require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DASHBOARD</title>

</head>
<body class="" >
     <div class="w3-sidebar w3-bar-block w3-white w3-card w3-animate-left" style="display:none" id="mySidebar">
                             <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
                                       <a class="w3-bar-item w3-button" href="index.php">HOME</a>

                                       <a class="w3-bar-item w3-button" href="dashboard.php">DASHBOARD</a>
		
		

                                       

                                       <a class="w3-bar-item w3-button" href="logout.php">LOGOUT</a>
                             
            </div> 


<div class="w3-container w3-animate-right" id="main">
      <?php include 'header.php';?>
	  
<br/>
   <div class="w3-bar w3-light-blue"  >
  <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'London')">CALL OPTIONS</button>
     <!-- <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Paris')">ADD OR REMOVE</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Tokyo')">NOTIFICATIONS</button>
  <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'tiruvuru')">SEARCH OPTIONS

</button>
   <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'kuppam')">LOGS</button>
</div>-->

<!--/////////////////////////////////////////-->
<div id="London" class="w3-container w3-display-container city">
 <!-- <span onclick="this.parentElement.style.display='none'"
  class="w3-button w3-large w3-display-topright">&times;</span>-->
 <br/>
 <div class="  w3-container w3-card w3-light-blue">
  
  
 <center> <div class="w3-panel w3-round w3-white"><p> CALL OPTIONS</p></div></center>
  <center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='add_call.php'">ADD CALL</button></center><br/>
 <center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='edit_index_call.php'">EDIT CALL</button></center><br/>

  <center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='sort_by_date.php'"> CALLS REPORTS</button></center><br/>
  <center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='add_eng.php'">ADD OR REMOVE ENGINEER</button></center><br/>
 

 
</div>
  
   <br/>
  
  
</div>
 


<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>


 


 
 



<br/>

	   
	   
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
<?php include 'footer.php';?>
 </body>



</html>














