<?php include("admin/config.php");
$_SESSION['upgradeplan']='yes';
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Get Your Real Estate Clients Pre Approved Online</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
 <?php include("includes/head.php");?>
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
          <h1>Upgrade your plan</h1>
          <ol class="breadcrumb">
            <li class="active"><a href="faq.php">FAQ >></a></li>
          </ol>
        </div>  
      </div> 
    </div> 
  </div>
  <div class="space20"></div>
<div class="container">
<div class="row">
<?php if($_SESSION['logge']['plan']=='silverPlan'){?>
<div class="col-md-4">
<div class="content-block">
<div class="content-box">
<h4>Gold</h4>
<p>
Up to 50 realtors<br>
Unlimited pre-approval letters per realtor<br>
$59.95/month<br></p>
<form  method="post" action="firstpayment.php">
<input type="text" class="form-control gold_sub1" id="promocode" name="promocode" placeholder="Enter promo code if applicable">
<input type="hidden" name="amount" value="59.95"/>  
<input type="hidden" name="Plan" value="goldPlan"/> 
<br>
<div class="col-md-12">
<button type="submit" id="gold_sub" class="btn btn-primary sub">Sign up for Gold</button>
</div> 
 </form>
</div>
</div>  
<div class="space40"></div>
</div>
<div class="col-md-4">
<div class="content-block">
<div class="content-box">
<h4>Platinum</h4>
<p><b>Unlimited realtors</b><br>
Unlimited pre-approval letters per realtor<br>
$150/Month<br></p> 
<form  method="post" action="firstpayment.php">
<input type="text" class="form-control plat_sub1" id="promocode" name="promocode" placeholder="Enter promo code if applicable">
<input type="hidden" name="amount" value="150"/> 
<input type="hidden" name="Plan" value="platinumPlan"/> 
<br>
<div class="col-md-12">
<button type="submit" id="plat_sub" class="btn btn-primary sub" style="background:#93CE52;font-size:large;box-shadow: 10px 10px 5px #888888;font-weight:bold;border:1px solid #cacaca;">Sign up for Platinum!!!</button>
</div> 
</form>
</div>
</div>  
<div class="space40"></div>
</div>
<?php } else {?>
<div class="col-md-4">
<div class="content-block">
<div class="content-box">
<h4>Platinum</h4>
<p><b>Unlimited realtors</b><br>
Unlimited pre-approval letters per realtor<br>
$150/Month<br></p> 
<form  method="post" action="firstpayment.php">
<input type="text" class="form-control plat_sub1" id="promocode" name="promocode" placeholder="Enter promo code if applicable">
<input type="hidden" name="amount" value="150"/> 
<input type="hidden" name="Plan" value="platinumPlan"/> 
<br>
<div class="col-md-12">
<button type="submit" id="plat_sub" class="btn btn-primary sub" style="background:#93CE52;font-size:large;box-shadow: 10px 10px 5px #888888;font-weight:bold;border:1px solid #cacaca;">Sign up for Platinum!!!</button>
</div> 
</form>
</div>
</div>  
<div class="space40"></div>
</div>
<?php }?>
</div>
</div> 
<div class="space40"></div>
<?php include("includes/strip.php");?>  
<div class="space40"></div>
<footer class="footer">
<?php include("includes/topfooter.php");?>
<?php include("includes/footer.php");?>  
</footer>     
<?php include("includes/javascript.php");?> 
<script type="text/javascript">
$(document).ready(function(){
	$('.sub').click(function(){
		var i=0;
		id=this.id;
		code=$('.'+id+'1').val();
		if(code!='')
		{
		$.ajax({ url: 'checkcode.php',
		   async:false,
           data:{code:code,action:'codevalid'},
           type: 'post',
		   beforeSend: function () {
                },
          success: function(output) {
                     if(output=='success')
					 {
						
					 }
					 else
					 {
						 i++;
					 }
                  }
               });
		}
			   if(i>0)
			   {
				   alert('We are sorry the promo code you entered is either wrong or expired. Please try a different code or continue with your registration. Thank you.')
				   code=$('.'+id+'1').val('');
				   return false;
			   }
		});
	});
</script> 
</body>
</html>