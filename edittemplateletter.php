<?php include("admin/config.php");

if(!$_SESSION['logge'] or !isset($_SESSION['logge']['id']))
 {
   header('location:index.php');
 }

$selectLender=mysql_fetch_assoc(mysql_query("select * from letter_constant where creator_id='".$_SESSION['logge']['id']."'"));
if(isset($_REQUEST['landsubmit']) and $_REQUEST['landsubmit']=='Submit')
{

$time=$_SESSION['logge']['id'].time();
if(!empty($_FILES['logo']['name']))	
 {
	$logo=$time.$_FILES['logo']['name'];
	move_uploaded_file($_FILES['logo']['tmp_name'],"frontuser/".$logo);
	$logourl="frontuser/".$logo;
 }
else
 {
	$logourl=$_REQUEST['hidlogoimg'];
 }
if(!empty($_FILES['signature']['name']))	
 {
	$signature=$time.$_FILES['signature']['name'];
	move_uploaded_file($_FILES['signature']['tmp_name'],"frontuser/".$signature);
	$signurl="frontuser/".$signature;
 }
else
 {
	 $signurl=$_REQUEST['hidsignimg'];
 }
if($selectLender['creator_id']=='')
 {
	mysql_query("delete from `letter_constant` where `creator_id`= '".$_SESSION['logge']['id']."'");
	
	$insert=mysql_query("insert into `letter_constant` (createed, creator_id, logo_url, signature_url, notice ) values ('".$time."', '".$_SESSION['logge']['id']."', '".addslashes($logourl)."', '".addslashes($signurl)."', '".addslashes($_REQUEST['editor1'])."')");
	
	
 }
else
 {
	$insert=mysql_query("update letter_constant set logo_url='".addslashes($logourl)."', signature_url='".addslashes($signurl)."', notice='".addslashes($_REQUEST['editor1'])."' where creator_id='".$_SESSION['logge']['id']."' ");
	
 }
if($insert)
 {
	header('location:lenderdashboard.php');
	//header('location:edittemplateletter.php?msg=success');
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
<title>Edit Template Pre-Approval Letter in your RePreApproval account</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and Home Buyers, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, Home Buyers, realtos, mortgage lender, lenders">
<?php include("includes/head.php"); ?>
<script type="text/javascript">
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
  });

 $('#logo').on('change',function(){
  var filename=$('#logo').val();
  var ext = filename.split('.').pop();
  var tnsn = ext.toLowerCase();
  var flflag= 'nutral';
  if(tnsn=='bmp' || tnsn=='gif' || tnsn=='img' || tnsn=='jpg' || tnsn=='jpeg')
   {
	var flflag= 'janedo';
   }
  if(flflag=='nutral')
   {
	 alert('We support only img, jpg, jpeg, bmp, gif file formats');
	 return false;
   }
  $('#logovalue').val(filename.split('\\').pop());
 });

 $('#signature').on('change',function(){
  var filename=$('#signature').val();
  var ext = filename.split('.').pop();
  var tnsn = ext.toLowerCase();
  var flflag= 'nutral';
  if(tnsn=='bmp' || tnsn=='gif' || tnsn=='img' || tnsn=='jpg' || tnsn=='jpeg')
   {
	var flflag= 'janedo';
   }
  if(flflag=='nutral')
   {
	 alert('We support only img, jpg, jpeg, bmp, gif file formats');
	 return false;
   }
  $('#signvalue').val(filename.split('\\').pop());
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
        <h1>Edit your pre-approval letter template</h1>
      </div>
    </div>
  </div>
</div>
<div class="space20"></div>
<div class="container">
  <div class="row">
    <div class="col-md-8"> 
      <!---->
      <div class="login">
        <h2>Your changes will apply to all of your letters</h2>
        <p>&nbsp;</p>
        <form name="registerform" id="registerform" action="edittemplateletter.php" method="post" enctype="multipart/form-data"  class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-4" for="">Your logo<br>
              <i>(Image size 150px by 100px)</i><br><i>(No PNG image please)</i></label>
            <div class="col-sm-8">
              <p><input type="text"  name="logovalue" id="logovalue" class="input" value="" size="50" title="20" placeholder="Upload your logo - Recommended size 150px by 100px. No PNG please." /></p>
              <p class="submit file-section">
                <input type="button"  value="Add or edit your logo" class="btn btn-primary"/>
                <input type="file" class="btn-file" id="logo" name="logo" />
                <?php if($selectLender['logo_url']=='') {?>
                <img src="images/no-logo.jpg" class="pull-right pro-img">
                <input type="hidden" name="hidlogoimg" value="images/no-logo.jpg"/>
                <?php } else {?>
                <img src="<?php echo $selectLender['logo_url']; ?>" class="pull-right pro-img" width="140" height="93">
                <input type="hidden" name="hidlogoimg" value="<?php echo $selectLender['logo_url']; ?>"/>
                <?php }?>
              </p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4" for="">Your signature<br>
              <i>(Image size 250px by 50px)</i><br><i>(No PNG image please)</i></label>
            <div class="col-sm-8">
            <p><input type="text" name="signvalue" id="signvalue" class="input" value="" size="50" title="20" placeholder="Upload an image of your signature - 250px by 50px. No PNG please." /></p>
            <p class="submit file-section">
                <input type="button"  value="Add or edit your signature image" class="btn btn-primary"/>
                <input type="file" class="btn-file" id="signature" name="signature"/>
                <?php if($selectLender['signature_url']=='') {?>
                <img src="images/no-sign.jpg" class="pull-right pro-img">
                <input type="hidden" name="hidsignimg" value="images/no-sign.jpg"/>
                <?php } else {?>
                <img src="<?php echo stripslashes($selectLender['signature_url']); ?>" class="pull-right pro-img" width="140" height="28">
                <input type="hidden" name="hidsignimg" value="<?php echo stripslashes($selectLender['signature_url']); ?>"/>
                <?php }?>
              </p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4" for="">Your text for the Important Notices section</label>
            <div class="col-sm-8">
              <textarea class="form-control" name="editor1" id="editor1" placeholder="Description"><?php echo stripslashes($selectLender['notice']); ?></textarea>
            </div>
          </div>
          <div class="form-group submit">
            <label class="col-sm-4" for="">&nbsp;</label>
            <div class="col-sm-8">
              <input type="submit" name="landsubmit" value="Submit" class="btn btn-primary"/>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!--
<div class="col-md-4">
<p><img src="images/lendersandrealtorsworkingtogether.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval"/></p>
<p><img src="images/increasecloserateonhomeoffers.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval" /></p>
</div>
--> 
  </div>
</div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer"><?php
include("includes/topfooter.php");
include("includes/footer.php");
?></footer><?php
include("includes/javascript.php");

?><script src="ckeditor/ckeditor.js"></script> 
<script src="ckeditor/adapters/jquery.js"></script> 
<script type="text/javascript">
	$( document ).ready( function() {
	$( 'textarea#editor1').ckeditor();
} );
</script>
</body>
</html>