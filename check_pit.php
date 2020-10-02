<?php 

	$er_pit="";
		if (isset($_POST['add6'])) {
			if (empty($_POST['breakcoach'])) {
				$er_pit="PLease select a coach from break shop!!";
			}
			else
			{
	    	require_once('connection.php');
			$cno=$_POST['breakcoach'];

			$que=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id FROM `break_shop` where `coach_no`= '$cno'");
			if (!$que) {
				die('could not fetch data from break_shop');
			}
			else{
							//echo "<script type='text/javascript'> alert('control goes to php')</script>";

				$coach_info=mysqli_fetch_assoc($que);
			    $id=$coach_info['reg_id'];
				$tdate=date("Y-m-d");
				$query=mysqli_query($conn,"INSERT INTO `ntxr` (`reg_id`,`coach_no`,`check_in`) VALUES ('$id','$cno','$tdate') ");
				if (!$query) {
					die();
				}
				else{
					$quer=mysqli_query($conn,"UPDATE `break_shop` SET `break_out`= '$tdate' WHERE `reg_id`='$id'");
					if (!$quer) {
						die('could not update in break_shop');
					}
					else
					{
						header('Location:newmain.php#maintain');
					}
				}	
			}
			mysqli_close($conn);
			}	
		}



?>


 <?php 
$er_back5="";
	if (isset($_POST['minus6'])) {
		if (empty($_POST['pitcoach'])) {
			$er_back5="PLease select a coach !!";
		}
		else
		{
			require_once('connection.php');
			$cono=$_POST['pitcoach'];
			$query=mysqli_query($conn,"SELECT MAX(`reg_id`)  FROM `ntxr` where `coach_no`= '$cono'");
			if (!$query) {
				die('could not fetch data from pit line for back action');
			}
			else
			{
				$info=mysqli_fetch_assoc($query);
				$id=$info['MAX(`reg_id`)'];
				$del=mysqli_query($conn,"DELETE FROM `ntxr` WHERE `reg_id`='$id'");
				if (!$del) {
					die('could not delete from pit line table');
				}
				else
				{
					$del2=mysqli_query($conn,"UPDATE `break_shop` SET `break_out`= NULL WHERE `reg_id`='$id'");
					if (!$del2) {
						die('could not reback in break shop');
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