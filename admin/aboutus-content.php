<?php include("config.php");
 include('head.php');
 include("FCKeditor/fckeditor.php");
 include('header.php');
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE about_us SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:aboutus-content.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE about_us SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:aboutus-content.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
	//echo "delete from faq where where id='".$_REQUEST['dlt_id']."'";die;
	$delete=mysql_query("delete from about_us  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:aboutus-content.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	
	$insert_pages=mysql_query("INSERT INTO about_us set page_title='".addslashes($_REQUEST['page_title'])."', page_sub_title='".addslashes($_REQUEST['sub_title'])."', content='".addslashes($_REQUEST['content'])."',founder_msg='".addslashes($_REQUEST['founder_msg'])."',vedio='".addslashes($_REQUEST['vedio'])."'");
		if($insert_pages)
		{
			header("LOCATION:aboutus-content.php?msg=Added");
		}
		
}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
$insert_pages=mysql_query("update about_us  set page_title='".addslashes($_REQUEST['page_title'])."', page_sub_title='".addslashes($_REQUEST['sub_title'])."', content='".addslashes($_REQUEST['content'])."',founder_msg='".addslashes($_REQUEST['founder_msg'])."',vedio='".addslashes($_REQUEST['vedio'])."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:aboutus-content.php?msg=updated");
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
                     Manage About Us Page <i>(about.php)</i>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="dashboard.php">Dashboard</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="javascript:;">About Us Page</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                         About Us Content
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
                            <form action="aboutus-content.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                              
                            <div class="control-group">
                                    <label class="control-label">Page Title</label>
                                    <div class="controls">
                                    <input type="text" placeholder="Title" class="input-xlarge" name="page_title" id="page_title" style="width:600px;" value=""  required />
                                        
                                    </div>
                                </div>
                                
                                      <div class="control-group">
                                    <label class="control-label">Page Subtitle Title</label>
                                    <div class="controls">
                                      
                                        <input type="text" placeholder="Sub Title" class="input-xlarge" name="sub_title" id="sub_title" style="width:600px;" value=""  required/>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Founder's Video</label>
                                    <div class="controls">
                                      
                                        <input type="text" placeholder="Video URL" class="input-xlarge" name="vedio" id="vedio" style="width:600px;" value=""  required/>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Message From Founder</label>
                                    <div class="controls">
                                      <textarea name="founder_msg" id="founder_msg" class="input-xlarge" style="width:600px;" placeholder="Founder Message" rows="10" cols="20" required> </textarea>
                                        
                                    </div>
                                </div>
                                
                              
                           
                                
                               <div class="control-group">
                                    <label class="control-label">Content</label>
                                    <div class="controls">
                              <?php
 $sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "aboutus-content.php"));
$oFCKeditor = new FCKeditor("content");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value="";
$oFCKeditor->Width  = '70%' ;
$oFCKeditor->Height = '400px' ;
$oFCKeditor->Config['EnterMode'] = 'br';
$config['global_xss_filtering'] = FALSE;
$oFCKeditor->Create() ;
?>
                                    </div>
                                </div> 
                                
                                
                                
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn" onClick="window.location='aboutus-content.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM about_us WHERE id='".$_REQUEST['edit_id']."'");
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
                            <form action="aboutus-content.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                             <input type="hidden" value="<?php echo $_REQUEST['edit_id']?>" name="edit_id"  style="width:600px;"  />

                               <div class="control-group">
                                    <label class="control-label">Page Title</label>
                                    <div class="controls">
                                    <input type="text" placeholder="Title" class="input-xlarge" name="page_title" id="page_title" value="<?php echo stripslashes($data_edit['page_title']) ?>" style="width:600px;" required/>

                                    </div>
                                </div>
                                
                                      <div class="control-group">
                                    <label class="control-label">Page Subtitle Title</label>
                                    <div class="controls">
                                      
                                        <input type="text" placeholder="Sub Title" class="input-xlarge" name="sub_title" id="sub_title" value="<?php echo stripslashes($data_edit['page_sub_title']) ?>"  style="width:600px;" required/>
                                        </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Founder's Video</label>
                                    <div class="controls">
                                      
                                        <input type="text" placeholder="Video URL" class="input-xlarge" name="vedio" id="vedio" value="<?php echo stripslashes($data_edit['vedio']) ?>" style="width:600px;" required />
                                        </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Message From Founder</label>
                                    <div class="controls">
                                      <textarea name="founder_msg" id="founder_msg" class="input-xlarge" required placeholder="Founder Message" rows="10" cols="20" style="width:600px;"> <?php echo stripslashes($data_edit['founder_msg']) ?></textarea>
                                        
                                    </div>
                                </div>
                                <div class="control-group">
                                 
                                                                    <label class="control-label">Content</label>
                                    <div class="controls">
                              <?php
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "aboutus-content.php"));
$oFCKeditor = new FCKeditor("content");
 $oFCKeditor->BasePath = $sBasePath.'/FCKeditor/';
$oFCKeditor->Value=stripslashes($data_edit['content']);
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
                                    <button type="button" class="btn" onClick="window.location='aboutus-content.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                                
                            <?php } else {
								$list_pages=mysql_query("SELECT * FROM about_us");
                                 $count=mysql_num_rows($list_pages);
								?>
                            <!-- END FORM--><div class="btn-group">
                                         <button  onClick="window.location='aboutus-content.php?action=add';" class="btn green" id="editable-sample_new">
                                             Add New <i class="icon-plus"></i>
                                         </button>
                                     </div>
                                     <p></p>
                                     <div class="widget red">
                                       <input type="hidden" name="tablename" id="tablename" value="about_us"/>
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
                                <th >Page Title</th>
                                <th width="">Page Subtitle</th>
                                <th width="200px">Founder Message</th>
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
                                <td><?php echo stripslashes($data->page_title  );?></td>
                                <td><?php echo stripslashes($data->page_sub_title  );?></td>
                                  <td><?php echo stripslashes($data->founder_msg  );?></td>
                                <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="aboutus-content.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="aboutus-content.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
    
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="aboutus-content.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
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
	  window.location.href='aboutus-content.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	
	});
</script>