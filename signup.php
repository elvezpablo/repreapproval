<?php include("admin/config.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Sign up with RePreApproval</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php"); ?>
<script>
var err= 0;

function matchpas()
 {
   var vv= $('#pass1').val();
   var vv2= $('#pass2').val();

   if(vv!='' && vv2!='')
    {
	  if(vv!=vv2)
	   {
		 $('#pass2').addClass('error');
	     $("#pass2").val("");
		 $('#pass2').attr('placeholder', 'Not matched');
	     err= 1;
	   }
	  else
	   {
		 $('#pass2').removeClass('error');
	     err= 0;
	   }
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
	fillfield('user_login');
	fillfield('pass1');
	fillfield('pass2');
	fillfield('first_name');
	checkma('user_email');
	matchpas();
	fillfield('license');
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
<body><?php
include_once("analyticstracking.php");
?><header><?php
include("includes/header.php");
?></header>
<div class="breadcrumb-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Sign up with RePreApproval today!</h1>

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
        <form action="plans.php" class="form-horizontal" id="registerform" method="post" name="registerform">
          <div>
            <p id="reg_passmail"></p>
            <div class="form-group">
              <label class="col-sm-3" for="user_email">E-mail<b>*</b></label>
              <div class="col-sm-9">
                <input class="input" id="user_email" name="user_email" onblur="checkmablur('user_email');" size="50" type="text" value="<?php echo $_SESSION['user_email'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3" for="pass1">Password<b>*</b></label>
              <div class="col-sm-9">
                <input autocomplete="off" class="input" id="pass1" name="pass1" onblur="fillfield('pass1');" size="50" type="password" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3" for="pass2">Confirm Password<b>*</b></label>
              <div class="col-sm-9">
                <input autocomplete="off" class="input" id="pass2" onblur="matchpas();" size="50" type="password" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3" for="first_name">First name<b>*</b></label>
              <div class="col-sm-9">
                <input class="input" id="first_name" name="first_name" onblur="fillfield('first_name');" size="50" type="text" value="<?php echo $_SESSION['first_name'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3" for="last_name">Last name</label>
              <div class="col-sm-9">
                <input class="input" id="last_name" name="last_name" size="50" type="text" value="<?php echo $_SESSION['last_name'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3" for="nmls">NMLS license</label>
              <div class="col-sm-9">
                <input class="input" id="nmls" name="nmls" size="50" type="text" value="<?php echo $_SESSION['nmls']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3" for="dre">BRE license</label>
              <div class="col-sm-9">
                <input class="input" id="dre" name="dre" size="50" type="text" value="<?php echo $_SESSION['dre']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3" for="company">Company name<b>*</b></label>
              <div class="col-sm-9">
                <input class="input" id="company" name="company" onblur="fillfield('company');" size="50" type="text" value="<?php echo $_SESSION['company'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Street address</label>
              <div class="col-sm-9">
                <input class="input" id="streetaddress1" name="streetaddress" size="50" type="text" value="<?php echo $_SESSION['streetaddress'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Suite #</label>
              <div class="col-sm-9">
                <input class="input" id="suite" name="suite" size="50" type="text" value="<?php echo $_SESSION['suite'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">City</label>
              <div class="col-sm-9">
                <input class="input" id="city" name="city" size="50" type="text" value="<?php echo $_SESSION['city'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">State</label>
              <div class="col-sm-9">
                <input class="input" id="state" name="state" size="50" type="text" value="<?php echo $_SESSION['state'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">ZIP code<b>*</b></label>
              <div class="col-sm-9">
                <input class="input poin" id="zip" name="zip" onblur="fillfield('zip');" size="50" type="text" value="<?php echo $_SESSION['zip'] ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Phone<b>*</b></label>
              <div class="col-sm-9">
                <input class="input phomo" id="phone" name="phone" onblur="fillfield('phone');" size="50" type="text" value="<?php echo $_SESSION['phone'] ?>">
              </div>
            </div>
            <div class="submit form-group">
              <label class="col-sm-3">&nbsp;</label>
              <div class="col-sm-9">
                <input class="btn btn-primary" name="landsubmit" type="submit" value="Register with RePreApproval">
              </div>
            </div><input id="alread" type="hidden">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--<div class="col-md-4">
<p><img src="images/lendersandrealtorsworkingtogether.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval"/></p>
<p><img src="images/increasecloserateonhomeoffers.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval" /></p>
</div>-->

</div></div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer"><?php
include("includes/topfooter.php");
include("includes/footer.php");
?></footer>
<?php
  include("includes/javascript.php");
?>
</body>
</html>
