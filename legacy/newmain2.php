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
  <script src="js/js1.js"></script>
  <script src="js/js2.js"></script>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/site.css">

  






<style type="text/css">
  
  h1{background-color: #000066;color:white;margin-left: 100px;margin-right: 100px; border-radius: 10px;}
      h2{color: #FFFFFF;background-color: #000066;margin-left: 500px;margin-right: 500px; border-radius: 10px;}
  h3{color: #FFFFFF;background-color: #000066;margin-left: 200px;margin-right: 200px; border-radius: 10px;}
  
  .a{ margin-left: 100px; margin-right: 100px;background-color:#000066;border-radius:10px;}
  input[type= submit]{
    font-weight: 700;
    border-width: 3px;
  }
  span{color:red;}
  label{color: #000066;font-family:  "Georgia", serif; font-size: 15px; margin-left: 10px }
  select option:first-child{color: blue;}


h1{background-color: #000066;color:white;margin-left: 100px;margin-right: 100px; border-radius: 10px;}
      h2.nm{background-color: #000066;color:white;margin-left: 500px;margin-right: 500px; border-radius: 10px;}
      p.b1{background-color: #000066;margin-left: 635px;margin-right: 635px; border-radius: 7px;border-style: outset;}
      
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
  background-color: #000066;
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
    background-color: white;
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
    letter-spacing: 4px;
    border-radius: 0;
    font-family: Montserrat, sans-serif;
    min-height: 110px;
  }
  .navbar li a, .navbar .navbar-brand {
    color: #fff !important;
    padding: 0 15px;
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
        <li><a href="main2.php">COACH</a></li>
        <li><a href="userreport.php">REPORT</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
      </ul>

    </div>
  </div>

</nav>

     <div class="jumbotron text-center" >
  
  
  <h2 style="background-color:#000066;font-size: 30px; margin-left:100px; margin-right:100px; color:white" align="center" ><font face = "Bedrock"><strong>SOUTH EASTERN RAILWAY WORKSHOP, KHARAGPUR</font></strong></h1> 
  <h1 align="center" style="font-size: 60px;"><font face = "Times New Roman"><strong>COACH REPAIR AND MANAGEMENT SYSTEM</font> </strong></h1>
 
 
    <div align="center">
<h2 style="color:white;font-size: 30px; margin-left: 500px; margin-right: 500px; border-radius: 10px "><b><font face = "Times New Roman"><b>WELCOME &nbsp;&nbsp; <?php echo strtoupper($_SESSION['first_name']); ?></b></font></b></h2>
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




<div class="container-fluid bg-grey">
  <div class="row">
    <div class="w3-container">
    </div>
    <div align="center">
       <h1>VISION</h1>
      <p>&nbsp;</p>
      <h3>To make a Tracking System which can keep a track of the condition and location of all the railway coaches in the workshop.
        <p>&nbsp;</p>
       <p style="font-size: 80%">This application can only be used by the admins/workers who does the maintainance of the coaches other users can just view the details of the coaches.</p></h3>
      <p>&nbsp;</p>
       <p align="left" style="font-size: 140%;"><strong>WORKING:</strong> There is an USER section where the admin can add/remove users. A new user can register only as a general user, to become an admin he/she must contact the current admin.
        <br>In COACH MANAGEMENT section, admin can add a new coach which has recently been introduced/build.<br>In REGISTRATION section, a coach is registered for repair/maintainance in the workshop only after that it is send to mantainance area.<br> MAINTAINANCE section have many tables, each table represents a specific shop in the workshop, a coach travels from all these shops for repair/mantainance as shown in the flow chart above. Here the location of the coaches can easily be seen i.e., in which shop it is currently located. The admin can move the coaches from one shop to another by selecting a particular coach and pressing the arrow button<br>Finally in REPORT section, all the details and histroy of a specific coach (including the ones present in the shop) can be seen.
                </p>


    </div>
  </div>
</div>

<!-- Container (REPORT Section) -->









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
