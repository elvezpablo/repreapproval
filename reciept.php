<?php
require '../vendor/autoload.php';
include("admin/config.php");
include('mailgun/RPAMailGun.php');
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
<?php include("includes/head.php"); ?>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
<header>
<?php include("includes/header.php"); ?>
</header>
<?php


if($_REQUEST['x_response_code']==1)
{
	if(isset($_SESSION['upgradeplan']) and $_SESSION['upgradeplan']=='yes')
	{
		
	if($_SESSION['plan']=='platinumPlan')
	{
		$plan='Platinum Plan';
	}
	else if($_SESSION['plan']=='goldPlan')
	{
		$plan='Gold Plan';
	}
	else if($_SESSION['plan']=='silverPlan')
	{
		$plan='Silver Plan';
	}

$date=strtotime(date('Y-m-d', strtotime("+30 days")));
$pro=$_REQUEST['x_trans_id'];
$initialpayment=$_REQUEST['x_amount'];
$Discount=$_SESSION['Discount'];
$tty= time();
$inser= mysql_query("update userthree set plan='".$_SESSION['plan']."' where id='".$_SESSION['logge']['id']."'");
 if($inser)// send Plan Upgrade Message message
   {
	   	$LanderId=$_SESSION['logge']['id'];
		$selec= mysql_fetch_assoc(mysql_query("select * from userthree where id = '".$LanderId."'"));
		$_SESSION['logge']=$selec;
		$insert=mysql_query("insert into companyinvoices(profile_id,lender_id,date_billing,amount,discount,exp_date,status)values('".$pro."','".$LanderId."','".$tty."','".$initialpayment."','".$_SESSION['Discount']."','".$date."','p')");
	   $subject= "Payment information";
		$to= $_SESSION['email']['user_email'];
		$from= "admin@repreapproval.com";
		$mess= '<table width="550px">
		<tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style=""width:340px" /></td></tr>
		
		<tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr>

		<tr><td colspan="2" style="color:#000;">Hello '.$_REQUEST['CardHoldersName'].',<br /><br/>This is the receipt for your membership plan upgrade at <strong>RePreApproval</strong>.<br/><br/>
		Following is the details of your payment for your record.</td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>
	
		<tr><td><strong style="color:#000;">Payment Type</strong></td><td><strong style="color:#045D92;">Purchase</strong></td></tr>
		<tr><td><strong style="color:#000;">Transaction ID</strong></td><td><strong style="color:#045D92;">'.$_REQUEST['x_trans_id'].'</strong></td></tr>
		<tr><td><strong style="color:#000;">Plan</strong></td><td><strong style="color:#045D92;">'.$plan.'</strong></td></tr>
		
		<tr><td><strong style="color:#000;">Amount</strong></td><td><strong style="color:#045D92;">$'.$_REQUEST['x_amount'].'</strong></td></tr>

<tr><td><strong style="color:#000;">Discount</strong> <i>(if applicable)</i></td><td><strong style="color:#045D92;">$'.$_SESSION['Discount'].'</strong></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>

        <tr><td colspan="2">If you require additional assistance, do not hesitate to email us or visit our <a href="http://www.repreapproval.com/faq.php" style="color:#26609E;text-decoration:none;">Frequently Asked Questions</a> page.</td></tr>
		
		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">Thank you for choosing <strong>RePreApproval</strong>.</td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">We wish you great success.</td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">The Team at <strong>RePreApproval</strong></td></tr>
		
		<tr><td colspan="2">&nbsp;</td></tr>
		
		<tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply go to the <a href="http://www.repreapproval.com/login.php" style="color:#26609E;text-decoration:none;"> Login Page</a>.</td></tr>

		<tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>
		
		</table>';
		
//		$headers  = 'MIME-Version: 1.0' . "\r\n";
//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//		$headers .= 'From: '.$from. "\r\n";
//		mail($to, $subject, $mess, $headers);
         $mailgun = new RPAMailGun();
         if($mailgun->mail($to, $subject, $mess, array('receipt','upgrade'))) {

         }
	   }
 $_SESSION['upgradeplan']='';
 header('location:lenderdashboard.php?tab=profile');	
	}
	else
	{
	
	if($_SESSION['plan']=='platinumPlan')
	{
		$plan='Platinum Plan';
	}
	else if($_SESSION['plan']=='goldPlan')
	{
		$plan='Gold Plan';
	}
	else if($_SESSION['plan']=='silverPlan')
	{
		$plan='Silver Plan';
	}
//mail payment info to user	
	
$subject= "Payment information";
		$to= $_SESSION['user_email'];
		$from= "admin@repreapproval.com";
		
		$mess= '<table width="550px">

		<tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style=""width:340px" /></td></tr>
		
		<tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr>

		<tr><td colspan="2" style="color:#000;">Hello '.$_REQUEST['CardHoldersName'].',<br /><br/>This is the receipt for your membership purchase at <strong>RePreApproval</strong>.<br/><br/>
		Following is the details of your payment for your record.</td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>
	
		<tr><td><strong style="color:#000;">Payment Type</strong></td><td><strong style="color:#045D92;">Purchase</strong></td></tr>
		<tr><td><strong style="color:#000;">Transaction ID</strong></td><td><strong style="color:#045D92;">'.$_REQUEST['x_trans_id'].'</strong></td></tr>
		<tr><td><strong style="color:#000;">Plan</strong></td><td><strong style="color:#045D92;">'.$plan.'</strong></td></tr>
		
		<tr><td><strong style="color:#000;">Amount</strong></td><td><strong style="color:#045D92;">$'.$_REQUEST['x_amount'].'</strong></td></tr>

<tr><td><strong style="color:#000;">Discount</strong> <i>(if applicable)</i></td><td><strong style="color:#045D92;">$'.$_SESSION['Discount'].'</strong></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>

        <tr><td colspan="2">If you require additional assistance, do not hesitate to email us or visit our <a href="http://www.repreapproval.com/faq.php" style="color:#26609E;text-decoration:none;">Frequently Asked Questions</a> page.</td></tr>
		
		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">Thank you for choosing <strong>RePreApproval</strong>.</td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">We wish you great success.</td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">The Team at <strong>RePreApproval</strong></td></tr>
		
		<tr><td colspan="2">&nbsp;</td></tr>
		
		<tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply go to the <a href="http://www.repreapproval.com/login.php" style="color:#26609E;text-decoration:none;"> Login Page</a>.</td></tr>

		<tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>
		
		</table>';
		
//		$headers  = 'MIME-Version: 1.0' . "\r\n";
//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//		$headers .= 'From: '.$from. "\r\n";
//		mail($to, $subject, $mess, $headers);
        $mailgun = new RPAMailGun();
        if($mailgun->mail($to, $subject, $mess, array('receipt'))) {

        }
//mail payment info finish	
$date=strtotime(date('Y-m-d', strtotime("+30 days")));
$pro=$_REQUEST['x_trans_id'];
$initialpayment=$_REQUEST['x_amount'];
$Discount=$_SESSION['Discount'];
$tty= time();

 if($_SESSION['first_name']!='' and $_SESSION['phone']!='' and $_SESSION['user_email']!='' and $_SESSION['pass1']!='' and $_SESSION['zip']!='')
  {

	$inser= mysql_query("insert into userthree (`firstname`, `lastname`, `companyname`, `phone`, `email`,`password`, `accounttype`, `street`, `suite`, `city`, `state`, `zip`, `comment`, `createdby`, `created`,license,DRE,plan) values ('".$_SESSION['first_name']."', '".$_SESSION['last_name']."', '".$_SESSION['company']."', '".$_SESSION['phone']."', '".$_SESSION['user_email']."','".$_SESSION['pass1']."', 'LENDER', '".$_SESSION['streetaddress']."', '".$_SESSION['suite']."', '".$_SESSION['city']."', '".$_SESSION['state']."', '".$_SESSION['zip']."', '".$_SESSION['comment']."', '', '".$tty."','".$_SESSION['nmls']."','".$_SESSION['dre']."','".$_SESSION['plan']."')");
	
  }
  
 if($inser)// send welcome message
   {
		$LanderId=mysql_insert_id();
		$selec= mysql_fetch_assoc(mysql_query("select * from userthree where id = '".$LanderId."'"));
		$_SESSION['logge']=$selec;
		$insert=mysql_query("insert into companyinvoices ( profile_id, lender_id, date_billing,amount, discount, exp_date, status )values('".$pro."','".$LanderId."','".$tty."','".$initialpayment."','".$_SESSION['Discount']."','".$date."','p')");
		   
		$subject= "Welcome to RePreApproval - You have successfully registered";
		$to= $_SESSION['user_email'];
		$from= "admin@repreapproval.com";
		
		$mess= '<table width="550px">

		<tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px" /></td></tr>
		
		<tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr>

		<tr><td colspan="2" style="color:#000;">Congratulations! You have successfully registered with <strong>RePreApproval</strong>.</td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>
	
		<tr><td><strong style="color:#000;">Username</strong></td><td><strong style="color:#045D92;">'.$_SESSION['user_email'].'</strong></td></tr>
		
		<tr><td><strong style="color:#000;">Password</strong></td><td><strong style="color:#045D92;">'.$_SESSION['pass1'].'</strong></td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">Please keep your login information in a secured location.</td></tr>
		
		<tr><td colspan="2">&nbsp;</td></tr>

        <tr><td colspan="2">If you require additional assistance, do not hesitate to email us or visit our <a href="http://www.repreapproval.com/faq.php">Frequently Asked Questions</a> page.</td></tr>
		
		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">Thank you for choosing <strong>RePreApproval</strong>.</td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">We wish you great success.</td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>

		<tr><td colspan="2">The Team at <strong>RePreApproval</strong></td></tr>
		
		<tr><td colspan="2">&nbsp;</td></tr>
		
		<tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply click on this <a href="http://www.repreapproval.com/login.php">link</a>.</td></tr>

		<tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr>

		<tr><td colspan="2">&nbsp;</td></tr>
		
		</table>';
		
//		$headers  = 'MIME-Version: 1.0' . "\r\n";
//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//		$headers .= 'From: '.$from. "\r\n";
//		if(mail($to, $subject, $mess, $headers))
//		{
//		 $_SESSION['first_name']='';
//		 $_SESSION['last_name']='';
//		 $_SESSION['company']='';
//		 $_SESSION['phone']='';
//		 $_SESSION['user_email']='';
//		 $_SESSION['plan']='';
//		 $_SESSION['nmls']='';
//		 $_SESSION['dre']='';
//		 $_SESSION['Discount']='';
//		// $_SESSION['user_login']='';
//		 $_SESSION['pass1']='';
//
//		 $_SESSION['streetaddress']='';
//		 $_SESSION['suite']='';
//		 $_SESSION['city']='';
//		 $_SESSION['state']='';
//		 $_SESSION['zip']='';
//		 $_SESSION['comment']='';
//		}
         $mailgun = new RPAMailGun();
         if($mailgun->mail($to, $subject, $mess, array('receipt', 'welcome'))) {
             //		 $_SESSION['first_name']='';
		 $_SESSION['last_name']='';
		 $_SESSION['company']='';
		 $_SESSION['phone']='';
		 $_SESSION['user_email']='';
		 $_SESSION['plan']='';
		 $_SESSION['nmls']='';
		 $_SESSION['dre']='';
		 $_SESSION['Discount']='';
		// $_SESSION['user_login']='';
		 $_SESSION['pass1']='';

		 $_SESSION['streetaddress']='';
		 $_SESSION['suite']='';
		 $_SESSION['city']='';
		 $_SESSION['state']='';
		 $_SESSION['zip']='';
		 $_SESSION['comment']='';
         }
	  }
 
 header('location:lenderdashboard.php?tab=profile');	
	}
}
else
{
	?>
    <div align="center">
    
<h2> <?php echo $_REQUEST['x_response_reason_text'].' due to the following reason'; ?></h2>
<h3> <?php echo $_REQUEST['Bank_Message']; ?></h3>
<h3><?php echo $_REQUEST['EXact_Message'];?></h3>
<a href="signup.php" class="btn btn-primary">Try Again</a>
<?php
$_SESSION['membership']='';
$_SESSION['Discount']='';
$_SESSION['user_email']='';
?>

</div>
<?php
}
 ?>
<div class="space60"></div>
<footer class="footer">
<?php
include("includes/topfooter.php");
include("includes/footer.php");
?>
</footer>
<?php include("includes/javascript.php"); ?>
</body>
</html>