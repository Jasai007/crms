<?php
session_start(); 
$error="";
if (isset($_POST['submit']))
{
  if (empty($_POST['username']) || empty($_POST['password'])){
      $error = "Please enter Username and Password";
  }
  else{
    $username=$_POST['username'];
    $password=$_POST['password'];
    require_once('connection.php');
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($conn,$username);
    $password = mysqli_real_escape_string($conn,$password);
    $qu1= mysqli_query($conn,"SELECT userlevel,firstname from user where password=md5('$password') AND username='$username'");
    $rows=mysqli_fetch_array($qu1);
    $count = mysqli_num_rows($qu1);
      if ($count == 1) {
        $_SESSION['login_user']=$username; 
        $_SESSION['userlevel']=$rows['userlevel'];
        $_SESSION['first_name']=$rows['firstname'];
        
      } 
      else{
      $error = "Username or Password is invalid";
      }
      mysqli_close($conn); 
   }
 }
?>