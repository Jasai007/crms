<?php 

	$er_done="";
		if (isset($_POST['comp'])) {
			if (empty($_POST['pitcoach'])) {
				$er_done="PLease select a coach from pit line!!";
			}
			else
			{
	    	require_once('connection.php');
			$cno=$_POST['pitcoach'];

			$que=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id FROM `ntxr` where `coach_no`= '$cno'");
			if (!$que) {
				die('could not fetch data from pit line table ');
			}
			else{
							//echo "<script type='text/javascript'> alert('control goes to php')</script>";

				$coach_info=mysqli_fetch_assoc($que);
			    $id=$coach_info['reg_id'];
				$tdate=date("Y-m-d");
				$query=mysqli_query($conn,"INSERT INTO `trafficout` (`reg_id`,`coach_no`,`date_out`) VALUES ('$id','$cno','$tdate') ");
				if (!$query) {
					die();
				}
				else{
					$x='YES';
					$quer=mysqli_query($conn,"UPDATE `ntxr` SET `check_out`= '$tdate',`fit`='$x' WHERE `reg_id`='$id'");
					if (!$quer) {
						die('could not update in ntxr');
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

	$er_last="";
		if (isset($_POST['reback'])) {
			if (empty($_POST['pitcoach'])) {
				$er_last="PLease select a coach from pit line!!";
			}
			else
			{
	    	require_once('connection.php');
			$cno=$_POST['pitcoach'];

			$que9=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id FROM `ntxr` where `coach_no`= '$cno'");
			if (!$que9) {
				die('could not fetch data from pit line table ');
			}
			else{
							//echo "<script type='text/javascript'> alert('control goes to php')</script>";

				$coach_info=mysqli_fetch_assoc($que9);
			    $id=$coach_info['reg_id'];
				$tdate=date("Y-m-d");
				$query=mysqli_query($conn,"INSERT INTO `last_repair` (`reg_id`,`coach_no`,`re_in`) VALUES ('$id','$cno','$tdate') ");
				if (!$query) {
					die();
				}
				else{
					$y='NO';
					$quer=mysqli_query($conn,"UPDATE `ntxr` SET `check_out`= '$tdate',`fit`='$y' WHERE `reg_id`='$id'");
					if (!$quer) {
						die('could not update in ntxr');
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

	$er_move="";
		if (isset($_POST['add7'])) {
			if (empty($_POST['lastcoach'])) {
				$er_move="PLease select a coach from repair shop!!";
			}
			else
			{
					$var=$_POST['done'];
					if($var==1)
					{
					require_once('connection.php');
					$cno=$_POST['lastcoach'];

					$que10=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id FROM `last_repair` where `coach_no`= '$cno'");
					if (!$que10) {
						die('could not fetch data from last_repair ');
					}
					else{
							//echo "<script type='text/javascript'> alert('control goes to php')</script>";

					$coach_info=mysqli_fetch_assoc($que10);
			    	$id=$coach_info['reg_id'];
					$tdate=date("Y-m-d");
					$query=mysqli_query($conn,"INSERT INTO `trafficout` (`reg_id`,`coach_no`,`date_out`) VALUES ('$id','$cno','$tdate') ");
					if (!$query) {
						die();
					}
					else{
					
						$quer=mysqli_query($conn,"UPDATE `last_repair` SET `re_out`= '$tdate' WHERE `reg_id`='$id'");
						if (!$quer) {
							die('could not update in last_repair');
						}
						else
						{
						header('Location:newmain.php#maintain');
						}
					}	
					}
					mysqli_close($conn);
					
				}
				else
				{
					$er_move="Right now working on defects";
				}
			}	
		}
?>

