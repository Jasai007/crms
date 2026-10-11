<?php
 	if(isset($_POST['submit'])){
	     require_once ('connection.php');
		 $u_ul    = $_POST['userlevel'];
 	     $u_name  = $_POST['User_Name'];
	     $u_psw   = $_POST['Password'];
	     $u_email = $_POST['Email'];
	     $u_fnm   = $_POST['F_Name'];
	     $u_lnm   = $_POST['L_Name'];
	     $u_doj   = $_POST['DOJ'];
	     
		 
	         $query4 = "INSERT into `user` (username, password, userlevel, email, firstname,lastname,doj) values ('$u_name',md5('$u_psw'),'$u_ul', 
			 '$u_email','$u_fnm','$u_lnm','$u_doj')";
		     $retval = mysqli_query($conn,$query4);
		     if(!$retval ){
	             die('Could not enter data:' . mysql_error());
			 }
			 if ($retval){
    		     echo "<script type='text/javascript'>alert<h3 class='scss'><p align='center'><b>USER ADDED SUCCESSFULLY!!!</b></p></h3></script>";
	  		     header('location:user.php');
	  	     }
        
	  	mysqli_close($conn);
	 }
?>