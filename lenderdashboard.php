<?php include("admin/config.php");
if(!$_SESSION['logge'] or !isset($_SESSION['logge']['id']))
 {
   header('location:index.php');
 }

if(isset($_REQUEST['delrealid']) and $_REQUEST['delrealid']!='' and isset($_REQUEST['realstam']) and $_REQUEST['realstam']!='')// to make realtor deleted for this user
 {
   $njddco= mysql_fetch_assoc(mysql_query("select * from userthree where id= '".$_REQUEST['delrealid']."' and created= '".$_REQUEST['realstam']."'"));
   $cdxxxp= explode(',', $njddco['createdby']);
   if(count($cdxxxp)>0)
    {
	  foreach($cdxxxp as $hs=>$asap)
	   {
		 if($asap==$_SESSION['logge']['id'])
		  {
			unset($cdxxxp[$hs]);
		  }
	   }
	}
   $njf= implode(',', $cdxxxp);
   //$deactivtae= mysql_query("update `userthree` set `email`= 'SANTDASDUBEY_HAS_DELETED' where id= '".$_REQUEST['delrealid']."' and created= '".$_REQUEST['realstam']."'");
   $deactivtae= mysql_query("update `userthree` set `createdby`= '".$njf."' where id= '".$_REQUEST['delrealid']."' and created= '".$_REQUEST['realstam']."'");
   
   if($deactivtae)
    {
	  $_SESSION['msg']='dltdact';
	}
 }

if(isset($_REQUEST['bbibid']) and $_REQUEST['bbibid']!='' and isset($_REQUEST['bystam']) and $_REQUEST['bystam']!='') // to delete buyer
 {
   $dterd= mysql_query("delete from `userthree` where `id`= '".$_REQUEST['bbibid']."' and created= '".$_REQUEST['bystam']."' and `accounttype`= 'HOMEBUYER'");
   if($dterd)
    {
	  mysql_query("delete from `letters` where `buyer_id`= '".$_REQUEST['bbibid']."'");
	  $_SESSION['msg']='dltdBY';
	  //header('location:lenderdashboard.php?tab=homebuyers');
	}
 }

if(isset($_REQUEST['delidd']) and $_REQUEST['delidd']!='' and isset($_REQUEST['stam']) and $_REQUEST['stam']!='') // to delete letter
 {
   $dterd= mysql_query("delete from `letters` where `id`= '".$_REQUEST['delidd']."' and created= '".$_REQUEST['stam']."'");
   if($dterd)
    {
	  $_SESSION['msg']='dltd';
	}
 }

if(isset($_REQUEST['UPDA']) and $_REQUEST['UPDA']=='Update your profile')
 {
   $exisalre= mysql_fetch_assoc(mysql_query("select id, email from userthree where id!='".$_SESSION['logge']['id']."' and email='".$_REQUEST['user_email']."'"));
   if(isset($exisalre['id']) and $exisalre['id']!='')
    {
	   $_SESSION['msg']='NOT_success';
	}
   else
    {
	   if($_REQUEST['user_email']!='' and $_REQUEST['newpas']!='' and $_REQUEST['first_name']!='' and $_REQUEST['company']!='' and $_REQUEST['zip']!='' and $_REQUEST['phone']!='')
		{
		  $decline= mysql_query("update userthree set `email`= '".$_REQUEST['user_email']."', `password`= '".$_REQUEST['newpas']."', `firstname`= '".$_REQUEST['first_name']."', `lastname`= '".$_REQUEST['last_name']."', `companyname`= '".$_REQUEST['company']."', `license`='".$_REQUEST['license']."', `DRE`='".$_REQUEST['dre']."', `street`= '".$_REQUEST['streetaddress1']."', `suite`= '".$_REQUEST['suite']."', `city`= '".$_REQUEST['city']."', `state`= '".$_REQUEST['state']."', `zip`= '".$_REQUEST['zip']."', `phone`= '".$_REQUEST['phone']."' where id= '".$_SESSION['logge']['id']."'");
		  if($decline)
		   {
			 $_SESSION['logge']['email']=$_REQUEST['user_email'];
			 $_SESSION['logge']['password']=$_REQUEST['newpas'];
			 $_SESSION['logge']['firstname']=$_REQUEST['first_name'];
			 $_SESSION['logge']['lastname']=$_REQUEST['last_name'];
			 $_SESSION['logge']['companyname']=$_REQUEST['company'];
			 
			 $_SESSION['logge']['license']=$_REQUEST['license'];
			 $_SESSION['logge']['DRE']=$_REQUEST['dre'];
			 
			 $_SESSION['logge']['street']=$_REQUEST['streetaddress1'];
			 $_SESSION['logge']['suite']=$_REQUEST['suite'];
			 $_SESSION['logge']['city']=$_REQUEST['city'];
			 $_SESSION['logge']['state']=$_REQUEST['state'];
			 $_SESSION['logge']['zip']=$_REQUEST['zip'];
			 $_SESSION['logge']['phone']=$_REQUEST['phone'];
			 $_SESSION['msg']='success';
			 header('location:lenderdashboard.php?tab=profile');
		   }
		}
	}
 }

