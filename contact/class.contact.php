<?php

if($MODE == 'DEV') {
  require '../vendor/autoload.php';
  include('mailgun/RPAMailGun.php');

} else {
  if (isset($_REQUEST['submit'])) {
      //$to="info@santarosawebsite.com";
      $to = "prangel@gmail.com";
      //$to= 'prangel@gmail.com';
      $subject = "Inquiry from RePreApproval";
      $mailgun = new RPAMailGun();

      $from = "admin@repreapproval.com";
      $mess = '<table width="650" border="0" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #ccc;padding-bottom:20px; margin:10px auto;"><tr>
  <td valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr><td valign="top" style="padding:1px 0;">&nbsp;</td></tr>
  <tr><td style="font-size:15px;font-weight:bold;padding-bottom:0px;background:#045D92;color:#fff;padding:10px;">You have received a new enquiry from the website RePreApproval.</td></tr>
  <tr><td><table width="100%" border="0" cellspacing="5" cellpadding="0" align="center" style="margin:2px auto;line-height:20px;background:#F0F0F0;">
  <tr><td style="padding-left:10px;" width="150"><strong style="color:#000;">Name</strong></td>
  <td>:</td><td style="color:#045D92">' . stripslashes($_REQUEST['contact_name']) . '</td></tr>

  <tr><td style="padding-left:10px;"><strong style="color:#000;">Email</strong></td>
  <td>:</td><td style="color:#045D92">' . stripslashes($_REQUEST['contact_email']) . '</td></tr>
  <tr><td style="padding-left:10px;"><strong style="color:#000;">Phone</strong></td>
  <td>:</td><td style="color:#045D92">' . stripslashes($_REQUEST['contact_phone']) . '</td></tr>

  <tr><td style="padding-left:10px;"><strong style="color:#000;">Subject</strong></td>
  <td>:</td><td style="color:#045D92">' . stripslashes($_REQUEST['contact_subject']) . '</td></tr>

  <tr><td style="padding-left:10px;"><strong style="color:#000;"> Message</strong></td><td>:</td>
  <td style="color:#045D92">' . stripslashes($_REQUEST['contact_message']) . '</td></tr></table></td></tr>
  <tr></tr>

  <tr><td valign="top" align="left" style="padding:2px 10px; background:#045D92;color:#fff"></td></tr>
  </table></td></tr></table>';

      if($mailgun->mail($to, $subject, $mess, array('contact'))) {
          header("location:thankyou.php");
      }
  }
}




?>
