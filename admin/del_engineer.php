<?php

echo'<head><link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>';
include('db.php');
require('admin_auth.php');
$id=$_REQUEST['id'];
$query_del_row = "select * from eng where id='$id'";


$result_del_row = mysqli_query( $con, $query_del_row);




echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p><center>--->REMOVE ENGINEER<---</center></p>
	  <table class="w3-table-all w3-responsive">
	  <tr>
													
	  <th>ENGINEER NAME</th>
	  <th >EMP CODE</th>
	  <th>LOCATION</th>
	  <th >PHONE NO.</th>
     
	  </tr>';
 while($row_del_row = mysqli_fetch_array($result_del_row))
	{
	  echo'
	  <tr class="w3-hover-grey ">

<td align="center">'.$row_del_row["eng_name"].' </td>
<td align="center">'.$row_del_row["emp_code"].'</td>
<td align="center">'.$row_del_row["location"].'</td>
<td align="center">'.$row_del_row["phno"].'</td>';


}
	  echo'
		</tr>
	  </table>
	
	  
      <p><form action="" method="post">
      <br/>
       
	  <label>DO U WANT TO (REMOVE ABOVE ENGINEER) CONTINUE?</label>
	 <select name="final_submit_chk" class="w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
	
	  <option value="NO">NO</option>
	   <option value="YES">YES</option>
     </select>
     

	 <br/>
	 <center><input type="submit" class="w3-button w3-blue w3-card" value="REMOVE ABOVE ENGINEER" ></input></center>
	 <br/>
	 <center><a  href="add_engineer.php" class="w3-button w3-blue"  >CANCLE</a></center>
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
$query = "DELETE FROM `eng` WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));

if($result)
{
	echo '<div id="id02" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >SUCESSFULLY REMOVED ENGINEER </p>
	 
	  <p><a class="w3-button w3-red" href="add_engineer.php">DONE</a></p>
	  
	  </div>
	  
	  </div>
	  </div>';
echo'<script>document.getElementById("id02").style.display="block"</script>';	  
}
	
	else{
		echo '<div id="id03" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >!ERROR CAN"T REMOVE</p>
	   <p><a class="w3-button w3-red" href="add_engineer.php">DONE</a></p>
	 
	  
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
	  <p><a class="w3-button w3-red" href="add_engineer.php">GO BACK</a></p>
	 
	  
	  </div>
	  
	  </div>
	  </div>
	  
	   ';
	  echo'<script>document.getElementById("id04").style.display="block"</script>';
	}
} 
?>