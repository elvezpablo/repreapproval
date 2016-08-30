<?php include("admin/config.php");
if(!$_SESSION['REAL_VEER'] or !isset($_SESSION['REAL_VEER']['id']))
 {
   header('location:index.php');
 }

if(isset($_REQUEST['HIDDidd']) and $_REQUEST['HIDDidd']!='' and isset($_REQUEST['MHstam']) and $_REQUEST['MHstam']!='')
 {
   $dterd= mysql_query("update `letters` set `buyer_view`= 'HIDE' where id= '".$_REQUEST['HIDDidd']."' and `created`= '".$_REQUEST['MHstam']."'");
   if($dterd)
    {
	  $_SESSION['msg']='dltd';
	}
 }

if(isset($_REQUEST['landsubmit']) and $_REQUEST['landsubmit']=="Edit your profile" and $_REQUEST['real_emailie']!='')
 {
   $alexisa= mysql_fetch_assoc(mysql_query("select id, email from userthree where id!='".$_SESSION['REAL_VEER']['id']."' and ( `email`='".$_REQUEST['real_emailie']."' or `DRE`='".$_REQUEST['dre']."' )"));
   if(isset($alexisa['id']) and $alexisa['id']!='')
    {
	   $_SESSION['msg']='NOT_success';
	}
   else
    {
	   if($_REQUEST['real_emailie']!='' and $_REQUEST['newpas']!='' and $_REQUEST['first_name']!='' and $_REQUEST['company']!='' and $_REQUEST['license']!='' and $_REQUEST['dre']!='' and $_REQUEST['zip']!='' and $_REQUEST['phone']!='')
		{
		  $decline= mysql_query("update `userthree` set `email`='".$_REQUEST['real_emailie']."', `username`='".$_REQUEST['real_emailie']."', `password`= '".$_REQUEST['newpas']."', `firstname`= '".$_REQUEST['first_name']."', `lastname`= '".$_REQUEST['last_name']."', `companyname`= '".$_REQUEST['company']."', `license`='".$_REQUEST['license']."', `DRE`='".$_REQUEST['dre']."', `street`= '".$_REQUEST['streetaddress1']."', `suite`= '".$_REQUEST['suite']."', `city`= '".$_REQUEST['city']."', `state`= '".$_REQUEST['state']."', `zip`= '".$_REQUEST['zip']."', `phone`= '".$_REQUEST['phone']."' where id= '".$_SESSION['REAL_VEER']['id']."'");
		  
		  if($decline)
		   {
			 $_SESSION['REAL_VEER']['email']=$_REQUEST['real_emailie'];
			 $_SESSION['REAL_VEER']['username']=$_REQUEST['real_emailie'];
			 
			 $_SESSION['REAL_VEER']['password']=$_REQUEST['newpas'];
			 $_SESSION['REAL_VEER']['firstname']=$_REQUEST['first_name'];
			 $_SESSION['REAL_VEER']['lastname']=$_REQUEST['last_name'];
			 $_SESSION['REAL_VEER']['companyname']=$_REQUEST['company'];
			 
			 
			 $_SESSION['REAL_VEER']['license']=$_REQUEST['license'];
			 $_SESSION['REAL_VEER']['DRE']=$_REQUEST['dre'];
			 
			 
			 $_SESSION['REAL_VEER']['street']=$_REQUEST['streetaddress1'];
			 $_SESSION['REAL_VEER']['suite']=$_REQUEST['suite'];
			 $_SESSION['REAL_VEER']['city']=$_REQUEST['city'];
			 $_SESSION['REAL_VEER']['state']=$_REQUEST['state'];
			 $_SESSION['REAL_VEER']['zip']=$_REQUEST['zip'];
			 $_SESSION['REAL_VEER']['phone']=$_REQUEST['phone'];
			 $_SESSION['msg']='success';
			 header('location:realtordashboard.php?tab=profile');
		   }
		  
		}
	}
 }

$allbuy=array();
$cdf= mysql_query("select * from userthree where `createdby`= '".$_SESSION['REAL_VEER']['id']."' and `accounttype`= 'HOMEBUYER'");
if($cdf)
 {
   while($ops=mysql_fetch_assoc($cdf))
    {
	  $allbuy[]=$ops['id'];
	}
 }

