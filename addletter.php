<?php include("admin/config.php");

if(!$_SESSION['logge'] or !isset($_SESSION['logge']['id']))
 {
   header('location:index.php');
 }

if(isset($_REQUEST['landsubmit']) and $_REQUEST['landsubmit']!='')
 {
	$stam= time();
	$ninty= 90*24*60*60;
	$dina= explode("/", $_POST['Cert_Gene_Date']);
	$Cert_Gene_Date= strtotime($dina[1]."-".$dina[0]."-".$dina[2]);
	$Cert_Exxp_Date= $Cert_Gene_Date+$ninty;
	
	//$Cert_Gene_Date=strtotime($_POST['Cert_Gene_Date']);
	//$Cert_Exp_Date=strtotime($_POST['Cert_Exp_Date']);
	
	$home_buyer=addslashes($_POST['home_buyer']);
	$Pre_qual=addslashes($_POST['Pre_qual']);
	$Lead_id=addslashes($_POST['Lead_id']);
	$Purchase_Price=addslashes($_POST['Purchase_Price']);
	$Down_Payment=addslashes($_POST['Down_Payment']);
	$Loan_Type=addslashes($_POST['Loan_Type']);
	$Loan_Term=addslashes($_POST['Loan_Term']);
	$Payment_Typ=addslashes($_POST['Payment_Typ']);
	$firstst_Mortgage=addslashes($_POST['firstst_Mortgage']);
	$secst_Mortgage=addslashes($_POST['secst_Mortgage']);
	$Property_Type=addslashes($_POST['Property_Type']);
	$Occupancy=addslashes($_POST['Occupancy']);
	$Loan_Index=addslashes($_POST['Loan_Index']);
	$Loan_Margin=addslashes($_POST['Loan_Margin']);
	$Max_Qual_Interest=addslashes($_POST['Max_Qual_Interest']);
	$Credit_Score=addslashes($_POST['Credit_Score']);
	$Mort_Insur=addslashes($_POST['Mort_Insur']);
	$Prop_Street_Addr=addslashes($_POST['Prop_Street_Addr']);
	$Prop_Suite_Apt=addslashes($_POST['Prop_Suite_Apt']);
	$Prop_City=addslashes($_POST['Prop_City']);
	$Prop_State=addslashes($_POST['Prop_State']);
	$ZIP_Code=addslashes($_POST['ZIP_Code']);
	$created=time();
	if($home_buyer!='' and $Cert_Gene_Date!='' and $Purchase_Price!='' and $Down_Payment!='' and $Loan_Type!='' and $Max_Qual_Interest!='' and  $Prop_Street_Addr!='' and $Prop_City!='' and $Prop_State!='' and $ZIP_Code!='')
	 {
	  $insert=mysql_query("INSERT INTO `repreapproval_com`.`letters` (`letter_sender`, `buyer_view`, `buyer_id`, `pre_qual_no`, `lead_id`, `generation_date`, `expiry_date`, `purchase_price`, `down_payment`, `loan_type`, `loan_term`, `payment_type`, `mortgage_one`, `mortgage_two`, `property_type`, `Occupancy`, `loan_index`, `loan_margin`, `max_qual_interest_rate`, `credit_score`, `mortgage_insurance`, `property_street`, `property_suite`, `property_city`, `property_state`, `property_zip`, `created`, `letter_type`) VALUES ('".$_SESSION['logge']['id']."', 'SHOW', '".$home_buyer."', '".$Pre_qual."', '".$Lead_id."', '".$Cert_Gene_Date."', '".$Cert_Exxp_Date."', '".$Purchase_Price."', '".$Down_Payment."', '".$Loan_Type."', '".$Loan_Term."', '".$Payment_Typ."', '".$firstst_Mortgage."', '".$secst_Mortgage."', '".$Property_Type."', '".$Occupancy."', '".$Loan_Index."', '".$Loan_Margin."', '".$Max_Qual_Interest."', '".$Credit_Score."', '".$Mort_Insur."', '".$Prop_Street_Addr."', '".$Prop_Suite_Apt."', '".$Prop_City."', '".$Prop_State."', '".$ZIP_Code."', '".$stam."', 'MAIN');");
	  if($insert)
	   {
		 header('location:lenderdashboard.php');
		 //$_SESSION['msg']='lettercreated';
	   }
	 }
	else
	 {
	   $_SESSION['msg']='fieldrequired';
	 }
 }

//$vgsx= mysql_query("select id from userthree where accounttype= 'REALTOR' and createdby= '".$_SESSION['logge']['id']."'");
$vgsx= mysql_query("select id from userthree where accounttype= 'REALTOR' and FIND_IN_SET('".$_SESSION['logge']['id']."', createdby)");
$xspo= array();
while($kod= mysql_fetch_assoc($vgsx))
 {
   $xspo[]= $kod['id'];
 }

