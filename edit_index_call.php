<?php include("auth.php"); 
include 'db.php';
$query='';
$count=1;
$output = '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $_SESSION["pass"].'- EDIT AASET-'.date("Ymd") ; ?></title>

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


<br/>
     




<?php
$query2 = "SELECT * FROM call_mgmt_table WHERE `call_sts`='PENDING' ORDER BY DATE";
$result2 = mysqli_query( $con, $query2);
if(@mysqli_num_rows($result2) > 0)
{
	echo '
	
	
	<CENTER>
	<table class="w3-table-all  w3-responsive  ">
						<tr><th colspan="11"><center>PENDING CALLS</center></th></tr>
						<tr class="w3-hover-grey w3-red">
		<center><div class="w3-panel w3-blue w3-card-4"><b><h3 style="color:black;">PENDING CALL DETAILS<h3></b></div></center>
			<br/>		
<th>SI.NO</th>							
<th>DATE</th>
							
<th>ENG NAME</th>
<th >APPOINT CALL</th>
<th >CALL REG NUMBER</th>
<th >CALL START TIME</th>
<th >CALL END TIME</th>
<th >DESCRIPTION OF CALL</th>
<th >CALL STATUS</th>
<th >SPARE DETAILS</th>
<th >ANY OTR/OTC</th>
<th >REMARKS</th>
<th>CALL CLOSED DATE</th>
<th colspan="2">OPTIONS</th>

				</tr>';
while($row2 = mysqli_fetch_array($result2))
	{
		//echo'?>
			<tr class="w3-hover-grey ">
			
	
	
<td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row2["date"]; ?></td>
<td align="center"><?php echo $row2["eng_name"]; ?></td>
<td align="center"><?php echo $row2["app_call"]; ?></td>

<td align="center"><?php echo $row2["call_id"]; ?></td>
<td align="center"><?php echo $row2["call_start_t"]; ?></td>
<td align="center"><?php echo $row2["call_end_t"]; ?></td>
<td align="center"><?php echo $row2["call_desc"]; ?></td>
<td align="center"><?php echo $row2["call_sts"]; ?></td>
<td align="center"><?php echo $row2["spare_det"]; ?></td>
<td align="center"><?php echo $row2["otr_det"]; ?></td>
<td align="center"><?php echo $row2["remarks"]; ?></td>
<td align="center"><?php echo $row2["call_closed_date"]; ?></td>

<td><button onclick="window.location.href ='delete.php?id=<?php echo $row2["id"]; ?>';"> DEELTE </button><br></td>
<td><button onclick="window.location.href ='edit_call.php?id=<?php echo $row2["id"]; ?>';"> EDIT </button><br></td>

		</tr>
		<?php
		$count++;
		//';
	}
	
}
else
{
	echo '<h1 class="w3-panel w3-green w3-round">NO CALLS ARE PENDING </h1>';
}


?>
</table></CENTER>


<!---/////////////////////////////////////////////////////////////////////////////////////////////////-->



<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->

<?php

$query = "SELECT * FROM call_mgmt_table WHERE `call_sts`='CLOSED' ORDER BY DATE";
$result = mysqli_query( $con, $query);
if(@mysqli_num_rows($result) > 0)
{
	echo '<br/>
	
	
	<CENTER>
	<table class="w3-table-all  w3-responsive  ">
		<center><div class="w3-panel w3-blue w3-card-4"><b><h3 style="color:black;">CLOSED CALL DETAILS<h3></b></div></center>
<br/>
						<tr><th colspan="11"><center>CLOSED CALLS</center></th></tr>
						<tr class="w3-hover-grey w3-red">
						
<th>SI.NO</th>							
<th>DATE</th>
							
<th>ENG NAME</th>
<th >APPOINT CALL</th>
<th >CALL REG NUMBER</th>
<th >CALL START TIME</th>
<th >CALL END TIME</th>
<th >DESCRIPTION OF CALL</th>
<th >CALL STATUS</th>
<th >SPARE DETAILS</th>
<th >ANY OTR/OTC</th>
<th >REMARKS</th>
<th>CALL CLOSED DATE</th>
<th colspan="2">OPTIONS</th>

				</tr>';
while($row = mysqli_fetch_array($result))
	{
		//echo'?>
			<tr class="w3-hover-grey ">
			
	
	
<td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["date"]; ?></td>
<td align="center"><?php echo $row["eng_name"]; ?></td>
<td align="center"><?php echo $row["app_call"]; ?></td>

<td align="center"><?php echo $row["call_id"]; ?></td>
<td align="center"><?php echo $row["call_start_t"]; ?></td>
<td align="center"><?php echo $row["call_end_t"]; ?></td>
<td align="center"><?php echo $row["call_desc"]; ?></td>
<td align="center"><?php echo $row["call_sts"]; ?></td>
<td align="center"><?php echo $row["spare_det"]; ?></td>
<td align="center"><?php echo $row["otr_det"]; ?></td>
<td align="center"><?php echo $row["remarks"]; ?></td>
<td align="center"><?php echo $row["call_closed_date"]; ?></td>
<td><button onclick="window.location.href ='delete.php?id=<?php echo $row["id"]; ?>';"> DEELTE </button><br></td>
<td><button onclick="window.location.href ='edit_call.php?id=<?php echo $row["id"]; ?>';"> EDIT </button><br></td>

		</tr>
		<?php
		$count++;
		//';
	}
	
}
else
{
	echo '<h1 class="w3-panel w3-green w3-round">NO CALLS ARE CLOSED </h1>';
}


?>

</table></CENTER>


<!---/////////////////////////////////////////////////////////////////////////////////////////////////-->







<?php include 'footer.php';?>
	   
	   </div>
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
