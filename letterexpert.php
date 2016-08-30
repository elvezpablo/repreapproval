<?php include("admin/config.php");

function formatMoney($number, $fractional=false)
 { 
  if ($fractional)
   { 
    $number = sprintf('%.2f', $number); 
   } 
  while (true)
   { 
    $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
    if ($replaced != $number)
	 { 
      $number = $replaced; 
     }
	else
	 { 
      break; 
     } 
    } 
   return $number;
 }

if(!isset($_SESSION['REAL_VEER']['id']) and !isset($_SESSION['logge']['id']))
 {
   header('location:index.php');
 }

if(!isset($_REQUEST['lett_id']) or $_REQUEST['lett_id']=='' or !isset($_REQUEST['stam']) or $_REQUEST['stam']=='')
 {
   header('location:realtordashboard.php');
 }

if(isset($_REQUEST['lett_id']) and $_REQUEST['lett_id']!='' and isset($_REQUEST['stam']) and $_REQUEST['stam']!='')
 {
   $nam= $_REQUEST['lett_id'].'RePre'.$_REQUEST['stam'].'.pdf';
   
   $bhfv= mysql_fetch_assoc(mysql_query("select * from `letters` where id='".$_REQUEST['lett_id']."' and created= '".$_REQUEST['stam']."'"));
   $sdret= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$bhfv['letter_sender']."'"));
   $const= mysql_fetch_assoc(mysql_query("select * from `letter_constant` where creator_id='".$bhfv['letter_sender']."'"));
   $otherbuyre= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$bhfv['buyer_id']."'"));
   $ccs= explode('@=@', $otherbuyre['otherbuyer']);
   if($otherbuyre['lastname']!='')
    {
	  $ccs[]= $otherbuyre['firstname'].' '.$otherbuyre['lastname'];
	}
   else
    {
	  $ccs[]= $otherbuyre['firstname'];
	}
   $ccs= array_reverse($ccs);
   foreach($ccs as $njxz=>$njks)
    {
	  if($njks=='' or $njks==' ' or $njks==NULL)
	   {
		 unset($ccs[$njxz]);
	   }
	}
   $ccd= implode(', ', $ccs);
   
 }
if(!$bhfv)
 {
   echo 'No Record Found'; exit;
 }

?><!DOCTYPE html>
<html class="not-ie" lang="en">
<head><meta charset="utf-8">
<title>RePreApproval Letter - Expert Style</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php");?>
<script type="text/javascript">
function printSelection(node)
 {
   var content=node.innerHTML
   var pwin=window.open('','print_content');
   pwin.document.open();
   pwin.document.write('<html><head><link href="css/styles.css" rel="stylesheet" id="color-style"><link href="css/print.css" rel="stylesheet"></head><body onload="window.print()">'+content+'</body></html>');
   
   if(pwin.document.close()){
     setTimeout(function(){pwin.close();},0000);
    }
 }

function shooptio()
 {
   $('#sen_yo_many').slideDown('slow').delay(6666).slideUp('fast');
 }

function sendMail(id, stamaa, flag)
 {
   $.ajax({
    type: "POST",
    data:{lett_id:id, stam:stamaa, oto:flag},
    url: "ajaxX.php",
    success:function(data)
	 {
	  if(data=='Bad_Request')
	   {
		 $('#nmaisen').slideDown('slow').delay(6666).slideUp('slow');
	   }
	  else//if(data=='sent')
	   {
		 $('#maisen').slideDown('slow').delay(6666).slideUp('slow');
	   }
	  }
  	});
 }

$(document).ready(function(){
  
});

