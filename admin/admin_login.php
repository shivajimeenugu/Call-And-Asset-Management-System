<?php

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php @include 'header.php';?>



<?php
	require('db.php');
	
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
	//Checking is user existing in the database or not
    $query = "SELECT * FROM `cc_users` WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($con,$query) or die(mysqli_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
			$_SESSION['admin_username'] = $username;
			header("Location:index.php"); // Redirect user to index.php
            }
    }
?>
<div class="form">


<body>
<!--<marquee>THE STUDENT LOGING IS AVAILABLE  SOON -Admin</marquee>-->
<div class="w3-container">
<center><h2>  Click Here To Login...</h2></center>
<center><p  id="mobileordesktop"></p></center>
<script type="text/javascript">
		var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
		var element = document.getElementById('mobileordesktop');
		if (isMobile) {
  			element.innerHTML = "<div class='w3-animate-fading w3-red'>MOBILE DETECTED MUST USE GOOGLE CHROME APP</div>";
		} else {
			element.innerHTML = "<div class='w3-animate-fading w3-red'>DESKTOP DETECTED BETTER TO USE CHROME</div>";
		}
	</script>
<center><button align="center" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-large" style="width:auto;"> Login</button></center>
<br/>
<center><button align="center" onclick="window.location.href='/call_mgmt'" class="w3-button w3-blue w3-large" style="width:auto;"> GO TO HOME</button></center>

<br/>





<div id="id01" class="w3-modal w3-animate-opacity">
  <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  
    <div class="w3-center">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      <img src="logo.png"  alt="Avatar" class="w3-circle w3-margin-top">
    </div>
<form class="w3-container" method="POST">
    <div class="w3-container">
      <label for="uname"><b>Enter User Name </b></label>
    <input type="text" name="username" required class="w3-input w3-border w3-margin-bottom" placeholder="Enter Username" name="username" required>
	 <!-- <select class="w3-input w3-border w3-margin-bottom" name="username" required>
	<option value="">SELECT BRANCH</option>  
<option value="DCME">DCME</option>
  <option value="DECE">DECE</option>
  <option value="DEEE">DEEE</option>
  <option value="DME">DME</option>
</select>-->

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" class="w3-input w3-border w3-margin-bottom" name="password" required>
        
      <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
     
    </div>
</form>
    <div class="w3-container w3-border-top w3-padding-16 w3-light-grey" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-red">Cancel</button>
	  <!--<span class="psw">  not register  <a href="#">Click Here!</a></span>-->
    </div>
    
  
  </div>
</div>
</div>



















































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

</body>
</form>


<br /><br />

</div>



</body>
<?php include 'footer.php';?>


</html>
