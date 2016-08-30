<?

require '../vendor/autoload.php';
include("admin/config.php");
include('mailgun/RPAMailGun.php');

if(isset($_REQUEST['Plan']))
{
$_SESSION['plan']=$_REQUEST['Plan'];
}
$selec= mysql_fetch_assoc(mysql_query("select * from userthree where email = '".$_SESSION['user_email']."'"));
if(isset($selec['id']) and $selec['id']!='')
 {
  header("location:index.php");
 }


if(isset($_REQUEST['cancel']) and $_REQUEST['cancel']==1)
{
	    $_SESSION['first_name']='';
		$_SESSION['last_name']='';
		$_SESSION['company']='';
		$_SESSION['phone']='';
		$_SESSION['user_email']='';
		$_SESSION['nmls']='';
		$_SESSION['dre']='';
		//$_SESSION['user_login']='';
		$_SESSION['pass1']='';
		$_SESSION['plan']='';
		$_SESSION['streetaddress']='';
		$_SESSION['suite']='';
		$_SESSION['city']='';
		$_SESSION['state']='';
		$_SESSION['zip']='';
		$_SESSION['comment']='';
		header('location:index.php');
}
$environment = 'sandbox';   // or 'beta-sandbox' or 'live'
$ROOT_URL = 'http://www.repreapproval.com/';

/**
 * Send HTTP POST Request
 *
 * @param   string  The API method name
 * @param   string  The POST Message fields in &name=value pair format
 * @return  array   Parsed HTTP Response body
 */
function PPHttpPost($methodName_, $nvpStr_) {

    global $environment;
    $API_UserName = urlencode('tripathiveerendra87-facilitator_api1.gmail.com');
    $API_Password = urlencode('1389298749');
    $API_Signature = urlencode('AFcWxV21C7fd0v3bYYYRCpSSRl31AHkvFVWd5xc9qVPPk21Y917LbVyD');
    $API_Endpoint = "https://api-3t.paypal.com/nvp";
    if("sandbox" === $environment || "beta-sandbox" === $environment) {
        $API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
    }
    $version = urlencode('51.0');

    // setting the curl parameters.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);

    // turning off the server and peer verification(TrustManager Concept).
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    // NVPRequest for submitting to server
    $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

    // setting the nvpreq as POST FIELD to curl
    curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

    // getting response from server
    $httpResponse = curl_exec($ch);

    if(!$httpResponse) {
        exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
    }

    // Extract the RefundTransaction response details
    $httpResponseAr = explode("&", $httpResponse);

    $httpParsedResponseAr = array();
    foreach ($httpResponseAr as $i => $value) {
        $tmpAr = explode("=", $value);
        if(sizeof($tmpAr) > 1) {
            $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
        }
    }

    if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
        exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
    }

    return $httpParsedResponseAr;
}

$amount=$_REQUEST['amount'];
 $initialpayment = urlencode($amount);
 $paymentAmount = urlencode($amount);  
