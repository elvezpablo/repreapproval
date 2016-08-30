<?php include("admin/config.php");
if(!$_SESSION['logge'] or !isset($_SESSION['logge']['id']))
 {
   header('location:index.php');
 }

if(!isset($_REQUEST['buyid']) or $_REQUEST['buyid']=='' or !isset($_REQUEST['edbystam']) or $_REQUEST['edbystam']=='')
 {
   header('location:lenderdashboard.php');
 }

if(isset($_REQUEST['buysubmit']) and $_REQUEST['buysubmit']=="Update Home Buyer details")
 {
   $exisalbuy= mysql_fetch_assoc(mysql_query("select id, email from userthree where id!='".$_REQUEST['byrids']."' and email='".$_REQUEST['user_email']."'"));
   if(isset($exisalbuy['id']) and $exisalbuy['id']!='')
    {
	   $_SESSION['msg']='NOT_success';
	   header('location:lenderdashboard.php?tab=homebuyers');
	   exit;
	}
   else
    {
	   if($_REQUEST['byrids']!='' and $_REQUEST['break']=='jao' and $_REQUEST['first_name']!='' and $_REQUEST['user_email']!='' and $_REQUEST['phone']!='' and $_REQUEST['zip']!='' and isset($_REQUEST['rtr']))
		{
		  $allother= $_REQUEST['byr1'].'@=@'.$_REQUEST['byr2'].'@=@'.$_REQUEST['byr3'];
		  if($_REQUEST['rtr']=='')// realtor of this Buyer is removed from this lender account
		   {
			 $changed= mysql_query("update `userthree` set `email`='".$_REQUEST['user_email']."', `username`= '".$_REQUEST['user_email']."', `firstname`= '".$_REQUEST['first_name']."', `phone`= '".$_REQUEST['phone']."', `otherbuyer`= '".$allother."', `street`= '".$_REQUEST['streetaddress']."', `city`= '".$_REQUEST['city']."', `state`= '".$_REQUEST['state']."', `zip`= '".$_REQUEST['zip']."' where id= '".$_REQUEST['byrids']."'");
		     
		   }
		  else
		   {
			 $changed= mysql_query("update `userthree` set `email`='".$_REQUEST['user_email']."', `username`= '".$_REQUEST['user_email']."', `firstname`= '".$_REQUEST['first_name']."', `phone`= '".$_REQUEST['phone']."', `otherbuyer`= '".$allother."', `street`= '".$_REQUEST['streetaddress']."', `city`= '".$_REQUEST['city']."', `state`= '".$_REQUEST['state']."', `zip`= '".$_REQUEST['zip']."', `createdby`= '".$_REQUEST['rtr']."' where id= '".$_REQUEST['byrids']."'");
		     
		   }
		  
		  if($changed)
		   {
			 $_SESSION['msg']='tedUBU';
			 header('location:lenderdashboard.php?tab=homebuyers');
			 exit;
		   }
		}
	}
 }

if(isset($_REQUEST['buyid']) and $_REQUEST['buyid']!='' and isset($_REQUEST['edbystam']) and $_REQUEST['edbystam']!='')
 {
   $hbyerEd= mysql_fetch_assoc(mysql_query("select * from `userthree` where `id`= '".$_REQUEST['buyid']."' and `created`='".$_REQUEST['edbystam']."' and `accounttype`= 'HOMEBUYER' and `lender_of_buyer`= '".$_SESSION['logge']['id']."'"));
   $bhsxc= explode('@=@', $hbyerEd['otherbuyer']);
   
   $allreal= array();
   //$cdf= mysql_query("select * from userthree where `createdby`= '".$_SESSION['logge']['id']."' and `accounttype`= 'REALTOR'");
   $cdf= mysql_query("select * from userthree where FIND_IN_SET('".$_SESSION['logge']['id']."', createdby) and `accounttype`= 'REALTOR'");
   if($cdf)
    {
     while($ops=mysql_fetch_assoc($cdf))
      {
	   $allreal[]=$ops;
	  }
    }
   
 }