$haz= implode(',', $xspo);

//$dspl= mysql_query("select * from userthree where accounttype= 'HOMEBUYER' and createdby in (".$haz.")");
$dspl= mysql_query("select * from userthree where accounttype= 'HOMEBUYER' and `lender_of_buyer`= '".$_SESSION['logge']['id']."'");
$xvfbo= array();
if($dspl)
 {
  while($kod= mysql_fetch_assoc($dspl))
   {
    $xvfbo[]= $kod;// these are all homebuyers
   }
 }

?><!DOCTYPE html>
<html class="not-ie" lang="en">
<head><meta charset="utf-8">
<title>Add a Pre-Approval Letter in your RePreApproval account</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and Home Buyers, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, Home Buyers, realtos, mortgage lender, lenders"><?php
include("includes/head.php");
?><link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
var err= 0;

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
	fillfield('Cert_Gene_Date');
	fillfield('Purchase_Price');
	fillfield('Down_Payment');
	fillfield('Loan_Type');
	fillfield('Loan_Term');
	fillfield('Max_Qual_Interest');
	fillfield('Credit_Score');
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
      //minDate: new Date(),
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
<?php include_once("analyticstracking.php"); ?>
<header>
<?php include("includes/header.php"); ?>
</header>
<div class="breadcrumb-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Add a pre-approval letter</h1>
        <!--<ol class="breadcrumb"><li class="active">Quick, efficient and powerful!</li>-->
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="space20"></div>
<div class="container"><div class="row"><div class="col-md-8">
<div style="background-color:#E7B987; text-align:center; width:500px; display:none" id="lettercreatedAA">Letter successfully created. </div>
<div style="background-color:#E7B987; text-align:center; width:500px; display:none" id="fieldrequiredAA">Something went wrong, please try again.</div><?php
if(isset($xvfbo) and count($xvfbo)>0)
 {
   ?><div class="login">
    <form name="registerform" id="registerform" action="addletter.php" method="post"  class="form-horizontal">
    <p id="reg_passmail"></p>
    <div class="form-group">
    <label class="col-sm-3" for="">Home Buyer*</label>
    <div class="col-sm-9">
    <select name="home_buyer" id="home_buyer" class="input"><?php
	foreach($xvfbo as $jhc=>$oksw)
	 {
	   $ccdzx= '';
	   if($oksw['otherbuyer']!='')
		{
		  $xxz= explode('@=@', $oksw['otherbuyer']);
		  foreach($xxz as $bbzx=>$vgsz)
		   {
			 if($vgsz=='' or $vgsz==' ' or $vgsz==NULL)
			  {
				unset($xxz[$bbzx]);
			  }
		   }
		  $vgs= implode(', ', $xxz);
		  $ccdzx= '';
		  if($vgs!='' and $vgs!=' ' and $vgs!=NULL)
		   {
			 $ccdzx= ', '.$vgs;
		   }
		  // all above or //$ccdzx= ', '.implode(', ', explode('@=@', $oksw['otherbuyer']));
		}
	   ?><option value="<?php echo $oksw['id']; ?>"><?php echo $oksw['firstname'].$ccdzx; ?></option><?php
	 }
	?></select></div></div>
          
          <div class="form-group">
            <label class="col-sm-3" for="">Pre-Qual No</label>
            <div class="col-sm-9">
              <input type="text" name="Pre_qual" class="input poin" size="50" placeholder="Example: 1234" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Lead ID</label>
            <div class="col-sm-9">
              <input type="text" name="Lead_id" class="input" size="50" placeholder="Example: 1234" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Certificate Generation Date*</label>
            <div class="col-sm-9">
              <input type="text" name="Cert_Gene_Date" id="Cert_Gene_Date" class="input" size="50"  onBlur="fillfield('Cert_Gene_Date');"  placeholder="Click and select a date from the calendar" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Certificate Expiration Date</label>
            <div class="col-sm-9">
              <input type="text" name="Cert_Exp_Date" id="Cert_Exp_Date" class="input" size="50" readonly  placeholder="90 days will be automatically added for your convenience" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Purchase Price ($)*</label>
            <div class="col-sm-9">
              <input type="text" name="Purchase_Price" id="Purchase_Price" class="input" size="50"  onBlur="fillfield('Purchase_Price');" placeholder="Do not add $ sign" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Down Payment (%)*</label>
            <div class="col-sm-9">
              <input type="text" name="Down_Payment" id="Down_Payment" class="input" size="50"  onBlur="fillfield('Down_Payment');" placeholder="Do not add % sign" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Loan Type*</label>
            <div class="col-sm-9">
              <input type="text" name="Loan_Type" id="Loan_Type" class="input" onBlur="fillfield('Loan_Type');" size="50"  placeholder="Example: FHA" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Loan Term*</label>
            <div class="col-sm-9">
              <input type="text" name="Loan_Term" id="Loan_Term" class="input" onBlur="fillfield('Loan_Term');" size="50"  placeholder="Example: 360 months" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Payment Type</label>
            <div class="col-sm-9">
              <input type="text" name="Payment_Typ" id="Payment_Typ" class="input" value="" size="50"  placeholder="Example: Interest only"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">1st Mortgage</label>
            <div class="col-sm-9">
              <input type="radio" name="firstst_Mortgage" id="firstst_Mortgage" value="Yes"/>
              &nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="firstst_Mortgage" id="1st_Mortgagee" value="No"/>
              &nbsp;&nbsp;No</div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">2st Mortgage</label>
            <div class="col-sm-9">
              <input type="radio" name="secst_Mortgage" id="secst_Mortgage" value="Yes"/>
              &nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="secst_Mortgage" id="2st_Mortgage" value="No"/>
              &nbsp;&nbsp;No</div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Property Type</label>
            <div class="col-sm-9">
              <input type="text" name="Property_Type" id="Property_Type" class="input" size="50"  placeholder="Example: SFR" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Occupancy</label>
            <div class="col-sm-9">
              <input type="text" name="Occupancy" id="Occupancy" class="input" size="50"  placeholder="Example: Owner occupied" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">If ARM Loan: Index (%)</label>
            <div class="col-sm-9">
              <input type="text" name="Loan_Index" id="Loan_Index" class="input" size="50"  placeholder="Example: 1%. Please add % sign." />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">If ARM Loan: Margin (%)</label>
            <div class="col-sm-9">
              <input type="text" name="Loan_Margin" id="Loan_Margin" class="input" size="50"  placeholder="Example: 1%. Please add % sign." />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Max. Qualifying Interest Rate (%)*</label>
            <div class="col-sm-9">
              <input type="text" name="Max_Qual_Interest" id="Max_Qual_Interest" onBlur="fillfield('Max_Qual_Interest');" class="input" size="50"  placeholder="Example: 1%. Please add % sign." />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Credit Score*</label>
            <div class="col-sm-9">
              <input type="text" name="Credit_Score" id="Credit_Score" class="input" onBlur="fillfield('Credit_Score');" size="50" placeholder="Example: 850" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Mortgage Insurance</label>
            <div class="col-sm-9">
              <input type="radio" name="Mort_Insur" id="Mort_Insur" value="Yes"/>
              &nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name="Mort_Insur" id="Mort_Insur" value="No"/>
              &nbsp;&nbsp;No</div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Property Street Address*</label>
            <div class="col-sm-9">
              <input type="text" name="Prop_Street_Addr" id="Prop_Street_Addr" class="input" onBlur="fillfield('Prop_Street_Addr');" size="50" placeholder="Required" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Property Suite or Apt</label>
            <div class="col-sm-9">
              <input type="text" name="Prop_Suite_Apt" id="Prop_Suite_Apt" class="input" size="50" placeholder="Optional" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Property City*</label>
            <div class="col-sm-9">
              <input type="text" name="Prop_City" id="Prop_City" class="input" size="50"  onBlur="fillfield('Prop_City');" placeholder="Required" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Property State*</label>
            <div class="col-sm-9">
              <input type="text" name="Prop_State" id="Prop_State" class="input" size="50"  onBlur="fillfield('Prop_State');" placeholder="Required" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3" for="">Property ZIP Code*</label>
            <div class="col-sm-9">
              <input type="text" name="ZIP_Code" id="ZIP_Code" class="input poin" size="50"  onBlur="fillfield('ZIP_Code');" placeholder="Required" />
            </div>
          </div>
          <div class="form-group submit">
            <label class="col-sm-3" for="">&nbsp;</label>
            <div class="col-sm-9">
              <input type="submit" name="landsubmit" value="Add a new Pre-Approval Letter" class="btn btn-primary"/>
            </div>
          </div>
          <div class="form-group">&nbsp;</div>
        </div>
        <div>
        </div>
      </form>
    </div><?php
 }
else
 {
   ?><div style="background-color:#E7B987; text-align:center; width:500px;"> You do not have any homebuyer to send these lettors </div><?php
 }

?></div>
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
?></footer><?php
include("includes/javascript.php");
?></body>
</html>