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
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >--->ASSIGN ENGINEER<---</p>
	  <table class="w3-table-all w3-responsive">
	  <tr>
							
      <th>ID</th>						
      <th>PROJECT</th>
      <th >BRANCH NAME</th>
      <th >PROBLEM REPORTED</th>
      <th >LOG DATE</th>
      <th >ASSET TYPE</th>
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
<td align="center">'.$row_del_row["remarks"].'</td>';


}
$q_get_eng="select * from eng";
$res_get_eng=mysqli_query( $con, $q_get_eng);


	  echo'
		</tr>
	  </table>
	
	  
      <p><form action="" method="post">
      <br/>
      <label>SELECT ENGINEER</label>
      <select name="eng_id" class="w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>';
      while($row_get_eng = mysqli_fetch_array($res_get_eng))
      {
        echo '<option value="'.$row_get_eng["emp_code"].'">'.$row_get_eng["eng_name"].'</option>'; 
      }    
        
      
      echo '</select><br/>
      <label>CALL SCHEDULED TO</label>
      <input type="date" name="shed_to" class="w3-input w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>

<br/>
	  <label>DO U WANT TO (ASSIGN) CONTINUE?</label>
	 <select name="final_submit_chk" class="w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
	
	  <option value="NO">NO</option>
	   <option value="YES">YES</option>
     </select>
     


	 <input type="submit" ></input>
	 </form>
	  </p>
	  
	  </div>
	  
	  </div>
	  </div>'; 
	  
	  echo'<script>document.getElementById("id01").style.display="block"</script>';

if(isset($_POST['final_submit_chk']))
{
    $call_shed_to=$_REQUEST['shed_to'];
	$chk_flag=$_REQUEST['final_submit_chk'];
	$eng_emp_id=$_REQUEST['eng_id'];
	
	$get_eng_phno="select * from eng where emp_code='$eng_emp_id'";
	$res_eng_phno=mysqli_query( $con, $get_eng_phno);
	$row_get_eng_phno = mysqli_fetch_array($res_eng_phno);
	$eng_phno=$row_get_eng_phno['phno'];
	$eng_name=$row_get_eng_phno['eng_name'];

	$res_get_call_data=mysqli_query( $con, $query_del_row);
	$row_get_call_data = mysqli_fetch_array($res_get_call_data);


	$bank_name=$row_get_call_data['prj_name'];
	$branch_name=$row_get_call_data['branch_name'];
	$asset_type=$row_get_call_data['asset_type'];
	$call_desc=$row_get_call_data['call_desc'];

	$msg_temp="dear ".$eng_name.",
	You have a call in ".$bank_name.",".$branch_name.".their is a problem with ".$asset_type." they report problem as -->".$call_desc."";
	


	  

	
	



	if($chk_flag=='YES')
	{
$query = "UPDATE call_table SET call_shed_date='$call_shed_to',eng_ass='$eng_emp_id',eng_ass_name='$eng_name',is_ass=1 WHERE id='$id' "; 
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
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >SUCESSFULLY ASSIGNED TO '.$eng_name.'-->'.$eng_emp_id.'</p>
	 
	  <p><a class="w3-button w3-red" href="ass_call_index.php">DONE</a></p>
	  
	  </div>
	  
	  </div>
	  </div>';
echo'<script>document.getElementById("id02").style.display="block"</script>';	  
}
	
	else{
		echo '<div id="id03" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >!ERROR CAN"T ASSIGN</p>
	   <p><a class="w3-button w3-red" href="ass_call_index.php">DONE</a></p>
	 
	  
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
	  <p><a class="w3-button w3-red" href="ass_call_index.php">GO BACK</a></p>
	 
	  
	  </div>
	  
	  </div>
	  </div>
	  
	   ';
	  echo'<script>document.getElementById("id04").style.display="block"</script>';
	}
} 
?>