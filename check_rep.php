<?php
$er_coach="";

	if (isset($_POST['add3'])) {
		if (empty($_POST['pohcoach']) && empty($_POST['mcrcoach']) && empty($_POST['hcrcoach'])){
  			$er_coach = "please select one coach from shops";
		}
		if (isset($_POST['pohcoach'])) {
			
			require_once('connection.php');
		
				$cn=$_POST['pohcoach'];
				$date=date("Y-m-d");
				$qu1=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id  FROM `pohtable` where `coach_no`='$cn'");
				if(!$qu1)
				{
					die('could not fetch data from pohtable');
				}
				else
				{
					$c_info=mysqli_fetch_assoc($qu1);
					$rid=$c_info['reg_id'];
					$qu2=mysqli_query($conn,"INSERT INTO `painting`(`reg_id`,`coach_no`,`paint_in`) VALUES ('$rid','$cn','$date')");
					if (!$qu2) {
						die('could not insert data in painting');
					}
					else
					{
						$qu3=mysqli_query($conn,"UPDATE `pohtable` SET `shop_out`='$date' WHERE `reg_id`='$rid'");
						if (!$qu3) {
							die('could not update pohtable');
						}
						else{
							header('Location:newmain.php');
						}
					}
				}
			mysqli_close($conn);
		}
		elseif (isset($_POST['mcrcoach'])) {
			
			require_once('connection.php');
			
				$cn=$_POST['mcrcoach'];
				$date=date("Y-m-d");
				$qu1=mysqli_query($conn,"SELECT MAX(`reg_id`)  FROM `mcrtable` where `coach_no`='$cn'");
				if(!$qu1)
				{
					die('could not fetch data from mcrtable');
				}
				else
				{
					$c_info=mysqli_fetch_assoc($qu1);
					$rid=$c_info['MAX(`reg_id`)'];
					$qu2=mysqli_query($conn,"INSERT INTO `painting`(`reg_id`,`coach_no`,`paint_in`) VALUES ('$rid','$cn','$date')");
					if (!$qu2) {
						die('could not insert data in painting');
					}
					else
					{
						$qu3=mysqli_query($conn,"UPDATE `mcrtable` SET `shop_out`='$date' WHERE `reg_id`='$rid'");
						if (!$qu3) {
							die('could not update mcrtable');
						}
						else{
							header('Location:newmain.php#maintain');
						}
					}
				}
				mysqli_close($conn);
		}
		elseif (isset($_POST['hcrcoach'])) {
			
			require_once('connection.php');
		
				$cn=$_POST['hcrcoach'];
				$date=date("Y-m-d");
				$qu1=mysqli_query($conn,"SELECT MAX(`reg_id`)  FROM `hcrtable` where `coach_no`='$cn'");
				if(!$qu1)
				{
					die('could not fetch data from hcrtable');
				}
				else
				{
					$c_info=mysqli_fetch_assoc($qu1);
					$rid=$c_info['MAX(`reg_id`)'];
					$qu2=mysqli_query($conn,"INSERT INTO `painting`(`reg_id`,`coach_no`,`paint_in`) VALUES ('$rid','$cn','$date')");
					if (!$qu2) {
						die('could not insert data in painting');
					}
					else
					{
						$qu3=mysqli_query($conn,"UPDATE `hcrtable` SET `shop_out`='$date' WHERE `reg_id`='$rid'");
						if (!$qu3) {
							die('could not update hcrtable');
						}
						else{
							header('Location:newmain.php#maintain');
						}
					}
				}
			mysqli_close($conn);
		}
		
	} 
 ?>
 <?php 
 $er_back="";
	if (isset($_POST['minus2'])) {
			require_once('connection.php');
		if (empty($_POST['pohcoach']) && empty($_POST['mcrcoach']) && empty($_POST['hcrcoach'])){
  			$er_back = "please select one coach from any of three shop!!";
		}
		else
		{
			if (isset($_POST['hcrcoach'])) {
				$no=$_POST['hcrcoach'];
				$q1=mysqli_query($conn,"SELECT MAX(`reg_id`)  FROM `hcrtable` where `coach_no`= '$no'");
				if (!$q1) {
					die('could not fetch data from hcrtable for back action');
				}
				else
				{
					$info=mysqli_fetch_assoc($q1);
					$id=$info['MAX(`reg_id`)'];
					$del1=mysqli_query($conn,"DELETE FROM `hcrtable` WHERE `reg_id`='$id'");
					if (!$del1) {
					die('could not delete from hcrtable');
					}
					else
					{
						$del3=mysqli_query($conn,"UPDATE `strip_ins` SET `strip_out`= NULL, `actual_hour`=NULL,`shop`=NULL,`shop_no`=NULL WHERE `reg_id`='$id'");
						if (!$del3) {
						die('could not reback in strip_ins');
						}
						else
						{
						header('Location:newmain.php#maintain');
						}
					}
				}
			}
			elseif(isset($_POST['mcrcoach'])) {
				//echo "<script type='text/javascript'> alert('control goes to php')</script>";
				$cno=$_POST['mcrcoach'];
				$q2=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id FROM `mcrtable` where `coach_no`= '$cno'");
				if (!$q2) {
					die('could not fetch data from mcrtable for back action');
				}
				else
				{
					$info=mysqli_fetch_array($q2);
					$id=$info['reg_id'];
					$del4=mysqli_query($conn,"DELETE FROM `mcrtable` WHERE `reg_id`='$id'");
					if (!$del4) {
					die('could not delete from mcrtable');
					}
					else
					{
						$del5=mysqli_query($conn,"UPDATE `strip_ins` SET `strip_out`= NULL, `actual_hour`=NULL,`shop`=NULL,`shop_no`=NULL WHERE `reg_id`='$id'");
						if (!$del5) {
						die('could not reback in strip_ins');
						}
						else
						{
						header('Location:newmain.php#maintain');
						}
					}
				}
			  }
			

			elseif (isset($_POST['pohcoach'])) {
				$co=$_POST['pohcoach'];
				$q3=mysqli_query($conn,"SELECT MAX(`reg_id`)  FROM `pohtable` where `coach_no`= '$co'");
				if (!$q3) {
					die('could not fetch data from pohtable for back action');
				}
				else
				{
					$info=mysqli_fetch_assoc($q3);
					$id=$info['MAX(`reg_id`)'];
					$del6=mysqli_query($conn,"DELETE FROM `pohtable` WHERE `reg_id`='$id'");
					if (!$del6) {
					die('could not delete from pohtable');
					}
					else
					{
						$del7=mysqli_query($conn,"UPDATE `strip_ins` SET `strip_out`= NULL, `actual_hour`=NULL,`shop`=NULL,`shop_no`=NULL WHERE `reg_id`='$id'");
						if (!$del7) {
						die('could not reback in strip_ins');
						}
						else
						{
						header('Location:newmain.php#maintain');
						}
					}
				}
			}
			
			elseif (isset($_POST['pohcoach']) && isset($_POST['mcrcoach']) && isset($_POST['hcrcoach'])) {
					$er_back= "select only one coach at a time";
				}
		}	
	}

 ?>