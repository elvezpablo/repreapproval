<?php
require '../vendor/autoload.php';
include("admin/config.php");
include('mailgun/RPAMailGun.php');

if(!$_SESSION['logge'] or !isset($_SESSION['logge']['id']))
 {
   header('location:index.php');
 }
if(!isset($_REQUEST['edrealid']) or $_REQUEST['edrealid']=='' or !isset($_REQUEST['edrealstam']) or $_REQUEST['edrealstam']=='')
 {
   header('location:lenderdashboard.php');
 }
if(isset($_REQUEST['edrealid']) and $_REQUEST['edrealid']!='' and isset($_REQUEST['edrealstam']) and $_REQUEST['edrealstam']!='')
 {
   $realtorEd= mysql_fetch_assoc(mysql_query("select * from `userthree` where `id`= '".$_REQUEST['edrealid']."' and `created`='".$_REQUEST['edrealstam']."' and `accounttype`= 'REALTOR'"));
 }
if(isset($_REQUEST['landsubmit']) and $_REQUEST['landsubmit']=="Edit your realtor's profile")
 {
   if($_REQUEST['oldpas']!='' and $_REQUEST['first_name']!='' and $_REQUEST['company']!='' and $_REQUEST['dre']!='' and $_REQUEST['zip']!='' and $_REQUEST['phone']!='')
    {
	  $changed= mysql_query("update `userthree` set `password`= '".$_REQUEST['oldpas']."', `firstname`= '".$_REQUEST['first_name']."', `lastname`= '".$_REQUEST['last_name']."', `companyname`= '".$_REQUEST['company']."', `license`='".$_REQUEST['license']."', `street`= '".$_REQUEST['streetaddress1']."', `suite`= '".$_REQUEST['suite']."', `city`= '".$_REQUEST['city']."', `state`= '".$_REQUEST['state']."', `zip`= '".$_REQUEST['zip']."', `phone`= '".$_REQUEST['phone']."' where id= '".$_REQUEST['edrlid']."'");
	  //$changed= mysql_query("update `userthree` set `password`= '".$_REQUEST['oldpas']."', `firstname`= '".$_REQUEST['first_name']."', `lastname`= '".$_REQUEST['last_name']."', `companyname`= '".$_REQUEST['company']."', `license`='".$_REQUEST['license']."', `DRE`='".$_REQUEST['dre']."', `street`= '".$_REQUEST['streetaddress1']."', `suite`= '".$_REQUEST['suite']."', `city`= '".$_REQUEST['city']."', `state`= '".$_REQUEST['state']."', `zip`= '".$_REQUEST['zip']."', `phone`= '".$_REQUEST['phone']."' where id= '".$_REQUEST['edrlid']."'");
	  if($changed)
	   {
		 $subject= "Account Details Updated from RePreApproval";
		 $to= $_REQUEST['maile'];
		 $from= "admin@repreapproval.com";
		 
		 $mess= '<table width="550px">
		 <tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style=""width:340px" /></td></tr>
		 <tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr>
		 <tr><td colspan="2">&nbsp;</td></tr>
		 <tr><td colspan="2">Hello '.$_REQUEST["first_name"].',</td></tr>
		 <tr><td colspan="2">&nbsp;</td></tr>
		 <tr><td colspan="2">This is a copy of your updated account. Your lender has changed your account information, we recommend that you log into your <strong>RePreApproval</strong> account with new details.</td></tr>
		 <tr><td colspan="2">&nbsp;</td></tr>
		 <tr><td><strong style="color:#000;">Your Password:</strong> <strong style="color:#045D92;">'.$_REQUEST["oldpas"].'</strong></td></tr>
		 <tr><td colspan="2">&nbsp;</td></tr>
		 <tr><td colspan="2">Thank you for choosing <strong>RePreApproval</strong>.</td></tr>
		 <tr><td colspan="2">&nbsp;</td></tr>
		 <tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply click on this <a href="http://www.repreapproval.com/login.php"><strong style="color:#000;">link</strong></a>.</td></tr>
		 <tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr>
		 <tr><td colspan="2">&nbsp;</td></tr></table>';
//		 $headers  = 'MIME-Version: 1.0' . "\r\n";
//		 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//		 $headers .= 'From: '.$from. "\r\n";
//		 mail($to, $subject, $mess, $headers);
          if($mailgun->mail($to, $subject, $mess, array('editrealtor'))) {

          }

		 header('location:lenderdashboard.php?tab=realtors');
		 $_SESSION['msg']='tedU';
		 exit;
	   }
	}
 }
