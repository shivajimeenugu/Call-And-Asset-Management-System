<?php

echo'<head><link rel="stylesheet" href="w3.css"><meta name="viewport" content="width=device-width, initial-scale=1"></head>';
include('db.php');
require('auth.php');
$id=$_REQUEST['id'];
$query_del_row = "select * from call_mgmt_table where id=$id";


$result_del_row = mysqli_query( $con, $query_del_row);

$count=1;


echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >--->DELETE<---</p>
	  <table class="w3-table-all w3-responsive">
	  <tr>
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
	  </tr>';
	  
while($row_del_row = mysqli_fetch_array($result_del_row))
	{
	  echo'
	  <tr class="w3-hover-grey ">
			
	
	

		<td align="center">'. $count.'</td>
	<td align="center">'.$row_del_row["date"].'</td>
	<td align="center">'.$row_del_row["eng_name"].'</td>
	<td align="center">'.$row_del_row["app_call"].'</td>

		<td align="center">'.$row_del_row["call_id"].'</td>
	<td align="center">'.$row_del_row["call_start_t"].'</td>
	<td align="center">'.$row_del_row["call_end_t"].'</td>
	<td align="center">'.$row_del_row["call_desc"].'</td>
	<td align="center">'.$row_del_row["call_sts"].'</td>
	<td align="center">'.$row_del_row["spare_det"].'</td>
	<td align="center">'.$row_del_row["otr_det"].'</td>
	<td align="center">'.$row_del_row["remarks"].'</td>
	<td align="center">'.$row_del_row["call_closed_date"].'</td>';

}
	  echo'
		</tr>
	  </table>
	
	  
	  <p><form action="" method="post">
	  <label>DO U WANT TO DELETE ABOVE DATA?</label>
	 <select name="final_submit_chk" class="w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge">
	
	  <option value="NO">NO</option>
	   <option value="YES">YES</option>
	 </select>
	 <center><input class="w3-button-blue" type="submit" ></input></center>
	 </form>
	  </p>
	  
	  </div>
	  
	  </div>
	  </div>'; 
	  
	  echo'<script>document.getElementById("id01").style.display="block"</script>';

if(isset($_POST['final_submit_chk']))
{
	$id=$_REQUEST['id'];
	$chk_flag=$_REQUEST['final_submit_chk'];
	if($chk_flag=='YES')
	{
$query = "DELETE FROM call_mgmt_table WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));

if($result)
{
	echo '<div id="id02" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >SUCESSFULLY DELETED</p>
	 
	  <p><a class="w3-button w3-red" href="edit_index_call.php">DONE</a></p>
	  
	  </div>
	  
	  </div>
	  </div>';
echo'<script>document.getElementById("id02").style.display="block"</script>';	  
}
	
	else{
		echo '<div id="id03" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >!ERROR CAN"T DELETE</p>
	   <p><a class="w3-button w3-red" href="edit_index_call.php">DONE</a></p>
	 
	  
	  </div>
	  
	  </div>
	  </div>'; 
	  echo'<script>document.getElementById("id03").style.display="block"</script>';
	}
	}
	else{
		echo '<div id="id04" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >CANCLED......</p>
	  <p><a class="w3-button w3-red" href="edit_index_call.php">GO BACK</a></p>
	 
	  
	  </div>
	  
	  </div>
	  </div>
	  
	   ';
	  echo'<script>document.getElementById("id04").style.display="block"</script>';
	}
} 
?>