<?php include("admin/config.php");
if(isset($_REQUEST['amount'])  and isset($_REQUEST['Plan']))
{
	$time=strtotime(date('y-m-d'));
$_SESSION['membership']=$_REQUEST['amount'];
$slePromo=mysql_query("select * from code where p_code='".$_REQUEST['promocode']."' and start_date<='".$time."' and end_date>='".$time."'");
$Check=mysql_num_rows($slePromo);
	if($Check>0)
	{

$Data=mysql_fetch_assoc($slePromo);
if($Data['applies_to']=='Y')
{
$_SESSION['Discount']=round(($_SESSION['membership']*($Data['discount']/100)),2);
}
else
{
	$ApplyArray=explode(',',$Data['applies_to']);
	if(in_array($_REQUEST['Plan'],$ApplyArray))
	{
		$_SESSION['Discount']=round(($_SESSION['membership']*($Data['discount']/100)),2);
	}
	else
	{
		$_SESSION['Discount']=0;
	}
}
	}
	else
	{
		$_SESSION['Discount']=0;
	}
$_SESSION['plan']=$_REQUEST['Plan'];
}
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
          <h1>Payment Review</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="space20"></div>
  <div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="login">

  <form action="https://globalgatewaye4.firstdata.com/payment" method="POST">

<?php
      
	  $x_login = $firstData['x_login'];  //  Take from Payment Page ID in Payment Pages interface
      $transaction_key = $firstData['transaction_key']; // Take from Payment Pages configuration interface
      $x_amount = $_SESSION['membership']-$_SESSION['Discount'];
      $x_currency_code = "USD"; // Needs to agree with the currency of the payment page
      srand(time()); // initialize random generator for x_fp_sequence
      $x_fp_sequence = rand(1000, 100000) + 123456;
      $x_fp_timestamp = time(); // needs to be in UTC. Make sure webserver produces UTC

      // The values that contribute to x_fp_hash
      $hmac_data = $x_login . "^" . $x_fp_sequence . "^" . $x_fp_timestamp . "^" . $x_amount . "^" . $x_currency_code;
      $x_fp_hash = hash_hmac('MD5', $hmac_data, $transaction_key);
     ?>
		<div style="float:left;width:213px;">
       <p><label>Membership Investment</label></p>
       <p><label>Discount <span style="font-size:small;font-style:italic;">(if applicable)<span></label></p>
       <p><label>Total Amount</label></p>
       <!--<p><label>Currency Code</label></p>-->
       <p><label>&nbsp;</label></p>
       </div>
       <div>
       <p><strong>$</strong><input type="text" readonly name="" value="<?php echo $_SESSION['membership']; ?>"></p>
       <p><strong>$</strong><input type="text" readonly name="" value="<?php echo $_SESSION['Discount']; ?>"></p>
       <p><strong>$</strong><input type="text" readonly name="x_amount" value="<?php echo $x_amount ?>"></p>
       <p><input type="hidden" readonly name="x_currency_code" value="<?php echo $x_currency_code; ?>"></p>
       <p><input type="submit" value="Pay" class="btn btn-primary"/></p>
       </div>

       <input type="hidden" name="x_login" value="<?php echo $x_login ?>">
       <input type="hidden" name="x_fp_sequence" value="<?php echo $x_fp_sequence ?>">
       <input type="hidden" name="x_fp_timestamp" value="<?php echo $x_fp_timestamp ?>">
       <input type="hidden" name="x_fp_hash" value="<?php echo $x_fp_hash ?>" size="50">
       <input type="hidden" name="x_show_form" value="PAYMENT_FORM"/>
        <input type="hidden" name="x_recurring_billing" value="TRUE"/>
      <input type="hidden" name="x_recurring_billing_id" value="MB-REPRE-2-70140"/>

      <input type="hidden" name="x_recurring_billing_amount" value="<?php echo $x_amount; ?>"/>
      <input type="hidden" name="Ecommerce_flag" value="2"/>
      <input name="x_line_item" value="1<|>Instant Payment<|>Instant Payment<|>1<|><?php echo $x_amount; ?><|>YES" type="hidden">
       <br/><br/>
    </form>

    </div>
    </div>
  </div>
</div>

<div class="space40"></div>
<div class="space60"></div>
<footer class="footer"><?php
include("includes/topfooter.php");
include("includes/footer.php");
?></footer><?php
include("includes/javascript.php");
?>
  </body>
</html>
