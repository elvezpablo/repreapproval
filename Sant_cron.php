<?php

require '../vendor/autoload.php';
include("admin/config.php");
include('mailgun/RPAMailGun.php');

$membersA= array();
$selec= mysql_query("select `id`, `firstname`, `lastname`, `email`, `createdby` from `userthree` where `accounttype`!='LENDER'");
while($vvz= mysql_fetch_assoc($selec))
 {
   $bhxx= '';
   if($vvz['lastname']!='')
    {
	  $bhxx= ' '.$vvz['lastname'];
	}
   $membersA[$vvz['id']]['name']= $vvz['firstname'].$bhxx;
   $membersA[$vvz['id']]['email']= $vvz['email'];
 }

$LettA= array();
$e=0;
$seLAT= mysql_query("select `id`, `letter_sender`, `buyer_id`, `generation_date`, `expiry_date` from `letters` where buyer_view='SHOW'");
while($ters= mysql_fetch_assoc($seLAT))
 {
   $LettA[$e]['name_FROM']= $membersA[$ters['letter_sender']]['name'];
   $LettA[$e]['name_TO']= $membersA[$ters['buyer_id']]['name'];
   $LettA[$e]['EXPIRES_DATE']= date('m/d/y', $ters['expiry_date']);
   $LettA[$e]['mail_of_TO']= $membersA[$ters['buyer_id']]['email'];
   $LettA[$e]['mail_of_FROM']= $membersA[$ters['letter_sender']]['email'];
   
   
   $LettA[$e]['id']= $ters['id'];
   $LettA[$e]['letter_sender']= $ters['letter_sender'];
   $LettA[$e]['buyer_id']= $ters['buyer_id'];
   $LettA[$e]['generation_date']= $ters['generation_date'];
   $LettA[$e]['expiry_date']= $ters['expiry_date'];
   $e++;
 }
////////////////////////

$min1 = 0;
$mx1 = 1*24*60*60;

$min30 = 29*24*60*60;
$mx30 = 30*24*60*60;

