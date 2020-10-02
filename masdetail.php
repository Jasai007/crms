<?php




  if(isset($_POST['submit'])){
       require_once ('connection.php');
       $rly= $_POST['rly'];
       $all_base= $_POST['all_base'];
       $c_no= $_POST['c_no'];
       $full_bk= $_POST['full_bk'];
       $type= $_POST['type'];
       $make= $_POST['make'];
       $category= $_POST['category'];
       $b_date= $_POST['b_date']; 

       $q1=mysqli_query($conn,"SELECT * FROM `railcoaches`.`coachmaster` where `COACH_NO`='$c_no'");

       
          $coun=mysqli_num_rows($q1);
          if($coun==1)
          {
               echo "<script type='text/javascript'>alert('Already added to coachmaster')</script>";
               header('location:newmain.php#coach');
            
          }
          elseif ($coun==0) {
            
          $query6 = "INSERT INTO `railcoaches`.`coachmaster` (`RAILWAY_ZONE`, `ALLOATED_BASE`, `COACH_NO`, `FULL_BRAKE`, `COACH_TYPE`, `MAKE`, `CATEGORY`, `BUILT_DATE`)values ('$rly','$all_base','$c_no','$full_bk','$type','$make','$category','$b_date')";
         $retval = mysqli_query($conn,$query6);   
             

         if(!$retval ){
            $er="Coach cannot be Inserted .Already in Master";
            die();               
            }
       if ($retval){
            
            
             header('location:newmain.php#coach');
           }
       mysqli_close($conn);
     }
     
   }
?>