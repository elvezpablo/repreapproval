<?php include("config.php");
 include('head.php');
 include("FCKeditor/fckeditor.php");
 include('header.php');
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE service_left_con SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:service-left-text.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE service_left_con SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:service-left-text.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	//echo "delete from faq where where id='".$_REQUEST['dlt_id']."'";die;
	$delete=mysql_query("delete from service_left_con  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:service-left-text.php?msg=deleted");
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

	$insert_pages=mysql_query("INSERT INTO service_left_con set image='".$img."', img_alt='".addslashes($_REQUEST['imgalt'])."',img_title='".addslashes($_REQUEST['imgtitle'])."', 	title='".addslashes($_REQUEST['text1'])."',subtitle='".addslashes($_REQUEST['text2'])."',url='".addslashes($_REQUEST['text3'])."',urltext='".addslashes($_REQUEST['text4'])."'");
		if($insert_pages)
		{
			header("LOCATION:service-left-text.php?msg=Added");
		}
		
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
	
	
$insert_pages=mysql_query("update service_left_con set  url='".addslashes($_REQUEST['url'])."',url_text ='".addslashes($_REQUEST['url_text'])."',text='".addslashes($_REQUEST['content'])."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:service-left-text.php?msg=updated");
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
                     Manage Services Page - Left Text <i>(services.php)</i>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="dashboard.php">Dashboard</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="javascript:;">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                         Services Page Left Text
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
                            <form action="service-left-text.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                            
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
                                    <label class="control-label">Image Alt</label>
                                    <div class="controls">
                                    <input type="text" placeholder="Text" class="input-xlarge" name="imgalt" id="imgalt" value=""  />
                                        
                                    </div>
                                </div>
                                
                                      <div class="control-group">
                                    <label class="control-label">Image Title</label>
                                    <div class="controls">
                                      
                                        <input type="text" placeholder="Text" class="input-xlarge" name="imgtitle" id="imgtitle" value=""  />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Title</label>
                                    <div class="controls">
                                    
                                        <input type="text" placeholder="Text" class="input-xlarge" name="text1" id="text1" value="" required />
                                      
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" class="input-xlarge" name="text2" id="text2" value="" required />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">URL</label>
                                    <div class="controls">
                                       <input type="text" placeholder="URL" class="input-xlarge" name="text3" id="text3" value="" required />
                                    </div>
                                </div>
                                
                                  <div class="control-group">
                                    <label class="control-label">URL Text</label>
                                    <div class="controls">
                                       <input type="text" placeholder="Text" class="input-xlarge" name="text4" id="text4" value="" required />
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='service-left-text.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM service_left_con WHERE id='".$_REQUEST['edit_id']."'");
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
                            <form action="service-left-text.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"   />
                                
                                <div class="control-group">
                                    <label class="control-label">URL</label>
                                    <div class="controls">
                                       <input type="text" placeholder="Text" class="input-xlarge" name="url" id="url" value="<?php echo $data_edit['url']  ?>" required />
                                    </div>
                                </div>
                                
                                  <div class="control-group">
                                    <label class="control-label">URL Text</label>
                                    <div class="controls">
                                       <input type="text" placeholder="Text" class="input-xlarge" name="url_text" id="url_text" value="<?php echo $data_edit['url_text']  ?>" required />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Text</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "service-left-text.php"));
$oFCKeditor = new FCKeditor("content");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value= stripslashes($data_edit['text']);
$oFCKeditor->Width  = '70%' ;
$oFCKeditor->Height = '400px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                
                                
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='service-left-text.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                                
                            <?php } else {
								$list_pages=mysql_query("SELECT * FROM service_left_con order by order_id");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><div class="btn-group">
                                         <!--<button  onClick="window.location='service-left-text.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>-->
                                     </div>
                                     <p></p>
                                     <div class="widget red">
                                       <input type="hidden" name="tablename" id="tablename" value="service_left_con"/>
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
                                <th width="">Text</th>
                              <th class="hidden-phone" width="100px">Status</th>
                                <th class="hidden-phone" width="100px">Edit</th>
                              <!--  <th class="hidden-phone" width="100px">Delete</th>-->
                                
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
                                <td><?php echo stripslashes($data->text);?></td>
                                <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="service-left-text.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="service-left-text.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
    
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="service-left-text.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
                       <!--         <td class="hidden-phone"><a href="javascript:;" class="btn btn-small btn-danger dell" id="<?php echo $data->id; ?>"><i class="icon-remove icon-white"></i> Delete</a></td>-->
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
	  window.location.href='service-left-text.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	
	});
</script>