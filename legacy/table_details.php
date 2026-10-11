<style type="text/css">
  
        p.b1{background-color: #000066;margin-left: 610px;margin-right: 610px; border-radius: 7px;border-style: outset;width:70px;}

</style>

<?php
  if(isset($_POST['submit']))
   {
       require_once ('connection.php');
     $coach_no=$_POST['coach_no'];
       $date=date("Y-m-d");
       $estimated_hours = $_POST['estimated_hours'];
       $repair_type = $_POST['repair_type'];
     //$query="select from coachmaster where CoachNo='$coach_no'";
     //$retval = mysqli_query($con,$query) or die(mysql_error());
     
     $retval = mysqli_query($conn,"insert into coachreg(coach_no,workshop_in,estimated_hours,repair_type) 
     values('$coach_no','$date','$estimated_hours','$repair_type')") or die(mysql_error());
     $retval = mysqli_query($conn,"select * from coachreg CR,coachmaster CM where CR.coach_no=CM.COACH_NO AND 
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
            $Rly=$row1['RAILWAY_ZONE'];
            $AllotedBase=$row1['ALLOATED_BASE'];
            $FullBk=$row1['FULL_BRAKE'];
            $Type=$row1['COACH_TYPE'];
            $Make=$row1['MAKE'];
            $category=$row1['CATEGORY'];
            $BuiltDt=$row1['BUILT_DATE'];
        
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
        echo "<p class='b1' align=".'center'."><a href=".'newmain.php#register'."><b><font color=".'white'.">GO TO Mainpage</font></b></a></p>";
        echo "<h3 class='scss'><p align='center'><b>THE FOLLOWING COACH HAS BEEN REGISTERED SUCCESSFULLY!!!</b></p></h3>";;
      }
      else
          echo "<h3 class='dngr'><p align='center'><b>COACH WITH MATCHING COACH NUMBER DOESNOT EXIST IN COACH MASTER!!</b></p></h3>";
      } 
      mysqli_close($conn);
   }
?>