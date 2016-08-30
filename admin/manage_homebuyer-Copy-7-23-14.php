<?php
include("config.php");
include('head.php');
include("FCKeditor/fckeditor.php");
include('header.php');

$allussr= array();
$vg= mysql_query("select `id`, `firstname`, `lastname` from userthree");
if($vg)
 {
   while($cx= mysql_fetch_assoc($vg))
    {
	  $allussr[$cx['id']]= $cx['firstname'].' '.$cx['lastname'];
	}
 }

$allreal= array();
$cdf= mysql_query("select * from userthree where `accounttype`= 'REALTOR'");
if($cdf)
 {
   while($ops=mysql_fetch_assoc($cdf))
    {
	  $allreal[]=$ops;
	}
 }

if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
 {
  $update=mysql_query("UPDATE  userthree SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
  if($update)
   {
	header("LOCATION:manage_homebuyer.php?msg=updated");
   }	
 }
 
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
 {
  $update=mysql_query("UPDATE  userthree SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
  if($update)
   {
	header("LOCATION:manage_homebuyer.php?msg=updated");
   }	
 }

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
 {
  $delete=mysql_query("delete from  userthree  where id='".$_REQUEST['dlt_id']."'");
  if($delete)
   {
	header("LOCATION:manage_homebuyer.php?msg=deleted");
   }	
 }

if(isset($_REQUEST['buysubmit']) and $_REQUEST['buysubmit']=='Add')
 {
   if($_REQUEST['byr1']!='' and $_REQUEST['byr2']!='' and $_REQUEST['byr3']!='' and $_REQUEST['first_name']!='' and $_REQUEST['user_email']!='' and $_REQUEST['phone']!='' and $_REQUEST['zip']!='' and isset($_REQUEST['rtr']) and $_REQUEST['rtr']!='')
    {
	  $selec= mysql_fetch_assoc(mysql_query("select * from userthree where email = '".$_REQUEST['user_email']."'"));
	  if(isset($selec['id']) and $selec['id']!='')
 	   {
  		 header("location:manage_homebuyer.php");
 	   }
	  else
	   {
		 $tty= time();
		 $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $randstring = '';
         for ($i = 0; $i < 10; $i++) 
          {
           $randstring .= $characters[rand(0, strlen($characters))];
          }
         $passw= $randstring;
		 $allother= $_REQUEST['byr1'].'@=@'.$_REQUEST['byr2'].'@=@'.$_REQUEST['byr3'];
		 $inser= mysql_query("insert into userthree (`firstname`, `phone`, `email`, `username`, `password`, `accounttype`, `otherbuyer`, `street`, `city`, `state`, `zip`, `createdby`, `created`) values ('".$_REQUEST['first_name']."', '".$_REQUEST['phone']."', '".$_REQUEST['user_email']."', '".$_REQUEST['user_email']."', '".$passw."', 'HOMEBUYER', '".$allother."', '".$_REQUEST['streetaddress']."', '".$_REQUEST['city']."', '".$_REQUEST['state']."', '".$_REQUEST['zip']."', '".$_REQUEST['rtr']."', '".$tty."')");
		
		$subject= "Welcome to RePreApproval - You have successfully registered";
		$to= $_REQUEST['user_email'];
		$from= "Info@repreapproval.com";
		
		$mess= '<table width="550px">
		<tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style=""width:340px" /></td></tr>
		<tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr>
		<tr><td colspan="2" style="color:#000;">Congratulations! You have been successfully registered with <strong>RePreApproval</strong> by your lender.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td><strong style="color:#000;">Username</strong></td><td><strong style="color:#045D92;">'.$_REQUEST['user_email'].'</strong></td></tr>
		<tr><td><strong style="color:#000;">Password</strong></td><td><strong style="color:#045D92;">'.$passw.'</strong></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Please keep your login information in a secured location.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">If you require additional assistance, do not hesitate to email us or visit our Frequently Asked Questions page.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Thank you for choosing <strong>RePreApproval</strong>.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">We wish you great success.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">The Team at <strong>RePreApproval</strong></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply go to: http://www.repreapproval.com/login.php</td></tr>
		<tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr></table>';
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$from. "\r\n";
		mail($to, $subject, $mess, $headers);
		$_SESSION['msg']='HBadded';
		header('location:manage_homebuyer.php');
	   }
	}
 }

if(isset($_REQUEST['buyUPD']) and $_REQUEST['buyUPD']=="Update")
 {
   if($_REQUEST['byrids']!='' and $_REQUEST['break']=='jao' and $_REQUEST['byr1']!='' and $_REQUEST['byr2']!='' and $_REQUEST['byr3']!='' and $_REQUEST['first_name']!='' and $_REQUEST['user_email']!='' and $_REQUEST['phone']!='' and $_REQUEST['zip']!='' and isset($_REQUEST['rtr']) and $_REQUEST['rtr']!='')
    {
	  $allother= $_REQUEST['byr1'].'@=@'.$_REQUEST['byr2'].'@=@'.$_REQUEST['byr3'];
	  $changed= mysql_query("update `userthree` set `firstname`= '".$_REQUEST['first_name']."', `phone`= '".$_REQUEST['phone']."', `otherbuyer`= '".$allother."', `street`= '".$_REQUEST['streetaddress']."', `city`= '".$_REQUEST['city']."', `state`= '".$_REQUEST['state']."', `zip`= '".$_REQUEST['zip']."', `createdby`= '".$_REQUEST['rtr']."' where id= '".$_REQUEST['byrids']."'");
	  
	  if($changed)
	   {
		 header('location:manage_homebuyer.php');
		 $_SESSION['msg']='tedUBU';
		 exit;
	   }
	}
 }

?><div id="container" class="row-fluid"> 
  <!-- BEGIN SIDEBAR -->
  <?php include('sidebar-left.php');?>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
  <div id="main-content"> 
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid"> 
      <!-- BEGIN PAGE HEADER-->
      <div class="row-fluid">
        <div class="span12"> 
          
          <!-- BEGIN PAGE TITLE & BREADCRUMB-->
          <h3 class="page-title"> Manage Homebuyers  </h3>
          <ul class="breadcrumb">
            <li> <a href="dashboard.php">Dashboard</a> <span class="divider">/</span> </li>
            <li class="active"> <a href="javascript:;"> Homebuyers</a> </li>
          </ul>
          <!-- END PAGE TITLE & BREADCRUMB--> 
          <!-- BEGIN PAGE CONTENT-->
          <div class="row-fluid">
            <div class="span12"><?php
			if(isset($_REQUEST['action']) and $_REQUEST['action']=='add')
			 {
			  ?><div class="widget green">
              <div class="widget-title">
              <h4><i class="icon-reorder"></i>Add</h4>
              <span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> <a href="javascript:;" class="icon-remove"></a> </span> </div>
              <div class="widget-body">
              <form action="manage_homebuyer.php" class="form-horizontal" id="registerform" method="post">
                
                <div class="control-group">
                <label class="control-label">Home Buyer #1</label>
                <div class="controls">
                <input type="text" name="byr1" id="byr1" onBlur="fillfield('byr1');" class="input-xxlarge"/>
                </div></div>
                
                <div class="control-group">
                <label class="control-label">Home Buyer #2</label>
                <div class="controls">
                <input type="text" name="byr2" id="byr2" onBlur="fillfield('byr2');" class="input-xxlarge"/>
                </div></div>
                
                <div class="control-group">
                <label class="control-label">Home Buyer #3</label>
                <div class="controls">
                <input type="text" name="byr3" id="byr3" onBlur="fillfield('byr3');" class="input-xxlarge"/>
                </div></div>
                
                <div class="control-group">
                <label class="control-label">Home Buyer Name (#4)</label>
                <div class="controls">
                <input type="text" name="first_name" id="first_name" onBlur="fillfield('first_name');" class="input-xxlarge"/>
                </div></div>
                
                <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                <input type="text" name="user_email" id="user_email" onBlur="checkmablur('user_email');" class="input-xxlarge"/>
                </div></div>
                
                <div class="control-group">
                <label class="control-label">Phone</label>
                <div class="controls">
                <input type="text" name="phone" id="phone" onBlur="fillfield('phone');" class="input-xxlarge"/>
                </div></div>
                
                <input type="hidden" id="alread"/>
                
                <div class="control-group">
                <label class="control-label">Associated Realtor</label>
                <div class="controls"><?php
                if(isset($allreal) and count($allreal)>0)
                 {
                  ?><p><select class="input-xxlarge" name="rtr" style="width:555px"><?php
                  foreach($allreal as $bhs=>$vgs)
                   {
                    if($vgs['email']!='SANTDASDUBEY_HAS_DELETED')
                     {
                      ?> <option value="<?php echo $vgs['id']; ?>"><?php echo $vgs['firstname'].' '.$vgs['lastname']; ?></option> <?php
                     }
                   }
                  ?></select><input type="hidden" id="break" value="jao"/></p><?php
                 }
                else
                 {
                  ?><p><input type="text" value="NO REALTOR FOUND" class="input-xxlarge error" size="50" readonly/>
                  <input type="hidden" id="break" value="ruko"/></p><?php
                 }
                ?></div></div>
                
                <div class="control-group">
                <label class="control-label">Street Address</label>
                <div class="controls">
                <input type="text" class="input-xxlarge" id="streetaddress1" name="streetaddress"/>
                </div></div>
                
                
                <div class="control-group">
                <label class="control-label">City</label>
                <div class="controls">
                <input type="text" name="city" id="city" class="input-xxlarge"/>
                </div></div>
                
                <div class="control-group">
                <label class="control-label">State</label>
                <div class="controls">
                <input type="text" name="state" id="state" class="input-xxlarge"/>
                </div></div>
                
                <div class="control-group">
                <label class="control-label">ZIP Code</label>
                <div class="controls">
                <input type="text" class="input-xxlarge poin" id="zip" onBlur="fillfield('zip');" name="zip"/>
                </div></div>
                
                <div class="form-actions">
                <button type="submit" class="btn btn-success" id="submit" name="buysubmit" value="Add"><i class="icon-ok"></i> Save</button>
                <button type="button" class="btn" onClick="window.location='manage_homebuyer.php';"><i class=" icon-remove"></i>Cancel</button>
                </div></form></div></div><?php
			 }
			else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit')
			 {
				$select_edit=mysql_query("SELECT * FROM  userthree WHERE id='".$_REQUEST['edit_id']."'");
				$hbyerEd=mysql_fetch_assoc($select_edit);
				$on= '';
				$tw= '';
				$th= '';
				if($hbyerEd['otherbuyer']!='')
				 {
				   $vfzZZ= explode('@=@', $hbyerEd['otherbuyer']);
				   if(isset($vfzZZ[0]))
				    {
					  $on= $vfzZZ[0];
					}
				   if(isset($vfzZZ[1]))
				    {
					  $tw= $vfzZZ[1];
					}
				   if(isset($vfzZZ[2]))
				    {
					  $th= $vfzZZ[2];
					}
				 }
				?><div class="widget purple">
				<div class="widget-title">
				<h4><i class="icon-reorder"></i> Edit</h4>
				<span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> <a href="javascript:;" class="icon-remove"></a> </span> </div>
				<div class="widget-body">
				<form action="manage_homebuyer.php" class="form-horizontal" method="post" id="onee">
				<input type="hidden" value="<?php echo $_REQUEST['edit_id']; ?>" name="byrids"/>
				
                <div class="control-group">
				<label class="control-label">Home Buyer #1</label>
				<div class="controls">
				<input type="text" class="input-xxlarge" name="byr1" id="byr1" value="<?php echo $on; ?>" onBlur="fillfield('byr1');"/>
				</div></div>
				
				<div class="control-group">
				<label class="control-label">Home Buyer #2</label>
				<div class="controls">
				<input type="text" class="input-xxlarge" name="byr2" id="byr2" value="<?php echo $tw; ?>" onBlur="fillfield('byr2');"/>
				</div></div>
				
				<div class="control-group">
				<label class="control-label">Home Buyer #3</label>
				<div class="controls">
				<input type="text" class="input-xxlarge" name="byr3" id="byr3" value="<?php echo $th; ?>" onBlur="fillfield('byr3');"/>
				</div></div>
				
                <div class="control-group">
				<label class="control-label">Home Buyer's Name (#4)</label>
				<div class="controls">
				<input type="text" class="input-xxlarge" name="first_name" value="<?php echo $hbyerEd['firstname']; ?>" id="first_name" onBlur="fillfield('first_name');"/>
				</div></div>
				
                <div class="control-group">
				<label class="control-label">Email</label>
				<div class="controls">
				<input type="text" name="user_email" value="<?php echo $hbyerEd['email']; ?>" id="user_email" class="input-xxlarge" readonly="readonly"/>
				</div></div>
                
                <div class="control-group">
				<label class="control-label">Phone</label>
				<div class="controls">
				<input type="text" name="phone" value="<?php echo $hbyerEd['phone']; ?>" id="phone" onBlur="fillfield('phone');" class="input-xxlarge poin"/>
				</div></div>
                
                <div class="control-group">
				<label class="control-label">Associated Realtor</label>
				<div class="controls"><?php
                if(isset($allreal) and count($allreal)>0)
                 {
                  ?><p><select class="input-xxlarge" name="rtr" style="width:555px"><?php
                  $rr= 'd';
                  foreach($allreal as $bhs=>$vgs)
                   {
                    if($vgs['email']=='SANTDASDUBEY_HAS_DELETED')
                     {
                      $val= $vgs['id'];
                	  $append= 'yes';
                	 }
                	if($vgs['email']!='SANTDASDUBEY_HAS_DELETED')
                	 {
                	  ?> <option value="<?php echo $vgs['id']; ?>" <?php if($vgs['id']==$hbyerEd['createdby']){ ?> selected <?php $rr= 'ff'; } ?> ><?php echo $vgs['firstname']; ?></option> <?php
                	 }
                   }
                  if($append=='yes' and $rr=='d')
                   {
                    ?> <option value="<?php echo $val; ?>" selected>Deleted Realtor</option> <?php
                   }
                  ?></select><input type="hidden" name="break" id="break" value="jao"/></p><?php
                 }
                else
                 {
                  ?><p><input type="text" value="NO REALTOR FOUND" class="input-xxlarge error" readonly/>
                  <input type="hidden" name="break" id="break" value="ruko"/></p><?php
                 }
                ?></div></div>
                
                <div class="control-group">
				<label class="control-label">Street</label>
				<div class="controls">
				<input type="text" class="input-xxlarge" id="streetaddress1" value="<?php echo $hbyerEd['street']; ?>" name="streetaddress"/>
				</div></div>
                
                <div class="control-group">
				<label class="control-label">City</label>
				<div class="controls">
				<input type="text" class="input-xxlarge" id="city" value="<?php echo $hbyerEd['city']; ?>" name="city"/>
				</div></div>
                
                <div class="control-group">
				<label class="control-label">State</label>
				<div class="controls">
				<input type="text" class="input-xxlarge" id="state" value="<?php echo $hbyerEd['state']; ?>" name="state"/>
				</div></div>
                
                <div class="control-group">
				<label class="control-label">Zip</label>
				<div class="controls">
				<input type="text" class="input-xxlarge" id="zip" value="<?php echo $hbyerEd['zip']; ?>" onBlur="fillfield('zip');" name="zip"/>
				</div></div>
                
				<div class="form-actions">
				<button type="submit" class="btn btn-success" id="submVV" name="buyUPD" value="Update"><i class="icon-ok"></i> Save </button>
				<button type="button" class="btn" onClick="window.location='manage_homebuyer.php';"><i class=" icon-remove"></i>Cancel</button>
				</div></form>
                
                </div></div><?php
			  }
			else
			 {
			  $list_pages=mysql_query("SELECT * FROM  userthree where accounttype='HOMEBUYER'");
              $count=mysql_num_rows($list_pages); ?>
              <div class="btn-group">
              <button  onClick="window.location='manage_homebuyer.php?action=add';" class="btn green" id="editable-sample_new"> Add New <i class="icon-plus"></i> </button>
              </div><p></p>
              
              <div class="widget red">
              <input type="hidden" name="tablename" id="tablename" value="code"/>
              <div class="widget-title">
              <h4><i class="icon-reorder"></i> List</h4>
              <span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> <a href="javascript:;" class="icon-remove"></a> </span><?php
			  if(isset($_REQUEST['msg']) and $_REQUEST['msg']=='Updated')
			   {
				 ?><span class="tools"> Updated Successfully </span><?php
			   }
			  ?></div>
              <div class="widget-body" id="draggable_portlets">
              <table class="table table-striped table-bordered" id="sample_1"><?php
			  if($count>0)
			   {
				?><thead><tr>
                <th style="width:8px;">SN</th>
                <th width=""><span class="text_white">Name</span></th>
                <th width=""><span class="text_white">Other Names</span></th>
                <th width=""><span class="text_white">Email</span></th>
                <th width=""><span class="text_white">Phone</span></th>
                
                <th width=""><span class="text_white">Associated Realtor</span></th>
                <th width=""><span class="text_white">Zip</span></th>
                
                <th class="hidden-phone">Edit</th>
                <th class="hidden-phone">Delete</th></tr>
                <div id="response" style="display:none"></div></thead>
                <tbody class="sortable"><?php
				$ijij=1;
				while($data=mysql_fetch_object($list_pages))
				 {
				  $vfc= stripslashes($data->otherbuyer);
				  $oyhg= '';
				  if($vfc!='')
				   {
					 $ccd= explode('@=@', $vfc);
					 $oyhg= implode(', ', $ccd);
				   }
				  
				  ?><tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>" >
                  <td><?php echo $ijij ?></td>
                  <td><?php echo stripslashes($data->firstname);?></td>
                  <td><?php echo $oyhg;?></td>
                  <td><?php echo stripslashes($data->email);?></td>
                  <td><?php echo stripslashes($data->phone);?></td>
                  
                  <td><?php echo $allussr[$data->createdby]; ?></td>
                  
                  <td><?php echo stripslashes($data->zip);?></td>
                  
                  <td class="hidden-phone"><a class="btn btn-small btn-primary" href="manage_homebuyer.php?action=edit&edit_id=<?php echo $data->id;?>">
                  <i class="icon-pencil icon-white"></i> Edit</a></td>
                  
                  <td class="hidden-phone"><a href="javascript:;" class="btn btn-small btn-danger dell" id="<?php echo $data->id; ?>">
                  <i class="icon-remove icon-white"></i> Delete</a></td>
                  </tr><?php
				  $ijij++;
				 }
				?></tbody><?php
			  }
			 ?></table></div></div><?php
			}
		  ?></div>
         </div>
        </div>
      </div>
      <!-- END PAGE HEADER--> 
    </div>
    <!-- END PAGE CONTAINER--> 
  </div>
  <!-- END PAGE --> 
</div>
<!-- END CONTAINER -->

<?php include('footer.php');?>
<script type="text/javascript">

var err= 0;

$(document).ready(function(){
  
  $('.poin').on('keydown',function(event){
   var e = event || evt;
   var charCode = e.which || e.keyCode;
   if(charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105))
	 return false;
   return true;
  });
  
  
  $('#onee').submit(function(){
	fillfield('byr1');
	fillfield('byr2');
	fillfield('byr3');
	fillfield('first_name');
	fillfield('phone');
	fillfield('streetaddress');
	fillfield('city');
	fillfield('state');
	fillfield('zip');
	if(err==1)
	 {
	   return false;
	 }
	if($('#break').val()=='ruko')
	 {
	   return false;
	 }
  });
  
  
  $('#registerform').submit(function(){
	fillfield('first_name');
	checkma('user_email');
	fillfield('phone');
	fillfield('zip');
	fillfield('byr1');
	fillfield('byr2');
	fillfield('byr3');
	
	if(err==1)
	 {
	   return false;
	 }
	if($('#break').val()=='ruko')
	 {
	   return false;
	 }
	if($('#alread').val()!='GOTRUE')
	 {
	   return false;
	 }
  });
  
$('.dell').live('click',function(){
  var DelId =this.id;
  apprise("Are you sure you want to delete?", {'verify': true, 'animate': true, 'textYes': 'Yes', 'textNo': 'No' },
    function (r) {
  if (r) {
	  window.location.href='manage_homebuyer.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
  
  
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin = $('#p_st_date').datepicker({
    onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
    }
    checkin.hide();
    $('#p_end_date')[0].focus();
    }).data('datepicker');
    var checkout = $('#p_end_date').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout.hide();
    }).data('datepicker');
  
	
	$('#submito').click(function(){
		var i=0;
		var mai=$('#email').val();
	  $.ajax({ url: '../ajaxX.php',
		   async:false,
           data:{mai:mai},
           type: 'post',
		            success: function(output) {
                     if(output=='wrong')
					 {
						$('#email').val(''); 
						$('#email').parent().addClass('has-error');
						$("html, body").animate({ scrollTop: $('#pwd').offset().top -100 }, 1000);
						$('#email').attr('placeholder','please chose other Email Address');
						i++;
					 }
                  }
               });
	 if(i>0)
	 {
		  return false;
	 }
		});
	});
function hiii()
 {
	 $('#select12').hide();
 }
function trew()
 {
	 $('#select12').show();
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
		 $("#"+ee).attr("value", "");
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

function checkmablur(ee)
 {
   $("#alread").val("");
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
		 //$("#"+ee).attr("val", "");
		 $("#"+ee).val("");
		 $('#'+ee).attr('placeholder', 'Invalid email');
	     err= 1;
	   }
	  else
	   {
		 $.ajax({
    		type: "POST",
    		data:{mai:vv},
    		url: "../ajaxX.php",
    		dataType: "html",
    		success:function(data)
	  		 {
	   		   if(data=='alright')
			    {
				  $('#alread').attr('value', 'GOTRUE');
				  $('#'+ee).removeClass('error');
	     		  err= 0;
				}
			   else
			    {
				  $('#'+ee).addClass('error');
		 		  $("#"+ee).val("");
		 		  $('#'+ee).attr('placeholder', 'Email Already Registered');
	     		  err= 1;
				}
	  		 }
  		 });
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
</script>