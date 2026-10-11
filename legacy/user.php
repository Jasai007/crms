
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>USER DETAILS</title>
	<script  src="SpryAssets/SpryMenuBar.js" type="text/javascript">
		function printContent(el){
		var restorepage=document.body.innerHTML;
		var printcontent=document.getElementById(el).innerHTML;
		document.body.innerHTML=printcontent;
		window.print();
		document.body.innerHTML=restorepage;
	}
	</script>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<style type="text/css">
			h1{background-color: #000066;color:white; margin-left: 100px;margin-right: 100px; border-radius: 10px;}
 			h2.nm{background-color: #000066;color:white; margin-left: 500px;margin-right: 500px; border-radius: 10px;}
 		    select.usertbl{height: 50px;}
 			p.b1{background-color: #000066; margin-left: 635px; margin-right: 635px; border-radius: 7px;border-style: outset;}
 			form{width:95% ; border-style: ridge;border-color: #000066;border-width: 7px;}
 			table{width:30% ; border-style: ridge;border-color: #000066;border-width: 7px;}
 			input[type=submit]{
 				font-weight: bold;
 				border-radius: 7px;
 				float: center;
 				background-color: #3498DB ;
 				color:white;
 				border-style: solid;
 				border-color: #000066;
 				border-width: 3px;}
 			h3.scss{color: #000066;}
 			h3.dngr{color: #000066;}
 		
			.a{ margin-left: 100px; margin-right: 100px;background-color:#000066;border-radius:10px;}
 	
 	        .openBtn {
 	        	 margin-left: 580px;
                 background: #f1f1f1;
                 border: none;
                 padding: 10px 15px;
                 font-size: 20px;
                 cursor: pointer;
                     }

            .openBtn:hover {
                 background: #bbb;
                     }

            .overlay {
                 height: 100%;
                 width: 100%;
                 display: none;
                 position: fixed;
                 z-index: 1;
                 top: 0;
                 left:;
                 background-color: rgb(0,0,0);
                 background-color: rgba(0,0,0, 0.9);
                      }

            .overlay-content {
                 position: relative;
                 top:20%;
                 width: 80%;
                 text-align: center;
                 margin-top: 30px;
                 margin: auto;
                              }

            .overlay .closebtn {
                 position: absolute;
                 top: 20px;
                 right: 45px;
                 font-size: 60px;
                 cursor: pointer;
                 color: white;
                                 } 

.overlay .closebtn:hover {
  color: #ccc;
}

.overlay input[type=text] {
  padding: 15px;
  font-size: 17px;
  border: none;
  border-color: #000000;
  float: center;
  width: 80%;
  background: white;
}

.overlay input[type=text]:hover {

  background: #f1f1f1;
}

.overlay button {
  float: center;
  width: 20%;
  padding: 15px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.overlay button:hover {
  background: #bbb;
}	

 		</style>
 	</head>

<body bgcolor="#FFFFFF">
<div class="a">
<h1 align="center"><strong>USER</strong></h1>
</div>

<div id="myOverlay" class="overlay">
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
  <div class="overlay-content">
    <form  action="" method="POST" style="border-width: 0" >


    <table width=60% height="300"  align="center"  cellpadding="2" cellspacing="3" >
         
      
      <tr>
   
      <td><input name='id' type='text' placeholder="ID" ></td>
           
      </tr>
          <tr>
     
      <td><input name='username' type='text' placeholder="USERNAME" ></td>
          
      </tr>
          <tr>
          
        <td><input name='email' type='text' placeholder="E MAIL" ></td>
          
      </tr>
      <tr>
     
      <td><input name='firstname' type='text' placeholder="FIRST NAME" ></td>
           
      </tr>
      <tr>
      
      <td><input name='lastname' type='text' placeholder="LAST NAME" ></td>
           
      </tr>
      <tr>
     
      <td><input name='doj' type='date' placeholder="date of joining" ></td>
            
      </tr> 
      <tr>
      
      </tr>
                </table>
      <button type="submit" name="queue9"><i class="fa fa-search"></i></button>	
    </form>
  </div>
</div>
<p class='b1' align="center"><a href="newmain.php"><b><font color="white">BACK</font></b></a></p>

<button align="center" class="openBtn" onclick="openSearch()">Open Search Box</button>

<script>
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
</script>


<div align="margin-left">
<p>&nbsp;&nbsp;&nbsp;&nbsp;</p>
	<br>
	<div style="display: flex;">

    	 <table width=40%  cellpadding="5"  cellspacing="2" align="center">
    	 	<form action="insert_user.php" method="POST">
         <tr>
            <td colspan="2" align="center"> <h2><strong>ADD USER</strong></h2></td>
         </tr>
         </tr>
         <tr>
       			<td align="right"> <strong>USER LEVEL:</strong></td>
                <td><select name="userlevel"required>
                <option></option>
                <option value=1>Admin</option>
				<option value=2>General user</option>
			    </select>
			    </td>
         </tr>
		 <tr>
			    <td width="47%" align="right"> <strong>USER NAME:</strong></td>
			    <td width="53%"><input name='User_Name' type='text' maxlength="8" minlength="7" required></td>
		 </tr>
		 <tr>
			    <td align="right"> <strong>PASSWORD:</strong></td>		
			    <td><input name='Password' type='password' maxlength="8"  required></td>
		 </tr>
		 <tr>
		     	<td align="right"> <strong>EMAIL:</strong></td>
			    <td><input name='Email' type='email' required></td>
		 </tr>
		 <tr>
			    <td align="right"> <strong>FIRST NAME:</strong></td>
			    <td><input name='F_Name' type='text' maxlength="8"  required></td>
		 </tr>
		 <tr>
			    <td align="right"> <strong>LAST NAME:</strong></td>
			    <td><input name='L_Name' type='text' maxlength="8"  required ></td>
		 </tr>	
		 <tr>
			    <td align="right"> <strong>DATE OF JOINING: </strong></td>
			    <td><input name='DOJ' type='date'  required></td>
		 </tr>
		 <tr>
			    <td align="center" colspan="2" ><input type='submit' value='SUBMIT' name='submit'></td>
		 </tr>
		 <tr>
	
		 </tr>
		 </form>
		 </table>
   
<p>&nbsp;&nbsp;&nbsp;</p>
<div>
	
	<?php 
	require_once('connection.php');
	$date=date("Y-m-d");
	$que1=mysqli_query($conn,"SELECT * FROM `user`")	
 ?>
	<form action="delete_user.php" method="post" form-group >
				<div  class="subject-info-box-1">
					<h2><label class="control-label">LIST OF MEMBERS</label></h2>
					<div style="display: flex;">
					<select multiple class="form-control" id="usertbl" name="usertbl" id="lstBox1" style="height: 250px" required>
						<option disabled>USER NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-MAIL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIRST NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LAST NAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATE OF JOINING&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USER LEVEL</option>
                            <?php
								while ($row=mysqli_fetch_array($que1)):;
								?>
								<option value="<?php echo $row[0];?>" >

                                        
									   
										<?php echo $row[1];?>
										<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
										
										<?php echo $row[6];?>
										<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
										<?php echo $row[4];?>
										<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
										<?php echo $row[5];?>
										<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
										<?php echo $row[7];?>
										<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
										<?php echo $row[3];?>
										<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                                </option>
							<?php endwhile;  ?>

					</select>
				
				</div>
			</div>
              <p>&nbsp;&nbsp;&nbsp;</p>    
              <div><td align="center"> <input type='submit' value='REMOVE' name='delete'></td></div>
				<p></p>
            </form>
</div>

</div>

<div>
	<?php
    $error= "";
  $value="";
  $search="";
  if(isset($_POST['queue9']))
     {
    require_once("connection.php");
      if($_POST['id'])
    {
      $value = $_POST['id'];
      $search ="id";
    }
    if($_POST['username'])
    {
       $value = $_POST['username'];
     $search = "username";
    }
   
    if($_POST['email'])
    {
       $value = $_POST['email'];
     $search = "email";
    }
    if($_POST['firstname'])
    {
       $value = $_POST['firstname'];
     $search = "firstname";
    }
    if($_POST['lastname'])
    {
       $value = $_POST['lastname'];
     $search = "lastname";
    }
    
    if($_POST['doj'])
    {
       $value = $_POST['doj'];
     $search = "doj";
    }
    $query = "select * from user where $search= '$value'";
    $retval = mysqli_query($conn,$query);
  
    if(! $retval )
     {
        echo "<h3 class='dngr'><p align='center'><b>COULD NOT FETCH DATA!!!</b></p></h3>";
       }
      else
    {
    $num=mysqli_num_rows($retval);
    if($num>0)
      {
        echo"<div id='div1'";
      echo "<br />";
        echo "<table width=80% bgcolor= #f1f1f1 cellpadding='5' cellspacing='2' align='center' border=1px>
          <tr>
        <td align = 'center' colspan='8'><h3> <strong> SEARCH RESULTS </strong></h3></td>   
        </tr>
            <tr>
      <td><strong> ID </strong></td>
        <td><strong> User Name </strong></td>
        <td><strong> Password </strong></td>
        <td><strong> Email </strong></td>
        <td><strong> First Name </strong></td>
        <td><strong> Last Name </strong></td>
        <td><strong> Date Of Joining </strong></td>
        <td><strong> User Level </strong></td>
        </tr>";
       
      $i=0;
      while ($row1=mysqli_fetch_array($retval))
        {
        echo "<tr>";  
        $id=$row1['id'];
        $uname=$row1['username'];
                $pw=$row1['password'];
                $email=$row1['email'];
                $fname=$row1['firstname'];
                $lname=$row1['lastname'];
                $dj=$row1['doj'];
        $ul=$row1['userlevel'];
        
        echo "<td>$id</td>";
        echo "<td>$uname</td>";
        echo "<td>$pw</td>";
        echo "<td>$email</td>";
        echo "<td>$fname</td>";
        echo "<td>$lname</td>";
        echo "<td>$dj</td>";
        echo "<td>$ul</td>";
        echo "</tr>";
        $i++;
        }
        echo"</div>";
      }
      else
      echo "<h3 class='dngr'><p align='center'><b>DATA WITH MATCHING VALUE DOESNOT EXISTS !!</b></p></h3>";
      }
   }
?>
</div>

<div>

</div>
<div>
	
</div>




</body>
</html>