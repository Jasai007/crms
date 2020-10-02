<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>



	<script src="js/jquery-1.10.2.js"></script>
  	<script src="js/bootstrap.js"></script>
  	<script src="js/jquery.selectlistactions.js"></script>
  
  	<link rel="stylesheet" href="css/bootstrap.css">
  	<link rel="stylesheet" href="css/site.css">

  	<style type="text/css">
  		h1{background-color: #000066;color:white;margin-left: 100px;margin-right: 100px; border-radius: 10px;}
		h2{color: #FFFFFF;background-color: #000066;margin-left: 500px;margin-right: 500px; border-radius: 10px;}

		.a{ margin-left: 100px; margin-right: 100px;background-color:#000066;border-radius:10px;}

   body{
   	height:100%;
   width:100%;
    font-family: Arial, Helvetica, sans-serif;
   background-image:url(img3.jpg);/*your background image*/  
   background-repeat:no-repeat;/*we want to have one single image not a repeated one*/  
   background-size:cover;/*this sets the image to fullscreen covering the whole screen*/  
   /*css hack for ie*/     
   filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='.image.jpg',sizingMethod='scale');
   -ms-filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='image.jpg',sizingMethod='scale')";
	}
  	</style>
</head>
<body>
	<?php
	$error=""; 
		if (isset($_POST['send'])) {
			require_once('connection.php');
			$username=$_POST['username'];
			$password=$_POST['password'];
			$username=mysqli_real_escape_string($conn,$username);
			$query=mysqli_query($conn,"SELECT * FROM `user` where `username`='$username'");
			if (!$query) {
				die('could not fetch data from user');
			}
			$countuser= mysqli_num_rows($query);
			if ($countuser<1) {
				$error="No user registered with this username.";
			}
			if ($countuser==1) {
				$rowuser=mysqli_fetch_array($query);
				$uid=$rowuser['id'];
				$q1=mysqli_query($conn,"UPDATE `user` SET `password`=md5('$password') where `id`='$uid'");
				if (!$q1) {
					$error="could not update password";
				}
				else{
						$error="password updated";
					}
			}
				
			
		}

	 ?>

	<img align="left" src="indian_rly_logo.png" height="90" width="100" style="margin-top: 20px;border-radius: 10px" />
	<img align="right" src="indian_rly_logo.png" height="90" width="100" style="margin-top: 20px;border-radius: 10px"/>
	<div class="a">
		<h2 style="background-color:#000066; margin-left:100px; margin-right:100px; color: #FFFFFF" align="center"><strong>SOUTH EASTERN RAILWAY WORKSHOP, KHARAGPUR</strong></h1>
		<h1 align="center"><strong>COACH REPAIR AND MANAGEMENT SYSTEM</strong></h1>
	</div>
	<div style="margin:90px 300px 100px 380px;width: 550px;height: 280px; background-color: white;border-width: 12px;border-style: ridge;border-color: #000066;">
		<h3 align="center">Provide Your details</h3>
		<form action="" method="post">
			<input type="text" name="username" placeholder="username" style="margin-left: 70px;margin-top: 25px;padding-left: 25px;height: 50px;border-width: 5px;border-style: ridge;border-color: #b9c9c2;font-size: 20px" required>
			<input type="password" name="password" placeholder=" New password" style="margin-left: 70px;margin-top: 25px;padding-left: 25px;height: 50px;border-width: 5px;border-style: ridge;border-color: #b9c9c2;font-size: 20px" required>
			<input type="submit" class="btn btn-success" name="send" value="SEND" style="margin-left: 20px">
			<a href="index.php" class="btn btn-warning">Back</a>
		</form>
		<span style="margin-left: 150px;color: green; font-size: 15px;margin-top: 40px;"><?php echo $error; ?></span>
	</div>

</body>
</html>