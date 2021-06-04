<?php include 'admin_auth.php'; 
include 'db.php';




function getName($n) { 
    $characters = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}
?>
<!DOCTYPE html>
<html>
<head>

<link href="../cc/table/table/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="../cc/table/table/dist/js/tabulator.min.js"></script>
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.5/jspdf.plugin.autotable.js"></script>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ADD SPARE</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#tblCustomers").table2excel({
                filename: "Table.xls"
            });
        });
    });
</script>
</head>
<body  >
<div class="w3-sidebar w3-bar-block w3-white w3-card w3-animate-left" style="display:none" id="mySidebar">
                             <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
                                       <a class="w3-bar-item w3-button" href="index.php">HOME</a>
                                       <a class="w3-bar-item w3-button" href="dashboard.php">DASHBOARD</a>
                                       <a class="w3-bar-item w3-button" href="menue.php">MENU</a>
                                       <a class="w3-bar-item w3-button" href="logout.php">LOGOUT</a>
                             
            </div> 


<div class="w3-container w3-animate-right" id="main">
            <?php include 'header.php';?>

     

<div class="w3-container" >

<?php


if(isset($_POST['new']) && $_POST['new']==1)
{
  $spare_name_ref= 'VREF-'.strtoupper(getName(3)).date('d')."".date('s')."".random_int ( 10 ,99);
//auto columns
date_default_timezone_set('Asia/Kolkata'); 
$i=1;
$ok=1;
$nok=1;
$qty=$_REQUEST['spare_qty'];
if($qty>0){


while($i<=$qty)
{
$uniqueId= 'VS'.strtoupper(getName(2)).date('ymd')."".date('s')."".random_int ( 10 ,99);
$log_date=date('Y-m-d');
$log_time=date("H:i:s");
$spare_name=$_REQUEST['spare_name'];
$spare_cat=$_REQUEST['spare_cat'];
$brand=$_REQUEST['brand'];
$spec=$_REQUEST['spec'];
$div=$_REQUEST['div'];
$query = "INSERT INTO `spares` (spare_name_ref,spare_spec,spare_name,spare_cat,spare_brand,spare_device,spare_id,log_date,log_time) VALUES ('$spare_name_ref','$spec','$spare_name','$spare_cat','$brand','$div','$uniqueId','$log_date','$log_time')";
$st = mysqli_query($con,$query);
if($st)
{
  $ok=$ok+1;
}
else{
  $nok=$nok+1;
}

$i=$i+1;
}
}
else{
  echo '<div id="id01" class="w3-modal  w3-animate-zoom">
  <div class="w3-modal-content w3-padding-16 w3-card">
    <div class="w3-container"><p class="w3-panel w3-green w3-round" >ERROR! INVALID SPARES QUANTITY<p>
    <p><center> <a class="w3-btn w3-yellow w3-border" href="menue.php.php">OK</a></center>
    </p>
    </div></div></div>'; 
  echo'<script>document.getElementById("id01").style.display="block"</script>';

}





if($nok>1)
{
  echo '<div id="id01" class="w3-modal  w3-animate-zoom">
  <div class="w3-modal-content w3-padding-16 w3-card">
    <div class="w3-container"><p class="w3-panel w3-green w3-round" >ERROR! CAN NOT ADD SPARES<p>
    <p><center> <a class="w3-btn w3-yellow w3-border" href="menue.php.php">OK</a></center>
    </p>
    </div></div></div>'; 
  echo'<script>document.getElementById("id01").style.display="block"</script>';

 
}
else{
  
	
echo '<div id="id01" class="w3-modal  w3-animate-zoom">
<div class="w3-modal-content w3-padding-16 w3-card">
  <div class="w3-container"><p class="w3-panel w3-green w3-round" >SPARES ADDED<p>
  <p class="w3-panel w3-green w3-round" >PLEASE NOTE REF ID <h2 class="w3-red w3-center">'.$spare_name_ref.'</h2><p>
  
  <br/>
  
  
  <div id="example-table"></div>
  <br/><center>
  <button class=" w3-button w3-blue" onclick="down_xls()" id="download-xlsx">[ABOVE DATA] Download XLSX</button></center>
  <p><center> <a class="w3-btn w3-yellow w3-border" href="menue.php">GO TO MENU</a></center>
  </p>
  </div></div>
  <br/>
  
  </div>
  '; 
echo'<script>document.getElementById("id01").style.display="block"</script>';

//header("Location: dashboard.php");
}	

	
	

}
else{
 if(!$_REQUEST['spare_cat'])
 {
  echo '<script>alert("NO ACESS GO BACK")</script>
  
  ';

  echo '<div id="id01" class="w3-modal  w3-animate-zoom">
  <div class="w3-modal-content w3-padding-16 w3-card">
    <div class="w3-container"><p class="w3-panel w3-green w3-round" >REQUESTING PAGE WITHOUT POST DATA IS RESTRICTED<p>
    <p><center> <a class="w3-btn w3-yellow w3-border" href="menue.php">OK</a></center>
    </p>
    </div></div></div>'; 
  echo'<script>document.getElementById("id01").style.display="block"</script>';
 }
}


