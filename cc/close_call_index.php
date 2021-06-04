
<?php include 'cc_auth.php';
include 'db.php'; 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="w3js.js"></script>
<title>Welcome Home</title>

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
<br/>
<input  type="text"  class="w3-input  w3-border" oninput="w3.filterHTML('#id01', '.item', this.value)"  placeholder="Search for .." title="Type in a name">
<br/>
<select onchange="w3.filterHTML('#id01', '.item', this.value)" class="w3-select w3-border">
<?php 
	$count=1;
	$query = "select * from call_table where status='PENDING' and is_ass=1 and is_eng_closed=1 and is_rejected=0";


$result = mysqli_query( $con, $query);
if(mysqli_num_rows($result) > 0)
{
$get_prj_name_q="SELECT DISTINCT bank_name FROM bank;";
$result_get_prj_name_q = mysqli_query( $con, $get_prj_name_q);
echo '';
while($row_prj = mysqli_fetch_array($result_get_prj_name_q))
	{
  ?>

<option value="<?php echo $row_prj['bank_name']; ?>"><?php echo $row_prj['bank_name']; ?></option>
    <?php } ?>
    <?php
	echo '</select><br/><br/>
	
	
	<CENTER>
	<table id="id01" class="w3-table-all  w3-responsive  ">
						<tr><th colspan="11"><center>CALLS</center></th></tr>
						<tr class="w3-hover-grey w3-red">
						
<th>SI.NO</th>							
<th>ID</th>						
<th>PROJECT</th>
<th >BRANCH NAME</th>
<th >PROBLEM REPORTED</th>
<th >LOG DATE</th>
<th >ASSET TYPE</th>
<th >REMARKS</th>
<th >ASSIGND TO</th>
<th>CALL REPORT</th>
<th>APPROVE CALL</th>
<th>REJECT CALL</th>

				</tr>';
while($row = mysqli_fetch_array($result))
	{
		//echo'?>
			<tr class="item w3-hover-grey ">
			
	
	
<td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["id"]; ?></td>
<td align="center"><?php echo $row["prj_name"]; ?></td>
<td align="center"><?php echo $row["branch_name"]; ?></td>
<td align="center"><?php echo $row["call_desc"]; ?></td>
<td align="center"><?php echo $row["log_date"]; ?></td>
<td align="center"><?php echo $row["asset_type"]; ?></td>
<td align="center"><?php echo $row["remarks"]; ?></td>
<td align="center"><?php 
$emp_id_loop=$row["eng_ass"];
$get_eng_name_q="select * from eng where emp_code='$emp_id_loop'";
$get_eng_name_res=mysqli_query( $con, $get_eng_name_q);
$row_get_eng_name = mysqli_fetch_array($get_eng_name_res);
echo $row_get_eng_name['eng_name'];

?></td>
<td align="center"><button onclick="window.open('../eng/reports_img_db/<?php echo $row['id']; ?>.jpg','popUpWindow','height=500,width=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');"><img src='../eng/reports_img_db/<?php echo $row['id']; ?>.jpg' alt='NO IMAGE' height='100px' width='100px'></img></button></td>

<td><button class="w3-button w3-green" onclick="window.location.href ='close_call.php?id=<?php echo $row["id"]; ?>';"> APPROVE </button><br></td>
<td><button class="w3-button w3-red" onclick="window.location.href ='reject_call.php?id=<?php echo $row["id"]; ?>';"> REJECT </button><br></td>
		</tr>
		<?php
		$count++;
		//';
	}
	
}
else
{
	echo '<h1 class="w3-panel w3-green w3-round">NO CALL DATA FOUND</h1>';
}


?>

</table></CENTER>





















<br /><br /><br /><br />



<?php include 'footer.php';?>

</div>
 </body>
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

<script>
function filtervar()
{
    w3.filterHTML('#id01', '.item', this.value)
}
</script>


</html>