$mkpp= implode(',', $allbuy);
$ltrs= array();

if(isset($_REQUEST['rtyp']))// if type selection dropdown in selected
 {
   if($_REQUEST['rtyp']=='MAIN')
    {
	  $aacdf= mysql_query("select * from letters where `buyer_view`='SHOW' and `buyer_id` in (".$mkpp.") and `letter_type`= 'MAIN' order by `id` DESC");
	  $sel= 'MAIN';
	}
   else // EDITED
    {
	  $aacdf= mysql_query("select * from letters where `buyer_view`='SHOW' and `buyer_id` in (".$mkpp.") and `letter_type`!= 'MAIN' order by `id` DESC");
	  $sel= 'EDITED';
	}
 }
else
 {
   $sel= 'MAIN';
   $aacdf= mysql_query("select * from letters where `buyer_view`='SHOW' and `buyer_id` in (".$mkpp.") and `letter_type`= 'MAIN' order by `id` DESC");
 }

if($aacdf)
 {
   while($aaops=mysql_fetch_assoc($aacdf))
    {
	  $ltrs[]=$aaops;
	}
 }

///////////for pagination////////////
$likns= '';
if(count($ltrs)>0)
 {
   $itm_pr_pg= 10;
   $total= count($ltrs);
   $total_pages= ceil($total/$itm_pr_pg);
   if(isset($_REQUEST['lpage']))
    {
     $this_pag= $_REQUEST['lpage'];
     $last_pag= $this_pag-1;
     $past= $last_pag*$itm_pr_pg; // (=<$past ko show nhee karna hai)
     $ini= $past+1;
     $Present= $this_pag*$itm_pr_pg; // (begin from $past+1 to $Present)
    }
   else
    {
     $this_pag= 1;
     $last_pag= $this_pag-1;
     $past= $last_pag*$itm_pr_pg; // (=<$past ko show nhee karna hai)
     $ini= $past+1;
     $Present= $this_pag*$itm_pr_pg;
    }
   $middb= array();
   $njv= 1;
   foreach($ltrs as $vgaa=>$vgha)
    {
     if($njv>=$ini and $njv<=$Present)
      {
	   $middb[]= $vgha;
	  }
     $njv++;
    }
   unset($ltrs);
   $ltrs= array();
   $ltrs= $middb;
   //////////////////////// making of pagination links
   for($z=1; $z<=$total_pages; $z++)// begin from 1 to total pages(till =)
    {
	  $clja= '';
	  if($z==$this_pag)
	   {
		 $clja= 'active';
	   }
	  $likns= $likns.'<li class="'.$clja.'"><a href="realtordashboard.php?lpage='.$z.'">Page '.$z.'</a></li>';
	  
	}
 }
////////////////////////////////////



$byrnams= array();
$otherbyye= array();
$bnam= mysql_query("select * from userthree where `id` in (".$mkpp.") or id = '".$_SESSION['REAL_VEER']['createdby']."'");
if($bnam)
 {
   while($vfcd=mysql_fetch_assoc($bnam))
    {
	  $byrnams[$vfcd['id']]=$vfcd['firstname'].' '.$vfcd['lastname'];
	  //====================
	  $gg= '';
	  if($vfcd['otherbuyer']!='')
	   {
		 $fzxpa= explode('@=@', $vfcd['otherbuyer']);
		 $gg= implode(', ', $fzxpa);
	   }
	  $otherbyye[$vfcd['id']]= $gg;
	  //====================
	}
 }

?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Realtor Dashboard on RePreApproval</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php"); ?>
<script type="text/javascript">

var err= 0;

function hidit(id, stam)
 {
   if(confirm("Are you sure you want to delete?")) {
      window.location.href="realtordashboard.php?HIDDidd="+id+"&MHstam="+stam+"";
    }
   else
    {
	  return false;
	}
 }

function checkma(ee)
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
	  var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
	  var valid = emailRegex.test(vv);
	  if(!valid)
	   {
	     $('#'+ee).addClass('error');
		 $("#"+ee).val("");
		 $('#'+ee).attr('placeholder', 'Invalid email');
	     err= 1;
	   }
	  else
	   {
		 $('#'+ee).removeClass('error');
	     err= 0;
	   }
	}
 }

