<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>report</title>

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

</script>
<style type="text/css">
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



</style>
</head>

<body bgcolor="#FFFFFF">
  <img align="left" src="indian_rly_logo.png" height="100" width="100" />
<img align="right" src="serly_logo.jpg" height="100" width="100" />
<div class="a">
<h2 style="background-color:#000066; margin-left:100px; margin-right:100px; color: #FFFFFF" align="center"><strong>SOUTH EASTERN RAILWAY WORKSHOP, KHARAGPUR</strong></h1>
<h1 align="center"><strong>COACH REPAIR AND MANAGEMENT SYSTEM</strong></h1>
</div>

<p>&nbsp;&nbsp;&nbsp;&nbsp;</p>
<h3 style="margin-left: 570px;font-size: 50px">REPORT</h3>
<p>&nbsp;&nbsp;&nbsp;&nbsp;</p>

<p class='b1' align="center"><a href="newmain2.php"><b><font color="white">BACK</font></b></a></p>


<div class="center">
<form method="post" action="" >
   <h3 style="color:#000066;"><STRONG>SHOP HOLDING</STRONG></h3>  
  <table height="20%" width="80%" >
    <tr>
      <td width="40%" align="right"><strong>SELECT STAGE</strong></td>
      <td width="40%" align="left">
        <select name="stage">
          <option>ALL</option>
          <option>STRIPPING AND INSPECTION</option>
          <option>POH</option>
          <option>MCR</option>
          <OPTION>HCR</OPTION>
          <option>PAINT SHOP</option>
          <option>LIFTING SHOP</option>
          <option>BRAKE SHOP</option>
          <option>NTXR SHOP</option>
          <option>REPAIR SHOP</option>
          <option>TRAFFIC OUT</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input type="submit" name="submit" value="SUBMIT" /></td>
    </tr>

 <td colspan="2" align="right">
<button onClick="printContent('div1')">PRINT REPORT</button>
</td>
    


  </table>
</form>
</div>

<p>&nbsp;&nbsp;</p>
<div class="center" >
  <form method="post" action="" >
  <h3 style="color:#000066;"><STRONG>COACH HISTORY</STRONG></h3>

<table height="20%" width="100%" align="center">
<tr><td width="40%" align="right"><strong>ENTER COACH NO.</strong></td>
<td><input type="text" style="display: inline-block;  box-sizing: border-box;" placeholder="COACH NO." name="c_no" required /></td></tr>
<tr><td colspan="2" align="right"><input type="submit" name="submit2" value="SUBMIT" /></td></tr>

<td colspan="2" align="right">
<button onClick="printContent('div2')">PRINT HISTORY</button>
</td>


</table>
</form>
</div>







