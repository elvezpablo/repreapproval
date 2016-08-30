<?php
require '../vendor/autoload.php';
include("admin/config.php");
include('mailgun/RPAMailGun.php');

if(!$_SESSION['logge'] or !isset($_SESSION['logge']['id']))
 {
   header('location:index.php');
 }

$addrea= 'roko';//to set limit of adding realtors, based on memership type
$vgsx= mysql_query("select id from userthree where accounttype= 'REALTOR' and `email`!='SANTDASDUBEY_HAS_DELETED' and createdby= '".$_SESSION['logge']['id']."'");
$xspo= array();
while($kod= mysql_fetch_assoc($vgsx))
 {
   $xspo[]= $kod;
 }
//if($_SESSION['logge']['plan']=='platinumPlan' and count($xspo)<51)
if($_SESSION['logge']['plan']=='platinumPlan')
 {
   $addrea= 'jaanedo';
 }
if($_SESSION['logge']['plan']=='goldPlan' and count($xspo)<50)
 {
   $addrea= 'jaanedo';
 }
if($_SESSION['logge']['plan']=='silverPlan' and count($xspo)<10)
 {
   $addrea= 'jaanedo';
 }

if(isset($_REQUEST['realsubmit']) and $_REQUEST['realsubmit']=='Add a realtor you work with' and $addrea=='jaanedo')
 {
   if($_REQUEST['first_name']!='' and $_REQUEST['user_email']!='' and $_REQUEST['dre']!='' and $_REQUEST['company']!='' and $_REQUEST['zip']!='' and $_REQUEST['phone']!='')
    {
	  $selec= mysql_fetch_assoc(mysql_query("select * from userthree where `email` = '".$_REQUEST['user_email']."' or `DRE`= '".$_REQUEST['dre']."'"));
	  if(isset($selec['id']) and $selec['id']!='')
 	   {
  		 if($selec['accounttype']=='REALTOR')
		  {
			$nrecre= $selec['createdby'].','.$_SESSION['logge']['id'];
			$vcdf= explode(',', $nrecre);
			$vvf= array_unique($vcdf);
			$nrecre= implode(',', $vvf);
			mysql_query("update `userthree` set `createdby` = '".$nrecre."' where `id` = '".$selec['id']."'");
			
			$subject= "Congratulations - One more lender has started working with you.";
			$to= $_REQUEST['user_email'];
			$from= "admin@repreapproval.com";

			$mess= '<table width="550px">
			<tr><td style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px" /></td></tr>
			<tr><td style="background-color:#045D92;height:10px"></td></tr>
			<tr><td style="color:#000;"> Congratulations! You have been successfully registered with RePreApproval by another lender.</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td> Your login information remains the same. </td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>If you require additional assistance, do not hesitate to email us or visit our <a href="http://www.repreapproval.com/faq.php">Frequently Asked Questions</a> page.</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>Thank you for using <strong>RePreApproval</strong> for your customers pre-aproval letters.</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>We wish you great success.</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>The Team at <strong>RePreApproval</strong></td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply go to: http://www.repreapproval.com/login.php</td></tr>
			<tr><td style="background-color:#045D92;height:2px"></td></tr><tr><td>&nbsp;</td></tr></table>';
              $mailgun = new RPAMailGun();
              if($mailgun->mail($to, $subject, $mess, array('addrealtor', 'lender'))) {

              }
//			$headers  = 'MIME-Version: 1.0' . "\r\n";
//			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//			$headers .= 'From: '.$from. "\r\n";
//			mail($to, $subject, $mess, $headers);
			unset($to);
			unset($from);
			unset($subject);
			unset($mess);
			unset($headers);
			
		  }
		 else
		  {
			echo 'Already registered Email';
		    header("location:addrealtor.php");
		    exit;
		  }
 	   }
	  else
	   {
		 //echo 'We are right'; exit;
		 $tty= time();
		 $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $randstring = '';
         for ($i = 0; $i < 10; $i++) 
          {
           $randstring .= $characters[rand(0, strlen($characters))];
          }
         $passw= $randstring;
		 $inser= mysql_query("insert into userthree (`firstname`, `lastname`, `companyname`, `license`, `DRE`, `phone`, `email`, `username`, `password`, `accounttype`, `street`, `suite`, `city`, `state`, `zip`, `createdby`, `created`) values ('".$_REQUEST['first_name']."', '".$_REQUEST['last_name']."', '".$_REQUEST['company']."', '".$_REQUEST['license']."', '".$_REQUEST['dre']."', '".$_REQUEST['phone']."', '".$_REQUEST['user_email']."', '".$_REQUEST['user_email']."', '".$passw."', 'REALTOR', '".$_REQUEST['streetaddress']."', '".$_REQUEST['suite']."', '".$_REQUEST['city']."', '".$_REQUEST['state']."', '".$_REQUEST['zip']."', '".$_SESSION['logge']['id']."', '".$tty."')");
		$subject= "Welcome to RePreApproval - You have been successfully registered by your lender.";
		$to= $_REQUEST['user_email'];
		$from= "admin@repreapproval.com";
		$mess= '<table width="550px">
		<tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px" /></td></tr>
		<tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr>
		<tr><td colspan="2" style="color:#000;">Congratulations! You have been successfully registered with <strong>RePreApproval</strong> by your preferred lender.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td><strong style="color:#000;">Username</strong></td><td><strong style="color:#045D92;">'.$_REQUEST['user_email'].'</strong></td></tr>
		<tr><td><strong style="color:#000;">Password</strong></td><td><strong style="color:#045D92;">'.$passw.'</strong></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Please keep your login information in a secured location. We also invite you to change your password at your convenience.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">If you require additional assistance, do not hesitate to email us or visit our <a href="http://www.repreapproval.com/faq.php">Frequently Asked Questions</a> page.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Thank you for using <strong>RePreApproval</strong> for your customers pre-aproval letters.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">We wish you great success.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">The Team at <strong>RePreApproval</strong></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply go to: http://www.repreapproval.com/login.php</td></tr>
		<tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr></table>';
//		$headers  = 'MIME-Version: 1.0' . "\r\n";
//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//		$headers .= 'From: '.$from. "\r\n";
//		mail($to, $subject, $mess, $headers);
          $mailgun = new RPAMailGun();
          if($mailgun->mail($to, $subject, $mess, array('addrealtor','register'))) {

          }
		unset($to);
		unset($from);
		unset($subject);
		unset($mess);
		unset($headers);
		
		$subject= "Welcome to RePreApproval - You have successfully added a realtor with you.";
		$to= $_SESSION['logge']['email'];
		$from= "admin@repreapproval.com";
		
		$mess= '<table width="550px">
		<tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px" /></td></tr>
		<tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr>
		<tr><td colspan="2" style="color:#000;">Congratulations! You have successfully added a realtor with you.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td><strong style="color:#000;">Realtor Name</strong></td><td><strong style="color:#045D92;">'.$_REQUEST['first_name'].' '.$_REQUEST['last_name'].'</strong></td></tr>
		<tr><td colspan="2">If you require additional assistance, do not hesitate to email us or visit our <a href="http://www.repreapproval.com/faq.php">Frequently Asked Questions</a> page.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Thank you for using <strong>RePreApproval</strong> for your customers pre-aproval letters.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">We wish you great success.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">The Team at <strong>RePreApproval</strong></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply go to: http://www.repreapproval.com/login.php</td></tr>
		<tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr><tr><td colspan="2">&nbsp;</td></tr></table>';
//		$headers  = 'MIME-Version: 1.0' . "\r\n";
//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//		$headers .= 'From: '.$from. "\r\n";
//		mail($to, $subject, $mess, $headers);
          if($mailgun->mail($to, $subject, $mess, array('addrealtor','added'))) {

          }
		$_SESSION['msg']='added';
		header('location:lenderdashboard.php?tab=realtors');
	   }
	}
 }
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Add a Realtor in your RePreApproval account</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php"); ?>
<script type="text/javascript">
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