function matchpas()
 {
   var vv= $('#newpas').val();
   var vv2= $('#conpas').val();
   var v33= $('#oldpas').val();
   
   if(v33=='')
    {
	  $('#oldpas').addClass('error');
	  $('#oldpas').attr('placeholder', 'Fill this field');
	  err= 1;
	}
   else
    {
	  if(v33!='<?php echo $_SESSION['REAL_VEER']['password']; ?>')
       {
	    $('#oldpas').addClass('error');
	    $("#oldpas").val("");
	    $('#oldpas').attr('placeholder', 'In-Correct Password');
	    err= 1;
	   }
      if(v33=='<?php echo $_SESSION['REAL_VEER']['password']; ?>')
       {
	    $('#oldpas').removeClass('error');
	    err= 0;
	   }
	}
   
   if(vv!='' && vv2!='')
    {
	  if(vv!=vv2)
	   {
		 $('#conpas').addClass('error');
	     $("#conpas").val("");
		 $('#conpas').attr('placeholder', 'Not matched');
	     err= 1;
	   }
	  else
	   {
		 $('#conpas').removeClass('error');
	     err= 0;
	   }
	}
 }

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
	 if($_SESSION['msg']=='pted')
	  {
		?> $('#AApted').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 if($_SESSION['msg']=='dltd')
	  {
		?> $('#AAdltd').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 if($_SESSION['msg']=='success')
	  {
		?> $('#succ').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 if($_SESSION['msg']=='NOT_success')
	  {
		?> $('#NNOsucc').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 unset($_SESSION['msg']);
   }
  
  if(isset($_REQUEST['tab']) and $_REQUEST['tab']=='profile')
   {
	 ?> $('#propro').trigger('click'); <?php
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
	
	fillfield('user_login');
	fillfield('first_name');
	fillfield('oldpas');
	fillfield('newpas');
	fillfield('conpas');
	checkma('real_emailie');
	fillfield('license');
	fillfield('dre');
	fillfield('company');
	fillfield('zip');
	fillfield('phone');
	matchpas();
	if(err==1)
	 {
	   return false;
	 }
  });
  
});

</script>
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
          <h1>Welcome back valued realtor to your dashboard</h1>
          <ol class="breadcrumb"><li class="active">Giving you the cutting edge you need!</li>
          </ol>
        </div>  
      </div> 
    </div> 
  </div>
<div class="space20"></div>
<div class="container">
<div class="row">
<div class="col-md-8">
<div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="AApted">Letter successfully updated.</div>
<div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="AAdltd">Letter successfully deleted.</div>
<div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="succ">Change successfully saved.</div>
<div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="NNOsucc">Newly entered email ID or BRE is already registered with us so we did not saved your changes.</div>