if(!isset($_REQUEST['token'])){ 

     // Set request-specific fields.
$autobillamt=urlencode("AddToNextBilling");
$billingType = urlencode("RecurringPayments");; 
$bilingdesc=urlencode("This is the membership charge you have to pay $".$initialpayment."instantly and every month");
$currencyID = urlencode('USD');                         // or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
 // $paymentType = urlencode('Sale');              // or 'Sale' or 'Order'
$returnURL = urlencode($ROOT_URL.'create-recuringprofile.php?return=1&amount='.$amount);
 $cancelURL = urlencode($ROOT_URL.'create-recuringprofile.php?cancel=1');
$ipnURL = urlencode($ROOT_URL.'ipn.php');
$contry=urlencode("IN");
    // Add request-specific fields to the request string.
    $nvpStr = "&IpnUrl=$ipnURL&Amt=$paymentAmount&ReturnUrl=$returnURL&CANCELURL=$cancelURL&PAYMENTACTION=$paymentType&CURRENCYCODE=$currencyID&BILLINGAGREEMENTDESCRIPTION=$bilingdesc&NOSHIPPING=1&BILLINGTYPE=$billingType&COUNTRY=$contry&AUTOBILLOUTAMT=$autobillamt";

    // Execute the API operation; see the PPHttpPost function above.
    $httpParsedResponseAr = PPHttpPost('SetExpressCheckout', $nvpStr);

   // print_r($httpParsedResponseAr);

    if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
        // Redirect to paypal.com.
        $token = urldecode($httpParsedResponseAr["TOKEN"]);
        $payPalURL = "https://www.paypal.com/webscr&cmd=_express-checkout&token=$token";
        if("sandbox" === $environment || "beta-sandbox" === $environment) {
          $payPalURL = "https://www.$environment.paypal.com/webscr&cmd=_express-checkout&token=$token";
        }

        header("Location:$payPalURL");
        //echo '<a href="'.$payPalURL.'">PayPal</a>';
        //exit;
    } else  {
       exit('SetExpressCheckout failed: ' . print_r($httpParsedResponseAr, true));
    }
}else{
$token =urlencode( $_REQUEST['token']);
$paymentAmount =urlencode ($initialpayment);
$paymentType = urlencode('Sale');
$currCodeType = urlencode('USD');
$payerID = urlencode($_REQUEST['PayerID']);
$ipnURL = urlencode($ROOT_URL.'ipn.php');
$nvpstr='&TOKEN='.$token.'&PAYERID='.$payerID.'&PAYMENTACTION='.$paymentType.'&AMT='.$paymentAmount.'&CURRENCYCODE='.$currCodeType.'&IPNURL='.$ipnURL;
$resArray=PPHttpPost("DoExpressCheckoutPayment",$nvpstr);
if("SUCCESS" == strtoupper($resArray["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($resArray["ACK"]))
{
    //Now create recurring profile
    ?>
    <h1>Yes!</h1>
    <?
$autobillamt=urlencode("AddToNextBilling");
$billingType = urlencode("RecurringPayments");; 
$bilingdesc=urlencode("This is the membership charge you have to pay $".$initialpayment."instantly and every month"); 
$currencyID = urlencode("USD");
$date=strtotime(date('Y-m-d', strtotime("+30 days")));                     // or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
$startDate = urlencode(date('Y-m-d', strtotime("+30 days")).'T0:0:0');
$billingPeriod = urlencode("Month");                // or "Day", "Week", "SemiMonth", "Year"
$billingFreq = urlencode("1"); 
$ipnURL = urlencode($ROOT_URL.'ipn.php');                     // combination of this and billingPeriod must be at most a year
$contry=urlencode("IN");
 $nvpStr="&IpnUrl=$ipnURL&TOKEN=$token&AMT=$paymentAmount&CURRENCYCODE=$currencyID&PROFILESTARTDATE=$startDate&L_BILLINGAGREEMENTDESCRIPTION0=$bilingdesc&L_PAYMENTTYPE0=$billingType&AUTOBILLOUTAMT=$autobillamt&DESC=$bilingdesc&COUNTRY=$contry".'<br/>';
 $nvpStr .="&BILLINGPERIOD=$billingPeriod&BILLINGFREQUENCY=$billingFreq";

$httpParsedResponseAr = PPHttpPost('CreateRecurringPaymentsProfile', $nvpStr);

if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
	//print_r($httpParsedResponseAr);die;
	
$date=strtotime(date('Y-m-d', strtotime("+30 days")));
$pro=substr_replace($httpParsedResponseAr['PROFILEID'],'-',1,3);
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
		$insert=mysql_query("insert into companyinvoices(profile_id,lender_id,date_billing,amount,exp_date,status)values('".$pro."','".$LanderId."','".$tty."','".$initialpayment."','".$date."','p')");
		   
		$subject= "Welcome to RePreApproval - You have successfully registered";
		$to= $_SESSION['user_email'];
		$from= "admin@repreapproval.com";
		
		$mess= '<table width="550px">

		<tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style=""width:340px" /></td></tr>
		
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
//		$_SESSION['dre']='';
//
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
         if($mailgun->mail($to, $subject, $mess, array('register','recurring'))) {
             $_SESSION['first_name']='';
             $_SESSION['last_name']='';
             $_SESSION['company']='';
             $_SESSION['phone']='';
             $_SESSION['user_email']='';
             $_SESSION['plan']='';
             $_SESSION['nmls']='';
             $_SESSION['dre']='';

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
 //exit('CreateRecurringPaymentsProfile Completed Successfully: '.print_r($httpParsedResponseAr, true));
}
else
{
 exit('CreateRecurringPaymentsProfile failed: ' . print_r($httpParsedResponseAr, true));
}
}}
?>