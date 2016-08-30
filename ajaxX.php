<?php
require '../vendor/autoload.php';
include("admin/config.php");
include('mailgun/RPAMailGun.php');

if(isset($_REQUEST['mai']) and $_REQUEST['mai']!='')
 {
   $selec= mysql_fetch_assoc(mysql_query("select * from userthree where email='".$_REQUEST['mai']."'"));
   if(isset($selec['id']) and $selec['id']!='')
    {
	  echo 'wrong'; exit;
	}
   else
    {
	  echo 'alright'; exit;
    }
 }

elseif(isset($_REQUEST['matchmai']) and $_REQUEST['matchmai']!='')
 {
   $selec= mysql_fetch_assoc(mysql_query("select * from userthree where email='".$_REQUEST['matchmai']."'"));
   if(isset($selec['id']) and $selec['id']!='')
    {
	  if($selec['accounttype']=='REALTOR')// if it is realtor
	   {
		 echo 'matchfound_@_'.$selec['firstname'].'_@_'.$selec['DRE'].'_@_'.$selec['lastname'].'_@_'.$selec['companyname'].'_@_'.$selec['license'].'_@_'.$selec['phone'].'_@_'.$selec['street'].'_@_'.$selec['suite'].'_@_'.$selec['city'].'_@_'.$selec['state'].'_@_'.$selec['zip']; exit;
	   }
	  else
	   {
		 echo 'wrong'; exit;
	   }
	}
   else
    {
	  echo 'alright'; exit;
    }
 }

elseif(isset($_REQUEST['matcBRE']) and $_REQUEST['matcBRE']!='')
 {
   $selec= mysql_fetch_assoc(mysql_query("select * from userthree where `DRE`='".$_REQUEST['matcBRE']."'"));
   if(isset($selec['id']) and $selec['id']!='')
    {
	  if($selec['accounttype']=='REALTOR')// if it is realtor
	   {
		 echo 'matchfound_@_'.$selec['firstname'].'_@_'.$selec['DRE'].'_@_'.$selec['lastname'].'_@_'.$selec['companyname'].'_@_'.$selec['license'].'_@_'.$selec['phone'].'_@_'.$selec['street'].'_@_'.$selec['suite'].'_@_'.$selec['city'].'_@_'.$selec['state'].'_@_'.$selec['zip'].'_@_'.$selec['email']; exit;
	   }
	  else
	   {
		 echo 'wrong'; exit;
	   }
	}
   else
    {
	  echo 'alright'; exit;
    }
 }

elseif(isset($_REQUEST['action']) and $_REQUEST['action']=='adddays')
 {
   $date = $_REQUEST['de'];
   $date = strtotime($date);
   $date = strtotime("+90 day", $date);
   echo date('m/d/Y', $date);
 }

elseif(isset($_REQUEST['lett_id']) and $_REQUEST['lett_id']!='' and isset($_REQUEST['stam']) and $_REQUEST['stam']!='' and isset($_REQUEST['oto']) and $_REQUEST['oto']!='') // send expert letter
 {
   $nam= $_REQUEST['lett_id'].'RePre'.$_REQUEST['stam'].'.pdf';
   $bhfv= mysql_fetch_assoc(mysql_query("select * from `letters` where id='".$_REQUEST['lett_id']."' and created= '".$_REQUEST['stam']."'"));
   if(!$bhfv)
    {
	  echo 'Bad_Request'; exit;
	}
   $otherbuyre= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$bhfv['buyer_id']."'"));// this is home-buyer
   $realtrAA= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$otherbuyre['createdby']."'"));// it is realtor who is related to this home-buyer
   //$LendraA= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$realtrAA['createdby']."'"));// this will be lender
   $LendraA= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$otherbuyre['lender_of_buyer']."'"));// this will be lender
   $subject= "RePreApproval Letter Notification";
   if($_REQUEST['oto']=='Lender')
    {
	  $to= $LendraA['email'];
	}
   if($_REQUEST['oto']=='Realtor')
    {
	  $to= $realtrAA['email'];
	}
   if($_REQUEST['oto']=='Buyer')
    {
	  $to= $otherbuyre['email'];
	}
   if($_REQUEST['oto']=='All')
    {
	  $to= $LendraA['email'].', '.$realtrAA['email'].', '.$otherbuyre['email'];
	}
   $from= "admin@repreapproval.com";
   $ccs= explode('@=@', $otherbuyre['otherbuyer']);
   $nnc= '';
   if($otherbuyre['lastname']!='')
    {
	  $nnc= ' '.$otherbuyre['lastname'];
	}
   $funnn= $otherbuyre['firstname'].$nnc;
   $ccs[]= $funnn;
   $ccs= array_reverse($ccs);
   
   foreach($ccs as $vgsp=>$zodsi)
    {
	 if($zodsi=='' or $zodsi==' ' or $zodsi==NULL)
	  {
		unset($ccs[$vgsp]);
	  }
	}
   
   $ccd= implode(', ', $ccs);
   
   $mess= '<table width="550px"><tr><td style="background-color:#93CE52">
<img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px" /></td></tr>
<tr><td style="background-color:#045D92;height:10px"></td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td>We are pleased to inform you that you have been issued a pre-approval letter by your lender.
You can view your letter by clicking on link given below.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>The Team at <strong>RePreApproval</strong>.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;"> 
<a href="http://www.repreapproval.com/login.php">
<strong style="color:#000;">Click here to login to Repreapproval.</strong></a></td></tr>

