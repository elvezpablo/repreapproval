<?php include("admin/config.php");

if(!$_SESSION['REAL_VEER'] or !isset($_SESSION['REAL_VEER']['id']))
 {
   header('location:index.php');
 }

if(!isset($_REQUEST['eid']) or $_REQUEST['eid']=='' or !isset($_REQUEST['tmp']) or $_REQUEST['tmp']=='')
 {
   header('location:realtordashboard.php');
 }

if(isset($_REQUEST['eid']) and $_REQUEST['eid']!='' and isset($_REQUEST['tmp']) and $_REQUEST['tmp']!='')
 {
   $bhxwe= mysql_fetch_assoc(mysql_query("select * from `letters` where id= '".$_REQUEST['eid']."' and `created` ='".$_REQUEST['tmp']."'"));
   $maxim= $bhxwe['purchase_price'];
   if($bhxwe['letter_type']!='MAIN')
    {
	  $njdcqw= mysql_fetch_assoc(mysql_query("select purchase_price from `letters` where id= '".$bhxwe['letter_type']."'"));
	  $maxim= $njdcqw['purchase_price']; // main letter's purchase price of this edited letter
	}
 }

if(isset($_REQUEST['landsubmit']) and $_REQUEST['landsubmit']!='')
 {
	 $stam= time();
	 $Purchase_Price=addslashes($_POST['Purchase_Price']);
	 $Prop_Street_Addr=addslashes($_POST['Prop_Street_Addr']);
	 $Prop_Suite_Apt=addslashes($_POST['Prop_Suite_Apt']);
	 $Prop_City=addslashes($_POST['Prop_City']);
	 $Prop_State=addslashes($_POST['Prop_State']);
	 $ZIP_Code=addslashes($_POST['ZIP_Code']);
	 $created=time();
	if($_REQUEST['idofrecord']!='' and $Purchase_Price!='' and  $Prop_Street_Addr!='' and $Prop_City!='' and $Prop_State!='' and $ZIP_Code!='')
	 {
	  if(isset($_REQUEST['edORin']) and $_REQUEST['edORin']=='MAIN')
	   {
		 $sedw= mysql_fetch_assoc(mysql_query("select * from `letters` where id= '".$_REQUEST['idofrecord']."'"));
		 $stam= time();
		 $uted=mysql_query("INSERT INTO `letters` (`letter_sender`, `buyer_view`, `buyer_id`, `pre_qual_no`, `lead_id`, `generation_date`, `expiry_date`, `purchase_price`, `down_payment`, `loan_type`, `loan_term`, `payment_type`, `mortgage_one`, `mortgage_two`, `property_type`, `Occupancy`, `loan_index`, `loan_margin`, `max_qual_interest_rate`, `credit_score`, `mortgage_insurance`, `property_street`, `property_suite`, `property_city`, `property_state`, `property_zip`, `created`, `letter_type`) VALUES ('".$sedw['letter_sender']."', '".$sedw['buyer_view']."', '".$sedw['buyer_id']."', '".$sedw['pre_qual_no']."', '".$sedw['lead_id']."', '".$sedw['generation_date']."', '".$sedw['expiry_date']."', '".$Purchase_Price."', '".$sedw['down_payment']."', '".$sedw['loan_type']."', '".$sedw['loan_term']."', '".$sedw['payment_type']."', '".$sedw['mortgage_one']."', '".$sedw['mortgage_two']."', '".$sedw['property_type']."', '".$sedw['Occupancy']."', '".$sedw['loan_index']."', '".$sedw['loan_margin']."', '".$sedw['max_qual_interest_rate']."', '".$sedw['credit_score']."', '".$sedw['mortgage_insurance']."', '".$Prop_Street_Addr."', '".$Prop_Suite_Apt."', '".$Prop_City."', '".$Prop_State."', '".$ZIP_Code."', '".$stam."', '".$sedw['id']."');");
		 
	   }
	  else
	   {
		 $uted= mysql_query("update `letters` set `buyer_view`= 'SHOW', `purchase_price`= '".$Purchase_Price."', `property_street`= '".$Prop_Street_Addr."', `property_suite`= '".$Prop_Suite_Apt."', `property_city`= '".$Prop_City."', `property_state`= '".$Prop_State."', `property_zip`= '".$ZIP_Code."', `created`= '".$stam."' where id= '".$_REQUEST['idofrecord']."'");
	   }
	  //$uted= mysql_query("update `letters` set `buyer_view`= 'SHOW', `purchase_price`= '".$Purchase_Price."', `property_street`= '".$Prop_Street_Addr."', `property_suite`= '".$Prop_Suite_Apt."', `property_city`= '".$Prop_City."', `property_state`= '".$Prop_State."', `property_zip`= '".$ZIP_Code."', `created`= '".$stam."' where id= '".$_REQUEST['idofrecord']."'");
	  
	  if($uted)
	   {
		 $_SESSION['msg']='pted';
		 header('location:realtordashboard.php?rtyp=EDITED');
		 exit;
	   }
	 }
 }

$dspl= mysql_query("select * from userthree where accounttype= 'HOMEBUYER' and createdby ='".$_SESSION['REAL_VEER']['id']."'");
$xvfbo= array();
while($kod= mysql_fetch_assoc($dspl))
 {
   $xvfbo[]= $kod;// these are all homebuyers
 }

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Add a Pre-Approval Letter in your RePreApproval account</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and Home Buyers, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, Home Buyers, realtos, mortgage lender, lenders">
<?php include("includes/head.php"); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
var err= 0;

