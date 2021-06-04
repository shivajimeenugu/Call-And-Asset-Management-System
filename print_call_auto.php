<?php include("auth.php"); ?>
<!DOCTYPE html>
<html>
<head>
<style>
@page {
  /*margin: 2mm*/
}

@media screen {
  div.divFooterms {
    display: none;
  }
}
@media print {
  div.divFooterms {
    position: fixed;
    bottom: 0;
  }
}
</style>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo 'DATA-CALLS-'.date("Ymd") ; ?></title>

</head>
<body  >
     <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
                             <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
                                       <a class="w3-bar-item w3-button" href="index.php">HOME</a>

                                       <a class="w3-bar-item w3-button" href="dashboard.php">DASHBOARD</a>
		
		

                                       

                                       <a class="w3-bar-item w3-button" href="logout.php">LOGOUT</a>
                             
            </div> 


<div class="w3-container w3-animate-right" id="main">
<?php //include 'header.php';?>
<div class="w3-container w3-border-theme-d4  " ">

   <button id="openNav" class="w3-button  w3-xlarge" onclick="w3_open()"></button>

        <center><img src="logo.png"  class="logo" alt="LOGO GOSE HEAR" ></img></center>
        <!--<center><h2 >RAPIDTECH IT SERVICES PVT LTD. </h2></center>
        <center><h3>ASSET MANAGEMENT SYSTEM</h3></center>-->
      <div  class="w3-panel w3-xlarge w3-theme "></div>

</div>

<br/>
     



<?php
include 'db.php';

$query='';
$count=1;
$from_date=$_REQUEST['from_date'];
$to_date=$_REQUEST['to_date'];
$output = '';
//SELECT * FROM call_mgmt_table WHERE date BETWEEN #'$from_date'# AND #'$to_date'#
$query = "SELECT * FROM call_mgmt_table WHERE date BETWEEN '$from_date' AND '$to_date' AND call_sts='PENDING'";
$result = mysqli_query( $con, $query);
$row_count=mysqli_num_rows($result);
echo '
	


<br/>
	<table style="border-collapse: collapse; border: 1px solid black;" class="w3-table-all">
						<thead>
					<tr class="w3-indigo">
	<th>CALL STATUS</th>						
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
				</tr>
				
				</thead>
				<tbody>
				
				
				
				
				';
if(mysqli_num_rows($result) > 0)
	{
	
	echo '
	


<br/>
	<table style="border-collapse: collapse; border: 1px solid black;" class="w3-table-all">
						<thead>
					<tr class="w3-indigo">
	<th>CALL STATUS</th>						
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
				</tr>
				
				</thead>
				<tbody>
				
				
				
				
				';
$row_span_flag=1;		
		
while($row = mysqli_fetch_array($result))
	{
		echo'
			<tr class="w3-hover-grey ">';
			if($row_span_flag==1)
			{
				echo '<td rowspan="'.$row_count.'" style="border: 1px solid black;" class="w3-red"><center>PENDING</center></td>';
				$row_span_flag++;
			}
			
			?>
			
	
	
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
		</tr>
		<?php
		$count++;
		
	}
	
}
else
{
	
	echo '<h1 class="w3-red">NO PENDING CALLS </h1>';
	
}


?>





<!--//////////////////////////////////////////////////////////////////////////-->
<?php

$query4 = "SELECT * FROM call_mgmt_table WHERE date BETWEEN '$from_date' AND '$to_date' AND call_sts='CLOSED'";

$count4=1;
$result4= mysqli_query( $con, $query4);
$row_count=mysqli_num_rows($result4);
if(mysqli_num_rows($result4) > 0)
{
	echo '<br/>
	
	
	
	
						
				';
$row_span_flag=1;				
while($row2 = mysqli_fetch_array($result4))
	{
		echo'
			<tr class="w3-hover-grey ">';
			if($row_span_flag==1)
			{
				echo '<td rowspan="'.$row_count.'"  style="border: 1px solid black;" class="w3-blue"><center>CLOSED</center></td>';
				$row_span_flag++;
			}
			
			?>
	
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
		</tr>
		<?php
		$count4++;
		//';
	}
	
}
else
{
	echo '<h1 class="w3-red">NO CLOSED CALLS </h1>';
}


?>




</tbody>
</table>
<br/><br/>
<br/><br/>
<br/>



<!--<script>window.print();</script>-->
<center><button class="w3-button w3-red" onclick="window.print()">PRINT</button></center>




<?php //include 'footer.php';?>
	   
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