?>

<script>
var tabledata = [];
   
    <?php 
	$query = "SELECT * FROM spares where spare_name_ref='$spare_name_ref'";


    $result = mysqli_query( $con, $query);
    $count_row=mysqli_num_rows($result);
    //$data=mysqli_fetch_assco(0;)
    //echo json_encode($result);
    while ($row = mysqli_fetch_assoc($result)) {

        echo 'tabledata.push('.json_encode($row).');';
        
    }


?>

     var table = new Tabulator("#example-table", {
		height:500, // set height of table to enable virtual DOM
		data:tabledata, //load initial data into table
        layout:"fitDataFill",
        pagination:"local",
        printAsHtml:true,
    printHeader:"<h1>Example Table Header<h1>",
    printFooter:"<h2>Example Table Footer<h2>",
    paginationSize:<?php echo $count_row; ?>,
    paginationSizeSelector:[<?php echo $count_row; ?>],
    movableColumns:true,
        //fit columns to width of table (optional)
 	columns:[ //Define Table Columns
            {title:"ID", field:"id", sorter:"string", width:150},
            {title:"SPARE NAME.", field:"spare_name", sorter:"string"},    
            {title:"SPARE ID", field:"spare_id", sorter:"string"},
            {title:"SPARE CATGEORY", field:"spare_cat", sorter:"string", sortable:false},
            {title:"SPARE BRAND", field:"spare_brand", sorter:"string"},
            {title:"SPARE RELATED TO", field:"spare_device", sorter:"string"},
            {title:"LOG DATE", field:"log_date", sorter:"date"},
            {title:"LOG TIME", field:"log_time", sorter:"string"},
            {title:"USED[1] OR NOT USED[0]", field:"is_used", sorter:"number"},
            {title:"USED CALL ID", field:"used_call", sorter:"string"},
            
            
          {title:"SPARES USED", field:"spare_used", sorter:"string"}
            
		],
    
     
     rowClick:function(e, row){ //trigger an alert message when the row is clicked
 		alert("Row " + row.getData().id + " Clicked!!!!");
 	},
}); 

//trigger download of data.csv file
document.getElementById("download-csv").addEventListener("click", function(){
    table.download("csv", "data.csv");
});

//trigger download of data.json file
document.getElementById("download-json").addEventListener("click", function(){
    table.download("json", "data.json");
});

//trigger download of data.xlsx file
document.getElementById("download-xlsx").addEventListener("click", function(){
    table.download("xlsx", "data.xlsx", {sheetName:"VJA CALL DATA"});
});

function down_xls(){
  table.download("xlsx", "data.xlsx", {sheetName:"VJA CALL DATA"});
}

//trigger download of data.pdf file
document.getElementById("download-pdf").addEventListener("click", function(){
    table.download("pdf", "data.pdf", {
        orientation:"landscape", //set page orientation to portrait
        title:"RAPIDTECH VIJAYAWADA CALL REPORTS", //add title to report

    });
});

//trigger download of data.html file
document.getElementById("download-html").addEventListener("click", function(){
    table.download("html", "data.html", {style:true});
});

//print button
document.getElementById("print-table").addEventListener("click", function(){
   table.print(false, true);
});


//Define variables for input elements
var fieldEl = document.getElementById("filter-field");
var typeEl = document.getElementById("filter-type");
var valueEl = document.getElementById("filter-value");

//Custom filter example
function customFilter(data){
    return data.car && data.rating < 3;
}

//Trigger setFilter function with correct parameters
function updateFilter(){
  var filterVal = fieldEl.options[fieldEl.selectedIndex].value;
  var typeVal = typeEl.options[typeEl.selectedIndex].value;

  var filter = filterVal == "function" ? customFilter : filterVal;

  if(filterVal == "function" ){
    typeEl.disabled = true;
    valueEl.disabled = true;
  }else{
    typeEl.disabled = false;
    valueEl.disabled = false;
  }

  if(filterVal){
    table.setFilter(filter,typeVal, valueEl.value);
  }
}

