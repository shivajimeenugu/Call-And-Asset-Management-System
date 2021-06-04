<?php
include 'db.php';
include("cc_auth.php");
if(isset($_REQUEST['sno']))
{
$sno=$_REQUEST['sno'];
$query_old = "SELECT * from asset_table where sno='".$sno."'";
$result_old = mysqli_query($con,$query_old) or die(mysql_error($con));
$row_old= mysqli_fetch_assoc($result_old);
$rows_count = mysqli_num_rows($result_old);
if($rows_count>0)
{

}
else{
  echo '<a class="w3-button w3-blue" href="#"'.'> ERROR-->NO DATA FOUND  </a>';
    echo'<script>alert("NO DATA FOUND FOR THIS SERIAL NUMBER [MAYBE YOU ARE REGISTERING ASSET WHICH IS NOT IN AMC]--->CHECK ASSET ERROR");</script>';
	echo'<script>window.location.href="dashboard.php";</script>';
}
}
/*else{
  echo '<a class="w3-button w3-blue" href="#"'.'> ERROR-->NO DATA FOUND  </a>';
    echo'<script>alert("INVALID REQUEST");</script>';
	echo'<script>window.location.href="dashboard.php";</script>';
}*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>REGISTER CALL</title>

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


if(isset($_POST['new']) && $_POST['new']==1)
{
//auto columns
date_default_timezone_set('Asia/Kolkata'); 
$log_date=date('Y-m-d');
$log_time=date("H:i:s");
$vja_id=$_REQUEST['vja_id'];
$ifsc=$_REQUEST['ifsc'];
$branch_name=$_REQUEST['branch_name'];
$prj_name=$_REQUEST['prj_name'];
$asset_type=$_REQUEST['asset_type'];
$status='PENDING';
$asset_sno=$_REQUEST['asset_sno'];
//manual columns
$call_reg_type=$_REQUEST['call_reg_type'];
$call_desc=strtoupper($_REQUEST['call_desc']);
$remarks=   strtoupper($_REQUEST['remarks']);



//$q="insert into 10(eng_name,app_call,call_id,call_start_t,call_end_t,call_desc,call_sts,spare_det,otr_det,remarks,date) values('$eng_name','$app_call','$call_id',$call_start_t,$call_end_t,'$call_desc','$call_sts','$spare_det','$otr_det','$remarks','$date');";
$q="INSERT INTO `call_table`( `id`,`asset_sno`,`ifsc`, `prj_name`, `call_reg_type`, `call_desc`, `log_date`, `log_time`,  `asset_type`, `status`, `remarks`,`branch_name`) VALUES 
(
  '$vja_id',
  '$asset_sno',
'$ifsc',

'$prj_name',
'$call_reg_type',
'$call_desc',
'$log_date',
'$log_time',
'$asset_type',
'$status',
'$remarks',
'$branch_name'

)";

$st=mysqli_query($con,$q) or die(mysqli_error($con));
//header('Location: suss_newinsert.php');


if($st)
{
 

 
echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >CALL ADDED<p>
      <br/>
      <p><center><div class=" w3-panel w3-red">CALL SUCCESSFULLY REGISTERED</div></center>
      </p>
      <p><center> <a class="w3-btn w3-yellow w3-border" href="dashboard.php">DONE</a></center>
      </p>
      </div></div>
      </div>
      '; 
    echo'<script>document.getElementById("id01").style.display="block"</script>';
    
    //header("Location: dashboard.php");
}
else{
	echo '<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >ERROR! CAN NOT ADD CALL<p></div></div></div>'; 
	  echo'<script>document.getElementById("id01").style.display="block"</script>';
}	
	
	

}


?>









<br/>







<form action="" class=" w3-card-4   w3-padding" method="post"  align="center">
<center><p class="w3-blue">CALL ADD FORM</p></center>

<input type="hidden" name="new" value="1" />
<span onclick="open_down_tab('down_tab1')" class="w3-btn w3-block w3-gray">
FETCHED DATA</span>

<br/>

<div id="down_tab1" class="w3-hide w3-container w3-center w3-pale-red">


<div class="w3-row">
<lable class="w3-half">VJA ID: </lable> 
<?php 
$uniqueId= 'V'.date('ymd')."".date('s')."".random_int ( 10 ,99);
?>
<input class=" w3-input w3-border w3-half" type="text" value="<?php echo $uniqueId; ?>" name="vja_id"  readonly/> 
</div>
<br/>



<div class="w3-row">
<lable class="  w3-half">IFSC</lable> 
<input class=" w3-input w3-border w3-half" type="text" name="ifsc"   value="<?php echo $row_old['ifsc'];?>"  readonly/> 
</div>
<br/>

<div class="w3-row">
<lable class="  w3-half">SERIAL NUMBER</lable> 
<input class=" w3-input w3-border w3-half" type="text" name="asset_sno"   value="<?php echo $sno;?>"  readonly/> 
</div>
<br/>


<div class="w3-row">
<lable class="  w3-half">BRANCH NAME</lable> 
<input class=" w3-input w3-border w3-half" type="text" name="branch_name"   value="<?php echo $row_old['branch_name'];?>"  readonly/> 
</div>
<br/>

<div class="w3-row">
<lable class="w3-half">PROJECT NAME: </lable> 
<input class=" w3-input w3-border w3-half" type="text" name="prj_name"   value="<?php echo $row_old['bank_name'];?>"  readonly/> 
</div>
<br/>

<div class="w3-row">
<lable class="w3-half">ASSET TYPE: </lable> 
<input class=" w3-input w3-border w3-half" type="text" name="asset_type"   value="<?php echo $row_old['asset_type'];?>"  readonly/> 
</div>
<br/>

</div>



<br/> <br/>

<div class="w3-row">
<lable class="w3-half" >CALL RISED BY</lable> 
<select class="w3-half w3-select w3-border" name="call_reg_type">
<option value="BY CUSTOMER">BY CUSTOMER</option>
<option value="BY ENGINEER FROM SITE">BY ENGINEER FROM SITE</option>
</select>
</div>
<br/>

<div class="w3-row">
<lable class="w3-half" >PROBLEM REPORTED</lable> 
<textarea  class="w3-half w3-textarea" name="call_desc" width="300px" height="300px" required></textarea>
</div>
<br/>

<div class="w3-row">
<lable class="w3-half" >REMARKS</lable> 
<textarea  class="w3-half w3-textarea" name="remarks" width="300px" height="300px"></textarea>
</div>
<br/>



<center><input align="center"  value="ADD CALL" type="submit" class="w3-btn  w3-center w3-blue" name="" > </center>


</form>








<br/>



</div>
<?php include 'footer.php';?>

<script>
function open_down_tab(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
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