$allreal= array();
$realids= array();
//SELECT * FROM `sele` WHERE FIND_IN_SET('2',for_ids);

//$cdf= mysql_query("select * from userthree where `createdby`= '".$_SESSION['logge']['id']."' and `accounttype`= 'REALTOR'");
$cdf= mysql_query("select * from userthree where FIND_IN_SET('".$_SESSION['logge']['id']."', createdby) and `accounttype`= 'REALTOR'");
if($cdf)
 {
   while($ops=mysql_fetch_assoc($cdf))
    {
	  $allreal[]=$ops;
	  $realids[]=$ops['id'];
	}
 }

$idin= implode(',', $realids);
$byridsss= array();
$bhyrsnams= array(); // is having comma issue
$baayres= array();
$otherbyye= array(); // is having comma issue
if($idin!='')
 {
   //$kccd= mysql_query("select * from userthree where `createdby` in (".$idin.") and `lender_of_buyer`= '".$_SESSION['logge']['id']."'"); // to fnd homebuyers of all realtors of this lender
   $kccd= mysql_query("select * from userthree where `lender_of_buyer`= '".$_SESSION['logge']['id']."'"); // to fnd homebuyers of all realtors of this lender
   while($ghfz= mysql_fetch_assoc($kccd))
    {
	  $baayres[]= $ghfz;
	  
	  if($ghfz['lastname']=='')
	   {
		 $bhyrsnams[$ghfz['id']]= $ghfz['firstname'];
	   }
	  else
	   {
		 $bhyrsnams[$ghfz['id']]= $ghfz['firstname'].' '.$ghfz['lastname'];
	   }
	  
	  ///============================================================
	  $gg= '';
	  if($ghfz['otherbuyer']!='')
	   {
		 $fzxpa= explode('@=@', $ghfz['otherbuyer']);
		 foreach($fzxpa as $bza=>$vpq)
		  {
			if($vpq=='' or $vpq==' ' or $vpq==NULL)
			 {
			   unset($fzxpa[$bza]);
			 }
		  }
		 $gg= implode(', ', $fzxpa);
	   }
	  $otherbyye[$ghfz['id']]= $gg;
	  ///============================================================
	  $byridsss[]=$ghfz['id'];
	}
 }

$mkpp= implode(',', $byridsss);
$ltrs= array();
if(isset($_REQUEST['rtyp']))// if type selection dropdown in selected
 {
   if($_REQUEST['rtyp']=='MAIN')
    {
	  $aacdf= mysql_query("select * from letters where `buyer_id` in (".$mkpp.") and `letter_type`= 'MAIN' order by `id` DESC");
	  $sel= 'MAIN';
	}
   else // EDITED
    {
	  $aacdf= mysql_query("select * from letters where `buyer_id` in (".$mkpp.") and `letter_type`!= 'MAIN' order by `id` DESC");
	  $sel= 'EDITED';
	}
 }
else // no dropdown value is selected
 {
   $aacdf= mysql_query("select * from letters where `buyer_id` in (".$mkpp.") and `letter_type`= 'MAIN' order by `id` DESC");
   $sel= 'MAIN';
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
	  $likns= $likns.'<li class="'.$clja.'"><a href="lenderdashboard.php?lpage='.$z.'">Page '.$z.'</a></li>';
	  
	}
 }
////////////////////////////////////

