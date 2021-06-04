<?php

echo'<head><link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>';
include('db.php');
require('admin_auth.php');
$id=$_REQUEST['id'];
$query_del_row = "select * from cc_users where id='$id'";


$result_del_row = mysqli_query( $con, $query_del_row);




echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p><center>--->REMOVE CC USER<---</center></p>
	  <table class="w3-table-all w3-responsive">
	  <tr>
													
	  <th>USERNAME</th>
	  <th >E-MAIL</th>
	 
     
	  </tr>';
 while($row_del_row = mysqli_fetch_array($result_del_row))
	{
	  echo'
	  <tr class="w3-hover-grey ">

<td align="center">'.$row_del_row["username"].' </td>
<td align="center">'.$row_del_row["email"].'</td>'
;


}
	  echo'
		</tr>
	  </table>
	
	  
      <p><form action="" method="post">
      <br/>
       
	  <label>DO U WANT TO (REMOVE ABOVE CC USER) CONTINUE?</label>
	 <select name="final_submit_chk" class="w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
	
	  <option value="NO">NO</option>
	   <option value="YES">YES</option>
     </select>
     

	 <br/>
	 <center><input type="submit" class="w3-button w3-blue w3-card" value="REMOVE ABOVE CC USER" ></input></center>
	 <br/>
	 <center><a  href="add_cc_users.php" class="w3-button w3-blue"  >CANCLE</a></center>
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
	
	$chk_flag=$_REQUEST['final_submit_chk'];
	if($chk_flag=='YES')
	{
$query = "DELETE FROM `cc_users` WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));

if($result)
{
	echo '<div id="id02" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >SUCESSFULLY REMOVED CC USER </p>
	 
	  <p><a class="w3-button w3-red" href="add_cc_users.php">DONE</a></p>
	  
	  </div>
	  
	  </div>
	  </div>';
echo'<script>document.getElementById("id02").style.display="block"</script>';	  
}
	
	else{
		echo '<div id="id03" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >!ERROR CAN"T REMOVE CC USER</p>
	   <p><a class="w3-button w3-red" href="add_cc_users.php">DONE</a></p>
	 
	  
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
	  <p><a class="w3-button w3-red" href="add_cc_users.php">GO BACK</a></p>
	 
	  
	  </div>
	  
	  </div>
	  </div>
	  
	   ';
	  echo'<script>document.getElementById("id04").style.display="block"</script>';
	}
} 
?>