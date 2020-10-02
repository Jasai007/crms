<?php

$er_hour="";
$er_strip="";
$ershop="";

 	if (isset($_POST['add2'])) {
 			//echo "<script type='text/javascript'> alert('control goes to php')</script>";
 		if (empty($_POST['stripcoach'])) {
 			$er_strip="please select a coach from stripping";
 		}
 		else
 		{
 		if (empty($_POST['hours'])){
  			$er_hour = "You didn't enter actual hours required";
		}
		else
		{
			if(empty($_POST['shop']))
			{
				$ershop="You didn't select shop";
			}
			else
			{
	    	require_once('connection.php');
			$cono=$_POST['stripcoach'];
			$hours=$_POST['hours'];
			$shop=$_POST['shop'];
			$que5=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id FROM `strip_ins` where `coach_no`= '$cono'");
			if (!$que5) {
				die('could not fetch data from stripping');
			}
			else{
				$co_info=mysqli_fetch_assoc($que5);
			    $r_id=$co_info['reg_id'];
				$date=date("Y-m-d");
				$a=500;
				$b=1000;
				$s1=25;
				$s2=26;
				$s3=33;
				if($shop==$s1)
				{
					$que6=mysqli_query($conn,"INSERT INTO `pohtable` (`reg_id`,`coach_no`,`shop_in`) VALUES ('$r_id','$cono','$date') ");
					if (!$que6) {
						die();
					}
					else{
						$que7=mysqli_query($conn,"UPDATE `strip_ins` SET `strip_out`= '$date',`actual_hour`='$hours',`shop`='POH',`shop_no`='$s1' WHERE `reg_id`='$r_id'");
						if (!$que7) {
							die('could not update in strip_ins');
						}
						else{
							header('Location:newmain.php#maintain');
						}
					}
				}
				if($shop==$s2)
				{
					$que6=mysqli_query($conn,"INSERT INTO `mcrtable` (`reg_id`,`coach_no`,`shop_in`) VALUES ('$r_id','$cono','$date') ");
					if (!$que6) {
						die();
					}
					else{
						$que7=mysqli_query($conn,"UPDATE `strip_ins` SET `strip_out`= '$date',`actual_hour`='$hours',`shop`='MCR',`shop_no`='$s2' WHERE `reg_id`='$r_id'");
						if (!$que7) {
							die('could not update in strip_ins');
						}
						else{
							header('Location:newmain.php#maintain');
						}
					}
				}
				if($shop==$s3)
				{
					$que6=mysqli_query($conn,"INSERT INTO `hcrtable` (`reg_id`,`coach_no`,`shop_in`) VALUES ('$r_id','$cono','$date') ");
					if (!$que6) {
						die();
					}
					else{
						$que7=mysqli_query($conn,"UPDATE `strip_ins` SET `strip_out`= '$date',`actual_hour`='$hours',`shop`='HCR',`shop_no`='$s3' WHERE `reg_id`='$r_id'");
						if (!$que7) {
							die('could not update in strip_ins');
						}
						else{
							header('Location:newmain.php#maintain');
						}
					}
				}

			}
			mysqli_close($conn);
			}	
		}
		}
	}

 ?>
 <?php 
$strip_back="";
	if (isset($_POST['minus1'])) {
		if (empty($_POST['stripcoach'])) {
			$strip_back="Please select a coach from stripping";
	}
	else
	{
			require_once('connection.php');
			$cono=$_POST['stripcoach'];
			$query5=mysqli_query($conn,"SELECT MAX(`reg_id`)  FROM `strip_ins` where `coach_no`= '$cono'");
			if (!$query5) {
				die('could not fetch data from strip_ins for back action');
			}
			else
			{
				$info=mysqli_fetch_assoc($query5);
				$id=$info['MAX(`reg_id`)'];
				$del=mysqli_query($conn,"DELETE FROM `strip_ins` WHERE `reg_id`='$id'");
				if (!$del) {
					die('could not delete from strip_ins');
				}
				else
				{
					$del2=mysqli_query($conn,"UPDATE `coachreg` SET `shop_in`= NULL WHERE `reg_id`='$id'");
					if (!$del2) {
						die('could not reback in reg');
					}
					else
					{
						header('Location:newmain.php#maintain');
					}
				}
			}
		}
	}
 ?>