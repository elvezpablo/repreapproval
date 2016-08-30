<?php
require '../vendor/autoload.php';
include("admin/config.php");
include('mailgun/RPAMailGun.php');

if (isset($_REQUEST['submit'])) {
    //$to="info@santarosawebsite.com";
    $to = "prangel@gmail.com";
    //$to= 'prangel@gmail.com';
    $subject = "Inquiry from RePreApproval";
    $mailgun = new RPAMailGun();

    $from = "admin@repreapproval.com";
    $mess = '<table width="650" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #ccc;padding-bottom:20px; margin:10px auto;"><tr>
<td valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td valign="top" style="padding:1px 0;">&nbsp;</td></tr>
<tr><td style="font-size:15px;font-weight:bold;padding-bottom:0px;background:#045D92;color:#fff;padding:10px;">You have received a new enquiry from the website RePreApproval.</td></tr>
<tr><td><table width="100%" border="0" cellspacing="5" cellpadding="0" align="center" style="margin:2px auto;line-height:20px;background:#F0F0F0;">
<tr><td style="padding-left:10px;" width="150"><strong style="color:#000;">Name</strong></td>
<td>:</td><td style="color:#045D92">' . stripslashes($_REQUEST['contact_name']) . '</td></tr>

<tr><td style="padding-left:10px;"><strong style="color:#000;">Email</strong></td>
<td>:</td><td style="color:#045D92">' . stripslashes($_REQUEST['contact_email']) . '</td></tr>
<tr><td style="padding-left:10px;"><strong style="color:#000;">Phone</strong></td>
<td>:</td><td style="color:#045D92">' . stripslashes($_REQUEST['contact_phone']) . '</td></tr>

<tr><td style="padding-left:10px;"><strong style="color:#000;">Subject</strong></td>
<td>:</td><td style="color:#045D92">' . stripslashes($_REQUEST['contact_subject']) . '</td></tr>

<tr><td style="padding-left:10px;"><strong style="color:#000;"> Message</strong></td><td>:</td>
<td style="color:#045D92">' . stripslashes($_REQUEST['contact_message']) . '</td></tr></table></td></tr>
<tr></tr>

<tr><td valign="top" align="left" style="padding:2px 10px; background:#045D92;color:#fff"></td></tr>
</table></td></tr></table>';

    if($mailgun->mail($to, $subject, $mess, array('contact'))) {
        header("location:thankyou.php");
    }
}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Contact RePreApproval</title>
<meta name="description" content="Contact RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="contact repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php");?>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<header>
<?php include("includes/header.php");?>
<header>
<div class="space40"></div>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Get In Touch!</h1>
    </div>
  </div>
</div>

<div class="space20"></div>

<div class="container">
  <div class="row contact-data">
    <div class="col-md-4">
<h4>Address</h4>
2360 Mendocino Avenue<br>
Suite A2-129<br>Santa Rosa, CA 95403
<div class="space20"></div>
    </div>
    <div class="col-md-4">
      <h4>Contact</h4>
      <i class="fa fa-envelope"></i> <a href="mailto:admin@repreapproval.com">admin@repreapproval.com</a><br>
      <i class="fa fa-globe"></i> <a href="index.php">www.RePreApproval.com</a><br>
      <div class="space20"></div>
    </div>
<div class="col-md-4 social-4">
<h4>Contact us on Social Media</h4>
<a href="https://www.facebook.com/repreapproval" title="Like us on Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
<a href="https://twitter.com/RePreApproval" title="Follow us on Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
<a href="https://plus.google.com/u/0/b/100117020883308068199/100117020883308068199/about" title="Join us on GooglePlus" target="_blank"><i class="fa fa-google-plus"></i></a>
<a href="https://www.linkedin.com/company/repreapproval?trk=company_name" title="Learn more about us on LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>
<a href="https://www.youtube.com/user/repreapproval" title="Watch our YouTube Videos" target="_blank"><i class="fa fa-youtube"></i></a>
<a href="https://www.vimeo.com/channels/repreapproval" title="Watch our Vimeo Videos" target="_blank"><i class="fa fa-video-camera"></i></a>
</div>

