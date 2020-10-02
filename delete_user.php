<?php 

			if (isset($_POST['delete'])) {
			require_once('connection.php');
			$cono=$_POST['usertbl'];
			$query1=mysqli_query($conn,"SELECT * FROM `user` where `id`= '$cono'");
			if (!$query1 ) {
				die('......');
			}
			else
			{
				$info=mysqli_fetch_assoc($query1);
				$id=$info['id'];
				$del=mysqli_query($conn,"DELETE FROM `user` WHERE `id`='$cono'");
				if (!$del) {
					die('could not delete from user');
				}
				else
				{
					
						header('Location:user.php');
				}
				
			}
		}

		 ?>