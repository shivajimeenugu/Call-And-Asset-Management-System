<?php include 'admin_auth.php'; 
include 'db.php'; 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ADD BRAND</title>

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

<?php


if(isset($_POST['new']) && $_POST['new']==1)
{
//auto columns
date_default_timezone_set('Asia/Kolkata'); 
$log_date=date('Y-m-d');
$log_time=date("H:i:s");

$bname=$_REQUEST['bname'];


$query = "INSERT INTO `brands` (brand) VALUES ('$bname')";
$st = mysqli_query($con,$query);


if($st)
{
 

 
echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >BRAND ADDED<p>
      <br/>
      
      <p><center> <a class="w3-btn w3-yellow w3-border" href="add_spear_brand.php">DONE</a></center>
      </p>
      </div></div>
      </div>
      '; 
    echo'<script>document.getElementById("id01").style.display="block"</script>';
    
    //header("Location: dashboard.php");
}
else{
	echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >ERROR! CAN NOT ADD BRAND<p>
      <p><center> <a class="w3-btn w3-yellow w3-border" href="add_spear_brand.php">OK</a></center>
      </p>
      </div></div></div>'; 
	  echo'<script>document.getElementById("id01").style.display="block"</script>';
}	
	
	

}


?>









<br/>







<form action="" class=" w3-card-4   w3-padding" method="post"  align="center">
<center><p class="w3-blue">ADD BRAND</p></center>

<input type="hidden" name="new" value="1" />


<div class="w3-row">
<lable class="w3-half" >ENGINEER BRAND NAME</lable> 
<input type="text" class="w3-half w3-input" name="bname" required/>
</div>
<br/>



<center><input align="center"  value="ADD BRAND" type="submit" class="w3-btn  w3-center w3-blue" name="" > </center>


</form>
<br/>
<br/>
<div class="w3-card-4 w3-pale-red">


<table id="id01" class="w3-table-all  w3-responsive  ">
						<tr><th colspan="11"><center>BRANDS</center></th></tr>
						<tr class="w3-hover-grey w3-red">
						
<th>SI.NO</th>							
<th>ID</th>						
<th>BRAND NAME</th>
<th>OPTIONS</th>
        </tr>';
        <?php
$query = "SELECT * FROM brands";
$result = mysqli_query($con,$query);
$count=1;
while($row = mysqli_fetch_array($result))
	{
		//echo'?>
			<tr class="item w3-hover-grey ">
<td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["id"]; ?></td>
<td align="center"><?php echo $row["brand"]; ?></td>

<td align="center"><a class="w3-button w3-blue" href="#.php?id=<?php echo $row['id'] ;?>">REMOVE</a></td> 
</tr>
  
  <?php
		$count++;
		//';
	}
	

?>

</table></CENTER>



















</div>







<br/>



</div>
<?php include 'footer.php';?>

<script>
function open_down_tab(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>



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