</div>
</div>

<div class="space10"></div>

<div class="container">
  <div class="row">
    <div class="col-sm-7">
    <form method="post" id="cntctfrm_contact_form" action="contact.php"  class="form-horizontal" enctype="multipart/form-data">
    			<div class="form-group">
						<label class="col-sm-4" for="cntctfrm_contact_name">Full name: <span class="required">*</span></label>
						<div class="col-sm-8 has-error"><input class="text input" type="text" size="80" value="" name="contact_name" id="contact_name" style="text-align: left; margin: 0;" /></div>
          </div>
          <div  class="form-group">
					<label class="col-sm-4" for="cntctfrm_contact_email">Email address: <span class="required">*</span></label>
					<div class="col-sm-8"><input class="text input" type="text" size="80" value="" name="contact_email" id="contact_email" style="text-align: left; margin: 0;" /></div>
        </div>
			<div class="form-group">
						<label class="col-sm-4" for="cntctfrm_contact_phone">Phone number:</label>
					<div class="col-sm-8"><input class="text input" type="text" size="80" value="" name="contact_phone" id="contact_phone" style="text-align: left; margin: 0;" /></div>
					</div>
					<div class="form-group">
					<label class="col-sm-4" for="cntctfrm_contact_subject">Subject:</label>
				<div class="col-sm-8"><input class="text input" type="text" size="80" value="" name="contact_subject" id="contact_subject" style="text-align: left; margin: 0;" /></div>
        </div>

				<div class="form-group">
					<label class="col-sm-4" for="cntctfrm_contact_message">Message: <span class="required">*</span></label><div class="col-sm-8"><textarea rows="5" cols="78" name="contact_message" id="contact_message" class="input"></textarea></div>
				</div>
        <div class="form-group">
        <label class="col-sm-4" for="cntctfrm_contact_message"></label><div class="col-sm-8"><input type="submit" value="Submit" style="cursor: pointer; margin: 0pt; text-align: center;margin-bottom:10px;  background:#CCC; padding:5px 10px; border:none; " name="submit" id="submit" /></div>
        </div>
        <div style="text-align: left; padding-top: 8px;">
					<input type="hidden" value="send" name="cntctfrm_contact_action"><input type="hidden" value="Version: 3.30" />
					<input type="hidden" value="en" name="cntctfrm_language">
				</div>
				</form></div>
    <div class="col-md-5"><img src="images/contactrepreapproval.jpg" alt="online preapproval from lender" title="ReReApproval - New tools for Mortgage Lenders" class="repreaaproval img-responsive" style="margin-left:20px;" /></div>
  </div>
</div>

<div class="space60"></div>
<?php include("includes/strip.php");?>
 <div class="space60"></div>
<footer class="footer">
<?php include("includes/topfooter.php");?>
<?php include("includes/footer.php");?>
</footer>
<?php include("includes/javascript.php");?>
<script type="text/javascript">
$(document).ready(function(){
	$('#submit').click(function(){
		var contact_name=$('#contact_name').val();
		var contact_email=$('#contact_email').val();
		var contact_message=$('#contact_message').val();
		 var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		 var i=0;
		 if(contact_name=='')
		 {
			 $('#contact_name').attr('placeholder','Please enter your full name');
			 $('#contact_name').addClass('error');
			 i++;
		 }
		  if(contact_email=='')
   {
	    $('#contact_email').attr('placeholder','Pleaser enter your email');
	   $('#contact_email').parent().addClass('has-error');
	  i++;
   }
   else if(regex.test(contact_email)==false)
   {
	   $('#contact_email').val('');
	   $('#contact_email').attr('placeholder','Please enter a valid email');
	   $('#contact_email').parent().addClass('has-error');
	   i++;
   }

    if(contact_message=='')
		 {
			 $('#contact_message').attr('placeholder','Please enter your message');
			 $('#contact_message').addClass('error');
			 i++;
		 }
		 if(i>0)
		 {
			 return false;
		 }
		});
	});
</script>
</body>
</html>
