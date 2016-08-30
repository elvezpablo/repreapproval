<?php
include("config.php");
include('head.php');
include('header.php');
$msg='';

if(isset($_POST['submit']) && $_POST['submit']=='Update')
{
  $select_oldpassword=mysql_query("SELECT * FROM userthree where password='".$_REQUEST['oldpassword']."'");
  $data_oldpassword=mysql_fetch_object($select_oldpassword);
  $count=mysql_num_rows($select_oldpassword);
  if($count>0)
   {
	
	$update=mysql_query("UPDATE userthree set `username`='".$_REQUEST['username']."',`password`='".$_REQUEST['confirmpass']."',`email`='".$_REQUEST['email']."' where `accounttype`= 'ADMIN'");
	// veersir Faulty// $update=mysql_query("UPDATE userthree set `username`='".$_REQUEST['username']."',`password`='".$_REQUEST['confirmpass']."',`email`='".$_REQUEST['email']."'");
	if($update)
	 {
	  $msg='Updated';
	  //header("Location:change-pwd.php?msg=Updated");
	 }
   }
  else
   {
	 $msg='wrongpassword';
	 //header("Location:change-pwd.php?msg=wrongpassword");
   }
}
	$select=mysql_query("SELECT * FROM userthree where `accounttype`= 'ADMIN'");
	$data=mysql_fetch_object($select);
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
					 <h3 class="page-title">
					   Admin Account Management
					 </h3>
					 <ul class="breadcrumb">
						 <li>
							 <a href="dashboard.php">Dashboard</a>
							 <span class="divider">/</span>
						 </li>
						 <li>
							 <a href="javascript:;">Account</a>
							 <span class="divider">/</span>
						 </li>
						 <li class="active">
							 Account Details
						 </li>
					 </ul>
					 <!-- END PAGE TITLE & BREADCRUMB-->
					  <!-- BEGIN PAGE CONTENT-->
			  <div class="row-fluid">
				  <div class="span12">
					  <!-- BEGIN SAMPLE FORMPORTLET-->
						<?php if($msg!='' and $msg=='Updated') {?> 
                        <div align="center" class=" alert-error"> <h3>Updated Successfully  </h3></div>
						<?php }
							 ?>
							   <?php if($msg!='' and $msg=='wrongpassword') {?>
                                <div align="center" class=" alert-error"> <h3> Entered wrong current password  </h3></div>
								<?php }
							 ?>
					  <div class="widget green">
						  <div class="widget-title">
							  <h4> Change Account Details</h4>
							  <span class="tools">
							  <a href="javascript:;" class="icon-chevron-down"></a>
							  <a href="javascript:;" class="icon-remove"></a>
							  </span>
							  </div>
						  <div class="widget-body">
							  <!-- BEGIN FORM-->
							  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-horizontal" method="post">
								  <!--<div class="control-group">
									  <label class="control-label">Username</label>
									  <div class="controls">
										  <input type="text" placeholder="Username" class="input-xlarge" name="username" id="username" value="<?php echo $data->username; ?>" />
									  </div>
								  </div>-->
								  <div class="control-group">
									  <label class="control-label">Email</label>
									  <div class="controls">
										  <input type="text" placeholder="Email" name="email" id="email" class="input-xlarge" value="<?php echo $data->email; ?>" />                                    </div>
								  </div>
								  <div class="control-group">
									  <label class="control-label">Current Password</label>
									  <div class="controls">
										  <input type="password" placeholder="Password" class="input-xlarge" id="oldpassword" name="oldpassword" />
									  </div>
								  </div>
								  <div class="control-group">
									  <label class="control-label">New Password</label>
									  <div class="controls">
										  <input type="password" placeholder="Password" class="input-xlarge" id="newpassword" name="newpassword"/>
									  </div>
								  </div>
								  <div class="control-group">
									  <label class="control-label">Confirm Password</label>
									  <div class="controls">
										  <input type="password" placeholder="Password" class="input-xlarge" id="confirmpass" name="confirmpass" />
									  </div>
								  </div>
								 <!--<div class="control-group">
									  <label class="control-label">Photo</label>
									  <div class="controls">
										  <div class="fileupload fileupload-new" data-provides="fileupload">
											  <div class="input-append">
												  <div class="uneditable-input">
													  <i class="icon-file fileupload-exists"></i>
													  <span class="fileupload-preview"></span>
												  </div>
												 <span class="btn btn-file">
												 <span class="fileupload-new">Select file</span>
												 <span class="fileupload-exists">Change</span>
												 <input type="file" class="default" name="image" id="image">
												 </span>
												  <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
											  </div>
										  </div>
									  </div>
								  </div>-->
								  <div class="form-actions">
									  <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
									  <button type="button" class="btn"><i class=" icon-remove"></i> Reset</button>
								  </div>
							  </form>
							  <!-- END FORM-->
						  </div>
					  </div>
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
	$("#submit").click(function(){
	if($("#oldpassword").val()=='')
	{
	apprise("Please Enter Your Current Password")	;
	return false;
	}
	else
		if($("#newpassword").val()=='')
	{
	apprise("Please Enter Your New Password")	;
	return false;
	}
		if($("#confirmpass").val()=='')
	{
	apprise("Please Enter Your Confirm Password")	;
	return false;
	}
	var pass1=$("#newpassword").val();
	var pass2=$("#confirmpass").val();
	if(pass1 !=pass2)
	{
		$("#confirmpass").val('');
		apprise("Your NewPaasword and ConfirmPassword Not Matched");
		return false;
	}
		});	
		})
	</script>