<?php include("admin/config.php");

function formatMoney($number, $fractional=false)
 { 
  if($fractional)
   { 
    $number = sprintf('%.2f', $number); 
   } 
  while(true)
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
   $nam= $_REQUEST['lett_id'].'RePre_BAS'.$_REQUEST['stam'].'.pdf';
   
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
<title>RePreApproval Letter - Basic Style</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders"><?php
include("includes/head.php");
?><script type="text/javascript">
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
function sendMail(id, stamaa, flag)
 {
   $.ajax({
    type: "POST",
    data:{BASlett_id:id, BASstam:stamaa, oto:flag},
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

function shooptio()
 {
   $('#sen_yo_many').slideDown('slow').delay(6666).slideUp('fast');
 }

$(document).ready(function(){

});

</script></head><body><?php
include_once("analyticstracking.php");
?><header><?php
include("includes/header.php");
?><style>
td {background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #E6EDF2 !important; color: #666; padding:0px;}
th, td {padding:5px 10px !important;}
table, th, td {border-radius: 0;}
td, th {padding:5px !important;}
.str_align p{clear:both !important;padding:0 !important;}
</style>
</header><div class="space20"></div>
<div class="container"><div class="row">

<div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px;margin-bottom:10px" id="maisen">This letter has been successfully sent to your specified choice.</div>
<div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px;margin-bottom:10px" id="nmaisen">Something went wrong, please try again. </div>

<div style="text-align:center;position:relative;"><p>
<div id="sen_yo_many" style="display:none; position:absolute;left:378px;top:36px;font-size:12px; z-index:100;background:#9ACE3C;border:1px solid #cacaca;padding:5px;font-weight:bold;border-radius:5px;text-align:left !important">
<span style="text-align:center;">Email this letter to :</span><br>
&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick="sendMail('<?php echo $_REQUEST['lett_id']; ?>', '<?php echo $_REQUEST['stam']; ?>', 'Lender');">Lender</a></br>
&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick="sendMail('<?php echo $_REQUEST['lett_id']; ?>', '<?php echo $_REQUEST['stam']; ?>', 'Realtor');">Realtor</a></br>
&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick="sendMail('<?php echo $_REQUEST['lett_id']; ?>', '<?php echo $_REQUEST['stam']; ?>', 'Buyer');">Home Buyer(s)</a></br>
&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onClick="sendMail('<?php echo $_REQUEST['lett_id']; ?>', '<?php echo $_REQUEST['stam']; ?>', 'All');">All of the above</a></br></div>

<img src="images/pin-icon.png" title="Email this letter in the basic format" onMouseOver="shooptio();" style="width:32px !important; cursor:pointer; height:32px !important;margin-right:20px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="<?php echo 'conve/examples/aboutbasic.php?BASlett_id='.$_REQUEST['lett_id'].'&BASstam='.$_REQUEST['stam']; ?>" target="_blank"><img src="images/pdf-icon.png" title="PDF this letter" style="width:32px !important; cursor:pointer; height:32px !important;"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="<?php echo 'conve/examples/aboutbasic.php?BASlett_id='.$_REQUEST['lett_id'].'&BASstam='.$_REQUEST['stam']; ?>" target="_blank"><img src="images/print-icon.png" title="Print this letter" onClick="printSelection(document.getElementById('printit'));return false;" style="width:32px !important; cursor:pointer; height:32px !important;"/></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<!--<a href="<?php //echo 'file_download.php?file_name=certificates/'.$nam; ?>" target="_blank"><img src="images/print-icon.png" title="Print this letter" style="width:32px !important; cursor:pointer; height:32px !important;"/></a>-->
<!--<img src="images/print-icon.png" title="Print this letter" onClick="printSelection(document.getElementById('printit'));return false;" style="width:32px !important; cursor:pointer; height:32px !important;"/>-->

<a href="letterexpert.php?lett_id=<?php echo $_REQUEST['lett_id']; ?>&stam=<?php echo $_REQUEST['stam']; ?>" style="color:#A0CE3A;">
<img src="images/gobacktoexpert.png" title="Switch to Expert View of this letter" style="cursor:pointer; height:32px !important;"/>&nbsp;&nbsp;&nbsp;
Change view >></a></p></div>

<div id="printit"><table cellpadding="0" cellspacing="0" border="0" style="width:95% !important;" align="center">
<tr><td colspan="3" align="left" style="background-image:url('images/transparent-background-logo.png');
background-repeat:no-repeat;background-attachment:fixed;background-position:center;">
<p style="text-align:center;"><img src="<?php echo stripslashes($const['logo_url']); ?>" width="120" style="max-width:120px;padding-top:20px"/></p>
<p>&nbsp;</p>
<p style="margin-left:20px;font-size:16px;float:left;"><b>Borrower(s):</b> <?php echo $ccd; ?></p>

<p style="margin-left:20px;margin-right:20px;text-align:right">
Certificate Generation Date: <b><?php echo date('m/d/Y', $bhfv['generation_date']); ?></b><br>
Certificate Expiration Date: <b><?php echo date('m/d/Y', $bhfv['expiry_date']); ?></b></p>

<p style="margin-left:20px;margin-right:20px;">To Whom It May Concern,</p>
<!--<p style="margin-left:20px;margin-right:20px;"><?php //echo $otherbuyre['firstname'].' '.$otherbuyre['lastname']; ?>,</p>-->

<p style="margin-left:20px;margin-right:20px;">Upon review of the credit and income documentation for the above-referenced borrower(s), they have been pre-approved for a purchase money loan with the following terms :</p>
<p style="text-align:center;font-size:16px">Purchase price: <b>$<?php echo formatMoney($bhfv['purchase_price']); ?></b><br>
Down payment: <b><?php echo $bhfv['down_payment']; ?>%</b><br>
Loan Type: <b><?php echo $bhfv['loan_type']; ?></b><br>
Credit Score: <b><?php echo $bhfv['credit_score']; ?></b></p>
<p style="margin-left:20px;margin-right:20px;">This Pre-Approval letter serves as notification of loan approval through Automated Underwriting and as a commitment for a mortgage loan subject to satisfactory completion of the following conditions :</p>
<p style="margin-left:20px;margin-right:20px;">1. Investor approval of appraisal, purchase contract and preliminary title report<br>
2. Asset/Down payment documentation<br>
3. All prior to document conditions<br>
4. Investor approval of all conditions</p>
<p style="margin-left:20px;margin-right:20px;">Please do not hesitate to call me with any questions.</p>
<p style="margin-left:20px;margin-right:20px;">Sincerely,</p>
<p style="margin-left:20px;margin-right:20px;"><img src="<?php echo stripslashes($const['signature_url']); ?>" style="width:250px !important;max-width:250px;height:50px;max-height:50px;"/></p>

<p style="margin-left:20px;margin-right:20px;"><span style="font-weight:bold;font-size:16px;color: #666;font-family: 'Open Sans',sans-serif;"><?php echo $sdret['firstname'].' '.$sdret['lastname']; ?></span><br><?php echo $sdret['phone']; ?><br><?php echo $sdret['email']; ?><br><?php echo 'NMLS # '.$sdret['license']; ?><br></p>
<p style="margin-left:20px;margin-right:20px;"><span style="font-weight:bold;font-size:18px;color: #025D92;font-family: 'Open Sans',sans-serif;"><?php echo $sdret['companyname']; ?></span><br><?php echo $sdret['street']; ?><br><?php echo $sdret['city'].', '.$sdret['state'].' '.$sdret['zip']; ?></p>
<div style="font-size:8px !important;line-height:11px !important;margin-left:15px !important"><?php echo stripslashes($const['notice']); ?></div>

</td></tr></table></div></div></div><div class="space40"></div><footer class="footer"><?php
include("includes/topfooter.php");
include("includes/footer.php");?></footer><?php
include("includes/javascript.php");
?></body></html>