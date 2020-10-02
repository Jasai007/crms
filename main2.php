<?php
  $error= "";
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>coaches</title>
<style type="text/css">
      h1{background-color: #000066;color:white;margin-left: 100px;margin-right: 100px; border-radius: 10px;}
      h2.nm{background-color: #000066;color:white;margin-left: 500px;margin-right: 500px; border-radius: 10px;}
      p.b1{background-color: #000066;margin-left: 635px;margin-right: 635px; border-radius: 7px;border-style: outset;}
      form{width:95% ; border-style: ridge;border-color: #000066;border-width: 7px;}
      table{width:30% ; border-style: ridge;border-color: #000066;border-width: 7px;}
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
                    .openBtn {
             margin-left: 550px;
                 background: #f1f1f1;
                 border: none;
                 padding: 10px 15px;
                 font-size: 20px;
                 cursor: pointer;
                 width:250px;
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
                 top:46%;
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

<body>


<div class="a">
<h2 style="background-color:#000066; margin-left:100px; margin-right:100px; color: #FFFFFF" align="center"><strong>SOUTH EASTERN RAILWAY WORKSHOP, KHARAGPUR</strong></h1>
<h1 align="center"><strong>COACH REPAIR AND MANAGEMENT SYSTEM</strong></h1>
</div>

<div id="myOverlay" class="overlay">
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
  <div class="overlay-content">
    <form  action="" method="POST" style="width:37% ; margin-left: 300px; border-style: ridge;border-color: #00bfff;border-width: 7px;">
      <input type="text" placeholder="ENTER THE COACH NUMBER" name='c_no' style="width: 280px;font-color:blue" >
      <button type="submit" name="sub"> <i class="fa fa-search style=" style="font-size:24px"></i></button>
    </form>
  </div>
</div>
<p class='b1' align="center"><a href="newmain2.php"><b><font color="white">BACK</font></b></a></p>
<button class="openBtn" onclick="openSearch()"><i class="fa fa-search style=" style="font-size:24px"></i>SEARCH MASTER</button>

<script>
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
</script>
  <div style="display: flex; margin-top: 30px; margin-left: 285px; margin-right: 285px ">



  
  <?php 
  require_once('connection.php');
  $date=date("Y-m-d");
  $que1=mysqli_query($conn,"SELECT * FROM `coachmaster`") 
 ?>
  <form action="" method="post" form-group >
        <div  class="subject-info-box-1">
          <h2 align="center">VIEW MASTER</h2>
          <div style="display: flex;">
          <select multiple class="form-control"  id="adch" name="adch" id="lstBox1" style="height: 250px" required>nbsp;CATEGORY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
            <option disabled>RAILWAY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ALLOTED BASE&nbsp;&nbsp;&nbsp;COACH NO.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BRAKE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TYPE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MAKE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CATEGORY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BUILT DATE</option>
                            <?php
                while ($row=mysqli_fetch_array($que1)):;
                ?>
                <option value="<?php echo $row[2];?>" >

                                        
                      <?php echo $row[0];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[1];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[2];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[3];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[4];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[5];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[6];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[7];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                                </option>
              <?php endwhile;  ?>

          </select>
        
        </div>
      </div>
            
        <p></p>
            </form>

</div>
<div>
    <?php
    $error= "";
  $value="";
  $search="";
  if(isset($_POST['sub']))
     {
    require_once("connection.php");
    if($_POST['c_no'])
    {
      $value = $_POST['c_no'];
      $search ="c_no";
    }
    $querys = "select * from coachmaster where COACH_NO= '$value'";
    $retval = mysqli_query($conn,$querys);
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
        echo "<table width=80% bgcolor= #FFFFFF cellpadding='5' cellspacing='2' align='center' border=1px>
          <tr>
        <td align = 'center' colspan='8'><h3> <strong> SEARCH RESULTS </strong></h3></td>   
        </tr>
            <tr>
      <td><strong> RAILWAYS </strong></td>
        <td><strong> ALLOTED BASE </strong></td>
        <td><strong> COACH NO </strong></td>
        <td><strong> FULL  BRAKE </strong></td>
        <td><strong> TYPE </strong></td>
        <td><strong> MAKE </strong></td>
        <td><strong> CATEGORY </strong></td>
        <td><strong> BUILT DATE </strong></td>
        </tr>";
       
      $i=0;
      while ($row1=mysqli_fetch_array($retval))
        {
        echo "<tr>";  
        $rly=$row1[0];
        $a_base=$row1[1];
                $c_no=$row1[2];
                $f_bk=$row1[3];
                $type=$row1[4];
                $make=$row1[5];
                $cat=$row1[6];
        $b_dt=$row1[7];
        
        echo "<td>$rly</td>";
        echo "<td>$a_base</td>";
        echo "<td>$c_no</td>";
        echo "<td>$f_bk</td>";
        echo "<td>$type</td>";
        echo "<td>$make</td>";
        echo "<td>$cat</td>";
        echo "<td>$b_dt</td>";
        echo "</tr>";
        $i++;
        }
        echo"</div>";
      }
      else
      echo "<h3 class='dngr'><p align='center'><b>COACH DOESNOT EXISTS !!</b></p></h3>";
      }
   }
?>
</div>
 <div>
 
</div>
<div>
  <?php 

      if (isset($_POST['delete'])) {
      require_once('connection.php');
      $cono=$_POST['adch'];
      $query1=mysqli_query($conn,"SELECT * FROM `coachmaster` where `COACH_NO`= '$cono'");
      if (!$query1 ) {
        die('......');
      }
      else
      {
        $info=mysqli_fetch_assoc($query1);
        $COACH_NO=$info['COACH_NO'];
        $del=mysqli_query($conn,"DELETE FROM `coachmaster` WHERE `COACH_NO`='$cono'");
        if (!$del) {
          die('could not delete from coachmaster');
        }
        else
        {
          
            header('Location:main1.php');
        }
        
      }
    }

     ?>
</div>

</body>
</html>