<?php
if(isset($_POST['submit']))
{
 require_once('connection.php');
 $stage=$_POST['stage'];


 if($stage=='STRIPPING AND INSPECTION')
 {
  $retval=mysqli_query($conn,"SELECT * from strip_ins where strip_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['strip_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL HOLDING OF STRIPPING AND INSPECTION AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}
}





 if($stage=='POH')
 {
  $retval=mysqli_query($conn,"SELECT * from pohtable where shop_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['shop_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL HOLDING OF POH AS ON -".date("d/m/Y")." : $num</h3>";
echo "</div>";
}
}






 if($stage=='MCR')
 {
  $retval=mysqli_query($conn,"SELECT * from mcrtable where shop_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['shop_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL HOLDING OF MCR AS ON - ".date("d/m/Y")." : $num</h3>";
echo "</div>";
}
}






if($stage=='HCR')
 {
  $retval=mysqli_query($conn,"SELECT * from hcrtable where shop_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['shop_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL HOLDING OF HCR AS ON - ".date("d/m/Y")." : $num</h3>";
echo "</div>";
}
}









if($stage=='PAINT SHOP'){
  $retval=mysqli_query($conn,"SELECT * from painting where paint_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['paint_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL HOLDING OF PAINT SHOP AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}
}












if($stage=='LIFTING SHOP')
{
  $retval=mysqli_query($conn,"SELECT * from lifting where lift_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='5' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['lift_in'];

echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL HOLDING OF LIFTING SHOP AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}
}











if($stage=='BRAKE SHOP')
{
  $retval=mysqli_query($conn,"SELECT * from break_shop where break_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['break_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL HOLDING OF BRAKE SHOP AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}
}






if($stage=='NTXR SHOP')
{
  $retval=mysqli_query($conn,"SELECT * from ntxr where check_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['check_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL HOLDING IN NTXR CHECK AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}
}










if($stage=='REPAIR SHOP'){
  $retval=mysqli_query($conn,"SELECT * from last_repair where re_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['re_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL HOLDING OF REPAIR SHOP AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}
}











if($stage=='TRAFFIC OUT')
{
  $retval=mysqli_query($conn,"SELECT * from trafficout") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE OUT </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_out=$row1['date_out'];

echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_out</td>";
echo "</tr>";
$i++;
}
echo "<h3 align='center'>TOTAL COACHES EXIT AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}
}










if($stage=='ALL')
{
   $retval=mysqli_query($conn,"SELECT * from strip_ins where strip_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['strip_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
echo "<h3 align='center'>TOTAL HOLDING OF STRIPPING AND INSPECTION AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}







$retval=mysqli_query($conn,"SELECT * from pohtable where shop_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['shop_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
  ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php

echo "<h3 align='center'>TOTAL HOLDING OF POH AS ON -".date("d/m/Y")." : $num</h3>";
echo "</div>";
}






$retval=mysqli_query($conn,"SELECT * from mcrtable where shop_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['shop_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
  ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
echo "<h3 align='center'>TOTAL HOLDING OF MCR AS ON - ".date("d/m/Y")." : $num</h3>";
echo "</div>";
}






$retval=mysqli_query($conn,"SELECT * from hcrtable where shop_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['shop_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
  ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
echo "<h3 align='center'>TOTAL HOLDING OF HCR AS ON - ".date("d/m/Y")." : $num</h3>";
echo "</div>";
}







 $retval=mysqli_query($conn,"SELECT * from painting where paint_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['paint_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
echo "<h3 align='center'>TOTAL HOLDING OF PAINT SHOP AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}






$retval=mysqli_query($conn,"SELECT * from lifting where lift_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='5' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['lift_in'];

echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
echo "<h3 align='center'>TOTAL HOLDING OF LIFTING SHOP AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}





 $retval=mysqli_query($conn,"SELECT * from break_shop where break_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['break_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
echo "<h3 align='center'>TOTAL HOLDING OF BRAKE SHOP AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}





 $retval=mysqli_query($conn,"SELECT * from ntxr where check_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['check_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
echo "<h3 align='center'>TOTAL HOLDING IN NTXR CHECK AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}










$retval=mysqli_query($conn,"SELECT * from last_repair where re_out is NULL") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);

  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE IN </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_in=$row1['re_in'];


echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_in</td>";
echo "</tr>";
$i++;
}
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
echo "<h3 align='center'>TOTAL HOLDING OF REPAIR SHOP AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}




 


$retval=mysqli_query($conn,"SELECT * from trafficout ") or die(mysql_error());
  if(!$retval){
   die('Could not fetch data');
  }
  else{
   $num=mysqli_num_rows($retval);
  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='4' cellspacing='2' align='center' border=1px>
          <tr>
      <td align='center'><strong> REG ID </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> DATE OUT </strong></td>
      </tr>";
       
  $i=0;
while ($row1=mysqli_fetch_array($retval))
 {
 echo "<tr>"; 
$reg_id=$row1['reg_id'];  
$coach_no=$row1['coach_no'];
$date_out=$row1['date_out'];

echo "<td align='center'>$reg_id</td>";
echo "<td align='center'>$coach_no</td>";
echo "<td align='center'>$date_out</td>";
echo "</tr>";
$i++;
}
?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
 ?><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p> <?php
echo "<h3 align='center'>TOTAL COACHES EXIT AS ON ".date("d-m-Y").": $num</h3>";
echo "</div>";
}


}
mysqli_close($conn);
}
?>




</body>


<style>




</style>


<?php


if(isset($_POST['submit2'])){
 require_once('connection.php');
 $coach_no=$_POST['c_no'];
 $no="";
 $reg_id=0;
  $h=1;
 $q1=mysqli_query($conn,"SELECT reg_id,strip_out FROM strip_ins where coach_no=$coach_no");

              //echo "<script type='text/javascript'>alert('control goes to php')</script>";
 if(!$q1)
 {

  die();
 }
 
  else{

  echo "<br />";
    echo "<div id='div1'><table width=40%  cellpadding='10' cellspacing='2' align='center' border=1px>
      <tr>
            <td align='center'><strong> Registration Id </strong></td>
      <td align='center'><strong> COACH NO </strong></td>
      <td align='center'><strong> STRIP OUT DATE </strong></td>
      <td align='center'><strong> POH-SHOP OUT </strong></td>
      <td align='center'><strong> MCR-SHOP OUT </strong></td>
      <td align='center'><strong> &nbsp;HCR-SHOP OUT </strong></td>
      <td align='center'><strong> PAINTING DATE</strong></td>
      <td align='center'><strong> LIFTING DATE </strong></td>
      <td align='center'><strong> BRAKE SHOP DATE </strong></td>
      <td align='center'><strong> PITLINE FIT </strong></td>
      <td align='center'><strong> PITLINE DONE </strong></td>
      <td align='center'><strong> REPAIRE COMPLETE </strong></td>
      <td align='center'><strong> WORKSHOP OUT </strong></td>
      </tr>";
       
  $i=0;
     while($row1=mysqli_fetch_assoc($q1))
      {
        echo "<tr>"; 
              $reg_id=$row1['reg_id'];
               $strip_out=$row1['strip_out'];
                      echo "<td align='center'>$reg_id</td>";
                      echo "<td align='center'>$coach_no</td>";
                      echo "<td align='center'>$strip_out</td>";

          $q2=mysqli_query($conn,"SELECT reg_id,shop_out FROM pohtable where reg_id=$reg_id");
          if(!$q2)
          {
            die();
          }
          else
          {
            while ($row2=mysqli_fetch_assoc($q2)) {
              # code...
            


       
       
       $poh_out=$row2['shop_out'];
       /*
       
       
       
       $date_out=$row1['10'];*/
       $id=$row1['reg_id'];

       //echo "<td align='center'>$coach_no</td>";
       echo "<td align='center'>$poh_out</td>";
       echo "<td align='center'>$no</td>";
       echo "<td align='center'>$no</td>";
       
       $i++;
     }
     }
     $q3=mysqli_query($conn,"SELECT reg_id,shop_out FROM mcrtable where reg_id=$reg_id");
     if(!$q3)
          {
            die();
          }
          else
          {
            while ($row3=mysqli_fetch_assoc($q3)) {
              # code...
              $no="";
              $mcr_out=$row3['shop_out'];
              echo "<td align='center'>$no</td>";
              echo "<td align='center'>$mcr_out</td>";
              echo "<td align='center'>$no</td>";
            }
          }
         
      $q4=mysqli_query($conn,"SELECT reg_id,shop_out FROM hcrtable where reg_id=$reg_id");
     if(!$q4)
          {
            echo "<td align='center'>$no</td>";
            die();
          }
          else
          {
            while ($row4=mysqli_fetch_assoc($q4)) {
              # code...
              
              $hcr_out=$row4['shop_out'];
              echo "<td align='center'>$no</td>";
              echo "<td align='center'>$no</td>";
              echo "<td align='center'>$hcr_out</td>";
               

            }
          }
          $q5=mysqli_query($conn,"SELECT reg_id,paint_out FROM painting where reg_id=$reg_id");
               if (!$q5) {
                die();
               }
               else{
                 while ($row5=mysqli_fetch_assoc($q5)) {

                          $paint_out=$row5['paint_out'];
                          
                           echo "<td align='center'>$paint_out</td>";
                       
                  }
               }
          $q6=mysqli_query($conn,"SELECT reg_id,lift_out FROM lifting where reg_id=$reg_id");
               if (!$q6) {
                die();
               }
               else{
                 while ($row6=mysqli_fetch_assoc($q6)) {

                          $lift_out=$row6['lift_out'];
                          
                           echo "<td align='center'>$lift_out</td>";
                       
                  }
               }
          $q7=mysqli_query($conn,"SELECT reg_id,break_out FROM break_shop where reg_id=$reg_id");
               if (!$q7) {
                die();
               }
               else{
                 while ($row7=mysqli_fetch_assoc($q7)) {

                          $brake_out=$row7['break_out'];
                          
                           echo "<td align='center'>$brake_out</td>";
                       
                  }
               }
          $q8=mysqli_query($conn,"SELECT reg_id,check_out,fit FROM ntxr where reg_id=$reg_id");
               if (!$q8) {
                die();
               }
               else{
                 while ($row8=mysqli_fetch_assoc($q8)) {

                          $fit=$row8['fit'];
                          $check_out=$row8['check_out'];
                          echo "<td align='center'>$fit</td>";
                           echo "<td align='center'>$check_out</td>";
                           if($fit=='NO')
                           {
                            $q9=mysqli_query($conn,"SELECT reg_id,re_out FROM last_repair where reg_id=$reg_id");
                            if (!$q9) {
                                die();
                                }
                            else{
                                while ($row9=mysqli_fetch_assoc($q9)) {

                                    $re_out=$row9['re_out'];
                          
                                    echo "<td align='center'>$re_out</td>";
                       
                                }
                              }
                           }
                           elseif ($fit=='YES') {
                                echo "<td align='center'>$no</td>";
                           }
                           
                       
                  }
               }
                $q10=mysqli_query($conn,"SELECT reg_id,date_out FROM trafficout where reg_id=$reg_id");
               if (!$q10) {
                die();
               }
               else{
                 while ($row10=mysqli_fetch_assoc($q10)) {

                          $date_out=$row10['date_out'];
                          
                           echo "<td align='center'>$date_out</td>";
                       
                  }
               }
            echo "</tr>";

    }
  }
}
 
?>






















</body>
</html>