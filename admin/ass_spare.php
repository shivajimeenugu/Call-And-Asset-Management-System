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
      <label>SELECT SPARE</label>
	  <input  class="w3-input w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" list="brow" name="spare_id" placeholder="SEARCH SHARE BY ANY DETAILS" required>
	  <datalist id="brow">
	  ';
      while($row_get_eng = mysqli_fetch_array($res_get_eng))
      {
        echo '<option value="'.$row_get_eng["spare_id"].'">'.$row_get_eng["spare_name"].'-'.$row_get_eng["spare_cat"].'-'.$row_get_eng["spare_spec"].'-'.$row_get_eng["spare_brand"].'</option>'; 
      }    
        
      
      echo '</datalist><br/>
     
	  <label>DO U WANT TO (ASSIGN) CONTINUE?</label>
	 <select name="final_submit_chk" class="w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
	
	  <option value="NO">NO</option>
	   <option value="YES">YES</option>
     </select>
     


	<center> <input class=" w3-button w3-deep-orange w3-center" type="submit" value="ASSIGN SPARE"></input></center>
	 </form>
	  </p>
	  
	  </div>
	  
	  </div>
	  </div>'; 
	  
	  echo'<script>document.getElementById("id01").style.display="block"</script>';

if(isset($_POST['final_submit_chk']))
{
    $spare_id=$_REQUEST['spare_id'];
	$chk_flag=$_REQUEST['final_submit_chk'];
	if($pre_spares=="'0'"){
		$spare_id_final=$spare_id;
	}
	else{
		$spare_id_final=$pre_spares."/".$spare_id;
	}
	

	$msg_temp="sp_id_chk--> ".$spare_id_final.", ";
	$msg_temp="Dear,".$eng_name.",
		YOUR REQUESTED SPARE(S) 
		[(".$spare_req.") FOR (".$bank_name.",".$baranch_name." ".$asset_type." COMPLAINT)]
		 ARE ALLOTED. HEAR IS YOUR SPARE ID(S) (".$spare_id_final.")";
			


	  

	
	



	if($chk_flag=='YES')
	{
$query = "UPDATE call_table SET spare_used='$spare_id_final' WHERE id='$id' "; 
$query_spare = "UPDATE spares SET is_used=1,used_call='$id' WHERE spare_id='$spare_id' "; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));
$result_spare = mysqli_query($con,$query_spare) or die ( mysqli_error($con));






if($result && $result_spare)
{

	echo '<div id="id02" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >SUCESSFULLY ASSIGNED SPARE </p>
	 
	  <p><a class="w3-button w3-red" href="approve_spare_index.php">DONE</a></p>
	  
	  </div>
	  
	  </div>
	  </div>';
echo'<script>document.getElementById("id02").style.display="block"</script>';	  
}
	
	else{
		echo '<div id="id03" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >!ERROR CAN"T ASSIGN SPARE</p>
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