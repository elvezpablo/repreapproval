<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//require '../vendor/autoload.php';
include("admin/config.php");
//include('mailgun/RPAMailGun.php');

if(!$_SESSION['logge'] or !isset($_SESSION['logge']['id']))
 {
    header('location:index.php');
 }

if(isset($_REQUEST['buysubmit']) and $_REQUEST['buysubmit']=='Add a Home Buyer you work with')
 {
   //if($_REQUEST['byr1']!='' and $_REQUEST['byr2']!='' and $_REQUEST['byr3']!='' and $_REQUEST['first_name']!='' and $_REQUEST['user_email']!='' and $_REQUEST['phone']!='' and $_REQUEST['zip']!='' and isset($_REQUEST['rtr']) and $_REQUEST['rtr']!='')
   if($_REQUEST['first_name']!='' and $_REQUEST['user_email']!='' and $_REQUEST['phone']!='' and $_REQUEST['zip']!='' and isset($_REQUEST['rtr']) and $_REQUEST['rtr']!='')
    {
	  $selec= mysql_fetch_assoc(mysql_query("select * from userthree where email = '".$_REQUEST['user_email']."'"));
	  if(isset($selec['id']) and $selec['id']!='')
 	   {
  		 header("location:addhomebuyer.php");
 	   }
	  else
	   {


		 //$inser= mysql_query($sql);

    // $subject= "Welcome to RePreApproval - Your lender has issued a pre-approval letter for you";
		// $to= $_REQUEST['user_email'];
		// $from= "admin@repreapproval.com";
		// $mess= '<table width="550px">
		// <tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style=""width:340px" /></td></tr>
		// <tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr>
		// <tr><td colspan="2" style="color:#000;">Congratulations! Your lender has issued a pre approval letter which your realtor can now access on <strong>RePreApproval</strong>.</td></tr>
		// <tr><td colspan="2">&nbsp;</td></tr>
		// <tr><td colspan="2">If you require additional assistance, please contact your lender or realtor.</td></tr>
		// <tr><td colspan="2">&nbsp;</td></tr>
		// <tr><td colspan="2">We wish you great success.</td></tr>
		// <tr><td colspan="2">&nbsp;</td></tr>
		// <tr><td colspan="2">The Team at <strong>RePreApproval</strong></td></tr>
		// <tr><td colspan="2">&nbsp;</td></tr>
		// <tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply <a href="http://www.repreapproval.com/login.php">click here</a>.</td></tr>
		// <tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr>
		// <tr><td colspan="2">&nbsp;</td></tr></table>';
    //       $mailgun = new RPAMailGun();
    //       if($mailgun->mail($to, $subject, $mess, array('addhomebuyer'))) {
    //           $_SESSION['msg']='HBadded';
    //           header('location:lenderdashboard.php?tab=homebuyers');
    //       }
	   }
	}
 }

$allreal= array();

