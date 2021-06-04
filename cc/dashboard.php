<?php

 
require('db.php');
include("cc_auth.php"); //include auth.php file on all secure pages ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DASHBOARD</title>

</head>
<body class="" >
     <div class="w3-sidebar w3-bar-block w3-white w3-card w3-animate-left" style="display:none" id="mySidebar">
                             <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
                                       <a class="w3-bar-item w3-button" href="index.php">HOME</a>

                                       <a class="w3-bar-item w3-button" href="dashboard.php">DASHBOARD</a>
		
		

                                       

                                       <a class="w3-bar-item w3-button" href="logout.php">LOGOUT</a>
                             
            </div> 


<div class="w3-container w3-animate-right" id="main">
      <?php include 'header.php';?>
	  
<br/>
   <div class="w3-bar w3-light-blue"  >
  <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'London')">CALL OPTIONS</button>
     <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Paris')">REPORTS</button>
    <!-- <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Tokyo')">NOTIFICATIONS</button>
  <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'tiruvuru')">SEARCH OPTIONS

</button>
   <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'kuppam')">LOGS</button>
-->
  </div>

<!--/////////////////////////////////////////-->
<div id="London" class="w3-container w3-display-container city">
 <!-- <span onclick="this.parentElement.style.display='none'"
  class="w3-button w3-large w3-display-topright">&times;</span>-->
 <br/>
 <div class="  w3-container w3-card w3-light-blue">
  
  
 <center> <div class="w3-panel w3-round w3-white"><p> CALL OPTIONS</p></div></center>
  <center> <button class="w3-btn w3-yellow w3-border" onclick="addcall()">REGISTER CALL</button></center><br/>
  <center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='close_call_index.php'"> APPROVE CALLS CLOSED BY ENGINEER</button></center><br/>
  
  <!--<center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='add_eng.php'">ADD OR REMOVE ENGINEER</button></center><br/>
 -->

 
</div>
  
   <br/>
  
  
</div>


<div id="Paris" class="w3-container w3-display-container city" style="display:none">
 <!-- <span onclick="this.parentElement.style.display='none'"
  class="w3-button w3-large w3-display-topright">&times;</span>-->
 <br/>
 <div class="  w3-container w3-card w3-light-blue">
  
  
 <center> <div class="w3-panel w3-round w3-white"><p> REPORTS</p></div></center>
  
  <center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='table.php'">ALL REPORTS</button></center><br/>
  <center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='table_pend.php'">NOT ASSIGNED CALLS</button></center><br/>
  <center> <button class="w3-btn w3-yellow w3-border" onclick="window.location.href='table_ass_but_pend.php'">PENDING CALLS AT ENGINEER SIDE</button></center><br/>
  
  
 
</div>
  
   <br/>
  
  
</div>










 
<div id="id01" class="w3-modal  w3-animate-zoom">
    <div class="w3-modal-content w3-padding-16 w3-card">
      <div class="w3-container"><p class="w3-panel w3-green w3-round" >
     
     
      <form  action="" method="POST" >
      <!--<input type="hidden" name="new" value="1" />-->
<input  class="w3-input w3-panel w3-border w3-responsive w3-card w3-pale-red w3-round-xxlarge" list="brow" name="sno" placeholder="ENTER IFSC CODE" required>
<datalist id="brow">
  <?php
$query_bank='select * from bank';
$result = mysqli_query($con,$query_bank) or die(mysql_error($con));

while($row = mysqli_fetch_array($result))
	{ 
?>

<option value="<?php echo $row['ifsc'];?>"><?php echo $row['branch_name'];?>-<?php echo $row['bank_name'];?> </option>
	<?php } ?>
</datalist> 




<br /><br />
<center>
<button type="submit" name="submit" onclick="asset_table()" class="w3-button w3-theme-d4">Fetch</button></center>
<br /><br />
</form>


      
      </div></div></div> 

      <div id="asset_table" class="w3-modal  w3-animate-zoom">
  <div class="w3-modal-content w3-padding-16 w3-card">
  <div class="w3-center">
      <span  onclick="window.location.href='dashboard.php'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
     
    </div>

      <div class="w3-container">
