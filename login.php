<?php
	include("admin/config.php");

	if(isset($_REQUEST['submit']) and $_REQUEST['log']!='' and $_REQUEST['pwd']!='') {
		$selec= mysql_fetch_assoc(mysql_query("select * from userthree where email = '".$_REQUEST['log']."' LIMIT 1"));
		//print_r($selec);
		if($selec)    {

			if($selec['password']==$_REQUEST['pwd'])   {

				if($selec['accounttype']=='LENDER')// lender is logging in
				{
					$_SESSION['logge']=$selec;
					header('location:lenderdashboard.php?tab=profile');
				}
				if($selec['accounttype']=='REALTOR')// realtor is logging in
				{
					$_SESSION['REAL_VEER']=$selec;
					header('location:realtordashboard.php?tab=profile');
				}
				// if($selec['accounttype']=='HOMEBUYER')// homebuyer is logging in
				// {
					// $_SESSION['BUY_SANT']=$selec;
					// header('location:lenderdashboard.php?tab=profile');
				// }

			} else   {
				$_SESSION['msg']='wronw';
			}

		} else    {
			$_SESSION['msg']='noren';
		}

	}

	?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Login on RePreApproval</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php");?>
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

  $('#llgn').submit(function(){
    checkma('log');
	fillfield('pwd');
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

	 if($_SESSION['msg']=='wronw')
	  {
		?> $('#wron').slideDown('slow').delay(6666).slideUp('slow'); <?php
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
        <h1>Login in your RePreApproval account</h1>
      </div>
    </div>
  </div>
</div>
<div class="space20"></div>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div style="background-color:#E7B987; text-align:center; width:500px; display:none" id="wron">Wrong Password</div>
      <div style="background-color:#E7B987; text-align:center; width:500px; display:none" id="nore">No Record Found</div>
      <div class="login">
        <form action='' method='post' id="llgn" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-3"><span>Email</span></label>
            <div class="col-sm-9">
              <input  type='text' name='log' id='log' value='' size='20' onBlur="checkma('log');" class="input" />
              <span class='et_protected_icon'></span></div>
          </div>
          <div class="form-group">
            <label class="col-sm-3"><span>Password</span></label>
            <div class="col-sm-9">
              <input type='password' name='pwd' onBlur="fillfield('pwd');" id='pwd'  class="input" size='20' />
              <span class='et_protected_icon et_protected_password'></span></div>
          </div>
          <div class="form-group">
            <label class="col-sm-3">&nbsp;</label>
            <div class="col-sm-9">
              <input type='submit' name='submit' value='Login' class='btn btn-primary' />
            </div>
          </div>
          <div>
            <p style="text-align:right;"><a href="forget.php">Forgot Password <img src="images/rightarrow.png" style="width:25px !important;" /></a></p>
          </div>
        </form>
      </div>
    </div>
    <!--<div class="col-md-4">
<p><img src="images/repreapprovalsecurity.jpg" alt="online preapproval from lender" title="ReReApproval - Realestate Innovation" class="repreaaproval" /></p>
</div>    -->
  </div>
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
