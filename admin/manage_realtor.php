<?php
require '../../vendor/autoload.php';
include("config.php");
include('../mailgun/RPAMailGun.php');

include('head.php');
include("FCKeditor/fckeditor.php");
include('header.php');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE  userthree SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
	if($update)
	{
		header("LOCATION:manage_realtor.php?msg=updated");
	}	
}
 
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE  userthree SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:manage_realtor.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$delete=mysql_query("delete from  userthree  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:manage_realtor.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
   $time=time();
   if($_REQUEST['fname']!='' and $_REQUEST['lname']!='' and $_REQUEST['email']!='' and $_REQUEST['pwd']!='' and $_REQUEST['lender']!='')
    {
	  $insert_pages=mysql_query("insert into userthree  set firstname='".addslashes($_REQUEST['fname'])."',lastname='".addslashes($_REQUEST['lname'])."',companyname='".addslashes($_REQUEST['company'])."',license='".addslashes($_REQUEST['nlicense'])."',DRE='".addslashes($_REQUEST['dre'])."',phone='".addslashes($_REQUEST['phone'])."',email='".addslashes($_REQUEST['email'])."',password='".addslashes($_REQUEST['pwd'])."',street='".addslashes($_REQUEST['street'])."',suite='".addslashes($_REQUEST['suite'])."',city='".addslashes($_REQUEST['city'])."',state='".addslashes($_REQUEST['state'])."',zip='".addslashes($_REQUEST['zipcode'])."',created='".$time."',accounttype='REALTOR',createdby='".$_REQUEST['lender']."'");
	}
   if($insert_pages)
	{
		$subject= "Welcome to RePreApproval - You have been successfully registered by your lender.";
		$to= $_REQUEST['email'];
		$from= "Info@repreapproval.com";
		
		$mess= '<table width="550px">
		<tr><td colspan="2" style="background-color:#93CE52"><img src="http://www.repreapproval.com/images/logo2.png" width="340px" style=""width:340px" /></td></tr>
		<tr><td colspan="2" style="background-color:#045D92;height:10px"></td></tr>
		<tr><td colspan="2" style="color:#000;">Congratulations! You have been successfully registered with <strong>RePreApproval</strong> by your preferred lender.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td><strong style="color:#000;">Username</strong></td><td><strong style="color:#045D92;">'.$_REQUEST['email'].'</strong></td></tr>
		<tr><td><strong style="color:#000;">Password</strong></td><td><strong style="color:#045D92;">'.$_REQUEST['pwd'].'</strong></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Please keep your login information in a secured location. We also invite you to change your password at your convenience.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">If you require additional assistance, do not hesitate to email us or visit our <a href="http://www.repreapproval.com/faq.php">Frequently Asked Questions</a> page.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">Thank you for using <strong>RePreApproval</strong> for your customers pre-aproval letters.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">We wish you great success.</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">The Team at <strong>RePreApproval</strong></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2" style="background-color:#93CE52;height:20px;color:#fff;text-align:center;font-weight:bold;">To login, simply go to: http://www.repreapproval.com/login.php</td></tr>
		<tr><td colspan="2" style="background-color:#045D92;height:2px"></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr></table>';
		
//		$headers  = 'MIME-Version: 1.0' . "\r\n";
//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//		$headers .= 'From: '.$from. "\r\n";
        if($mailgun->mail($to, $subject, $mess, array('managerealtor'))) {
            header("LOCATION:manage_realtor.php?msg=Added");
        }

		}
		else
		{
			echo "ERROR";
		}
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
 {
  if($_REQUEST['fname']!='' and $_REQUEST['lname']!='' and $_REQUEST['email']!='' and $_REQUEST['lender']!='' and $_REQUEST['pwd']!='' and $_REQUEST['edit_id']!='')
   {
	 $insert_pages=mysql_query("update  userthree set firstname='".addslashes($_REQUEST['fname'])."',lastname='".addslashes($_REQUEST['lname'])."',companyname='".addslashes($_REQUEST['company'])."',license='".addslashes($_REQUEST['nlicense'])."',DRE='".addslashes($_REQUEST['dre'])."',phone='".addslashes($_REQUEST['phone'])."',email='".addslashes($_REQUEST['email'])."',street='".addslashes($_REQUEST['street'])."',suite='".addslashes($_REQUEST['suite'])."',city='".addslashes($_REQUEST['city'])."',state='".addslashes($_REQUEST['state'])."',zip='".addslashes($_REQUEST['zipcode'])."',createdby='".$_REQUEST['lender']."',password='".addslashes($_REQUEST['pwd'])."' where id='".$_REQUEST['edit_id']."'");
   }
  
  if($insert_pages)
   {
	header("LOCATION:manage_realtor.php?msg=updated");
   }
  else
   {
	echo "ERROR";
   }
 }
  ?>
<!-- BEGIN CONTAINER -->
<div id="container" class="row-fluid"> 
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
          <h3 class="page-title"> Manage Registered Realtors</h3>
          <ul class="breadcrumb">
            <li> <a href="dashboard.php">Dashboard</a> <span class="divider">/</span> </li>
            <li> <a href="javascript:;">Membership Center</a> <span class="divider">/</span> </li>
            <li class="active"> <a href="javascript:;"> Manage Realtors</a> </li>
          </ul>
          <!-- END PAGE TITLE & BREADCRUMB--> 
          <!-- BEGIN PAGE CONTENT-->
          <div class="row-fluid">
            <div class="span12"> 
              <!-- BEGIN SAMPLE FORMPORTLET--> 
              <!-- BEGIN FORM-->
              <?php if(isset($_REQUEST['action']) and $_REQUEST['action']=='add') {?>
              <div class="widget green">
                <div class="widget-title">
                  <h4><i class="icon-reorder"></i>Add</h4>
                  <span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> <a href="javascript:;" class="icon-remove"></a> </span> </div>
                <div class="widget-body">
                  <form action="manage_realtor.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                  <div class="control-group">
                  <label class="control-label">Lender</label> 
                  <div class="controls">
                  <select name="lender" id="lender" class="select" required>
                  <!--<option value="">Select Lender</option>-->
                  <?php $selMenu=mysql_query("select id, firstname ,lastname from userthree where accounttype='LENDER'"); 
				  while($munu=mysql_fetch_assoc($selMenu)) {?>
                  <option value="<?php echo $munu['id'] ?>"><?php echo $munu['firstname'].' '.$munu['lastname'] ?></option>
                  <?php }?>
                  </select>
                  </div> 
                  </div>
                  <div class="control-group">
                  <label class="control-label">Email</label>
                  <div class="controls">
                  <input type="text" placeholder="Text" onblur="checkmablur('email');"  name="email" id="email" class="input-xxlarge" value="" required />
                  </div>
                  </div>
                    
                    <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                    <input type="password" placeholder="Text"  name="pwd" id="pwd" class="input-xxlarge" value="" required/>
                    </div>
                    </div>
                    
                    <div class="control-group">
                    <label class="control-label">First Name</label>
                    <div class="controls">
                    <input type="text" placeholder="First Name"  name="fname" id="fname" class="input-xxlarge" value="" required/>
                    </div>
                    </div>
                    
                    
                    <div class="control-group">
                      <label class="control-label">Last Name</label>
                      <div class="controls">
                        <input type="text" placeholder="Last Name"  name="lname" id="lname" class="input-xxlarge" value="" required/>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Company</label>
                      <div class="controls">
                        <input type="text" placeholder="Company"  name="company" id="company" class="input-xxlarge" value="" required/>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">NMLS license</label>
                      <div class="controls">
                        <input type="text" placeholder="Text"  name="nlicense" id="nlicense" class="input-xxlarge" value="" required/>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">BRE license</label>
                      <div class="controls">
                        <input type="text" placeholder="Text"  name="dre" id="dre" class="input-xxlarge" value="" required/>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Street address</label>
                      <div class="controls">
                        <input type="text" placeholder="Text"  name="street" id="street" class="input-xxlarge" value="" required/>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Suite #</label>
                      <div class="controls">
                        <input type="text" placeholder="Text"  name="suite" id="suite" class="input-xxlarge" value="" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">City</label>
                      <div class="controls">
                        <input type="text" placeholder="Text"  name="city" id="city" class="input-xxlarge" value="" required />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">State</label>
                      <div class="controls">
                        <input type="text" placeholder="Text"  name="state" id="state" class="input-xxlarge" value="" required />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">ZIP code</label>
                      <div class="controls">
                        <input type="text" placeholder="Text"  name="zipcode" id="zipcode" class="input-xxlarge" value="" required/>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Phone</label>
                      <div class="controls">
                        <input type="text" placeholder="Text"  name="phone" id="phone" class="input-xxlarge" value="" required/>
                      </div>
                    </div>
               <div class="form-actions">
                      <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                      <button type="button" class="btn" onClick="window.location='manage_realtor.php';"><i class=" icon-remove"></i>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
              <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
			  $select_edit=mysql_query("SELECT * FROM  userthree WHERE id='".$_REQUEST['edit_id']."'");
	  		  $data_edit=mysql_fetch_assoc($select_edit);?>
              <div class="widget purple">
                <div class="widget-title">
                  <h4><i class="icon-reorder"></i> Edit</h4>
                  <span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> <a href="javascript:;" class="icon-remove"></a> </span> </div>
                <div class="widget-body">
                <form action="manage_realtor.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  class="span12"  />
                
                <div class="control-group">
                <label class="control-label">Lender</label> 
                <div class="controls">
                <select name="lender" id="lender" class="select" required>
                <!--<option value="">Select Lender</option>--><?php
				$selMenu=mysql_query("select id,firstname,lastname  from userthree where accounttype='LENDER'"); 
				 while($munu=mysql_fetch_assoc($selMenu)) {?>
                <option value="<?php echo $munu['id'] ?>" <?php if($munu['id']==$select_edit['createdby']){?>selected="selected"<?php }?>><?php echo $munu['firstname'].' '.$munu['lastname'] ?></option>
                <?php }?>
                
                </select>
                </div> </div>
                
                <div class="control-group">
                <label class="control-label">Email</label>
                      <div class="controls">
                        <input type="text" readonly="readonly" required name="email" id="email" class="input-xxlarge" value="<?php echo stripslashes($data_edit['email']); ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Password</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="pwd" id="pwd" class="input-xxlarge" value="<?php echo stripslashes($data_edit['password']); ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">First Name</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="fname" id="fname" class="input-xxlarge" value="<?php echo stripslashes($data_edit['firstname']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Last Name</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="lname" id="lname" class="input-xxlarge" value="<?php echo stripslashes($data_edit['lastname']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Company</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="company" id="company" class="input-xxlarge" value="<?php echo stripslashes($data_edit['companyname']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">NMLS license</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="nlicense" id="nlicense" class="input-xxlarge" value="<?php echo stripslashes($data_edit['license']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">DRE license</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="dre" id="dre" class="input-xxlarge" value="<?php echo stripslashes($data_edit['DRE']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Street address</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="street" id="street" class="input-xxlarge" value="<?php echo stripslashes($data_edit['street']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Suite #</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="suite" id="suite" class="input-xxlarge" value="<?php echo stripslashes($data_edit['suite']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">City</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="city" id="city" class="input-xxlarge" value="<?php echo stripslashes($data_edit['city']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">State</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="state" id="state" class="input-xxlarge" value="<?php echo stripslashes($data_edit['state']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">ZIP code</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="zipcode" id="zipcode" class="input-xxlarge" value="<?php echo stripslashes($data_edit['zip']); ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label class="control-label">Phone</label>
                      <div class="controls">
                        <input type="text" placeholder="Text" required name="phone" id="phone" class="input-xxlarge" value="<?php echo stripslashes($data_edit['phone']); ?>" />
                      </div>
                    </div>
                                        
                    <div class="form-actions">
             <button type="submit" class="btn btn-success" id="submit1" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
              <button type="button" class="btn" onClick="window.location='manage_realtor.php';"><i class=" icon-remove"></i>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
              <?php } else {
				  $list_pages=mysql_query("SELECT * FROM  userthree where accounttype='REALTOR' order by id");
                  $count=mysql_num_rows($list_pages);?>
              <!-- END FORM-->
              <div class="btn-group">
                <button  onClick="window.location='manage_realtor.php?action=add';" class="btn green" id="editable-sample_new"> Add New <i class="icon-plus"></i> </button>
              </div>
              <p></p>
              <div class="widget red">
                <input type="hidden" name="tablename" id="tablename" value="userthree"/>
                <div class="widget-title">
                  <h4><i class="icon-reorder"></i> List</h4>
                  <span class="tools"> <a href="javascript:;" class="icon-chevron-down"></a> <a href="javascript:;" class="icon-remove"></a> </span>
                  <?php if(isset($_REQUEST['msg']) and $_REQUEST['msg']=='Updated') {?>
                  <span class="tools"> Updated Successfully
                  <?php }?>
                  </span> </div>
                  <div class="widget-body" id="draggable_portlets">
                        <table class="table table-striped table-bordered" id="sample_1"> 
                            <thead> 
                      <?php if($count>0) {?>
                      <tr>
                        <th style="width:8px;">SN</th>
                        <th width=""><span class="text_white">First Name</span></th>
                        <th width=""><span class="text_white">Last Name</span></th>
                        <th width=""><span class="text_white">Company</span></th>
                         <th width=""><span class="text_white">Email</span></th>
                        <th class="hidden-phone">Edit</th>
                        <th class="hidden-phone">Delete</th>
                      </tr>
                      </thead>
                    <div id="response" style="display:none"></div>
                      
                    <tbody class="sortable">
                      <?php $ijij=1; 
while($data=mysql_fetch_object($list_pages)){?>
                      <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>">
                        <td><?php echo $ijij ?></td>
                        <td><?php echo stripslashes($data->firstname);?></td>
                        <td><?php echo stripslashes($data->lastname);?></td>
                       <td><?php echo stripslashes($data->companyname);?></td>
                        <td><?php echo stripslashes($data->email);?></td>
                        <td class="hidden-phone"><a class="btn btn-small btn-primary" href="manage_realtor.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
                        <td class="hidden-phone"><a href="javascript:;" class="btn btn-small btn-danger dell" id="<?php echo $data->id; ?>"><i class="icon-remove icon-white"></i> Delete</a></td>
                      </tr>
                      <?php	$ijij++;}?>
                    </tbody>
                    <?php } ?>
                  </table>
                </div>
              </div>
              <?php }?>
              
              <!-- END SAMPLE FORM PORTLET--> 
            </div>
          </div>
          <!-- END PAGE CONTENT--> 
          
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
$(document).ready(function(){
	
$('.dell').live('click',function(){
  var DelId =this.id;
  apprise("Are you sure you want to delete?", {'verify': true, 'animate': true, 'textYes': 'Yes', 'textNo': 'No' },
    function (r) {
  if (r) {
	  window.location.href='manage_realtor.php?action=delete&dlt_id='+DelId;
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
  
	
	$('#submit').click(function(){
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
    		  success:function(data)
	  		 {
	   		   if(data=='alright')
			    {
				  //$('#alread').attr('value', 'GOTRUE');
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

</script>