<?php 
if(isset($_REQUEST['sno'])){
  
 

  $query='';
  $count=1;
  //$con = mysqli_connect("localhost", "root", "", "lib");
  $output = '';
   
    $ifsc=$_REQUEST['sno'];
    
  
    
  $query_bank_date="select * from bank where  ifsc='$ifsc' ";
  $result_date = mysqli_query($con,$query_bank_date) or die(mysqli_error($con));
  $row_date = mysqli_fetch_array($result_date);
  $bank_name=$row_date['bank_name'];
  $branch_name= $row_date['branch_name'];
    
    
    
    
    
    
    
    
    $query = "select * from asset_table where cat='CPU' AND ifsc='$ifsc'";
  echo'<center>
  

  
  <table style="border-collapse: collapse; border: 1px solid black;" class="w3-table-all w3-bordered w3-responsive">
  <tr>
  
  <th>BRANCH NAME</th>
  <th>IFSC</th>

  
  </tr>
  <tr>
  <td style="border: 1px solid black;"><div ><b><h4 style="color:black;">'.$bank_name.' , '.$branch_name.'<h4></b></div></td>
    <td style="border: 1px solid black;"><div ><b><h4 style="color:black;">'.$ifsc.'<h4></b></div></td>
    
  <tr>	
    
  
  </table></center>';
  echo '
    
  
  
  <br/>
    <table style="border-collapse: collapse; border: 1px solid black;" class="w3-table-all w3-responsive">
              <thead>
            <tr class="w3-indigo">
    <th>ASSET TYPE</th>						
  <th>SI.NO</th>							
  
                
  
  <th >MANIFARTURER</th>
  <th >SERIAL NO</th>
  <th >MODEL</th>
  <th >CONDITION</th>
  
  <th >CONFIGRATION</th>
  <th >IP</th>
  <th>OS GENUINE</th>
  <th>AMC/WARRANTY</th>
  <th >REMARKS</th>
  <th>REGISTER</th>
          </tr>
          
          </thead>
          <tbody>
          
          
          
          
          ';
  $result = mysqli_query( $con, $query);
  $row_count=mysqli_num_rows($result);
  if(mysqli_num_rows($result) > 0)
    {
    
  $row_span_flag=1;		
      
  while($row = mysqli_fetch_array($result))
    {
      echo'
        <tr class="w3-hover-grey ">';
        if($row_span_flag==1)
        {
          echo '<td rowspan="'.$row_count.'" style="border: 1px solid black;" class="w3-red"><center>DESKTOPS</center></td>';
          $row_span_flag++;
        }
        
        ?>
        
    
    
  <td style="border: 1px solid black;" align="center"><?php echo $count; ?></td>
  <td style="border: 1px solid black;"  align="center"><?php echo $row["mf"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row["sno"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row["model"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row["cond"]; ?></td>
  
  
  <td  style="border: 1px solid black;" align="center"><?php echo $row["pro"].'/'.$row["hdd"].'/'.$row["ram"].'/'.$row["os"] ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row["ip"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row["is_gen"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row["amc_or_w"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row["remarks"]; ?></td>
  <td><button class=" w3-button w3-red"onclick="window.location.href ='reg_call.php?sno=<?php echo $row['sno']; ?>';"> SELECT </button><br></td>
      </tr>
      <?php
      $count++;
      
    }
    
  }
  else
  {
    
    echo '<h3 class=" w3-panel w3-red">NO DESKTOP DATA FOUND FROM '.$branch_name.' ' .'BRANCH</h3>';
    
  }
  
  
  ?>
  
  
  
  
  
  <!--//////////////////////////////////////////////////////////////////////////-->
  <?php
  
  $query4 = "select * from asset_table where cat='SERVER' AND ifsc='$ifsc'";
  
  $count4=1;
  $result4= mysqli_query( $con, $query4);
  $row_count=mysqli_num_rows($result4);
  if(mysqli_num_rows($result4) > 0)
  {
    echo '<br/>
    
    
    
    
              
          ';
  $row_span_flag=1;				
  while($row4 = mysqli_fetch_array($result4))
    {
      echo'
        <tr class="w3-hover-grey ">';
        if($row_span_flag==1)
        {
          echo '<td rowspan="'.$row_count.'"  style="border: 1px solid black;" class="w3-blue"><center>SERVERS</center></td>';
          $row_span_flag++;
        }
        
        ?>
    
  <td style="border: 1px solid black;" align="center"><?php echo $count4; ?></td>
  
  
  
  <td  style="border: 1px solid black;" align="center"><?php echo $row4["mf"]; ?></td>
  <td style="border: 1px solid black;"  align="center"><?php echo $row4["sno"]; ?></td>
  <td style="border: 1px solid black;"  align="center"><?php echo $row4["model"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row4["cond"]; ?></td>
  
  
  <td  style="border: 1px solid black;" align="center"><?php echo $row4["pro"].'/'.$row4["hdd"].'/'.$row4["ram"].'/'.$row4["os"] ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row4["ip"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row4["is_gen"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row4["amc_or_w"]; ?></td>
  <td style="border: 1px solid black;"  align="center"><?php echo $row4["remarks"]; ?></td>
  <td><button class=" w3-button w3-red"onclick="window.location.href ='reg_call.php?sno=<?php echo $row4['sno']; ?>';"> SELECT </button><br></td>
      </tr>
      <?php
      $count4++;
      //';
    }
    
  }
  else
  {
    echo '<h3  class=" w3-panel w3-red"  >NO SERVER DATA FOUND FROM '.$branch_name.' ' .'BRANCH</h3>';
  }
  
  
  ?>
  
  
  
  
  <!--//////////////////////////////////////////////////////////////////////////-->
  
  <?php
  
  $query2 = "select * from asset_table where cat='PRINTER' AND ifsc='$ifsc'";
  
  $count2=1;
  $result2 = mysqli_query( $con, $query2);
  $row_count=mysqli_num_rows($result2);
  if(mysqli_num_rows($result2) > 0)
  {
    echo '<br/>
    
    
            ';
  $row_span_flag=1;				
  while($row2 = mysqli_fetch_array($result2))
    {
      echo'
        <tr class="w3-hover-grey ">';
        if($row_span_flag==1)
        {
          echo '<td rowspan="'.$row_count.'" style="border: 1px solid black;"  class="w3-green"><center>PRINTERS</center></td>';
          $row_span_flag++;
        }
        
        ?>
        
    
    
  <td style="border: 1px solid black;"  align="center"><?php echo $count2; ?></td>
  
  
  
  <td  style="border: 1px solid black;" align="center"><?php echo $row2["mf"]; ?></td>
  <td style="border: 1px solid black;"  align="center"><?php echo $row2["sno"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row2["model"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row2["cond"]; ?></td>
  
  
  
  <td style="border: 1px solid black;"  align="center">---</td>
  <td style="border: 1px solid black;"  align="center">---</td>
  <td  style="border: 1px solid black;" align="center">---</td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row2["amc_or_w"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row2["remarks"]; ?></td>
  <td><button class=" w3-button w3-red"onclick="window.location.href ='reg_call.php?sno=<?php echo $row2['sno']; ?>';"> SELECT </button><br></td>
      </tr>
      <?php
      $count2++;
      //';
    }
    
  }
  else
  {
    echo '<h3  class=" w3-panel w3-red" >NO PRINTERS DATA FOUND FROM '.$branch_name.' ' .'BRANCH</h3>';
  }
  
  
  ?>
  
  <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  
  <?php
  
  $query3 = "select * from asset_table where cat='MONITER' AND ifsc='$ifsc'";
  
  $count3=1;
  $result3 = mysqli_query( $con, $query3);
  $row_count=mysqli_num_rows($result3);
  if(mysqli_num_rows($result3) > 0)
  {
    //echo '<br/>
    
    
    $row_span_flag=1;				
  while($row3 = mysqli_fetch_array($result3))
    {
      echo'
        <tr class="w3-hover-grey ">';
        if($row_span_flag==1)
        {
          echo '<td rowspan="'.$row_count.'"  style="border: 1px solid black;" class="w3-yellow"><center>MONITERS</center></td>';
          $row_span_flag++;
        }
        
        ?>
        
    
    
  <td style="border: 1px solid black;"  align="center"><?php echo $count3; ?></td>
  
  
  
  <td  style="border: 1px solid black;" align="center"><?php echo $row3["mf"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row3["sno"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row3["model"]; ?></td>
  <td style="border: 1px solid black;"  align="center"><?php echo $row3["cond"]; ?></td>
  
  
  
  
  <td  style="border: 1px solid black;" align="center">---</td>
  <td  style="border: 1px solid black;" align="center">---</td>
  <td  style="border: 1px solid black;" align="center">---</td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row3["amc_or_w"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row3["remarks"]; ?></td>	
  <td><button class=" w3-button w3-red"onclick="window.location.href ='reg_call.php?sno=<?php echo $row3['sno']; ?>';"> SELECT </button><br></td>
      </tr>
      <?php
      $count3++;
      //';
    }
    
  }
  else
  {
    echo '<h3 class=" w3-panel w3-red" >NO MONITER DATA FOUND FROM '.$branch_name.' ' .'BRANCH</h3>';
  }
  
  
  ?>
  
  
  
  
  <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  
  
  
  <?php
  
  $query5 = "select * from asset_table where cat='SCANNER' AND ifsc='$ifsc'";
  
  $count5=1;
  $result5 = mysqli_query( $con, $query5);
  $row_count=mysqli_num_rows($result5);
  if(mysqli_num_rows($result5) > 0)
  {
    //echo '<br/>
    
    
    
    $row_span_flag=1;				
  while($row5 = mysqli_fetch_array($result5))
    {
      echo'
        <tr class="w3-hover-grey ">';
        if($row_span_flag==1)
        {
          echo '<td rowspan="'.$row_count.'" style="border: 1px solid black;"  class="w3-pink"><center>SCANNERS</center></td>';
          $row_span_flag++;
        }
        
        ?>
        
    
    
  <td  style="border: 1px solid black;" align="center"><?php echo $count5; ?></td>
  
  
  
  <td style="border: 1px solid black;"  align="center"><?php echo $row5["mf"]; ?></td>
  <td style="border: 1px solid black;"  align="center"><?php echo $row5["sno"]; ?></td>
  <td style="border: 1px solid black;"  align="center"><?php echo $row5["model"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row5["cond"]; ?></td>
  
  
  <td  style="border: 1px solid black;" align="center">---</td>
  <td  style="border: 1px solid black;" align="center">---</td>
  <td  style="border: 1px solid black;" align="center">---</td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row5["amc_or_w"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row5["remarks"]; ?></td>
  <td><button class=" w3-button w3-red"onclick="window.location.href ='reg_call.php?sno=<?php echo $row5['sno']; ?>';"> SELECT </button><br></td>
      </tr>
      <?php
      $count5++;
      //';
    }
    
  }
  else
  {
    echo '<h3  class=" w3-panel w3-red" >NO PRINTERS DATA FOUND FROM '.$branch_name.' ' .'BRANCH</h3>';
  }
  
  
  ?>
  
  
  
  <!--//////////////////////////////////////////////////////////////////////////-->
  
  <?php
  
  $query6 = "select * from asset_table where cat='OTHERS' AND ifsc='$ifsc'";
  
  $count6=1;
  $result6 = mysqli_query( $con, $query6);
  $row_count=mysqli_num_rows($result6);
  if(mysqli_num_rows($result6) > 0)
  {
    //echo '<br/>
    
    
    
    $row_span_flag=1;				
  while($row6 = mysqli_fetch_array($result6))
    {
      echo'
        <tr class="w3-hover-grey ">';
        if($row_span_flag==1)
        {
          echo '<td rowspan="'.$row_count.'" style="border: 1px solid black;"  class="w3-violet"><center>OTHERS</center></td>';
          $row_span_flag++;
        }
        
        ?>
        
    
    
  <td style="border: 1px solid black;"  align="center"><?php echo $count6; ?></td>
  
  
  
  <td  style="border: 1px solid black;" align="center"><?php echo $row6["mf"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row6["sno"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row6["model"]; ?></td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row6["cond"]; ?></td>
  
  
  
  
  <td style="border: 1px solid black;"  align="center">---</td>
  <td style="border: 1px solid black;"  align="center">---</td>
  <td  style="border: 1px solid black;" align="center">---</td>
  <td  style="border: 1px solid black;" align="center"><?php echo $row6["amc_or_w"]; ?></td>
  <td style="border: 1px solid black;"  align="center"><?php echo $row6["remarks"]; ?></td>
  <td><button class=" w3-button w3-red"onclick="window.location.href ='reg_call.php?sno=<?php echo $row6['sno']; ?>';"> SELECT </button><br></td>
      </tr>
      <?php
      $count6++;
      //';
    }
    
  }
  else
  {
    //echo '<h3  class=" w3-panel w3-red" >NO OTHERS </h3>';
  }
  
  
  ?>
  <?php
  echo '</tbody>
  </table>';

echo'<center><p><a class="w3-button w3-blue" href="dashboard.php">CANCLE</a></p><center>';

  echo'<script>document.getElementById("asset_table").style.display="block"</script>';

}

?> 

</div></div></div>

	  <script>
    function addcall(){
    document.getElementById("id01").style.display="block"
    }
    function asset_table(){
    document.getElementById("asset_table").style.display="block"
    }
    </script>

<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>


 
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

 
 



<br/>

	   
	   
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
</div>
<?php include 'footer.php';?>
 </body>



</html>