//Update filters on value change
document.getElementById("filter-field").addEventListener("change", updateFilter);
document.getElementById("filter-type").addEventListener("change", updateFilter);
document.getElementById("filter-value").addEventListener("keyup", updateFilter);

//Clear filters on "Clear Filters" button click
document.getElementById("filter-clear").addEventListener("click", function(){
  fieldEl.value = "";
  typeEl.value = "=";
  valueEl.value = "";

  table.clearFilter();
});
</script>
















<br/>







<form action="" class=" w3-card-4   w3-padding" method="post"  align="center">
<center><p class="w3-blue">ADD CATEGORY</p></center>

<input type="hidden" name="new" value="1" />

<!--HONAD BANZ CIRCLE>>>>>>>>>7674076536-->


<div class="w3-row">
<lable class="w3-half" >ENTER SPARE NAME</lable> 
<input type="text" class="w3-half w3-input" placeholder=" EXAMPLE:HARD DISK 500GB" name="spare_name" required/>
</div>
<br/>




<div class="w3-row">
<lable class="w3-half" >SELECT SPARE CATGEORY</lable> 

<input type="text" value="<?php echo $_REQUEST['spare_cat'];?>" class="w3-half w3-input" name="spare_cat" readonly required/>



</div>
<br/>





<div class="w3-row">
<lable class="w3-half" >SELECT SPARE BRAND</lable> 

<select name="brand" class="w3-select w3-half w3-border" required>
<?php
$query_bank='select * from brands';
$result = mysqli_query($con,$query_bank) or die(mysql_error($con));
while($row = mysqli_fetch_array($result))
	{ 
?>
<option value="<?php echo $row['brand'];?>"><?php echo $row['brand'];?></option>
	<?php } ?>
</select>


</div>
<br/>



<div class="w3-row">
<lable class="w3-half" >SELECT SPARE SPECIFICATION</lable> 

<select name="spec" class="w3-select w3-half w3-border" required>
<option value="NO SPEC">NO SPEC</option>
<?php
$cat_ret=$_REQUEST['spare_cat'];
$query_bank="select * from spare_spec where spare_cat='$cat_ret'";
$result = mysqli_query($con,$query_bank) or die(mysql_error($con));
while($row = mysqli_fetch_array($result))
	{ 
?>
<option value="<?php echo $row['spare_spec'];?>"><?php echo $row['spare_spec'];?></option>
	<?php } ?>
</select>


</div>
<br/>


<div class="w3-row">
<lable class="w3-half" >SELECT SPARE RELATED TO</lable> 

<select name="div" class="w3-select w3-half w3-border" required>
<?php
$query_bank="select * from devices";
$result = mysqli_query($con,$query_bank) or die(mysql_error($con));
while($row = mysqli_fetch_array($result))
	{ 
?>
<option value="<?php echo $row['device'];?>"><?php echo $row['device'];?></option>
	<?php } ?>
</select>


</div>
<br/>








<div class="w3-row">
<lable class="w3-half" >ENTER QUANTITY</lable> 


<input type="number" min="1" class="w3-half w3-input w3-border" name="spare_qty" required/>



</div>
<br/>


<center><input align="center"  value="ADD SPARE" type="submit" class="w3-btn  w3-center w3-blue" name="" > </center>


</form>
<br/>
<br/>
<div class="w3-card-4 w3-pale-red">


<table id="id01" class="w3-table-all  w3-responsive  ">
						<tr><th colspan="11"><center>CATEGORYS</center></th></tr>
						<tr class="w3-hover-grey w3-red">
						
<th>SI.NO</th>							
<th>ID</th>						
<th>CATEGORY NAME</th>
<th>OPTIONS</th>
        </tr>';
        <?php
$query = "SELECT * FROM spare_cat";
$result = mysqli_query($con,$query);
$count=1;
while($row = mysqli_fetch_array($result))
	{
		//echo'?>
			<tr class="item w3-hover-grey ">
<td align="center"><?php echo $count; ?></td>
<td align="center"><?php echo $row["id"]; ?></td>
<td align="center"><?php echo $row["cat_name"]; ?></td>

<td align="center"><a class="w3-button w3-blue" href="#.php?id=<?php echo $row['id'] ;?>">REMOVE</a></td> 
</tr>
  
  <?php
		$count++;
		//';
	}
	

?>

</table></CENTER>



















</div>







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
