<?php include 'admin_auth.php'; 
include 'db.php';

?>
<!DOCTYPE html>
<html>
<head>
<style>
.tabulator-print-header, tabulator-print-footer{
    text-align:center;
}
</style>
<link href="../cc/table/table/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="../cc/table/table/dist/js/tabulator.min.js"></script>
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

<meta charset="utf-8">


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.5/jspdf.plugin.autotable.js"></script>
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome Home</title>

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
<br/>



<div class="w3-cell-row">
  <div class="w3-container  w3-cell w3-mobile">
  <button class="w3-button w3-red" id="download-csv">Download CSV</button>
  </div>
  <div class="w3-container  w3-cell w3-mobile">
  <button class=" w3-button w3-green"id="download-json">Download JSON</button>
  </div>
  <div class="w3-container  w3-cell w3-mobile">
  <button class=" w3-button w3-blue" id="download-xlsx">Download XLSX</button>
  </div>
  <div class="w3-container  w3-cell w3-mobile">
  <button class=" w3-button w3-amber" id="download-pdf">Download PDF</button>
  </div>
  <div class="w3-container  w3-cell w3-mobile">
  
  <button class=" w3-button w3-orange" id="download-html">Download HTML</button>
  </div>
  <div class="w3-container  w3-cell w3-mobile">
    <center><button class=" w3-button w3-orange" id="print-table">Print Table</button></center>
    </div>
</div>


<br/>




<div class="w3-cell-row">
  <div class="w3-container  w3-cell w3-mobile">
  <select class="w3-select w3-border" id="filter-field">
    <option></option>
    <option value="id">ID</option>
    <option value="spare_name">SPARE NAME</option>
    <option value="spare_cat">SPARE CATGEORY</option>
    <option value="spare_id">SPARE ID</option>
    <option value="spare_device">SPARE RELATED TO</option>
    <option value="spare_brand">SPARE BRAND</option>
    
    
    <option value="log_date">LOG DATE</option>
    <option value="log_time">LOG TIME< 3</option>


    <option value="is_used">USED[1] OR NOT USED[0]</option>

    <option value="used_call">USED CALL ID</option>
  

    
  </select>
  </div>
  <div class="w3-container  w3-cell w3-mobile">
  <select class="w3-select w3-border" id="filter-type">
    <option value="like">like</option>
  </select>
  </div>
  <div class="w3-container  w3-cell w3-mobile">
  <input class="w3-input w3-border" id="filter-value" type="text" placeholder="value to filter">
  </div>
  
</div>

<br/>

<div id="example-table"></div>
<script>
var tabledata = [];
   
    <?php 
	$query = "SELECT * FROM spares";


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






<br /><br /><br /><br />



<?php include 'footer.php';?>
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
 </body>



</html>