<!-- Tabs -->
      
  <div class="container">
    <div class="row">
      <div class="col-md-12">
  
        <div class="tabbable">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1-1" data-toggle="tab"><i class="fa fa-edit"></i>Pre-Approved Letters</a></li>
			<li><a href="#tab1-2" data-toggle="tab"><i class="fa fa-cog"></i>News</a></li>
            <li><a href="#tab1-3" id="propro" data-toggle="tab"><i class="fa fa-user"></i>Profile</a></li>
			<li><img src="images/repreappovaldashboard.png" style="width:80%;" /></li>
          </ul>

		      <!-- TAB ONE -->
              <div class="tab-content"><div class="tab-pane active" id="tab1-1">
              <h3> <form method="post" action="realtordashboard.php"> <span style="font-size:22px;">Manage your pre-approval letters for your home buyers</span><br><span style="color:#93ce52;font-style:italic;font-size:15px;">To access your edited letters, switch Letter Type view from 'Main' to 'Edited'</span>
              <!--<input type="text" name="" id="" class="input" placeholder="Search by last name" style="font-size:12px; margin-left:52px; text-align:center; color:#666" />-->
              <span style="float:right"> Letter Type <select class="input" name="rtyp" onChange="this.form.submit()">
              <option value="MAIN" <?php if($sel=='MAIN'){ ?> selected <?php } ?> >Main</option><option value="EDITED" <?php if($sel=='EDITED'){ ?> selected <?php } ?> >Edited
              </option></select></span></form></h3><hr /><?php
			  
			  if(isset($ltrs) and count($ltrs)>0)
			   {
				 foreach($ltrs as $bhgll=>$vgfnn)
				  {
					?><div style="border:1px solid #cacaca;background:#fff;padding:5px 10px 0px 10px;margin-bottom:10px">
                    <div class="row">
                    <div class="col-sm-7"><a href="letterbasic.php?lett_id=<?php echo $vgfnn['id']; ?>&stam=<?php echo $vgfnn['created']; ?>"><b><?php echo $byrnams[$vgfnn['letter_sender']].' - '.$byrnams[$vgfnn['buyer_id']].', '.$otherbyye[$vgfnn['buyer_id']]; ?></b></a></div>
                    
                    <div class="col-sm-2"><b>Loan Type:</b> <?php echo $vgfnn['loan_type']; ?></div>
                    
                    <div class="col-sm-3"><span style="font-weight:bold;color:#045D92;font-size:13px"> Pre-approved up to: $<?php echo $vgfnn['purchase_price'].' @ '.$vgfnn['max_qual_interest_rate'] ?>%</span></div></div>
                    
                    <div class="row">
                    <div class="col-sm-3"><b>Property Type:</b> <?php echo $vgfnn['property_type']; ?></div>
                    <div class="col-sm-2">Issued on <?php echo date('m/d/Y', $vgfnn['generation_date']); ?></div>
                    <div class="col-sm-2">Expires on <?php echo date('m/d/Y', $vgfnn['expiry_date']); ?></div>
                    <div class="col-sm-3"><span style="font-weight:bold;color:#045D92;">
                    <a href="letterbasic.php?lett_id=<?php echo $vgfnn['id']; ?>&stam=<?php echo $vgfnn['created']; ?>">View, Print or Email</a></span></div>
                    
                    <div class="col-sm-2">
                    <a href="realtoreditletter.php?eid=<?php echo $vgfnn['id']; ?>&tmp=<?php echo $vgfnn['created']; ?>&sel=<?php echo $sel; ?>">
                    <span style="font-weight:bold;color:#93CE52;">Edit this letter</span></a></div></div></div><?php
				  }
				 ?><div style="border:1px solid #cacaca;background:#fff;padding:5px 10px 0px 10px;margin-bottom:10px">
                 <div class="row"><div class="col-sm-12">
                 <ul class="pagination"><?php echo $likns; ?></ul></div></div></div><?php
			   }
			  else
			   {
				 ?> <div style="background-color:#93CE52; text-align:center; width:500px;">No Record Found</div> <?php
			   }
			  
			  ?><p>&nbsp;</p></div>
              
			  <!-- TAB TWO -->
              <div class="tab-pane" id="tab1-2">
              <?php $SelResource=mysql_fetch_assoc(mysql_query("select * from resource_cont where status='1'"));?>
              <h3><?php echo stripslashes($SelResource['title']); ?></h3>
			  <hr />
              <?php echo stripslashes($SelResource['content']); ?>
			  <iframe class="repreapproval" width="600" height="427" src="<?php echo stripslashes($SelResource['vedio']); ?>" frameborder="0" allowfullscreen></iframe>	
			  </div>

			  <!-- TAB THREE -->
            <div class="tab-pane" id="tab1-3">
            <h3>Manage your profile </h3>
<div class="login">
<form name="registerform" id="registerform" action="realtordashboard.php"  class="form-horizontal" method="post">


