<?php

echo'<head><link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>';
include('db.php');
require('admin_auth.php');
$id=$_REQUEST['id'];
$query_del_row = "select * from eng where id='$id'";


$res = mysqli_query( $con, $query_del_row);
$result_del_row=mysqli_fetch_array($res);




echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p><center>--->UPDATE ENGINEER DATA<---</center></p>

      <p><form action="" method="post">
        
        <div class="w3-row">
        <lable class="w3-half" >ENGINEER FULL NAME</lable> 
        <input type="text" class="w3-half w3-input w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" name="eng_name" value="'.$result_del_row['eng_name'].'" required/>
        </div>
        <br/>

        <div class="w3-row">
        <lable class="w3-half" >EMPLOYEE CODE</lable> 
        <input type="text" class="w3-half w3-input w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" name="emp_code" value="'.$result_del_row['emp_code'].'" required/>
        </div>
        <br/>

        <div class="w3-row">
        <lable class="w3-half" >LOCATION</lable> 
        <input type="text" class="w3-half w3-input w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" name="location" value="'.$result_del_row['location'].'" required/>
        </div>
        <br/>

        <div class="w3-row">
        <lable class="w3-half" >PHONE NUMBER</lable> 
        <input type="tel" class="w3-half w3-input w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" name="phno" value="'.$result_del_row['phno'].'" required/>
        </div>
        <br/>


        <div class="w3-row">
        <lable class="w3-half" >DO U WANT TO SAVE CHANGES?</lable> 
        <select name="final_submit_chk" class="w3-half w3-select w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" required>
        <option value="YES">YES</option>
         <option value="NO">NO</option>
          
        </select>

        </div>
        <br/>


	 <br/>
	 <center><input type="submit" class="w3-button w3-blue w3-card" value="UPDATE ENGINEER DATA" ></input></center>
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
    $eng_name=$_REQUEST['eng_name'];
    $emp_code=$_REQUEST['emp_code'];
    $location=$_REQUEST['location'];
    $phno=$_REQUEST['phno'];

	$chk_flag=$_REQUEST['final_submit_chk'];
	if($chk_flag=='YES')
	{
$query = "UPDATE `eng` SET `eng_name`='$eng_name',`emp_code`='$emp_code',`location`='$location',`phno`='$phno' WHERE id=$id"; 
$result = mysqli_query($con,$query) or die ( mysqli_error($con));

if($result)
{
	echo '<div id="id02" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >SUCESSFULLY UPDATED ENGINEER DATA</p>
	 
	  <p><a class="w3-button w3-red" href="add_engineer.php">DONE</a></p>
	  
	  </div>
	  
	  </div>
	  </div>';
echo'<script>document.getElementById("id02").style.display="block"</script>';	  
}
	
	else{
		echo '<div id="id03" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >!ERROR CAN"T UPDATE</p>
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