var ccm= '<?php echo $maxim; ?>';
function mxfillfield(ee)
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
	  if(parseInt(vv) > parseInt(ccm))
	   {
		$("#"+ee).val("");
	    $('#'+ee).attr('placeholder', 'Decrease this value');
	    
		alert('The amount you entered is above the approved amount for this home buyer. Please contact the lender to increase the approved amount or enter a lower dollar amount. Thank you.');
		
		$('#'+ee).addClass('error');
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
  
  <?php
  if(isset($_SESSION['msg']) and $_SESSION['msg']!='')
   {
	 if($_SESSION['msg']=='lettercreated')
	  {
		?> $('#lettercreatedAA').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 if($_SESSION['msg']=='fieldrequired')
	  {
		?> $('#fieldrequiredAA').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 unset($_SESSION['msg']);
   }
  ?>
  
  $('.poin').on('keydown',function(event){
   var e = event || evt;
   var charCode = e.which || e.keyCode;
   if(charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105))
	 return false;
   return true;
  });
  
  $('#registerform').submit(function(){
	mxfillfield('Purchase_Price');
	fillfield('Prop_Street_Addr');
	//fillfield('Prop_Suite_Apt');
	fillfield('Prop_City');
	fillfield('Prop_State');
	fillfield('ZIP_Code');
	if(err==1)
	 {
	   return false;
	 }
  });
  
  $("#Cert_Gene_Date").datepicker({ //calender
   dateFormat: 'mm/dd/yy',
   changeMonth: true,
   minDate: new Date(),
   maxDate: '+2y',
   onSelect: function(date){
	  var de= $('#Cert_Gene_Date').val();
      $.ajax({ url: 'ajaxX.php',
		async:false,
        data:{de:de,action:'adddays'},
        type: 'post',
		beforeSend: function(){},
        success: function(output){
          $('#Cert_Exp_Date').val(output); 
         }
        });
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
          <h1>Update a pre-approval letter</h1>
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

<div style="background-color:#E7B987; text-align:center; width:500px; display:none" id="lettercreatedAA">Letter successfully created.</div>
<div style="background-color:#E7B987; text-align:center; width:500px; display:none" id="fieldrequiredAA">Something went wrong, please try again.</div><?php

if(isset($xvfbo) and count($xvfbo)>0)
 {
   ?><div class="login">
   <form name="registerform" id="registerform" action="" class="form-horizontal" method="post">

<p id="reg_passmail"></p>
<div class="form-group"><label class="col-sm-3" for="">Purchase Price ($)*</label><div class="col-sm-9"><input type="text" name="Purchase_Price" id="Purchase_Price" class="input poin" size="50" value="<?php echo $bhxwe['purchase_price']; ?>" onBlur="mxfillfield('Purchase_Price');"/></div></div>
<div class="form-group"><label class="col-sm-3" for="">Property Street Address*</label><div class="col-sm-9"><input type="text" name="Prop_Street_Addr" id="Prop_Street_Addr" class="input" onBlur="fillfield('Prop_Street_Addr');" size="50" value="<?php echo $bhxwe['property_street']; ?>"/></div></div>
<div class="form-group"><label class="col-sm-3" for="">Property Suite or Apt</label><div class="col-sm-9"><input type="text" name="Prop_Suite_Apt" id="Prop_Suite_Apt" class="input" size="50" value="<?php echo $bhxwe['property_suite']; ?>"/></div></div>
<div class="form-group"><label class="col-sm-3" for="">Property City*</label><div class="col-sm-9"><input type="text" name="Prop_City" id="Prop_City" class="input" size="50" onBlur="fillfield('Prop_City');" value="<?php echo $bhxwe['property_city']; ?>"/></div></div>
<div class="form-group"><label class="col-sm-3" for="">Property State*</label><div class="col-sm-9"><input type="text" name="Prop_State" id="Prop_State" class="input" size="50" onBlur="fillfield('Prop_State');" value="<?php echo $bhxwe['property_state']; ?>"/></div></div>
<div class="form-group"><label class="col-sm-3" for="">Property ZIP Code*</label><div class="col-sm-9"><input type="text" name="ZIP_Code" id="ZIP_Code" class="input poin" size="50" onBlur="fillfield('ZIP_Code');" value="<?php echo $bhxwe['property_zip']; ?>"/></div></div>
<input type="hidden" name="idofrecord" value="<?php echo $_REQUEST['eid']; ?>"/>
<input type="hidden" name="edORin" value="<?php echo $bhxwe['letter_type']; ?>"/>

<div class="form-group submit"><label class="col-sm-3" for="">&nbsp;</label><div class="col-sm-9"><input type="submit" name="landsubmit" value="Update this Pre-Approval Letter" class="btn btn-primary"/></div></div>
</form></div><?php
 }
else
 {
   ?> <div style="background-color:#E7B987; text-align:center; width:500px;"> You do not have any homebuyer to send these lettors </div> <?php
 }

?></div>
<!--<div class="col-md-4">
<p><img src="images/lendersandrealtorsworkingtogether.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval"/></p>
<p><img src="images/increasecloserateonhomeoffers.jpg" alt="online preapproval from lender" title="Sign up with ReReApproval" class="repreaaproval" /></p>
</div>
-->
</div> </div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer"><?php
include("includes/topfooter.php");
include("includes/footer.php");
?></footer><?php
include("includes/javascript.php");
?></body>
</html>