function checkBREblur(bb)
 {
   $("#alread").val("");
   var vv= $('#'+bb).val();
   if(vv=='')
    {
	  $('#'+bb).attr('placeholder', 'Fill this field');
	  $('#'+bb).addClass('error');
	  err= 1;
	}
   else
    {
     $.ajax({
	  type: "POST",
	  data:{matcBRE:vv},
	  url: "ajaxX.php",
	  dataType: "html",
	  success:function(data)
	   {
		//$("#license").val("");
		$("#company").val("");
		$("#streetaddress1").val("");
		$("#suite").val("");
		$("#city").val("");
		$("#state").val("");
		$("#zip").val("");
		$("#phone").val("");
		
		if(data=='alright')
		 {
		  $('#alread').attr('value', 'GOTRUE');
		  $('#'+bb).removeClass('error');
		  err= 0;
		 }
		else if(data=='wrong')
		 {
		  $('#'+bb).addClass('error');
		  $("#"+bb).val("");
		  $('#'+bb).attr('placeholder', 'Email Already Registered');
		  err= 1;
		 }
		else
		 {
		  var aram= data.split('_@_');
		  alert("We found a match for you. Realtor name is: '"+aram[1]+"' and his/her BRE is: '"+aram[2]+"'. Press OKAY to continue with this realtor.");
		  //first_name//last_name//user_email//license//dre//company//streetaddress1//suite//city//state//zip//phone
		  $("#first_name").val(aram[1]);
		  $("#last_name").val(aram[3]);
		  $("#user_email").val(aram[12]);
		  $("#license").val(aram[5]);
		  //$("#dre").val(aram[2]);
		  $("#company").val(aram[4]);
		  $("#streetaddress1").val(aram[7]);
		  $("#suite").val(aram[8]);
		  $("#city").val(aram[9]);
		  $("#state").val(aram[10]);
		  $("#zip").val(aram[11]);
		  $("#phone").val(aram[6]);
		  
		  //aram[3]= lastname
		  //aram[4]= companyname
		  //aram[5]= license
		  //aram[6]= phone
		  //aram[7]= street
		  //aram[8]= suite
		  //aram[9]= city
		  //aram[10]= stste
		  //aram[11]= zip
		  
		  $('#alread').attr('value', 'GOTRUE');
		  $('#'+bb).removeClass('error');
		  err= 0;
		}
	  }
	 });
	}
 }


