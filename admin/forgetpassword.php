<?php
require '../../vendor/autoload.php';
include("config.php");
include('../mailgun/RPAMailGun.php');

if(!empty($_SESSION['username']))
 {
   header("location:dashboard.php");
 }
if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Submit')
 {
  $select=mysql_query("SELECT * FROM userthree WHERE email='".$_REQUEST['email']."' and accounttype='ADMIN'");
  $count=mysql_num_rows($select);
  if($count>0)
   {
	$rsdata=mysql_fetch_object($select);
	$subject= "Admin Password Recovery Assistance from RePreApproval";
	$to= $rsdata->email;
	//$to= "dubeysant87@gmail.com";
	$from= "tim@repreapproval.com";
	$mess= '<table width="550px"><tr><td colspan="2" style="background-color:#93CE52">
	<img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px"/>
	</td></tr><tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr><tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2">Hello Repreapproval Admin,</td></tr><tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2">This is a copy of your password you requested. If you did not ask for this reminder, we recommend that you log into admin
	<strong></strong> account and change your password.</td></tr><tr><td colspan="2">&nbsp;</td></tr>
	<tr><td><strong style="color:#000;">Your Login ID:</strong></td> <td><strong style="color:#045D92;">'.$rsdata->email.'</strong></td></tr>
	<tr><td><strong style="color:#000;">Your Password:</strong></td> <td><strong style="color:#045D92;">'.$rsdata->password.'</strong></td></tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2">Thank you for choosing <strong>RePreApproval</strong>.</td></tr>
	<tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr></table>';
//
//	$headers  = 'MIME-Version: 1.0' . "\r\n";
//	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//	$headers .= 'From: '.$from. "\r\n";

       $mailgun = new RPAMailGun();
       if($mailgun->mail($to, $subject, $mess, array('forget','admin'))) {
           header("location:forgetpassword.php?msg=success");
       }

//	if(mail($to, $subject, $mess, $headers))
//	 {
//	  header("location:forgetpassword.php?msg=success");
//	 }
   }
  else
   {
	header("location:forgetpassword.php?msg=error");
   }
}
?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title>Forget Password</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<link href="css/style-responsive.css" rel="stylesheet" />
<link href="css/style-default.css" rel="stylesheet" id="style_color" />
<script src="js/jquery-1.8.3.min.js"></script>
</head>
<script type="text/ecmascript">
$(document).ready(function(){
$('#submit').click(function(){
var i=0;
var email=$('#email').val();
if(email=='')
 {
  $('#email').addClass('error');
  $('#email').attr('placeholder','Enter Your Email');
  i++;
 }
else if(filter.test(email)==false)
 {
  $("#email").val("").addClass("error");
  $('#email').attr('placeholder','Invalid Email');
  i++;
 }	

if(i>0)
 {
  return false;
 }
});

$('.input').focus(function()
 {
  $('#errormsg').hide();
  id=this.id;
  if($('#'+id).hasClass('error'))
   {
	$('#'+id).val('');
	$('#'+id).removeClass('error');
   }
  });
 });
</script>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="lock">
<div class="lock-header">
<!-- BEGIN LOGO -->
<a class="center" id="logo" href="../index.php">
<img class="center" alt="RepreAproval" src="../images/logo2.png">
</a>
<!-- END LOGO -->
</div>
<div align="center"> <div class="alert alert-error">
<strong>Did you forget your password?</strong><br/>Enter your email below and click submit.
</div><?php
if(isset($_REQUEST['msg']) and $_REQUEST['msg']=='success')
 {
  ?><div class="alert alert-success" id="errormsg"><?php
  echo "An email has been sent to the email address on file. Check your inbox and return to the CMS login page."; ?></div><?php
 }
?></div>
<div class="login-wrap">
<form action="" method="post">
<div class="metro single-size terques login">
<button type="button" class="btn login-btn" name="" id="" value="" onClick="window.location='index.php';">Login<i class=" icon-long-arrow-left"></i></button></div>


<div class="metro double-size yellow"><div class="input-append lock-input">
<input type="text" class="input" placeholder="Enter Your Email" name="email" id="email"></div></div>

<div class="metro single-size terques login">
<button type="submit" class="btn login-btn" name="submit" id="submit" value="Submit">Submit<i class=" icon-long-arrow-right"></i></button></div> 
</form>

<div id="msg_sucess" style="clear:both;color:#C13F00;line-height:25px;font-size:18px"><?php
if(isset($_REQUEST['msg'])and $_REQUEST['msg']=="error")
 {
  ?> Sorry the email address you entered is not the one on file in the CMS. Please try another one or contact your
  <a href="http://www.santarosawebsite.com/contact.php" target="_blank"> webmaster.</a><?php
 }
?></div></div></body>
<!-- END BODY -->

<!-- Mirrored from thevectorlab.net/metrolab/login.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 10 Oct 2013 05:39:42 GMT -->
</html><?php
if($_GET['msg']=='error')
{
 ?><script type="text/javascript">
 $(document).ready(function(){
 $("#msg_sucess").show();
  setTimeout(function() { $("#msg_sucess").hide(); }, 49000);
 });
 </script><?php
}?>