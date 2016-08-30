<script>
function change_captcha()
{
	document.getElementById('captcha').src="components/com_jumi/files/get_captcha.php?rnd=" + Math.random();
}
 
jQuery(document).ready(function() { 
 // refresh captcha
 jQuery('img#captcha-refresh').click(function() {  
		change_captcha();
 });
});

$('.input').bind('keypress', function () {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
	var id=this.id;
   var text=$('#'+id).val();
    if (!regex.test(text)) {
      alert("special characters not allowed");
       return false;
    }
});

jQuery(document).ready(function(e) {
jQuery("input#mysubmit").click(function(){
 
  var FIRST_NAME = jQuery("input#FIRST_NAME").val();
  var LAST_NAME = jQuery("input#LAST_NAME").val();
  var EMAIL = jQuery("input#EMAIL").val();
  var captchacode = jQuery("input#captcha-code").val();
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  
  if(jQuery.trim(FIRST_NAME).length == 0)
  {
	  alert("Please enter First Name");
	  jQuery("input#FIRST_NAME").focus();
	  return false;
  }
  
  if(jQuery.trim(LAST_NAME).length == 0)
  {
	  alert("Please enter Last Name");
	  jQuery("input#LAST_NAME").focus();
	  return false;
  }
  
  if(jQuery.trim(EMAIL).length == 0)
  {
	 alert('Please enter valid email address');
	 jQuery("input#EMAIL").focus();
	 return false;
  }
  
  if(!regex.test(EMAIL))
  {
  	alert("You must enter a valid e-mail address");
	jQuery("input#EMAIL").focus();
  	return false;
  }
  
  //var dataa = jQuery("#contactus").serialize();
  
  jQuery.ajax({
	url:'components/com_jumi/files/get_captcha.php?method=check&captcha='+captchacode,
	type:'GET',
	success: function(response)
	{
		
	if(jQuery.trim(response) == "success")
	{
		document.getElementById("contactus").submit();
		return false;
	}
	else
	{
		change_captcha();
		alert("Invalid Security code entered.");
		jQuery("input#captcha-code").val("");
		return false;
	}
		
	}
	});
  return false;
});
});
</script>

