
 
<?php 
include('db.php');
require('cc_auth.php');
$q="select * from sms_server";
$res=mysqli_query( $con, $q);
$row = mysqli_fetch_array($res);



try{ $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : null; $phoneNumber = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null; if($message !=null && $phoneNumber !=null)
    { 
     $url = "http://".$row['ip'].":".$row['port']."/SendSMS?username=".$row['username']."&password=".$row['password']."&phone=".$phoneNumber."&message=".urlencode($message);
     $curl = curl_init($url);
     curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
     $curl_response = curl_exec($curl); 


      if($curl_response === false)
      {
           $info = curl_getinfo($curl);
            curl_close($curl);
             die('Error occurred'.var_export($info));
       } 

             curl_close($curl); 
             $response = json_decode($curl_response); 
             
             if($response->status == 200){
            
                echo 'sent';
        }else{

            'Technical Problem';
        }
 
    }
}catch(Exception $ex){
    echo '<h1 style="color:red;">RESET SMS SERVER IN YOUR PHONE (CLEAR RECENT APP AND RESTART) AND PRESS F5 TO RESEND<h1>';
    echo '<br/><br/><br/>';
    echo "Exception: ".$ex;
}
//echo $url;
?>