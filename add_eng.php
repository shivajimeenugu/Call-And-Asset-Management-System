<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ENGINEER ADD FORM</title>

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

$eng_name=strtoupper($_REQUEST['eng_name']);




//$q="insert into 10(eng_name,app_call,call_id,call_start_t,call_end_t,call_desc,call_sts,spare_det,otr_det,remarks,date) values('$eng_name','$app_call','$call_id',$call_start_t,$call_end_t,'$call_desc','$call_sts','$spare_det','$otr_det','$remarks','$date');";
$q="INSERT INTO eng_name(`eng_name`) VALUES ('$eng_name')";

$st=mysqli_query($con,$q) or die(mysqli_error($con));
//header('Location: suss_newinsert.php');


if($st)
{
 

 
echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >ENG ADDED<p></div></div></div>'; 
	  echo'<script>document.getElementById("id01").style.display="block"</script>';
}
else{
	echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >ERROR! CAN NOT ADD ENG<p></div></div></div>'; 
	  echo'<script>document.getElementById("id01").style.display="block"</script>';
}	
	
	

}

function getengdet()
	{
	
	}

?>
</table></CENTER>










<br/>







<form action="" class=" w3-card-4   w3-padding" method="post"  align="center">
<center><p class="w3-blue">ENGINEER ADD FORM</p></center>

<input type="hidden" name="new" value="1" />




<div class="w3-row">
<lable class="  w3-half">NAME OF ENGINEER</lable> 
<input class=" w3-input w3-border w3-half" type="text" name="eng_name"  placeholder="ENTER NAME OF ENGINEER" required  /> 
</div>
<br/>


<center><input align="center"  type="submit" class="w3-btn  w3-center w3-blue" value="ADD ENGINEER" > </center>


</form>

<?php 
$count=1;
		
		$query2 = "SELECT * FROM eng_name  ORDER BY eng_name";
$result2 = mysqli_query( $con, $query2);
		echo '
	
	
	<CENTER>
	<table class="w3-table-all  w3-responsive  ">
						<tr><th colspan="11"><center>ENGINEER NAMES</center></th></tr>
						<tr class="w3-hover-grey w3-red">
		
			<br/>		
<th>SI.NO</th>							
<th>NAME</th>
<th>OPTIONS</th>

				</tr>';
while($row2 = mysqli_fetch_array($result2))
	{
		
			echo'<tr class="w3-hover-grey ">
			
	
	
<td align="center">.'.$count.'</td>
<td align="center">'.$row2["eng_name"].'</td>


<td><a href ="delete_eng_name.php?id='.$row2["id"].'"> DEELTE </a><br></td>



		</tr>';
		
		$count++;
		
	}
echo '</table></center>';
?>



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
