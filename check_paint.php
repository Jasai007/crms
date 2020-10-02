<?php 
$er_back2="";
	if (isset($_POST['minus3'])) {
		require_once('connection.php');
		if (empty($_POST['paintcoach'])) {
			$er_back2="please select a coach from paint shop";
		}
		elseif (isset($_POST['paintcoach'])) {
			$cno=$_POST['paintcoach'];
			$qup1=mysqli_query($conn,"SELECT MAX(`reg_id`)  FROM `painting` where `coach_no`= '$cno'");
			if (!$qup1) {
				die('could not fetch data from paintshop for back action');
			}
			else
			{
				$rowp1 = mysqli_fetch_array($qup1);
      			$id=$rowp1['MAX(`reg_id`)'];
      			$mcr=mysqli_query($conn,"SELECT MAX(`reg_id`) FROM `mcrtable` where `reg_id`='$id'");
      					if (!$mcr) {
      						die('could not fetch data from mcrtable');
      					}
      					else
      					{
      						$count2=mysqli_num_rows($mcr);
      						if ($count2<1) {
      							
      						}
      						elseif($count2 ==1)
      						{
      							$delm=mysqli_query($conn,"UPDATE `mcrtable` SET `shop_out`= NULL WHERE `reg_id`='$id'");
								if (!$delm) {
									die();
								}
								else
								{
									$del1=mysqli_query($conn,"DELETE FROM `painting` WHERE `reg_id`='$id'");
									if (!$del1) {
										die('could not delete from painting');
									}
									else
									{
										header('Location:newmain.php#maintain');	
									}
								}
      								
      						}
      					}
      					$hcr=mysqli_query($conn,"SELECT MAX(`reg_id`) FROM `hcrtable` where `reg_id`='$id'");
      							if (!$hcr) {
      								die('could not fetch data from hcrtable');
      							}
      							else
      							{
      								$count3=mysqli_num_rows($hcr);
      								if ($count3<1) {
      									die();
      								}
      								elseif ($count3==1)
      								{
      									$delh=mysqli_query($conn,"UPDATE `hcrtable` SET `shop_out`= NULL WHERE `reg_id`='$id'");
										if (!$delh) {
											die('could not reback in hcrtable');
										}
										else
										{
											$del2=mysqli_query($conn,"DELETE FROM `painting` WHERE `reg_id`='$id'");
											if (!$del2) {
												die('could not delete from painting');
											}
											else
											{
												header('Location:newmain.php#maintain');	
											}
										}
      								}
      							}
      			$poh=mysqli_query($conn,"SELECT MAX(`reg_id`) FROM `pohtable` where `reg_id`='$id'");
      			if (!$poh) {
      				die('could not fetch data from pohtable');
      			}
      			else
      			{
      				$count1 = mysqli_num_rows($poh);
      				if ($count1<1) {
      					die();
      				}
      				elseif ($count1==1) {
      					$delpoh=mysqli_query($conn,"UPDATE `pohtable` SET `shop_out`= NULL WHERE `reg_id`='$id'");
						if (!$delpoh) {
							die('could not reback in pohtable');
						}
						else
						{
							$delp=mysqli_query($conn,"DELETE FROM `painting` WHERE `reg_id`='$id'");
							if (!$delp) {
								die('could not delete from painting');
							}
							else
							{
								header('Location:newmain.php#maintain');	
							}
						}
      				}
      			}


			}
		}
	}



 ?>