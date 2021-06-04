<?php 
include("auth.php");
include 'db.php';
$id=$_REQUEST['id'];
$query_old = "SELECT * FROM call_mgmt_table WHERE id='$id'";
$result_old = mysqli_query($con,$query_old) or die(mysqli_error($con));
$row_old= mysqli_fetch_assoc($result_old);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>EDIT CALL FORM</title>

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

<?php



if(isset($_POST['new']) && $_POST['new']==1&& $_POST['eng_name'])
{
date_default_timezone_set('Asia/Kolkata'); 

$date=$_REQUEST['date'];
$call_closed_date=$_REQUEST['call_closed_date'];

$eng_name=strtoupper($_REQUEST['eng_name']);
$app_call=strtoupper($_REQUEST['app_call']);
$call_id=strtoupper($_REQUEST['call_id']);
$call_start_t=$_REQUEST['call_start_t'];
$call_end_t=$_REQUEST['call_end_t'];
$call_desc=strtoupper($_REQUEST['call_desc']);
$call_sts=strtoupper($_REQUEST['call_sts']);
$spare_det=strtoupper($_REQUEST['spare_det']);
$otr_det=strtoupper($_REQUEST['otr_det']);
$remarks=strtoupper($_REQUEST['remarks']);



$q="UPDATE call_mgmt_table SET eng_name='".$eng_name."', app_call='".$app_call."', call_id='".$call_id."', call_start_t='".$call_start_t."', call_end_t='".$call_end_t."', call_desc='".$call_desc."', call_sts='".$call_sts."', spare_det='".$spare_det."', otr_det='".$otr_det."',remarks='".$remarks."',date='".$date."',call_closed_date='".$call_closed_date."' WHERE id='".$id."'";
//update asset_table set asset_type='".$asset_type."',
$st=mysqli_query($con,$q) or die(mysqli_error($con));
//header('Location: suss_newinsert.php');


if($st)
{
 

 
echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >CALL MODIFIED SUCESS</p><p><center> <a class="w3-button w3-yellow" href="edit_index_call.php">DONE</a></center></p></div></div></div>'; 
	  echo'<script>document.getElementById("id01").style.display="block"</script>';
}
else{
	echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >ERROR! CAN NOT MODIFY CALL<p></div></div></div>'; 
	  echo'<script>document.getElementById("id01").style.display="block"</script>';
}	
	
	

}



?>









<br/>


<form action="" class=" w3-card-4   w3-padding" method="post"  align="center">
<center><p class="w3-blue">CALL MODIFY FORM</p></center>

<input type="hidden" name="new" value="1" />

<div class="w3-row">
<lable class="w3-label w3-half">SELECT ENG NAME</lable> 
<select class=" w3-select w3-border w3-half" id="asset_type"   name="eng_name" required>
<option value="<?php echo $row_old['eng_name'];?>"><?php echo $row_old['eng_name'];?></option>
<?php
$query_bank='select * from eng_name order by eng_name';
$result = mysqli_query($con,$query_bank) or die(mysql_error($con));

while($row = mysqli_fetch_array($result))
	{ 
?>

<option value="<?php echo $row['eng_name'];?>"><?php echo $row['eng_name'];?></option>
	<?php } ?>
 
</select>
</div>
<script>
function configchk(){
var iscpu=document.getElementById("asset_type").value;

if(iscpu!='CPU'&&iscpu!='SERVER')
{

	
	document.getElementById("hdd").disabled = true;
	document.getElementById("pro").disabled = true;
	document.getElementById("ram").disabled = true;
	document.getElementById("os").disabled = true;
	document.getElementById("ip").disabled = true;
	
	var color='black';
	
	
	document.getElementById("hdd").style.background = color;
	document.getElementById("pro").style.background = color;
	document.getElementById("ram").style.background = color;
	document.getElementById("os").style.background = color;
	document.getElementById("ip").style.background = color;
	
}
else{

	document.getElementById("hdd").disabled = false;
	document.getElementById("pro").disabled = false;
	document.getElementById("ram").disabled = false;
	document.getElementById("os").disabled = false;
	document.getElementById("ip").disabled = false;
	
	var color='';
	

	document.getElementById("hdd").style.background = color;
	document.getElementById("pro").style.background = color;
	document.getElementById("ram").style.background = color;
	document.getElementById("os").style.background = color;
	document.getElementById("ip").style.background = color;
}
}

