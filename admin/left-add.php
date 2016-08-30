<?php 
include("../includes/config.php");
include('head.php');
include("FCKeditor/fckeditor.php");
include('header.php');
$msg='';
if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_green')
{
	$update=mysql_query("UPDATE  add_content SET status='0' WHERE id='".$_REQUEST['upd_id']."' ");
		if($update)
	{
		header("LOCATION:left-add.php?msg=updated");
	}	
}
 
 if(isset($_REQUEST['action']) && $_REQUEST['action']=='update_red')
{
	$update=mysql_query("UPDATE  add_content SET status='1' WHERE id='".$_REQUEST['update_id']."' ");
	if($update)
	{
		header("LOCATION:left-add.php?msg=updated");
	}	
}

if(isset($_REQUEST['action']) && $_REQUEST['action']=='delete')
{
		$delete=mysql_query("delete from  add_content  where id='".$_REQUEST['dlt_id']."'");
	if($delete)
	{
		header("LOCATION:left-add.php?msg=deleted");
	}	
}


if(isset($_REQUEST['submit']) && $_REQUEST['submit']=='Add')
{
	$insert=mysql_query("insert into add_content(type,content) values('left','".addslashes($_REQUEST['FCKeditor1'])."')");
	if($inser)
	{
		header('location:left.php?msg=inserted');
		//$msg='inserted';
	}
	else
	{
		$msg='error';
	}
	}

if(isset($_REQUEST['submit']) && $_REQUEST['submit']=="Update")
{
	//echo "update add_content set content='".addslashes($_REQUEST['FCKeditor1'])."' where id='".$_REQUEST['edit_id']."'";die;
$insert_pages=mysql_query("update add_content set content='".addslashes($_REQUEST['FCKeditor1'])."' where id='".$_REQUEST['edit_id']."'");
		if($insert_pages)
		{
			header("LOCATION:left-add.php?msg=updated");
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
                     Manage Add
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="dashboard.php">Dashboard</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="javascript:;">Add</a>
                           <span class="divider">/</span>
                       </li>
                       <li class="active">
                        <a href="javascript:;"> Left</a>
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
                            <form action="left-add.php" class="form-horizontal" method="post" enctype="multipart/form-data" id="myform">
                                <div class="control-group">
                                    <label class="control-label">Add Content</label>
                                    <div class="controls">
                              <?php
                                  $sBasePath = $_SERVER[ 'PHP_SELF' ] ;                                                       
$oFCKeditor = new FCKeditor('FCKeditor1') ;                                                   
$oFCKeditor->BasePath = 'FCKeditor/' ; $oFCKeditor->Height = 800;                                                                     
$oFCKeditor->Width  = 600;                                                                     
$oFCKeditor->Value = '' ;
$oFCKeditor->Create() ;
                                ?>
                                    </div>
                                </div>
                                <input type="hidden" name="tester" id="testeradd" value="" />
                                
                                 <input type="hidden" name="tester1" id="testeradd1" value="" />
                                <div class="form-actions">
                          <button type="submit" class="btn btn-success" id="submit" name="submit" value="Add"><i class="icon-ok"></i> Save</button>
                        <button type="button" class="btn" onClick="window.location='left-add.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div></div>
                            <?php } else if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit'){
								 $select_edit=mysql_query("SELECT * FROM  add_content WHERE id='".$_REQUEST['edit_id']."'");
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
                            <form action="left-add.php" class="form-horizontal" method="post" enctype="multipart/form-data" id="myform">
                                <div class="control-group">
                                    <label class="control-label">Add Content</label>
                                    <div class="controls">
                              <?php
 
                     $sBasePath = $_SERVER[ 'PHP_SELF' ] ;                                                       
$oFCKeditor = new FCKeditor('FCKeditor1') ;                                                   
$oFCKeditor->BasePath = 'FCKeditor/' ; $oFCKeditor->Height = 800;                                                                     
$oFCKeditor->Width  = 600;                                                                     
$oFCKeditor->Value = stripslashes($data_edit['content']) ;
$oFCKeditor->Config['EnterMode'] = 'br';
$oFCKeditor->Create() ;
                                ?>
                                    </div>
                                </div>
                                <input type="hidden" name="tester" id="testeradd" value="" />
                                
                                 <input type="hidden" name="tester1" id="testeradd1" value="" />
                                <div class="form-actions">
                           <button type="submit" class="btn btn-success" id="submit" name="submit" value="Update"><i class="icon-ok"></i> Save</button>
                           <button type="button" class="btn" onClick="window.location='left-add.php';"><i class=" icon-remove"></i>Cancel</button>
                                </div>
                            </form>
                            </div> </div>
                                
                            <?php } else {
								
								$list_pages=mysql_query("SELECT * FROM  add_content order by id");
                                 $count=mysql_num_rows($list_pages);
								?>
                            
                                           
                              <?php if(isset($_REQUEST['msg'])) {?>      
                        <div align="center" class=" alert-error" id="successMessage"> 
                        <?php if($_REQUEST['msg']=='updated') {?>
                        <h3>Updated Successfully  </h3>
                        <?php } else if($_REQUEST['msg']=='deleted') {?>
                          <h3>Deleted Successfully  </h3>
                          <?php }?>
                        </div>
                        <?php }?>
                                     <div class="widget red">
                                      <input type="hidden" name="tablename" id="tablename" value="new_page"/>
                            <div class="widget-title">
                            
                            <h4><i class="icon-reorder"></i> List</h4>
                            
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
                                 <th class="hidden-phone" >Type</th>
                                <!--<th class="hidden-phone">Content</th>-->
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
                            <tr class="odd gradeX widget" id="arrayorder_<?php echo $data->id; ?>">
                                <td><?php echo $ijij ?></td>
                                <td><?php echo stripslashes($data->type);?></td>
                             <?php /*?>   <td><?php echo stripslashes($data->content);?></td><?php */?>
                                
                                 
                                <?php if($data->status==1)
		 {
			?><td class="hidden-phone">
			<a class="btn btn-small btn-success" href="left-add.php?action=update_green&upd_id=<?php echo $data->id?>">Active</a></td><?php
		 }
		else
		 {
			?><td class="hidden-phone" >
			<a class="btn btn-small btn-danger" href="left-add.php?action=update_red&update_id=<?php echo $data->id?>">Deactive</a></td><?php
		 }?>
    
                                <td class="hidden-phone"><a class="btn btn-small btn-primary" href="left-add.php?action=edit&edit_id=<?php echo $data->id;?>"><i class="icon-pencil icon-white"></i> Edit</a></td>
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
	  window.location.href='left-add.php?action=delete&dlt_id='+DelId;
	  }
   else
   {
    return false;
   }
  })});
	});
	$(function() {
    // $("#successMessage").hide() function
    setTimeout(function() {
        $("#successMessage").hide('blind', {}, 300)
    }, 5000);
});
</script>