<form id="contactus" action="https://www.topproduceronline.com/LeadToolkit.asp" method="post">
  <DIV id="EVALUATION-FORM" name="CONTACT_INFO" align="LEFT" style="WIDTH: 600px">
    <DIV style="WIDTH: 600px; TEXT-ALIGN: LEFT"> Please enter your information in the following fields and click the submit button.<br />
      All <strong> BOLD </strong> fields are required. </DIV>
    <BR>
    <div style="width: 600px">
      <fieldset>
        <legend>Contact Information</legend>
        <label for="FIRST_NAME" class="required">First Name:</label>
        <INPUT class="input" type="TEXT" maxlength="21"  id="FIRST_NAME" name="FIRST_NAME"  style="float: left; clear:none !important;" value="<?php echo $_POST['FIRST_NAME']?>">
        <div class="cleaner"></div>
        <label for="LAST_NAME" class="required">Last Name:</label>
        <INPUT class="input" type="TEXT" maxlength="26" id="LAST_NAME" name="LAST_NAME"  style="float: left; clear:none !important;"  value="<?php echo $_POST[ "LAST_NAME" ]?>">
        <div class="cleaner"></div>
        <label for="EMAIL" class="required">Email:</label>
        <INPUT type="TEXT" maxlength="80" id="EMAIL" name="EMAIL"  style="float: left; clear:none !important;"  value="<?php echo $_POST[ "EMAIL" ]?>">
        <div style="clear: both"></div>
        <label for="PHONE" >Phone:</label>
        <INPUT class="input" type="TEXT" maxlength="3" id="PHONE_AREA_CODE" name="PHONE_AREA_CODE" style="width: 40px" value="<?php echo $_POST[ "PHONE_AREA_CODE" ]?>">
        &nbsp;
        <INPUT class="input" type="TEXT"  maxlength="3" id="PHONE_LOCAL_CODE" name="PHONE_LOCAL_CODE" style="width: 40px" value="<?php echo $_POST[ "PHONE_LOCAL_CODE" ]?>">
        &nbsp;
        <INPUT class="input" type="TEXT" maxlength="4" id="PHONE_NUMBER" name="PHONE_NUMBER" style="width: 120px" value="<?php echo $_POST[ "PHONE_NUMBER" ]?>">
        <div class="cleaner"></div>
        <label for="BEST_TIME">Best time to reach me:</label>
        <SELECT id="BEST_TIME" name="BEST_TIME">
          <OPTION value="Anytime" selected="">Anytime </OPTION>
          <OPTION value="Morning">Morning </OPTION>
          <OPTION value="Afternoon">Afternoon </OPTION>
          <OPTION value="Evening">Evening </OPTION>
        </SELECT>
        <div class="cleaner"></div>
      </fieldset>
      <br />
      <fieldset>
        <legend>Comments</legend>
        <label for"STATUS_BUYER"> I am interested in: </label>
        <INPUT id="STATUS_BUYER" type="RADIO" name="STATUS" value="Buy-New-Home">
        Buying
        <INPUT id="STATUS_SELLER" type="RADIO" name="STATUS" value="Sell-Home">
        Selling
        <INPUT id="STATUS_BOTH" type="RADIO" name="STATUS" value="Buy-Resale-Home">
        Both
        <div class="cleaner"></div>
        <label for="COMMENTS">Comments:</label>
        <TEXTAREA  class="input" id="comments" name="COMMENTS" COLS="50" ROWS="5"><?php echo $_POST[ "COMMENTS" ]?> </TEXTAREA>
        <div style="margin-top:10px;">
        <div class="cleaner"></div>
      </fieldset>
      <br />
    </div>
    <div id="captcha-wrap">
      <div class="captcha-box"> <img src="components/com_jumi/files/get_captcha.php" alt="" id="captcha" /> </div>
      <div class="text-box"> 
        <!--<label>Type the two words:</label>-->
        <input name="captcha-code" type="text" id="captcha-code">
      </div>
      <div class="captcha-action"> <img src="components/com_jumi/files/refresh.jpg"  alt="" id="captcha-refresh" /> </div>
    </div>
    <div id="mess"></div>
  </div>
  <br />
  <br />
  <br />
  <br />
  <div class="cleaner"></div>
  <INPUT type="hidden" id="STATUS_BUYER" value="Buy-New-Home">
  <INPUT type="hidden" name="PAGEID" value="TUZhcmlzOA==">
  <INPUT type="hidden" name="SOURCE" value="Contact Us Web">
  <INPUT type="hidden" name="MSG_SUCCESS" value="&lt;P&gt;&lt;FONT face=Arial size=4&gt;&lt;STRONG&gt;Thank you for your inquiry. You will be contacted as soon as possible.&lt;/STRONG&gt;&lt;/P&gt;&lt;/FONT&gt;&lt;br">
  <INPUT type="hidden" name="MSG_FAILURE" value="&lt;P&gt;&lt;FONT face=Arial size=4&gt;&lt;STRONG&gt;Your inquiry has not been sent. The server may be busy, or an unexpected problem has occurred. Please try again. If the problem persists, please email me directly at &lt;a HREF=mailto:mark@markfaris.ca&gt;mark@markfaris.ca&lt;/a&gt;&lt;/STRONG&gt;&lt;/font&gt;&lt;br&gt;&lt;br&gt;&lt;a href=javascript:history.go(-1)&gt;Click here to return to the previous page&lt;/a&gt;">
  <INPUT type="HIDDEN" name="URL_SUCCESS" value="">
  <INPUT type="HIDDEN" name="ASSIGNED_TO" value="{FD04B7C8-A2CC-48AF-B7D5-D969B6D8E170}">
  <INPUT type="button" NAME="SUBMIT" id="mysubmit"  VALUE="SUBMIT">
</FORM>
<link href="components/com_jumi/files/style.css" rel="stylesheet" type="text/css">
