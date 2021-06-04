<?php

echo'<head><link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>';
include('db.php');
require('cc_auth.php');
$id=$_REQUEST['id'];
$query_del_row = "select * from call_table where id='$id'";


$result_del_row = mysqli_query( $con, $query_del_row);




echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p><center>--->CLOSE CALL<---</center></p>
	  <table class="w3-table-all w3-responsive">
	  <tr>
							
      <th>ID</th>						
      <th>PROJECT</th>
      <th >BRANCH NAME</th>
      <th >PROBLEM REPORTED</th>
      <th >LOG DATE</th>
	  <th >ASSET TYPE</th>
	  <th >ASSIGND TO</th>
      <th >REMARKS</th>
     
	  </tr>';
 while($row_del_row = mysqli_fetch_array($result_del_row))
	{
	  echo'
	  <tr class="w3-hover-grey ">

<td align="center">'.$row_del_row["id"].' </td>
<td align="center">'.$row_del_row["prj_name"].'</td>
<td align="center">'.$row_del_row["branch_name"].'</td>
<td align="center">'.$row_del_row["call_desc"].'</td>
<td align="center">'.$row_del_row["log_date"].'</td>
<td align="center">'.$row_del_row["asset_type"].'</td>
<td align="center">';
$emp_id_loop=$row_del_row["eng_ass"];
$get_eng_name_q="select * from eng where emp_code='$emp_id_loop'";
$get_eng_name_res=mysqli_query( $con, $get_eng_name_q);
$row_get_eng_name = mysqli_fetch_array($get_eng_name_res);
echo $row_get_eng_name['eng_name'];

echo '</td>
<td align="center">'.$row_del_row["remarks"].'</td>';


}
$q_get_eng="select * from eng";
$res_get_eng=mysqli_query( $con, $q_get_eng);


	  echo'
		</tr>
	  </table>
	
	  
      <p><form action="" method="post">
      <br/>
       <label class="w3-lable">ENTER HYD ID</label>
      <input type="text" name="hyd_id" class="w3-input w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>

<br/>

<label>ENTER REMARKS</label><br/>
<textarea  class=" w3-input w3-border w3-card w3-pale-red" name="close_remarks" width="500px" height="300px" ></textarea>
     <br/>
        
     
	  <label>DO U WANT TO (CLOSE) CONTINUE?</label>
	 <select name="final_submit_chk" class="w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
	
	  <option value="NO">NO</option>
	   <option value="YES">YES</option>
     </select>
     

	 <br/>
	 <center><input type="submit" class="w3-button w3-blue w3-card" value="CLOSE CALL" ></input></center>
	 <center><p><a class="w3-button w3-amber" href="close_call_index.php">CANCLE</a></p></center>
	 <br/>
	 <br/><br/><br/>
	 </form>
	  </p>
	  
	  </div>
	  
	  </div>
	  </div>'; 
	  
	  echo'<script>document.getElementById("id01").style.display="block"</script>';

if(isset($_POST['final_submit_chk']))
{
	
	date_default_timezone_set('Asia/Kolkata'); 
	$hyd_id=strtoupper($_REQUEST['hyd_id']);
	$close_remarks=$_REQUEST['close_remarks'];
	/*$spares_used_raw=strtoupper($_REQUEST['spares_used']);
	$spares_used=json_encode( explode ("/", $spares_used_raw)); */

	$close_date=date('Y-m-d');
	$close_time=date("H:i:s");
	$status='CLOSED';
	$chk_flag=$_REQUEST['final_submit_chk'];
	if($chk_flag=='YES')
	{
		
$query = "UPDATE call_table SET hyd_id='$hyd_id',close_remarks='$close_remarks',status='$status',close_date='$close_date',close_time='$close_time' WHERE id='$id' "; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));

if($result)
{
	$q_get_call_eng="SELECT * FROM call_table where id='$id'";
	$q_get_call_eng_res=mysqli_query($con,$q_get_call_eng);
	$row_get_eng_call=mysqli_fetch_array($q_get_call_eng_res);
	$eng_name_msg=$row_get_eng_call['eng_ass_name'];
	$bank_name=$row_get_eng_call['prj_name'];
	$branch_name=$row_get_eng_call['branch_name'];
	$hyd_id_fetched=$hyd_id;

	$msg_temp="dear ".$eng_name_msg.",
	Your call in ".$bank_name.",".$branch_name.".approved by call center 
	    (HYD CALL ID)
	     ".$hyd_id." 
	    ---------------- 
	    (REMARKS)
	   ".$close_remarks."";
	

	$url="https://api.telegram.org/bot1123935748:AAF-LAaY7uTdsN1tS6WNoX8q6M45p7XwBT4/sendMessage?chat_id=-398461547&text=".urlencode($msg_temp);
	
echo '
<script>
var myWindow = window.open("'.$url.'", "MsgWindow", "width=200,height=100");

</script>
';
	echo '<div id="id02" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >SUCESSFULLY CLOSED </p>
	 
	  <p><a class="w3-button w3-red" href="close_call_index.php">DONE</a></p>
	  
	  </div>
	  
	  </div>
	  </div>';
echo'<script>document.getElementById("id02").style.display="block"</script>';	  
}
	
	else{
		echo '<div id="id03" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >!ERROR CAN"T CLOSE</p>
	   <p><a class="w3-button w3-red" href="close_call_index.php">DONE</a></p>
	 
	  
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
	  <p><a class="w3-button w3-red" href="close_call_index.php">GO BACK</a></p>
	 
	  
	  </div>
	  
	  </div>
	  </div>
	  
	   ';
	  echo'<script>document.getElementById("id04").style.display="block"</script>';
	}
} 
?>