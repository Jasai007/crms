<?php
 $er_break="";
		if (isset($_POST['add5'])) {
			if (empty($_POST['liftcoach'])) {
				$er_break="PLease select a coach from lift shop!!";
			}
			else
			{
	    	require_once('connection.php');
			$cno=$_POST['liftcoach'];

			$que=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id FROM `lifting` where `coach_no`= '$cno'");
			if (!$que) {
				die('could not fetch data from lifting');
			}
			else{
							echo "<script type='text/javascript'> alert('control goes to php')</script>";

				$coach_info=mysqli_fetch_assoc($que);
			    $id=$coach_info['reg_id'];
				$tdate=date("Y-m-d");
				$query=mysqli_query($conn,"INSERT INTO `break_shop` (`reg_id`,`coach_no`,`break_in`) VALUES ('$id','$cno','$tdate') ");
				if (!$query) {
					die();
				}
				else{
					$quer=mysqli_query($conn,"UPDATE `lifting` SET `lift_out`= '$tdate' WHERE `reg_id`='$id'");
					if (!$quer) {
						die('could not update in lifting');
					}
					else
					{
						header('Location:newmain.php');
					}
				}	
			}
			mysqli_close($conn);
			}	
		}
 ?>

  <?php 
$er_back4="";
	if (isset($_POST['minus5'])) {
		if (empty($_POST['breakcoach'])) {
			$er_back4="PLease select a coach from break shop";
		}
		else
		{
			require_once('connection.php');
			$cono=$_POST['breakcoach'];
			$query=mysqli_query($conn,"SELECT MAX(`reg_id`)  FROM `break_shop` where `coach_no`= '$cono'");
			if (!$query) {
				die('could not fetch data from break shop for back action');
			}
			else
			{
				$info=mysqli_fetch_assoc($query);
				$id=$info['MAX(`reg_id`)'];
				$del=mysqli_query($conn,"DELETE FROM `break_shop` WHERE `reg_id`='$id'");
				if (!$del) {
					die('could not delete from break shop table');
				}
				else
				{
					$del2=mysqli_query($conn,"UPDATE `lifting` SET `lift_out`= NULL WHERE `reg_id`='$id'");
					if (!$del2) {
						die('could not reback in lifting');
					}
					else
					{
						header('Location:newmain.php');
					}
				}
			}
		}	
	}

 ?>