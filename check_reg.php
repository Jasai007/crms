
 <?php
 $er_reg="";
	if (isset($_POST['add1'])) {
		if (empty($_POST['regcoach'])) {
			$er_reg="Please select a coach from registered coach";
		}
		else
		{
	    	require_once('connection.php');
			$cno=$_POST['regcoach'];

			$que2=mysqli_query($conn,"SELECT MAX(`reg_id`) as reg_id FROM `coachreg` where `coach_no`= '$cno'");
			if (!$que2) {
				die('could not fetch data from regcoach');
			}
			else{
							echo "<script type='text/javascript'> alert('control goes to php')</script>";

				$coach_info=mysqli_fetch_assoc($que2);
			    $id=$coach_info['reg_id'];
				$tdate=date("Y-m-d");
				$que3=mysqli_query($conn,"INSERT INTO `strip_ins` (`reg_id`,`coach_no`,`strip_in`) VALUES ('$id','$cno','$tdate') ");
				if (!$que3) {
					die();
				}
				else{
					$que4=mysqli_query($conn,"UPDATE `coachreg` SET `shop_in`= '$tdate' WHERE `reg_id`='$id'");
					if (!$que4) {
						die('could not update in coachreg');
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