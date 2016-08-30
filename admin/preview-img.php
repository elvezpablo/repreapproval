<?php include("config.php");
 include('head.php');
 include("FCKeditor/fckeditor.php");
 include('header.php');
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE  footer_preview SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:preview-img.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE  footer_preview SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:preview-img.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	//echo "delete from faq where where id='".$_REQUEST['dlt_id']."'";die;
	$delete=mysql_query("delete from  footer_preview  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:preview-img.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	$time=time();
	if(!empty($_FILES['image']['name']))
	{
		$img=$time.$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],"../userfiles/".$img);
	}
	else {$img='';}
	
	$insert_pages=mysql_query("INSERT INTO  footer_preview set url='".addslashes($_REQUEST['url'])."', image='".$img."',img_title='".addslashes($_REQUEST['img_title'])."',img_alt='".addslashes($_REQUEST['img_alt'])."'");
		if($insert_pages)
		{
			header("LOCATION:preview-img.php?msg=Added");
		}
		
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
	$time=time();
	if(!empty($_FILES['image']['name']))
	{
		$img=$time.$_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],"../userfiles/".$img);
	}
	else {$img=$_REQUEST['hidimg'];}
	
	$insert_pages=mysql_query("update  footer_preview set url='".addslashes($_REQUEST['url'])."',img_title='".addslashes($_REQUEST['img_title'])."',img_alt='".addslashes($_REQUEST['img_alt'])."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:preview-img.php?msg=updated");
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
                     ManageTop Footer<i></i>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="dashboard.php">Dashboard</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="javascript:;">Footere</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                        Top Footer
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
                             <h4><i class="icon-reorder"></i>Add</h4>
                            
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                           
                        </div>
                        <div class="widget-body">
                            <form action="preview-img.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                              
                              
                              <div class="control-group">
                                    <label class="control-label">Image Alt</label>
                                    <div class="controls">
                                      
                                        <input type="text" placeholder="Alt" class="input-xlarge" name="img_alt" id="img_alt" value=""  />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image Title</label>
                                    <div class="controls">
                                      
                                        <input type="text" placeholder="Title" class="input-xlarge" name="img_title" id="img_title" value=""  />
                                    </div>
                                </div>
                                
                              <div class="control-group">
                                    <label class="control-label">Image</label>
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
                                               <input type="file" class="default" name="image" id="image" required>
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                              
                            <div class="control-group">
                                    <label class="control-label"> Url</label>
                                    <div class="controls">
                                    <input type="text" placeholder="Url" class="input-xlarge" name="url" id="url" value=""  required/>
                                        
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='preview-img.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM  footer_preview WHERE id='".$_REQUEST['edit_id']."'");
	  $data_edit=mysql_fetch_assoc($select_edit);
	  
								?>
                                	<div class="widget purple">
                            <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Edit Menu</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                            <div class="widget-body">
                            <form action="preview-img.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"   />
                             
                                      <div class="control-group">
                                    <label class="control-label">Image Alt</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Alt" class="input-xlarge" name="img_alt" id="img_alt" value="<?php echo stripslashes($data_edit['img_alt']) ?>"  />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image Title</label>
                                    <div class="controls">
                                      
                                        <input type="text" placeholder="Title" class="input-xlarge" name="img_title" id="img_title" value="<?php echo stripslashes($data_edit['img_title']) ?>"  />
                                    </div>
                                </div>
                                
                              <div class="control-group">
                                    <label class="control-label">Image</label>
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
                                               <input type="file" class="default" name="image" id="image" >
                                               <input type="hidden" name="hidimg" value="<?php echo $data_edit['image'] ?>"/>
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                <img src="../userfiles/<?php echo $data_edit['image'] ?>" width="100" height="100"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="control-group">
                                    <label class="control-label"> Title</label>
                                    <div class="controls">
                                    <input type="text" placeholder="Title" class="input-xlarge" name="url" id="url" value="<?php echo stripslashes($data_edit['url']) ?>"  required/>
                                        
                                    </div>
                                </div>
                                
                              
                                
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='preview-img.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                                
                            <?php } else {
								$list_pages=mysql_query("SELECT * FROM  footer_preview");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><div class="btn-group">
                                         <button  onClick="window.location='preview-img.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>
                                     <p></p>
                                     <div class="widget red">
                                       <input type="hidden" name="tablename" id="tablename" value=" footer_preview"/>
                            <div class="widget-title">
                            
                            <h4><i class="icon-reorder"></i> Sliders</h4>
                            
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
                                <th > Title</th>
                                <th width="200px">Image</th>
                              <th class="hidden-phone" width="100px">Status</th>
                                <th class="hidden-phone" width="100px">Edit</th>
                                <th class="hidden-phone" width="100px">Delete</th>
                                
                            </tr>
                            </thead>
                            <div id="response" style="display:none"></div>
                           <tbody class="sortable">
                            <?php $ijij=1; 
while($data=mysql_fetch_object($list_pages))
{
 ?>
                            <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>">
                                <td><?php echo $ijij ?></td>
                                <td><?php echo stripslashes($data->img_title);?></td>
                                <td><img src="../userfiles/<?php echo $data->image;?>"/ width="150" height="150"></td>
                              <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="preview-img.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="preview-img.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
    
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="preview-img.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
                                <td class="hidden-phone"><a href="javascript:;" class="btn btn-small btn-danger dell" id="<?php echo $data->id; ?>"><i class="icon-remove icon-white"></i> Delete</a></td>
                            </tr>
                              <?php
	$ijij++;
 }
 
 ?>
                            </tbody>
                            <?php } else {?>
                            <tbody>
                            <tr class="odd gradeX">
                                <td>No Record Found</td>
                                <td></td>
                                <td></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                            </tr>
                            
                            </tbody>
                            <?php } ?>
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

<?php include('footer.php');?>
<script type="text/javascript">
$(document).ready(function(){
	
$('.dell').live('click',function(){
  var DelId =this.id;
  apprise("Are you sure you want to delete?", {'verify': true, 'animate': true, 'textYes': 'Yes', 'textNo': 'No' },
    function (r) {
  if (r) {
	  window.location.href='preview-img.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	
	});
</script>