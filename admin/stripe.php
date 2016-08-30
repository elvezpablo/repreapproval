<?php include("config.php");
 include('head.php');
 include('header.php');
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE stripe_img SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:stripe.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE stripe_img SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:stripe.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	//echo "delete from faq where where id='".$_REQUEST['dlt_id']."'";die;
	$delete=mysql_query("delete from stripe_img  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:stripe.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	$time=time();	
if(!empty($_FILES['image']['name']))
	{
		$anchorimg=$time.$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],"../userfiles/".$anchorimg);
	}
	else {$anchorimg='';}
	
	
	$cat=implode(",",$_REQUEST['imagecat']);
		
$insert_pages=mysql_query("INSERT INTO  stripe_img set  img_title='".addslashes($_REQUEST['img_title'])."', img_alt='".addslashes($_REQUEST['img_alt'])."',image='".$anchorimg."'");
		if($insert_pages)
		{
			header("LOCATION:stripe.php?msg=Added");
			
		}
		else
		{
			echo "ERROR";
		}
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{

	$time=time();	
if(!empty($_FILES['image']['name']))
	{
		$anchorimg=$time.$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],"../userfiles/".$anchorimg);
	}
	else {$anchorimg=$_REQUEST['hidimg'];}	
	
	$cat=implode(",",$_REQUEST['editimagecat']);
	$update=mysql_query("UPDATE stripe_img set img_title='".addslashes($_REQUEST['img_title'])."', img_alt='".addslashes($_REQUEST['img_alt'])."',image='".$anchorimg."' WHERE id='".$_REQUEST['edit_id']."'");
	if($update)
	{
		header("LOCATION:stripe.php?msg=updated");
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
                   <h3 class="page-title">
                     Manage Image Strip at the Bottom of Pages
                   </h3>
                   <ul class="breadcrumb">
                      <li>
                           <a href="dashboard.php">Dashboard</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="javascript:;">Manage Pages</a>
                           <span class="divider">/</span>
                       </li>
                        <li>
                           <a href="javascript:;">Images Strip</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                       Image Gallery
                       </li>
                       
                   </ul>
                   <!-- END PAGE TITLE & BREADCRUMB-->
                    <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    
                            <!-- BEGIN FORM-->
                            <?php if(isset($_REQUEST['action']) and $_REQUEST['action']=='add') {?><div class="widget green">
                            <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Add Menu</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                           
                        </div>
                        <div class="widget-body">
                            <form action="stripe.php" class="form-horizontal" method="post"  enctype="multipart/form-data">

                                    <div class="control-group">
                                    <label class="control-label"> Image</label>
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
                                               <input type="file" class="default" name="image" id="image" value="">
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"> Image Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Image Title" class="input-xlarge" name="img_title" id="aimg_title" value="" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"> Image Alt</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Image Title" class="input-xlarge" name="img_alt" id="aimg_alt" value="" required />
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='stripe.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM stripe_img WHERE id='".$_REQUEST['edit_id']."'");
	                      $data_edit=mysql_fetch_object($select_edit);
								?><div class="widget purple">
                            <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Edit</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                            <div class="widget-body">
                            <form action="stripe.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  class="span12" placeholder="Name" />
                             
                                    <div class="control-group">
                                    <label class="control-label"> Image</label>
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
                                               <input type="file" class="default" name="image" id="image" value="">
                                                <input type="hidden" name="hidimg" value="<?php echo stripslashes($data_edit->image)?>"/> 
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                            <img src="../userfiles/<?php echo stripslashes($data_edit->image)?>" width="150" height="200"/>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="control-group">
                                    <label class="control-label">Image Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Image Title" class="input-xlarge" name="img_title" id="img_title" value="<?php echo stripslashes($data_edit->img_title)?>" required />
                                    </div>
                                </div>
                                
                                    <div class="control-group">
                                    <label class="control-label">Image Alt</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Image Title" class="input-xlarge" name="img_alt" id="img_alt" value="<?php echo stripslashes($data_edit->img_alt)?>" required />
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='stripe.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                            <?php } else {
								$list_pages=mysql_query("SELECT * FROM stripe_img order by order_id ASC");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><div class="btn-group">
                                         <button  onClick="window.location='stripe.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>
                                     <p></p>
                                     <div class="widget red">
                            <div class="widget-title">
                            <input type="hidden" name="tablename" id="tablename" value="stripe_img"/>
                            <h4><i class="icon-reorder"></i> Menu List</h4>
                            
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                           <?php if(isset($_REQUEST['msg']) and $_REQUEST['msg']=='Updated') {?> <span class="tools"> Updated Successfully <?php }
						   ?>
                           </span>
                        </div>
                      		   <div class="widget-body" id="draggable_portlets">
                        <table class="table table-striped table-bordered" id="sample_1"> 
                            <thead> 
							<?php if($count>0) {?>
                            <tr>
                                <th style="width:8px;">SN</th>
                                <th lass="hidden-phone">Image Title</th>
                                <th class="hidden-phone">Image Alt</th>
                                <th class="hidden-phone"> Image</th>
                                <th class="hidden-phone">Status</th>
                                <th class="hidden-phone">Edit</th>
                                <th class="hidden-phone">Delete</th>
                                
                            </tr>
                             <div id="response" style="display:none"></div>
                            </thead>
                           <tbody class="sortable">
                            <?php $ijij=1; 
while($data=mysql_fetch_object($list_pages))
{
 ?>
                              <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>" >
                                <td><?php echo $ijij ?></td>
                                <td><?php echo stripslashes($data->img_title);?></td>
                                <td class="hidden-phone"><?php echo stripslashes($data->img_alt);?></td>
                                <td class="hidden-phone"><img src="../userfiles/<?php echo $data->image ;?>" width="100" height="100"/></td>
                                <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="stripe.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="stripe.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="stripe.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i>Edit</a></td>
                                <td class="hidden-phone"><a href="javascript:;" class="btn btn-small btn-danger dell" id="<?php echo $data->id; ?>" ><i class="icon-remove icon-white"></i>Delete</a></td>
                            </tr>
                              <?php
	$ijij++;
 }
 
 ?>                            </tbody>
                            <?php }?>
                        </table>
                        </div></div>
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

  <?php include('footer.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
	
$('.dell').live('click',function(){
  var DelId =this.id;
  apprise("Are you sure you want to delete?", {'verify': true, 'animate': true, 'textYes': 'Yes', 'textNo': 'No' },
    function (r) {
  if (r) {
	  window.location.href='stripe.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	
	});
</script>