function checkmablur(ee)
 {
   $("#alread").val("");
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
		 $.ajax({
    		type: "POST",
    		data:{matchmai:vv},
    		url: "ajaxX.php",
    		dataType: "html",
    		success:function(data)
	  		 {
	   		   //$("#license").val("");
			   //$("#dre").val("");
			   $("#company").val("");
			   $("#streetaddress1").val("");
			   $("#suite").val("");
			   $("#city").val("");
			   $("#state").val("");
			   $("#zip").val("");
			   $("#phone").val("");
			   
			   if(data=='alright')
			    {
				  $('#alread').attr('value', 'GOTRUE');
				  $('#'+ee).removeClass('error');
	     		  err= 0;
				}
			   else if(data=='wrong')
			    {
				  $('#'+ee).addClass('error');
		 		  $("#"+ee).val("");
		 		  $('#'+ee).attr('placeholder', 'Email Already Registered');
	     		  err= 1;
				}
			   else
			    {
				  var aram= data.split('_@_');
				  alert("We found a match for you. Realtor name is: '"+aram[1]+"' and his/her BRE is: '"+aram[2]+"'. Press OKAY to continue with this realtor.");
				  //first_name//last_name//user_email//license//dre//company//streetaddress1//suite//city//state//zip//phone
				  $("#first_name").val(aram[1]);
				  $("#last_name").val(aram[3]);
				  //$("#user_email").val("");
				  $("#license").val(aram[5]);
				  $("#dre").val(aram[2]);
				  $("#company").val(aram[4]);
				  $("#streetaddress1").val(aram[7]);
				  $("#suite").val(aram[8]);
				  $("#city").val(aram[9]);
				  $("#state").val(aram[10]);
				  $("#zip").val(aram[11]);
				  $("#phone").val(aram[6]);
				  
				  //aram[3]= lastname
				  //aram[4]= companyname
				  //aram[5]= license
				  //aram[6]= phone
				  //aram[7]= street
				  //aram[8]= suite
				  //aram[9]= city
				  //aram[10]= stste
				  //aram[11]= zip
				  
				  $('#alread').attr('value', 'GOTRUE');
				  $('#'+ee).removeClass('error');
	     		  err= 0;
				}
	  		 }
  		 });
	   }
	}
 }

function fillfield(ee)
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
	  $('#'+ee).removeClass('error');
	  err= 0;
	}
 }

$(document).ready(function(){
  
  $('.phomo').keyup(function()
   {
    this.value = this.value.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
	//this.value = this.value.replace(/(\d{4})\-?/g,'$1-');
   });
  
  $('.poin').on('keydown',function(event){
   var e = event || evt;
   var charCode = e.which || e.keyCode;
   if(charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105))
	 return false;
   return true;
  });
  
  $('#registerform').submit(function(){
	//first_name//user_email//license//company//zip//phone
	fillfield('first_name');
	checkma('user_email');
	//fillfield('license');
	fillfield('dre');
	fillfield('company');
	fillfield('zip');
	fillfield('phone');
	if(err==1)
	 {
	   return false;
	 }
	if($('#alread').val()!='GOTRUE')
	 {
	   return false;
	 }
  });
});
</script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<header>
<?php include("includes/header.php"); ?>
</header>
  <div class="breadcrumb-container">
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
          <h1>Add a realtor you are associated with</h1>
          <!--<ol class="breadcrumb"><li class="active">Quick, efficient and powerful!</li>-->
          </ol>
        </div>  
      </div> 
    </div> 
  </div>
