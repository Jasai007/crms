 



 <?php


$error="";




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
          $query6 = "INSERT INTO `railcoaches`.`coachmaster` (`RAILWAY_ZONE`, `ALLOATED_BASE`, `COACH_NO`, `FULL_BRAKE`, `COACH_TYPE`, `MAKE`, `CATEGORY`, `BUILT_DATE`)values ('$rly','$all_base','$c_no','$full_bk','$type','$make','$category','$b_date')";
         $retval = mysqli_query($conn,$query6);   
             

         if(!$retval ){
              echo "<script type='text/javascript'> alert('Coach is already in Master')</script>";
               
       }
       if ($retval){
            
            
             header('location:newmain.php#coach');
           }
       mysqli_close($conn);
   }
?>