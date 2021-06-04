<?php


function get_prj_call_status($bank_name_get)
{
    include 'db.php';
    
    
        $row_data=$bank_name_get;
        $get_prj_sts='SELECT * FROM call_table where prj_name="'.$row_data.'"' ;
        $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
        $call_count= mysqli_num_rows($get_prj_sts_res);
        $output_data=$call_count;
        
    
    return $output_data;

}

function get_prj_call_status_pend($bank_name_get)
{
    include 'db.php';
    
    
        $row_data=$bank_name_get;
        $get_prj_sts='SELECT * FROM call_table where prj_name="'.$row_data.'" AND status="PENDING"' ;
        $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
        $call_count= mysqli_num_rows($get_prj_sts_res);
        $output_data=$call_count;
        
    
    return $output_data;

}

function get_prj_call_status_closed($bank_name_get)
{
    include 'db.php';
    
    
        $row_data=$bank_name_get;
        $get_prj_sts='SELECT * FROM call_table where prj_name="'.$row_data.'" AND status="CLOSED"' ;
        $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
        $call_count= mysqli_num_rows($get_prj_sts_res);
        $output_data=$call_count;
        
    
    return $output_data;

}


//---------------------------------------------------------------------------------------------------

function get_prj_call_status_all()
{
    include 'db.php';
    
    
        
        $get_prj_sts='SELECT * FROM call_table ' ;
        $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
        $call_count= mysqli_num_rows($get_prj_sts_res);
        $output_data=$call_count;
        
    
    return $output_data;

}

function get_prj_call_status_pend_all()
{
    include 'db.php';
    
    
       
        $get_prj_sts='SELECT * FROM call_table where  is_eng_closed=0 and is_ass=1' ;
        $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
        $call_count= mysqli_num_rows($get_prj_sts_res);
        $output_data=$call_count;
        
    
    return $output_data;

}
function get_call_not_ass_sts()
{
    include 'db.php';
    
    
       
        $get_prj_sts='SELECT * FROM call_table where is_ass=0' ;
        $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
        $call_count= mysqli_num_rows($get_prj_sts_res);
        $output_data=$call_count;
        
    
    return $output_data;

}

function get_prj_call_status_closed_all()
{
    include 'db.php';
    
    
        
        $get_prj_sts='SELECT * FROM call_table where status="CLOSED"' ;
        $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
        $call_count= mysqli_num_rows($get_prj_sts_res);
        $output_data=$call_count;
        
    
    return $output_data;

}

function get_eng_status($eng_ref)
{
    include 'db.php';
    
    
        
    $get_prj_sts='SELECT * FROM call_table where is_eng_closed=0 and eng_ass="'.$eng_ref.'"' ;
    $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
    $call_count= mysqli_num_rows($get_prj_sts_res);
    $output_data=$call_count;
    

return $output_data;

}


function get_eng_status_closed($eng_ref)
{
    include 'db.php';
    
    
        
    $get_prj_sts='SELECT * FROM call_table where  is_eng_closed=1 and eng_ass="'.$eng_ref.'"' ;
    $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
    $call_count= mysqli_num_rows($get_prj_sts_res);
    $output_data=$call_count;
    

return $output_data;

}



function get_eng_count()
{
    include 'db.php';
    
    
        
    $get_prj_sts='SELECT * FROM eng' ;
    $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
    $call_count= mysqli_num_rows($get_prj_sts_res);
    $output_data=$call_count;
    

return $output_data;

}

function get_prj_count()
{
    include 'db.php';
    
    
        
    $get_prj_sts='SELECT DISTINCT bank_name FROM `bank`' ;
    $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
    $call_count= mysqli_num_rows($get_prj_sts_res);
    $output_data=$call_count;
    

return $output_data;

}

function no_of_calls_not_verified_by_cc()
{
    include 'db.php';
    
    
        
    $get_prj_sts='SELECT * FROM call_table where status="PENDING" and is_eng_closed=1' ;
    $get_prj_sts_res=mysqli_query($con,$get_prj_sts);
    $call_count= mysqli_num_rows($get_prj_sts_res);
    $output_data=$call_count;
    

return $output_data;

}







?>