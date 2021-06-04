<?php

echo'<head><link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>';
include('db.php');
require('admin_auth.php');
$id=$_REQUEST['id'];
$query_del_row = "select * from call_table where id='$id'";


$result_del_row = mysqli_query( $con, $query_del_row);




echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >--->ASSIGN SPARE<---</p>
	  <table class="w3-table-all w3-responsive">
	  <tr>
							
	  <th>ID</th>	
	  <th>SPARE REQUESTED</th>
	  <th>SPARE ASSIGNED</th>				
      <th>PROJECT</th>
      <th >BRANCH NAME</th>
      <th >PROBLEM REPORTED</th>
      <th >LOG DATE</th>
      <th >ASSET TYPE</th>
      <th >REMARKS</th>
     
	  </tr>';
 while($row_del_row = mysqli_fetch_array($result_del_row))
	{
		$eng_name=$row_del_row["eng_ass_name"];
		$pre_spares=$row_del_row["spare_used"];
		$bank_name=$row_del_row["prj_name"];
		$baranch_name=$row_del_row["branch_name"];
		$asset_type=$row_del_row["asset_type"];
		$spare_req=$row_del_row["spare_req"];
	  echo'
	  <tr class="w3-hover-grey ">

<td align="center">'.$row_del_row["id"].' </td>
<td align="center" class="w3-pale-green">'.$row_del_row["spare_req"].'</td>
<td align="center" class="w3-pale-green">'.$row_del_row["spare_used"].'</td>
<td align="center">'.$row_del_row["prj_name"].'</td>
<td align="center">'.$row_del_row["branch_name"].'</td>
<td align="center">'.$row_del_row["call_desc"].'</td>
<td align="center">'.$row_del_row["log_date"].'</td>
<td align="center">'.$row_del_row["asset_type"].'</td>
<td align="center">'.$row_del_row["remarks"].'</td>';


}
$q_get_eng="select * from spares where is_used=0";
$res_get_eng=mysqli_query( $con, $q_get_eng);
	  echo'
		</tr>
	  </table>
	
	  
      <p><form action="" method="post">
      <br/>
          
	  <label>DO U WANT TO (SUBMIT) CONTINUE?</label>
	 <select name="final_submit_chk" class="w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
	
	  <option value="NO">NO</option>
	   <option value="YES">YES</option>
     </select>
     


	<center> <input class=" w3-button w3-deep-orange w3-center" type="submit" value="SUBMIT"></input></center>
	 </form>
	  </p>
	  
	  </div>
	  
	  </div>
	  </div>'; 
	  
	  echo'<script>document.getElementById("id01").style.display="block"</script>';

if(isset($_POST['final_submit_chk']))
{
    
	$chk_flag=$_REQUEST['final_submit_chk'];

	$msg_temp="Dear,".$eng_name.",
		YOUR REQUESTED SPARE(S) 
		[(".$spare_req.") FOR (".$bank_name.",".$baranch_name." ".$asset_type." COMPLAINT)]
		 ARE ALLOTED. HEAR IS YOUR SPARE ID(S) (".$pre_spares.")";
			


	  

	
	



	if($chk_flag=='YES')
	{
$query = "UPDATE call_table SET is_spare_call=2 WHERE id='$id' "; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));

$url="https://api.telegram.org/bot1123935748:AAF-LAaY7uTdsN1tS6WNoX8q6M45p7XwBT4/sendMessage?chat_id=-398461547&text=".urlencode($msg_temp);
	
echo '
<script>
var myWindow = window.open("'.$url.'", "MsgWindow", "width=200,height=100");

</script>
';




if($result)
{

	echo '<div id="id02" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >SUCESSFULLY SUBMITTED</p>
	 
	  <p><a class="w3-button w3-red" href="approve_spare_index.php">DONE</a></p>
	  
	  </div>
	  
	  </div>
	  </div>';
echo'<script>document.getElementById("id02").style.display="block"</script>';	  
}
	
	else{
		echo '<div id="id03" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >!ERROR CAN"T SUBMITE</p>
	   <p><a class="w3-button w3-red" href="approve_spare_index.php">DONE</a></p>
	 
	  
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
	  <p><a class="w3-button w3-red" href="approve_spare_index.php">GO BACK</a></p>
	 
	  
	  </div>
	  
	  </div>
	  </div>
	  
	   ';
	  echo'<script>document.getElementById("id04").style.display="block"</script>';
	}
} 
?>