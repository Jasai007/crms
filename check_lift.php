
 <?php
 $er_lift="";
		if (isset($_POST['add4'])) {
			if (empty($_POST['paintcoach'])) {
				$er_lift="PLease select a coach from paint shop!!";
			}
			else
			{
	    	require_once('connection.php');
			$cno=$_POST['paintcoach'];

			$que=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id FROM `painting` where `coach_no`= '$cno'");
			if (!$que) {
				die('could not fetch data from painting');
			}
			else{
							echo "<script type='text/javascript'> alert('control goes to php')</script>";

				$coach_info=mysqli_fetch_assoc($que);
			    $id=$coach_info['reg_id'];
				$tdate=date("Y-m-d");
				$query=mysqli_query($conn,"INSERT INTO `lifting` (`reg_id`,`coach_no`,`lift_in`) VALUES ('$id','$cno','$tdate') ");
				if (!$query) {
					die();
				}
				else{
					$quer=mysqli_query($conn,"UPDATE `painting` SET `paint_out`= '$tdate' WHERE `reg_id`='$id'");
					if (!$quer) {
						die('could not update in painting');
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
$er_back3="";
	if (isset($_POST['minus4'])) {
		if (empty($_POST['liftcoach'])) {
			$er_back3="PLease select a coach from lift shop";
		}
		else
		{
			require_once('connection.php');
			$cono=$_POST['liftcoach'];
			$query=mysqli_query($conn,"SELECT MAX(`reg_id`)  FROM `lifting` where `coach_no`= '$cono'");
			if (!$query) {
				die('could not fetch data from lifting for back action');
			}
			else
			{
				$info=mysqli_fetch_assoc($query);
				$id=$info['MAX(`reg_id`)'];
				$del=mysqli_query($conn,"DELETE FROM `lifting` WHERE `reg_id`='$id'");
				if (!$del) {
					die('could not delete from lift table');
				}
				else
				{
					$del2=mysqli_query($conn,"UPDATE `painting` SET `paint_out`= NULL WHERE `reg_id`='$id'");
					if (!$del2) {
						die('could not reback in painting');
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