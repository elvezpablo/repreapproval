<?php 
ob_start();
$tr= implode(",", $_REQUEST['daa']);
echo $tr;
echo "<pre>";print_r($_REQUEST);die;
$subject="Live Demo Request from Dogoodpins Website";
/*$to="vikassist@gmail.com";*/
$to=$tr;
$bcc="vikassist@gmail.com";
$from="dogoodpins";
$mess.='
<table width="650" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #ccc;padding-bottom:20px; margin:10px auto;">
<tr><td valign="top" align="left" style="padding:10px;border-bottom:0px solid #ccc;line-height:20px;background:#ccc;"><img src="http://www.dogoodpins.com/images/logo.png" width="224" /></td></tr>
<tr>
<td valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">        
<tr><td valign="top" style="padding:1px 0;">&nbsp;</td></tr>
<tr><td style="font-size:15px;font-weight:bold;padding-bottom:0px;background:#1298EA;color:#fff;padding:10px;">You have received a new Subscription Letter from the Dogoodpins website.</td></tr>
<tr>
<td>
<table width="100%" border="0" cellspacing="5" cellpadding="0" align="center" style="margin:2px auto;line-height:20px;background:#F0F0F0;"></td>
</tr>
<tr><td valign="top" align="left" style="padding:3px 10px; background:#2D98EA;"></td></tr>
<h2>hello freind</h2>
</table></td>
</tr>
</table>';
$mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
 $headers = "From: $from\r\n" .
 "Bcc: $bcc\r\n".
         "MIME-Version: 1.0\r\n" .
         "Content-Type: multipart/mixed;\r\n" .
         " boundary=\"{$mime_boundary}\"";
      $mess .= "This is a multi-part message in MIME format.\n\n" .
         "--{$mime_boundary}\n" .
         "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
         "Content-Transfer-Encoding: 7bit\n\n" .
         $mess . "\n\n";
         "--{$mime_boundary}--\n";	
 if(mail($to, $subject, $mess, $headers)){
		 echo 50;
		header("location:thank-contactus.php");
		 }
?>