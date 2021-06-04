<?php include 'admin_auth.php'; 
include 'db.php';
include 'get_prj_call_atatus.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<script src="https://www.gstatic.com/charts/loader.js"></script>
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
<center><h1 class="w3-panel w3-pink">CONSOLIDATED</h1></center>


<center>
<div class="w3-row-padding">

  <div class="w3-third w3-round w3-hover-shadow w3-padding-16 w3-card-4 w3-margin w3-purple" style="width:30%;">
    <h3 class="w3-text">PENDING</h3>
    <h1 class="w3-text"><?php echo get_prj_call_status_pend_all();  ?></h1>
</div>
<div class="w3-third w3-round w3-hover-shadow w3-padding-16 w3-card-4 w3-margin w3-purple" style="width:30%;">
    <h3 class="w3-text">CLOSED</h3>
    <h1 class="w3-text"><?php echo get_prj_call_status_closed_all();  ?></h1>
</div>
<div class="w3-third w3-round w3-hover-shadow w3-padding-16 w3-card-4 w3-margin w3-purple" style="width:30%;">
    <h3 class="w3-text">TOTAL</h3>
    <h1 class="w3-text"><?php echo get_prj_call_status_all();  ?></h1>
</div>
<div class="w3-third w3-round w3-hover-shadow w3-padding-16 w3-card-4 w3-margin w3-purple" style="width:30%;">
    <h3 class="w3-text">NO OF ENGINEERS</h3>
    <h1 class="w3-text"><?php echo get_eng_count();  ?></h1>
</div>
<div class="w3-third w3-round w3-hover-shadow w3-padding-16 w3-card-4 w3-margin w3-purple" style="width:30%;">
    <h3 class="w3-text">NO OF CALLS NOT VERIFIED BY CC</h3>
    <h1 class="w3-text"><?php echo no_of_calls_not_verified_by_cc();  ?></h1>
</div>
<div class="w3-third w3-round w3-hover-shadow w3-padding-16 w3-card-4 w3-margin w3-purple" style="width:30%;">
    <h3 class="w3-text">NO OF PROJECTS</h3>
    <h1 class="w3-text"><?php echo get_prj_count();  ?></h1>
</div>
<div class="w3-third w3-round w3-hover-shadow w3-padding-16 w3-card-4 w3-margin w3-purple" style="width:30%;">
    <h3 class="w3-text">NO OF CALLS NOT ASSIGNED</h3>
    <h1 class="w3-text"><?php echo get_call_not_ass_sts();  ?></h1>
</div>
</div>

</div>
</center>
<br/><br/>

<center><h1 class="w3-panel w3-pink">PROJECT WISE</h1></center>
<div class="w3-row-padding">
  
<div style="width:30%; height:50%;" class="w3-half w3-round w3-hover-shadow w3-margin w3-card-4 ">
<center><div  style="width:30%; height:50%;" id="barchart_values" ></div></center>
</div>

<div style="width:60%; height:50%;"  class="w3-half w3-round w3-hover-shadow w3-card-4 w3-margin">
<center><div  style="width:70%; height:50%;"   id="chart_div"></div></center>
</div>

</div>
<br/>
<center><h1 class="w3-panel w3-pink">ENGINEERS PROGRESS</h1></center>
<div class="w3-card-4 w3-margin" id="table_div"></div>
<br/>

<br/>
<center><h1 class="w3-panel w3-pink">SPARES STOCK</h1></center>
<div class="w3-card-4 w3-margin" id="table_stocks"><?php include 'spare_print_embd.php'; ?></div>
<br/>

<br /><br /><br /><br />
<center><h1 class="w3-panel w3-pink">NEW ADD-ONs ARE UNDER DEVELOPMENT</h1></center>


<?php include 'footer.php';?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
    
      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('number', 'NO of calls assigned');
        data.addColumn('number', 'No of calls in progress');
        data.addColumn('number', 'No of calls closed (TILL NOW)');

        data.addRows([
          <?php
        $get_count_status=0;
        $sum_total_ass=0;
        $get_count_status_closed=0;
        $get_bank_name="SELECT * FROM eng";
        $get_bank_name_res=mysqli_query($con,$get_bank_name);
        while($row_get_bank=mysqli_fetch_array($get_bank_name_res))
        {
            $eng_ref=$row_get_bank['emp_code'];
            $eng_name_ref=$row_get_bank['eng_name'];
            $get_count_status+=get_eng_status($eng_ref);
            $get_count_status_closed+=get_eng_status_closed($eng_ref);
            $total_ass=get_eng_status($eng_ref)+get_eng_status_closed($eng_ref);
            $sum_total_ass=$sum_total_ass+$total_ass;
            echo '["'.$eng_name_ref.'",'.$total_ass.','.get_eng_status($eng_ref).','.get_eng_status_closed($eng_ref).'],';
        }
        echo '["TOTAL",'.$sum_total_ass.','.$get_count_status.','.$get_count_status_closed.'],';

        ?>
          
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '30%'});
      }
    </script>

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["PROJECT NAME", "CALLS", { role: "style" } ],
        <?php
        $get_bank_name="SELECT DISTINCT bank_name FROM bank";
        $get_bank_name_res=mysqli_query($con,$get_bank_name);
        while($row_get_bank=mysqli_fetch_array($get_bank_name_res))
        {
            $bank_name_fetched=$row_get_bank['bank_name'];
            echo '["'.$bank_name_fetched.'",'.get_prj_call_status($bank_name_fetched).',"#26ff26"],';
        }
        ?>
        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "PROJECT WISE CALL STATUS",
        width: 200,
        height: 400,
        bar: {groupWidth: "50%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['PROJECT NAME', 'CLOSED', 'PENDING', 'TOTAL'],
          <?php
        $get_bank_name="SELECT DISTINCT bank_name FROM bank";
        $get_bank_name_res=mysqli_query($con,$get_bank_name);
        while($row_get_bank=mysqli_fetch_array($get_bank_name_res))
        {
            $bank_name_fetched=$row_get_bank['bank_name'];
            echo '["'.$bank_name_fetched.'","'.get_prj_call_status_closed($bank_name_fetched).'","'.get_prj_call_status_pend($bank_name_fetched).'","'.get_prj_call_status($bank_name_fetched).'"],';
        }
        ?>
        ]);

        var options = {
          chart: {
        title: "PROJECT WISE CALL STATUS",
        width: 200,
        height: 200,
        bar: {groupWidth: "40%"},
        bar: {groupHeight: "20%"},
        legend: { position: "none" },
          },
          bars: 'horizontal', // Required for Material Bar Charts.
          hAxis: {format: 'decimal'},
          height: 400,
          colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

        var btns = document.getElementById('btn-group');

        btns.onclick = function (e) {

          if (e.target.tagName === 'BUTTON') {
            options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
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


</div>
 </body>



</html>
