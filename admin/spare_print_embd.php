<?php 
include 'db.php';
?>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome Home</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#spare_table").table2excel({
                filename: "Table.xls"
            });
        });
    });
</script>
</head>




<div class="w3-container w3-animate-right" id="main">
             
             <br/>
<br/>
<input  type="button" id="btnExport" value="Export Data To Excel" /><br/>
<table id="spare_table" style="border-collapse: collapse; border: 1px solid black;" class="w3-table-all">
    <thead>
             <tr>
                <th>CATGEORY</th>
                <th>SPARE NAME</th>
                <th>SPEC DETAILS</th>
                <th>BRAND</th>
                <th>LOG DATE</th>
                <th>TOTAL QUANTITY</th>
                <th>CONSUMED QUANTITY</th>
                <th>AVAILABLE QUANTITY</th>
            </tr>
    </thead>
    <tbody>
    <?php
    $color_class=array();
    array_push($color_class,"w3-red","w3-purple","w3-indigo","w3-light-blue","w3-aqua","w3-green","w3-lime","w3-khaki","w3-amber","w3-deep-orange","w3-brown","w3-pale-red");
    $query="SELECT DISTINCT spare_cat FROM spares";
    $result = mysqli_query( $con, $query);
    $row_count=mysqli_num_rows($result);			
    while($row = mysqli_fetch_array($result))
	{
        $color_select_index=random_int ( 0 ,11);
        $scat=$row['spare_cat'];
        $q_sname="SELECT DISTINCT spare_name FROM spares where spare_cat='$scat'";
        $result_sname = mysqli_query( $con, $q_sname);
        $row_count_sname=mysqli_num_rows($result_sname);
        $row_count_sname=$row_count_sname+1;
		echo'<tr class="w3-hover-grey ">';
             $flag=1;   
        echo '<td rowspan="'.$row_count_sname.'" style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$scat.'</center></td>';
        while($row_sname = mysqli_fetch_array($result_sname))
	    {
           
            $sname=$row_sname['spare_name'];
            $q_sname_count="SELECT * FROM spares where spare_cat='$scat' and spare_name='$sname'";
            $result_sname_count = mysqli_query( $con, $q_sname_count);
            $row_count_sname_count=mysqli_num_rows($result_sname_count);

            //CONSUMED QUERY
            $q_sname_count_cons="SELECT * FROM spares where spare_cat='$scat' and spare_name='$sname' and is_used=1";
            $result_sname_count_cons = mysqli_query( $con, $q_sname_count_cons);
            $row_count_sname_count_cons=mysqli_num_rows($result_sname_count_cons);

             //ava QUERY
             $q_sname_count_ava="SELECT * FROM spares where spare_cat='$scat' and spare_name='$sname' and is_used=0";
             $result_sname_count_ava = mysqli_query( $con, $q_sname_count_ava);
             $row_count_sname_count_ava=mysqli_num_rows($result_sname_count_ava);









            $row_sname_count = mysqli_fetch_array($result_sname_count);
            $spec=$row_sname_count['spare_spec'];
            $brand=$row_sname_count['spare_brand'];
            $log_date=$row_sname_count['log_date'];
            if($flag==1)
            {
                echo '<tr><td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$sname.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$spec.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$brand.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$log_date.'</center></td>

                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$row_count_sname_count.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$row_count_sname_count_cons.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$row_count_sname_count_ava.'</center></td>
                
                </tr>';
               
           
            }
            else{
                echo '<tr><td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$sname.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$spec.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$brand.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$log_date.'</center></td>

                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$row_count_sname_count.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$row_count_sname_count_cons.'</center></td>
                <td  style="border: 1px solid black;" class="'.$color_class[$color_select_index].'"><center>'.$row_count_sname_count_ava.'</center></td>
                
                </tr>';
           
            }
            
            
            $flag++;
        }
        echo '</tr>';
    }
    
				
			
			
			?>

    

    </tbody>
</table>












</div>


 