?><!DOCTYPE html>
<html class="not-ie" lang="en">
<head><meta charset="utf-8">
<title>Lenders Dashboard on RePreApproval</title>
<meta name="description" content="RePreApproval, a revolution in real estate pre approval letters. Lenders and realtors, have your clients' pre approval letter modified and printed online">
<meta name="keywords" content="repreapproval, preapproval letters online, online preapproval letters, print preapproval letter, real estate, realtors, realtos, mortgage lender, lenders">
<?php include("includes/head.php"); ?>
<script type="text/javascript">
var err= 0;

function condelbuy(iddi, samay)
 {
   if(confirm("Are you sure you want to delete this realtor? Deletion is permanent.")) {
      window.location.href="lenderdashboard.php?bbibid="+iddi+"&bystam="+samay+"";
    }
   else
    {
	  return false;
	}
 }

function delreal(id, stapr)
 {
   if(confirm("Are you sure you want to delete this realtor? Deletion is permanent.")) {
      window.location.href="lenderdashboard.php?delrealid="+id+"&realstam="+stapr+"";
    }
   else
    {
	  return false;
	}
 }


function delit(id, stam)
 {
   if(confirm("Are you sure you want to delete? Deletion is permanent.")) {
      window.location.href="lenderdashboard.php?delidd="+id+"&stam="+stam+"";
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
	  if(v33!='<?php echo $_SESSION['logge']['password']; ?>')
       {
	    $('#oldpas').addClass('error');
	    $("#oldpas").val("");
	    $('#oldpas').attr('placeholder', 'In-Correct Password');
	    err= 1;
	   }
      if(v33=='<?php echo $_SESSION['logge']['password']; ?>')
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

function delACC()
 {
   if(confirm("Are you sure to delete your account from Re-PreApproval ?"))
     {
      window.location.href="Del_acc.php";
     }
   else
     {
	  return false;
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
  
  $('.phomo').keyup(function()
   {
    this.value = this.value.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
	//this.value = this.value.replace(/(\d{4})\-?/g,'$1-');
   });
  
  <?php
  if(isset($_SESSION['msg']) and $_SESSION['msg']!='')
   {
	 if($_SESSION['msg']=='tedUBU')
	  {
		?> $('#AAtedUBU').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 if($_SESSION['msg']=='tedU')
	  {
		?> $('#AAtedU').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 if($_SESSION['msg']=='pted')
	  {
		?> $('#AApted').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 
	 if($_SESSION['msg']=='dltdBY')
	  {
		?> $('#AAdltdBY').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 
	 if($_SESSION['msg']=='dltd')
	  {
		?> $('#AAdltd').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 if($_SESSION['msg']=='dltdact')
	  {
		?> $('#rtor').trigger('click');
		$('#AAdltdact').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 if($_SESSION['msg']=='HBadded')
	  {
		?> $('#HBadded').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 
	 if($_SESSION['msg']=='added')
	  {
		?> $('#added').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 
	 if($_SESSION['msg']=='NOT_success')
	  {
		?> $('#NNOsucc').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 
	 if($_SESSION['msg']=='success')
	  {
		?> $('#succ').slideDown('slow').delay(6666).slideUp('slow'); <?php
	  }
	 unset($_SESSION['msg']);
   }
  
  if(isset($_REQUEST['tab']) and $_REQUEST['tab']=='homebuyers')
   {
	 ?> $('#hmby').trigger('click'); <?php
   }
  if(isset($_REQUEST['tab']) and $_REQUEST['tab']=='profile')
   {
	 ?> $('#propro').trigger('click'); <?php
   }
  elseif(isset($_REQUEST['tab']) and $_REQUEST['tab']=='realtors')
   {
	 ?> $('#rtor').trigger('click'); <?php
   }
  elseif(isset($_REQUEST['delrealid']) and $_REQUEST['delrealid']!='')
   {
	 ?> $('#rtor').trigger('click'); <?php
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
	
	checkma('user_email');
	fillfield('user_login');
	fillfield('first_name');
	fillfield('oldpas');
	fillfield('newpas');
	fillfield('conpas');
	//fillfield('license');
	//fillfield('dre');
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
<?php include("includes/header.php"); ?>
</header>
<div class="breadcrumb-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12"> 
        <!--<h1>Welcome back valued lender to your dashboard</h1>companyname-->
        <h1>Welcome back <span style="color:#26609E;font-weight:bold;"><?php echo $_SESSION['logge']['companyname']; ?></span></h1>
        <ol class="breadcrumb">
          <li class="active">Giving you the cutting edge you need!</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="space20"></div>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="AAdltdact">Realtor successfully deleted</div>
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="AAtedUBU">Home buyer account successfully Updated</div>
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="AAtedU">Realtor account successfully Updated</div>
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="AApted">Letter successfully Updated</div>
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="AAdltdBY">Home buyer successfully deleted</div>
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="AAdltd">Letter successfully deleted</div>
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="HBadded">Home buyer successfully added</div>
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="added">Realtor successfully added</div>
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="succ">Change successfully saved</div>
      <div style="background-color:#93CE52; text-align:center; width:500px; display:none;margin-left:15px" id="NNOsucc">Newly entered email id is already registered so we did not saved your changes</div>
      
      <!-- Tabs -->
      
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="tabbable">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1-1" data-toggle="tab"><i class="fa fa-edit"></i>Pre-Approved Letters</a></li>
                <li><a href="#tab1-2" id="rtor" data-toggle="tab"><i class="fa fa-users"></i>My Realtors</a></li>
                <li><a href="#tab1-3" id="hmby" data-toggle="tab"><i class="fa fa-users"></i>My Home Buyers</a></li>
                <li><a href="#tab1-4" data-toggle="tab"><i class="fa fa-cog"></i>News</a></li>
                <li><a href="#tab1-5" id="propro" data-toggle="tab"><i class="fa fa-user"></i>Profile</a></li>
                <li><img src="images/repreappovaldashboard.png" class="michael" /></li>
              </ul>
              
              <!-- TAB ONE -->
              <div class="tab-content">
                <div class="tab-pane active" id="tab1-1">
                  <p><a href="addletter.php" title="Click here to add a new pre approval letter"><img src="images/addbutton.png" style="width:30px;margin-bottom:7px;margin-right:10px" /> Add a new pre-approval letter</a></p>
                  <p><a href="edittemplateletter.php" title="Click here to add a new pre approval letter"><img src="images/addbutton.png" style="width:30px;margin-bottom:7px;margin-right:10px" />Click here to edit your logo and disclaimer section for all of your pre-approval letters</a></p>
                  <hr style="margin:5px 0 !important;" />
                  <!--<h3>Manage your pre-approval letters<input autocomplete="" name="" id="" class="input" size="" value="" type="" placeholder="Search by last name"  style="font-size:12px;margin-left:352px;text-align:center;color:#666" /></h3>-originally----->
                  
                  <h3 style="padding-top:0px !important;">
                    <form method="post" action="lenderdashboard.php">
                      <span style="font-size:22px;">Manage your pre-approval letters for your home buyers</span><br><span style="color:#93ce52;font-style:italic;font-size:15px;">To access your edited letters, switch Letter Type view from 'Main' to 'Edited'</span>
                      <!--<input type="text" name="" id="" class="input" placeholder="Search by last name" style="font-size:12px;margin-left:52px;text-align:center;color:#666" />--> 
                      <span style=" float:right">Select a letter type
                      <select class="input" name="rtyp" onChange="this.form.submit()">
                        <option value="MAIN" <?php if($sel=='MAIN'){ ?> selected <?php } ?> >Original letter</option>
                        <option value="EDITED" <?php if($sel=='EDITED'){ ?> selected <?php } ?> >Edited letters from your realtors </option>
                      </select>
                      </span>
                    </form>
                  </h3><hr /><?php
			  
			  if(isset($ltrs) and count($ltrs)>0)
			   {
				foreach($ltrs as $bhgll=>$vgfnn)
				 {
				  ?><div style="border:1px solid #cacaca;background:#fff;padding:5px 10px 0px 10px;margin-bottom:10px">
                  <div class="row"><div class="col-sm-7">
                  
                  <a href="letterbasic.php?lett_id=<?php echo $vgfnn['id']; ?>&stam=<?php echo $vgfnn['created']; ?>"><b><?php 
				  $ccdzp= '';
				  if($otherbyye[$vgfnn['buyer_id']]!='')
				   {
					 $ccdzp= ', '.$otherbyye[$vgfnn['buyer_id']];
				   }
				  echo $_SESSION['logge']['firstname'].' '.$_SESSION['logge']['lastname'].' - '.$bhyrsnams[$vgfnn['buyer_id']].$ccdzp;
				  //echo $_SESSION['logge']['firstname'].' '.$_SESSION['logge']['lastname'].' - '.$bhyrsnams[$vgfnn['buyer_id']].', '.$otherbyye[$vgfnn['buyer_id']]; ?></b>
                  </a></div>
                  
                  <div class="col-sm-2"><b>Loan Type:</b> <?php echo $vgfnn['loan_type']; ?></div>
                  <div class="col-sm-3"><span style="font-weight:bold;color:#045D92;font-size:13px"> Pre-approved up to: $<?php echo $vgfnn['purchase_price'].' @ '.$vgfnn['max_qual_interest_rate']; ?></span></div>
                  </div>
                  
                  <div class="row">
                      <div class="col-sm-3"><b>Property Type:</b> <?php echo $vgfnn['property_type']; ?></div>
                      <div class="col-sm-2">Issued on <?php echo date('m/d/Y', $vgfnn['generation_date']); ?></div>
                      <div class="col-sm-2">Expires on <?php echo date('m/d/Y', $vgfnn['expiry_date']); ?></div>
                      <div class="col-sm-2"><span style="font-weight:bold;color:#045D92;"> <a href="letterbasic.php?lett_id=<?php echo $vgfnn['id']; ?>&stam=<?php echo $vgfnn['created']; ?>">View, Print or Email</a></span></div>
                      <div class="col-sm-2"><a href="lendereditletter.php?eid=<?php echo $vgfnn['id']; ?>&tmp=<?php echo $vgfnn['created']; ?>"> <span style="font-weight:bold;color:#93CE52;">Edit this letter</span></a></div>
                      <div class="col-sm-1"><span style="font-weight:bold;color:#ddd;"> <a href="javascript:void(0);" onClick="delit('<?php echo $vgfnn['id']; ?>', '<?php echo $vgfnn['created']; ?>');" style="color:#f65201">Delete</a> </span></div>
                    </div>
                  </div>
                  <?php
				  }
				 ?>
                  <div style="border:1px solid #cacaca;background:#fff;padding:5px 10px 0px 10px;margin-bottom:10px">
                    <div class="row">
                      <div class="col-sm-12">
                        <ul class="pagination">
                          <?php echo $likns; ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <?php
			   }
			  else
			   {
				 ?><div style="background-color:#93CE52; text-align:center; width:500px;">No Record Found</div><?php
			   }
              ?><p>&nbsp;</p></div>
              
              <!-- TAB TWO -->
              <div class="tab-pane" id="tab1-2">
              <p><a href="addrealtor.php" title="Click here to add a new realtor in your network">
              <img src="images/addbutton.png" style="width:30px;margin-bottom:7px;margin-right:10px" /> Add a new realtor</a>
              <!--<input class="input" style="font-size:12px;margin-left:352px;text-align:center;color:#666" />-->
              </p><hr />
              <h3>Manage your realtors</h3>
              <hr /><?php
			  if(count($allreal)>0)
			   {
				 foreach($allreal as $vgs=>$aop)
				  {
					if($aop['email']!='SANTDASDUBEY_HAS_DELETED')
					 {
					  ?>
                    <div class="row" style="font-size:13px;">
                    <div class="col-sm-3"><?php echo $aop['firstname'].' '.$aop['lastname']; ?></div>
                    <div class="col-sm-3"><?php echo $aop['companyname']; ?></div>
                    <div class="col-sm-3"><?php echo $aop['email']; ?></div>
                    <div class="col-sm-1">&nbsp;</div>
                    <div class="col-sm-1" style="padding:0;"><a href="editrealtor.php?edrealid=<?php echo $aop['id']; ?>&edrealstam=<?php echo $aop['created']; ?>" title="Click here to edit this realtor" style="color:#26609E;font-weight:bold;">Edit Profile</a> | </div>
                    <div class="col-sm-1" style="padding:0;"><a href="javascript:void(0);" onClick="delreal('<?php echo $aop['id']; ?>', '<?php echo $aop['created']; ?>');" title="Click here to delete this realtor" style="color:#93CE52;font-size:small">Delete Profile</a></div>
                  </div>
                  <hr style="background:#F7FCFF;margin:7px 0 !important;"/>
                  <?php
					 }
				  }
			   }
			  else
			   {
				 echo '<div style="background-color:#93CE52; text-align:center; width:500px;">No Realtors Found In Your Account</div>';
			   }
			  ?>
                  <!--Realtor's First and Last Name | Agency Name | Email | <a href="" title="Click here to edit this realtor">Edit Profile</a> | <a href="" title="Click here to delete this realtor">Delete Profile</a><br>--> 
                  
              </div>
              <div class="tab-pane" id="tab1-3">
              <p><a href="addhomebuyer.php" title="Click here to add a new home buyer in your network">
              <img src="images/addbutton.png" style="width:30px;margin-bottom:7px;margin-right:10px" /> Add a new home buyer</a>
              <!--<input class="input" style="font-size:12px;margin-left:352px;text-align:center;color:#666" />-->
              </p><hr />
              <h3>Manage your home buyers</h3>
              <hr /><?php
			  if(isset($baayres) and count($baayres)>0)
			   {
				 foreach($baayres as $fjs=>$jcr)
				  {
					$gg= '';
					if($jcr['otherbuyer']!='')
					 {
					  $fzxpa= explode('@=@', $jcr['otherbuyer']);
					  foreach($fzxpa as $bza=>$vpq)
		  			   {
						if($vpq=='' or $vpq==' ' or $vpq==NULL)
			 			 {
			   			  unset($fzxpa[$bza]);
			 			 }
		  			   }
					  $gg= implode(', ', $fzxpa);
					 }
					?><div class="row" style="font-size:13px;"><div class="col-sm-6"><?php
					if($gg!='')
					 {
					   echo $jcr['firstname'].', '.$gg;
					 }
					else
					 {
					   echo $jcr['firstname'];
					 }
					?></div>
                    <div class="col-sm-4"><a href="javascript:void(0);"><?php echo $jcr['email']; ?></a></div>
                    <div class="col-sm-1" style="padding:0;"><a href="editbuyer.php?buyid=<?php echo $jcr['id']; ?>&edbystam=<?php echo $jcr['created']; ?>" title="Click here to edit this home buyer" style="color:#26609E;font-weight:bold;">Edit Profile</a> | </div>
                    <div class="col-sm-1" style="padding:0;"><a href="javascript:void(0);" onClick="condelbuy('<?php echo $jcr['id']; ?>', '<?php echo $jcr['created']; ?>');" title="Click here to delete this home buyer" style="color:#93CE52;font-size:small">Delete Profile</a></div>
                    </div><hr style="background:#F7FCFF;margin:7px 0 !important;" /><?php
				  }
			   }
			  else
			   {
				 echo '<div style="background-color:#93CE52; text-align:center; width:500px;">No Home Buyers found</div>';
			   }
			  ?>
                  
                  <!--Home Buyers' First and Last Names | Approval Amount | Aprroval Date - Issued | Approval Date - Expiration | Email | <a href="" title="Click here to edit this home buyer">Edit Profile</a> | <a href="" title="Click here to delete this home buyer">Delete Profile</a><br>--> 
                  
                </div>
                
                <!-- TAB FOUR -->
                <div class="tab-pane" id="tab1-4">
                  <?php $SelResource=mysql_fetch_assoc(mysql_query("select * from resource_cont where status='1'"));?>
                  <h3><?php echo stripslashes($SelResource['title']); ?></h3>
                  <hr />
                  <?php echo stripslashes($SelResource['content']); ?>
                  <iframe class="repreapproval" width="600" height="427" src="<?php echo stripslashes($SelResource['vedio']); ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                
                <!-- TAB FIVE -->
                
                <div class="tab-pane" id="tab1-5">
                  <h3>Manage your profile </h3>
                  <div class="login">
                    <form name="registerform" id="registerform" action="" method="post" class="form-horizontal">
                      
                      <!--<p><label for="user_login">Username</label></div>-->
                      <p id="reg_passmail"></p>
                      <div class="form-group">
                        <label class="col-sm-3" for="user_email">E-mail</label>
                        <div class="col-sm-9">
                          <input type="text" name="user_email" id="user_email" onBlur="checkma('user_email');" class="input" value="<?php echo $_SESSION['logge']['email']; ?>" size="50"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" for="pass1">Current password</label>
                        <div class="col-sm-9">
                          <input autocomplete="off" name="oldpas" id="oldpas" class="input" size="50" onBlur="fillfield('oldpas');" type="password" placeholder="You must enter your current password to save your changes"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" for="pass1">New password</label>
                        <div class="col-sm-9">
                          <input autocomplete="off" name="newpas" id="newpas" class="input" size="50" onBlur="fillfield('newpas');" type="password" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" for="pass2">Confirm new password</label>
                        <div class="col-sm-9">
                          <input autocomplete="off" name="conpas" id="conpas" class="input" size="50" onBlur="fillfield('conpas');" type="password" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" for="first_name">First name</label>
                        <div class="col-sm-9">
                          <input type="text" name="first_name" id="first_name" class="input" onBlur="fillfield('first_name');" value="<?php echo $_SESSION['logge']['firstname']; ?>" size="50"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" for="last_name">Last name</label>
                        <div class="col-sm-9">
                          <input type="text" name="last_name" id="last_name" class="input" value="<?php echo $_SESSION['logge']['lastname']; ?>" size="50"/>
                        </div>
                      </div>
                      
                      <!-- NEW FIELDS begin -->
                      <div class="form-group">
                        <label class="col-sm-3" for="nmls">NMLS license</label>
                        <div class="col-sm-9">
                          <input type="text" name="license" id="license" class="input" value="<?php echo $_SESSION['logge']['license']; ?>" size="50" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3" for="dre">BRE license</label>
                        <div class="col-sm-9">
                          <input type="text" name="dre" id="dre" class="input" value="<?php echo $_SESSION['logge']['DRE']; ?>" size="50" />
                        </div>
                      </div>
                      <!-- NEW FIELDS end -->
                      <div class="form-group">
                        <label class="col-sm-3" for="company">Company name</label>
                        <div class="col-sm-9">
                          <input title="50" type="text" name="company" id="company" onBlur="fillfield('company');" class="input" value="<?php echo $_SESSION['logge']['companyname']; ?>" size="50" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3">Street address</label>
                        <div class="col-sm-9">
                          <input id="streetaddress1" type="text" class="input" size="50" value="<?php echo $_SESSION['logge']['street']; ?>" name="streetaddress1" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3">Suite #</label>
                        <div class="col-sm-9">
                          <input id="suite" type="text" class="input" size="50" value="<?php echo $_SESSION['logge']['suite']; ?>" name="suite" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3">City</label>
                        <div class="col-sm-9">
                          <input id="city" type="text" class="input" size="50" value="<?php echo $_SESSION['logge']['city']; ?>" name="city" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3">State</label>
                        <div class="col-sm-9">
                          <input id="state" type="text" class="input" size="50" value="<?php echo $_SESSION['logge']['state']; ?>" name="state" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3">ZIP code</label>
                        <div class="col-sm-9">
                          <input id="zip" type="text" class="input poin" size="50" onBlur="fillfield('zip');" value="<?php echo $_SESSION['logge']['zip']; ?>" name="zip" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3">Phone</label>
                        <div class="col-sm-9">
                          <input id="phone" type="text" class="input phomo" size="50" onBlur="fillfield('phone');" value="<?php echo $_SESSION['logge']['phone']; ?>" name="phone" />
                        </div>
                      </div>
                      <div class="form-group submit">
                        <label class="col-sm-3">&nbsp;</label>
                        <div class="col-sm-9">
                          <input type="submit" name="UPDA" id="UPDA" value="Update your profile" class="btn btn-primary" />
                          <input type="button" onClick="delACC();" value="Delete Your Account" class="btn btn-primary pull-right" />
                          <div class="clearfix"></div>
                        </div>
                      </div>
                      <div>
                      <?php /*?><p><input title="10" type="text" name="user_login" id="user_login" onBlur="fillfield('user_login');" class="input" value="<?php echo $_SESSION['logge']['username']; ?>" size="50" /></p><?php */?>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Tabs End --> 
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
?></body>
</html>