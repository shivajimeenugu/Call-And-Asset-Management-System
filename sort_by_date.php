<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CALL SORT BY DATE FORM</title>

</head>
<body  >
     <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
                             <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
                                       <a class="w3-bar-item w3-button" href="index.php">HOME</a>

                                       <a class="w3-bar-item w3-button" href="dashboard.php">DASHBOARD</a>
		
		

                                       

                                       <a class="w3-bar-item w3-button" href="logout.php">LOGOUT</a>
                             
            </div> 


<div class="w3-container w3-animate-right" id="main">
            <?php include 'header.php';?>

     

<div class="w3-container" >

<?php
include 'db.php';
include("auth.php");

if(isset($_POST['new']) && $_POST['new']==1)
{

$from_date=$_REQUEST['from_date'];
$to_date=$_REQUEST['to_date'];
header("Location:print_call_auto.php?from_date=$from_date&to_date=$to_date"); 	
}

if(isset($_POST['export_post']) && $_POST['export_post']==1)
{

$from_date=$_REQUEST['from_date'];
$to_date=$_REQUEST['to_date'];
header("Location:export.php?sql=SELECT * FROM call_mgmt_table WHERE date BETWEEN '$from_date' AND '$to_date'"); 	
}

?>


<br/>

<form action="" class=" w3-card-4   w3-padding" method="post"  align="center">
<center><p class="w3-blue">CALL SORT BY DATE FORM</p></center>

<input type="hidden" name="new" value="1" />


			
<br/>


<div class="w3-row">
<lable class="  w3-half">FROM DATE</lable> 
<input class=" w3-input w3-border w3-half" type="date" name="from_date"  placeholder="ENTER APPOINT CALL" required  /> 
</div>
<br/>


<div class="w3-row">
<lable class="w3-half">TO DATE: </lable> 
<input class=" w3-input w3-border w3-half" type="date" name="to_date"  placeholder="ENTER REG NUMBER"   /> 
</div>
<br/>







<br/>



<center><input align="center"  type="submit" class="w3-btn  w3-center w3-blue" value="SHOW" > </center>


</form>

<br/>
<form action="" class=" w3-card-4   w3-padding" method="post"  align="center">
<center><p class="w3-blue">CALL EXPORT BY DATE FORM</p></center>
<input type="hidden" name="export_post" value="1" />

<div class="w3-row">
<lable class="  w3-half">FROM DATE</lable> 
<input class=" w3-input w3-border w3-half" type="date" name="from_date"  placeholder="ENTER APPOINT CALL" required  /> 
</div>
<br/>


<div class="w3-row">
<lable class="w3-half">TO DATE: </lable> 
<input class=" w3-input w3-border w3-half" type="date" name="to_date"  placeholder="ENTER REG NUMBER"   /> 
</div>
<br/>

<center><input align="center"  type="submit" class="w3-btn  w3-center w3-blue" value="EXPORT" > </center>


</form>

<br/>
<div class="w3-panel w3-green">BELOW OPTION EXPORTS ENTIRE DATABASE</div>
  <center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='export.php?sql=<?php echo'select * from call_mgmt_table'; ?>'">EXPORT ALL CALLS DATA</button></center><br/>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


<br/>



</div>
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
 </body>



</html>