</script>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<header>
<?php include("includes/header.php");?>
<style>
td {background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #E6EDF2 !important; color: #666; padding:0px;}
th, td {padding:5px 10px !important;}
table, th, td {border-radius: 0;}
td, th {padding:5px !important;}
.str_align p{clear:both !important;padding:0 !important;}
</style></header>
<div class="space20"></div>
<div class="container"><?php
if(isset($bhfv) and $bhfv['id']!=''){

?><div class="row">

<div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px;margin-bottom:10px" id="maisen">This letter has been successfully sent to your specified choice.</div>
<div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px;margin-bottom:10px" id="nmaisen">Something went wrong, please try again. </div>

<div style="text-align:center;position:relative;"><p>

<div id="sen_yo_many" style="display:none; position:absolute;left:378px;top:36px;font-size:12px; z-index:100;background:#9ACE3C;border:1px solid #cacaca;padding:5px;font-weight:bold;border-radius:5px;text-align:left !important">
<span style="text-align:center;">Email this letter to:</span><br>
&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick="sendMail('<?php echo $_REQUEST['lett_id']; ?>', '<?php echo $_REQUEST['stam']; ?>', 'Lender');">Lender</a></br>
&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick="sendMail('<?php echo $_REQUEST['lett_id']; ?>', '<?php echo $_REQUEST['stam']; ?>', 'Realtor');">Realtor</a></br>
&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick="sendMail('<?php echo $_REQUEST['lett_id']; ?>', '<?php echo $_REQUEST['stam']; ?>', 'Buyer');">Home Buyer(s)</a></br>
&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick="sendMail('<?php echo $_REQUEST['lett_id']; ?>', '<?php echo $_REQUEST['stam']; ?>', 'All');">All of the above</a></br></div>

<img src="images/pin-icon.png" title="Email this letter in the expert format" onMouseOver="shooptio();" style="width:32px !important; cursor:pointer; height:32px !important;margin-right:20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="<?php echo 'conve/examples/about.php?lett_id='.$_REQUEST['lett_id'].'&stam='.$_REQUEST['stam']; ?>" target="_blank"><img src="images/pdf-icon.png" title="PDF this letter" style="width:32px !important; cursor:pointer; height:32px !important;"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="<?php echo 'conve/examples/about.php?lett_id='.$_REQUEST['lett_id'].'&stam='.$_REQUEST['stam']; ?>" target="_blank"><img src="images/print-icon.png" title="Print this letter" onClick="printSelection(document.getElementById('printit'));return false;" style="width:32px !important; cursor:pointer; height:32px !important;"/></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<!--<a href="<?php //echo 'file_download.php?file_name=certificates/'.$nam; ?>" target="_blank"><img src="images/print-icon.png" title="Print this letter" style="width:32px !important; cursor:pointer; height:32px !important;"/></a>-->
<!--<img src="images/print-icon.png" title="Print this letter" onClick="printSelection(document.getElementById('printit'));return false;" style="width:32px !important; cursor:pointer; height:32px !important;"/>-->

<a href="letterbasic.php?lett_id=<?php echo $_REQUEST['lett_id']; ?>&stam=<?php echo $_REQUEST['stam']; ?>" style="color:#A0CE3A;">
<img src="images/gobacktobasic.png" title="Switch to Basic View of this letter" style="cursor:pointer; height:32px !important;"/>&nbsp;&nbsp;&nbsp;
Change view >></a></p>
</div>
<div id="printit">
<table cellpadding="0" cellspacing="0" border="0" style="width:85% !important;z-index:99999;" align="center"
<tr style="border-top:1px solid #dedede;">

<td width="20%" align="left" style="background-image:url('images/transparent-background-logo.png');
background-repeat:no-repeat;background-attachment:fixed;background-position:center;">
<img src="<?php echo stripslashes($const['logo_url']); ?>" style="max-width:150px;max-height:100px" width="150px" height="100px" ></td>          
<td width="60%" class="" align="center"><h2 style="font-variant:small-caps;font-weight:bolder;letter-spacing:1px;">Loan Pre Approval Certificate</h2></td>
<td width="20%"><table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td width="40%" style="color:#666;font-size:10px">Pre-Qual No</td>
<td width="60%" style="color:#666;font-size:10px"><?php echo $bhfv['pre_qual_no']; ?></td></tr>
<tr><td style="color:#666;font-size:10px">Lead ID</td>
<td style="color:#666;font-size:10px"><?php echo $bhfv['lead_id']; ?></td></tr></table></td></tr>

<tr><td colspan="3" style="background:#E6EDF2 !important">
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-size:13px;color:#000">

<tr><td align="center" width="33%" style="color:#666;font-weight:bold;font-size:16px">Borrowers:<br><span style="font-weight:normal !important;"><?php echo $ccd; ?></span></td>
<td align="center" width="33%" style="color:#666;font-weight:bold;font-size:16px">Certificate Generation Date:<br> <span style="font-weight:normal !important;"><?php echo date('m/d/Y', $bhfv['generation_date']); ?></span></td>
<td align="center" width="34%" style="color:#666;font-weight:bold;font-size:16px">Certificate Expiration Date:<br> <span style="font-weight:normal !important;"><?php echo date('m/d/Y', $bhfv['expiry_date']); ?></span></td></tr></table></td></tr>

<tr><td colspan="3" align="center">
<h2 style="font-variant:small-caps;font-weight:bold;letter-spacing:0.5px;line-height:25px">Congratulations!</h2>
<p><span style="font-weight:bold;font-size:18px"><u><?php echo $sdret['companyname']; ?></u></span><p>
<p style="margin:0 0 5px !important;">has pre-approved you based upon the following loan terms:</h4></td></tr>

<tr><td colspan="3"><div class="poss">
<table cellpadding="2" cellspacing="0" border="0" width="100%" style="background:#F7FCFF;">

<tr><td class="str_align" valign="top" width="50%" style="border: 1px solid #DEDEDE;padding:20px 0;line-height:15px !important;" align="center">

<p><strong>Purchase Price:</strong>&nbsp;
<span style="font-weight:bold;color:#025D92 !important;font-size:large;">$<?php echo formatMoney($bhfv['purchase_price']); ?></span></p>

<p><strong>Down Payment:</strong>&nbsp;<b><?php echo $bhfv['down_payment']; ?>%</b></p>
<p><strong class="nrmal">Loan Type:</strong>&nbsp;<?php echo $bhfv['loan_type']; ?></p>
<p><strong class="nrmal">Loan Term:</strong>&nbsp;<?php echo $bhfv['loan_term']; ?></p>
<p><strong class="nrmal">1st Mortgage:</strong>&nbsp;<?php echo $bhfv['mortgage_one']; ?></p>
<p><strong class="nrmal">2st Mortgage:</strong>&nbsp;<?php echo $bhfv['mortgage_two']; ?></p>
<p><strong class="nrmal">If ARM Loan - Index:</strong>&nbsp;<?php echo $bhfv['loan_index']; ?></p>
<p><strong class="nrmal">If ARM Loan - Margin:</strong>&nbsp;<?php echo $bhfv['loan_margin']; ?></p></td>

<td class="str_align" valign="top" width="50%" style="border:1px solid #DEDEDE;padding:20px 0;line-height:15px !important;" align="center">
<p><strong class="nrmal">Payment Type:</strong>&nbsp;<?php echo $bhfv['payment_type']; ?></p>

<p><strong class="nrmal">Property Type:</strong>&nbsp;<?php echo $bhfv['property_type']; ?></p>
<p><strong class="nrmal">Occupancy:</strong>&nbsp;<?php echo $bhfv['Occupancy']; ?></p>

<p style="clear:both;"><strong class="nrmal">**Max. Qualifying Interest Rate:</strong>&nbsp;<?php echo $bhfv['max_qual_interest_rate']; ?></p>
<p style="clear:both;"><strong class="nrmal">Credit Score:&nbsp;</strong><?php echo $bhfv['credit_score']; ?> </p>                    
<p style="clear:both;"><strong class="nrmal">Mortgage Insurance:</strong>&nbsp;<?php echo $bhfv['mortgage_insurance']; ?></p>
<p style="text-align:center;clear:both;">**This is the maximum interest rate for which you qualify
under the loan program reflected on this Certificate.</p></td></tr>

<tr><td colspan="3" align="center" style="border:none !important;"><p style="padding-top:10px;"><span style="font-weight:bold;font-size:20px;color: #025D92;font-family: 'Open Sans',sans-serif;"></span><span style="color:#666">Property Address:</span> <?php echo $bhfv['property_suite'].' '.$bhfv['property_street'].', '.$bhfv['property_city'].', '.$bhfv['property_state'].', '.$bhfv['property_zip']; ?></p></td></tr></table></div>

<div style="border:1px solid #DEDEDE;padding:10px 0px 0px 0px;">
<p style="text-align:center;font-weight:bold;">
Loan Originator: <span style="color:#025D92"><?php echo $sdret['firstname'].' '.$sdret['lastname'].' - '.$sdret['phone'].' - '.$sdret['email'].' - NMLS #'.$sdret['license']; ?><br>
<?php echo $sdret['companyname']; ?><br><?php echo $sdret['street'].', '.$sdret['suite'].', '.$sdret['city'].', '.$sdret['state'].', '.$sdret['zip']; ?></span></p></div>
<div style="border: 1px solid #DEDEDE;padding:5px 0px 0px 0px;background:#E6EDF2">
<h4 style="text-align:center;">Important Notices</h4></div></td></tr>
<tr><td colspan="3"><table align="center">
<tr><td style="font-size:9px !important;line-height:11px !important;margin-left:15px !important"><?php echo stripslashes($const['notice']); ?></td></tr>

<!--<tr><td style="font-size:8px !important;line-height:8px !important;padding:0px 5px !important;"><p><?php //echo stripslashes($const['notice']); ?></p></td></tr>-->
<tr><td align="center"><p><img src="<?php echo stripslashes($const['logo_url']);?>" style="padding:0 10px 0 0;max-height:100px !important;max-width:100px" />
<strong><?php echo $sdret['companyname']; ?></strong></p></td></tr></table></td></tr></table></div></div><?php

}
?></div>
<div class="space40"></div>
<footer class="footer">
<?php
include("includes/topfooter.php");
include("includes/footer.php");
?>
</footer>
<?php include("includes/javascript.php"); ?>
</body>
</html>