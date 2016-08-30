<?php include("config.php");
include('head.php');
include("FCKeditor/fckeditor.php");
include('header.php');
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE security_cont SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:security-content.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE security_cont SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:security-content.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	$delete=mysql_query("delete from security_cont  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:security-content.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
$time=time();
if(!empty($_FILES['img']['name']))
	{
		
		$backimg=$time.$_FILES['img']['name'];
		move_uploaded_file($_FILES['img']['tmp_name'],"../userfiles/".$backimg);
	}
	else {$backimg='';}
	//echo "INSERT INTO security_cont set img_title='".addslashes($_REQUEST['title'])."',img_alt='".addslashes($_REQUEST['alt'])."',image='".$backimg."',page_title='".addslashes($_REQUEST['page_title'])."',page_content='".addslashes($_REQUEST['content'])."'";die;
	$insert_pages=mysql_query("INSERT INTO security_cont set img_title='".addslashes($_REQUEST['title'])."',img_alt='".addslashes($_REQUEST['alt'])."',image='".$backimg."',page_title='".addslashes($_REQUEST['page_title'])."',page_content='".addslashes($_REQUEST['content'])."'");
		if($insert_pages)
		{
			header("LOCATION:security-content.php?msg=Added");
		}
		else
		{
			echo "ERROR";
		}
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
	$time=time();
	if(!empty($_FILES['img']['name']))
	{
		$backimg=$time.$_FILES['img']['name'];
		move_uploaded_file($_FILES['img']['tmp_name'],"../userfiles/".$backimg);
	}
	else {$backimg=$_REQUEST['hidbackimg'];}
	
	
$insert_pages=mysql_query("update security_cont set img_title='".addslashes($_REQUEST['title'])."',img_alt='".addslashes($_REQUEST['alt'])."',image='".$backimg."',page_title='".addslashes($_REQUEST['page_title'])."',page_content='".addslashes($_REQUEST['content'])."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:security-content.php?msg=updated");
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
                     Manage Security Page <i>(security.php)</i>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="dashboard.php">Dashboard</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="javascript:;">Security</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                        Security Content
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
                            <form action="security-content.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <div class="control-group">
                                    <label class="control-label">Image Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="title" id="title" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image Alt</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Alt " required name="alt" id="alt" class="input-xxlarge" value="" />
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
                                               <input type="file" class="default" name="img" id="img" >
                                                
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="control-group">
                                    <label class="control-label">Page Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Title " required name="page_title" id="page_title" class="input-xxlarge" value="" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Page Content</label>
                                    <div class="controls">
                              <?php
                          $sBasePath = $_SERVER['PHP_SELF'] ;
                            $sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "security-content.php"));
                              $oFCKeditor = new FCKeditor("content");
                                $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
                                $oFCKeditor->Value="";
                               $oFCKeditor->Width  = '80%' ;
                                $oFCKeditor->Height = '500px' ;
                                  $oFCKeditor->Config['EnterMode'] = 'br';
                                 $config['global_xss_filtering'] = FALSE;
                                     $oFCKeditor->Create() ;
?>
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='security-content.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM security_cont WHERE id='".$_REQUEST['edit_id']."'");
	  $data_edit=mysql_fetch_assoc($select_edit);
	  
								?>
                                	<div class="widget purple">
                            <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Edit</h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                            <div class="widget-body">
                            <form action="security-content.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  class="span12"  />
                              <div class="control-group">
                                    <label class="control-label">Image Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Text" required name="title" id="title" class="input-xxlarge" value="<?php echo stripslashes($data_edit['img_title']) ?>" />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Image Alt</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Alt " required name="alt" id="alt" class="input-xxlarge" value="<?php echo stripslashes($data_edit['img_alt']) ?>" />
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
                                               <input type="file" class="default" name="img" id="img" >
                                               <input type="hidden" name="hidbackimg" value="<?php echo stripslashes($data_edit['image']) ?>"/>
                                                
                                               </span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                <img src="../userfiles/<?php echo stripslashes($data_edit['image']) ?>" width="100" height="100"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="control-group">
                                    <label class="control-label">Page Title</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Title " required name="page_title" id="page_title" class="input-xxlarge" value="<?php echo stripslashes($data_edit['page_title']) ?>" />
                                    </div>
                                </div>
                                 <div class="control-group">
                                 
                                                                    <label class="control-label">Page Content</label>
                                <div class="controls">
                              <?php
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "security-content.php"));
$oFCKeditor = new FCKeditor("content");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value=stripslashes($data_edit['page_content']);
$oFCKeditor->Width  = '80%' ;
$oFCKeditor->Height = '500px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                    </div>
                               
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='security-content.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                                
                            <?php } else {
								$list_pages=mysql_query("SELECT * FROM security_cont");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><!--<div class="btn-group">
                                         <button  onClick="window.location='security-content.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>-->
                                     <p></p>
                                     <div class="widget red">
                                     <input type="hidden" name="tablename" id="tablename" value="security_cont"/>
                            <div class="widget-title">
                            
                            <h4><i class="icon-reorder"></i> Questions List</h4>
                            
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
                                <th width="300px">Page Title</th>
                                <th width="500px">Page Content</th>
                                <th width="500px">Image</th>
                              <th class="hidden-phone">Status</th>
                                <th class="hidden-phone">Edit</th>
                                <th class="hidden-phone">Delete</th>
                                
                            </tr>
                             <div id="response" style="display:none"></div>
                            <tbody class="sortable">
                            <tbody>
                            <?php $ijij=1; 
while($data=mysql_fetch_object($list_pages))
{
 ?>
                           <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>">
                                <td><?php echo $ijij ?></td>
                                <td><?php echo stripslashes($data->page_title);?></td>
                                 <td><?php echo stripslashes($data->page_content);?></td>
                                 <td><img src="../userfiles/<?php echo stripslashes($data->image);?>" width="200" height="200"/></td>
                                <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="security-content.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="security-content.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
    
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="security-content.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
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
	  window.location.href='security-content.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	
	});
</script>