<p id="reg_passmail"></p>
 <div class="form-group"><label class="col-sm-3" for="first_name">Your first name</label><div class="col-sm-9"><input type="text" name="first_name" id="first_name" class="input" onBlur="fillfield('first_name');" value="<?php echo $_SESSION['REAL_VEER']['firstname']; ?>" size="50"/></div></div>
 <div class="form-group"><label class="col-sm-3" for="last_name">Your last name</label><div class="col-sm-9"><input type="text" name="last_name" id="last_name" class="input" value="<?php echo $_SESSION['REAL_VEER']['lastname']; ?>" size="50"/></div></div>
 <div class="form-group"><label class="col-sm-3" for="pass1">Current password</label><div class="col-sm-9"><input autocomplete="off" name="oldpas" id="oldpas" class="input" size="50" onBlur="matchpas();" type="password" placeholder="You must enter your current password to save your changes" /></div></div>
 <div class="form-group"><label class="col-sm-3" for="pass1">New password</label><div class="col-sm-9"><input autocomplete="off" name="newpas" id="newpas" class="input" size="50" onBlur="fillfield('newpas');" type="password" /></div></div>
 <div class="form-group"><label class="col-sm-3" for="pass2">Confirm new password</label><div class="col-sm-9"><input autocomplete="off" name="conpas" id="conpas" class="input" size="50" onBlur="matchpas();" type="password"/></div></div>

 <div class="form-group"><label class="col-sm-3" for="user_email">Your email</label><div class="col-sm-9"><input type="text" class="input" name="real_emailie" id="real_emailie" onBlur="checkma('real_emailie');" value="<?php echo $_SESSION['REAL_VEER']['email']; ?>" size="50"/></div></div>
 <div class="form-group"><label class="col-sm-3" for="nmls">NMLS license</label><div class="col-sm-9"><input type="text" name="license" id="license" class="input" onBlur="fillfield('license');" value="<?php echo $_SESSION['REAL_VEER']['license']; ?>" size="50" /></div></div>
 <div class="form-group"><label class="col-sm-3" for="dre">DRE license</label><div class="col-sm-9"><input type="text" name="dre" id="dre" class="input" onBlur="fillfield('dre');" value="<?php echo $_SESSION['REAL_VEER']['DRE']; ?>" size="50" /></div></div>
 <div class="form-group"><label class="col-sm-3" for="company">Your agency name</label><div class="col-sm-9"><input type="text" name="company" id="company" onBlur="fillfield('company');" class="input" value="<?php echo $_SESSION['REAL_VEER']['companyname']; ?>" size="50" /></div></div>

 <div class="form-group"><label class="col-sm-3">Street address</label><div class="col-sm-9"><input id="streetaddress1" type="text" class="input" size="50" value="<?php echo $_SESSION['REAL_VEER']['street']; ?>" name="streetaddress1" /></div></div>   
 <div class="form-group"><label class="col-sm-3">Suite #</label><div class="col-sm-9"><input id="suite" type="text" class="input" size="50" value="<?php echo $_SESSION['REAL_VEER']['suite']; ?>" name="suite" /></div></div>
 <div class="form-group"><label class="col-sm-3">City</label><div class="col-sm-9"><input id="city" type="text" class="input" size="50" value="<?php echo $_SESSION['REAL_VEER']['city']; ?>" name="city" /></div></div>
 <div class="form-group"><label class="col-sm-3">State</label><div class="col-sm-9"><input id="state" type="text" class="input" size="50" value="<?php echo $_SESSION['REAL_VEER']['state']; ?>" name="state" /></div></div>
 <div class="form-group"><label class="col-sm-3">ZIP code</label><div class="col-sm-9"><input id="zip" type="text" class="input poin" size="50" onBlur="fillfield('zip');" value="<?php echo $_SESSION['REAL_VEER']['zip']; ?>" name="zip" /></div></div>
 <div class="form-group"><label class="col-sm-3">Phone</label><div class="col-sm-9"><input id="phone" type="text" class="input" size="50" onBlur="fillfield('phone');" value="<?php echo $_SESSION['REAL_VEER']['phone']; ?>" name="phone" /></div></div>
 <div class="form-group submit"><label class="col-sm-3">&nbsp;</label><div class="col-sm-9"><input type="submit" name="landsubmit" value="Edit your profile" class="btn btn-primary"/></div></div>
</form>
</div></div></div></div></div>
</div></div></div></div></div>
<div class="space40"></div>
<div class="space60"></div>
<footer class="footer"><?php
include("includes/topfooter.php");
include("includes/footer.php");
?></footer><?php
include("includes/javascript.php");
?></body>
</html>