<div class="space20"></div>
<div class="container">
<div class="row">
<div class="col-md-8"><?php
if($addrea=='jaanedo')
 {
   ?><div class="login">

<form name="registerform" id="registerform" action="addrealtor.php" method="post" class="form-horizontal">

<p id="reg_passmail"></p>
<input type="hidden" id="alread"/>

<div class="form-group"><label class="col-sm-3" for="first_name">Realtor's first name</label>
<div class="col-sm-9"><input type="text" name="first_name" id="first_name" onBlur="fillfield('first_name');" class="input" size="50"/></div></div>

<div class="form-group"><label class="col-sm-3" for="last_name">Realtor's last name</label>
<div class="col-sm-9"><input type="text" name="last_name" id="last_name" class="input" size="50"/></div></div>


<div class="form-group"><label class="col-sm-3" for="license">BRE license</label>
<div class="col-sm-9"><input type="text" name="dre" onBlur="checkBREblur('dre');" id="dre" class="input" size="50" /></div></div>

<div class="form-group"><label class="col-sm-3" for="license">NMLS license</label>
<div class="col-sm-9"><input type="text" name="license" id="license" class="input" size="50" /></div></div>

<div class="form-group"><label class="col-sm-3" for="user_email">Realtor's email</label>
<div class="col-sm-9"><input type="text" name="user_email" id="user_email" onBlur="checkmablur('user_email');" class="input" size="50" /></div></div>

<div class="form-group"><label class="col-sm-3" for="company">Real Estate Agency Name</label>
<div class="col-sm-9"><input type="text" name="company" onBlur="fillfield('company');" id="company" class="input" size="50" /></div></div>

<div class="form-group"><label class="col-sm-3">Street address</label>
<div class="col-sm-9"><input id="streetaddress1" type="text" class="input" size="50" name="streetaddress" /></div></div>   

<div class="form-group"><label class="col-sm-3">Suite #</label>
<div class="col-sm-9"><input id="suite" type="text" class="input" size="50" name="suite" /></div></div>

<div class="form-group"><label class="col-sm-3">City</label>
<div class="col-sm-9"><input id="city" type="text" class="input" size="50" name="city" /></div></div>

<div class="form-group"><label class="col-sm-3">State</label>
<div class="col-sm-9"><input id="state" type="text" class="input" size="50" name="state" /></div></div>

<div class="form-group"><label class="col-sm-3">ZIP code</label>
<div class="col-sm-9"><input id="zip" onBlur="fillfield('zip');" type="text" class="input poin" size="50" name="zip" /></div></div>

<div class="form-group"><label class="col-sm-3">Phone</label>
<div class="col-sm-9"><input id="phone" onBlur="fillfield('phone');" type="text" class="input phomo" size="50" name="phone" /></div></div>

<div class="form-group submit"><label class="col-sm-3">&nbsp;&nbsp;</label>
<div class="col-sm-9"><input type="submit" name="realsubmit" value="Add a realtor you work with" class="btn btn-primary"/></div></div>

<p>&nbsp;</p>

<div></div></form></div><?php

 }
else
 {
   ?><div style="background-color:#93CE52;text-align:center; width:100%;font-weight:bold;font-size:larger;padding:20px 10px;border: 1px solid #CACACA;border-bottom-left-radius: 50px;border-top-right-radius: 50px;color:#fff;">
   <span style="font-size:25px;">Upgrade your membership today to add more realtors</span><br><br>
   <a href="upgrade.php" style="font-size:larger;">Upgrade me now &#10138;</a><br><br>
   <a href="lenderdashboard.php">I will upgrade later &#10136;</a><br>
   <img src="images/logo2.png" alt="online pre approval letters for real estate" title="welcome to RePreApproval!"></div><?php
 }

?></div>
<!--
<div class="col-md-4">
<p><img src="images/lendersandrealtorsworkingtogether.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval"/></p>
<p><img src="images/increasecloserateonhomeoffers.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval" /></p>
</div>
--></div></div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer"><?php
include("includes/topfooter.php");
include("includes/footer.php");
?></footer><?php
include("includes/javascript.php");
?></body></html>