$min60 = 59*24*60*60;
$mx60 = 60*24*60*60;
$tdy= time();
foreach($LettA as $njc=>$kds)
 {
   $mais=array();
   if($kds['mail_of_TO']!='')
	{
	 $mais[]= $kds['mail_of_TO'];
	}
   if($kds['mail_of_FROM']!='')
	{
	 $mais[]= $kds['mail_of_FROM'];
	}
   $realto= '';
   if(count($mais)>0)
    {
	  $realto= implode(', ', $mais);
	}
   
   $rem= $kds['expiry_date']-$tdy; // expire hone me bacha huaa time
   $sent= '';
   if($rem>=$min1 and $rem<$mx1)// 90check// letter is expiring in one day
    {
	  $dterd= mysql_query("update `letters` set `buyer_view`= 'HIDE' where id= '".$kds['id']."'"); // to hide letter from realtor and homebuyer
	  
	  $subject= "RePreApproval – Notice of Expiration";
	  $to= $realto;
	  $from= "info@repreapproval.com";
	  
	  $uhs= array();
	  $uhs[]= $kds['name_TO'];
	  $uhs[]= $kds['name_FROM'];
	  $bhs= implode(', ', $uhs);
	  
	$mess= '<table width="550px"><tr><td style="background-color:#93CE52">
	<img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px" /></td></tr>
	<tr><td style="background-color:#045D92;height:10px"></td></tr><tr><td>&nbsp;</td></tr>
	
	<tr><td>'.date("m/d/y", $tdy).'</td></tr>
	
    <tr><td>&nbsp;</td></tr>
    
	<tr><td>Dear '.$bhs.'</td></tr>
	
    <tr><td>&nbsp;</td></tr>
    
	<tr><td>Thank you for being a valued client and member of <a href="http://www.repreapproval.com">www.RePreApproval.com</a>!</td></tr>
	
	<tr><td>This letter serves as a notice that the terms outlined in your pre-approval letter have recently expired.</td></tr>
	
    <tr><td>&nbsp;</td></tr>
	
    <tr><td>In order to continue assisting you with your pre-approval letter(s), we will need updated information. Please contact your <a href="http://www.repreapproval.com">www.RePreApproval.com</a> representative today for assistance with creating a new 90-Day-Approval letter.</td></tr>
	
    <tr><td>&nbsp;</td></tr>
    
	<tr><td>Thank you from the Team at <strong>RePreApproval</strong>.</td></tr><tr><td style="background-color:#045D92;height:2px"></td></tr></table>';
	  
//	  $headers  = 'MIME-Version: 1.0' . "\r\n";
//	  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//	  $headers .= 'From: '.$from. "\r\n";
	  
	  if($to!='')
	   {
//		 mail($to, $subject, $mess, $headers);
           $mailgun = new RPAMailGun();
           if($mailgun->mail($to, $subject, $mess, array('expiration','0'))) {

           }
	   }
	  $sent= 'YES';
	}
   elseif($rem>=$min30 and $rem<$mx30)// 60check // letter is expiring in 30 days
    {
	  $subject= "Quick update from RePreApproval – 60 Day Notification";
	  $to= $realto;
	  $from= "info@repreapproval.com";
	  $ff= $tdy+$min30;
	  
	  $uhs= array();
	  $uhs[]= $kds['name_TO'];
	  $uhs[]= $kds['name_FROM'];
	  $bhs= implode(', ', $uhs);
	  
	$mess= '<table width="550px"><tr><td style="background-color:#93CE52">
	<img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px" /></td></tr>
	<tr><td style="background-color:#045D92;height:10px"></td></tr><tr><td>&nbsp;</td></tr>
	
	<tr><td>'.date("m/d/y", $tdy).'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Dear '.$bhs.'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Thank you for being a valued client and member of <a href="http://www.repreapproval.com">www.RePreApproval.com</a>! In order to maintain the accuracy of your pre approval letter, the team at <a href="http://www.repreapproval.com">www.RePreApproval.com</a> is checking in with you to see if there has been any change in circumstance with your application. If nothing has changed, please disregard this email and thank you for your continued business. If there are changes, or if you have new documentation to provide, please contact your <a href="http://www.repreapproval.com">www.RePreApproval.com</a> representative as soon as possible.</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>The terms outlined in your current pre approval letter will remain in effect until '.date("m/d/y", $ff).' unless we are contacted with renewal information before then.</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>The Team at <strong>RePreApproval</strong>.</td></tr><tr><td style="background-color:#045D92;height:2px"></td></tr></table>';
	  
	  
//	  $headers  = 'MIME-Version: 1.0' . "\r\n";
//	  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//	  $headers .= 'From: '.$from. "\r\n";
	  
	  //print_r($mess); exit;
	  
	  if($to!='')
	   {
//		 mail($to, $subject, $mess, $headers);
           $mailgun = new RPAMailGun();
           if($mailgun->mail($to, $subject, $mess, array('expiration','60'))) {

           }
	   }
	  $sent= 'YES';
	}
   elseif($rem>=$min60 and $rem<$mx60)// 30check // letter is expiring in 60 dayz
    {
	  $subject= "Quick update from RePreApproval – 30 Day Notification";
	  $to= $realto;
	  $from= "info@repreapproval.com";
	  
	  $ff= $tdy+$min60;
	  
	  $uhs= array();
	  $uhs[]= $kds['name_TO'];
	  $uhs[]= $kds['name_FROM'];
	  $bhs= implode(', ', $uhs);
	  
	  
	$mess= '<table width="550px"><tr><td style="background-color:#93CE52">
	<img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px" /></td></tr>
	<tr><td style="background-color:#045D92;height:10px"></td></tr><tr><td>&nbsp;</td></tr>
	
	<tr><td>'.date("m/d/y", $tdy).'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Dear '.$bhs.'</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Thank you for being a valued client and member of <a href="http://www.repreapproval.com">www.RePreApproval.com</a>! In order to maintain the accuracy of your pre approval letter, the team at <a href="http://www.repreapproval.com">www.RePreApproval.com</a> is checking in with you to see if there has been any change in circumstance with your application. If nothing has changed, please disregard this email and thank you for your continued business. If there are changes, or if you have new documentation to provide, please contact your <a href="http://www.repreapproval.com">www.RePreApproval.com</a> representative as soon as possible.</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>The terms outlined in your current pre approval letter will remain in effect until '.date("m/d/y", $ff).' unless we are contacted with renewal information before then.</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>The Team at <strong>RePreApproval</strong>.</td></tr><tr><td style="background-color:#045D92;height:2px"></td></tr></table>';
	  
//	  $headers  = 'MIME-Version: 1.0' . "\r\n";
//	  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//	  $headers .= 'From: '.$from. "\r\n";
	  
	  //print_r($mess); exit;
	  
	  if($to!='')
	   {
//		 mail($to, $subject, $mess, $headers);
          $mailgun = new RPAMailGun();
          if($mailgun->mail($to, $subject, $mess, array('expiration','30'))) {

          }
	   }
	  $sent= 'YES';
	}
   
   if($sent=='YES')
    {
	  unset($to);
	  unset($subject);
	  unset($mess);
	  unset($headers);
	  unset($from);
	}
 }