//$cdf= mysql_query("select * from userthree where `createdby`= '".$_SESSION['logge']['id']."' and `accounttype`= 'REALTOR'");
$cdf= mysql_query("SELECT * from userthree WHERE FIND_IN_SET('".$_SESSION['logge']['id']."', createdby) and `accounttype`= 'REALTOR'");
if($cdf)
 {
   while($ops=mysql_fetch_assoc($cdf))
    {
	  $allreal[]=$ops;
	}
 }
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Add a Home Buyer in your RePreApproval account</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and Home Buyers, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, Home Buyers, realtos, mortgage lender, lenders">
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
		 $("#"+ee).attr("value", "");
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
		 //$("#"+ee).attr("val", "");
		 $("#"+ee).val("");
		 $('#'+ee).attr('placeholder', 'Invalid email');
	     err= 1;
	   }
	  else
	   {
		 $.ajax({
    		type: "POST",
    		data:{mai:vv},
    		url: "ajaxX.php",
    		dataType: "html",
    		success:function(data)
	  		 {
	   		   if(data=='alright')
			    {
				  $('#alread').attr('value', 'GOTRUE');
				  $('#'+ee).removeClass('error');
	     		  err= 0;
				}
			   else
			    {
				  $('#'+ee).addClass('error');
		 		  $("#"+ee).val("");
		 		  $('#'+ee).attr('placeholder', 'Email Already Registered');
	     		  err= 1;
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
	fillfield('first_name');
	checkma('user_email');
	fillfield('phone');
	fillfield('zip');
	//fillfield('byr1');
	//fillfield('byr2');
	//fillfield('byr3');
	if(err==1)
	 {
	   return false;
	 }
	if($('#break').val()=='ruko')
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
<?php include_once("analyticstracking.php"); ?>
<header>
<?php include("includes/header.php"); ?>
</header>
<div class="breadcrumb-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Add a home buyer you are associated with</h1>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="space20"></div>
<div class="container">
  <div class="row">
    <div class="col-md-8">
    <div class="login">
    <form name="registerform" id="registerform" action="addhomebuyer.php" method="post" class="form-horizontal">
      <p id="reg_passmail"></p>
      <input type="hidden" id="alread"/>
      <div class="form-group">
        <label class="col-sm-3" for="last_name2">Home Buyer #1</label>
        <div class="col-sm-9">
          <input type="text" name="first_name" id="first_name" onBlur="fillfield('first_name');" class="input" size="50" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3" for="first_name1">Home Buyer #2</label>
        <div class="col-sm-9">
          <input type="text" name="byr1" id="byr1" class="input" size="50" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3" for="last_name1">Home Buyer #3</label>
        <div class="col-sm-9">
          <input type="text" name="byr2" id="byr2" class="input" size="50" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3" for="first_name2">Home Buyer #4</label>
        <div class="col-sm-9">
          <input type="text" name="byr3" id="byr3" class="input" size="50" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3" for="hbuser_email">Home Buyer(s)' contact email</label>
        <div class="col-sm-9">
          <input type="text" name="user_email" id="user_email" onBlur="checkmablur('user_email');" class="input" size="50" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3" for="hbphone">Home Buyer(s)' contact phone</label>
        <div class="col-sm-9">
          <input type="text" name="phone" id="phone" onBlur="fillfield('phone');" class="input phomo" size="50"/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3" for="hbrealtor">Realtor handling their purchase</label>
        <div class="col-sm-9">
          <?php if(isset($allreal) and count($allreal)>0) { ?>
            <select class="input" name="rtr">
              <?php foreach($allreal as $bhs=>$vgs) { ?>
                <option value="<?php echo $vgs['id']; ?>"><?php echo $vgs['firstname'].' '.$vgs['lastname']; ?></option>
              <?php }?></select>
              <input type="hidden" id="break" value="jao"/>
          <?php } else { ?>
              <input type="text" value="YOU DO NOT HAVE ANY REALTOR" class="input error" size="50" readonly/>
		          <input type="hidden" id="break" value="ruko"/>
          <?php }?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3"> Street address</label>
        <div class="col-sm-9">
          <input id="streetaddress1" type="text" class="input" size="50" name="streetaddress"/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3"> City</label>
        <div class="col-sm-9">
          <input id="city" type="text" class="input" size="50" name="city"/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3"> State</label>
        <div class="col-sm-9">
          <input id="state" type="text" class="input" size="50" name="state"/>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3"> ZIP code</label>
        <div class="col-sm-9">
          <input id="zip" type="text" class="input poin" onBlur="fillfield('zip');" size="50" name="zip"/>
        </div>
      </div>
      <div class="form-group submit">
        <label class="col-sm-3">&nbsp;</label>
        <div class="col-sm-9">
        <input type="submit" name="buysubmit" value="Add a Home Buyer you work with" class="btn btn-primary"/>
        </div></div>
      <p>&nbsp;</p>
    </form>
  </div>
</div>

</div>
</div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer">
  <?php
    include("includes/topfooter.php");
    include("includes/footer.php");
    include("includes/javascript.php");
  ?>
</footer>
</body>
</html>