?><!DOCTYPE html>
<html class="not-ie" lang="en"><head>
<meta charset="utf-8">
<title>Add a Realtor in your RePreApproval account</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php"); ?> 
<script type="text/javascript">
var err= 0;
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
	//fillfield('byr1');
	//fillfield('byr2');
	//fillfield('byr3');
	fillfield('first_name');
	checkma('user_email');
	fillfield('phone');
	fillfield('streetaddress');
	fillfield('city');
	fillfield('state');
	fillfield('zip');
	if(err==1)
	 {
	   return false;
	 }
	if($('#break').val()=='ruko')
	 {
	   return false;
	 }
  });
  
});
</script>
</head>
<body>
<?php include_once("analyticstracking.php"); ?>
<header>
<?php include("includes/header.php"); ?>
</header>
  <div class="breadcrumb-container">
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
          <h1>Edit a realtor you are associated with</h1>
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
if($hbyerEd)
 {
   ?>
   <div class="login">
    <form name="registerform" id="registerform" action="editbuyer.php" method="post" class="form-horizontal">
    <p id="reg_passmail"></p>
     <input type="hidden" name="byrids" value="<?php echo $hbyerEd['id']; ?>"/>
    <div class="form-group"><label class="col-sm-3" for="last_name2">Home Buyer #1</label><div class="col-sm-9"><input type="text" name="first_name" value="<?php echo $hbyerEd['firstname']; ?>" id="first_name" onBlur="fillfield('first_name');" class="input" size="50" /></div></div>
    <div class="form-group"><label class="col-sm-3" for="first_name1">Home Buyer #2</label><div class="col-sm-9"><input type="text" name="byr1" id="byr1" value="<?php echo $bhsxc['0']; ?>" class="input" size="50" /></div></div>
    <div class="form-group"><label class="col-sm-3" for="last_name1">Home Buyer #3</label><div class="col-sm-9"><input type="text" name="byr2" id="byr2" value="<?php echo $bhsxc['1']; ?>" class="input" size="50" /></div></div>
    <div class="form-group"><label class="col-sm-3" for="first_name2">Home Buyer #4</label><div class="col-sm-9"><input type="text" name="byr3" id="byr3" value="<?php echo $bhsxc['2']; ?>" class="input" size="50" /></div></div>
    
    <div class="form-group"><label class="col-sm-3" for="hbuser_email">Home Buyers' email</label><div class="col-sm-9"><input type="text" name="user_email" value="<?php echo $hbyerEd['email']; ?>" id="user_email" onBlur="checkma('user_email');" class="input" size="50"/></div></div>
    <div class="form-group"><label class="col-sm-3" for="hbphone">Home Buyers' phone</label><div class="col-sm-9"><input type="text" name="phone" value="<?php echo $hbyerEd['phone']; ?>" id="phone" onBlur="fillfield('phone');" class="input phomo" size="50" /></div></div>
    <div class="form-group"><label class="col-sm-3" for="hbrealtor">Realtor handling their purchase</label><div class="col-sm-9"><?php
    if(isset($allreal) and count($allreal)>0)
     {
      ?><select class="input" name="rtr" style="width:416px"><?php
      $rr= 'd';
	  foreach($allreal as $bhs=>$vgs)
       {
        ?><option value="<?php echo $vgs['id']; ?>" <?php if($vgs['id']==$hbyerEd['createdby']){ ?> selected <?php $rr= 'ff'; } ?> ><?php echo $vgs['firstname']; ?></option> <?php
       }
      if($rr=='d')
	   {
		 ?><option value="" selected>Deleted Realtor</option> <?php
	   }
	  ?></select><input type="hidden" name="break" id="break" value="jao"/><?php
     }
    else
     {
      ?><input type="text" value="YOU DO NOT HAVE ANY REALTOR" class="input error" size="50" readonly/>
      <input type="hidden" name="break" id="break" value="ruko"/><?php
     }
    
	?></div></div>
    <div class="form-group"><label class="col-sm-3"> Street address</label><div class="col-sm-9"><input id="streetaddress1" type="text" class="input" size="50" value="<?php echo $hbyerEd['street']; ?>" name="streetaddress" /></div></div>   
    <div class="form-group"><label class="col-sm-3"> City</label><div class="col-sm-9"><input id="city" type="text" class="input" size="50" value="<?php echo $hbyerEd['city']; ?>" name="city"/></div></div>
    <div class="form-group"><label class="col-sm-3"> State</label><div class="col-sm-9"><input id="state" type="text" class="input" size="50" value="<?php echo $hbyerEd['state']; ?>" name="state"/></div></div>
    <div class="form-group"><label class="col-sm-3"> ZIP code</label><div class="col-sm-9"><input id="zip" type="text" class="input poin" value="<?php echo $hbyerEd['zip']; ?>" onBlur="fillfield('zip');" size="50" name="zip"/></div></div>
    <div class="form-group submit"><label class="col-sm-3">&nbsp;</label><div class="col-sm-9"><input type="submit" name="buysubmit" value="Update Home Buyer details" class="btn btn-primary"/></div></div>
    </form>
   </div><?php
 }
else
 {
   ?><div style="background-color:#E7B987; text-align:center; width:500px;">No Record Found</div><?php
 }
?></div>
<!--
<div class="col-md-4">
<p><img src="images/lendersandrealtorsworkingtogether.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval"/></p>
<p><img src="images/increasecloserateonhomeoffers.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval" /></p>
</div>
-->
</div></div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer"><?php
include("includes/topfooter.php");
include("includes/footer.php");
?></footer><?php
include("includes/javascript.php");
?></body>
</html>