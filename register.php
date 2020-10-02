<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Please Register for enter</title>

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
$er="";
$done="";
	if (isset($_POST['register'])) {
		require_once('connection.php');
		$username=$_POST['username'];
		$password=$_POST['passwd'];
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$email=$_POST['email'];
		$doj=$_POST['doj'];
		$ul=2;
		$qu2=mysqli_query($conn,"SELECT * FROM `user` WHERE `password`=md5('$password') AND `username`='$username'");
		if(!$qu2)
		{
			die();
		}
   		$count = mysqli_num_rows($qu2);
     	 if ($count == 1) {
     	 	$er="not possible";
     	 }
     	 else
     	 {
			$qu1=mysqli_query($conn,"INSERT INTO `user` ( `username`, `password`, `userlevel`, `firstname`, `lastname`, `email`, `doj`) VALUES ( '$username', MD5('$password'), '$ul', '$firstname', '$lastname', '$email', '$doj')");
			if(!$qu1)
			{
				echo 'Not created';
			}
			else
			{
				$done="Registration done!!";
			}
		}
	}



 ?>	

	<img align="left" src="indian_rly_logo.png" height="100" width="100" style="margin-top: 15px;" />
	<img align="right" src="indian_rly_logo.png" height="100" width="100" style="margin-top: 15px;"/>
	<div class="a">
		<h2 style="background-color:#000066; margin-left:100px; margin-right:100px; color: #FFFFFF" align="center"><strong>SOUTH EASTERN RAILWAY WORKSHOP, KHARAGPUR</strong></h1>
		<h1 align="center"><strong>COACH REPAIR AND MANAGEMENT SYSTEM</strong></h1>
	</div>

	<div style="margin:70px 200px 100px 350px;width: 700px;height: 420px; background-color: white;border-width: 20px;border-style: ridge;border-color: #000066;">
		<h3 style="color:black; padding-left: 200px"><b>Register Your Details</b></h3>
		<form action="" method="post" style="font-size: 20px; margin: 20px 20px 5px 50px; color: #000066 ">
			<label>Username:</label>
			<input type="text" name="username" value="" maxlength="8" placeholder="  username" style="width: 150px" required>
			<label>Password:</label>
			<input type="Password" name="passwd" placeholder=" password(8)" value=""  maxlength="8" style="width: 150px" required>
			<label style="margin-top: 15px">Firstname::</label>
			<input type="text" name="firstname" placeholder="" value="" style="width: 400px;margin-left:13px;" required>

			<label style="margin-top: 15px">  lastname::</label>
			<input type="text" name="lastname" placeholder="" value="" style="margin-left:20px;width: 400px" required>

			<label style="margin-top: 15px">  Email::</label>
			<input type="email" name="email" placeholder="" value="" style="margin-left:53px;width: 400px" required>

			<label style="margin-top: 15px">  Date Of Join::</label>
			<input type="date" name="doj" placeholder="" value="" style="margin-left:20px;width: 250px"  required>	
			<span style="color: red;"><?php echo $er;echo $done; ?></span>
			<br/><br/>
			<input type="submit" name="register" class="btn btn-success" value="Register" style="margin-left:50px;width: 150px;height: 50px">
			<input type="reset" class="btn btn-warning" style="margin-left:30px;width: 150px;height: 50px">
			<a href="index.php" class="btn btn-primary" style="margin-left:30px;font-size: 15px; width: 150px;height: 50px">Back</a>  

		</form>
	</div>



</body>
</html>