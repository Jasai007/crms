<?php
require_once "session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com -->
  <title>mainpage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap1.css">
  <link href="css/site1.css" rel="stylesheet" type="text/css">
  <link href="css/site2.css" rel="stylesheet" type="text/css">
   <link href="css/site3.css" rel="stylesheet" type="text/css">
  <script src="js/js1.js"></script>
  <script src="js/js2.js"></script>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/site.css">

 
  








<style type="text/css">
  
  h1{background-color: #000066;color:white;margin-left: 100px;margin-right: 100px; border-radius: 10px;}
      h2{color: #FFFFFF;background-color: #000066;margin-left: 500px;margin-right: 500px; border-radius: 10px;}
  h3{color: #FFFFFF;background-color: #000066;margin-left: 200px;margin-right: 200px; border-radius: 10px;}
  p.b1{background-color: #000066;margin-left: 635px;margin-right: 635px; border-radius: 7px;border-style: outset;}


  .a{ margin-left: 100px; margin-right: 100px;background-color:#000066;border-radius:10px;}
  input[type= submit]{
    font-weight: 700;
    border-width: 3px;
  }
  span{color:red;}
  label{color: #000066;font-family:  "Georgia", serif; font-size: 15px; margin-left: 10px }
  select option:first-child{color: blue;}


 h2 {
    font-size: 24px;
    text-transform: uppercase;
    color: #303030;
    font-weight: 600;
    margin-bottom: 30px;
  }
  h4 {
    font-size: 19px;
    line-height: 1.375em;
    color: #303030;
    font-weight: 400;
    margin-bottom: 30px;
  }  



 input::placeholder{

color:blue;
font-weight: bold;

 }













  body {
    font: 400 15px Lato, sans-serif;
    line-height: 1.8;
    color: #818181;
    position:relative;
  }

  

  * {box-sizing: border-box;}
      .mySlides {display: none;}
      img {vertical-align: middle;}

      /* Slideshow container */
      .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
      }


      /* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

      /* Caption text */
      .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
      }

      /* Number text (1/3 etc) */
     .numbertext {
       color: #f2f2f2;
       font-size: 12px;
       padding: 8px 12px;
       position: absolute;
       top: 0;
     }

     /* The dots/bullets/indicators */
     .dot {
       height: 15px;
       width: 15px;
       margin: 0 2px;
       background-color: #bbb;
       border-radius: 50%;
       display: inline-block;
       transition: background-color 0.6s ease;
     }

     .active, .dot:hover {
  background-color: #717171;
}


     /* Fading animation */
    .fade {
      -webkit-animation-name: fade;
      -webkit-animation-duration: 1.5s;
      animation-name: fade;
      animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
      from {opacity: .4} 
      to {opacity: 1}
    }

    @keyframes fade {
      from {opacity: .4} 
      to {opacity: 1}
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
      .text {font-size: 11px}
    }


 
  
  .jumbotron {
    background-color: #000066;
    color: #fff;
    padding: 100px 25px;
    font-family: Montserrat, sans-serif;
  }
  .container-fluid {
    padding: 60px 50px;
  }
  .bg-grey {
    background-color: #f6f6f6;
  }
  .logo-small {
    color: #000066;
    font-size: 50px;
  }
  .logo {
    color: #000066;
    font-size: 200px;
  }
  .thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
  }
  .thumbnail img {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
    background-image: none;
    color: #ffffff;
  }
  .carousel-indicators li {
    border-color: #ffffff;
  }
  .carousel-indicators li.active {
    background-color: #ffffff;
  }
  .item h4 {
    font-size: 19px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
  }
  .item span {
    font-style: normal;
  }
  .panel {
    border: 1px solid #000066; 
    border-radius:0 !important;
    transition: box-shadow 0.5s;
  }
  .panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
    border: 1px solid #000066;
    background-color: #fff !important;
    color: #000066;
  }
  .panel-heading {
    color: #fff !important;
    background-color: #000066 !important;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  .panel-footer {
    background-color: white !important;
  }
  .panel-footer h3 {
    font-size: 32px;
  }
  .panel-footer h4 {
    color: #aaa;
    font-size: 14px;
  }
  .panel-footer .btn {
    margin: 15px 0;
    background-color: #000066;
    color: #fff;
  }
  .navbar {
    margin-bottom: 0;
    background-color: #000066;
    z-index: 9999;
    border: 0;
    font-size: 14px !important;
    line-height: 1.42857143 !important;
    letter-spacing: 2px;
    border-radius: 0;
    font-family: Montserrat, sans-serif;
    min-height: 110px;
  }
  .navbar li a, .navbar .navbar-brand {
    color: #fff !important;
    padding: 0 10px;
  height: 80px;
  line-height: 50px;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
    color: #000066 !important;
    background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
    color: #fff !important;

  }
  footer .glyphicon {
    font-size: 20px;
    margin-bottom: 20px;
    color: #000066;
  }
  .slideanim {visibility:hidden;}
  .slide {
    animation-name: slide;
    -webkit-animation-name: slide;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
      width: 100%;
      margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 800px) {
    .logo {
      font-size: 150px;
    }
  }

  



  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 

      </button>
         
            <a class="navbar-brand" href="#myPage"><img src="indian_rly_logo.png" height="100" width="100" /></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#home">HOME</a></li>
        <li><a href="user.php">USER</a></li>
        <li><a href="#coach">COACH</a></li>
        <li><a href="#register">REGISTER COACH</a></li>
        <li><a href="#maintain">MAINTENANCE</a></li>
        <li><a href="newreport.php">REPORT</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
      </ul>

    </div>
  </div>

</nav>

     <div class="jumbotron text-center" >
  
  
  <h2 style="background-color:#000066;font-size: 30px; margin-left:100px; margin-right:100px; color:white" align="center" ><font face = "Bedrock"><strong>SOUTH EASTERN RAILWAY WORKSHOP, KHARAGPUR</font></strong></h1> 
  <h1 align="center" style="font-size: 60px;"><font face = "Times New Roman"><strong>COACH REPAIR AND MANAGEMENT SYSTEM</font> </strong></h1>
 
 
    <div align="center">
<h2 style="color:white;font-size: 30px; margin-left: 500px; margin-right: 500px; border-radius: 10px "><b><font face = "Times New Roman"><b>WELCOME &nbsp; <?php echo strtoupper($_SESSION['first_name']); ?></b></font></b></h2>
</div>
    

</div>

<!-- Container (HOME Section) -->


<div id="home" class="container-fluid">

    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    
    <table width="100%" border="5" align="center" cellspacing="5" cellpadding="5">
  <tr>
    <td width="35%">
      <div class="slideshow-container">
      
      <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img10.jpg" style="width:100%; height:100%">
      </div>
      <div class="item">
        <img src="img11.jpg" style="width:100%; height:100%">
      </div>
      <div class="item">
        <img src="img4.jpg" style="width:100%; height:100%">
      </div>
      <div class="item">
        <img src="img5.jpg" style="width:100%; height:100%">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
<br>


    </td>
    <td width="65%" align="justify">
        <img src="flowchart.jpg" height="453" width="806" /></td>
  </tr>
</table>

  
 




  
   

</div>

</div>


<div class="container-fluid bg-grey">
  <div class="row">
    <div class="w3-container">
      
    </div>
    <div align="center">
      <h1>VISION</h1>
      <p>&nbsp;</p>
      <h3>To make a Tracking System which can keep a track of the condition and location of all the railway coaches in the workshop.
        <p>&nbsp;</p>
       <p style="font-size: 80%">This application can only be used by the mantainance staffs of the coaches, other users can just view the details of the coaches.</p></h3>
      <p>&nbsp;</p>
      <p align="left" style="font-size: 140%;"><strong>WORKING:</strong> There is an USER section where the admin can add/remove users. A new user can register only as a general user, to become an admin he/she must contact the current admin.
        <br>In COACH MANAGEMENT section, admin can add a new coach which has recently been introduced/build.<br>In REGISTRATION section, a coach is registered for repair/maintainance in the workshop only after that it is send to mantainance area.<br> MAINTAINANCE section have many tables, each table represents a specific shop in the workshop, a coach travels from all these shops for repair/mantainance as shown in the flow chart above. Here the location of the coaches can easily be seen i.e., in which shop it is currently located. The admin can move the coaches from one shop to another by selecting a particular coach and pressing the arrow button<br>Finally in REPORT section, all the details and histroy of a specific coach (including the ones present in the shop) can be seen.
                </p>

    </div>
  </div>
</div>










<div id="coach" class="container-fluid text-center">

<html xmlns="http://www.w3.org/1999/xhtml">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <style>
  h1{background-color: #000066;color:white;margin-left: 100px;margin-right: 100px; border-radius: 10px;}
      h2.nm{background-color: #000066;color:white;margin-left: 500px;margin-right: 500px; border-radius: 10px;}
            h2.lm{background-color: #000066;color:white;margin-left: 530px;margin-right: 500px; border-radius: 10px; width:230px;}

      p.b1{background-color: #000066;margin-left: 635px;margin-right: 635px; border-radius: 7px;border-style: outset;}
     

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
             margin-left: 20px;
                 background: #f1f1f1;
                 border: none;
                 padding: 10px 15px;
                 font-size: 20px;
                 cursor: pointer;
                 width:250px;
                 color:#000066;
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




<?php
    $error= "";
  $value="";
  $search="";
 if(isset($_POST['sub2']))
 {
  header('location:newmain.php#coach');
 }



  if(isset($_POST['sub']))
     {

       if(empty($_POST['c_no']))
       {
        $error="PLEASE ENTER COACH NUMBER";
       }

      else

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
      echo "<h2 style=".'background-color:white; color:blue;'." ><p align='center'><b>COACH DOESNOT EXISTS !!</b></p></h2>";
     
      }
   }
 }
?>

<?php



$er="";
$err="";
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

       $q1=mysqli_query($conn,"SELECT * FROM `epiz_26877844_railway`.`coachmaster` where `COACH_NO`='$c_no'");

       
          $coun=mysqli_num_rows($q1);
          if($coun==1)
          {     
              $er="Coach cannot be Inserted .Already in Master";
               echo "<script type='text/javascript'>alert('Cannot be added already in coachmaster')</script>";
               
            
          }
          elseif ($coun==0) {
            
          $query6 = "INSERT INTO `epiz_26877844_railway`.`coachmaster` (`RAILWAY_ZONE`, `ALLOATED_BASE`, `COACH_NO`, `FULL_BRAKE`, `COACH_TYPE`, `MAKE`, `CATEGORY`, `BUILT_DATE`)values ('$rly','$all_base','$c_no','$full_bk','$type','$make','$category','$b_date')";
         $retval = mysqli_query($conn,$query6);   
             

         if(!$retval ){
            
            die();               
            }
       if ($retval){
            
                          $err="Coach Inserted";
             header('location:newmain.php#coach');
           }
       mysqli_close($conn);
     }
     
   }
?>







<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<h1 align="center">COACH MANAGMENT</h1>
<div id="myOverlay" class="overlay">
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay">X</span>
  <div class="overlay-content">
    <form  action="newmain.php#coach" method="POST" >
      <input type="text" placeholder="ENTER THE COACH NUMBER" name='c_no' style="width: 280px;font-color:blue" >
      <button type="submit" name="sub" style="width: 50px;cursor: pointer"> <i class="fa fa-search style=" style="font-size:24px;"></i></button>
      <br/>
      <button type="submit" name="sub2" style="width: 70px height:50px;margin-top: 10px; color:#000066;font-weight: 15px;"><b>BACK</b></button>
    </form>

  </div>
</div>
<button class="openBtn" onclick="openSearch()"><i class="fa fa-search style=" style="font-size:24px;font-color:blue;"></i>SEARCH MASTER</button><br/>

<span style="color: red;"> <?php 
echo $error;
?></span>

 

<script>
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
</script>


<div style="display: flex; margin-top: 30px; margin-left: 40px; ">
  <span style="color: red;"> <?php 
echo $err;
?></span>


<table style="display: block;">

      <form action="" method="POST">
       <td colspan="2" align="left"> <h2 class="nm" style="width: 200px; padding-left: 20px;">ADD MASTER</h2></td>
       <tr align="center">
            <td align="right"> <strong>RAILWAYS</strong></td>
                <td ><select name="rly">
                <option>CR</option> 
            <option>ER</option> 
            <option>ECR</option> 
            <option>ECOR</option> 
            <option>NR</option> 
            <option>NCR</option> 
            <option>NER</option> 
            <option>NFR</option> 
            <option>NWR</option> 
            <option>SR</option> 
            <option>SER</option> 
            <option>SECR</option>
            <option>SWR</option> 
            <option>WR</option> 
            <option>WCR</option>
         </td>
         </tr>
      <tr>
      <td align="right"> <strong>ALLOTED BASE</strong></td>
      <td ><select name='all_base'>
            <option>TATA</option> 
            <option>ECO</option> 
            <option>BSP</option> 
            <option>SRC</option> 
            <option>HTE</option> 
            <option>NA</option> 
            <option>JSG</option> 
            <option>NRC</option> 
            <option>ADA</option> 
            <option>KGP</option> 
            <option>CKP</option> 
            <option>SEC</option>
            <option>H.TE</option> 
            <option>sac</option> 
            <option>DHN</option>
            <option>ROU</option> 
            </td>
            </tr>
            <tr>
            <td align="right"> <strong>COACH NO.</strong></td>    
      <td><input name='c_no' type='text' required></td>
            </tr>
            <tr>
      <td align="right"> <strong>FULL BRAKE</strong></td>
      <td><select name='full_bk'>
            <option>AB</option>
            <option>A</option>
            </td>
      </tr>
      <tr>
      <td align="right"> <strong>TYPE</strong></td>
      <td><select name='type'>
            <option>ERT</option> 
            <option>WGACCN</option> 
            <option>WGSCZAC</option> 
            <option>WGSCN </option>
            <option>VPH</option> 
            <option>GS</option> 
            <option>WGSCZ</option> 
            <option>SLR</option> 
            <option>GSLR</option>
            <option>PPS</option> 
            <option>RA</option> 
            <option>RT/TV</option> 
            <option>RT/SV</option> 
            <option>RR</option> 
            <option>WGACCW</option> 
            <option>GSLRD</option> 
            <option>WGCB</option> 
            <option>WCB</option> 
            <option>NMG</option> 
            <option>WGSCZACJ</option> 
            <option>WGSCZJ</option> 
            <option>WGSRJ</option>
            <option>VPU</option> 
            <option>GSCZ</option> 
            <option>RS(QT)</option> 
            </td>
      </tr>
      <tr>
      <td align="right"> <strong>MAKE</strong></td>
      <td><select name='make'>
            <option>IRS</option>
            <option>RCF</option>
            <option>IBF</option>
            </td>
      </tr> 
      <tr>
      <td align="right"> <strong>CATEGORY</strong></td>
      <td><select name='category'>
            <option>AC</option>
            <option>NON-AC</option>
            </td>
      </tr>
          <tr>
      <td align="right"><strong>BUILT DATE</strong></td>
      <td><input name="b_date" type="date" required></td>
      </tr>
      <tr>
      <td  colspan="2" align="center"><input type='submit' value='SUBMIT' name='submit'></td>
     
        
         </tr>

      
    </form>                           
    </table>
       


</div>




  
  <?php 
  require_once('connection.php');
  $date=date("Y-m-d");
  $que1=mysqli_query($conn,"SELECT * FROM `coachmaster`") 
 ?>

  <h2 class="lm" style="padding-left: 10px">VIEW MASTER</h2></td>
<div style="float:left; width:50%; max-height: 100%" >
  <form action="" method="post" style="width:1000px ; max-height: 100%; border-style: ridge;border-color: #000066;border-width: 5px; margin-left: 190px;"align="center"form-group >
        <div  style="float:left; width:100%; " align="center">
         
          <div style="display:inline;">
          <select multiple class="form-control" id="adch" name="adch" id="lstBox1" style="height: 250px; padding-left: 35px" required> &nbsp;CATEGORY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <option disabled>
            RLY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;_BASE_&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;COACH NO.&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;BRAKE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TYPE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;__MAKE__&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_CATEGORY_&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BUILT DATE</option>
                            <?php
                while ($row=mysqli_fetch_array($que1)):;
                ?>
                <option value="<?php echo $row[2];?>" >

                                        
                      <?php echo $row[0];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[1];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[2];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[3];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[4];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[5];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[6];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                    <?php echo $row[7];?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
                                </option>
              <?php endwhile;  ?>

          </select>
        
        </div>
      </div>
              <p>&nbsp;&nbsp;&nbsp;</p>    
               <input type='submit' value='REMOVE' name='delete'>
        <p></p>
            </form>
</div>
</div>

<div>
    
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
          
            header('Location:newmain.php#coach');
        }
        
      }
    }

     ?>
