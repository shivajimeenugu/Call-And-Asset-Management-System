<?php 


function get_reject_call_count($emp_id)
{
    include 'db.php';
    $query = "SELECT * FROM `call_table` WHERE eng_ass='$emp_id' and  is_rejected=1";
    $result = mysqli_query($con,$query);
    $no_of_calls = mysqli_num_rows($result);
    return $no_of_calls;
}

function get_pending_call_count($emp_id)
{
    include 'db.php';
    $query = "SELECT * FROM `call_table` WHERE eng_ass='$emp_id' and  is_rejected=0 and is_eng_closed=1 and status='PENDING'";
    $result = mysqli_query($con,$query);
    $no_of_calls = mysqli_num_rows($result);
    return $no_of_calls;
}

function get_approved_call_count($emp_id)
{
    include 'db.php';
    $query = "SELECT * FROM `call_table` WHERE eng_ass='$emp_id' and  is_rejected=0 and is_eng_closed=1 and status='CLOSED'";
    $result = mysqli_query($con,$query);
    $no_of_calls = mysqli_num_rows($result);
    return $no_of_calls;
}

function get_call_count($emp_id)
{
    include 'db.php';
    $query = "SELECT * FROM `call_table` WHERE eng_ass='$emp_id' and status='PENDING' and is_eng_closed=0";
    $result = mysqli_query($con,$query);
    $no_of_calls = mysqli_num_rows($result);
    return $no_of_calls;
}
?>