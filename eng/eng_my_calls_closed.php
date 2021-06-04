<?php include 'eng_auth.php'; 
include 'call_count.php';
$eng_id=$_SESSION['eng_username'];
include 'db.php';

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome Home</title>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
<br/>
<div class=" w3-panal">

<div class="w3-cell w3-mobile">
    <div  class="w3-panel w3-margin w3-green w3-border ">GREEN COLOUR -->CC APPROVED <span class="w3-badge"><?php echo get_approved_call_count($eng_id); ?></span></div> 
    <div  class="w3-panel w3-margin  w3-red w3-border ">RED COLOUR -->PENDDING AT CC <span class="w3-badge"><?php echo get_pending_call_count($eng_id); ?></span></div>
    <div   class="w3-panel  w3-margin  w3-blue w3-border">BLUE COLOUR -->REJECTED AT CC <span class="w3-badge"><?php echo get_reject_call_count($eng_id); ?></span></div>
    </div>
    

</div>

<div class="w3-card-2 w3-margin" style="max-width:100%;">
  <header class="w3-container w3-light-grey w3-padding-16">
    <h3>My CLOSED CALLS LIST</h3>
  </header>
  <ul class="w3-ul">
<?php 
$eng_id=$_SESSION['eng_username'];
$query = "SELECT * FROM `call_table` WHERE eng_ass='$eng_id' and  is_eng_closed=1 ORDER BY close_date";
$result = mysqli_query($con,$query);
$no_of_calls = mysqli_num_rows($result);
$count=1;
while($row = mysqli_fetch_array($result))
	{
if($row['status']=='PENDING')
{
  if($row['is_rejected']==1)
  {

?>
<!--rejectd block-->
<li onclick="open_down_tab('down_tab<?php echo $count; ?>')" class="w3-padding-16 w3-blue"><?php echo $count.'. '.$row['prj_name'].'--'.$row['branch_name'].' '.$row['asset_type'].' PROBLEM'; ?><i class='fas fa-angle-double-down w3-right w3-margin-right' style='font-size:24px'></i>
  <div class="w3-row"><button  onclick="window.location.href='eng_close_call.php?id=<?php echo $row['id']; ?>'" class="w3-button w3-amber">RE SUBMIT TO CC</button></div>

</li>

  <div id="down_tab<?php echo $count; ?>" class="w3-hide w3-container w3-animate-zoom w3-center w3-pale-red">
  <div class="w3-row">
    <div class="w3-panel w3-white w3-border w3-half">CC REMARKS</div> 
    <div class="w3-panel w3-light-grey w3-border w3-half"><?php echo $row['close_remarks']; ?></div> 
    </div>
    <br/>
<!--reject block end-->
<?php }
else{
?>

  <!--loop content-->
  <li onclick="open_down_tab('down_tab<?php echo $count; ?>')" class="w3-padding-16 w3-red"><?php echo $count.'. '.$row['prj_name'].'--'.$row['branch_name'].' '.$row['asset_type'].' PROBLEM'; ?><i class='fas fa-angle-double-down w3-right w3-margin-right' style='font-size:24px'></i>
  <div class="w3-row"><button  onclick="window.location.href='eng_undo_closed_call.php?id=<?php echo $row['id']; ?>'" class="w3-button w3-amber">UNDO CLOSE</button></div>
  </li>

  <div id="down_tab<?php echo $count; ?>" class="w3-hide w3-container w3-animate-zoom w3-center w3-pale-red">

<?php }}
else{
?>
<li onclick="open_down_tab('down_tab<?php echo $count; ?>')" class="w3-padding-16 w3-green"><?php echo $count.'. '.$row['prj_name'].'--'.$row['branch_name'].' '.$row['asset_type'].' PROBLEM'; ?><i class='fas fa-angle-double-down w3-right w3-margin-right' style='font-size:24px'></i>
  
  </li>
  <div id="down_tab<?php echo $count; ?>" class="w3-hide w3-container w3-animate-zoom w3-center w3-pale-red">
    
    <div class="w3-row">
    <div class="w3-panel w3-white w3-border w3-half">HYD ID</div> 
    <div class="w3-panel w3-light-grey w3-border w3-half"><?php echo $row['hyd_id']; ?></div> 
    </div>
    <br/>
    
    
    <div class="w3-row">
    <div class="w3-panel w3-white w3-border w3-half">CC REMARKS</div> 
    <div class="w3-panel w3-light-grey w3-border w3-half"><?php echo $row['close_remarks']; ?></div> 
    </div>
    <br/>

<?php } ?>
  
    
    <div class="w3-row">
    <div class="w3-panel w3-white w3-border w3-half">VJA ID</div> 
    <div class="w3-panel w3-light-grey w3-border w3-half"><?php echo $row['id']; ?></div> 
    </div>
    <br/>


    <div class="w3-row">
    <div class="w3-panel w3-white w3-border w3-half">SERIAL NO.</div> 
    <div class="w3-panel w3-light-grey w3-border w3-half"><?php echo $row['asset_sno']; ?></div> 
    </div>
    <br/>

    <div class="w3-row">
    <div class="w3-panel w3-white w3-border w3-half">PROBLEM REPORTED</div> 
    <div class="w3-panel w3-light-grey w3-border w3-half"><?php echo $row['call_desc']; ?></div> 
    </div>
    <br/>

    <div class="w3-row">
    <div class="w3-panel w3-white w3-border w3-half">CALL SHUDULED TO</div> 
    <div class="w3-panel w3-light-grey w3-border w3-half"><?php echo $row['call_shed_date']; ?></div> 
    </div>
    <br/>

    <div class="w3-row">
    <div class="w3-panel w3-white w3-border w3-half">REMARKS</div> 
    <div class="w3-panel w3-light-grey w3-border w3-half"><?php echo $row['remarks']; ?></div> 
    </div>
    <br/>

    </div>
  
<!--loop enf-->
  <?php $count=$count+1; }?>
  </ul>

<div class="w3-container w3-light-grey w3-padding-16">
    <div class="w3-row w3-margin-top">
    </div>
  </div>
</div>


</div>















<?php include 'footer.php';?>
 </body>

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


</html>