<tr><td style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;"> 
<a href="http://www.repreapproval.com/file_download.php?file_name=certificates/'.$nam.'">
<strong style="color:#000;">Click here to open your pre-approved letter in a PDF format.</strong></a></td></tr>

<tr><td style="background-color:#045D92;height:2px"></td></tr><tr><td>&nbsp;</td></tr></table>';

     $mailgun = new RPAMailGun();
     if($mailgun->mail($to, $subject, $mess, array('issued'))) {
         header('location:conve/examples/about.php?lett_id='.$_REQUEST['lett_id'].'&stam='.$_REQUEST['stam'].'');
         exit;
     }

//   $headers  = 'MIME-Version: 1.0' . "\r\n";
//   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//   $headers .= 'From: '.$from. "\r\n";
//   if(mail($to, $subject, $mess, $headers))
//    {
//	  //echo 'sent';
//	  header('location:conve/examples/about.php?lett_id='.$_REQUEST['lett_id'].'&stam='.$_REQUEST['stam'].'');
//	  exit;
//	}
   
 }

elseif(isset($_REQUEST['BASlett_id']) and $_REQUEST['BASlett_id']!='' and isset($_REQUEST['BASstam']) and $_REQUEST['BASstam']!='' and isset($_REQUEST['oto']) and $_REQUEST['oto']!='')// send basic letter
 {
   $nam= $_REQUEST['BASlett_id'].'RePre_BAS'.$_REQUEST['BASstam'].'.pdf';
   $bhfv= mysql_fetch_assoc(mysql_query("select * from `letters` where id='".$_REQUEST['BASlett_id']."' and created= '".$_REQUEST['BASstam']."'"));
   if(!$bhfv)
    {
	  echo 'Bad_Request'; exit;
	}
   $otherbuyre= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$bhfv['buyer_id']."'"));// this is home buyer
   $realtrAA= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$otherbuyre['createdby']."'"));// it is realtor who is related to this home-buyer
   //$otherbuyre['lender_of_buyer'] lender of a home buyer
   //$LendraA= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$realtrAA['createdby']."'"));// this will be lender
   $LendraA= mysql_fetch_assoc(mysql_query("select * from `userthree` where id='".$otherbuyre['lender_of_buyer']."'"));// this will be lender
   $subject= "RePreApproval Letter Notification";
   if($_REQUEST['oto']=='Lender')
    {
	  $to= $LendraA['email'];
	}
   if($_REQUEST['oto']=='Realtor')
    {
	  $to= $realtrAA['email'];
	}
   if($_REQUEST['oto']=='Buyer')
    {
	  $to= $otherbuyre['email'];
	}
   if($_REQUEST['oto']=='All')
    {
	  $to= $LendraA['email'].', '.$realtrAA['email'].', '.$otherbuyre['email'];
	}
   
   $ccs= explode('@=@', $otherbuyre['otherbuyer']);
   $nnc= '';
   if($otherbuyre['lastname']!='')
    {
	  $nnc= ' '.$otherbuyre['lastname'];
	}
   $funnn= $otherbuyre['firstname'].$nnc;
   $ccs[]= $funnn;
   $ccs= array_reverse($ccs);
   foreach($ccs as $vgsp=>$zodsi)
    {
	 if($zodsi=='' or $zodsi==' ' or $zodsi==NULL)
	  {
		unset($ccs[$vgsp]);
	  }
	}
   $ccd= implode(', ', $ccs);
   
   $from= "admin@repreapproval.com";
   $mess= '<table width="550px"><tr><td style="background-color:#93CE52">
<img src="http://www.repreapproval.com/images/logo2.png" width="340px" style="width:340px" /></td></tr>
<tr><td style="background-color:#045D92;height:10px"></td></tr>
<tr><td>&nbsp;</td></tr>

<tr><td>We are pleased to inform you that you have been issued a pre-approval letter by your lender. You can view your letter by clicking on link given below.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>We wish great success with your home purchase.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>The Team at <strong>RePreApproval</strong>.</td></tr><tr><td>&nbsp;</td></tr>

<tr><td style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;"> 
<a href="http://www.repreapproval.com/login.php">
<strong style="color:#000;">Click here to login to Repreapproval.</strong>
</a></td></tr>

<tr><td style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;"> 
<a href="http://www.repreapproval.com/file_download.php?file_name=certificates/'.$nam.'">
<strong style="color:#000;">Click here to open your pre-approved letter in a PDF format.</strong>
</a></td></tr><tr><td style="background-color:#045D92;height:2px"></td></tr><tr><td>&nbsp;</td></tr></table>';
   
   header("location:file_download.php?file_name=certificates/".$rt.".pdf");

     $mailgun = new RPAMailGun();
     if($mailgun->mail($to, $subject, $mess, array('issued'))) {
         header('location:conve/examples/aboutbasic.php?BASlett_id='.$_REQUEST['BASlett_id'].'&BASstam='.$_REQUEST['BASstam'].'');
         exit;
     }

//   $headers  = 'MIME-Version: 1.0' . "\r\n";
//   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//   $headers .= 'From: '.$from. "\r\n";
//   if(mail($to, $subject, $mess, $headers))
//    {
//	  //echo 'sent';
//	  header('location:conve/examples/aboutbasic.php?BASlett_id='.$_REQUEST['BASlett_id'].'&BASstam='.$_REQUEST['BASstam'].'');
//	  exit;
//	}
 }
?>