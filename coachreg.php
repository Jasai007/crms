
<title>coach registration</title>
<style type="text/css">
 			h1{background-color: #000066;color:white;margin-left: 100px;margin-right: 100px; border-radius: 10px;}
 			h2.nm{background-color: #000066;color:white;margin-left: 500px;margin-right: 500px; border-radius: 10px;}
 			p.b1{background-color: #000066;margin-left: 635px;margin-right: 635px; border-radius: 7px;border-style: outset;}
 			form{border-style: ridge;border-color: #000066;border-width: 7px;}
 			input[type=submit]{
 				font-weight: bold;
 				border-radius: 7px;
 				background-color: #000066;
 				color:white;
 				border-width: 3px;
 			}
 			h3.scss{color: #000066;}
 			h3.dngr{color: #000066;}
			h1{background-color: #000066;color:white;margin-left: 100px;margin-right: 100px; border-radius: 10px;}
        	.a{ margin-left: 100px; margin-right: 100px;background-color:#000066;border-radius:10px;}

</style>
</head>
</head>

<body>

 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        
</div>
<div align='center'>
<h1 align="center">COACH REGISTRATION</h1>
<br>
  	<form method="POST" action="">
    	<table width=100%  cellpadding="5"  cellspacing="2" align="center">
         <tr>
       			<td align="right"> <strong>COACH NUMBER</strong></td>
                <td><input type="number" name="coach_no" REQUIRED/></td>
         </tr>
		  <tr>
			<td align="right"> <strong>WORKSHOP IN</strong></td>
			<td><input name='workshop_in' type='date' required></td>
		  </tr>
		  <tr>
			<td align="right"> <strong>ESTIMATED HOURS</strong></td>
			<td><input name='estimated_hours' type='number' required></td>
		  </tr>
		  <tr>
			<td align="right"> <strong>REPAIR TYPE</strong></td>
			<td><select name='repair_type' required>
            <option>MCR</option>
            <option>HCR</option>
            <option>POH</option>
            </select>
            </td>
		  </tr>
           <tr>
			<td colspan=2 align="center"><input type='submit' value='SUBMIT' name='submit'></td>
		  </tr>
		</table>
        <p class='b1' align="center"><a href="mainpage.php"><b><font color="white">BACK</font></b></a></p>
          </form>
          </div>
          <?php
 	if(isset($_POST['submit']))
	 {
	     require_once ('connection.php');
		 $coach_no=$_POST['coach_no'];
 	     $workshop_in = $_POST['workshop_in'];
	     $estimated_hours = $_POST['estimated_hours'];
	     $repair_type = $_POST['repair_type'];
		 //$query="select from coachmaster where CoachNo='$coach_no'";
		 //$retval = mysqli_query($con,$query) or die(mysql_error());
		 
		 $retval = mysqli_query($con,"insert into coachregistration(coach_no,workshop_in,estimated_hours,repair_type) 
		 values('$coach_no','$workshop_in','$estimated_hours','$repair_type')") or die(mysql_error());
		 $retval = mysqli_query($con,"select * from coachregistration CR,coachmaster CM where CR.coach_no=CM.CoachNo AND 
		 CR.workshop_in=CURRENT_DATE AND CR.coach_no=$coach_no") or die(mysql_error());
	 	 if(!$retval ){
	     	echo "<h3 class='dngr'><p align='center'><b>COULD NOT FETCH DATA!!!</b></p></h3>";
	  	 }
	  	 else{
		    $num=mysqli_num_rows($retval);
		    if($num>0){
			    echo "<div id='div1'";
			    echo "<br />";
			    echo "<br />";
  			    echo "<table width=80% bgcolor= #f1f1f1 cellpadding='5' cellspacing='2' align='center' border=1px>
      	  	    <tr>
			    <td><strong> REGISTRATION ID </strong></td>
			    <td><strong> COACH NO </strong></td>
			    <td><strong> WORKSHOP IN </strong></td>
			    <td><strong> ESTIMATED HOURS </strong></td>
			    <td><strong> REPAIR TYPE </strong></td>
			    <td><strong> RAILWAY </strong></td>
		  	    <td><strong> ALLOTED BASE </strong></td>
		  	    <td><strong> FULL BRAKE </strong></td>
		  	    <td><strong> TYPE </strong></td>
		  	    <td><strong> MAKE </strong></td>
		  	    <td><strong> CATEGORY </strong></td>
		        <td><strong> BUILT DATE </strong></td>
		  	    </tr>";
				$i=0;
			    while ($row1=mysqli_fetch_array($retval)){
 				    echo "<tr>";
				    $reg_id=$row1['reg_id'];
				    $coach_no=$row1['coach_no'];
				    $workshop_in=$row1['workshop_in'];
				    $estimated_hours=$row1['estimated_hours'];
				    $repair_type=$row1['repair_type'];
				    $Rly=$row1['Rly'];
				    $AllotedBase=$row1['AllotedBase'];
				    $FullBk=$row1['FullBk'];
				    $Type=$row1['Type'];
				    $Make=$row1['Make'];
				    $category=$row1['category'];
				    $BuiltDt=$row1['BuiltDt'];
				
				    echo "<td>$reg_id</td>";
				    echo "<td>$coach_no</td>";
				    echo "<td>$workshop_in</td>";
				    echo "<td>$estimated_hours</td>";
				    echo "<td>$repair_type</td>";
				    echo "<td>$Rly</td>";
				    echo "<td>$AllotedBase</td>";
				    echo "<td>$FullBk</td>";
				    echo "<td>$Type</td>";
				    echo "<td>$Make</td>";
				    echo "<td>$category</td>";
				    echo "<td>$BuiltDt</strong></td>";
				    echo "</tr>";
				    $i++;
				}
				echo"</div>";
				echo "<h3 class='scss'><p align='center'><b>THE FOLLOWING COACH HAS BEEN REGISTERED SUCCESSFULLY!!!</b></p></h3>";;
			}
			else
			    echo "<h3 class='dngr'><p align='center'><b>COACH WITH MATCHING COACH NUMBER DOESNOT EXIST IN COACH MASTER!!</b></p></h3>";
			} 
			mysqli_close($con);
	 }
?>
</body>
</html>

