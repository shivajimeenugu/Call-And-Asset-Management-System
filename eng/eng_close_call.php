<?php

echo'<head>






<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="hayageek.js"></script>

</head>';
include('db.php');
require('eng_auth.php');
$id=$_REQUEST['id'];
$query_del_row = "select * from call_table where id='$id'";


$result_del_row = mysqli_query( $con, $query_del_row);



$retun_to_mycalls_url="window.location.href='eng_my_calls.php'";
echo '








<div id="id01" class="w3-modal  w3-animate-zoom">
	<div class="w3-modal-content w3-padding-16 w3-card">
	<div class="w3-center">
      <span onclick="'.$retun_to_mycalls_url.'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      
    </div>
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
	
	  
      <p><form action="" method="post" enctype="multipart/form-data">
	  

	  <div class="w3-row">
       <label class=" w3-half w3-lable">ACTION TAKEN</label>
       <textarea  class=" w3-half w3-input w3-border w3-card w3-pale-red" name="action_taken" width="500px" height="300px" required></textarea>
	 </div>  
	   <br/>

	   
	  <div class="w3-row">
	  <label class=" w3-half w3-lable">ANY REMARKS</label>
	  <textarea  class=" w3-half w3-input w3-border w3-card w3-pale-red" name="close_remarks" width="500px" height="300px" ></textarea>
	</div>  
	  <br/>
	  
	  <div class="w3-row">
	  <label class=" w3-half w3-lable" >CALL CLOSED BY?</label>
	 <select id="call_sol_type" onchange="report_upload_togle()" name="call_sol_type" class="w3-half w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
	 <option value=""></option> 
	 <option value="BY PHONE">BY PHONE</option>
	  <option value="ON SITE">ON SITE</option>
     </select>
     </div>
	 <br/>

	  <div class="w3-row">
	  <label class=" w3-half w3-lable" >DO U WANT TO (CLOSE) CONTINUE?</label>
	 <select name="final_submit_chk" class="w3-half w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
	  <option value="NO">NO</option>
	   <option value="YES">YES</option>
     </select>
     </div>
	 <br/>

	 <div class="w3-row">
	<label class="w3-half" >UPLOAD CALL REPORT</label> 
	<div  class="w3-half" id="fileuploader" required /> 
	</div>
	<br/>


	 <center><p><input id="close_call_btn" type="submit"  class="w3-button w3-blue w3-card" value="CLOSE CALL" disabled></input></p></center>
	 <center><p><a class="w3-button w3-red" href="eng_my_calls.php">CANCLE</a></p></center>
	 </form>
	  </p>
	  <br/>
	 <br/><br/><br/>
	  </div>
	  
	  </div>
	  </div>'; 
	  
	  echo'<script>document.getElementById("id01").style.display="block"</script>';

if(isset($_POST['final_submit_chk']))
{
	
	date_default_timezone_set('Asia/Kolkata'); 
	$eng_name=$_SESSION['eng_name'];
	$close_remarks=$_REQUEST['close_remarks'];
	$action_taken=$_REQUEST['action_taken'];
	$call_sol_type=$_REQUEST['call_sol_type'];
	
	$query_del_row = "select * from call_table where id='$id'";
	$result_del_row = mysqli_query( $con, $query_del_row);
	$row_del_row = mysqli_fetch_array($result_del_row);
	$close_date=date('Y-m-d');
	$close_time=date("H:i:s");
	//$status='CLOSED';
	$chk_flag=$_REQUEST['final_submit_chk'];
	if($chk_flag=='YES')
	{
$query = "UPDATE call_table SET eng_close_remarks='$close_remarks',is_eng_closed=1,eng_close_date='$close_date',eng_close_time='$close_time',action_taken='$action_taken',call_slo_type='$call_sol_type',is_rejected=0 WHERE id='$id' "; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));

if($call_sol_type=="ON SITE"){
$msg_temp="".$eng_name.",
JUST CLOSED A CALL(".$row_del_row['prj_name'].",".$row_del_row['branch_name']." )".$call_sol_type."
HEAR IS REPORT( http://rapidcc.rf.gd/call_mgmt/eng/reports_img_db/".$row_del_row['id'].".jpg )
";
}
else{
	$msg_temp="".$eng_name.",
	JUST CLOSED A CALL(".$row_del_row['prj_name'].",".$row_del_row['branch_name']." )".$call_sol_type."
	
	";
}

$url="https://api.telegram.org/bot1123935748:AAF-LAaY7uTdsN1tS6WNoX8q6M45p7XwBT4/sendMessage?chat_id=-398461547&text=".urlencode($msg_temp);
	
if($result)
{


	echo '<div id="id02" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >SUCESSFULLY CLOSED </p>
	 
	  <p><a class="w3-button w3-red" href="eng_my_calls.php">DONE</a></p>
	  
	  </div>
	  
	  </div>
	  </div>';
echo'<script>document.getElementById("id02").style.display="block"</script>';	  
echo '
<script>
var myWindow = window.open("'.$url.'", "MsgWindow", "width=200,height=100");

</script>
';
}
	
	else{
		echo '<div id="id03" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >!ERROR CAN"T CLOSE</p>
	   <p><a class="w3-button w3-red" href="eng_my_calls.php">DONE</a></p>
	 
	  
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
	  <p><a class="w3-button w3-red" href="eng_my_calls.php">GO BACK</a></p>
	 
	  
	  </div>
	  
	  </div>
	  </div>
	  
	   ';
	  echo'
	  
	 
	 
	  <script>document.getElementById("id04").style.display="block"</script>';
	}
	
} 
echo '<script>
function report_upload_togle(){
	var flag = document.getElementById("call_sol_type").value;
	if(flag=="BY PHONE"){
	var x = document.getElementById("fileuploader");
	x.style.display = "none";
	document.getElementById("close_call_btn").disabled = false;
	}
	else{
		var x = document.getElementById("fileuploader");
	x.style.display = "block";
	document.getElementById("close_call_btn").disabled = true;

	}
}



	$(document).ready(function()
	{
	var uploadObj=$("#fileuploader").uploadFile({
		url:"file_upload.php",
		fileName:"myfile",
		maxFileCount:1,
		multiple:false,
		
		acceptFiles:"image/*",
		showDone:false,
		formData: {"filename_id":"'.$id.'"},
		afterUploadAll:function(obj)
		{
			alert("CALL REPORT UPLOADED..");
			document.getElementById("close_call_btn").disabled = false;
		}
		});
		
		
		
		
	});
	
	
		
	</script> ';
?>