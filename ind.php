<?php
 include('login_valid.php'); // Includes Login Script
if(isset($_SESSION['login_user']))
{
	$i=1;
	if($_SESSION['userlevel']!=$i)
	header("location: newmain2.php");
	else
	{
		header("location: newmain.php");
	}
}
  ?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form </title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">

	.flip-card {
  background-color: transparent;
  width: 700px;
  height: 300px;
  perspective: 1000px;
  margin: 100px 300px 100px;


}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

.flip-card-front {
  background-color: white;
  color: black;
}

.flip-card-back {
  background-color: white;
  color: white;
  transform: rotateY(180deg);
}





	#login{
		border-width: 7px;
		border-style: ridge;
		background-color: #FFFFFF;
		border-color: #000066;
	}
	h2{
		background-color: #FFFFFF;
		font-family:"Times New Roman", Times, serif;
		color: #000066;
	}
	
	input::placeholder{
	color: #000066;
	font-family: "Times New Roman", Times, serifs;
	}
	h1{background-color: #000066;color:white;margin-left: 100px;margin-right: 100px; border-radius: 10px;}
	.a{ margin-left: 100px; margin-right: 100px;background-color:#000066;border-radius:10px;}
body{height:100%;
   width:100%;
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
 <img align="left" src="indian_rly_logo.png" height="100" width="100" />
<img align="right" src="serly_logo.jpg" height="100" width="100" />
<div class="a">
<h2 style="background-color:#000066; margin-left:100px; margin-right:100px; color: #FFFFFF" align="center"><strong>SOUTH EASTERN RAILWAY WORKSHOP, KHARAGPUR</strong></h1>
<h1 align="center"><strong>COACH REPAIR AND MANAGEMENT SYSTEM</strong></h1>
</div>
	<div class="flip-card">
  		<div class="flip-card-inner">
    		<div class="flip-card-front" style="border-width: 7px; border-style: ridge;border-color: #000066;">
				<div style="margin: 100px 200px; font-family: serif;">
					<h2 align="center">To view the Coach details please LOGIN!!!</h2>
					<span style="color: red;"><?php echo $error; ?></span>
				</div>
			</div>	
			<div class="flip-card-back" style="border-width: 7px; border-style: ridge;border-color: #000066;">	
					<form action="" method="post">
						<div align="left" style="margin: 10px 100px;">
						  <input name="username"  placeholder="USERNAME" type="text" size="40" required style="height: 35px;border-width: 4px;font-size: 20px;padding-left: 30px;border-radius: 7px">
						  <br><br>
							<input name="password" placeholder="PASSWORD" type="password" size="40" maxlength="8" style="height: 35px;border-width: 4px;font-size: 20px;padding-left: 30px;border-radius: 7px" required>
  							<br><br>
  							<button name="submit" type="submit"  class="btn " style="cursor:pointer;height: 50px;width:300px;border-width: 4px;font-size: 20px;border-radius: 7px;margin-left: 100px;background-color:#000066;color: white ">LOGIN</button>	
						</div>
					</form>
					<h2>New User!!!!  <a href="Register.php" data-toggle="tooltip" data-placement="bottom" title="Please Register!!!" style="color:#000066;font-size: 20px;">Register</a></h2>
					<a href="forgot.php" data-toggle="tooltip" data-placement="right" title="Don't Worry!!!" >Forgot Password</a>
			</div>
		</div>
	</div>	
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>	
</body>
</html>