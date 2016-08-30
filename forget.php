<?php
require '../vendor/autoload.php';
include("admin/config.php");
include('mailgun/RPAMailGun.php');

if(isset($_REQUEST['submitt']) and isset($_REQUEST['logg']) and $_REQUEST['logg']!='')
 {
   $selec= mysql_fetch_assoc(mysql_query("select * from userthree where email = '".$_REQUEST['logg']."'"));
   if($selec['id']!='')
    {
	  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randstring = '';
      for ($i = 0; $i < 10; $i++) 
       {
        $randstring .= $characters[rand(0, strlen($characters))];
       }
      $passw= $randstring;
	  
	  $vgxs= mysql_query("UPDATE userthree SET `password`='".$passw."' WHERE `email`='".$_REQUEST['logg']."'");
	  if($vgxs)
	   {
		 $subject= "Password Recovery Assistance from RePreApproval";
		 $to= $_REQUEST['logg'];
		 $from= "admin@repreapproval.com";
		 $mess= '<table width="550px"><tr><td colspan="2" style="background-color:#93CE52">
		 <img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px"/>
	     </td></tr><tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr><tr><td colspan="2">&nbsp;</td></tr>
		 <tr><td colspan="2">Hello '.$selec['firstname'].',</td></tr><tr><td colspan="2">&nbsp;</td></tr>
		 <tr><td colspan="2">This is a copy of your password you requested. If you did not ask for this reminder, we recommend that you log into your
		 <strong>RePreApproval</strong> account and change your password.</td></tr><tr><td colspan="2">&nbsp;</td></tr>
		 
		 <tr><td><strong style="color:#000;">Your Login ID:</strong></td> <td><strong style="color:#045D92;">'.$to.'</strong></td></tr>
		 <tr><td><strong style="color:#000;">Your Password:</strong></td> <td><strong style="color:#045D92;">'.$passw.'</strong></td></tr>
		 
		 <tr><td colspan="2">&nbsp;</td></tr>
		 <tr><td colspan="2">Thank you for choosing <strong>RePreApproval</strong>.</td></tr><tr><td colspan="2">&nbsp;</td></tr>
		 <tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply click on this <strong style="color:#000;"><a href="http://www.repreapproval.com/login.php">link</a></strong>.</td></tr>
		 
		 <tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr><tr><td colspan="2">&nbsp;</td></tr></table>';
           $mailgun = new RPAMailGun();
           if($mailgun->mail($to, $subject, $mess, array('forget'))) {

           }

//		 $headers  = 'MIME-Version: 1.0' . "\r\n";
//		 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//		 $headers .= 'From: '.$from. "\r\n";
//		 mail($to, $subject, $mess, $headers);
//
		 header('location:passwordsent.php');
	   }
	  
	}
   else
    {
	  $_SESSION['msg']='noren';
	  //echo 'This email address is not registered';
	}
 }

?><!DOCTYPE html>
<html class="not-ie" lang="en">
<head>
<meta charset="utf-8">
<title>Password Recovery Assistance from RePreApproval</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php"); ?>
<script>
var err= 0;
function checkma(ee)
 {
   var vv= $('#'+ee).val();
   if(vv=='')
    {
	  $('#'+ee).attr('placeholder', 'Fill this field');
	  $('#'+ee).addClass('error');
	  err= 1;
	}
   else
    {
	  var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
	  var valid = emailRegex.test(vv);
	  if(!valid)
	   {
	     $('#'+ee).addClass('error');
		 $("#"+ee).val("");
		 $('#'+ee).attr('placeholder', 'Invalid email');
	     err= 1;
	   }
	  else
	   {
		 $('#'+ee).removeClass('error');
	     err= 0;
	   }
	}
 }

$(document).ready(function(){
  
  $('#forgg').submit(function(){
    checkma('logaa');
	if(err==1)
	 {
	   return false;
	 }
  });
  
  <?php
  if(isset($_SESSION['msg']) and $_SESSION['msg']!='')
   {
	 if($_SESSION['msg']=='noren')
	  {
		?> $('#nore').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 unset($_SESSION['msg']);
   }
  
  ?>
  
});

</script>
</head>       
<body>
<?php include_once("analyticstracking.php") ?>
<header> 
<?php include("includes/header.php");?>
</header>
  <div class="breadcrumb-container">
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
         <h1>Password Recovery Assistance</h1>
          <!--<ol class="breadcrumb"><li class="active">Quick, efficient and powerful!</li>--></ol>
        </div>  
      </div> 
    </div> 
  </div>
<div class="space20"></div>
<div class="container">
<div class="row">
<div class="col-md-8">
<div style="background-color:#E7B987; text-align:center; width:500px; display:none" id="nore">This email address is not registered</div>
<div class="login">
<form action='' method='post' id="forgg">
<p>Enter the email address we have on file for you and our system will email you your password shortly.</p>
<div style="float:left;width:100px;">
<label><span>Email</span>
<br><br>
<br><br>
</div>
<div>
<input type='text' name='logg' id='logaa' onBlur="checkma('logaa');" value='' size='40' /><span class='et_protected_icon'></span></label>
<br><br>
<input type='submit' name='submitt' value='Recover my password' class='btn btn-primary' />
</div>

</form>
</div>
</div>
<div class="col-md-4">
<p><img src="images/securedonlineportalforlenders.png" alt="secured online preapproval for lender" title="ReReApproval - Secured lending" /></p>
</div>          
</div> 
</div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer"><?php
include("includes/topfooter.php");
include("includes/footer.php");
?></footer><?php
include("includes/javascript.php");
?></body>
</html>