?><!DOCTYPE html>
<html class="not-ie" lang="en">
<head><meta charset="utf-8">
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
	fillfield('user_login');
	fillfield('first_name');
	fillfield('oldpas');
	//fillfield('license');
	fillfield('dre');
	fillfield('company');
	fillfield('zip');
	fillfield('phone');
	if(err==1)
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
    <div class="col-md-8">
      <?php
if($realtorEd)
 {
   ?>
      <div class="login">
        <form name="registerform" id="registerform" action="editrealtor.php" method="post" class="form-horizontal">
          <input type="hidden" name="edrlid" value="<?php echo $_REQUEST['edrealid']; ?>"/>
          <p id="reg_passmail"></p>
          <div class="form-group">
          <label class="col-sm-3" for="first_name">First name</label>
          <div class="col-sm-9">
            <input type="text" name="first_name" id="first_name" class="input" onBlur="fillfield('first_name');" value="<?php echo $realtorEd['firstname']; ?>" size="50"/>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3" for="last_name">Last name</label>
          <div class="col-sm-9">
            <input type="text" name="last_name" id="last_name" class="input" value="<?php echo $realtorEd['lastname']; ?>" size="50"/>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3" for="pass1">Password</label>
          <div class="col-sm-9">
            <input autocomplete="off" name="oldpas" id="oldpas" class="input" size="50" value="<?php echo $realtorEd['password']; ?>" type="text"/>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3" for="user_email">Email</label>
          <div class="col-sm-9">
            <input type="text" class="input" name="maile" value="<?php echo $realtorEd['email']; ?>" size="50" readonly/>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3" for="nmls">NMLS license</label>
          <div class="col-sm-9">
            <input type="text" name="license" id="license" class="input" value="<?php echo $realtorEd['license']; ?>" size="50" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3" for="dre">BRE license</label>
          <div class="col-sm-9">
            <input type="text" name="dre" id="dre" class="input" onBlur="fillfield('dre');" value="<?php echo $realtorEd['DRE']; ?>" size="50" readonly/>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3" for="company">Agency name</label>
          <div class="col-sm-9">
            <input type="text" name="company" id="company" onBlur="fillfield('company');" class="input" value="<?php echo $realtorEd['companyname']; ?>" size="50" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3">Street address</label>
          <div class="col-sm-9">
            <input id="streetaddress1" type="text" class="input" size="50" value="<?php echo $realtorEd['street']; ?>" name="streetaddress1" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3">Suite #</label>
          <div class="col-sm-9">
            <input id="suite" type="text" class="input" size="50" value="<?php echo $realtorEd['suite']; ?>" name="suite" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3">City</label>
          <div class="col-sm-9">
            <input id="city" type="text" class="input" size="50" value="<?php echo $realtorEd['city']; ?>" name="city" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3">State</label>
          <div class="col-sm-9">
            <input id="state" type="text" class="input" size="50" value="<?php echo $realtorEd['state']; ?>" name="state" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3">ZIP code</label>
          <div class="col-sm-9">
            <input id="zip" type="text" class="input poin" size="50" onBlur="fillfield('zip');" value="<?php echo $realtorEd['zip']; ?>" name="zip" />
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-3">Phone</label>
          <div class="col-sm-9">
          <input id="phone" type="text" class="input phomo" size="50" onBlur="fillfield('phone');" value="<?php echo $realtorEd['phone']; ?>" name="phone" />
          </div>
          </div>
          <div class="form-group submit">
          <label class="col-sm-3">&nbsp;</label>
          <div class="col-sm-9">
            <input type="submit" name="landsubmit" value="Edit your realtor's profile" class="btn btn-primary"/>
          </div>
          </div>          
          <p>&nbsp;</p>
        </form>
      </div>
      <div> </div>
    </div>
    <?php
 }
else
 {
   ?>
    <div style="background-color:#E7B987; text-align:center; width:500px;">No Record Found</div>
    <?php
 }
?>
  </div>
  <!--<div class="col-md-4">
<p><img src="images/lendersandrealtorsworkingtogether.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval"/></p>
<p><img src="images/increasecloserateonhomeoffers.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval" /></p>
</div>--></div>
</div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer">
<?php
include("includes/topfooter.php");
include("includes/footer.php");
?>
</footer>
<?php include("includes/javascript.php"); ?>
</body>
</html>