</div>
























</div>








<div id="register" class="container-fluid text-center">



 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        

<div align='center'>
<h1 align="center">COACH REGISTRATION</h1>
<br>
    <form method="POST" action="table_details.php">
      <table width=100%  cellpadding="5"  cellspacing="2" align="center">
         <tr>
            <td align="right"> <strong>COACH NUMBER</strong></td>
                <td><input type="number" name="coach_no" REQUIRED/></td>
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
        
          </form>
          </div>
          




</div>




















<!-- Container (MAINTENANCE Section) -->
<div id="maintain" class="container-fluid">
    
  <?php 
  
  include('check_reg.php');
  include('check_strip.php');
  include('check_rep.php');
  include('check_paint.php');
  include('check_lift.php');
  include('check_break.php');
  include('check_pit.php');
  include('check_comp.php');

 ?>
  <?php 
  require_once('connection.php');
  $date=date("Y-m-d");
  $que1=mysqli_query($conn,"SELECT * FROM `coachreg` where workshop_in between '2019-06-01' AND '$date' HAVING `shop_in` LIKE '0000-00-00'");
  if (!$que1) {
    die('Could not fetch data');

  }
  $query=mysqli_query($conn,"SELECT * FROM `strip_ins` where `strip_out` IS NULL ");
  if(!$query)
  {
    die('could not fetch data from strip in');
  }
  $qp=mysqli_query($conn,"SELECT * FROM `pohtable` WHERE `shop_out` IS NULL ");
  if(!$qp)
  {
    die('could not fetch data from pohtable');
  }
  $qm=mysqli_query($conn,"SELECT * FROM `mcrtable` WHERE `shop_out` IS NULL ");
  if(!$qm)
  {
    die('could not fetch data from mcrtable');
  }
  $qh=mysqli_query($conn,"SELECT * FROM `hcrtable` WHERE `shop_out` IS NULL ");
  if(!$qh)
  {
    die('could not fetch data from hcrtable');
  }
  $qpaint=mysqli_query($conn,"SELECT * FROM `painting` WHERE `paint_out` IS NULL ");
  if(!$qpaint)
  {
    die('could not fetch data from painting');
  }
  $qlift=mysqli_query($conn,"SELECT * FROM `lifting` WHERE `lift_out` IS NULL ");
  if(!$qlift)
  {
    die('could not fetch data from lifting');
  }
  $qbreak=mysqli_query($conn,"SELECT * FROM `break_shop` WHERE `break_out` IS NULL ");
  if(!$qbreak)
  {
    die('could not fetch data from break_shop');
  }
  $qpit=mysqli_query($conn,"SELECT * FROM `ntxr` WHERE `check_out` IS NULL ");
  if(!$qpit)
  {
    die('could not fetch data from pit line');
  }
  $qtraffic=mysqli_query($conn,"SELECT * FROM `trafficout` ");
  if(!$qtraffic)
  {
    die('could not fetch data from trafficout');
  }
  $qlast=mysqli_query($conn,"SELECT * FROM `last_repair` where `re_out` IS NULL ");
  if(!$qlast)
  {
    die('could not fetch data from last repair shop');
  }

 ?>

  
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
       
        <h1 align="center">MAINTENANCE</h1>
  
    <div class="row  style-select" align="left" style="padding-left: 45px;" >
      <div class="col-md-6" style="margin-top: 100px;" >
            <form action="" method="post">
              <span><?php echo $er_reg; ?></span>
                <div style="float: left; width: 45%;">
                <label >Registered Coaches</label>
                <select multiple class="form-control" id="lstBox1" name="regcoach" >
                  <option value="none" disabled>Co_No &nbsp; Wshop_in &nbsp;&nbsp; E_hours &nbsp;R_type</option>
                <?php
                while ($row1=mysqli_fetch_array($que1)):;
                ?>
                <option value="<?php echo $row1['coach_no']?>" ><?php echo $row1['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $row1['workshop_in']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $row1['estimated_hours']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $row1['repair_type']?></option>
                <?php endwhile;  ?>

                </select>

              </div>
              <div class=" subject-info-arrows text-center "  >
                <br /><br />
                <button type='submit'  name='add1' value='>'  class="btn btn-info" />></button><br />
            
                  <button type='submit' name='minus1'  style="margin-top: 10px"  class="btn btn-primary"/><</button>    
              </div>

              <span><?php echo $strip_back; ?></span>
              <span><?php echo $er_hour; ?></span>
                <span><?php echo $er_strip; ?></span>
              <div style="float: left; width: 35%;">
                <label>Coaches in Strip-in</label>
                <select multiple class="form-control" id="lstBox2" name="stripcoach" >
                  <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     Strip_in Date</b> </option>
                <?php
                while ($row=mysqli_fetch_array($query)):;
                ?>
                  
                  <option value="<?php echo $row['coach_no']?>"><?php echo $row['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $row['strip_in']?></option>
                <?php endwhile;  ?>
                </select>
                <input type="number" name="hours" placeholder="Actual Hours required " style="margin-left: 15px "><br/>
                <select name="shop" style="margin-left: 25px;width: 150px;padding-left: 30px;"> 
                  <option value="25">Shop-25</option>
                  <option value="26">Shop-26</option>
                  <option value="33">Shop-33</option>
                </select>
              </div>
              <div class=" subject-info-arrows text-center" >
                <br /><br />
                <button type='submit' value='>' name="add2"  class="btn btn-info" />></button><br />

                  <button type='submit' name='minus2' style="margin-top: 10px"  class="btn btn-primary"/><</button>    
              </div>
                
                <div class="col-md-5">
                <div style="float: left; width: 95%;margin-top: 20px; " >
                  
                  

                  <label>Traffic_out Coaches</label>
                  <select multiple class="form-control" id="lstBox2" name="" >
                    <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     Out Date</b> </option>
                  <?php
                  while ($rtraffic=mysqli_fetch_array($qtraffic)):;
                  ?>
                  
                  <option value="<?php echo $rtraffic['coach_no']?>"><?php echo $rtraffic['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $rtraffic['date_out']?></option>
                  <?php endwhile;  ?>
                  </select>
                </div>

                

                <div style="float: left; width: 85%;margin-top: 40px;" >
                  <span><?php echo $er_move; ?></span>
                  <label> Coaches In Repair </label>
                  <select multiple class="form-control" id="lstBox2" name="lastcoach" >
                    <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     In Date</b> </option>
                  <?php
                  while ($rlast=mysqli_fetch_array($qlast)):;
                  ?>
                  
                  <option value="<?php echo $rlast['coach_no']?>"><?php echo $rlast['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $rlast['re_in']?></option>
                  <?php endwhile;  ?>
                  </select>
                </div>
                <div class=" subject-info-arrows text-center" >
                  <br /><br />
                    <input type="hidden" name="done" value="0" />

                    <input type='checkbox' value=" 1" name="done" style="margin-top: 40px; margin-left: 7px;"  class="btn btn-info" />Done

                  <button type='submit' name="add7" class="btn btn-success"  style="margin-top: 10px; margin-left: 7px;"><span class="glyphicon glyphicon-chevron-up" style="color: white;border-width: 3px;"></span> </button><br />
                </div>
                </div>
              <br><br>

                
                <div class="subject-info-arrows text-center" style="width: 55px;margin-top: 120px;">
                  <br/>
                  <button type="submit" name="comp"  class="btn  btn-success" style="border-width: 3px ;width:45px;"><</button>
                  <br/>
                  <button type="submit" name="reback" class="btn btn-danger " style=" margin-top: 10px; width:45px; border-width: 3px"><span class="glyphicon glyphicon-repeat" style="color: white"></span> </button>
                </div>

                <div style="float: left; width: 33%;margin-top: 100px;  " >
                  <span><?php echo $er_back5; ?></span>
                  <span><?php echo $er_done; ?></span>
                  <span><?php echo $er_last; ?></span>
                  

                  <label>Coaches in  Pit Line</label>
                  <select multiple class="form-control" id="lstBox2" name="pitcoach" >
                    <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     Shop_in Date</b> </option>
                  <?php
                  while ($rpit=mysqli_fetch_array($qpit)):;
                  ?>
                  
                  <option value="<?php echo $rpit['coach_no']?>"><?php echo $rpit['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $rpit['check_in']?></option>
                  <?php endwhile;  ?>
                  </select>
                </div>


              <div class=" subject-info-arrows text-center  "  style="margin-top: 120px">
                  <br /><br />
                  <button type='submit' value='<'  name="add6" class="btn btn-info" /><</button><br />
                  
                    <button type='submit' name='minus6'  style="margin-top: 10px"  class="btn btn-primary"/>></button>    

                </div>
            
        </div>  
      <div class="col-md-6" >
          <div class="row" >
            <div class="col-md-12">
              <span><?php echo $er_coach; ?></span>
              <span><?php echo $er_back; ?></span>
              <span><?php echo $er_back2; ?></span>
              <span><?php echo $er_lift; ?></span>
              <span><?php echo $er_back3; ?></span>
              <span><?php echo $er_break; ?></span>
              <span><?php echo $er_back4; ?></span>


              <div style="float: left; width: 35%;">
                <label>Coaches in Shop-25</label>
                <select multiple class="form-control" id="lstBox2" name="pohcoach" >
                  <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     Shop_in Date</b> </option>
                <?php
                while ($r2=mysqli_fetch_array($qp)):;
                ?>
                  
                  <option value="<?php echo $r2['coach_no']?>"><?php echo $r2['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $r2['shop_in']?></option>
                <?php endwhile;  ?>
                </select>
              </div>
            </div>
          </div>
          
            <div class="row" align="left">
              <div class="col-md-12" >
              
                <div style="float: left; width: 35%;">
                  <label>Coaches in Shop-26</label>
                  <select multiple class="form-control" id="lstBox2" name="mcrcoach" >
                  <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     Shop_in Date</b> </option>
                  <?php
                  while ($r3=mysqli_fetch_array($qm)):;
                  ?>
                  
                  <option value="<?php echo $r3['coach_no']?>"><?php echo $r3['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $r3['shop_in']?></option>
                  <?php endwhile;  ?>
                  </select>
                </div>
                <div class=" subject-info-arrows text-center "  >
                  <br /><br />
                  <button type='submit' value='>'  name="add3" class="btn btn-info" />></button><br />
                  
                    <button type='submit' name='minus3'  style="margin-top: 10px;" class="btn btn-primary"/><</button>    

                </div>

                <div style="float: left; width: 35%;">
                  <label>Coaches in Paint Shop</label>
                  <select multiple class="form-control" id="lstBox2" name="paintcoach" >
                    <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     Shop_in Date</b> </option>
                  <?php
                  while ($rpaint=mysqli_fetch_array($qpaint)):;
                  ?>
                  
                  <option value="<?php echo $rpaint['coach_no']?>"><?php echo $rpaint['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $rpaint['paint_in']?></option>
                  <?php endwhile;  ?>
                  </select>
                </div>
                <div class=" subject-info-arrows text-center "  >
                  <br /><br />
                  <button type='submit' name="add4" class="btn btn-info" ><span class="glyphicon glyphicon-chevron-down" style="color: white;border-width: 3px;"> </span> </button>
                  <br/>
                  <button type='submit' name="minus4" class="btn btn-primary" style="margin-top: 10px"><span class="glyphicon glyphicon-chevron-up" style="color: white;border-width: 3px;"></span> </button><br />                 

                  
                  

                </div>
                
                
                
              </div>
            </div>
          

            <div class="row">
              <div class="col-md-12">
              <div style="float: left; width: 35%;">
                <label>Coaches in Shop-33</label>
                <select multiple class="form-control" id="lstBox2" name="hcrcoach" >
                  <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     Shop_in Date</b> </option>
                <?php
                while ($r4=mysqli_fetch_array($qh)):;
                ?>
                  
                  <option value="<?php echo $r4['coach_no']?>"><?php echo $r4['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $r4['shop_in']?></option>
                <?php endwhile;  ?>
                </select>
              </div>
              </div>
            </div>


            <div class="row" >
              <div class="col-md-5" >
                <span><?php echo $er_pit; ?></span>
                <div style="float: left; width: 85%;margin-left: 10px;">
                  <label>Coaches in Break Shop</label>
                  <select multiple class="form-control" id="lstBox2" name="breakcoach" >
                    <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     Shop_in Date</b> </option>
                  <?php
                  while ($rbreak=mysqli_fetch_array($qbreak)):;
                  ?>
                  
                  <option value="<?php echo $rbreak['coach_no']?>"><?php echo $rbreak['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $rbreak['break_in']?></option>
                  <?php endwhile;  ?>
                  </select>
                </div>
              </div>
              <div class=" subject-info-arrows text-center  "  >
                  <br /><br />
                  <button type='submit' value='<'  name="add5" class="btn btn-info" /><</button><br />
                  
                    <button type='submit' name='minus5'  style="margin-top: 10px"  class="btn btn-primary"/>></button>    

                </div>
              
              <div style="margin-left: 300px">
              <div class="col-md-8"  >
              <div style="float: left; width: 100%; ">
                  <label>Coaches in lift Shop</label>
                  <select multiple class="form-control" id="lstBox2" name="liftcoach" >
                    <option value="none" disabled><b>Coach_No &nbsp; &nbsp;&nbsp;     Shop_in Date</b> </option>
                  <?php
                  while ($rlift=mysqli_fetch_array($qlift)):;
                  ?>
                  
                  <option value="<?php echo $rlift['coach_no']?>"><?php echo $rlift['coach_no']?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp" ?><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?><?php echo $rlift['lift_in']?></option>
                  <?php endwhile;  ?>
                  </select>
                </div>
              </div>
              </div>
            </div>  
    </form>
      
    </div>
      
      

</div>








<div id="report" class="container-fluid text-center">

<script type="text/javascript">
    function printContent(el)
    {
    var restorepage=document.body.innerHTML;
    var printcontent=document.getElementById(el).innerHTML;
    document.body.innerHTML=printcontent;
    window.print();
    document.body.innerHTML=restorepage;
      }

</script>


<style type="text/css">
     
      
      input[type=submit]{
        font-weight: bold;
        border-radius: 8px;
        background-color: #000066;
        color:white;
        border-width: 5px;
      }
      input[type=submit]:hover 
      {
         background-color:#4169E1;
      }

      button
      {   background-color: #000066;
        color: white;
        font-weight: bold;
        border-radius: 8px;
        border-width: 5px;
        }

        button:hover
        {
           background-color:#4169E1;
        }

      h3.scss{color: #000066;}
      h3.dngr{color: #000066;}
      label{color:blue;}
      .a{ margin-left: 100px; margin-right: 100px;background-color:#000066;border-radius:10px;}

      .div{
          position: absolute;
        }




        .center {
  margin: auto;
  width: 60%;
  border: 7px solid #000066;
  padding: 30px;
}



</style>
</head>



<p>&nbsp;&nbsp;&nbsp;&nbsp;</p>

<h1  align="center"><a href="newreport.php">REPORT</a></h1>
<p>&nbsp;&nbsp;&nbsp;&nbsp;</p>
























 


































<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})




</script>

</body>
</html>
