<?php 
include 'db.php';
	$query = "SELECT DISTINCT spare_cat FROM spares";


    $result = mysqli_query( $con, $query);
    $count_row=mysqli_num_rows($result);
    //$data=mysqli_fetch_assco(0;)
    //echo json_encode($result);
    while ($row = mysqli_fetch_assoc($result)) {

        print_r($row) ;
        echo '<br/>';
        echo 'tabledata.push('.json_encode($row).');';
        
    }


?>