</script>			
<br/>


<div class="w3-row">
<lable class="  w3-half">APPOINT CALL</lable> 
<input class=" w3-input w3-border w3-half" type="text" value=<?php echo $row_old['app_call']; ?> name="app_call"  placeholder="ENTER APPOINT CALL" required  /> 
</div>
<br/>


<div class="w3-row">
<lable class="w3-half">CALL REG NUMBER: </lable> 
<input class=" w3-input w3-border w3-half" value=<?php echo $row_old['call_id']; ?> type="text" name="call_id"  placeholder="ENTER REG NUMBER"   /> 
</div>
<br/>
<div class="w3-row">
<lable class="w3-half">CALL START TIME: </lable> 
<input class=" w3-time w3-border w3-half" value=<?php echo $row_old['call_start_t']; ?>  type="time" name="call_start_t"     /> 
</div>
<br/>
<div class="w3-row">
<lable class="w3-half">CALL END TIME: </lable> 
<input class=" w3-time w3-border w3-half" value=<?php echo $row_old['call_end_t']; ?> type="time" name="call_end_t"     /> 
</div>
<br/>
<div class="w3-row">
<lable class="w3-half" >SELECT CALL STATUS</lable> 


<select class=" w3-select w3-border w3-half"  name="call_sts"  > 
<option value="<?php echo $row_old['call_sts'];?>"><?php echo $row_old['call_sts'];?></option>
<option value="CLOSED">CLOSED</option> 
<option value="PENDING">PENDING</option> 
<option value="UNDER OBSERVATION">UNDER OBSERVATION</option> 


</select>
 
</div>
<br/>



<div class="w3-row">
<lable class="w3-half" >ENTER DESCRIPTION OF CALL: </lable> 
<textarea  class="w3-half w3-textarea" name="call_desc" width="300px" height="300px"><?php echo $row_old['call_desc']; ?></textarea>

</div>
<br/>
<div class="w3-row">
<lable class="w3-half" >ENTER SPARE DETAILS: </lable> 
<textarea  class="w3-half w3-textarea" name="spare_det" width="300px" height="300px"><?php echo $row_old['spare_det']; ?></textarea>
 
</div>
<br/>
<div class="w3-row">
<lable class="w3-half" >ENTER OTR DETAILS: </lable> 

<textarea  class="w3-half w3-textarea" name="otr_det" width="300px" height="300px"><?php echo $row_old['otr_det']; ?></textarea>
</div>
<br/>
<div class="w3-row">
<lable class="  w3-half">DATE OF CALL</lable> 
<input class=" w3-input w3-border w3-half" type="date" value=<?php echo $row_old['date']; ?> name="date"  placeholder="" required  /> 
</div>
<br/>

<div class="w3-row">
<lable class="  w3-half">DATE OF CALL CLOSED</lable> 
<input class=" w3-input w3-border w3-half" type="date" value=<?php echo $row_old['call_closed_date']; ?> name="call_closed_date"  placeholder="" required  /> 
</div>
<br/>
<div class="w3-row">
<lable class="w3-half" >REMARKS</lable> 





<textarea  class="w3-half w3-textarea" name="remarks" width="300px" height="300px"><?php echo $row_old['remarks']; ?></textarea>
</div>
<br/>
<!--<div class="w3-row">
<lable class="w3-half" >UPLOAD IMAGE</lable> 





<input class="w3-half w3-input w3-border "  id="image"  name="image" type="file" accept="image/*;capture=camera">
</div>


<br/>-->


<center><input align="center"  type="submit" class="w3-btn  w3-center w3-blue" value="UPDATE" > </center>


</form>










<!--<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>-->


<br/>

<?php include 'footer.php';?>

</div>
	<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>		


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
 </body>



</html>
