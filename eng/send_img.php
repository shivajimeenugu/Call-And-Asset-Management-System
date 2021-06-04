<?php  
  function base64_encode_image ($filename=string,$filetype=string) {
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }
} 




// Get the image and convert into string 
$img_path = 'C:\xampp\htdocs\call_mgmt\eng\reports_img_db\V2005133365.jpg'; 
  
  
// Display the output 
//echo $data; 
$url2="http://api.telegram.org/bot1123935748:AAF-LAaY7uTdsN1tS6WNoX8q6M45p7XwBT4/sendPhoto?chat_id=-398461547&photo=".base64_encode_image($img_path,'jpg')."";
echo '
<img src="'.base64_encode_image ($img_path,'jpg').'"/>
<br/>
<a href="'.$url2.'">LINK</a>';

?> 